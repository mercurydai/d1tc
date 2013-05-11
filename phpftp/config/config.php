<?php

/* CUSTOMIZE PHFTP WITH THE PARAMETERS BELOW.
   DON'T CHANGE OTHER FILES THAN THIS. 
   SAVE A COPY OF IT! 
*/


/* DEFAULT FTP HOST */
$conf_phpftp_host = "localhost";


/* DEFAULT FTP PORT */
$conf_phpftp_port = "21";


/* USE FTP OVER SSL AT DEFAULT?
   DEFAULT: false */
$conf_phpftp_ssl = false;


/* YOUR OWN ENCRYPTION SALT
   ADDITIONALLY SECURES YOUR PASSWORD ENCRYPTION STRING */
$conf_enc_salt = "Gd71ec9472ALi171ecL61eC3872L";


/* PASSIVE FTP AT DEFAULT?
   DEFAULT: true */
$conf_phpftp_passive = true;


/* IMPORTANT!
   The temporary directory for file operations. Needs to be writable
   for your web server process user (e.g. apache, httpd, daemon,...)
   Example preparation:   mkdir /var/tmp/ftpfiles && chmod 1777 /var/tmp/ftpfiles
                          [SITE] CHMOD 1777 /data/tmp/ftpfiles
*/
$conf_phpftp_tmpdir="/tmp";


/* MAXIMUM SIZE IN BYTES(!) OF FILES YOU WANT TO ACCEPT. YOU MAY ALSO NEED
   TO EDIT YOUR PHP.INI FILE AND CHANGE UPLOAD_MAX_FILESIZE ETC. APPROPRIATELY
   DEFAULT: 15360000 (BYTES, =15MB) */
$conf_max_file_size="15360000";


/* GENERAL TIMEOUT TO FTP SERVER CONNECT ATTEMPTS IN SECONDS
   DEFAULT: 30 */
$conf_timeout=30;


/* ALLOWED RIGHTS FOR CHMOD OPERATION
   DEFAULT:            array("600","650","655","700","750","755","770","777");

   TO DISABLE CHMOD SUPPORT SIMPLY COMMENT IT OUT. */

$conf_allowed_chmods = array("600","650","655","700","750","755","770","777");


/* LANGUAGES SUPPORTED: EN,DE, ... (CHECK YOUR ./lang/ DIRECTORY FOR SUPPORTED LANGUAGES)
   DEFAULT: en                     (YOU ARE WELCOME TO CREATE AND SEND US NEW TRANSLATIONS) */
$conf_phpftp_lang = "en";


/* FILES WITH THE FOLLOWING EXTENSIONS WILL BE TRANSFERED IN ASCII MODE
   INSTEAD BINARY MODE (CONCERNS UP- AND DOWNLOADS). */
$conf_phpftp_ascii_files = array(
".am",".asp",".bat",".c",".cfm",".cgi",".conf",".cnf",
".cpp",".css",".dhtml",".diz",".forward",
".h",".hpp",".htaccess",".htm",".html",
".in",".inc",".ini",".js",".m4",".mak",".nfo",".nsi",
".pas",".patch",".php",".php3",".php4",".php5",".phtml",".pl",".po",
".procmailrc",
".py",".qmail",".sh",".shtml",".sql",".ssi",".tcl",".tpl",".txt",
".vbs",".wsdl",".xml",".xrc",".xslt"
);


/* APPEARANCE: STYLE TEMPLATE TO USE, CSS STYLESHEET FILENAME
 * DEFAULT: default.css (ALTERNATIVES: candy.css, your.css) */
$conf_css = "default.css";


/* GLOBALLY CENTER THE TOOLS INTERFACE IN THE PAGES
   DEFAULT: true */
$conf_centered = true;


/* WIDTH IN PIXEL OF BOTH FILEMANAGER SIDES (FOLDERS,FILES)
   DEFAULT: 380,500  (COMMA SEPARATED) */
$conf_fileman_width = "380,500";


/* ALLOW THE USER TO DEFINE THE FTP HOST, PORT AND SSL
   DEFAULT: true */
$conf_enable_host_selection = true;


/* FILE AND DIRECTORY VERTICAL LIST LENGTH
   (NUMBER OF FILES AND FOLDERS WITHOUT SCROLLING)
   DEFAULT: 25 */
$conf_listlength = 25;

?>