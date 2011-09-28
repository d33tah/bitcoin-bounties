<?php

class View {

private $view;
private $root_directory;

public function __construct($view,$root_directory) {
  $this->view = $view;
  $this->root_directory=$root_directory;
  $this->validate($view);
}

private function validate($view)
{
  $this->validate_length();
  $this->validate_regex();

  if(!( $this->viewfile_exists() || $this->modelfile_exists() ))
    throw new Exception("Neither viewfile nor modelfile exist.");
}

private function validate_length()
{
  if(strlen($this->view)<1)
    throw new Exception("The view name is too short (<1 characters).");
  if(strlen($this->view)>50)
    throw new Exception("The view name is too long (>50 characters).");
}

private function validate_regex()
{
  if(!preg_match("/^[a-zA-Z0._-]*$/",$this->view))
    throw new Exception ("The view name contains illegal characters.");
}

public function viewfile_exists()
{
  return file_exists($this->viewfile_name());
}

public function viewfile_name()
{
  return $this->root_directory.'views/'.$this->view.'.php';
}

public function modelfile_exists()
{
  return file_exists($this->modelfile_name());
}

public function modelfile_name()
{
  return $this->root_directory.'models/'.$this->view.'.php';
}

public function get_name()
{
  return $this->view;
}

}

?>