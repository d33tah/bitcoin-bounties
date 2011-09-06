<?php
//TODO: check if a file exists
require_once(ROOT.'/classes/bountydb.php');
$bdb=new BountyDB();
if(isset($_SESSION['login']))
{
  if(isset($_GET['id']))
  {
    $tpl->replace('BOUNTYID',$_GET['id']);
    if($bounty = $bdb->get_by_id($_GET["id"]))
    {
      if($_POST)
      {
	$tmpfile=$_FILES['uploaded']['tmp_name'];
	$filename=basename($_FILES['uploaded']['name']);
	if(is_uploaded_file($tmpfile))
	{
	  if(move_uploaded_file($tmpfile,ROOT."uploads/".$filename))
	  {
	    $our_user=$udb->get_by_login($_SESSION['login']);
	    $our_uid=$our_user['id'];
	    $bounty_id=$_GET['id'];
	    $description=$_POST['comments'];
	    $bdb->add_submission($bounty_id,$our_uid,$description,$filename);
	    echo "File submitted successfully!";
	  }
	  else
	    echo 'if(move_uploaded_file($tmpfile,ROOT."uploads/".$filename))';
	}
	else
	  echo 'if(is_uploaded_file($tmpfile))';
      }
    }
    else
      echo 'if($bounty = $bdb->get_by_id($_GET["id"]))';
  }
  else
    echo "if(isset(\$_GET['id']))";
}
else
  echo "if(isset(\$_SESSION['login']))";

$title=$domain.' - '.__(MSG_ADD_COMMIT_TITLE);
$tpl->replace("TITLE",$title);
$tpl->replace("SHORT_TITLE",$title);
