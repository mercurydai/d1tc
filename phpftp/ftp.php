<?php
/* **************************************************************************

 Don't edit this file! Customizable configuration is located in config/config.php

 Copyright (c) by Andreas Mehrrath (http://www.mindcatch.com)

 ************************************************************************** */

require_once("config/config.php");

require_once("inc/globals.php");

require_once("inc/phftp_tools.php");

require_once("inc/ftp_tools.php");

if (((isset($function))&&($function!="help"))||(!isset($function)))       // MAIN FORM DRAW FUNCTION
require_once("inc/frm_interface.php");


// FILE TO BROWSER
if ($function != "get") include_once("inc/header.php");

// AFTER LOGIN
if ((isset($action))&&($action=="login")) $phpftp_passwd = enc_pwd($phpftp_passwd);


// CURRENT FUNCTION
switch($function)
{
	case "dir":
		phpftp_list($phpftp_user,$phpftp_passwd,$phpftp_dir);
		$site_msg = $al['refreshed'];
		break;

	case "cd":
		phpftp_cd($phpftp_user,$phpftp_passwd,$phpftp_dir,$select_directory);
		$site_msg = $al['dirchanged'];
		break;

	case "get":
		phpftp_get($phpftp_user,$phpftp_passwd,$phpftp_dir,$select_file); 
		// DOWNLOAD IS SILENT - NO RELOAD
		break;

	case "put":
		if (phpftp_put($phpftp_user,$phpftp_passwd,$phpftp_dir,$userfile))
			 $site_msg = $al['fileputted'];
		else $site_msg = $al['fileputtedfail'];
		break;

	case "mkdir":
		if (phpftp_mkdir($phpftp_user,$phpftp_passwd,$phpftp_dir,$new_dir))
			 $site_msg = $al['dircreated'];
		else $site_msg = $al['dircreatedfail'];
		break;

	case "drop":
	    if (phpftp_drop($phpftp_user,$phpftp_passwd,$phpftp_dir,$select_file))
	    	 $site_msg = $al['filedropped'];
	    else $site_msg = $al['filedroppedfail'];
	    break;

	case "dropdir":
	    if (phpftp_dropdir($phpftp_user,$phpftp_passwd,$phpftp_dir,$select_directory))
	    	 $site_msg = $al['dirdropped'];
	    else $site_msg = $al['dirdroppedfail'];
	    break;

	case "chmod":
	    if (phpftp_chmod($phpftp_user,$phpftp_passwd,$phpftp_dir,$select_file,$chmode))
	    	 $site_msg = sts($al['chmodsuccess'],array($chmode,$select_file));
	    else $site_msg = $al['chmodfail'];
	    break;

	case "help":
	    include_once("inc/frm_help.php");
	    break;

	default:
		include_once("inc/frm_login.php");
		include_once("inc/config_test.php");
		break;
}

if (!is_dir($phpftp_tmpdir)) show_error(sts($al['error6'],$phpftp_tmpdir)."\n<br><br>\n");

if ($function != "get") include_once("inc/footer.php");

?>