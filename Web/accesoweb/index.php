<?php

/**
 * @author Alfonso Patiño
 * @copyright 2025
 */


define("ADMIN_ZONE",true);
 
 chdir("..");
 
 require('includes/config.php');
 require('includes/init.php');

if (isset($_GET['controller']) && !empty($_GET['controller'])){
	$controller = $_GET['controller'];
} else {
	$controller = "homeController";
}

//Log common access
Utils::logAccess();

//Check admin permissions
if (!Utils::checkAdminPermissions()){	
	Utils::redirect('index.php?controller=loginController');
}

$controller_class = 'controllers/admin/'.$controller . '.php';
if (is_file($controller_class)){
	include($controller_class);
	$cObj = new $controller;	
	$cObj->init();
} else {
	die('Error: Controller not found');
}	


?>