<?php

class AccountDB {

var $conn;

public function __construct($login,$pass,$host,$port,$path) {
        require_once(ROOT.'/classes/jsonRPCClient.php');
	$this->conn = new jsonRPCClient
          (sprintf('http://%s:%s@%s:%s/%s',$login,$pass,$host,$port,$path));

}

public function create_address($label='')
{
  if($label)
    return $this->conn->getnewaddress($label);
  else
    return $this->conn->getnewaddress();
}

public function balance_prefix($prefix)
{
  $ret = 0;
  $result = $this->conn->listaccounts();
  //print_r($result);
  foreach($result as $key => $value)
    if(strpos($key,$prefix)===0)
      $ret+=round($value,8)*1e8;
  return $ret/pow(10,8);
}

public function balance_address($address)
{
  return $this->conn->getbalance($address);
}


public function sendtoaddress($address,$amount)
{
  return $this->conn->sendtoaddress($address,$amount);
}

}
