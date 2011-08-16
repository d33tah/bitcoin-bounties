<?php
ob_start();
session_start();
define('ROOT',dirname($_SERVER['SCRIPT_FILENAME']).'/');
require_once("functions.php");
require_once("classes/templates.php");
require_once(ROOT.'classes/phpmailer/class.phpmailer.php');
require_once("../config.php");

function validate_view_name() { return validate_stub(); }

if(array_key_exists("view",$_GET))
{
	$view=$_GET["view"];
	validate_view_name($view);
}
else
{
	$view="listbounties";
}
//index controller
$header_html=<<<HEADER_HTML
<a href="%LINK_PREFIX%/login/">Login</a> <a href="%LINK_PREFIX%/signup/">Sign up</a>
HEADER_HTML;

$homelink='<a href="%LINK_PREFIX%/">Back to the homepage</a>';

$css=<<<CSS
<style>
	a { text-decoration:none; }
	table { border-collapse: collapse; }
	td { border: 1px solid; }
	.donate_address { text-align: center; }
</style>
CSS;

$body=@file_get_contents(viewfile($view)) or do_404();
$tpl=new Template($body);
$tpl->replace("ENCODING","");
$tpl->replace("HEADER",$header_html);
$tpl->replace("CSS",$css);
$tpl->replace("HOMELINK",$homelink);
$tpl->replace("DOMAIN",$domain			);
$tpl->replace("LINK_PREFIX",LINK_PREFIX);

require_once(ROOT.modelfile($view));

$tpl->print_body();
?>
