<?php
// ***************************************
// ** FILE:    FOOTER.PHP               **
// ** PURPOSE: PHFTP                    **
// ** DATE:    18.03.2011               **
// ** AUTHOR:  ANDREAS MEHRRATH         **
// ***************************************

?>

<p style="font: 10px verdana; margin-top:4px;">
<a href="<?php echo _APP_VEND_URL; ?>"><?php echo _APP_LONG; ?></a>
</p>

<?php

// CLOSE CENTER TABLE
if ((isset($phpftp_centered))&&($phpftp_centered))
echo "</td></tr></table>\n";


// SITE MSG
if ( (strlen($site_msg)>2) && (!((isset($action))&&($action=="login"))))
js_command("if (isAvailable(document.getElementById('site_msg'))) { document.getElementById('site_msg').value='".$site_msg."'; }");


// POPUP ALERT
if (strlen($GLOBALS["endmsg"])>2) js_alert($GLOBALS["endmsg"]);


?>
</BODY>
</HTML>
