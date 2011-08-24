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
    if($newid = $bdb->add_bounty($title,$desc,$our_uid))
    {
      $bountylink=$LINK_PREFIX.'/viewbounty/id='.$newid;
      message(str_replace('%BOUNTYLINK%',$bountylink,$messages[MSG_BOUNTY_ADDED]));
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