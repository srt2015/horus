<?php
namespace droptables;
use \common\CommonFunctions as CommonFunctions;
use \common\CommonDatabaseTranslator as CommonDatabaseTranslator;
use \droptables\WhiteBlackListBase as WhiteBlackListBase;

class BlackList extends WhiteBlackListBase
{
	/**
	* @param array $table_list : name of tables
	* @param array $tables_for_anon (table_name=>array column_names)
	* @return array : the modified $tables_for_anon
	*/
	protected function dropTables(array $table_list, array $tables_for_anon)
	{
		/*global $DB;
		$dbman=$DB->get_manager();
		
		foreach($tables_list as $table=>$columns)
		{
			$Xtable=new \xmldb_table($table);
			$dbman->drop_table($Xtable);
		}*/
		foreach($table_list as $table=>$columns)
		{
			CommonDatabaseTranslator::dropTable($table);
		}
		
		return array_diff_key($tables_for_anon, $table_list);
	}
}
?>