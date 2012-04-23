<?php
/**
 * Quiz Question Component Class File
 *
 * @copyright 	2008 richardmowatt.com
 * @license		???
 * @version 	???
 * @link 		???
 * @since		Class available since initial Release
 * @package 	MowattMedia
 * @subpackage 	Component
 * @author 		Richard Mowatt <rmowatt@richardmowatt.com>
 */

	class MowattMedia_Components_QuizQuestion {
		
		private $id;
		private $question;
		private $answers = array();
		
		public function __construct($id = '', $question = '', $answers = array()) {
			$this->id = $id;
			$this->question = $question;
			$this->answers = $answers;
		}
		
		/**
		 * returnd the id of the question as assigtned in kitcab_MowattMedia.quizQuestions
		 *
		 * @return int
		 */
		
		public function getId() {
			return $this->id;
		}
		
		/**
		 * set the questions
		 *
		 * @param string $q
		 * @return void
		 */
		
		public function setQuestion($q) {
			$this->question = $q;
		}
		
		/**
		 * return current value of question
		 *
		 * @return string
		 */
		
		public function getQuestion() {
			return $this->question;
		}
		
		/**
		 * Add an answer to the answer array
		 *
		 * @param array $answer
		 * @return void
		 */
		
		public function addAnswer($answer) {
			$this->answers[] = $answer;
		}
		
		/**
		 * return current array of answers to question
		 *
		 * @return array
		 */
		
		public function getAnswers() {
			return $this->answers;
		}
		
		
	}