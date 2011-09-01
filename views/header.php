<?php
//index controller
$blockcount=$adb->conn->getblocknumber();
if(array_key_exists('login',$_SESSION))



$header_html=<<<HEADER_HTML
Block no. $blockcount<br />
Logged in as {$_SESSION['login']} 
<a href="%LINK_PREFIX%/login/mode=logout">[Log out]</a>
HEADER_HTML;
else
$header_html=<<<HEADER_HTML
Block no. $blockcount<br />
<a href="%LINK_PREFIX%/login/">Login</a> 
<a href="%LINK_PREFIX%/signup/">Sign up</a>
HEADER_HTML;

$homelink='<a href="%LINK_PREFIX%/">Back to the homepage</a>';

$css='<link rel="stylesheet" href="'.$LINK_PREFIX.'/style.css" 
type="text/css">';
