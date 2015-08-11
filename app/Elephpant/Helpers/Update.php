<?php
/*
 *	Author: Pan Otlet
 */
 
namespace Elephpant\Helpers;

class Update{
	private $feed;
	
	public function updateInfo(){
		
		$feed	=	file_get_contents('http://cmf.elephpant.pl/rss.xml');
		$func	=	new \SimpleXmlElement($feed);
		foreach($func->channel->item as $tablica) {
        	$array	.= [
        		'title'	=>	$tablica->title,
        		];
    	}
		return $array;
		
	}
}