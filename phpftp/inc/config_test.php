<?php
// ***************************************
// ** FILE:    CONFIG_TEST.PHP          **
// ** PURPOSE: PHFTP                    **
// ** DATE:    12.02.2011               **
// ** AUTHOR:  ANDREAS MEHRRATH         **
// ***************************************

$myMsg  = "PHP FTP support missing! Required PHP FTP extension and FTP functions not available.\\n";
$myMsg .= _APP_NAME." will not work without these. Visit ";
$myMsg .= "http://www.php.net/manual/".$conf_phpftp_lang."/book.ftp.php";


// FTP PHP Extension is required

$arrExt = get_loaded_extensions();

if (
	((!in_array("ftp",$arrExt)) && (!in_array("FTP",$arrExt)) && (!in_array("Ftp",$arrExt))) ||
	(!function_exists('ftp_connect'))
)
$endmsg .= $myMsg;


?>