<?php
// ***************************************
// ** FILE:    HEADER.PHP               **
// ** PURPOSE: PHFTP                    **
// ** DATE:    12.02.2011               **
// ** AUTHOR:  ANDREAS MEHRRATH         **
// ***************************************

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<title><?php echo _APP_SHORT; ?></title>

<META HTTP-EQUIV="Content-Type" content="text/html; charset=utf-8">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
<META HTTP-EQUIV="PRAGMA"  CONTENT="NO-CACHE">
<META NAME="AUTHOR"        CONTENT="<?php echo _APP_AUTHOR; ?>">
<META NAME="GENERATOR"     CONTENT="vi">

<LINK REL="STYLESHEET" HREF="css/<?php if (isset($conf_css)) echo $conf_css; else echo "default.css"; ?>" TYPE="text/css">

<SCRIPT LANGUAGE="JavaScript" src="js/tools.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" src="js/ftp_tools.js"></SCRIPT>

<STYLE type="text/css">

.clipper {
   overflow:hidden;
   float:left;
}

.clipper select {
   font-size:1em;
   border:none;
}
</STYLE>
<!--[if IE]>
<style type="text/css">
.clipper select {
   margin:-2px;
   width: 259px;
}
</style>
<![endif]-->
</HEAD>
<BODY TOPMARGIN='1' LEFTMARGIN='1' BGCOLOR='WHITE' TEXT='BLACK'>

<?php

if ((isset($phpftp_centered))&&($phpftp_centered))
echo "<table border=\"1\" style=\"background-color: transparent ! important; border: none ! important;\" cellpadding=\"0\" cellspacing=\"0\" width=\"99%\" height=\"90%\"><tr><td valign=\"middle\" align=\"center\" style=\"border: none ! important;\">\n";

?>
