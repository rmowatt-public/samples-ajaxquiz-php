<?php
/**
 * QuizTracker Model Class File. 
 * Controls access to kitcabco_MowattMedia.quizTracker
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

class MowattMedia_Models_Quiz_QuizTrackerModel extends MowattMedia_Models_BaseModel {

	protected $_dbName = 'mowattme_quiz';
	protected $_tableName = 'quizTracker';

	public function __construct() {
		parent::__construct();

	}
}