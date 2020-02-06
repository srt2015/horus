<?php
namespace core;
use \common\CommonFunctions as CommonFunctions;
use \common\CommonDatabaseTranslator as CommonDatabaseTranslator;
use \dbmanipulation\SchemaManipulation as SchemaManipulation;
use \dbmanipulation\DataManipulation as DataManipulation;

class Core
{
	/**
	* @param string $file_name : name of the file that describes tables-attributes for anonymisation
	* @param string string $file_name2 default null : name of the file that describes tables for the method WhiteBlackListBase::dropTables
	* @param string string $list_type_class_name default null : name of class that extends WhiteBlackListBase
	* @return void
	*/
	public static function anonymiseDatabase(string $file_name, string $file_name2=null, string $list_type_class_name=null)
	{
		try
		{
			$tables_for_anon=CommonFunctions::getJSONContent($file_name);
			
			//WhiteBlackListBase process
			if(!is_null($file_name2) and !is_null($list_type_class_name))
			{
				$class_name="\\droptables\\".$list_type_class_name;
				$wbl_instance=new \droptables\WhiteBlackList(new $class_name());
				$tables_for_anon=$wbl_instance->dropTables(CommonFunctions::getJSONContent($file_name2), $tables_for_anon);
			}
			
			foreach($tables_for_anon as $table=>$columns)
			{
				$records=CommonDatabaseTranslator::getRecords($table);
				CommonDatabaseTranslator::deleteAllRecords($table);
				SchemaManipulation::changeColumnsTypeForHash(array($table=>$columns));
				CommonDatabaseTranslator::writeBackRecords($table, DataManipulation::hashColumnValue($records, $columns));
			}
		}catch(Exception $e){
			throw $e;
		}
	}
}
?>