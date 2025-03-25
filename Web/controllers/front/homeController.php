<?php

/**
 * @author Alfonso patiño
 * @copyright 2025
 */
include('classes/client.php');
include('classes/place.php');


 class HomeController {
    var $params; 
	var $tpl;
	var $search_result;

    function init() {
	
		// Initialize Smarty var
		$this->tpl = $GLOBALS['smarty'];
		
		$this->params = Utils::getParams();
	
		if (isset($_GET['action']) && !empty($_GET['action'])){
			$action = $_GET['action'];
		} else {
			$action = "";
		}

		
		$this->tpl->assign(array(
			'placesData'=> Place::getAllPlacesJSON(),
		));

		return $this->display();
		
    }
	
	private function display(){

		$this->tpl->assign(array(
			'page_title'=>PAGE_TITLE,
			'meta_description'=>PAGE_META_DESCRIPTION,
			'messages'=>Utils::getMessages()
		));
			
		$this->tpl->display('front/common/head.tpl');
	
        $this->tpl->display('front/home.tpl');
		
		return true;	
	}

}
?>