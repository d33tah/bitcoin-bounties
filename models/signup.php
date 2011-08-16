<?php
assume_index();
require_once(ROOT.'classes/recaptchalib.php');
$errors = array();
if($_POST)
{
	function validate_login() { return validate_stub(); }
	function validate_password() { return validate_stub(); }
	function validate_email() { return validate_stub(); }

	$login=$_POST['login'];
	$password=$_POST['password'];
	$referer=$_SERVER['HTTP_REFERER'];
	$remoteip=$_SERVER['REMOTE_ADDR'];

		$password2=$_POST['password'];
		$email=$_POST['email'];
		
                validate_login($login) || array_push($errors,"The login you entered is not valid.");
		validate_password($password,$password2) || array_push($errors,"The passwords you entered are not valid.");
		validate_email($email) || array_push($errors,"The e-mail address you entered is not valid.");
		
		$udb->user_exists($login) && array_push($errors,"The login you entered already belongs to another user.");

		$captcha1=$_POST["recaptcha_challenge_field"];
		$captcha2=$_POST["recaptcha_response_field"];
		$captcha_response = recaptcha_check_answer ($recaptcha_privatekey,
		  $_SERVER["REMOTE_ADDR"], $captcha1, $captcha2);
		
          	$captcha_response->is_valid || array_push($errors,"The verification CAPTCHA was not repeated correctly.");

                if(count($errors)==0)

                {

		  validate_login($login) || array_push($errors,"The login you entered is not valid.");
		  $hash1=crypt($password,SALT);
		  $hash2=crypt(rand(),SALT);
		  $udb->register($login,$hash1,$hash2,$email);
		  
		  $mail->Body = <<<HEREDOC
Hello ${login},

Someone with the IP address ${remoteip} tried to register a username '${login}'
and entered your e-mail address on the website ${domain}. If it wasn't you,
please just remove this e-mail and ignore it. Otherwise, please click the below
or copy it to your browser's address bar to confirm that your e-mail address 
is valid:

${LINK_PREFIX}/confirm/hash=${hash2}

The following link will expire within 24 hours.

Please note this is an automatically generated message. Please do not reply to
it. Should you have any questions, please contact the server admin at
${adminemail}

Yours sincerely,
${domain} admin

HEREDOC;
			  $mail->Subject = "Cofirm your registration at ${domain}";
			  $mail->AddAddress($email,$login);
  
			  $result = $mail->Send();
			  $mail->ClearAddresses();
			  $mail->ClearAttachments();
	        }

if(count($errors)<=0)
{
  $_SESSION['message']="We sent you a confirmation link.";
  $tpl->replace("ERROR_MESSAGE",'');
  redirect($LINK_PREFIX."/message/ ");
}
else
{
  if(count($errors)==1)
  {
    $error_html=array_pop($errors);
  }
  else
  {
    $error_html="The registration failed due to the following reasons: <ul>";
    foreach($errors as $reason)
    {
      $error_html.='<li>'.$reason.'</li>';
    }
    $error_html.="</ul>";
  }
  $tpl->replace("ERROR_MESSAGE",'<p>'.$error_html.'</p>');
}

}

$tpl->replace("ERROR_MESSAGE",'');

if(isset($captcha_response) && !$captcha_response->is_valid)
{
  $error = $captcha_response->error;
  $tpl->replace("RECAPTCHA",recaptcha_get_html($recaptcha_publickey, $error));
}
else
  $tpl->replace("RECAPTCHA",recaptcha_get_html($recaptcha_publickey,""));