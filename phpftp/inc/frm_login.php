<?php
// ***************************************
// ** FILE:    FRM_LOGIN.PHP            **
// ** PURPOSE: PHFTP                    **
// ** DATE:    12.02.2011               **
// ** AUTHOR:  ANDREAS MEHRRATH         **
// ***************************************

// LOGIN FORM

?>

<h2><img src="img/logo.gif" style="margin-top: -5px;" align="middle" width="31" height="31" border="0"> <?php echo _APP_NAME. " - ".$al['login']; ?></h2>
<p>
<form action="ftp.php" method=post name="frm_login">
<p><table cellspacing="5" cellpadding="5" border="0">

<?php if ($enable_host_selection)
{ ?>
<tr><td>
<?php echo $al['host']; ?>
</td><td>
<input type="text" name="phpftp_host" value='<?php echo $phpftp_host; ?>'>

&nbsp;<?php echo $al['port']; ?>&nbsp;
<input type="text" size=3 maxlength=5 name="phpftp_port" value='<?php echo $phpftp_port; ?>'>

&nbsp;<?php echo $al['ssl']; ?>&nbsp;
<input type="checkbox" name="phpftp_ssl" <?php if ($phpftp_ssl) echo "checked"; ?>>

&nbsp; <?php echo helpme(); ?>
</td></tr>

<?php } ?>


<tr><td align=right colspan=2>
&nbsp;<input type="checkbox" name="phpftp_anon" onClick="anon(this);">&nbsp;<?php echo $al['anonymous']; ?>
&nbsp;<input type="checkbox" name="phpftp_passive" <?php if ($phpftp_passive) echo "checked"; ?>>&nbsp;<?php echo $al['passive']; ?>
</td></tr>



<tr><td>
<?php echo $al['login']; ?>
</td><td>
<input name="phpftp_user" type="text" size="25">
</td></tr>

<tr><td>
<?php echo $al['password']; ?>
</td><td>
<input name="phpftp_passwd" type="password" size="25">
</td></tr>

<tr><td>
<?php echo $al['directory']; ?>
</td><td>
<input name="phpftp_dir" type="text" value="<?php echo $phpftp_dir; ?>" size="40">
</td></tr>

</table>
</p><p>
<input type="hidden" name="action"   value="login">
<input type="hidden" name="function" value="dir">
<input type="submit" class="ibutton" value="<?php echo $al['connect']; ?>">
</p>
</form>
<p>

<?php

js_command("document.forms.frm_login.phpftp_user.focus();");


?>

