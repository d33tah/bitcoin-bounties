<?php
//handles manipulating the connecting with the MySQL database
class Database
{
public function __construct() {
	global $db_host,$db_login,$db_pass,$db_name;
	mysql_connect($db_host,$db_login,$db_pass);
	mysql_select_db($db_name);
	//TODO: encoding selection: set names utf8?
}
}