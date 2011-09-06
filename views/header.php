<?php
//index controller
$blockcount=$adb->conn->getblocknumber();
if(array_key_exists('login',$_SESSION))
{
  $header_html="Block no. $blockcount<br />".
    __(MSG_LOGGED_IN_AS,$_SESSION['login']).
    ' <a href="'.$LINK_PREFIX.'/login/mode=logout">['.
    __(MSG_LOGOUT_BUTTON).']</a>';
}
else
{
$header_html="Block no. $blockcount<br />".
  '<a href="'.$LINK_PREFIX.'/login/">'.__(MSG_LOGIN_BUTTON).'</a> '.
  '<a href="'.$LINK_PREFIX.'/signup/">'.__(MSG_SIGN_UP_BUTTON).'</a>';
}
$homelink='<a href="'.$LINK_PREFIX.'/">'.__(MSG_BACK_TO_HOMEPAGE).'</a>';

$css='<link rel="stylesheet" href="'.$LINK_PREFIX.'/style.css" 
type="text/css">';
