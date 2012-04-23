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

class MowattMedia_Controllers_SamplesController extends MowattMedia_Controllers_BaseController {

	public function __construct($registry) {
		parent::__construct($registry);
	}
	
	public function index() {
		$this->registry->template->featured = MowattMedia_Components_WebSite::getRandom();
		$this->registry->template->types = MowattMedia_Components_Project::getTypes();
		$this->registry->template->events = $this->getRss();
	}
	
	public function aboutus() {
		$this->registry->template->featured = MowattMedia_Components_WebSite::getRandom();
		$this->registry->template->types = MowattMedia_Components_Project::getTypes();
	}
}