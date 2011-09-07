<?php
require_once(ROOT.'/classes/bountydb.php');
$bdb=new BountyDB();
if(isset())
{
  if($bounty = $bdb->get_by_id($_GET["id"]))
  {
    $id=htmlentities($bounty["id"]);
    $bounty_title=htmlentities($bounty["title"]);
    $description=htmlentities($bounty["description"]);
    $collected=sprintf("%.8f BTC", $adb->balance_prefix('bounty_'.$id));
    $submissions=count($bdb->get_submissions($bounty));
  
    $tpl->replace("BOUNTY_DESC",$bounty_title);
    $tpl->replace("BOUNTY_ID",$id);
    $tpl->replace("DONATED",$collected);
    $tpl->replace("SUBMISSIONS",$submissions);
    $tpl->replace("DESCRIPTION",$description);
    $title=$domain.' - '.__(MSG_VIEWING_X,$title);
    $short_title=$domain.' - '.__(MSG_VIEW_BOUNTY);
  }
  else
  {
    $title=$short_title=__(MSG_ERROR);
    $tpl->replace("FATAL_ERROR",MSG_BOUNTY_NOT_FOUND);
  }
}
else
{
  $title=$short_title=__(MSG_ERROR);
  $tpl->replace("FATAL_ERROR",MSG_NO_BOUNTY_GIVEN);
}

$tpl->replace("TITLE",$title);
$tpl->replace("SHORT_TITLE",$short_title);
