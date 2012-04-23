<?php
/**
 * Quiz Component Class File
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

class MowattMedia_Components_Quiz {

	protected $quizesModel;
	protected $quizQuestionsModel;
	protected $quizAnswersModel;
	protected $quizResultsModel;
	protected $used = array();
	protected $available = array();
	protected $totalQuestions;
	protected $correct = 0;
	protected $description;
	protected $id;


	public function __construct() {
		$this->quizesModel = new MowattMedia_Models_Quiz_QuizModel();
		$this->quizAnswersModel = new MowattMedia_Models_Quiz_QuizAnswersModel();
		$this->quizQuestionsModel= new MowattMedia_Models_Quiz_QuizQuestionsModel();
		$this->quizResultsModel = new MowattMedia_Models_Quiz_QuizResultsModel();
		
	}

	/**
	 * Populates the quiz component with a series of questions and possible answers
	 *
	 * @return void
	 */
	
	public function populate() {
		$quiz = $this->quizesModel->getRandomQuiz();
		$this->id = $quiz['id'];
		$this->description = $quiz['description'];
		$questions = $this->quizQuestionsModel->getRecordsByKeys(array('quizId'=>$quiz['id']));
		if(is_array($questions)) {
			shuffle($questions);
			foreach (array_reverse($questions) as $question) {
				$answers = $this->quizAnswersModel->getRecordsByKeys(array('questionId'=>$question['id']));
				if(is_array($answers)) {
					shuffle($answers);
					$quizQuestion = new MowattMedia_Components_QuizQuestion($question['id'], ucwords($question['question']), $answers);
					$this->available[$question['id']] = $quizQuestion;
				}
			}
			$this->totalQuestions = count($this->available);
		}
	}
	
	/**
	 * Returns the id of the quiz
	 *
	 * @return int
	 */

	public function getId() {
		return $this->id;
	}
	
	/**
	 * Returns the next question in series
	 *
	 * @return mixed MowattMedia_Components_QuizQuestion | boolean
	 */
	
	public function getNextQuestion() {
		if(count($this->available) < 1) {
			return false;
		}
		$question = array_pop($this->available);
		$this->used[] = $question;
		return $question;
	}

	/**
	 * Verifies if the correct answer has been given by looking at the database record to see if the `correct` column is set to 1
	 *
	 * @param int $questionId
	 * @param int $answerId
	 * @return boolean
	 */
	
	public function verifyAnswer($questionId, $answerId) {
		$answers = $this->quizAnswersModel->getRecordByKeys(array('id'=>$answerId, 'questionId'=>$questionId));
		$tracker = new MowattMedia_Models_Quiz_QuizTrackerModel();
		if($answers['correct'] == 1){
			$this->correct += 1;
			$tracker->insertRecord(array('quizId' => $this->getId(), 
											'questionId' => $questionId, 
											'answerId' => $answerId, 
											'correct' => 1,
											'session' => session_id()));
			return true;
		}
		$tracker->insertRecord(array('quizId' => $this->getId(), 
											'questionId' => $questionId, 
											'answerId' => $answerId, 
											'correct' => 0,
											'session' => session_id()));
		return false;
	}
	
	/**
	 * returns the total number of questions in the quiz
	 *
	 * @return int
	 */
	
	public function getTotalQuestions() {
		return $this->totalQuestions;
	}
	
	/**
	 * returns the number of correct answers given to this point in the quiz
	 *
	 * @return int
	 */
	
	public function getResults() {
		return $this->correct;
	}
	
	/**
	 * returns the quizes description
	 *
	 * @return string
	 */
	
	public function getDescription() {
		return $this->description;
	}
	
	/**
	 * Commits quiz results to quizResults table
	 *
	 * @return void
	 */
	
	public function commitResults() {
		$this->quizResultsModel->insertRecord(array('quizId' => $this->getId(), 
											'sessionId' => session_id(), 
											'totalQuestions' => $this->getTotalQuestions(), 
											'totalCorrect' => $this->getResults()));
	}
}