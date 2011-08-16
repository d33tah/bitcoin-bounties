<?php
if($_POST)
{
require_once(ROOT.'/classes/userdb.php');
$udb = new UserDB();
$login=$_POST['login'];
$password=$_POST['password'];
$hash=crypt($password);
$errors = array();
if($udb->valid_login($login,$hash))
{
$_SESSION['login']=$login;
print "Logged in!";
}
else
{
array_push($errors,"The login data you entered are not valid.\n");
print "error";
}
}