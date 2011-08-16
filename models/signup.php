<?php
assume_index();
$errors = array();
require_once(ROOT.'/classes/userdb.php');
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
		
		$udb = new UserDB();
		$udb->user_exists($login) && array_push($errors,"The login you entered already belongs to another user.");

                if(count($errors)==0)

                {

		  validate_login($login) || array_push($errors,"The login you entered is not valid.");
		  $hash1=crypt($password);
		  $hash2=crypt(rand());
		  $udb->register($login,$hash1,$hash2,$email);
		  
		  $mail->Body = <<<HEREDOC
Hello ${login},

Someone with the IP address ${remoteip} tried to register a username '${login}'
and entered your e-mail address on the website ${domain}. If it wasn't you,
please just remove this e-mail and ignore it. Otherwise, please click the below
or copy it to your browser's address bar to confirm that your e-mail address 
is valid:

http://${domain}${server_directory}confirm/${hash2}

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

if(count($errors)==0)
{
$_SESSION['message']="We sent you a confirmation link.";
#redirect("/message/ ");
}

}
else
{
}