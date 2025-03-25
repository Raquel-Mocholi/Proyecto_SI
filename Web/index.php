<?php

/**
 * @author Alfonso Patiño
 * @copyright 2025
 */


 require('includes/config.php');
 require('includes/init.php');
 
if (isset($_GET['controller']) && !empty($_GET['controller'])){
	//Check controller name
	if (preg_replace("/[^a-zA-Z]+/", "", $_GET['controller']) != $_GET['controller']) {
		die('Error: Controller not found');
	}
	
	// $controller = $_GET['controller'];
	$controller =  preg_replace("/[^a-zA-Z]+/", "", $_GET['controller']);
} else {
	$controller = "homeController";
}

$controller_class = 'controllers/front/'.$controller . '.php';

if (is_file($controller_class)){
	include($controller_class);
	$cObj = new $controller;	
	$cObj->init();
} else {
	die('Error: Controller not found');
}	


?>