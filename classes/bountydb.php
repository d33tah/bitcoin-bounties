<?php

class BountyDB {

public function __construct() {
	assume_database();
}

public function get_bounties()
{
  $ret = array();
  $sql = "SELECT * FROM `bounties`";
  $res = mysql_query($sql);
  while($row=mysql_fetch_assoc($res))
  {
    array_push($ret,$row);
  }
  return $ret;
}

public function get_by_id($id)
{
  $ret = array();
  $id_safe=mysql_real_escape_string($id);
  $sql = "SELECT * FROM `bounties` WHERE `id`='".$id_safe."'";
  $res = mysql_query($sql);
  if($res)
    $ret=mysql_fetch_assoc($res);
  return $ret;
}

public function get_submissions($bounty)
{
  $ret = array();
  $id_safe = mysql_real_escape_string($bounty["id"]);
  $sql = "SELECT * FROM `submissions` WHERE `bounty_id`='".$id_safe."'";
  $res = mysql_query($sql);
  if($res)
    while($row=mysql_fetch_assoc($res))
      array_push($ret,$row);
  return $ret;
}

public function add_bounty($title,$desc,$uid,$accounts_db)
{
  $title_safe=mysql_real_escape_string($title);
  $desc_safe=mysql_real_escape_string($desc);
  $uid_safe=mysql_real_escape_string($uid);
  $sql = "INSERT INTO `bounties` (`id`,`title`,`user_id`,`description`,
    `bitcoins`,`satoshi`, `address`) VALUES ('','".$title_safe."','".$uid_safe.
    "','".$desc_safe."','0','0','')";
  mysql_query($sql);
  echo mysql_error();
  if(mysql_insert_id())
  {
    $new_address = $accounts_db->create_address('bounty_'.mysql_insert_id());
    $sql=mysql_query("UPDATE `bounties` SET `address`='$new_address'");
    mysql_query($sql);
  }
}

public function get_submission($id)
{
  $ret = array();
  $id_safe=mysql_real_escape_string($id);
  $sql = "SELECT * FROM `submissions` WHERE `id`='".$id_safe."'";
  $res = mysql_query($sql);
  if($res)
    $ret=mysql_fetch_assoc($res);
  return $ret;
}

public function add_submission($bounty_id,$uid,$desc,$filename)
{
  $bountyid_safe=mysql_real_escape_string($bounty_id);
  $uid_safe=mysql_real_escape_string($uid);
  $desc_safe=mysql_real_escape_string($desc);
  $filename_safe=mysql_real_escape_string($filename);
  $sql = "INSERT INTO `submissions` (`id`,`bounty_id`,`user_id`,`description`,
    `filename`) VALUES ('','".$bountyid_safe."','".$uid_safe.
    "','".$desc_safe."','".$filename_safe."')";
  mysql_query($sql);
  echo mysql_error();
  return mysql_insert_id();
}


public function get_address($bounty,$user_id, $accounts_db)
{
  $id_safe=mysql_real_escape_string($bounty['id']);
  $uid_safe=mysql_real_escape_string($user_id);
  $sql = "SELECT * FROM `accounts` WHERE `bounty_id`='".$id_safe."' AND
    `user_id`='".$uid_safe."'";
  if($res = mysql_query($sql))
  {
    if($ret=mysql_fetch_assoc($res))
    {
      return $ret['address'];
    }
  }

  $new_address = $accounts_db->create_address('bounty_'.$id_safe.'_'
    .$uid_safe);
  $new_address_safe=mysql_real_escape_string($new_address);
  $sql = "INSERT INTO `accounts` (`bounty_id`,`user_id`,`address`) VALUES (
    '$id_safe', '$uid_safe', '$new_address_safe')";
  mysql_query($sql);
  echo mysql_error();
  return $new_address;
}

public function getvotes_commit($commit_id,$accounts_db)
{
  $commitid_safe=mysql_real_escape_string($commit_id);
  $submission=$this->get_submission($commitid_safe);
  $bounty=$this->get_by_id($submission['bounty_id']);
  $total=$accounts_db->balance_prefix('bounty_'.$bounty['id']);
  $total_anonymous=$accounts_db->balance_address($bounty['address']);
  $total_by_registered=$total-$total_anonymous;
  if($total_by_registered)
  {
    $total_voted=0;
    $sql = "SELECT * FROM `votes` WHERE `commit_id`='".$commitid_safe."'";
    $res = mysql_query($sql);
    if($res)
    {
      while($row = mysql_fetch_assoc($res))
      {
	$total_voted+=$accounts_db->balance_address(
          'bounty_'.$bounty['id'].'_'.$row['user_id']);
      }
    }
  }

  if (false)
  print "total=$total, total_anonymous=$total_anonymous,
   total_by_registered=$total_by_registered, total_voted=$total_voted\n<br/>";

  return $total_voted/$total_by_registered*100;
}

public function voteup_commit($commit_id,$accounts_db,$user_db,$user_id)
{
  global $messages, $LINK_PREFIX, $domain, $mail;

  $commitid_safe=mysql_real_escape_string($commit_id);
  $uid_safe=mysql_real_escape_string($user_id);
  $submission=$this->get_submission($commitid_safe);
  $bounty=$this->get_by_id($submission['bounty_id']);
  $sql = "SELECT * FROM `votes` WHERE `commit_id`='".$commitid_safe."' AND 
    `user_id`='".$uid_safe."'";
  $res=mysql_query($sql);
  echo mysql_error();
  if($res)
  {
    $row=mysql_fetch_assoc($res);
    if($row)
    {
      return false;
    }
  }

  $sql = "INSERT INTO `votes` (`id`,`commit_id`,`user_id`,`vote_time`) VALUES
    ('','".$commitid_safe."','".$uid_safe."','".time()."')";
  mysql_query($sql);

  if($this->getvotes_commit($commitid_safe,$accounts_db)>30)
  {
    $total=$accounts_db->balance_prefix('bounty_'.$bounty['id']);
    $fee=$total*0.01;
    
    $commit=$this->get_submission($commitid_safe);
    $receiving_user=$user_db->get_by_id($commit['user_id']);

    $bounty_gathered_mail=new Template($messages[MSG_BOUNTY_GATHERED]);
    $bounty_gathered_mail->replace('DOMAIN',$domain);
    $bounty_gathered_mail->replace('USERNAME',$receiving_user['login']);
    $bounty_gathered_mail->replace('BOUNTYID',$bounty['id']);
    $bounty_gathered_mail->replace('VALUE',sprintf("%.8f",$total-$fee));
    $bounty_gathered_mail->replace('LINK_PREFIX',$LINK_PREFIX);

    $mail->Body = $bounty_gathered_mail->get_body();
    $mail->Subject = $messages[MSG_BOUNTY_GATHERED_TITLE];
    $mail->AddAddress($receiving_user['mail'],$receiving_user['login']);

    $result = $mail->Send();
    $mail->ClearAddresses();
    $mail->ClearAttachments();

  }
  return true;
}

}