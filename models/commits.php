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
  
  $tpl->replace("BOUNTY_DESC",$title);
  $tpl->replace("BOUNTY_ID",$id);
  $tpl->replace("DONATED",$collected);
  if($submissions)
  {
    foreach($submissions as $submission)
    {
      $user=$udb->get_by_id($submission["user_id"]);
      $percent=$bdb->getvotes_commit($submission['id'],$adb);
      $tpl->addentry("SUBMITENTRY", array("AUTHOR"=>$user['login'],
	"PERCENT"=>$percent."%", "COMMIT_ID"=>$submission['id']));
    }
  }

  $tpl->replace('TITLE',$domain.' - '.__(MSG_COMMITS_LIST_FOR,$title));
  $tpl->replace('SHORT_TITLE',$domain.' - '.__(MSG_COMMITS_LIST));
}
