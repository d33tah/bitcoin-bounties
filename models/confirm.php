<?php
if ($udb->try_confirm($_GET["hash"]))
{
  $message = $messages[MSG_ACCOUNT_CONFIRMED];
}
else
{
  $message = $messages[MSG_CONFIRATION_LINK_INVALID];
}

$tpl->replace("MESSAGE",$message);
