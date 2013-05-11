<?php
// ***************************************
// ** FILE:    FRM_HELP.PHP             **
// ** PURPOSE: PHFTP                    **
// ** DATE:    12.02.2011               **
// ** AUTHOR:  ANDREAS MEHRRATH         **
// ***************************************

// HELP PAGE

echo "<h2><img src=\"img/help.gif\" align=\"top\" width=\"19\" height=\"19\" border=\"0\"> "._APP_NAME." Help</h2><pre>".
sts($al['help_text'],array(_APP_NAME,_APP_NAME,_APP_NAME,strtolower(_APP_NAME),strtolower(_APP_NAME),_APP_NAME,_APP_VEND_URL,str_replace("http://","",_APP_VEND_URL)))."</pre>\n<br>
<center><input type=\"button\" value=\"close me\" style=\"width:140px;\" onClick=\"window.close();\"><br><hr></center>\n";


?>