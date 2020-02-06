<?php
function loader($class_name)
{
	$filename = str_replace("\\", "/", $class_name) . ".php";
	if(file_exists($filename))
	{
		require_once($filename);
		if(class_exists($class_name))
		{
			return TRUE;
		}
	}
	return FALSE;
}
spl_autoload_register("loader");

try{
	\core\Core::anonymiseDatabase('*\data.json', '*\blackL.json', 'BlackList');
}catch(Exception $e){
	echo $e->getMessage();
}