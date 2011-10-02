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

public function get_solutions($bounty)
{
  $ret = array();
  $id_safe = mysql_real_escape_string($bounty["id"]);
  $sql = "SELECT * FROM `solutions` WHERE `bounty_id`='".$id_safe."'";
  $res = mysql_query($sql);
  if($res)
    while($row=mysql_fetch_assoc($res))
      array_push($ret,$row);
  return $ret;
}

public function get_solution($id)
{
  $ret = array();
  $id_safe=mysql_real_escape_string($id);
  $sql = "SELECT * FROM `solutions` WHERE `id`='".$id_safe."'";
  $res = mysql_query($sql);
  if($res)
    $ret=mysql_fetch_assoc($res);
  return $ret;
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

public function getvotes_solution($solution_id,$accounts_db)
{
  $solutionid_safe=mysql_real_escape_string($solution_id);
  $solution=$this->get_solution($solutionid_safe);
  $bounty=$this->get_by_id($solution['bounty_id']);
  $total=$accounts_db->balance_prefix('bounty_'.$bounty['id']);
  $total_anonymous=$accounts_db->balance_address($bounty['address']);
  $total_by_registered=$total-$total_anonymous;
  $total_voted=0;
  if($total_by_registered)
  {
    $sql = "SELECT * FROM `votes` WHERE `solution_id`='".$solutionid_safe."'";
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

  if ($total_voted)
    return $total_voted/$total_by_registered*100;
  else
    return 0;
}

public function voteup_solution($solution_id,$accounts_db,$user_db,$user_id)
{
  global $LINK_PREFIX, $domain, $mail;

  $solutionid_safe=mysql_real_escape_string($solution_id);
  $uid_safe=mysql_real_escape_string($user_id);
  $solution=$this->get_solution($solutionid_safe);
  $bounty=$this->get_by_id($solution['bounty_id']);
  $sql = "SELECT * FROM `votes` WHERE `solution_id`='".$solutionid_safe."' AND 
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

  $sql = "INSERT INTO `votes` (`id`,`solution_id`,`user_id`,`vote_time`) VALUES
    ('','".$solutionid_safe."','".$uid_safe."','".time()."')";
  mysql_query($sql);

  if($this->getvotes_solution($solutionid_safe,$accounts_db)>30)
  {
    $total=$accounts_db->balance_prefix('bounty_'.$bounty['id']);
    $fee=$total*0.01;
    
    $solution=$this->get_solution($solutionid_safe);
    $receiving_user=$user_db->get_by_id($solution['user_id']);

    $value = sprintf("%.8f",$total-$fee);
    $bounty_gathered_mail=__(MSG_BOUNTY_GATHERED,
      $receiving_user['login'],$bounty['id'],$value);
    $mail->Body = $bounty_gathered_mail;
    $mail->Subject = __(MSG_BOUNTY_GATHERED_TITLE);
    $mail->AddAddress($receiving_user['mail'],$receiving_user['login']);

    $result = $mail->Send();
    $mail->ClearAddresses();
    $mail->ClearAttachments();

  }
  return true;
}

public function votedown_solution($solution_id,$user_id)
{
  $solutionid_safe=mysql_real_escape_string($solution_id);
  $uid_safe=mysql_real_escape_string($user_id);
  $sql = "DELETE FROM `votes` WHERE `solution_id`='".$solutionid_safe."' AND 
    `user_id`='".$uid_safe."'";
  $res=mysql_query($sql);
  return true;
}

public function set_locked($bounty)
{
  $safe_id=mysql_real_escape_string($bounty['id']);
  mysql_query("UPDATE `bounties` SET `state`='1' WHERE `id`='".$safe_id."'");
}

private function check_locked($bountyid_safe)
{
  $sql='SELECT * FROM `bounties` WHERE `id`="'.$bountyid_safe.'" 
    AND `state` & "1"';
  if($res = mysql_query($sql))
    $error=mysql_num_rows($res)>0;
  else
    $error=false;
  
  if ($error)
  {
    $this->bounty_locked = true;
    $this->errors++;
    return true;
  }
  else
  {
    return false;
  }
}

public $title_too_short;
public $title_too_long;
public $title_regex;
public $title_exists;
public $desc_too_short;
public $desc_too_long;
public $desc_regex;
public $errors;
public $bounty_locked;

private function reset_flags()
{
  $this->title_too_short = false;
  $this->title_too_long = false;
  $this->title_regex = false;
  $this->title_exists = false;
  $this->desc_too_short = false;
  $this->desc_too_long = false;
  $this->desc_regex = false;
  $this->bounty_locked = false;
  $this->errors = 0;
}

private function check_title_too_short($title)
{
  global $title_min_length;

  if (strlen($title)<$title_min_length)
  {
    $this->title_too_short = true;
    $this->errors++;
    return true;
  }
  else
  {
    return false;
  }
}

private function check_title_too_long($title)
{
  global $title_max_length;

  if (strlen($title)>$title_max_length)
  {
    $this->title_too_short = true;
    $this->errors++;
    return true;
  }
  else
  {
    return false;
  }
}

private function check_title_regex($title)
{
  //TODO: anything besides < and > ? perhaps not even that?
  if (!preg_match('/^[^<>]*$/',$title))
  {
    $this->title_regex = true;
    $this->errors++;
    return true;
  }
  else
  {
    return false;
  }
}

private function check_desc_too_short($description)
{
  global $desc_min_length;

  if (strlen($description)<$desc_min_length)
  {
    $this->desc_too_short = true;
    $this->errors++;
    return true;
  }
  else
  {
    return false;
  }
}

private function check_desc_too_long($description)
{
  global $desc_max_length;

  if (strlen($description)>$desc_max_length)
  {
    $this->desc_too_long = true;
    $this->errors++;
    return true;
  }
  else
  {
    return false;
  }
}

private function check_desc_regex($description)
{
  //TODO: it's currently just a placeholder.
  if (false)
  {
    $this->desc_regex = true;
    $this->errors++;
    return true;
  }
  else
  {
    return false;
  }
}

private function check_title_exists($title_safe)
{
  $sql='SELECT * FROM `bounties` WHERE `title`="'.$title_safe.'"';
  if($res = mysql_query($sql))
    $error=mysql_num_rows($res)>0;
  else
    $error=false;
  
  if ($error)
  {
    $this->title_exists = true;
    $this->errors++;
    return true;
  }
  else
  {
    return false;
  }
}

public function get_solution_user_voted($bounty_id,$user_id)
{
  $bountyid_safe=mysql_real_escape_string($bounty_id);
  $uid_safe=mysql_real_escape_string($user_id);
  $sql = "SELECT * FROM `solutions`,`votes` WHERE   `votes`.`user_id`=
    `solutions`.`user_id` AND  `votes`.`user_id`='".$uid_safe.
    "' AND `bounty_id`='".$bountyid_safe."'";
  $res = mysql_query($sql);
  if($res)
  {
    $row = mysql_fetch_assoc($res);
    if($row)
    {
      return $row['solution_id'];
    }
  }
  return 0;
}

public function add_bounty($title,$desc,$uid,$accounts_db)
{
  $title_safe=mysql_real_escape_string(htmlentities($title));
  $desc_safe=mysql_real_escape_string(htmlentities($desc));
  $uid_safe=mysql_real_escape_string($uid);

  $this->reset_flags();
  $this->check_title_too_short($title);
  $this->check_title_too_short($title);
  $this->check_title_regex($title);
  $this->check_title_exists($title_safe);
  $this->check_desc_too_short($desc);
  $this->check_desc_too_long($desc);
  $this->check_desc_regex($desc);

  if($this->errors>0)
    return false;

  $sql = "INSERT INTO `bounties` (`id`,`title`,`user_id`,`description`,
    `bitcoins`,`satoshi`, `address`, `state`) VALUES 
      ('','".$title_safe."','".$uid_safe."','".$desc_safe."','0','0','','0')";
  mysql_query($sql);
  echo mysql_error();
  if($newid = mysql_insert_id())
  {
    $new_address = $accounts_db->create_address('bounty_'.$newid);
    $sql=mysql_query("UPDATE `bounties` SET `address`='$new_address' WHERE
      `id`='$newid'");
    mysql_query($sql);
    return $newid;
  }
}

public function add_solution($bounty_id,$uid,$desc,$filename)
{
  $bountyid_safe=mysql_real_escape_string($bounty_id);
  $uid_safe=mysql_real_escape_string($uid);
  $desc_safe=mysql_real_escape_string($desc);
  $filename_safe=mysql_real_escape_string($filename);

  $this->reset_flags();
  $this->check_desc_too_short($desc);
  $this->check_desc_too_long($desc);
  $this->check_desc_regex($desc);
  $this->check_locked($bountyid_safe);

  if($this->errors>0)
    return false;

  $sql = "INSERT INTO `solutions` (`id`,`bounty_id`,`user_id`,`description`,
    `filename`) VALUES ('','".$bountyid_safe."','".$uid_safe.
    "','".$desc_safe."','".$filename_safe."')";
  mysql_query($sql);
  echo mysql_error();
  return mysql_insert_id();
}


}