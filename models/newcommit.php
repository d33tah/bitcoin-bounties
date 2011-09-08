<?php
//TODO: check if a file exists
require_once(ROOT.'/classes/bountydb.php');
require_once(ROOT.'classes/recaptchalib.php');

$bdb=new BountyDB();
if($our_user = $udb->get_logged_in())
{
  if(isset($_GET['id']))
  {
    if($bounty = $bdb->get_by_id($_GET["id"]))
    {
      if($_POST)
      {
	$tmpfile=$_FILES['uploaded']['tmp_name'];
	$filename=basename($_FILES['uploaded']['name']);
        $destination=ROOT."uploads/".$filename;
	if(is_uploaded_file($tmpfile))
	{
          if(filesize($tmpfile)>0)
          {
            if(!file_exists($destination))
            {
              if(validate_filename($filename))
              {
		if(move_uploaded_file($tmpfile,$destination))
		{
		  $our_uid=$our_user['id'];
		  $bounty_id=$_GET['id'];
		  $description=$_POST['comments'];
		  if($newid = $bdb->add_submission($bounty_id,$our_uid,
		    $description,$filename))
		  {
                    $title=$domain.' - '.__(MSG_ADD_COMMIT_TITLE);
		    $tpl->ERROR_MESSAGE='';
		    $commitlink='/viewcommit/id='.$newid;
		    message(__(MSG_COMMIT_ADDED,$LINK_PREFIX.$commitlink),
		    $server_directory.$commitlink);
		  }
		  else
		  {
		    $title=$domain.' - '.__(MSG_ERROR);

		    $errors = array();
	      
		    $bdb->desc_too_short && array_push($errors,
		      $messages[MSG_DESCRIPTION_TOO_SHORT]);
	      
		    $bdb->desc_too_long && array_push($errors,
		      $messages[MSG_DESCRIPTION_TOO_LONG]);
	      
		    $bdb->desc_regex && array_push($errors,
		      $messages[MSG_DESCRIPTION_REGEX]);
	      
	      
		    $error_html='';
		    if(count($errors)==1)
		    {
		      $error_html=array_pop($errors);
		    }
		    else
		    {
		      $error_html=$messages[MSG_BOUNTY_ADDING_FAILED_LIST].
                        '<ul>';
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
		  $tpl->ERROR_MESSAGE=__(MSG_FILE_UPLOAD_ERROR);
		  $title=$domain.' - '.__(MSG_ERROR);
                }
	      }
              else
	      {
		$tpl->ERROR_MESSAGE=__(MSG_ILLEGAL_FILENAME);
		$title=$domain.' - '.__(MSG_ERROR);
	      }
            }
	    else
	    {
	      $tpl->ERROR_MESSAGE=__(MSG_FILENAME_EXISTS);
	      $title=$domain.' - '.__(MSG_ERROR);
	    }
          }
	  else
	  {
	    $tpl->ERROR_MESSAGE=__(MSG_FILE_EMPTY);
	    $title=$domain.' - '.__(MSG_ERROR);
	  }
	}
	else
        {
	  $tpl->ERROR_MESSAGE=__(MSG_FILE_UPLOAD_ERROR);
	  $title=$domain.' - '.__(MSG_ERROR);
        }
      }
      else
      {
	$title=$domain.' - '.__(MSG_ADD_COMMIT_TITLE);
        $tpl->ERROR_MESSAGE='';
      }
    }
    else
    {
      $tpl->FATAL_ERROR=__(MSG_BOUNTY_NOT_FOUND);
      $title=$domain.' - '.__(MSG_ERROR);
    }
  }
  else
  {
    $tpl->FATAL_ERROR=__(MSG_NO_BOUNTY_GIVEN);
    $title=$domain.' - '.__(MSG_ERROR);
  }
}
else
{
  $title=$domain.' - '.__(MSG_LOGIN_NEEDED);
  $recaptcha=recaptcha_get_html($recaptcha_publickey,"");
  $url=$server_directory.'/newbounty';
  $tpl->FATAL_ERROR=__(MSG_NEED_LOGIN).login_form($recaptcha,$url);
}

$tpl->TITLE=$title;
$tpl->SHORT_TITLE=$title;
