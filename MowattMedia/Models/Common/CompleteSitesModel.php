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

class MowattMedia_Models_Common_CompleteSitesModel extends MowattMedia_Models_BaseModel {
	
	protected $_tableName = 'completeSites';
	
	public function __construct() {
		parent::__construct();
	}
	
	public function getAll(){
		$sql = "SELECT * from {$this->_dbName}.{$this->_tableName} w ORDER BY id ASC";
		return $this->getRecords($sql);
	}
}