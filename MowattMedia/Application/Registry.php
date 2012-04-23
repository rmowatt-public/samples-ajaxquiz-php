<?php
/**
 * Registry Class File. 
 *
 * Helps us avoid using GLOBALS by keeping all vars in a single namespace
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

class MowattMedia_Application_Registry {

	private $variables = array();

	public function __set($index, $value)
	{
		$this->variables[$index] = $value;
	}

	public function __get($index)
	{
		return $this->variables[$index];
	}

}

