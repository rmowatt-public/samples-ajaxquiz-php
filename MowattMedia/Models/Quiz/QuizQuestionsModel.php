<?php
/**
 * QuizQuestions Model Class File. 
 * Controls access to kitcabco_MowattMedia.quizQuestions
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

class MowattMedia_Models_Quiz_QuizQuestionsModel extends MowattMedia_Models_BaseModel {

	protected $_dbName = 'mowattme_quiz';
	protected $_tableName = 'quizQuestions';
		
	public function __construct() {
		parent::__construct();
	}

	/**
	 * get any record
	 *
	 * @return array
	 */
	
	public function getSingleRecord() {
		$sql = "SELECT * from {$this->_dbName}.{$this->_tableName} ORDER BY id DESC LIMIT 1;";
		return $this->getRecord($sql);
	}
	
	/**
	 * get a record specifically by Id
	 *
	 * @param int $id
	 * @return array
	 */
	
	public function getRecordById($id) {
		$sql = "SELECT * from {$this->_dbName}.{$this->_tableName} q WHERE q.id = {$id}";
		return $this->getSingleRow($sql);
	}
}