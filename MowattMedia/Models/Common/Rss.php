<?php
/**
 * Quiz Model Class File. 
 * Controls access to kitcabco_MowattMedia.quizes
 *
 * @copyright 	2008 richardmowatt.com
 * @license		???
 * @version 	???
 * @link 		???
 * @since		Class available since initial Release
 * @package 	MowattMedia
 * @subpackage 	Model
 * @author 		Richard Mowatt <rmowatt@richardmowatt.com>
 */

class MowattMedia_Models_Common_Rss extends MowattMedia_Models_Common_BaseModel {
	
	protected $_tableName = 'rss';
	
	public function __construct() {
		parent::__construct();
	}
	
	public function getSingleRecord() {
		$sql = "SELECT * from {$this->_dbName}.{$this->_tableName} ORDER BY id DESC LIMIT 1;";
		return $this->getRecord($sql);
	}
	
}