<?php
require_once(ROOT.'/classes/bountydb.php');
$bdb=new BountyDB();
if($bounties=$bdb->get_bounties())
{
  foreach($bounties as $bounty)
  {
    $id=htmlentities($bounty["id"]);
    $title=htmlentities($bounty["title"]);
    //$bitcoins = $bounty["bitcoins"];
    //$satoshi = $bounty["satoshi"];
    //$collected=htmlentities($bitcoins.'.'.sprintf('%08d',$satoshi).' BTC');
    $collected=sprintf("%.8f BTC", $adb->balance_prefix('bounty_'.$id));
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