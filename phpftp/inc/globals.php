<?php
// ***************************************
// ** FILE:    GLOBALS.PHP              **
// ** PURPOSE: PHFTP                    **
// ** DATE:    18.03.2011               **
// ** AUTHOR:  ANDREAS MEHRRATH         **
// ***************************************

// *** TEST/DEBUG OR PRODUCTION MODE ***

// ini_set('display_errors', 		1);
// ini_set('error_reporting', 		E_ALL);

ini_set('display_errors', 			0);
ini_set('error_reporting', 			E_ALL & ~E_NOTICE);


if (!isset($function))	$function = "";


if (!get_cfg_var("register_globals"))
{
 extract($_REQUEST);
 if ($function=="put") extract($_FILES);
}



// SYSTEM LANGUAGE

if ((!isset($conf_phpftp_lang))||(strlen($conf_phpftp_lang)!=2)||
    (!file_exists("lang/".$conf_phpftp_lang.".php")))
$conf_phpftp_lang="en";

include("lang/".$conf_phpftp_lang.".php");       // SETS THE $al LANGUAGE ARRAY



// IMPORTANT TERMS

define("_SYSTEM",		"ftp.php");

define("_APP_NAME",     "PHFTP");

define("_APP_VEND",     "mindCatch(tm) Software Solutions");

define("_APP_VEND_URL", "http://www.mindcatch.com");

define("_APP_VERSION",  "4.2");

define("_APP_AUTHOR",   "Andreas Mehrrath - &copy; ".date("Y")." "._APP_VEND);

define("_APP_SHORT",    _APP_NAME." "._APP_VERSION);

define("_APP_LONG",     "Free "._APP_NAME." "._APP_VERSION." by "._APP_AUTHOR);

define("_ERR",          "<b>".$al['error']."</b>");

define("_ERR_RETRY",    "<br>\n<a href=\"ftp.php\">".$al['retry']."</a><br>\n");



// CUSTOM ENCRYPTION SALT

if (!isset($conf_enc_salt)) $conf_enc_salt = "Gd71ec9472ALi171ecL61eC3872L";

define("_ENC_SALT",$conf_enc_salt);



// FINAL CONFIGURE ERROR TOLERANTS

if (!isset($phpftp_host))           $phpftp_host = $conf_phpftp_host;
if ($phpftp_host=="")				$phpftp_host = "localhost";

if (!isset($phpftp_port))           $phpftp_port = $conf_phpftp_port;
if ($phpftp_port=="")				$phpftp_port = "21";


if (!isset($phpftp_ssl))            $phpftp_ssl  = (bool) $conf_phpftp_ssl;
else                                $phpftp_ssl  = (bool) $phpftp_ssl;

if (!isset($phpftp_passive))        $phpftp_passive  = (bool) $conf_phpftp_passive;
else                                $phpftp_passive  = (bool) $phpftp_passive;

if (!isset($phpftp_dir))			$phpftp_dir = "";


if ((!isset($conf_centered)) || (!is_bool($conf_centered)) || ($function=="help"))
	$phpftp_centered = true;
else  
	$phpftp_centered = (bool) $conf_centered;


// LIST WIDTHS

if (!isset($conf_fileman_width)) $conf_fileman_width = "380,500";

$conf_fileman_width = explode(",",$conf_fileman_width);

$conf_fileman_folders_width = $conf_fileman_width[0];
$conf_fileman_files_width   = $conf_fileman_width[1];

unset($conf_fileman_width);



// VARIOUS

if (!isset($max_file_size))				$max_file_size = $conf_max_file_size;
if (!is_numeric($max_file_size))		$max_file_size = 15360000;

if (!isset($enable_host_selection)) 	$enable_host_selection = $conf_enable_host_selection;
if (!is_bool($enable_host_selection))	$enable_host_selection = false;

if (!isset($phpftp_tmpdir))         	
{ 
	$phpftp_tmpdir = $conf_phpftp_tmpdir;
	
	// ALTERNATIVE SUCHE NACH GUELTIGEM TEMP DIR (sys_get_temp_dir())
	if (!is_dir($phpftp_tmpdir))	$phpftp_tmpdir = getenv('TMPDIR');
	if (!is_dir($phpftp_tmpdir))	$phpftp_tmpdir = getenv('TMP');
	if (!is_dir($phpftp_tmpdir))	$phpftp_tmpdir = "/tmp";
	if (!is_dir($phpftp_tmpdir))	$phpftp_tmpdir = "/var/tmp";
}

if ((!isset($listlength)) && (is_numeric($conf_listlength)))	$listlength = $conf_listlength;
else                                                            $listlength = 25;


if ((isset($conf_allowed_chmods))&&(is_array($conf_allowed_chmods))) $phpftp_chmods = $conf_allowed_chmods;
else 															     $phpftp_chmods = false;


if (!isset($endmsg))	$endmsg = "";
if (!isset($site_msg))	$site_msg = "";

?>