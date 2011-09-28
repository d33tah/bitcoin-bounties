<?php
assume_index();
require_once(ROOT.'classes/recaptchalib.php');
$errors = array();
if(!$udb->get_logged_in())
{
  $title=$domain.' - '.__(MSG_SIGN_UP_TITLE);
  if($_POST)
  {
    $login=$_POST['login'];
    $password=$_POST['password'];
    $password2=$_POST['password'];
    $email=$_POST['email'];
  
    $referer=$_SERVER['HTTP_REFERER'];
    $remoteip=$_SERVER['REMOTE_ADDR'];
  
    $udb->check_login_too_short($login) && 
      array_push($errors, $messages[MSG_LOGIN_TOO_SHORT]);
    $udb->check_login_too_long($login) && 
      array_push($errors, $messages[MSG_LOGIN_TOO_LONG]);
    $udb->check_login_regex($login) && 
      array_push($errors, $messages[MSG_LOGIN_REGEX]);
    $udb->check_pass_too_short($password) && 
      array_push($errors, $messages[MSG_PASS_TOO_SHORT]);
    $udb->check_pass_too_long($password) && 
      array_push($errors, $messages[MSG_PASS_TOO_LONG]);
    $udb->check_email_regex($email) && 
      array_push($errors, $messages[MSG_EMAIL_REGEX]);
    $udb->get_by_email($email) && 
      array_push($errors, $messages[MSG_EMAIL_TAKEN]);
  
    if($password!=$password2) array_push($errors, 
      $messages[MSG_PASS_DONT_MATCH]);
    
    $udb->user_exists($login) && array_push($errors,
      $messages[MSG_LOGIN_TAKEN]);
  
    $captcha1=$_POST["recaptcha_challenge_field"];
    $captcha2=$_POST["recaptcha_response_field"];
    $captcha_response = recaptcha_check_answer (
      $recaptcha_privatekey,$_SERVER["REMOTE_ADDR"], 
      $captcha1, $captcha2);
    
    $captcha_response->is_valid || array_push($errors, 
      $messages[MSG_INVALID_CAPTCHA]);
  
    if(count($errors)==0)
  
    {
  
      $hash1=hashdata($password,SALT);
      $hash2=hashdata(rand(),SALT);
  
      $confirmation_email = __(MSG_CONFIRMATION_EMAIL,
	$login,$remoteip,$hash2);
  
      $mail->Body = $confirmation_email;
      $mail->Subject = $messages[
	MSG_CONFIRMATION_EMAIL_TITLE];
      $mail->AddAddress($email,$login);
  
      $result = $mail->Send();
  
      $mail->ClearAddresses();
      $mail->ClearAttachments();
  
      if($result)
	$udb->do_register($login,$hash1,$hash2,$email);
      else
	array_push($errors, $messages[MSG_EMAIL_SENDING_ERROR]);
  
  
    }
  
    if(count($errors)<=0)
    {
      $tpl->ERROR_MESSAGE='';
      message($messages[MSG_CONFIRMATION_EMAIL_SENT]);
    }
    else
    {
      if(count($errors)==1)
      {
	$error_html=array_pop($errors);
      }
      else
      {
	$error_html=$messages[MSG_REGISTRATION_FAILED_LIST].'<ul>';
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
    $tpl->ERROR_MESSAGE='';
  
  if(isset($captcha_response) && !$captcha_response->is_valid)
  {
    $error = $captcha_response->error;
    $tpl->RECAPTCHA=recaptcha_get_html($recaptcha_publickey, $error);
  }
  else
    $tpl->RECAPTCHA=recaptcha_get_html($recaptcha_publickey,"");
}
else
{
  $title=$domain.' - '.__(MSG_ERROR);
  $tpl->FATAL_ERROR=__(MSG_NEED_LOGOUT);
}

$tpl->TITLE=$title;
$tpl->SHORT_TITLE=$title;
