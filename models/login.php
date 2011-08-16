<?php
if(array_key_exists('mode',$_GET) && $_GET['mode']=='logout')
{
  $_SESSION['login']='';
  if(array_key_exists('HTTP_REFERER',$_SERVER))
    redirect($_SERVER['HTTP_REFERER']);
}
else
if($_POST)
{
  require_once(ROOT.'/classes/userdb.php');
  $udb = new UserDB();
  $login=$_POST['login'];
  $password=$_POST['password'];
  $hash=crypt($password,SALT);
  $errors = array();
  if($udb->valid_login($login,$hash))
  {
    $_SESSION['login']=$login;
    redirect($LINK_PREFIX);
  }
  else
  {
    array_push($errors,"The login data you entered are not valid.\n");
  }
}