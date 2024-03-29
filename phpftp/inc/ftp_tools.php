<?php
// ***************************************
// ** FILE:    FTP_TOOLS.PHP            **
// ** PURPOSE: PHFTP                    **
// ** DATE:    09.03.2011               **
// ** AUTHOR:  ANDREAS MEHRRATH         **
// ***************************************



// *********************************************
// THIS FUNCTION RETURNS THE CURRENT FTP STREAM
// *********************************************
function phpftp_connect($phpftp_user,$phpftp_passwd)
{
    global $phpftp_host, $phpftp_port, $phpftp_ssl, $conf_timeout, $phpftp_passive, $al;

	$err_level = 1;

    if ($phpftp_ssl)
    {
        $ftp = ftp_ssl_connect($phpftp_host,$phpftp_port,$conf_timeout);
        if ($ftp)
        {
			$err_level = 2;
            if (ftp_login($ftp,$phpftp_user,dec_pwd($phpftp_passwd)))
            {
            	if ($phpftp_passive) ftp_pasv($ftp, true);
                return $ftp;
            }
        }
    }
    else
    {
        $ftp = ftp_connect($phpftp_host,$phpftp_port,$conf_timeout);
        if ($ftp)
        {
			$err_level = 2;
            if (ftp_login($ftp,$phpftp_user,dec_pwd($phpftp_passwd)))
            {
				if ($phpftp_passive) ftp_pasv($ftp, true);
                return $ftp;
            }
        }
    }

    if ($err_level==1) show_error(sts($al['error2'],array($phpftp_host,$phpftp_port))."\n<br><br>\n"._ERR_RETRY);
	else               show_error(sts($al['error1'],$phpftp_host)."\n<br><br>\n"._ERR_RETRY);

    return false;
}



// ********************************************************************************************
// ********************************************************************************************
function phpftp_cd($phpftp_user,$phpftp_passwd,$phpftp_dir,$select_directory)
{
    $new_directory=$phpftp_dir . "/" . $select_directory;
    phpftp_list($phpftp_user,$phpftp_passwd,$new_directory);
}



// ********************************************************************************************
// ********************************************************************************************
function phpftp_mkdir($phpftp_user,$phpftp_passwd,$phpftp_dir,$new_dir)
{
    $rVal = false;
    
    $ftp = @phpftp_connect($phpftp_user,$phpftp_passwd);
    if ($phpftp_dir == "") {
        $phpftp_dir="/";
    }
    if (!$ftp)
    {
        @ftp_close($ftp);
    } else {
        $dir_path = $phpftp_dir . "/" . $new_dir;
        
        if (@ftp_mkdir($ftp,$dir_path))
        $rVal = true;
        
        @ftp_close($ftp);
    }
    
    phpftp_list($phpftp_user,$phpftp_passwd,$phpftp_dir);
    
    return $rVal;
}



// ********************************************************************************************
// ********************************************************************************************
function phpftp_get($phpftp_user,$phpftp_passwd,$phpftp_dir,$select_file)
{
    global $phpftp_tmpdir, $endmsg, $al, $conf_phpftp_ascii_files;

    $rVal = false;
    
    $ftp = @phpftp_connect($phpftp_user,$phpftp_passwd);
    if ($phpftp_dir == "")
    {
        $phpftp_dir="/";
    }
    if ((!$ftp) || (!@ftp_chdir($ftp,$phpftp_dir)))
    {
        $endmsg = sts($al['error15'],$phpftp_dir);
        @ftp_close($ftp);
    } else
    {
        srand((double)microtime()*1000000);
        $randval = rand();
        $tmpfile=$phpftp_tmpdir . "/" . $select_file . "." . $randval;
        
        //  FTP_ASCII | FTP_BINARY
        $ftp_enc=FTP_BINARY;
        if (
        (isset($conf_phpftp_ascii_files))&&
        (is_array($conf_phpftp_ascii_files))&&
        (instr($select_file,"."))&&
        (in_array(strtolower(substr($select_file,strrpos($select_file,"."))),$conf_phpftp_ascii_files))
        )
        $ftp_enc=FTP_ASCII;        
        
        if (!@ftp_get($ftp,$tmpfile,$select_file,$ftp_enc))
        {
            ftp_close($ftp);
            show_error($al['error5']);
            show_error(sts($al['error6'],dirname($tmpfile))."\n<br><br>\n"._ERR_RETRY);
        } else
        {
            @ftp_close($ftp);

            include_once("mimetype.php");
            $mime_type = new mimetype();
            header("Content-Type: " . $mime_type->getMimeType($select_file));
            header("Content-Disposition: attachment; filename=" . $select_file);
            
            if (readfile($tmpfile))
            $rVal = true;
        }
        @unlink($tmpfile);
    }
    return $rVal;
}



// ********************************************************************************************
// PHP 5 MODIFICATIONS -> FILE EXTRACTION ARRAY CHANGES
// ********************************************************************************************
function phpftp_put($phpftp_user,$phpftp_passwd,$phpftp_dir,$userfile)
{
    global $phpftp_tmpdir, $max_file_size, $endmsg, $al, $conf_phpftp_ascii_files;
    
    $rVal = false;

    if ($userfile['size']>$max_file_size)
    {
        unset($userfile);
        $endmsg = sts($al['error14'],$max_file_size);
        phpftp_list($phpftp_user,$phpftp_passwd,$phpftp_dir);
    }
    else
    {
        srand((double)microtime()*1000000);
        $randval = rand();

        $tmpfile=$phpftp_tmpdir . "/" . $userfile['name'] . "." . $randval;

        $userfile_name = $userfile['tmp_name'];							// UPLOAD TEMP FILE NAME

        if (!@move_uploaded_file($userfile_name,$tmpfile))				// HTTP UPLOAD SPEICHERN
        {
            show_error(sts($al['error6'],dirname($tmpfile))."\n<br><br>\n"._ERR_RETRY);
        }
        else
        {
            if (!$ftp = @phpftp_connect($phpftp_user,$phpftp_passwd))
            {
                @unlink($tmpfile);
                @ftp_close($ftp);
            } else
            {
                @ftp_chdir($ftp,$phpftp_dir);
                
                //  FTP_ASCII | FTP_BINARY
                $ftp_enc=FTP_BINARY;
                if (
                (isset($conf_phpftp_ascii_files))&&
                (is_array($conf_phpftp_ascii_files))&&
                (instr($userfile['name'],"."))&&
                (in_array(strtolower(substr($userfile['name'],strrpos($userfile['name'],"."))),$conf_phpftp_ascii_files))
                )
                $ftp_enc=FTP_ASCII; 
                
                if (@ftp_put($ftp,$userfile['name'],$tmpfile,$ftp_enc))		// HTTP UPLOAD AN FTP SERVER
                $rVal = true;
                
                @ftp_close($ftp);
                @unlink($tmpfile);
            }
        }
    }
    phpftp_list($phpftp_user,$phpftp_passwd,$phpftp_dir);
    
    return $rVal;
}



// ********************************************************************************************
function phpftp_chmod($phpftp_user,$phpftp_passwd,$phpftp_dir,$select_file,$chmode)
// ********************************************************************************************
{
    global $phpftp_tmpdir, $endmsg, $al;
    
    $rVal = false;

    if (($select_file!="")&&($chmode!=""))
    {
        $ftp = @phpftp_connect($phpftp_user,$phpftp_passwd);

        if ($phpftp_dir == "")  $phpftp_dir="/";

        if (function_exists("ftp_site"))
        {
        	@ftp_chdir($ftp,str_replace("//","/",$phpftp_dir));
        	if (!ftp_site($ftp,"CHMOD 0".$chmode." ".$select_file))
            	$endmsg = sts($al['error8'],array($chmode,$select_file));
            else 
            $rVal = true;
        }
        else
        	$endmsg = $al['error7'];

        @ftp_close($ftp);
    }
    else $endmsg = $al['error9'];

    phpftp_list($phpftp_user,$phpftp_passwd,$phpftp_dir);
    
    return $rVal;
}



// ********************************************************************************************
function phpftp_drop($phpftp_user,$phpftp_passwd,$phpftp_dir,$select_file)
// ********************************************************************************************
{
    global $phpftp_tmpdir, $endmsg, $al;
    
    $rVal = false;

    if ($select_file!="")
    {
        $ftp = @phpftp_connect($phpftp_user,$phpftp_passwd);

        if ($phpftp_dir == "")  $phpftp_dir="/";

        if (!@ftp_delete($ftp,str_replace("//","/",$phpftp_dir."/".$select_file)))
            $endmsg = sts($al['error10'],$select_file);
        else 
        $rVal = true;

        @ftp_close($ftp);
    }
    else    $endmsg = $al['error11'];

    phpftp_list($phpftp_user,$phpftp_passwd,$phpftp_dir);
    
    return $rVal;
}



// ********************************************************************************************
function phpftp_dropdir($phpftp_user,$phpftp_passwd,$phpftp_dir,$select_directory)
// ********************************************************************************************
{
    global $phpftp_tmpdir, $endmsg, $al;
    
    $rVal = false;

    if ($select_directory!="")
    {
        $ftp = @phpftp_connect($phpftp_user,$phpftp_passwd);

        if ($phpftp_dir == "") $phpftp_dir="/";

        if (!@ftp_rmdir($ftp,str_replace("//","/",$phpftp_dir."/".$select_directory)))
            $endmsg = sts($al['error12'],$select_directory);
        else 
        $rVal = true;

        @ftp_close($ftp);
    }
    else    $endmsg = $al['error13'];

    phpftp_list($phpftp_user,$phpftp_passwd,$phpftp_dir);
    
    return $rVal;
}


?>