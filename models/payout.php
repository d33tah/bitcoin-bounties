<?php
require_once(ROOT.'/classes/bountydb.php');
require_once(ROOT.'classes/recaptchalib.php');

$bdb=new BountyDB();

if($our_user = $udb->get_logged_in())
{
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
	  $fee=$total*$fee_multiplier;
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
	$message=__(MSG_BOUNTY_PAYOUT_SUCCESS);
	$adb->sendtoaddress($address,$payout);
	$adb->sendtoaddress($fee_address,$fees);
	foreach($paid_out as $lock_me)
        {
          $bdb->set_locked($lock_me);
        }
      }
      else
      {
	$message=__(MSG_INVALID_ADDRESS_GIVEN);
      }
    }
    else
    {
      $payout_neat=sprintf("%.8f BTC",$payout);
      $message=__(MSG_ENTER_PAYOUT_ADDRESS,$payout_neat)."
      <form method=\"post\">
      <input name=\"address\" />
      <input type=\"submit\" />
      </form>";
    }
  }
  else
    $message=__(MSG_NO_PAYOUT);

}
else
{
  $recaptcha=recaptcha_get_html($recaptcha_publickey,"");
  $url=$server_directory.'/payout/';
  $message=__(MSG_NEED_LOGIN).login_form($recaptcha,$url);
}

$title=$domain.' - '.__(MSG_BOUNTY_PAYOUT);
$tpl->TITLE=$title;
$tpl->SHORT_TITLE=$title;
$tpl->MESSAGE=$message;
