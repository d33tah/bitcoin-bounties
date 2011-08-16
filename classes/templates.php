<?php
//handles replacing the %TAG% with user-provided text
class Template {

private $body;
private $tags=array();
private $blocks=array();

public function __construct($body) {
	$this->body=$body;
}

public function replace($tag,$with)
{
	$this->tags[$tag]=$with;
}

public function addentry($entry,$array)
{
	if(!array_key_exists($entry,$this->blocks))
		$this->blocks[$entry]=array();
	array_push($this->blocks[$entry],$array);
}

public function print_body()
{
	foreach($this->tags as $tag=>$with)
	{
		$this->body=str_replace("%$tag%",$with,$this->body);
	}
	
	//TODO: what if there's a global variable inside the block?
	foreach($this->blocks as $name=>$data)
	{
		$blockhtml=get_string_between($this->body,"%_BLOCKSTART_$name%",
			"%_BLOCKEND_$name%");
		
		foreach($data as $entry)
		{
			$ourentry=$blockhtml;
			
			foreach($entry as $tag=>$with)
			{
				$ourentry=str_replace("%_BLOCK_$tag%",$with,$ourentry);
			}
			
			$this->body=str_replace("%_BLOCKEND_$name%",
				"$ourentry%_BLOCKEND_$name%",$this->body);
		}
		
		$this->body=str_replace("%_BLOCKSTART_$name%","",$this->body);
		$this->body=str_replace($blockhtml,"",$this->body);
		$this->body=str_replace("%_BLOCKEND_$name%","",$this->body);
	}
	
	$this->body=str_replace("%%","%",$this->body);
	print $this->body;
}

}