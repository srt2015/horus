<?php
/**
* In this class, third party database functions are changed to internal functions to prevent dependent classes modifications.
* To change database driver, modify these functions only! Please, be careful that do not modify the behaviours of functions.
*/
namespace common;
require('*\config.php');

class CommonDatabaseTranslator
{
	/**
	* @param string $table_name
	* @return array of objects
	*/
	public static function getRecords(string $table_name)
	{
		global $DB;
		return $DB->get_records($table_name);
	}
	
	/**
	* @param string $table_name
	* @return void
	*/
	public static function deleteAllRecords(string $table_name)
	{
		global $DB;
		$DB->delete_records($table_name);
	}
	
	/**
	* @param string $table_name
	* @param array $records array of objects (for example, result set of the getRecords)
	* @return void
	*/
	public static function writeBackRecords(string $table_name, array $records)
	{
		global $DB;
		$DB->insert_records($table_name, $records);
	}
	
	/**
	* @param string $table_name
	* @param string $column_name
	* @param int $size length of character type
	* @return void
	*/
	public static function changeFieldType(string $table_name, string $column_name, int $size)
	{
		global $DB;
		$dbman=$DB->get_manager();
		
		$Xfield=new \xmldb_field($column_name);
		$Xfield->set_attributes(XMLDB_TYPE_CHAR, $size);
		
		$dbman->change_field_type(new \xmldb_table($table_name), $Xfield);
	}
	
	/**
	* @return array list of all DB tables
	*/
	public static function getTablesList()
	{
		global $DB;
		return $DB->get_tables();
	}
	
	/**
	* @param string $table_name
	* @return void
	*/
	public static function dropTable(string $table_name)
	{
		global $DB;
		$dbman=$DB->get_manager();
		
		$dbman->drop_table(new \xmldb_table($table_name));
	}
}
?>