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
        $bounty = $bdb->get_by_id($commit["bounty_id"]);
	$our_uid=$our_user['id'];
	$bdb->voteup_commit($commit_id,$adb,$udb,$our_uid);
	$tpl->MESSAGE=__(MSG_VOTEUP_SUCCESS,$commit_id);
	$tpl->REFRESH=$server_directory.'/commits/id='.$commit_id;
        $title=$domain.' - '.__(MSG_REDIRECTING);
    
	$tpl->addentry("BREADCRUMBS",array(
	  "URL"=>$LINK_PREFIX."/viewbounty/id={$bounty['id']}",
	  "NAME"=>$bounty['title']));
    
	$tpl->addentry("BREADCRUMBS",array(
	  "URL"=>$LINK_PREFIX."/commits/id={$bounty['id']}",
	  "NAME"=>__(MSG_COMMITS_LIST_CAPITAL)));

    }
    else
    {
      $tpl->MESSAGE=__(MSG_COMMIT_NOT_FOUND);
      $title=$domain.' - '.__(MSG_ERROR);
    }
  }
  else
  {
    $tpl->MESSAGE=__(MSG_NO_COMMIT_GIVEN);
    $title=$domain.' - '.__(MSG_ERROR);
  }
}
else
{
  $recaptcha=recaptcha_get_html($recaptcha_publickey,"");
  $url=$server_directory.'/newbounty';
  $tpl->MESSAGE=__(MSG_NEED_LOGIN).login_form($recaptcha,$url);
  $title=$domain.' - '.__(MSG_LOGIN_NEEDED);
}

$tpl->TITLE=$title;
$tpl->SHORT_TITLE=$title;