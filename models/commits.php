<?php
require_once(ROOT.'/classes/bountydb.php');
$bdb=new BountyDB();
if(isset($_GET["id"]))
{
  if($bounty = $bdb->get_by_id($_GET["id"]))
  {
    $id=htmlentities($bounty["id"]);
    $title=htmlentities($bounty["title"]);

    $tpl->addentry("BREADCRUMBS",array(
      "URL"=>$LINK_PREFIX."/viewbounty/id=$id",
      "NAME"=>$title));
    
    $description=htmlentities($bounty["description"]);
    $locked = $bounty['state'] & 1;
    $collected=htmlentities($bounty["bitcoins"].
      '.'.sprintf('%08d',$bounty["satoshi"]).' BTC');
    $submissions=($bdb->get_submissions($bounty));

    if($our_user)
      $voted = $bdb->get_commit_user_voted($id, $our_user['id']);
    else
      $voted = 0;
    
    $tpl->BOUNTY_DESC=$title;
    $tpl->BOUNTY_ID=$id;
    $tpl->DONATED=$collected;
    $tpl->LOCKED=$locked;
    if($submissions)
    {
      foreach($submissions as $submission)
      {
	$user=$udb->get_by_id($submission["user_id"]);
	$percent=$bdb->getvotes_commit($submission['id'],$adb);
	$tpl->addentry("SUBMITENTRY", array(
          "AUTHOR"=>$user['login'],
	  "PERCENT"=>$percent."%", 
          "COMMIT_ID"=>$submission['id'],
          "CAN_VOTE"=>!( $locked || $voted ),
          "CAN_UNDO"=>(!$locked && $voted == $submission['id'])
        ));
      }
    }
  
    $tpl->TITLE=$domain.' - '.__(MSG_COMMITS_LIST_FOR,$title);
    $tpl->SHORT_TITLE=$domain.' - '.__(MSG_COMMITS_LIST);
  }
  else
  {
    $tpl->TITLE=$short_title=$domain.' - '.__(MSG_ERROR);
    $tpl->FATAL_ERROR=__(MSG_BOUNTY_NOT_FOUND);
  }
}
else
{
  $tpl->FATAL_ERROR=__(MSG_NO_BOUNTY_GIVEN);
  $tpl->TITLE=$short_title=$domain.' - '.__(MSG_ERROR);
}