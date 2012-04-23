<?php
/**
 * Base View Class File. 
 * Grabs the proper template and merges it with data by providing the variables that have been put in the registry
 *
 * @copyright 	2008 richardmowatt.com
 * @license		???
 * @version 	???
 * @link 		???
 * @since		Class available since initial Release
 * @package 	MowattMedia
 * @subpackage 	Views
 * @author 		Richard Mowatt <rmowatt@richardmowatt.com>
 */
Class MowattMedia_Views_BaseView {

	/**
	 * provides set of global variables w/o having to declare globals (yuck!)
	 *
	 * @var MowattMedia_Application_Registry
	 */

	private $registry;

	/**
	 * array of variables that will be available to view
	 *
	 * @var array
	 */

	private $vars = array();

	function __construct($registry) {
		$this->registry = $registry;
	}


	/**
	 * php magic method
	 * @param string $index
	 * @param mixed $value
	 *
	 * @return void
 	 */
	
	public function __set($index, $value)
	{
		$this->vars[$index] = $value;
	}


	/**
	 * combines and renders script
	 *
	 * @param string $name
	 * @return void
	 */
	
	function render($name) {
		$path = ROOT_PATH . '/scripts/' . $name . '.php';
		if (file_exists($path) == false)
		{
			throw new Exception('Template not found in '. $path);
			return false;
		}
		// Load variables
		foreach ($this->vars as $key => $value)
		{
			$$key = $value;
		}
		include_once($path);
	}


}