<?php
	
/**
 * @author Alfonso Patiño
 * @copyright 2025
 */


class Client {
	
	public $client_id;
	public $client_username;
	public $client_password;
	public $client_name;
	public $client_email;
	public $client_phone;
	
	public $client_admin_access;
	public $client_superadmin;

	
	function __construct($client_id=0) {
		if ((int)$client_id==0){
			$this->client_id = 0;
			$this->client_username = '';
			$this->client_name = '';
			$this->client_email = '';
			$this->client_phone = '';
			$this->client_password = '';
			$this->client_admin_access = 0;
			$this->client_superadmin = 0;
			

		} else {
			$this->client_id = (int)$client_id;
			$this->getClient();	
		}
	}
	
	private function getClient(){
		$client_data = DB::getInstance()->queryS("SELECT * FROM clients WHERE client_id=".$this->client_id);
		if (count($client_data)==1){
			$this->client_username = $client_data[0]['client_username'];
			$this->client_name = $client_data[0]['client_name'];
			$this->client_email = $client_data[0]['client_email'];
			$this->client_phone = $client_data[0]['client_phone'];
			$this->client_password = $client_data[0]['client_password'];
			$this->client_admin_access = $client_data[0]['client_admin_access'];
			$this->client_superadmin = $client_data[0]['client_superadmin'];
	
			if (isset($_SESSION['superclient_id']) && (int)$_SESSION['superclient_id']>0){
				$this->client_current_superclient = array("id"=>(int)$_SESSION['superclient_id'],"username"=>Client::getClientNameById((int)$_SESSION['superclient_id']));
			} else {
				$this->client_current_superclient = array("id"=>-1,"username"=>"");
			}
		} else {
			die("Too many clients with the same client_id");
		}
	}
	
	public function save(){
		if($this->client_id==0){
			// Insert
			$insert_client_query = "INSERT INTO clients (
				client_username,
				client_name,
				client_email,
				client_phone,
				client_password,
				client_admin_access,
				client_superadmin
			) VALUES (
				'".addslashes($this->client_username)."',
				'".addslashes($this->client_name)."',
				'".addslashes($this->client_email)."',
				'".addslashes($this->client_phone)."',
				'".addslashes($this->client_password)."',
				'".addslashes($this->client_admin_access)."',
				'".addslashes($this->client_superadmin)."'
			)";
            
			DB::getInstance()->query($insert_client_query);
			$this->client_id = DB::getInstance()->insertId();
			
		} else {
			// Update
			$update_client_query = "UPDATE clients SET
				client_username = '".addslashes($this->client_username)."',
				client_name = '".addslashes($this->client_name)."',
				client_email = '".addslashes($this->client_email)."',
				client_phone = '".addslashes($this->client_phone)."',
				client_password = '".addslashes($this->client_password)."',
				client_admin_access = '".(int)($this->client_admin_access)."',
				client_superadmin = '".(int)($this->client_superadmin)."'
			WHERE
				client_id = ".$this->client_id;			
		
			// var_dump($update_client_query);
			// exit();
			DB::getInstance()->query($update_client_query);
		}
		
		
	}
	
	
	public function delete() {
		if ((int)$this->client_id){
		
			$delete_client_query = "DELETE FROM clients WHERE client_id=".$this->client_id;
			DB::getInstance()->query($delete_client_query);			
			
			if (DB::getInstance()->affectedRows()){
				return true;
			}else {
				return false;
			}

		} else {
			return false;
		}
	}
	
	
		
	public function logAction() {
	
		 $action_query = 'INSERT into clients_access_log (
			 client_id,
			 date,
			 ip,
			 action,
			 parameters,
			 superclient_id
		 )  values (
			 '.(int)$this->client_id.',
			 now(),
			 "'.$_SERVER['REMOTE_ADDR'].'",
			 "'.$_SERVER['REQUEST_URI'].'",
			 "'.addslashes('POST: ' . json_encode($_POST)).'",
			 '.(int)$this->client_current_superclient['id'].')';
		 // echo $action_query;
		 
		 DB::getInstance()->query($action_query);
	}
	
	
	/* Get data of clients (paged) */
	static function getAllClients($item_per_page=10, $page=0) {
		if ($page<0 || $item_per_page<0){ // Sin paginar
			$limit_query =  "";
		} else {
			$limit_query =  " LIMIT ".($item_per_page*$page). ", ". $item_per_page;
		}
		
		// Admin login check
		if (isset($_SESSION['admin_login']['superadmin']) && ($_SESSION['admin_login']['superadmin']==0)){
			$where_query=" c.client_id  in (".$_SESSION['admin_login']['admin_client_id'].",".implode(",",$_SESSION['admin_login']['subclients']).")";
		} else {
			$where_query=" 1 ";
		}
		
		$clients_raw = DB::getInstance()->queryS("SELECT * FROM clients c LEFT JOIN clients_zones cz ON c.client_zone_id=cz.client_zone_id WHERE " . $where_query . $limit_query);
		$clients_data = array();
		
		foreach ($clients_raw as $client){
			
			// Client Groups
			$groups_raw = DB::getInstance()->queryS("SELECT * FROM clients_groups cg LEFT JOIN groups g ON cg.group_id = g.group_id, brands b WHERE cg.client_id=".$client['client_id']." and b.brand_id=g.brand_id");
			$groups_data = array();
			foreach ($groups_raw as $group){
				$groups_data[] = array(
					'group_id'=>$group['group_id'],
					'group_name'=>$group['group_name'],
					'brand_id'=>$group['brand_id'],
					'brand_name'=>$group['brand_name']
				);
			}
			
			
			$clients_data[] = array(
				'client_id'=>$client['client_id'],
				'client_username'=>$client['client_username'],
				'client_password'=>$client['client_password'],
				'client_name'=>$client['client_name'],
				'client_zone_id'=>$client['client_zone_id'],
				'client_zone_name'=>$client['client_zone_name'],
				'client_email'=>$client['client_email'],
				'client_number'=>$client['client_number'],
				'discount_group_id'=>$client['discount_group_id'],
				'groups'=>$groups_data);
		
		}

		return $clients_data;
	}	
	
		
	/* Get num of clients */
	static function getCountAllClients() {
		
		// Admin login check
		if (isset($_SESSION['admin_login']['superadmin']) && ($_SESSION['admin_login']['superadmin']==0)){
			$where_query=" c.client_id  in (".$_SESSION['admin_login']['admin_client_id'].",".implode(",",$_SESSION['admin_login']['subclients']).")";
		} else {
			$where_query=" 1 ";
		}
	
		$clients_num = DB::getInstance()->queryS("SELECT COUNT(c.client_id) as total FROM clients c WHERE ".$where_query);
		return $clients_num[0]['total'];
	}	
	
	
	
	// ---------------------- LOGIN FUNCTIONS -------------------------
	public static function isLogged(){
		if (isset($_SESSION['client_id']) && (int)$_SESSION['client_id']>0){
			return $_SESSION['client_id'];
		} else {
			return false;
		}
	}	
	
	public static function login($client_username,$client_password){
		$client_query = "select client_id from clients where client_username='".$client_username."' and BINARY client_password='".$client_password."'";
		$result = DB::getInstance()->queryS($client_query);

		if (count($result)==1){
			return $result[0]['client_id'];
		} else {
			return false;
		}
	}
	
	public static function logout(){		
		if (isset($_SESSION['client_id'])){
			unset($_SESSION['client_id']);
		}
		
		if (isset($_SESSION['brand_id'])){
			unset($_SESSION['brand_id']);
		}	
		
		if (isset($_SESSION['show_prices'])){
			unset($_SESSION['show_prices']);
		}	
		
		if (isset($_SESSION['show_retailer_prices'])){
			unset($_SESSION['show_retailer_prices']);
		}	
		
		if (isset($_SESSION['superclient_id'])){
			unset($_SESSION['superclient_id']);
		}	
		
	}

	// ---------------------- END LOGIN FUNCTIONS -------------------------
		
	// ---------------------- LOGIN FUNCTIONS -------------------------
	public static function isAdminLogged(){
		
		// var_dump(isset($_SESSION['admin_login']['admin_client_id']) && (int)$_SESSION['admin_login']['admin_client_id']>0);
		// exit;
		if (isset($_SESSION['admin_login']['admin_client_id']) && (int)$_SESSION['admin_login']['admin_client_id']>0){
			return $_SESSION['admin_login'];
		} else {
			return false;
		}
	}	
	
	public static function adminLogin($client_username,$client_password){
		$client_query = "select client_id, client_superadmin from clients where client_username='".$client_username."' and BINARY client_password='".$client_password."' and client_admin_access = 1";
		// var_dump($client_query);
		// exit();
		$result = DB::getInstance()->queryS($client_query);

		if (count($result)==1){
			$admin_client = new Client((int)$result[0]['client_id']);
			
			// client is allowed itself
			$subclients = array((int)$result[0]['client_id']);
			foreach ($admin_client->client_subclients as $subclient){
				$subclients[] = (int)$subclient;
			}
			
			$admin_client_info = array(	"admin_client_id"=>(int)$result[0]['client_id'],
										"superadmin"=>(int)$result[0]['client_superadmin'],
										"subclients"=>$subclients);
			

			return $admin_client_info;

		} else {
			return false;
		}
	}
	
	public static function adminLogout(){		
		if (isset($_SESSION['admin_login'])){
			unset($_SESSION['admin_login']);
		}
		
	}

	// ---------------------- END LOGIN FUNCTIONS -------------------------
	
	
	
}