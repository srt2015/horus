<?php
namespace dbmanipulation;
use \common\CommonFunctions as CommonFunctions;
use \common\CommonDatabaseTranslator as CommonDatabaseTranslator;

class SchemaManipulation
{
	/**
	* @param array $tables_for_anon (table_name=>array column_names)
	* @param int $size default 64 for sha3-256 : length of character type
	* @return void
	*/
	public static function changeColumnsTypeForHash(array $tables_for_anon, int $size=64)
	{
		foreach($tables_for_anon as $table=>$columns)
		{
			if(empty($columns)){throw new \Exception("SchemaManipulation.changeColumnsTypeForHash::TABLE_COLUMNS_NOT_EXIST_IN_JSON");}
			
			foreach($columns as $column)
			{
				CommonDatabaseTranslator::changeFieldType($table, $column, $size);
			}
		}
	}
}
?>