<?php
	
/**
 * @author Alfonso Patiño
 * @copyright 2021
 */
 
 class Utils {

	public static function getParams() {
		$params = array();
		if (isset($_GET) && !empty($_GET)){
			foreach ($_GET as $key => $value){
				if (!is_array($value))
					$params[$key] = Utils::sanitize($value);
			}
		}
		
		if (isset($_POST) && !empty($_POST)){
			foreach ($_POST as $key => $value){
				if (!is_array($value))
					$params[$key] = Utils::sanitize($value);
			}
		}
		
		return $params;
    }
	
	public static function sanitize($text){
		if (!is_array($text))
			return trim(strip_tags(addslashes($text)));
	}
	
	public static function redirect($url){
		header('Location: '. $url);
		exit(0);
	}	

	public static function convertDate($date){
		return implode("-", array_reverse(explode("/",$date)));
	}
	
	public static function convertDateReverse($date){
		return implode("/", array_reverse(explode("-",$date)));
	}
	
	// Convert from YYYY/mm/dd HH:ii:ss to dd/mm/YYYY HH:ii:ss
	public static function convertDateTimeReverse($date){
		$tmp = explode(" ",$date);
		$result = implode("/", array_reverse(explode("-",$tmp[0]))). " " . $tmp[1];
		
		return $result;
	}
	
	public static function removeProtocol($str){
		return str_replace("http://","",$str);
	}
	
	public static function getDayBetweenDates($date_init, $date_end){
		$begin = new DateTime($date_init);
		$end = new DateTime($date_end);

		$daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);

		$days = array();
		foreach($daterange as $date){
			$days[] = $date->format("Y-m-d");
		}
		return $days;
	}
	
	
	/* Funcion que obtiene las secciones de administración */
	public static function getAdminNav($selectedController = null){
		$navigation_raw = array();
		
		$admin_categories_query = "SELECT * FROM `admin_categories` WHERE `admin_category_parent_id`= 0 ORDER BY admin_category_order ASC";
		$admin_categories_result = DB::getInstance()->queryS($admin_categories_query);
		
		for ($k=0;$k<count($admin_categories_result);$k++){
			$adminNavigationQuery = "SELECT admin_navigation_name as name, admin_navigation_icon as icon, admin_navigation_link as link, admin_navigation_controller as controller FROM admin_navigation WHERE active = 1 AND superadmin <= ".(int)$_SESSION['admin_login']['superadmin']." and display_in_menu=1 AND admin_category_id = ".$admin_categories_result[$k]['admin_category_id']." ORDER BY admin_navigation_sort_order ASC";
			
			$navigation_result = DB::getInstance()->queryS($adminNavigationQuery);
			
			$section_array = array();
			$active = false;
			for ($i=0;$i<count($navigation_result);$i++){
				$navigation_result[$i]["active"]= 0;
				$section_array[] = $navigation_result[$i];
				if ($section_array[$i]['controller']== $selectedController && !is_null($selectedController)) {
					$section_array[$i]['active'] = 1;
					$active = true;
				}
				
			}
		
			$navigation_raw[] = array (	"admin_category_id"=>$admin_categories_result[$k]['admin_category_id'],
										"admin_category_name"=>$admin_categories_result[$k]['admin_category_name'],
										"admin_category_icon"=>$admin_categories_result[$k]['admin_category_icon'],
										"active"=>$active,
										"sections"=>$section_array);
		}
		
		

		return $navigation_raw;
		
	}
	
	public static function initSession(){
		if (defined("ADMIN_ZONE")){
			session_name("backOffice");
		} else {
			session_name("frontOffice");
		}
		
		return session_start();
	}
	
	public static function destroySession(){
		return session_destroy();
	}	
	
	public static function addMessage($msg,$type='info'){
		if (!isset($_SESSION['messages'])){
			$_SESSION['messages'] = array('info'=>array(),'error'=>array(),'warning'=>array());
		}
		
		if (!isset($_SESSION['messages'][$type])){
			die("Error: Invalid message typ");
		} else {
			$_SESSION['messages'][$type][] =  $msg;
		}
	}
	
	public static function getMessages(){
		$output = array();
		if (!isset($_SESSION['messages'])){
			return $output;
		}
		
		foreach($_SESSION['messages']['info'] as $info){
			$output[] = array('message'=>$info,'type'=>'success');
		}		
		foreach($_SESSION['messages']['error'] as $error){
			$output[] = array('message'=>$error,'type'=>'danger');
		}		
		foreach($_SESSION['messages']['warning'] as $warning){
			$output[] = array('message'=>$warning,'type'=>'warning');
		}

		unset($_SESSION['messages']);
		
		return $output;
		
	}	
	
	
	public static function encryptPassword($pass){
		return $pass;
	}
						
	
	// define constants from configuration table
	public static function loadConfiguration(){
		$configuration_query = "SELECT * FROM configuration";
		$configuration_values = DB::getInstance()->queryS($configuration_query);
		
		foreach ($configuration_values as $configuration_value){
			define($configuration_value['configuration_key'], $configuration_value['configuration_value']);
		}
		
		return true;
	}
						
	public static function sendMail($to, $subject, $message, $template_vars=array(), $additional_headers = ''){
		
		// Replace template vars in subject and message
		foreach($template_vars as $key=>$value){
			$subject = str_replace('{'.$key.'}',$value,$subject);
			$message = str_replace('{'.$key.'}',$value,$message);
		}
		
		if (mail($to, $subject, $message, $additional_headers)){
			return true;
		}else {
			return false;
		}

	}

	// Search feature_value in $products->features array
	public static function featureInArray($haystack, $needle){
		foreach($haystack as $feature){
			if ($feature['product_feature_value_id']==$needle){
				// var_dump($value['product_feature_value_id']); 
				// var_dump($needle); 
				return true;
			}
		}
		return false;
	}

	// Search feature_value in $products->features array
	public static function categoryInArray($haystack, $needle){
		foreach($haystack as $discount_category){
			if ($discount_category['discount_category_id']==$needle){
				// var_dump($value['product_feature_value_id']); 
				// var_dump($needle); 
				return true;
			}
			}
		return false;
	}
    
	// log common access
	public static function logAccess(){
		$action_query = 'INSERT into admin_users_access_log (
			 date,
			 ip,
			 action,
			 parameters
		 )  values (
			 now(),
			 "'.$_SERVER['REMOTE_ADDR'].'",
			 "'.$_SERVER['REQUEST_URI'].'",
			 "'.addslashes('POST: ' . json_encode($_POST)).'")';
		 // echo $action_query;
		 
		 DB::getInstance()->query($action_query);

	}
	
	public static function updateConfigurationValue($key,$value){
		$key = Utils::sanitize($key);
		$value = addslashes($value);
					
		$update_query = 'UPDATE configuration set configuration_value="'.$value.'" where configuration_key="'.$key.'"';
		
		DB::getInstance()->query($update_query);
	}
	
	public static function getConfigurationValue($key){
					
		$configuration_query = 'SELECT configuration_value FROM configuration WHERE configuration_key = "'.$key.'"';
		$configuration_result = DB::getInstance()->queryS($configuration_query);
		
		if (count($configuration_result) == 1) {
			return $configuration_result[0]['configuration_value'];
		} else return false;
	}
	
	public static function getConfigurationValues(){
					
		$configuration_query = 'SELECT * FROM configuration';
		$configuration_result = DB::getInstance()->queryS($configuration_query);
		
		$data = array();
		foreach($configuration_result as $configuration_item){
			$data[$configuration_item['configuration_key']] = $configuration_item['configuration_value'];
		}
		
		return $data;
	}
	
	
	
	public static function generateRandomString($length = 32) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	} 

	public static function getImportLogs($limit=20) {
		$import_log_query = 'SELECT * FROM import_logs ORDER BY import_log_id DESC LIMIT '. (int)$limit;
		$import_log_result = DB::getInstance()->queryS($import_log_query);
		
		return $import_log_result;
	}	
	
	public static function checkAdminPermissions() {
		if (isset($_GET['controller']) && !empty($_GET['controller'])){
			$controller = $_GET['controller'];
		} else {
			$controller = "homeController";
		}
		
		// Login page has always allowed
		if ($controller=="loginController") {
			return true;
		}
		
		if (isset($_SESSION['admin_login']['superadmin'])){
		
			//Get controller permissions
			$controller_query = "SELECT * FROM `admin_navigation` WHERE `admin_navigation_controller` like '".$controller."'";
			
			$controller_result = DB::getInstance()->queryS($controller_query);

			if (isset($controller_result[0]['superadmin'])){
				if (intval($_SESSION['admin_login']['superadmin'])>=intval($controller_result[0]['superadmin'])){
					return true;
				}
			}
		}
		
		return false;
		
	}
	
	public static function randomHash($len=32) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
	  
		for ($i = 0; $i < $len; $i++) {
			$index = rand(0, strlen($characters) - 1);
			$randomString .= $characters[$index];
		}
	  
		return $randomString;
	}		
	
	public static function formatSetDescriptionHTML($product_set_description){
		if (trim($product_set_description)){
			$items = explode(";",$product_set_description);
			
			$qty_html="";
			$total_items=0;
			
			foreach ($items as $item) {
				$item = explode(":",$item);
				
				if (strtolower(trim($item[0]))=="total") 
					continue;
				
				$qty_html .= "<div style=\"display:inline-block;width:45px;border-right:1px solid #000000;\">
					<div style=\"padding:2px;text-align:center;background:#000000;color:#FFFFFF;\">".$item[0]."</div><div style=\"padding:2px;text-align:center;background:#FFFFFF;color:#000000;border-bottom:1px solid #000000;\">".$item[1]."</div></div>";
				$total_items += intval($item[1]); 
			}
			
			$output_html = "<div style=\"border-left:1px solid #000000;\">";
			$output_html .= "<div style=\"display:inline-block;width:80px;border-right:1px solid #000000;\"><div style=\"padding:2px;text-align:center;background:#000000;color:#FFFFFF;\">TOTAL</div><div style=\"padding:2px;text-align:center;background:#FFFFFF;color:#000000;border-bottom:1px solid #000000;\">".$total_items." unidades</div></div>";
			$output_html .= $qty_html;
			$output_html .= "</div>";
			
			return $output_html;
		} else {
			return "";
		}
	
	}


	
	public static function formatSetDescriptionHTMLTable($product_set_description){
		if (trim($product_set_description)){
			$items = explode(";",$product_set_description);
			
			$qty_html="";
			$total_items=0;
			
			$row_1 = array();
			$row_2 = array();
			
			foreach ($items as $item) {
				$item = explode(":",$item);
				
				if (strtolower(trim($item[0]))=="total") 
					continue;
					
				$row_1[] = $item[0];
				$row_2[] = $item[1];
				
				$total_items += intval($item[1]); 
			}
			
			
			$output_html = '<table border="0" cellpadding="0" style="border:0px;"><tr>';
			$output_html .= "</tr><tr>";
			$output_html .= '<th style="border-right:1px solid #000000;border-left:1px solid #000000;padding:3px;text-align:center;background:#000000;color:#FFFFFF;">CONTENIDO DEL LOTE</th>';
			foreach ($row_1 as $atributo){
				$output_html .= '<th style="border-right:1px solid #000000;padding:3px 10px;text-align:center;background:#000000;color:#FFFFFF;"><center>'.$atributo.'</center></th>';
			}
			$output_html .= "</tr><tr>";
			$output_html .= '<td style="border-right:1px solid #000000;border-left:1px solid #000000;border-bottom:1px solid #000000;;padding:3px 10px;text-align:center;">'.$total_items.'</td>';
			foreach ($row_2 as $cantidad){
				$output_html .= '<td style="border-right:1px solid #000000;border-bottom:1px solid #000000;;padding:3px 10px;text-align:center;"><center>'.$cantidad.'</center></td>';
			}
			
			$output_html .= "</tr></table>";
			
			return $output_html;
		} else {
			return "";
		}
	
	}

	public static function saveFile($src_file, $dst_file){
		if (move_uploaded_file($src_file, $dst_file)) {
			return true;
		} else {
			return false;
		}
	}

}
?>