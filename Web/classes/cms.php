<?php
	
/**
 * @author Alfonso Patiño
 * @copyright 2019
 */

class Cms {
	
	public $cms_id;
	public $cms_date;
	public $cms_title;
	public $cms_description;
	
	
	function __construct($cms_id=0) {
		if ((int)$cms_id==0){
			$this->cms_id = 0;
			$this->cms_date = date("Y-m-d h:i:s");
			$this->cms_title = '';			
			$this->cms_description = '';
		} else {
			$this->cms_id = (int)$cms_id;
			$this->getCms();	
		}
	}
	
	private function getCms(){
		$cms_data = DB::getInstance()->queryS("SELECT * FROM cms WHERE cms_id=".$this->cms_id);
		if (count($cms_data)==1){
			$this->cms_title = $cms_data[0]['cms_title'];
			$this->cms_description = $cms_data[0]['cms_description'];
			$this->cms_date = $cms_data[0]['cms_date'];
		} else {
			die("Too many cms with the same cms_id");
		}
	}

	public function save(){
		if($this->cms_id==0){
			// Insert
			$insert_cms_query = "INSERT INTO cms (
				cms_date,
				cms_title,
				cms_description
			) VALUES (
				'".addslashes($this->cms_date)."',
				'".addslashes($this->cms_title)."',
				'".addslashes($this->cms_description)."'
			)";
				var_dump($insert_cms_query);
			DB::getInstance()->query($insert_cms_query);
			$this->cms_id = DB::getInstance()->insertId();
			
		} else {
			// Update
			$update_cms_query = "UPDATE cms SET
				cms_date = '".addslashes($this->cms_date)."',
				cms_title = '".addslashes($this->cms_title)."',
				cms_description = '".addslashes($this->cms_description)."'
			WHERE
				cms_id = ".$this->cms_id;
		
			DB::getInstance()->query($update_cms_query);
		}
	}
	
	public function delete() {
		if ((int)$this->cms_id){		
			$delete_cms_query = "DELETE FROM cms WHERE cms_id=".$this->cms_id;
			DB::getInstance()->query($delete_cms_query);		
			
			if (DB::getInstance()->affectedRows()){
				return true;
			} else {
				return false;
			}

		} else {
			return false;
		}
	}

	
	// Get all cms and its groups
	static function getAllCms($brand_id=0, $item_per_page=10, $page=0) {
		if ($brand_id==0){
			$cms_query = "SELECT * FROM cms ORDER BY cms_date DESC LIMIT ".($item_per_page*$page). ", ". $item_per_page;
			$cms_data = DB::getInstance()->queryS($cms_query);
		}else{
			$cms_query = "SELECT * FROM cms WHERE brand_id=".(int)$brand_id." ORDER BY cms_date DESC LIMIT ".($item_per_page*$page). ", ". $item_per_page;
			$cms_data = DB::getInstance()->queryS($cms_query );
		}

		return $cms_data;
	}	
	
	static function getCountAllCms($brand_id=0) {
		if ($brand_id==0){
			$cms_query = "SELECT COUNT(cms_id) as total FROM cms";
			$cms_data = DB::getInstance()->queryS($cms_query);
		}else{
			$cms_query = "SELECT COUNT(cms_id) as total FROM cms WHERE brand_id=".(int)$brand_id;
			$cms_data = DB::getInstance()->queryS($cms_query );
		}
	
		return $cms_data[0]['total'];
	}

	
}