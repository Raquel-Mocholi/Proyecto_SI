<?php
	
/**
 * @author Alfonso Patiño
 * @copyright 2025
 */

class Place {
	
	public $place_id;
	public $roadmap_id;
	public $place_date;
	public $place_title;
	public $place_description;
	public $place_latitude;
	public $place_longitude;
	public $place_hash;
	
	
	function __construct($place_id=0) {
		if ((int)$place_id==0){
			$this->place_id = 0;
			$this->roadmap_id = 0;
			$this->place_date = date("Y-m-d h:i:s");
			$this->place_title = '';			
			$this->place_description = '';
			$this->place_latitude = '';
			$this->place_longitude = '';
			$this->place_hash = '';
		} else {
			$this->place_id = (int)$place_id;
			$this->getPlace();	
		}
	}
	
	private function getPlace(){
		$place_data = DB::getInstance()->queryS("SELECT * FROM places WHERE place_id=".$this->place_id);
		if (count($place_data)==1){
			$this->roadmap_id = $place_data[0]['roadmap_id'];
			$this->place_title = $place_data[0]['place_title'];
			$this->place_description = $place_data[0]['place_description'];
			$this->place_latitude = $place_data[0]['place_latitude'];
			$this->place_longitude = $place_data[0]['place_longitude'];
			$this->place_date = $place_data[0]['place_date'];
			$this->place_hash = $place_data[0]['place_hash'];
		} else {
			die("Too many place with the same place_id");
		}
	}

	public function save(){
		
		if (empty($this->place_hash)){
			$this->place_hash = hash('sha256',$this->place_date . $this->place_title . $this->place_latitude . $this->place_longitude);
		}
		
		if($this->place_id==0){
			// Insert
			$insert_place_query = "INSERT INTO places (
				roadmap_id,
				place_date,
				place_title,
				place_description,
				place_latitude,
				place_longitude,
				place_hash
			) VALUES (
				'".addslashes($this->roadmap_id)."',
				'".addslashes($this->place_date)."',
				'".addslashes($this->place_title)."',
				'".addslashes($this->place_description)."',
				'".addslashes($this->place_latitude)."',
				'".addslashes($this->place_longitude)."',
				'".addslashes($this->place_hash)."'
			)";

			DB::getInstance()->query($insert_place_query);
			$this->place_id = DB::getInstance()->insertId();
			
		} else {
			// Update
			$update_place_query = "UPDATE places SET
				roadmap_id = '".(int)$this->roadmap_id."',
				place_date = '".addslashes($this->place_date)."',
				place_title = '".addslashes($this->place_title)."',
				place_description = '".addslashes($this->place_description)."',
				place_latitude = '".addslashes($this->place_latitude)."',
				place_longitude = '".addslashes($this->place_longitude)."',
				place_hash = '".addslashes($this->place_hash)."'
			WHERE
				place_id = ".$this->place_id;
		
			DB::getInstance()->query($update_place_query);
		}
	}
	
	public function delete() {
		if ((int)$this->place_id){

			if (is_file(NEWS_LOGO_PATH. 'place_'.$this->place_id.'.jpg')){
				unlink(NEWS_LOGO_PATH. 'place_'.$this->place_id.'.jpg');
			}
			
			$delete_place_query = "DELETE FROM places WHERE place_id=".$this->place_id;
			DB::getInstance()->query($delete_place_query);		
			
			if (DB::getInstance()->affectedRows()){
				return true;
			}else {
				return false;
			}

		} else {
			return false;
		}
	}
	
	public function saveFile($img,$filepath,$extension) {
		if ((int)$this->place_id){
			if (move_uploaded_file($img, $filepath. 'place_'.$this->place_id.'.'.$extension)) {
				return true;
			} else {
				return false;
			}
		}
	}
	
	// Get all place and its groups
	static function getAllPlace($roadmap_id=0, $item_per_page=10, $page=0) {
		if ($roadmap_id==0){
			$place_query = "SELECT * FROM places ORDER BY place_date DESC LIMIT ".($item_per_page*$page). ", ". $item_per_page;
			$place_data = DB::getInstance()->queryS($place_query);
		}else{
			$place_query = "SELECT * FROM places WHERE roadmap_id=".(int)$roadmap_id." ORDER BY place_date DESC LIMIT ".($item_per_page*$page). ", ". $item_per_page;
			$place_data = DB::getInstance()->queryS($place_query );
		}

		return $place_data;
	}	
	
	static function getCountAllPlace($roadmap_id=0) {
		if ($roadmap_id==0){
			$place_query = "SELECT COUNT(place_id) as total FROM places";
			$place_data = DB::getInstance()->queryS($place_query);
		}else{
			$place_query = "SELECT COUNT(place_id) as total FROM places WHERE roadmap_id=".(int)$roadmap_id;
			$place_data = DB::getInstance()->queryS($place_query );
		}
	
		return $place_data[0]['total'];
	}	
	
	static function getAllPlacesJSON() {
		$place_query = "SELECT * FROM places";
		$place_data_json= json_encode(DB::getInstance()->queryS($place_query));

		return $place_data_json;
	}	

	
}