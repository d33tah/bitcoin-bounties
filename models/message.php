<?php

$title=$domain.' - '.__(MSG_A_MESSAGE);
$tpl->replace("TITLE",$title);
$tpl->replace("SHORT_TITLE",$title);

$message = $_SESSION['message'];
if($message)
{
  $_SESSION['message'] = '';
  $tpl->replace("MESSAGE",$message);

  if(isset($_GET['refresh']))
    $tpl->replace("REFRESH",$_GET['refresh']); //TODO: some validation?
}
else
  do_404();
