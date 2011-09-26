<?php
/*

basically: preparation stuff.

It's supposed to check for the view to load and load it.

*/

ob_start();


session_start();
define('ROOT',dirname($_SERVER['SCRIPT_FILENAME']).'/');
require_once("config.php"); //put it here so I don't push it accidentally
require_once("functions.php");
  execution_timer();
require_once(ROOT."constants.php");
require_once(ROOT."languages/english.php");
require_once(ROOT.'classes/phpmailer/class.phpmailer.php');
require_once("classes/templates.php");
require_once(ROOT.'/classes/accountdb.php');
require_once(ROOT.'/classes/userdb.php');

mail_setup();

function validate_view_name() { return validate_stub(); }

if(array_key_exists("view",$_GET))
{
	$view=$_GET["view"];
	validate_view_name($view);
}
else
	$view="listbounties";

$udb = new UserDB();
$adb=new AccountDB($bitcoin_login,$bitcoin_password,
  $bitcoin_host,$bitcoin_port,$bitcoin_path);

if(file_exists(viewfile($view)))
  $tpl=new Template(viewfile($view));
else
  do_404();

$udb->try_from_cookie();
$tpl->BLOCKCOUNT=$adb->conn->getblocknumber();
if($our_user = $udb->get_logged_in())
  $tpl->USERNAME=$our_user['login'];
else
  $tpl->USERNAME=false;
$tpl->VIEWNAME=$view;


//TODO: catch an exception and do_404();

$tpl->DOMAIN=$domain			;
$tpl->LINK_PREFIX=$LINK_PREFIX;

require_once(ROOT.modelfile($view));

print $tpl->print_body();
?>
