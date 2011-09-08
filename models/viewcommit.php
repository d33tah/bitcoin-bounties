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
      $tpl->COMMIT_AUTHOR=$username;
      $tpl->BOUNTY_DESC=$bounty['title'];
      $tpl->COMMIT_FILENAME=$filename_link;
      $tpl->COMMIT_SIZE=$file_size;
      $tpl->COMMIT_COMMENT=$submission['description'];

      $title = $domain.' - '.__(MSG_VIEWING_COMMIT_TO_BY,  
        $bounty['title'],$username);

      $short_title = $domain.' - '.__(MSG_VIEWING_COMMIT_BY,$username);

      $tpl->addentry("BREADCRUMBS",array(
	"URL"=>$LINK_PREFIX."/viewbounty/id={$bounty['id']}",
	"NAME"=>$bounty['title']));

      $tpl->addentry("BREADCRUMBS",array(
	"URL"=>$LINK_PREFIX."/commits/id={$bounty['id']}",
	"NAME"=>__(MSG_COMMITS_LIST_CAPITAL)));

    }
  }
  else
  {
    $title=$short_title=$domain.' - '.__(MSG_ERROR);
    $tpl->FATAL_ERROR=__(MSG_COMMIT_NOT_FOUND);
  }
}
else
{
  $tpl->FATAL_ERROR=__(MSG_NO_COMMIT_GIVEN);
  $title=$short_title=$domain.' - '.__(MSG_ERROR);
}

$tpl->TITLE= $title;
$tpl->SHORT_TITLE= $short_title;
