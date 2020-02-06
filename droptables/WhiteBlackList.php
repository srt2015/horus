<?php
namespace droptables;
use \droptables\WhiteBlackListBase as WhiteBlackListBase;

class WhiteBlackList
{
	private $white_black_list;

	public function __construct(WhiteBlackListBase $instance)
	{
		$this->white_black_list=$instance;
	}

	/**
	* @param array $table_list : name of tables
	* @param array $tables_for_anon (table_name=>array column_names)
	* @return detailed in the extending class
	*/
	public function dropTables(array $table_list, array $tables_for_anon)
	{
		return $this->white_black_list->callDropTables($table_list, $tables_for_anon);
	}
}
?>