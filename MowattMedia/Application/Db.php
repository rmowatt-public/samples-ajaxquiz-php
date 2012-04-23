<?php
/**
 * DB Class File. 
 *
 * Creates a single instance of db connection so were not wasting resources
 *
 * @copyright 	2008 richardmowatt.com
 * @license		???
 * @version 	???
 * @link 		???
 * @since		Class available since initial Release
 * @package 	MowattMedia
 * @subpackage 	Application
 * @author 		Richard Mowatt <rmowatt@richardmowatt.com>
 */


class MowattMedia_Application_Db {

	private static $dbInstance = null;
	protected $_host = 'localhost';
	protected $_userName = '';
	protected $_password = '';
	protected $_dbName = 'mowattme_quiz';
	protected $_profiler = true;
	protected $_tableName;
	protected $_conn;

	private function __construct($db) {
		$this->_conn = Zend_Db::factory('Pdo_Mysql',
		array( 'host' => $this->_host,
		'username' => $this->_userName,
		'password' => $this->_password,
		'dbname' => $db,
		'profiler' => $this->_profiler));
	}

	static public function getInstance($db) {
		if(!self::$dbInstance || !in_array($db, self::$dbInstance)) {
			self::$dbInstance[$db] = new MowattMedia_Application_Db($db);
		}
		return self::$dbInstance[$db];
	}
	
	public function getConnection() {
		return $this->_conn;
	}

}
