<?php
/*
1. fetch from the database a list of bounties
2. for every bounty:
  3. send to the template its title
  4. send the amount collected
  5. send whether it's locked or not

require_once(ROOT.'/classes/bountydb.php');
$bdb=new BountyDB();
if($bounties=$bdb->get_bounties())
foreach($bounties as $bounty)
{
  $tpl->addentry("BOUNTIES",array(
    "ID"=>$bounty->get_id(),
    "TITLE"=>$bounty->get_title(),
    "COLLECTED"=>$adb->get_bounty_collected($bounty),
    "LOCKED"=>$bounty->get_locked()
    ));
}

$tpl->TITLE=$domain.' - '.__(MSG_BOUNTIES_LIST);
*/
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
    $tpl->addentry("BOUNTIES",
      array("DESC"=>
              '<a href="'.$LINK_PREFIX.'/viewbounty/id='.$id.'">'.$title.
	      '</a>', 
            "COLLECTED"=>$collected,
            "LOCKED"=>$bounty['state'] & 1 //TODO: magic number
            ));
  }
}

$tpl->TITLE=$domain.' - '.__(MSG_BOUNTIES_LIST);
