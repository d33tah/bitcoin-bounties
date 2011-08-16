<?php
$message = $_SESSION['message'];
if($message)
{
$_SESSION['message'] = '';
$tpl->replace("MESSAGE",$message);
}
else
do_404();