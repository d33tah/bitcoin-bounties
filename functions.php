<?php
function validate_stub() { return true; }

function assume_index()
{
	$basename=basename($_SERVER['PHP_SELF']);
	if($basename!='index.php')
		throw new Exception("assume_index(): $basename");
}

function assume_loggedin()
{
  if($_SESSION['login'])
    return true;
}

function assume_database()
{
	if(!defined('DB_CONNECTED'))
	{
		require_once(ROOT.'/classes/database.php');
		global $db;
		$db = new Database();
                mysql_query("DELETE FROM `users` WHERE `mode`='1' AND `created`<".(time()-60*60*24));
                print mysql_error();
	}
}

function try_require($filename)
{
	if(file_exists($filename))
	{
		return require($filename);
	}
	
	return false;
}

function viewfile($viewname)
{
//we assume it's validated
return "views/$viewname.php";
}

function modelfile($modelname)
{
//we assume it's validated
return "models/$modelname.php";
}

function do_404()
{
	require(viewfile(404));
}

//taken from http://www.justin-cook.com/wp/2006/03/31/php-parse-a-string-between-two-strings/
function get_string_between($string, $start, $end){
	$ini = strpos($string,$start);
	if ($ini == 0) throw new Exception("get_string_between: $start not found");
	$ini += strlen($start);
	$len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}

function validate_oururl() { return validate_stub(); }

function redirect($url)
{
	validate_oururl();
	header("Location: $url");
}