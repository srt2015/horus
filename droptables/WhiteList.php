<?php
namespace droptables;
use \common\CommonFunctions as CommonFunctions;
use \common\CommonDatabaseTranslator as CommonDatabaseTranslator;
use \droptables\WhiteBlackListBase as WhiteBlackListBase;

class WhiteList extends WhiteBlackListBase
{
	/**
	* @param array $table_list : name of tables
	* @param array $tables_for_anon (table_name=>array column_names)
	* @return array : the modified $tables_for_anon
	*/
	protected function dropTables(array $table_list, array $tables_for_anon)
	{
		/*$database_tables=CommonDatabaseTranslator::getTablesList();
		$tables_to_drop=array_diff($database_tables, array_keys($tables_list));
		
		foreach($tables_to_drop as $table)
		{
			CommonDatabaseTranslator::dropTable($table);
		}*/
		foreach(array_diff(CommonDatabaseTranslator::getTablesList(), array_keys($table_list)) as $table)
		{
			CommonDatabaseTranslator::dropTable($table);
		}
		
		return array_diff_key($tables_for_anon, array_diff_key($tables_for_anon, $table_list));
	}
}
?>