<?php
//handles the communication with the MySQL database - users table
class UserDB {

public function __construct() {
	assume_database();
}

public function user_exists($login)
{
	$login_safe=mysql_real_escape_string($login);
	$sql='SELECT * FROM `users` WHERE `login`="'.$login_safe.'"';
	$res=mysql_query($sql);
	if($res)
		return mysql_num_rows($res)==1;
	return false;
}

public function valid_login($login,$hash,$cookie=false)
{
        $login_safe=mysql_real_escape_string($login);
        $hash_safe=mysql_real_escape_string($hash);
        $sql='SELECT * FROM `users` WHERE `login`="'.$login_safe.'"';
	$res=mysql_query($sql);
	if($res)
	{
              $row=mysql_fetch_assoc($res);
              if($row["password"]==$hash)
              {
                return true;
              }
	}
        return false;
}

public function do_login($login)
{
	if($cookie)
	  setcookie('hash',$row["hash"],time()+60*60*24*365*10,'/');
        $_SESSION['login']=$login;
	return true;
}

public function try_from_cookie()
{
        if(!array_key_exists('login',$_SESSION) && 
          array_key_exists('hash',$_COOKIE ))
        {
	  $hash_safe=mysql_real_escape_string($_COOKIE['hash']);
	  $sql='SELECT * FROM `users` WHERE `hash`="'.$hash_safe.'"';
	  $res=mysql_query($sql);
	  if($res)
	  {
		$row=mysql_fetch_assoc($res);
		$_SESSION['login']=$row['login'];
                return;
	  }
        setcookie('hash','',time()-3600,'/');
        unset($_COOKIE['hash2']); 
	}

}

public function do_register($login,$hash1,$hash2,$email)
{
	//we assume that user_exists was already called
	#TODO: fix magic numbers
	#TODO: hash2 could be more random?
	$login_safe=mysql_real_escape_string($login);
	$email_safe=mysql_real_escape_string($email);
	$sql='INSERT INTO `users` (`id`, `login`, `password`, `mail`, 
	  `mode`, `hash`, `created`) VALUES (NULL, 
	  "'.$login_safe.'", 
	  "'.$hash1.'", 
	  "'.$email_safe.'", 
	  "1", 
	  "'.$hash2.'",
	  "'.time().'");';
	mysql_query($sql);
        echo mysql_error();
}

public function try_confirm($hash)
{
      $hash_safe=mysql_real_escape_string($hash);
      $sql='UPDATE `users` SET mode="2" WHERE `hash`="'.$hash_safe
            .'" AND mode="1" AND created>'.(time()-60*60*24);
      mysql_query($sql);
      return mysql_affected_rows()==1;
}

public function user_confirmed($login)
{
      $login_safe=mysql_real_escape_string($login);
      $sql="SELECT * FROM `users` WHERE `login`='".$login_safe."'";
      $res = mysql_query($sql);
      if($res)
      {
	    $row=mysql_fetch_assoc($res);
	    if ($row["mode"]!=1)
              return true;
      }
      return false;
}

public function check_login_too_short($login)
{
  return strlen($login)<4;
}

public function check_login_too_long($login)
{
  return strlen($login)>30;
}

public function check_login_regex($login)
{
return preg_match("/^[0-9A-Za-z]*$/",$login)==0;
}

public function check_pass_too_short($password)
{
  return strlen($password)<9;
}

public function check_pass_too_long($password)
{
  return strlen($password)>199;
}

public function check_pass_regex()
{
  return false;
}

public function check_email_regex($email) //TODO: up/lowercase? fixes?
{ //the 22 in TLD length limit is because of XN--CLCHC0EA0B2G2A9GCD
  return preg_match("/^[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,22}$/",
    $email)==0;
}

public function get_by_hash($hash)
{
  $hash_safe=mysql_real_escape_string($hash);
  $sql="SELECT * FROM `users` WHERE `hash`='".$hash_safe."'";
  $res = mysql_query($sql);
  if($res)
  {
    $row=mysql_fetch_assoc($res);
    return $row['login'];
  }
  return NULL;
}

public function get_by_email($email)
{
  $email_safe=mysql_real_escape_string($email);
  $sql="SELECT * FROM `users` WHERE `mail`='".$email_safe."'";
  $res = mysql_query($sql);
  if($res)
  {
    $row=mysql_fetch_assoc($res);
    return $row['login'];
  }
  return NULL;
}

public function change_password($login,$password)
{
  $login_safe=mysql_real_escape_string($login);
  $hash1=hashdata($password,SALT);
  $hash2=hashdata(rand(),SALT);
  $sql="UPDATE `users` SET `password`='".$hash1."',`hash`='".$hash2."' 
    WHERE `login`='".$login_safe."'";
  mysql_query($sql);
  echo mysql_error();
  return mysql_affected_rows()==1;
}

public function get_hash($login)
{
  $login_safe=mysql_real_escape_string($login);
  $sql="SELECT * FROM `users` WHERE `login`='".$login_safe."'";
  $res = mysql_query($sql);
  if($res)
  {
    $row=mysql_fetch_assoc($res);
    return $row['hash'];
  }
  return NULL;

}

public function get_by_login($login)
{
  $login_safe=mysql_real_escape_string($login);
  $sql="SELECT * FROM `users` WHERE `login`='".$login_safe."'";
  $res = mysql_query($sql);
  if($res)
  {
    $row=mysql_fetch_assoc($res);
    return $row;
  }
  return NULL;
}

public function get_by_id($id)
{
  $id_safe=mysql_real_escape_string($id);
  $sql="SELECT * FROM `users` WHERE `id`='".$id_safe."'";
  $res = mysql_query($sql);
  if($res)
  {
    $row=mysql_fetch_assoc($res);
    return $row;
  }
  return NULL;
}

}