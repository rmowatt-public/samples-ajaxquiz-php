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

class MowattMedia_Components_WebSite {

	protected $completeSitesModel;



	public function __construct() {
		$this->completeSitesModel = new MowattMedia_Models_Common_CompleteSitesModel();
	}

	public static function getRandom() {
		$model = new MowattMedia_Models_Common_CompleteSitesModel();
		$all= $model->getAll();
		$i = array_rand( $all, 1);
		return $all[$i];
	}
	
	
	public static function getAll() {
		$model = new MowattMedia_Models_Common_CompleteSitesModel();
		$all= $model->getAll();
		return $all;
	}
	
	public static function getSingle($id) {
		$model = new MowattMedia_Models_Common_CompleteSitesModel();
		$all= $model->getRecord(array('id'=>$id));
		return $all;
	}
}