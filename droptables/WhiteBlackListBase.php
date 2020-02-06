<?php
namespace droptables;

abstract class WhiteBlackListBase
{
	/**
	* @param array $table_list : name of tables
	* @param array $tables_for_anon (table_name=>array column_names)
	* @return detailed in the extending class
	*/
	abstract protected function dropTables(array $table_list, array $tables_for_anon);
	final public function callDropTables(array $table_list, array $tables_for_anon)
	{
		return $this->dropTables($table_list, $tables_for_anon);
	}
}
?>