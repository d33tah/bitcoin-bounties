<?php
require_once(ROOT.'/classes/bountydb.php');
require_once(ROOT.'classes/recaptchalib.php');
//TODO: check referrer to prevent abuse?
$bdb=new BountyDB();
if($our_user = $udb->get_logged_in())
{
  if($solution_id=$_GET["id"])
  {
    if($solution=$bdb->get_solution($solution_id))
    {
        $bounty = $bdb->get_by_id($solution["bounty_id"]);
        $bounty_locked = $bounty['state'] & 1;
	$our_uid=$our_user['id'];

	$tpl->addentry("BREADCRUMBS",array(
	  "URL"=>$LINK_PREFIX."/viewbounty/id={$bounty['id']}",
	  "NAME"=>$bounty['title']));
    
	$tpl->addentry("BREADCRUMBS",array(
	  "URL"=>$LINK_PREFIX."/solutions/id={$bounty['id']}",
	  "NAME"=>__(MSG_SOLUTIONS_LIST_CAPITAL)));

        //TODO: ugly!

        if(!$bounty_locked && 
          $bdb->voteup_solution($solution_id,$adb,$udb,$our_uid))
	{
	  $tpl->MESSAGE=__(MSG_VOTEUP_SUCCESS,$solution_id);
	  $tpl->REFRESH=$server_directory.'/solutions/id='.$solution_id;
	  $tpl->TITLE=$domain.' - '.__(MSG_REDIRECTING);
        }
        else
        {
	  if(isset($_GET['mode']) && !$bounty_locked &&
	      $bdb->get_solution_user_voted($bounty['id'],$our_user['id'])
	      == $solution_id
	      )
	  {
	    if($_GET['mode']=='undo')
	    {
	      $bdb->votedown_solution($solution_id,$our_uid);
	      $tpl->MESSAGE=__(MSG_VOTEDOWN_SUCCESS,$solution_id);
	      $tpl->REFRESH=$server_directory.'/solutions/id='.$solution_id;
	      $tpl->TITLE=$domain.' - '.__(MSG_REDIRECTING);
	    }
	  }
	  else
	  {
	  $tpl->TITLE=$domain.' - '.__(MSG_ERROR);
	  if($bounty_locked)
	    $tpl->MESSAGE=__(MSG_BOUNTY_WAS_LOCKED);
          else
	    $tpl->MESSAGE=__(MSG_ALREADY_VOTED);
	  }
        }
    }
    else
    {
      $tpl->MESSAGE=__(MSG_SOLUTION_NOT_FOUND);
      $tpl->TITLE=$domain.' - '.__(MSG_ERROR);
    }
  }
  else
  {
    $tpl->MESSAGE=__(MSG_NO_SOLUTION_GIVEN);
    $tpl->TITLE=$domain.' - '.__(MSG_ERROR);
  }
}
else
{
  $recaptcha=recaptcha_get_html($recaptcha_publickey,"");
  $url='/votesolution/id='.$_GET["id"];
  $tpl->MESSAGE=__(MSG_NEED_LOGIN).login_form($recaptcha,$url);
  $tpl->TITLE=$domain.' - '.__(MSG_LOGIN_NEEDED);
}
