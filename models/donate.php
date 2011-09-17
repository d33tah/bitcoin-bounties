<?php
require_once(ROOT.'classes/recaptchalib.php');
require_once(ROOT.'/classes/bountydb.php');
$bdb=new BountyDB();
if(isset($_GET["id"]))
{
  if($bounty = $bdb->get_by_id($_GET["id"]))
  {

    $tpl->addentry("BREADCRUMBS",array(
      "URL"=>$LINK_PREFIX."/viewbounty/id={$bounty['id']}",
      "NAME"=>$bounty['title']));
    $locked=$bounty['state'] & 1;

    if($locked)
    {
      $message_type=MSG_CANT_DONATE_LOCKED;
    }
    else
    if($our_user = $udb->get_logged_in())
    {
      $our_uid=$our_user['id'];
      $bounty_address=$bdb->get_address($bounty,$our_uid,$adb);
      $recaptcha_html='';
      $message=__(MSG_DONATE_REGISTERED,$bounty_address);
    }
    else
    {
      $bounty_address=$bounty['address'];
      $recaptcha_html=__(MSG_VERIFICATION_CAPTCHA).
	recaptcha_get_html($recaptcha_publickey,"");
      $message=__(MSG_DONATE_UNREGISTERED,$bounty_address,
        login_form($recaptcha_html,'/donate/'.$bounty['id']));
    }
  $title=$domain.' - '.__(MSG_DONATE_BOUNTY_X,
    $bounty['title']);
  $short_title=$domain.' - '.__(MSG_DONATE_BOUNTY);
  
  }
  else
  {
    $title=$short_title=$domain.' - '.__(MSG_ERROR);
    $message=__(MSG_BOUNTY_NOT_FOUND);
  }
}
else
{
  $title=$short_title=$domain.' - '.__(MSG_ERROR);
  $message=__(MSG_NO_BOUNTY_GIVEN);
}

$tpl->TITLE=$title;
$tpl->SHORT_TITLE=$short_title;
$tpl->MESSAGE=$message;
