<?php
require_once(ROOT.'/classes/bountydb.php');
$bdb=new BountyDB();
if($bounty = $bdb->get_by_id($_GET["id"]))
{
  $id=htmlentities($bounty["id"]);
  $title=htmlentities($bounty["title"]);
  $description=htmlentities($bounty["description"]);
  $collected=sprintf("%.8f BTC", $adb->balance_prefix('bounty_'.$id));
  $submissions=count($bdb->get_submissions($bounty));

$tpl->replace("BOUNTY_DESC",$title);
$tpl->replace("BOUNTY_ID",$id);
$tpl->replace("DONATED",$collected);
$tpl->replace("SUBMISSIONS",$submissions);
$tpl->replace("DESCRIPTION",$description);
}

$tpl->replace("TITLE",$domain.' - '.__(MSG_VIEWING_X,$title));
$tpl->replace("SHORT_TITLE",$domain.' - '.__(MSG_VIEW_BOUNTY));
