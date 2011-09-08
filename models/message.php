<?php

$title=$domain.' - '.__(MSG_A_MESSAGE);
$tpl->TITLE=$title;
$tpl->SHORT_TITLE=$title;

$message = $_SESSION['message'];
if($message)
{
  $_SESSION['message'] = '';
  $tpl->MESSAGE=$message;

  if(isset($_GET['refresh']))
    $tpl->REFRESH=$_GET['refresh']; //TODO: some validation?
}
else
  do_404();
