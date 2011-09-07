<?php

function callback($buffer) { return '<pre>'.htmlentities($buffer).'</pre>'; }

if($_POST)
  ob_start('callback');

function assume_index() { }
define('ROOT','');
require_once("config.php");
require_once("constants.php");
require_once("languages/english.php");

$curr=0;

if(!$_POST)
  echo "<form method='post'>";

foreach (preg_split("[\n|\r]", $consts_list) as $value)
{
  if($_POST)
  {
    echo '$messages['.$value."]=<<<MESSAGE\n";
    echo $_POST[$curr];
    echo "\nMESSAGE;\n\n";
  }
  else
    echo $value."<br /><textarea name='$curr' rows='5'
      cols='79'>".$messages[$curr]."</textarea><br />";
  $curr++;
}

if(!$_POST)
  echo '<input type="submit" /></form>';