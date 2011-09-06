<?php
require_once(ROOT.'/classes/bountydb.php');
$bdb=new BountyDB();

if(isset($_SESSION['login']))
{
  if($_POST)
  {
    $our_user=$udb->get_by_login($_SESSION['login']);
    $our_uid=$our_user['id'];
    $title=$_POST["title"];
    $desc=$_POST["desc"];
    if($newid = $bdb->add_bounty($title,$desc,$our_uid,$adb))
    {
      $bountylink=$LINK_PREFIX.'/viewbounty/id='.$newid;
      message(sprintf($messages[MSG_BOUNTY_ADDED],$bountylink));
    }
    else
    {
      //errors
    }
  }
  else
  {
    //no POST
  }
}

$title=$domain.' - '.__(MSG_ADD_NEW_BOUNTY_TITLE);
$tpl->replace("TITLE",$title);
$tpl->replace("SHORT_TITLE",$title);
