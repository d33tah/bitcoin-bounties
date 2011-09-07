<?php
require_once(ROOT.'/classes/bountydb.php');
require_once(ROOT.'classes/recaptchalib.php');
$bdb=new BountyDB();
if($our_user = $udb->get_logged_in())
{
  if($commit_id=$_GET["id"])
  {
    if($commit=$bdb->get_submission($commit_id))
    {
	$our_uid=$our_user['id'];
	$bdb->voteup_commit($commit_id,$adb,$udb,$our_uid);
	$tpl->replace("MESSAGE",__(MSG_VOTEUP_SUCCESS,$commit_id));
	$tpl->replace("REFRESH",$server_directory.'/commits/id='.$commit_id);
        $title=$domain.' - '.__(MSG_REDIRECTING);
    }
    else
    {
      $tpl->replace("MESSAGE",__(MSG_COMMIT_NOT_FOUND));
      $title=$domain.' - '.__(MSG_ERROR);
    }
  }
  else
  {
    $tpl->replace("MESSAGE",__(MSG_NO_COMMIT_GIVEN));
    $title=$domain.' - '.__(MSG_ERROR);
  }
}
else
{
  $recaptcha=recaptcha_get_html($recaptcha_publickey,"");
  $url=$server_directory.'/newbounty';
  $tpl->replace("MESSAGE",__(MSG_NEED_LOGIN).login_form($recaptcha,$url));
  $title=$domain.' - '.__(MSG_LOGIN_NEEDED);
}

$tpl->replace("TITLE",$title);
$tpl->replace("SHORT_TITLE",$title);