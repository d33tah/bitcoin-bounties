<?php
require_once(ROOT.'/classes/bountydb.php');
$bdb=new BountyDB();
if(isset($_GET["id"]))
{
  if($submission = $bdb->get_submission($_GET["id"]))
  {
    if($bounty = $bdb->get_by_id($submission['bounty_id']))
    {
      if($user=$udb->get_by_id($submission["user_id"]))
        $username=$user['login'];
      else
        $username=__MSG(MSG_DELETED_USER);

      $filename=$submission['filename'];
      $filename_link="<a href=\"$LINK_PREFIX/uploads/$filename\">
	$filename</a>";
      $file_size=size_readable(filesize(ROOT."uploads/".$filename));
      $tpl->replace('COMMIT_AUTHOR',$username);
      $tpl->replace('BOUNTY_DESC',$bounty['title']);
      $tpl->replace('COMMIT_FILENAME',$filename_link);
      $tpl->replace('COMMIT_SIZE',$file_size);
      $tpl->replace('COMMIT_COMMENT',$submission['description']);

      $title = $domain.' - '.__(MSG_VIEWING_COMMIT_TO_BY,  
        $bounty['title'],$username);

      $short_title = $domain.' - '.__(MSG_VIEWING_COMMIT_BY,$username);
  
    }
  }
  else
  {
    $title=$short_title=$domain.' - '.__(MSG_ERROR);
    $tpl->replace("FATAL_ERROR",__(MSG_COMMIT_NOT_FOUND));
  }
}
else
{
  $tpl->replace("FATAL_ERROR",__(MSG_NO_COMMIT_GIVEN));
  $title=$short_title=$domain.' - '.__(MSG_ERROR);
}

$tpl->replace("TITLE", $title);
$tpl->replace("SHORT_TITLE", $short_title);
