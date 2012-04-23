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

class MowattMedia_Controllers_ContactController extends MowattMedia_Controllers_BaseController {

	public function __construct($registry) {
		parent::__construct($registry);
	}
	
	public function index() {
		$result = null;
		if(array_key_exists('name', $_POST)) {
			if($_POST['subject'] == '') {
				$result = 'Please Complete the subject field';
			}else {
				$this->registry->template->subject = $_POST['subject'];
			}
			if($_POST['email'] == '' || !eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $_POST['email'])) {
				$result = 'Please provide a properly formatted email address';
			}else {
				$this->registry->template->email = $_POST['email'];
			}
			if($_POST['name'] == '') {
				$result = 'Please Complete the name field';
			} else {
				$this->registry->template->firstname = $_POST['name'];
			}
			if($_POST['message'] != '') {
				$this->registry->template->message = $_POST['message'];
			}
			if(!$result) {
				$message = $_POST['email'] . ' :: ' . $_POST['message']; 
				mail('richmowatt@gmail.com', 'SITE:: ' . $_POST['subject'], $message);
				$this->registry->template->subject = '';
				$this->registry->template->email = '';
				$this->registry->template->firstname = '';
				$this->registry->template->message = '';
				$result = 'Thank you. Your message has been sent.';
			}
		}
		$this->registry->template->result = $result;
	}
	
}