<?php
if ($udb->try_confirm($_GET["hash"]))
{
  $message = $messages[MSG_ACCOUNT_CONFIRMED];
}
else
{
  $message = $messages[MSG_CONFIRATION_LINK_INVALID];
}

$tpl->MESSAGE=$message;
$title=$domain.' - account confirmation';
$tpl->TITLE=$title;
$tpl->SHORT_TITLE=$title;
