<?php
/**
 * QuizResults Model Class File. 
 * Controls access to kitcabco_MowattMedia.quizResults
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

class MowattMedia_Models_Quiz_QuizResultsModel extends MowattMedia_Models_BaseModel {

	protected $_dbName = 'mowattme_quiz';
	protected $_tableName = 'quizResults';

	public function __construct() {
		parent::__construct();

	}
}