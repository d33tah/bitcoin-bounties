<?php
require_once(ROOT.'/classes/bountydb.php');
$bdb=new BountyDB();
if($submission = $bdb->get_submission($_GET["id"]))
{
  if($bounty = $bdb->get_by_id($submission['bounty_id']))
  {
    if($user=$udb->get_by_id($submission["user_id"]))
    {
      $filename=$submission['filename'];
      $filename_link="<a href=\"$LINK_PREFIX/uploads/$filename\">
        $filename</a>";
      $file_size=size_readable(filesize(ROOT."uploads/".$filename));
      $tpl->replace('COMMIT_AUTHOR',$user['login']);
      $tpl->replace('BOUNTY_DESC',$bounty['description']);
      $tpl->replace('COMMIT_FILENAME',$filename_link);
      $tpl->replace('COMMIT_SIZE',$file_size);
      $tpl->replace('COMMIT_COMMENT',$submission['description']);

      $tpl->replace("TITLE", 
	$domain.' - '.__(MSG_VIEWING_COMMIT_TO_BY,
        $bounty['description'],$user['login']));
      
      $tpl->replace("SHORT_TITLE", 
	$domain.' - '.__(MSG_VIEWING_COMMIT_BY,$user['login']));

    }
  }
}

