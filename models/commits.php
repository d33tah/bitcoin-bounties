<?php
require_once(ROOT.'/classes/bountydb.php');
$bdb=new BountyDB();
if($bounty = $bdb->get_by_id($_GET["id"]))
{
  $id=htmlentities($bounty["id"]);
  $title=htmlentities($bounty["title"]);
  $description=htmlentities($bounty["description"]);
  $collected=htmlentities($bounty["bitcoins"].
    '.'.sprintf('%08d',$bounty["satoshi"]).' BTC');
  $submissions=($bdb->get_submissions($bounty));
  
  $tpl->replace("BOUNTYDESC",$title);
  $tpl->replace("BOUNTYID",$id);
  $tpl->replace("DONATED",$collected);
  if($submissions)
  {
    foreach($submissions as $submission)
    {
      $user=$udb->get_by_id($submission["user_id"]);
      $tpl->addentry("SUBMITENTRY", array("AUTHOR"=>$user['login'],
	"PERCENT"=>'29%', "COMMIT_ID"=>$submission['id']));
    }
  }
}