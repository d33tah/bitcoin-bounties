<?php
$domain="";
$server_directory="/"
$adminemail='';

$db_host='';
$db_login='';
$db_pass='';
$db_name='';
define('SALT','');
define('LINK_PREFIX','');

function mail_setup()
{

  global $mail;
  
  $mail = new PHPMailer();
  $mail->From = "";
  $mail->FromName = "";
  $mail->Host = "smtp.gmail.com";
  $mail->Port = 465;
  $mail->SMTPSecure = "ssl";
  $mail->Mailer = "smtp";
  $mail->Username = "";
  $mail->Password = "";
  $mail->SMTPAuth = true;
  $mail->SetLanguage("en", "phpmailer/language/");

}

$recaptcha_publickey="";
$recaptcha_privatekey="";