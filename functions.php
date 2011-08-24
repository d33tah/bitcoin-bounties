<?php
function validate_stub() { return true; }

function hashdata($data,$salt)
{
$ret = crypt($data,$salt);
$ret = substr($ret,strrpos($ret,'$')+1,strlen($ret));
$ret = str_replace('/','',$ret);
return $ret;
}

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
  if ($ini == 0) 
    throw new Exception("get_string_between: $start not found");
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

function message($msg)
{
  global $LINK_PREFIX;
  $_SESSION['message']=$msg;
  redirect($LINK_PREFIX."/message/ ");
}

//taken from: http://aidanlister.com/2004/04/human-readable-file-sizes/
//TODO: ask for WTFPL or something
function size_readable($size, $max = null, $system = 'si', 
  $retstring = '%01.2f %s')
{
  // Pick units
  $systems['si']['prefix'] = array('B', 'K', 'MB', 'GB', 'TB', 'PB');
  $systems['si']['size']   = 1000;
  $systems['bi']['prefix'] = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB');
  $systems['bi']['size']   = 1024;
  $sys = isset($systems[$system]) ? $systems[$system] : $systems['si'];

  // Max unit to display
  $depth = count($sys['prefix']) - 1;
  if ($max && false !== $d = array_search($max, $sys['prefix'])) {
      $depth = $d;
  }

  // Loop
  $i = 0;
  while ($size >= $sys['size'] && $i < $depth) {
      $size /= $sys['size'];
      $i++;
  }

  return sprintf($retstring, $size, $sys['prefix'][$i]);
}