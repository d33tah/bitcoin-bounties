<?php
//handles the communication with the MySQL database - users table
class UserDB {

public function user_exists($login)
{
	assume_database();
	$login_safe=mysql_real_escape_string($login);
	$sql='SELECT * FROM `users` WHERE `login`="'.$login_safe.'"';
	$res=mysql_query($sql);
	if($res)
		return mysql_num_rows($res)==1;
	return false;
}

public function valid_login($login,$hash,$cookie=false)
{
        assume_database();
        $login_safe=mysql_real_escape_string($login);
        $hash_safe=mysql_real_escape_string($hash);
        $sql='SELECT * FROM `users` WHERE `login`="'.$login_safe.'"';
	$res=mysql_query($sql);
	if($res)
	{
              $row=mysql_fetch_assoc($res);
              if($row["password"]==$hash)
              {
                if($cookie)
                  setcookie('hash',$row["hash"],time()+60*60*24*365*10,'/');
                return true;
              }
	}
        return false;
}

public function try_from_cookie()
{
        if(!array_key_exists('login',$_SESSION) && array_key_exists('hash',$_COOKIE ))
        {
	  assume_database();
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

public function register($login,$hash1,$hash2,$email)
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
}