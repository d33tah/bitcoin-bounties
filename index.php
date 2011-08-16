<?php
/*

basically: preparation stuff.

It's supposed to check for the view to load and load it.

*/

ob_start();
session_start();
define('ROOT',dirname($_SERVER['SCRIPT_FILENAME']).'/');
require_once("functions.php");
require_once("classes/templates.php");
require_once(ROOT.'classes/phpmailer/class.phpmailer.php');
require_once("../config.php"); //put it here so I don't push it accidentally

function validate_view_name() { return validate_stub(); }

if(array_key_exists("view",$_GET))
{
	$view=$_GET["view"];
	validate_view_name($view);
}
else
	$view="listbounties";

require_once(ROOT.'/classes/userdb.php');
$udb = new UserDB();

$udb->try_from_cookie();
require_once(ROOT.viewfile("header"));

$body=@file_get_contents(viewfile($view)) or do_404();
$tpl=new Template($body);

$tpl->replace("ENCODING","");
$tpl->replace("HEADER",$header_html);
$tpl->replace("CSS",$css);
$tpl->replace("HOMELINK",$homelink);
$tpl->replace("DOMAIN",$domain			);
$tpl->replace("LINK_PREFIX",$LINK_PREFIX);

require_once(ROOT.modelfile($view));

$tpl->print_body();
?>
