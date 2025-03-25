<?php

/**
 * @author Alfonso Patiño
 * @copyright 2025
 */
 
include('classes/cms.php');
 
class CmsController {
    var $params; 
	var $tpl;
	var $search_result;

    function init() {
		
		$this->params = Utils::getParams();
		$this->tpl = $GLOBALS['smarty'];
		
		if (isset($_GET['action']) && !empty($_GET['action'])){
			$action = $_GET['action'];
		} else {
			$action = "";
		}
		
		switch($action){
			case 'new_cms':
			case 'edit_cms':
				
				if ($action == "edit_cms"){
					$cms_id = (int)$_GET['cms_id'];
				} else {
					$cms_id = 0;					
				}
				
				$cms = new Cms($cms_id);
				
				$this->tpl->assign(array(
					'action' => 'edit',
					'cms_data'=> $cms
				));
				
				return $this->display('admin/cms.tpl');
				break;
			case 'save_cms':
				
				$cms = new Cms((int)Utils::sanitize($_POST['cms_id']));
							
				$cms->cms_title = Utils::sanitize($_POST['cms_title']);
				$cms->cms_description  =$_POST['cms_description'];

				$cms->save();

				// Save image to disk
				if($_FILES["cms_image"]["name"]!="") {
					$cms->saveImage($_FILES["cms_image"]["tmp_name"]);
				}
				Utils::addMessage("Sección guardada correctamente");
				
				Utils::redirect('index.php?controller=cmsController');
				break;
			case 'delete_cms':
				$cms = new Cms((int)Utils::sanitize($_GET['cms_id']));
				if ($cms->delete()){
					Utils::addMessage("Sección eliminada correctamente");
				} else {
					Utils::addMessage("La noticia no se ha podido eliminar correctamente","warning");
				};
				Utils::redirect('index.php?controller=cmsController');
				break;
			default:	
				$this->tpl->assign(array(
					'action' => 'list',
					'cms_data'=> Cms::getAllCms()
				));
				return $this->display('admin/cms.tpl');	
		}

		
    }
	
	private function display($tpl){
		
		$this->tpl->assign(array(
			'page_title'=> PAGE_TITLE,
			'meta_description'=> PAGE_META_DESCRIPTION,
			'navitems'=> Utils::getAdminNav('CmsController'),
			'messages'=>Utils::getMessages()
		));
		
		$this->tpl->display('admin/common/head.tpl');	
		$this->tpl->display('admin/common/header.tpl');
		
        $this->tpl->display($tpl);
		
		$this->tpl->display('admin/common/footer.tpl');
		return true;
	}

}
?>