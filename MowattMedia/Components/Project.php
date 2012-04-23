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

class MowattMedia_Components_Project {
	
	public static function getTypes() {
		$model = new MowattMedia_Models_Common_ProjectTypesModel();
		return $model->getAll();
	}
}