<?php
//index controller
if($_SESSION['login'])

$header_html=<<<HEADER_HTML
Logged in as {$_SESSION['login']} <a href="%LINK_PREFIX%/login/mode=logout">[Log out]</a>
HEADER_HTML;
else
$header_html=<<<HEADER_HTML
<a href="%LINK_PREFIX%/login/">Login</a> <a href="%LINK_PREFIX%/signup/">Sign up</a>
HEADER_HTML;

$homelink='<a href="%LINK_PREFIX%/">Back to the homepage</a>';

$css='<link rel="stylesheet" href="'.$LINK_PREFIX.'/style.css" type="text/css">';
