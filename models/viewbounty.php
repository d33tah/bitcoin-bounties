<?php
require_once(ROOT.'/classes/bountydb.php');
$bdb=new BountyDB();
if($bounty = $bdb->get_by_id($_GET["id"]))
{
  $id=htmlentities($bounty["id"]);
  $title=htmlentities($bounty["title"]);
  $description=htmlentities($bounty["description"]);
  $collected=htmlentities($bounty["bitcoins"].'.'.
    sprintf('%08d',$bounty["satoshi"]).' BTC');
  $submissions=count($bdb->get_submissions($bounty));

$tpl->replace("BOUNTYDESC",$title);
$tpl->replace("BOUNTYID",$id);
$tpl->replace("DONATED",$collected);
$tpl->replace("SUBMISSIONS",$submissions);
$tpl->replace("DESCRIPTION",$description);
}