<?php
require_once(ROOT.'/classes/bountydb.php');
$bdb=new BountyDB();

if(isset($_SESSION['login']))
{
  $our_user=$udb->get_by_login($_SESSION['login']);
  $our_uid=$our_user['id'];
  $sql="SELECT * FROM `submissions` WHERE `user_id`='".$our_uid."'";
  $payout=0;
  $fees=0;
  
  $res=mysql_query($sql);
  
  if($res)
  {
    echo mysql_error();
    $paid_out = array();
    while($row=mysql_fetch_assoc($res))
    {
      if($bdb->getvotes_commit($row['id'],$adb)>30)
      {
	$bounty=$bdb->get_by_id($row['bounty_id']);
	if($bounty['state']==0)
	{
	  $total=$adb->balance_prefix('bounty_'.$bounty['id']);
	  $fee=$total*0.01;
	  $payout+=$total-$fee;
	  $fees+=$fee;
          array_push($paid_out,$bounty);
	}
      }
    }
  }
  
  if($payout)
  {
    if(isset($_POST["address"]))
    {
      if(ctype_alnum($_POST["address"]) && strlen($_POST['address']<35))
      {
	$address=$_POST["address"];
	$fee_address='mghb6K62ZZok1Yq2qwRytWm1GobUETdvrp';
	$message="The bounty was paid out successfully!";
	$adb->sendtoaddress($address,$payout);
	$adb->sendtoaddress($fee_address,$fees);
	foreach($paid_out as $lock_me)
        {
          $bdb->set_locked($lock_me);
        }
      }
      else
      {
	$message='You typed in an invalid address!';
      }
    }
    else
    {
      $payout_neat=sprintf("%.8f BTC",$payout);
      $message="You earned $payout_neat. Just type in the address you want
      it to be transferred to:
      <form method=\"post\">
      <input name=\"address\" />
      <input type=\"submit\" />
      </form>";
    }
  }
  else
    $message="No bounty to be paid out.";

}
else
  $message="You have to log in.";
$tpl->replace("MESSAGE",$message);
