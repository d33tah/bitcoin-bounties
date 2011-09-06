<?php
require_once(ROOT.'/classes/bountydb.php');
$bdb=new BountyDB();
if($commit_id=$_GET["id"])
{
  $tpl->replace("COMMITID",$commit_id);

  $tpl->replace("MESSAGE",sprintf($messages[MSG_VOTEUP_SUCCESS],$commit_id));
  $our_user=$udb->get_by_login($_SESSION['login']);
  $our_uid=$our_user['id'];
  $bdb->voteup_commit($commit_id,$adb,$udb,$our_uid);
  //TODO header("Refresh")
}

$title=$domain.' - '.__(MSG_REDIRECTING);
$tpl->replace("TITLE",$title);
$tpl->replace("SHORT_TITLE",$title);
