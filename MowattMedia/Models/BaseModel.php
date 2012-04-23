<?php
/**
 * Base Model Class File. 
 * All Model Classess Should Extend this class.
 * Provides controlled access to the database
 *
 * @copyright 	2008 richardmowatt.com
 * @license		???
 * @version 	???
 * @link 		???
 * @since		Class available since initial Release
 * @package 	MowattMedia
 * @subpackage 	Controller
 * @author 		Richard Mowatt <rmowatt@richardmowatt.com>
 */

class MowattMedia_Models_BaseModel {

	protected $dbInstance;
	protected $_dbName = 'mowattme_common';
	protected $_tableName;
	protected $_colNames;
	private $_conn;

	public function __construct() {
		$db = MowattMedia_Application_Db::getInstance($this->_dbName);
		$this->_conn = $db->getConnection();
		$this->_colNames = array_keys($this->_conn->describeTable($this->_tableName));
	}

	/**
	 * get a single record from the db.table
	 * decodes any special characters
	 * 
	 * @return array
	 */

	protected function getRecord($sql) {
		$values =  $this->_conn->fetchRow($sql);
		$returnValues = array();
		if(is_array($values)) {
			foreach ($values as $key=>$value) {
				$returnValues[$key] = htmlspecialchars_decode($value);
			}
		}
		return $returnValues;
	}

	/**
	 * get a multipls records from the db.table
	 * decodes any special characters
	 * 
	 * @return array
	 */

	protected function getRecords($sql) {
		$values =  $this->_conn->fetchAll($sql);
		$returnValues = array();
		if(is_array($values)) {
			foreach ($values as $key=>$value) {
				if(is_array($value)) {
					foreach ($value as $key1=>$value1) {
						$returnValues[$key][$key1] = htmlspecialchars_decode($value1);
					}
				}
			}
		}
		return $returnValues;
	}

	/**
	 * Final step in insertion
	 *
	 * @param array $args
	 * @returnmixed int | boolean
	 */
	
	protected function insert($args) {
		$args = $this->_clean($args);
		if($this->_conn->insert($this->_dbName . '.' . $this->_tableName, $args)) {
			return $this->_conn->lastInsertId();
		}
		return false;
	}

	/**
	 * get a single record from the db.table using specified keys
	 * used to create the query that will eventually be passed  to $this->getRecord
	 * 
	 * @return array
	 */

	public function getRecordByKeys($keys){
		$where = $this->_makeWhere($keys, 'w');
		//print $where; exit;
		$sql = "SELECT * from {$this->_dbName}.{$this->_tableName} w WHERE {$where}";
		return $this->getRecord($sql);
	}

	/**
	 * get multiple records from the db.table using specified keys
	 * used to create the query that will eventually be passed  to $this->getRecords
	 * 
	 * @return array
	 */

	public function getRecordsByKeys($keys){
		$where = $this->_makeWhere($keys, 'w');
		$sql = "SELECT * from {$this->_dbName}.{$this->_tableName} w WHERE {$where}";
		return $this->getRecords($sql);
	}

	/**
	 * get all records from the db.table 
	 * used to create the query that will eventually be passed  to $this->getRecords
	 * 
	 * @return array
	 */

	public function getAll(){
		$sql = "SELECT * from {$this->_dbName}.{$this->_tableName} w ";
		return $this->getRecords($sql);
	}
	
	/**
	 * returns an array to be used with remove function
	 * 
	 * @return array
	 */

	protected function _deleteString($args) {
		$returnSArray = array();
		$args = $this->_clean($args);
		foreach ($args as $key=>$value) {
			$returnSArray[] = "{$key} =  '{$value}'";
		}
		return $returnSArray;
	}

	/**
	 * Creates a where string using an associative array
	 * 
	 * @return string
	 */

	protected function _makeWhere($keys, $tableId) {
		$where = '';
		$keys = $this->_clean($keys);
		foreach ($keys as $key=>$value) {
			if($tableId){$where .= "$tableId.";}
			$where .= "{$key} = '{$value}' AND ";
		}
		$where = substr($where, 0, -4);
		return $where;
	}

	/**
	 * makes sure all argument keys actually exist in table 
	 * then cleans the values to avoid scripting attacks
	 * 
	 * @return array
	 */

	protected function _clean($args) {
		$returnArray = array();
		foreach ($args as $key=>$value) {
			if(in_array($key, $this->_colNames)){
				$returnArray[$key] = stripslashes(htmlentities($value));
			}
		}
		return $returnArray;
	}

	/**
	 * Inserts record into db.table
	 * 
	 * @return mixed int | boolean
	 */

	public function insertRecord($args) {
		$keys = array();
		$values = array();
		$insert = array();
		foreach ($args as $key=>$value) {
			if(in_array($key, $this->_colNames)){
				$insert[$key] = $value;
			}
		}
		return $this->insert($insert);
	}

	/**
	 * removes record from tablle
	 * 
	 * @return boolean
	 */

	public function remove($args) {
		return $this->delete($this->_deleteString($args));
	}

	/**
	 * updates record in db.table
	 * 
	 * @return boolean
	 */

	public function edit($keys, $args) {
		return $this->update($keys, $args);
	}
}