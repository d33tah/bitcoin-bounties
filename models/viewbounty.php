<?php
require_once(ROOT.'/classes/bountydb.php');
$bdb=new BountyDB();
if(isset($_GET["id"]))
{
  if($bounty = $bdb->get_by_id($_GET["id"]))
  {
    $id=htmlentities($bounty["id"]);
    $bounty_title=htmlentities($bounty["title"]);
    $description=htmlentities($bounty["description"]);
    $collected=sprintf("%.8f BTC", $adb->balance_prefix('bounty_'.$id));
    $solutions=count($bdb->get_solutions($bounty));
  
    $tpl->BOUNTY_DESC=$bounty_title;
    $tpl->BOUNTY_ID=$id;
    $tpl->DONATED=$collected;
    $tpl->SOLUTIONS=$solutions;
    $tpl->DESCRIPTION=$description;
    $tpl->LOCKED=$bounty['state'] & 1;
    $title=$domain.' - '.__(MSG_VIEWING_X,$bounty_title);
    $short_title=$domain.' - '.__(MSG_VIEW_BOUNTY);
  }
  else
  {
    $title=$short_title=__(MSG_ERROR);
    $tpl->FATAL_ERROR=MSG_BOUNTY_NOT_FOUND;
  }
}
else
{
  $title=$short_title=__(MSG_ERROR);
  $tpl->FATAL_ERROR=MSG_NO_BOUNTY_GIVEN;
}

$tpl->TITLE=$title;
$tpl->SHORT_TITLE=$short_title;
