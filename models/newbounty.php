<?php
require_once(ROOT.'/classes/bountydb.php');
require_once(ROOT.'classes/recaptchalib.php');
$bdb=new BountyDB();

if($our_user = $udb->get_logged_in())
{
  if($_POST)
  {
    $title=$domain.' - '.__(MSG_ADD_NEW_BOUNTY_TITLE);
    $our_uid=$our_user['id'];
    $title=$_POST["title"];
    $desc=$_POST["desc"];
    if($newid = $bdb->add_bounty($title,$desc,$our_uid,$adb))
    {
      $tpl->ERROR_MESSAGE='';
      $bountylink='/viewbounty/id='.$newid;
      message(__(MSG_BOUNTY_ADDED,$LINK_PREFIX.$bountylink),
        $server_directory.$bountylink);
    }
    else
    {
      $title=$domain.' - '.__(MSG_ERROR);

      $errors = array();

      $bdb->title_too_short && array_push($errors,
        __(MSG_TITLE_TOO_SHORT,$title_min_length,$title_max_length));

      $bdb->title_too_long && array_push($errors,
        __(MSG_TITLE_TOO_LONG,$title_min_length,$title_max_length));

      $bdb->title_regex && array_push($errors,
        __(MSG_TITLE_REGEX));

      $bdb->title_exists && array_push($errors,
        __(MSG_BOUNTY_TITLE_EXISTS));

      $bdb->desc_too_short && array_push($errors,
        __(MSG_DESCRIPTION_TOO_SHORT,$desc_min_length,$desc_max_length));

      $bdb->desc_too_long && array_push($errors,
        __(MSG_DESCRIPTION_TOO_LONG,$desc_min_length,$desc_max_length));

      $bdb->desc_regex && array_push($errors,
        __(MSG_DESCRIPTION_REGEX));


      $error_html='';
      if(count($errors)==1)
      {
	$error_html=array_pop($errors);
      }
      else
      {
	$error_html=__(MSG_BOUNTY_ADDING_FAILED_LIST).'<ul>';
	foreach($errors as $reason)
	{
	  $error_html.='<li>'.$reason.'</li>';
	}
	$error_html.="</ul>";
      }
      $tpl->ERROR_MESSAGE='<p>'.$error_html.'</p>';
    }
  }
  else
  {
    $tpl->ERROR_MESSAGE='';
    $title=$domain.' - '.__(MSG_ADD_NEW_BOUNTY_TITLE);
  }
}
else
{
  $title=$domain.' - '.__(MSG_LOGIN_NEEDED);
  $recaptcha=recaptcha_get_html($recaptcha_publickey,"");
  $url='/newbounty/';
  $tpl->FATAL_ERROR=__(MSG_NEED_LOGIN).login_form($recaptcha,$url);
}

$tpl->TITLE=$title;
$tpl->SHORT_TITLE=$title;
