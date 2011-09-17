<?php
$errors=array();
$logged_in = $udb->get_logged_in();
if($_POST)
{
  if($logged_in)
  {
    $login = $logged_in["login"];

    if(isset($_POST["oldpass"]) && isset($_POST["pass1"]) 
      && isset($_POST["pass2"]))
      {
      $oldpass=$_POST["oldpass"];
      $oldpass_hash=hashdata($_POST["oldpass"],SALT);
      $pass1=$_POST["pass1"];
      $pass2=$_POST["pass2"];
      if ($udb->valid_login($login,$oldpass_hash))
      {
        if($pass1==$pass2)
        {
          if(!$udb->password_too_short($pass1))
          {
	    if(!$udb->password_too_long($pass1))
            {
              if($pass1!=$oldpass)
	      {
		$udb->change_password($login,$newpass);
		  $_SESSION['message']=$messages[MSG_PASSWORD_CHANGED];
		  redirect($LINK_PREFIX."/message/ ");
	      }
              else
              {
		array_push($errors,$messages[MSG_NO_REAL_PASSWORD_CHANGE]);
              }
            }
	    else
            {
	      array_push($errors,$messages[MSG_NEW_PASSWORD_TOO_LONG]);
            }
          }
          else
            array_push($errors,$messages[MSG_NEW_PASSWORD_TOO_SHORT]);
	}
        else
	 array_push($errors,$messages[MSG_NEW_PASSWORDS_DIFFER]);
      }
      else
          array_push($errors,$messages[MSG_INVALID_OLD_PASSWORD]); 
    }
    else
      array_push($errors,$messages[MSG_FILL_REQUIRED_FIELDS]);
  }
  else
  {
    if(isset($_POST["login"]) && isset($_POST["email"]))
    {
      $login = $_POST["login"];
      $email = $_POST["email"];
      $found = $udb->get_by_email($email);
      if($login==$found)
      {
	  if($udb->user_confirmed($login))
	  {
	  $hash2 = $udb->get_hash($login);
	  $remoteip=$_SERVER['REMOTE_ADDR'];
    
	  $mail->Body = sprintf($messages[MSG_RESETPASSWORD_MAIL], 
            $login, $remoteip, $hash2);
	  $mail->Subject = $messages[MSG_RESETPASSWORD_MAIL_TITLE];
	  $mail->AddAddress($email,$login);
      
	  $result = $mail->Send();
	  $mail->ClearAddresses();
	  $mail->ClearAttachments();
      
	  $_SESSION['message']=$messages[MSG_RESETPASSWORD_MAIL_SENT];
	  redirect($LINK_PREFIX."/message/ ");
        }
        else
	  array_push($errors,$messages[MSG_ACCOUNT_NOT_CONFIRMED_YET]);

      }
      else
        array_push($errors,$messages[MSG_LOGIN_OR_EMAIL_INVALID]);
    }
    else
      if(isset($_GET["hash"]) && isset($_POST["pass1"]) && 
        isset($_POST["pass2"]))
      {
	$login = $udb->get_by_hash($_GET["hash"]);

        if($login)
        {
          if($udb->user_confirmed($login))
          {
	    if($_POST["pass1"]==$_POST["pass2"])
	    {
	      $newpass=$_POST["pass1"];
	      if(!$udb->check_pass_too_short($newpass))
		if(!$udb->check_pass_too_long($newpass))
		{
                  $udb->change_password($login,$newpass);
                    $_SESSION['message']=$messages[MSG_PASSWORD_CHANGED];
		    redirect($LINK_PREFIX."/message/ ");
                }
		else
		  array_push($errors,$messages[MSG_NEW_PASSWORD_TOO_LONG]);
	      else
		array_push($errors,$messages[MSG_NEW_PASSWORD_TOO_SHORT]);
	    }
	    else
	      array_push($errors,$messages[MSG_NEW_PASSWORDS_DIFFER]);
          }
          else
            array_push($errors,$messages[MSG_ACCOUNT_NOT_CONFIRMED_YET]);
        }
        else
          array_push($errors,$messages[MSG_INVALID_HASH]);
      }
      else
        array_push($errors,$messages[MSG_FILL_REQUIRED_FIELDS]);
  }
}
else
{
  if(isset($_GET["hash"]))
  {
      $tpl->HASH="hash=".$_GET["hash"];
      $tpl->TITLE=$messages[MSG_PASSWORD_RECOVERY_TITLE];
      $tpl->INPUTS=$messages[MSG_NEW_PASSWORD_INPUTS];
  }
  else if($logged_in)
  {
    $tpl->HASH='';
    $tpl->TITLE=$messages[MSG_CHANGE_PASSWORD_TITLE];
    $tpl->INPUTS=$messages[MSG_OLD_NEW_PASSWORD_INPUTS];
  }
  else
  {
    $tpl->HASH='';
    $tpl->TITLE=$messages[MSG_PASSWORD_RECOVERY_TITLE];
    $tpl->INPUTS=$messages[MSG_LOGIN_EMAIL_INPUTS];
  }
}

if(!isset($error_html))
{
  if(count($errors)<=0)
  {
    $error_html='';
  }
  else
  if(count($errors)==1)
  {
    $error_html='<p>'.array_pop($errors).'</p>';
  }
  else
  {
    print count($errors);
    $error_html="<p>".$messages[MSG_OPERATION_FAILED_REASONS]."<ul>";
    foreach($errors as $reason)
    {
      $error_html.='<li>'.$reason.'</li>';
    }
    $error_html.="</ul></p>";
  
  }
}
$tpl->ERROR_MESSAGE=$error_html;

$title = $domain.' - '.__(MSG_PASSWORD_RECOVERY);
$tpl->TITLE=$title;
$tpl->SHORT_TITLE=$title;
