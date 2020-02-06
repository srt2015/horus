<?php
namespace common;

class CommonFunctions
{
	/**
	* @param string $file_name
	* @return JSON in associative arrays : the content of given file
	*/
	public static function getJSONContent(string $file_name)
	{
		if(file_exists($file_name))
		{
			$file_content=file_get_contents($file_name);
		}
		else
		{
			throw new \Exception("CommonFunctions::JSON_NOT_EXSIT");
		}
		
		if(empty($json=json_decode($file_content, true))){throw new \Exception("CommonFunctions::JSON_EMPTY");}
		
		return $json;
	}
	
	/**
	* @param int $size length of the random string that should be returned, default 512
	* @return string
	*/
	public static function generateSalt(int $size=512)
	{
		return bin2hex(random_bytes($size));
	}
}
?>