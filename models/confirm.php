<?php

if(isset($_GET["hash"]))
{
  if ($udb->try_confirm($_GET["hash"]))
  {
    $message = __(MSG_ACCOUNT_CONFIRMED);
  }
  else
  {
    $message = __(MSG_CONFIRATION_LINK_INVALID);
  }
}
else
{
  $message = __(MSG_CONFIRATION_LINK_INVALID);
}


$tpl->MESSAGE=$message;
$title=$domain.' - account confirmation';
$tpl->TITLE=$title;
$tpl->SHORT_TITLE=$title;
