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

class MowattMedia_Models_Quiz_QuizModel extends MowattMedia_Models_BaseModel {

	protected $_tableName = 'quizes';
	protected $_dbName = 'mowattme_quiz';
	
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Randomly select a quiz to show client
	 *
	 * @return array
	 */
	
	public function getRandomQuiz() {
		$sql = "SELECT * from {$this->_dbName}.{$this->_tableName} ORDER BY RAND()";
		return $this->getRecord($sql);
	}
}