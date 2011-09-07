<?php
//handles replacing the %TAG% with user-provided text
class Template {

private $filename;
private $tags=array();

public function __construct($filename) {
  $this->filename = $filename;
}

public function replace($tag,$with)
{
  $this->tags[$tag]=$with;
}

public function addentry($entry,$array)
{
  if(!isset($this->tags[$entry]))
    $this->tags[$entry]=array();
  array_push($this->tags[$entry],$array);
}

public function print_body()
{
  extract($this->tags);
  include($this->filename);
}

}
