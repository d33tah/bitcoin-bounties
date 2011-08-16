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

public function valid_login($login,$hash)
{
        assume_database();
        $login_safe=mysql_real_escape_string($login);
        $hash_safe=mysql_real_escape_string($hash);
        $sql='SELECT * FROM `users` WHERE `login`="'.$login_safe.'"';
        print $sql;
        print mysql_error();
	$res=mysql_query($sql);
	if($res)
	{
              $row=mysql_fetch_assoc($res);
              print $hash;
              print_r($row);
              return $row["password"]==$hash;
	}
        print "nothing";
        return false;
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