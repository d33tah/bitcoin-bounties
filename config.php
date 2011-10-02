<?php
$domain="";
$server_directory="/";
$adminemail='';

$db_host='';
$db_login='';
$db_pass='';
$db_name='';
define('SALT','');
$LINK_PREFIX='';

$default_view='listbounties';
$debug=true;

$login_min_length =  4;
$login_max_length = 30;
$pass_min_length = 9;
$pass_max_length = 199;
$title_min_length = 7;
$title_max_length = 40;
$desc_min_length = 20;
$desc_max_length = 4096;

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

$bitcoin_login='rpcuser';
$bitcoin_password='rpcpass';
$bitcoin_host='127.0.0.1';
$bitcoin_port='8332';
$bitcoin_path='';

$fee_address='mghb6K62ZZok1Yq2qwRytWm1GobUETdvrp';
$fee_multiplier=0.01;
