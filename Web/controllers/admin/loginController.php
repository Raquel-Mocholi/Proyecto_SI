<?php

/**
 * @author Alfonso Patiño
 * @copyright 2023
 */

 
 class LoginController {
    var $params; 
	var $tpl;

    function init() {
		include('classes/client.php');
		
		$this->params = Utils::getParams();
		
		if (isset($_GET['action']) && !empty($_GET['action'])){
			$action = $_GET['action'];
		} else {
			$action = "";
		}
		
		switch($action){
			case 'login':

				if (isset($this->params['client_username']) && isset($this->params['client_password'])){
					if ($client_data = Client::adminLogin($this->params['client_username'],$this->params['client_password'])){
						$_SESSION['admin_login'] = $client_data;
						Utils::redirect('index.php?controller=homeController');
					} else {
						unset($_SESSION['admin_login']);
					}
				}

				Utils::addMessage("Acceso incorrecto. Compruebe los datos introducidos",'error');
				Utils::redirect('index.php?controller=loginController');
				break;
			case 'logout':
				Client::adminLogout();
				Utils::addMessage("Sesión cerrada correctamente",'info');
				Utils::redirect('index.php?controller=loginController');
				break;
			default:
				// If user is logged redicts to home page
				if (Client::isAdminLogged()){
					Utils::redirect('index.php?controller=homeController');
				}
			
				// Initialize Smarty var
				$this->tpl = $GLOBALS['smarty'];	
				return $this->display();	
		}
    }
	
	private function display(){

		$this->tpl->assign(array(
			'page_title'=> PAGE_TITLE,
			'meta_description'=> PAGE_META_DESCRIPTION,
			'messages'=>Utils::getMessages()
		));
			
		$this->tpl->display('admin/common/head.tpl');

        $this->tpl->display('admin/login.tpl');
		
		return true;		
	}

}


?>