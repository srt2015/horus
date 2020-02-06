<?php
namespace dbmanipulation;
use \common\CommonFunctions as CommonFunctions;
use \common\Keccak as Keccak;

class DataManipulation
{
	/**
	* @param array $records : result set of CommonDatabaseTranslator::getRecords
	* @param array $columns : column names of the table of $records
	* @return array
	*/
	public static function hashColumnValue(array $records, array $columns)
	{
		$salt=CommonFunctions::generateSalt();
		
		//do not check is $records empty because if it is that is not an Exception!
		if(empty($columns)){throw new \Exception("DataManipulation.hashColumnValue::TABLE_COLUMNS_NOT_EXIST_IN_JSON");}
		
		foreach($records as $key=>$obj)
		{
			foreach($columns as $column)
			{
				$obj->$column=Keccak::hash($obj->$column.$salt, 256);
			}
		}
		
		return $records;
	}
}
?>