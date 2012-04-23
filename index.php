<?php
//session_start();
error_reporting(1);
//error_reporting(E_ALL ^ E_WARNING);
 /*** error reporting on ***/
// error_reporting(E_ALL);
 $rootpath = realpath(dirname(__FILE__));
 /** define root **/
 define ('ROOT_PATH', $rootpath);
 define('TEMPLATE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/scripts/');
 define('CSS_PATH', $_SERVER['DOCUMENT_ROOT'] . '/css/');
 define('JS_PATH', $_SERVER['DOCUMENT_ROOT'] . '/js/');
 define('SELF_ICON', 'rmowatt.jpg');
 /*** do some basic setup, this is where we get registry ***/
 require_once('Includes/setup.php');
 $registry->router = new MowattMedia_Application_Router($registry);
 $registry->router->setPath (ROOT_PATH . '/MowattMedia/Controllers');

  /*** load up the template ***/
 $registry->template = new MowattMedia_Views_BaseView($registry); 
   /*** load the controller and call method (action)***/
 $registry->router->executeAction();
 $registry->template->render(strtolower($registry->router->getControllerName()) . '/' . $registry->router->getActionName());

