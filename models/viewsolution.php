<?php
require_once(ROOT.'/classes/bountydb.php');
$bdb=new BountyDB();
if(isset($_GET["id"]))
{
  if($solution = $bdb->get_solution($_GET["id"]))
  {
    if($bounty = $bdb->get_by_id($solution['bounty_id']))
    {
      if($user=$udb->get_by_id($solution["user_id"]))
        $username=$user['login'];
      else
        $username=__MSG(MSG_DELETED_USER);

      $filename=$solution['filename'];
      $filename_link="<a href=\"$LINK_PREFIX/uploads/$filename\">
	$filename</a>";
      $file_size=size_readable(filesize(ROOT."uploads/".$filename));
      $tpl->SOLUTION_AUTHOR=$username;
      $tpl->BOUNTY_DESC=$bounty['title'];
      $tpl->SOLUTION_FILENAME=$filename_link;
      $tpl->SOLUTION_SIZE=$file_size;
      $tpl->SOLUTION_COMMENT=$solution['description'];

      $title = $domain.' - '.__(MSG_VIEWING_SOLUTION_TO_BY,  
        $bounty['title'],$username);

      $short_title = $domain.' - '.__(MSG_VIEWING_SOLUTION_BY,$username);

      $tpl->addentry("BREADCRUMBS",array(
	"URL"=>$LINK_PREFIX."/viewbounty/id={$bounty['id']}",
	"NAME"=>$bounty['title']));

      $tpl->addentry("BREADCRUMBS",array(
	"URL"=>$LINK_PREFIX."/solutions/id={$bounty['id']}",
	"NAME"=>__(MSG_SOLUTIONS_LIST_CAPITAL)));

    }
  }
  else
  {
    $title=$short_title=$domain.' - '.__(MSG_ERROR);
    $tpl->FATAL_ERROR=__(MSG_SOLUTION_NOT_FOUND);
  }
}
else
{
  $tpl->FATAL_ERROR=__(MSG_NO_SOLUTION_GIVEN);
  $title=$short_title=$domain.' - '.__(MSG_ERROR);
}

$tpl->TITLE= $title;
$tpl->SHORT_TITLE= $short_title;
