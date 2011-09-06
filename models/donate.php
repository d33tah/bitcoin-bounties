<?php

require_once(ROOT.'/classes/bountydb.php');
$bdb=new BountyDB();
if($bounty = $bdb->get_by_id($_GET["id"]))
{
  if(isset($_SESSION['login']))
  {
    $message_type=MSG_DONATE_REGISTERED;
    $our_user=$udb->get_by_login($_SESSION['login']);
    $our_uid=$our_user['id'];
    $bounty_address=$bdb->get_address($bounty,$our_uid,$adb);
  }
  else
  {
    $message_type=MSG_DONATE_UNREGISTERED;
    $bounty_address=$bounty['address'];
  }
}

$tpl->replace("MESSAGE",__($message_type,$bounty_address,$bounty['id']));
$tpl->replace("TITLE",$domain.' - '.__(MSG_DONATE_BOUNTY_X,$bounty['title']));
$tpl->replace("SHORT_TITLE",$domain.' - '.__(MSG_DONATE_BOUNTY));
