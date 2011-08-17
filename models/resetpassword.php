<?php
$errors=array();
if($_POST)
{
  if(isset($_SESSION["login"]))
  {
    $login = $_SESSION["login"];

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
		  $_SESSION['message']="Your password has been changed.";
		  redirect($LINK_PREFIX."/message/ ");
	      }
              else
              {
		array_push($errors,'The password you entered as new is
	         identical to the old one. Please choose another one.');
              }
            }
	    else
            {
	      array_push($errors,'The new password you entered is too long.
	       Please choose a shorter one.');
            }
          }
          else
            array_push($errors,'The new password you entered is too short.
              Please choose a longer one.');
	}
        else
	 array_push($errors,'The two "new password" fields do not 
	  contain the same password.');
      }
      else
          array_push($errors,'The old password you entered is not valid.'); 
    }
    else
      array_push($errors,"Please fill all the required fields.");
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
    
	  $mail->Body = <<<HEREDOC
Hello ${login},

Someone with the IP address ${remoteip} tried to recover your password
on the website ${domain}. If it wasn't you, please just remove this e-mail and
ignore it. Otherwise, please click the below or copy it to your browser's 
address bar:

${LINK_PREFIX}/resetpassword/hash=${hash2}

The following link does not expire.

Please note this is an automatically generated message. Please do not reply to
it. Should you have any questions, please contact the server admin at
${adminemail}

Yours sincerely,
${domain} admin

HEREDOC;
	  $mail->Subject = "Reset your password at ${domain}";
	  $mail->AddAddress($email,$login);
      
	  $result = $mail->Send();
	  $mail->ClearAddresses();
	  $mail->ClearAttachments();
      
	  $_SESSION['message']="To reset your password, please visit the link in 
	    the e-mail we have just sent you.";
	  redirect($LINK_PREFIX."/message/ ");
        }
        else
	  array_push($errors,"Your account is not confirmed yet. Please
	    confirm your account by clicking the confirmation link we
	    sent you to your e-mail address. If you can't find it, check
	    your SPAM folder. To rule out a mistake, you can retry signing
	    up again with another username or wait 24 hours for the 
	    confirmation link to expire. If you still haven't received
	    the e-mail, please contact the site administrator at
	    <a href=\"mailto:${adminemail}\">${adminemail}</a>.");

      }
      else
        array_push($errors,"Either the login or e-mail field is not valid.
          Please make sure the account is registered and try again.");
    }
    else
      if(isset($_GET["hash"]) && isset($_POST["pass1"]) && isset($_POST["pass2"]))
      {
	$login = $udb->get_by_hash($_GET["hash"]);

        if($login)
        {
          if($udb->user_confirmed($login))
          {
	    if($_POST["pass1"]==$_POST["pass2"])
	    {
	      $newpass=$_POST["pass1"];
	      if(!$udb->password_too_short($newpass))
		if(!$udb->password_too_long($newpass))
		{
                  $udb->change_password($login,$newpass);
                    $_SESSION['message']="Your password has been changed.";
		    redirect($LINK_PREFIX."/message/ ");
                }
		else
		  array_push($errors,'The new password you entered is too long.
		  Please choose a shorter one.');
	      else
		array_push($errors,'The new password you entered is too short.
		Please choose a longer one.');
	    }
	    else
	      array_push($errors,'The two "new password" fields do not 
		contain the same password.');
          }
          else
            array_push($errors,"Your account is not confirmed yet. Please
              confirm your account by clicking the confirmation link we
              sent you to your e-mail address. If you can't find it, check
              your SPAM folder. To rule out a mistake, you can retry signing
              up again with another username or wait 24 hours for the 
              confirmation link to expire. If you still haven't received
              the e-mail, please contact the site administrator at
              <a href=\"mailto:${adminemail}\">${adminemail}</a>.");
        }
        else
          array_push($errors,"The given hash is invalid. Please make sure the 
            link you have clicked is not corrupt.");
      }
      else
        array_push($errors,"Please fill all the required fields.");
  }
}
else
{
  if(isset($_GET["hash"]))
  {
      $tpl->replace("HASH","hash=".$_GET["hash"]);
      $tpl->replace("TITLE","password recovery");
      $tpl->replace("INPUTS",'
	Choose a new password: <input type="password" name="pass1" /> <br />
	Repeat new password: <input type="password" name="pass2" /> <br />
	');
  }
  else if(isset($_SESSION["login"]))
  {
    $tpl->replace("HASH",'');
    $tpl->replace("TITLE","change password");
    $tpl->replace("INPUTS",'
      Old password: <input type="password" name="oldpass" /> <br />
      Choose a new password: <input type="password" name="pass1" /> <br />
      Repeat new password: <input type="password" name="pass2" /> <br />
      ');
  }
  else
  {
    $tpl->replace("HASH",'');
    $tpl->replace("TITLE","password recovery");
    $tpl->replace("INPUTS",'
      Login: <input type="text" name="login" /> <br />
      E-mail address: <input type="text" name="email" /> <br />
      ');
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
    $error_html="<p>The login failed due to the following reasons: <ul>";
    foreach($errors as $reason)
    {
      $error_html.='<li>'.$reason.'</li>';
    }
    $error_html.="</ul></p>";
  
  }
}
$tpl->replace("ERROR_MESSAGE",$error_html);
