<?php

require_once(ROOT.'classes/recaptchalib.php');
if(array_key_exists('mode',$_GET) && $_GET['mode']=='logout')
{
  $udb->logout();
}
else
if(!$udb->get_logged_in())
{
  $title=$domain.' - '.__(MSG_LOG_IN);
  if($_POST)
  {
    $login=$_POST['login'];
    $password=$_POST['password'];
    $cookie=isset($_POST['remember']) && $_POST['remember']=="on";
    $hash=hashdata($password,SALT);
  
    $captcha1=@$_POST["recaptcha_challenge_field"];
    $captcha2=@$_POST["recaptcha_response_field"];
    $captcha_response = recaptcha_check_answer ($recaptcha_privatekey,
      $_SERVER["REMOTE_ADDR"], $captcha1, $captcha2);
  
    $errors = array();
    
    if(!$captcha_response->is_valid)
    {
      array_push($errors,$messages[MSG_INVALID_CAPTCHA]);
    }
    else
    {
      $valid = $udb->valid_login($login,$hash);
      if($valid)
      {
	if(!$udb->user_confirmed($login))
	      array_push($errors,$messages[MSG_ACCOUNT_NOT_CONFIRMED_YET]);
      }
      else
      {
	array_push($errors,$messages[MSG_LOGIN_DATA_INVALID]);
      }
    }
  
    if(count($errors)<=0)
    {
      $udb->do_login($login,$cookie);
      $tpl->ERROR_MESSAGE='';
      if(isset($_GET['redirect']))
	redirect($_GET['redirect']);
      else
	redirect($LINK_PREFIX);
      
    }
    else
    if(count($errors)==1)
    {
      $error_html=array_pop($errors);
    }
    else
    {
      $error_html=$messages[MSG_LOGIN_FAILED_REASONS]."<ul>";
      foreach($errors as $reason)
      {
	$error_html.='<li>'.$reason.'</li>';
      }
      $error_html.="</ul>";
    }
    $tpl->ERROR_MESSAGE='<p>'.$error_html.'</p>';
  }
  else
    $tpl->ERROR_MESSAGE='';
  
  if(isset($captcha_response) && !$captcha_response->is_valid)
  {
    $error = $captcha_response->error;
    $tpl->LOGIN_FORM=login_form(recaptcha_get_html(
      $recaptcha_publickey, $error));
  }
  else
    $tpl->LOGIN_FORM=login_form(recaptcha_get_html(
      $recaptcha_publickey,""));
}
else
{
  $title=$domain.' - '.__(MSG_ERROR);
  $tpl->FATAL_ERROR=__(MSG_NEED_LOGOUT);
}

$tpl->TITLE=$title;
$tpl->SHORT_TITLE=$title;
