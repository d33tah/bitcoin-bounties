<?php

require_once(ROOT.'classes/recaptchalib.php');
if(array_key_exists('mode',$_GET) && $_GET['mode']=='logout')
{
  setcookie('hash','',time()-3600,'/');
  if(array_key_exists('hash',$_COOKIE))
    unset($_COOKIE['hash']);
  unset($_SESSION['login']);
  if(array_key_exists('HTTP_REFERER',$_SERVER))
    redirect($_SERVER['HTTP_REFERER']);
}
else
if($_POST)
{
  $login=$_POST['login'];
  $password=$_POST['password'];
  $cookie=isset($_POST['remember']) && $_POST['remember']=="on";
  $hash=hashdata($password,SALT);

  $captcha1=$_POST["recaptcha_challenge_field"];
  $captcha2=$_POST["recaptcha_response_field"];
  $captcha_response = recaptcha_check_answer ($recaptcha_privatekey,
    $_SERVER["REMOTE_ADDR"], $captcha1, $captcha2);

  $errors = array();
  
  if(!$captcha_response->is_valid)
  {
    array_push($errors,"The verification CAPTCHA was not repeated correctly.\n");
  }
  else
  {
    $valid = $udb->valid_login($login,$hash,$cookie);
    if($valid)
    {
      if(!$udb->user_confirmed($login))
            array_push($errors,"Your account is not confirmed yet. Please
              confirm your account by clicking the confirmation link we
              sent you to your e-mail address and then try again. 
              If you can't find it, check your SPAM folder. To rule out a 
              mistake, you can retry signing up again with another username
              or wait 24 hours for the confirmation link to expire. If you 
              still haven't received the e-mail, please contact the site 
              administrator.");
    }
    else
    {
      array_push($errors,"The login data you entered are not valid.\n");
    }
  }

  if(count($errors)<=0)
  {
    $udb->do_login($login);
    $tpl->replace("ERROR_MESSAGE",'');
    redirect($LINK_PREFIX);
  }
  else
  if(count($errors)==1)
  {
    $error_html=array_pop($errors);
  }
  else
  {
    $error_html="The login failed due to the following reasons: <ul>";
    foreach($errors as $reason)
    {
      $error_html.='<li>'.$reason.'</li>';
    }
    $error_html.="</ul>";
  }
  $tpl->replace("ERROR_MESSAGE",'<p>'.$error_html.'</p>');
}
else
  $tpl->replace("ERROR_MESSAGE",'');

if(isset($captcha_response) && !$captcha_response->is_valid)
{
  $error = $captcha_response->error;
  $tpl->replace("RECAPTCHA",recaptcha_get_html($recaptcha_publickey, $error));
}
else
  $tpl->replace("RECAPTCHA",recaptcha_get_html($recaptcha_publickey,""));