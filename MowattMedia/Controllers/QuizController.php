<?php
/**
 * Quiz Controller Class File. 
 * User enters index and a quiz component is created a stored in session 
 * where it is manipulated through AJAX.
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

class MowattMedia_Controllers_QuizController extends MowattMedia_Controllers_BaseController {

	public function __construct($registry) {
		parent::__construct($registry);
	}

	/**
	 * Only page user sees, sets up the component and stores in session
	 * 
	 * @return void
	 */
	
	public function index() {
		$ns = new Zend_Session_Namespace('quiz');
		$ns->unsetAll();
		$quiz = new MowattMedia_Components_Quiz();
		$values = $quiz->populate();
		$ns->quiz = serialize($quiz);
	}

	/**
	 * Used to supply next question to ajax call
	 * if no questions are left it inorms js script that quiz id complete
	 * 
	 * @return void
	 */
	
	public function ajaxquestionfeeder() {
		$ns = new Zend_Session_Namespace('quiz');
		if($ns->quiz) {
			$quiz = unserialize($ns->quiz);
			$question = $quiz->getNextQuestion();
			$ns->quiz = serialize($quiz);
		}

		if(!$question){
			echo json_encode(array('message'=>'complete'));
			exit;
		}

		$returnValues['questionId'] = $question->getId();
		$returnValues['question'] = $question->getQuestion();
		$returnValues['description'] = $quiz->getDescription();
		$answers = $question->getAnswers();
		
		$i = 1;
		foreach ($answers as $index=>$value) {
			$returnValues['answers'][$i]['id'] = $value['id'];
			$returnValues['answers'][$i]['answer'] = ucwords($value['answer']);
			$returnValues['answers'][$i]['correct'] = ucwords($value['correct']);
			$i++;
		}
		$returnValues['answers'] = array_values($returnValues['answers']);
		echo json_encode($returnValues);
		exit;
	}

	/**
	 * Checks to see if the user submitted the right answer 
	 * and relays result back to ajax script
	 * 
	 * @return void
	 */
	
	public function ajaxquestionresponse() {
		if($_POST) {
			$ns = new Zend_Session_Namespace('quiz');
			if($ns->quiz) {
				$quiz = unserialize($ns->quiz);
				echo ($quiz->verifyAnswer($_POST['questionId'], $_POST['answerId'])) ? '1' : '0';
			}
			$ns->quiz = serialize($quiz);
			exit;
		}
		exit;
	}

	/**
	 * Supplies script with the total number of questions and the number user got correct
	 * 
	 * @return void
	 */
	
	public function ajaxgetresults() {
		$ns = new Zend_Session_Namespace('quiz');
		if($ns->quiz) {
			$quiz = unserialize($ns->quiz);
			$total = $quiz->getTotalQuestions();
			$correct = $quiz->getResults();
			$quiz->commitResults();
			$ns->quiz = serialize($quiz);
		}
		$results = array('total'=>$total, 'correct'=>$correct);
		echo json_encode($results);
		exit;
	}


}