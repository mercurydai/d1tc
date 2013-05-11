<?php
// ***************************************
// ** FILE:    PHFTP_TOOLS.PHP          **
// ** PURPOSE: PHFTP                    **
// ** DATE:    12.02.2011               **
// ** AUTHOR:  ANDREAS MEHRRATH         **
// ***************************************

// PHFTP SPECIFIC TOOLS

include_once("tools.php");


// ***************************************
function enc_pwd($myPwd,$mySalt=_ENC_SALT)
// ***************************************
{
    $arrTemp = array();

	for ($i=0;$i<strlen($myPwd);$i++) $arrTemp[] = substr($myPwd,$i,1);

    return "AES.".mt_rand(1000,9999).base64_encode(implode($mySalt,array_reverse($arrTemp)));
}



// ***************************************
function dec_pwd($myPwd,$mySalt=_ENC_SALT)
// ***************************************
{
    return implode("",array_reverse(explode($mySalt,base64_decode(substr($myPwd,8)))));
}




// *********************************************************
function draw_form($function,$formAdditionals="",$submit="")
// *********************************************************
{
	global $phpftp_user, $phpftp_passwd, $phpftp_host, $phpftp_port, $phpftp_ssl, $phpftp_passive;

	echo "\n<form id=\"frm_".$function."\" action=\""._SYSTEM."\" method=\"post\" ".$formAdditionals.">\n";
	echo "<input type=\"hidden\" name=\"function\"       value=\"".$function."\">\n";
	echo "<input type=\"hidden\" name=\"phpftp_user\"    value=\"".$phpftp_user."\">\n";
	echo "<input type=\"hidden\" name=\"phpftp_passwd\"  value=\"".$phpftp_passwd."\">\n";
	echo "<input type=\"hidden\" name=\"phpftp_host\"    value=\"".$phpftp_host."\">\n";
	echo "<input type=\"hidden\" name=\"phpftp_port\"    value=\"".$phpftp_port."\">\n";

	if ($phpftp_ssl) 	echo "<input type=\"hidden\" name=\"phpftp_ssl\"     value=\"1\">\n";
	else 				echo "<input type=\"hidden\" name=\"phpftp_ssl\"     value=\"0\">\n";

	if ($phpftp_passive)echo "<input type=\"hidden\" name=\"phpftp_passive\"     value=\"1\">\n";
	else 				echo "<input type=\"hidden\" name=\"phpftp_passive\"     value=\"0\">\n";

	if ($submit!="")
	echo "<input type=\"submit\" value=\"".$submit."\" class=\"ibutton\">\n";
}



// ********************************************************************************************
function decode_ftp_filedate($fdate)
// ********************************************************************************************
{
 $fdate = trim(strtolower($fdate));

 $arrMonIn  =array('jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','dec');
 $arrMonOut =array('01.','02.','03.','04.','05.','06.','07.','08.','09.','10.','11.','12.');

 return str_replace(array(". ",".\t","\t.\t","\t."),".",str_replace($arrMonIn,$arrMonOut,$fdate));
}



// **************
function helpme()
// **************
{
    global $al;

    return "<a href=\"#\" onClick=\"popup_win('help','ftp.php?function=help',600,640);\">
    <img src=\"img/help.gif\" align=\"top\" width=\"19\" height=\"19\" border=\"0\"> ".$al['help']."</a>";
}

?>