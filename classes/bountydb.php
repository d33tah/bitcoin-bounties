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

public function add_bounty($title,$desc,$uid)
{
  $title_safe=mysql_real_escape_string($title);
  $desc_safe=mysql_real_escape_string($desc);
  $uid_safe=mysql_real_escape_string($uid);
  $sql = "INSERT INTO `bounties` (`id`,`title`,`user_id`,`description`,
    `bitcoins`,`satoshi`) VALUES ('','".$title_safe."','".$uid_safe.
    "','".$desc_safe."','0','0')";
  mysql_query($sql);
  echo mysql_error();
  return mysql_insert_id();
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


}