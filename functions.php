<?php
function validate_stub() { return true; }

function hashdata($data,$salt)
{
  $ret = crypt($data,$salt);
  $ret = substr($ret,strrpos($ret,'$')+1,strlen($ret));
  $ret = str_replace('/','',$ret);
  $ret = str_replace('.','',$ret);
  return $ret;
}

function assume_index()
{
  $basename=basename($_SERVER['PHP_SELF']);
  if($basename!='index.php')
    throw new Exception("assume_index(): $basename");
}

function assume_database()
{
  if(!defined('DB_CONNECTED'))
  {
    require_once(ROOT.'/classes/database.php');
    global $db;
    $db = new Database();
    mysql_query("DELETE FROM `users` WHERE `mode`='1' AND `created`<".
      (time()-60*60*24));
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

//taken from http://www.justin-cook.com
// /wp/2006/03/31/php-parse-a-string-between-two-strings/
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

function message($msg,$refresh_url='')
{
  global $LINK_PREFIX;
  $_SESSION['message']=$msg;
  if($refresh_url)
    $refresh='refresh='.$refresh_url;
  else
    $refresh='';
  redirect($LINK_PREFIX."/message/$refresh");
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

function __()
{
  global $messages;
  $args = func_get_args();
  $msg_num = array_shift($args);
  $format = $messages[$msg_num];
  
  return vsprintf($format,$args);
}

function validate_filename($filename)
{
  //return true;
  return substr($filename,-4)!='.php';
}

function execution_timer()
{
  global $start_time;
  list($usec, $sec) = explode(" ", microtime());
  $tmp=((float)$usec + (float)$sec);

  if(isset($start_time))
    return $tmp-$start_time;
  else
    $start_time=$tmp;
}

function login_form($RECAPTCHA,$redirect_url='')
{
  global $LINK_PREFIX,$server_directory;

  if($redirect_url)
    $redirect="redirect=${server_directory}/${redirect_url}";
  else
    $redirect='';
  
  $MSG_LOGIN=__(MSG_LOGIN);
  $MSG_PASSWORD=__(MSG_PASSWORD);
  $MSG_REMEMBER_ME=__(MSG_REMEMBER_ME);
  $MSG_VERIFICATION_CAPTCHA=__(MSG_VERIFICATION_CAPTCHA);
  $MSG_FORGOT_PASSWORD=__(MSG_FORGOT_PASSWORD);
  $MSG_HAVE_NO_ACCOUNT_SIGN_UP=__(MSG_HAVE_NO_ACCOUNT_SIGN_UP);

  $ret =<<<HEREDOC
    <form method="post" action="$LINK_PREFIX/login/$redirect">
      $MSG_LOGIN
	<input type="text" name="login" /> <br />

      $MSG_PASSWORD
	<input type="password" name="password" /> <br />

	<input type="checkbox" name="remember">
      $MSG_REMEMBER_ME
	<br />

      $MSG_VERIFICATION_CAPTCHA
	<script type="text/javascript">
	  var RecaptchaOptions = {
	      theme : 'clean'
	  };
	</script>
      $RECAPTCHA

      <input type="submit" value="Submit" />
    </form>
    
    <p>
      <a href="$LINK_PREFIX/resetpassword/">
	$MSG_FORGOT_PASSWORD
      </a>
    </p>
    
    <p>
      <a href="$LINK_PREFIX/signup/">
	$MSG_HAVE_NO_ACCOUNT_SIGN_UP
      </a>
    </p>
HEREDOC;

  return $ret;
}