<?php
/*
1. set up output buffering, 2. sessions, and 3. execution timer
2. get the model name, 4. if it's invalid, return a 404
5. establish a connection with the bitcoin server //TODO: react to downtimes
6. try to log in from cookie
7. if logged in, tell it to the template
8. tell the template about our block number, domain, link prefix and view name
9. run the model file
*/

ob_start();
session_start();
define('ROOT',dirname($_SERVER['SCRIPT_FILENAME']).'/');
require_once("../config.php"); //put it here so I don't push it accidentally
require_once("functions.php");

execution_timer();

require_once(ROOT."constants.php");
require_once(ROOT."languages/english.php");

require_once(ROOT.'classes/phpmailer/class.phpmailer.php');
require_once(ROOT."classes/templates.php");
require_once(ROOT.'/classes/accountdb.php');
require_once(ROOT.'/classes/userdb.php');

require_once(ROOT.'/controllers/view.php');

mail_setup();

try
{

  if(isset($_GET['view']))
    $view = new View($_GET["view"],ROOT);
  else
    $view = new View($default_view,ROOT);

  $adb=new AccountDB($bitcoin_login,$bitcoin_password,
    $bitcoin_host,$bitcoin_port,$bitcoin_path);

  $udb = new UserDB();
  $udb->try_from_cookie();
  $our_user = $udb->get_logged_in();

  if($view->viewfile_exists())
  {
    $tpl=new Template($view->viewfile_name());

    if($our_user)
      $tpl->USERNAME=$our_user['login'];
    else
      $tpl->USERNAME=false;

    $tpl->VIEWNAME=$view->get_name();
    $tpl->DOMAIN=$domain			;
    $tpl->LINK_PREFIX=$LINK_PREFIX;
    $tpl->BLOCKCOUNT=$adb->conn->getblocknumber();
  }

  if($view->modelfile_exists())
    require_once($view->modelfile_name());

  if($view->viewfile_exists())
    print $tpl->print_body();

}
catch(Exception $e)
{
  if($debug)
    die($e->getMessage());
  do_404();
}

?>
