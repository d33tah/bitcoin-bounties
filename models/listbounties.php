<?php
require_once(ROOT.'/classes/bountydb.php');
$bdb=new BountyDB();
if($bounties=$bdb->get_bounties())
{
  foreach($bounties as $bounty)
  {
    $id=htmlentities($bounty["id"]);
    $title=htmlentities($bounty["title"]);
    $collected=htmlentities($bounty["bitcoins"].'.'.sprintf('%08d',$bounty["satoshi"]).' BTC');
    $tpl->addentry("BOUNTYENTRY",
      array("DESC"=>
              '<a href="'.$LINK_PREFIX.'/viewbounty/id='.$id.'">'.$title.'</a>', 
            "COLLECTED"=>$collected));
  }
}
else
{
//TODO: say there's nothing to show.
}