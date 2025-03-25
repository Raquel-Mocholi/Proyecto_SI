<?php

/**
 * @author Alfonso Patiño
 * @copyright 2025
 */
 
include('classes/place.php');
  
 
class PlacesController {
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
			case 'new_place':
			case 'edit_place':
				
				if ($action == "edit_place"){
					$place_id = (int)$_GET['place_id'];
				} else {
					$place_id = 0;					
				}
				
				$place = new Place($place_id);
				
				$this->tpl->assign(array(
					'action' => 'edit',
					'places_data'=> $place
				));
				
				return $this->display('admin/places.tpl');
				break;
			case 'save_place':
				
				$place = new Place((int)Utils::sanitize($_POST['place_id']));
							
				$place->place_title = Utils::sanitize($_POST['place_title']);
				$place->place_description  =$_POST['place_description'];
				$place->place_latitude  =$_POST['place_latitude'];
				$place->place_longitude  =$_POST['place_longitude'];
				$place->roadmap_id  = (int)$_POST['roadmap_id'];
				
				if($_FILES["place_image"]["name"]!="") {
					$place->place_image  = Utils::sanitize($_FILES['place_image']["name"]);
				}
				
				$place->save();

				// Save image to disk
				if($_FILES["place_image"]["name"]!="") {
					$place->saveFile($_FILES["place_image"]["tmp_name"],PLACE_IMAGE_PATH,"jpg");
				}
				
				// Save audio to disk
				if($_FILES["place_speech"]["name"]!="") {
					$place->saveFile($_FILES["place_speech"]["tmp_name"],PLACE_SPEECH_PATH,"mp3");
				}
				
				
				
				
				Utils::addMessage("Lugar guardado correctamente");
				
				Utils::redirect('index.php?controller=placesController');
				break;
			case 'delete_place':
				$place = new Place((int)Utils::sanitize($_GET['place_id']));
				if ($place->delete()){
					Utils::addMessage("Lugar eliminado correctamente");
				} else {
					Utils::addMessage("El lugar no se ha podido eliminar correctamente","warning");
				};
				Utils::redirect('index.php?controller=placesController');
				break;
			default:	
				$this->tpl->assign(array(
					'action' => 'list',
					'places_data'=> Place::getAllPlace()
				));
				return $this->display('admin/places.tpl');	
				return $this->display('admin/places.tpl');	
		}

		
    }
	
	private function display($tpl){
		
		$this->tpl->assign(array(
			'page_title'=> PAGE_TITLE,
			'meta_description'=> PAGE_META_DESCRIPTION,
			'navitems'=> Utils::getAdminNav('PlacesController'),
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