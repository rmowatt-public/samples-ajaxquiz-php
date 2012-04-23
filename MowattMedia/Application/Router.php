<?php
/**
 * Router Class File. 
 *
 * Controls routing in combination with mod rewrite to make for pretty urls
 * pattern goes like http://SITE/controller/action
 *
 * @copyright 	2008 richardmowatt.com
 * @license		???
 * @version 	???
 * @link 		???
 * @since		Class available since initial Release
 * @package 	MowattMedia
 * @subpackage 	Application
 * @author 		Richard Mowatt <rmowatt@richardmowatt.com>
 */

class MowattMedia_Application_Router {
	
	/**
	 * provides set of global variables w/o having to declare globals (yuck!)
	 *
	 * @var MowattMedia_Application_Registry
	 */
	protected $registry;
	protected $controllerPath;
	protected $args = array();
	public $file;
	public $controller;
	public $action;

	function __construct( MowattMedia_Application_Registry $registry) {
		$this->registry = $registry;
	}

	function setPath($path) {
		/*** check if path is directory ***/
		if (is_dir($path) == false)
		{
			throw new Exception ('Invalid controller path: `' . $path . '`');
		}
		/*** set the path ***/
		$this->controllerPath = $path;
	}

	/**
	 * executes the action (method)
	 *
	 * @return void
	 */
	
	public function executeAction() {
		$this->getController();
		//make sure we can read the file
		if (is_readable($this->file) == false) {
			echo $this->file;
			die ('404 Not Found');
		}
		//include_once($this->file);
		/*** instantiate controller ***/
		$class = 'MowattMedia_Controllers_' . $this->controller . 'Controller';
		$controller = new $class($this->registry);
		if (is_callable(array($controller, $this->action)) == false) {
			$action = 'index';
		} else {
			$action = $this->action;
		}
		$action = strtolower($action);
		/*** execute the method ***/
		$controller->$action();
	}

	/**
	 * gets the name of the controller and action (method) we will be using
	 * sets them as Object variables
	 * 
	 * @return void
	 */
	
	private function getController() {
		// gotta love mod_rewrite
		$route = (empty($_GET['controller'])) ? '' : $_GET['controller'];
	
		if (empty($route)) {
			$route = 'index';
		} else {
			//get the parts
			$parts = explode('/', $route);
			$this->controller = $parts[0];
			if(isset($parts[1])) {
				$this->action = $parts[1];
			}
		}
		if (empty($this->controller)) {
			$this->controller = 'index';
		}
		//Get action
		if (empty($this->action)) {
			$this->action = 'index';
		}
		//our controller are always uppercased
		$this->controller = ucwords(strtolower($this->controller));
		/*** set the file path ***/
		$this->file = $this->controllerPath .'/'. $this->controller . 'Controller.php';
	}
	
	/**
	 * returns name of controller we are using
	 *
	 * @return string
	 */
	
	public function getControllerName() {
		return $this->controller;
	}
	
	/**
	 * returns name of method (action) we are executing
	 *
	 * @return string
	 */
	
	public function getActionName() {
		return $this->action;
	}
}