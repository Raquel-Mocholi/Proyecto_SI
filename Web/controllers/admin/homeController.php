<?php

/**
 * @author Alfonso Patiño
 * @copyright 2025
 */

class HomeController {
    var $params; 
	var $tpl;
	var $search_result;

    function init() {
		include('classes/client.php');	
				
		$this->params = Utils::getParams();
	
		// Initialize Smarty var
		$this->tpl = $GLOBALS['smarty'];
		
		return $this->display();
		
    }
	
	private function display(){

		$this->tpl->assign(array(
			'page_title'=> PAGE_TITLE,
			'meta_description'=> PAGE_META_DESCRIPTION
		));
		$this->tpl->display('admin/common/head.tpl');

		$this->tpl->assign(array(
			'navitems'=> Utils::getAdminNav('HomeController'),
			'messages'=>Utils::getMessages(),
		));	
		
		$this->tpl->display('admin/common/header.tpl');
		
		$this->tpl->assign(array(
	
		));		
        $this->tpl->display('admin/index.tpl');
		
		$this->tpl->display('admin/common/footer.tpl');
		return true;
	}

}
?>