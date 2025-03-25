<?php

$mini_exists = false;

if (isset($_GET['type']) && ($_GET['type']=='product')){
	$output_dir = '../../img/products/';
	$mini_exists = true;
	$output_mini_dir = '../../img/products-mini/';
}else if (isset($_GET['type']) && ($_GET['type']=='category')){
	$output_dir = '../../img/categories/sliders/';
}else if (isset($_GET['type']) && ($_GET['type']=='discountcategory')){
	$output_dir = '../../img/discount_categories/sliders/';
} else {
	die("type not specified");
}


 
error_reporting(E_ALL);

if (isset($_FILES["myfile"])) {
	$ret = array();
	
	$error = $_FILES["myfile"]["error"];    
		
	if (!is_array($_FILES["myfile"]['name'])) {
	
		$fileName = $_FILES["myfile"]["name"];
		
		//Avoid overwrite files
		// while (file_exists($output_dir . $fileName)){
			// $fileName =  rand(100,999) .'_'. $fileName;
		// } 
		
		move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . $fileName);
		$ret[$fileName] = $fileName;
		
		// Delete thumbnail cache
		if ($mini_exists){
			@unlink($output_mini_dir . $fileName);
		}
	} else {
		$fileCount = count($_FILES["myfile"]['name']);
		for ($i = 0; $i < $fileCount; $i++) {

			$fileName = $_FILES["myfile"]["name"][$i];
			
			//Avoid overwrite files
			// while (file_exists($output_dir . $fileName)){
				// $fileName =  rand(100,999) .'_'. $fileName;
			// } 
			
			move_uploaded_file($_FILES["myfile"]["tmp_name"][$i], $output_dir . $fileName);
			$ret[$fileName] = $fileName;
			
			// Delete thumbnail cache
			if ($mini_exists){
				@unlink($output_mini_dir . $fileName);
			}
		}
		
	}
	
	echo json_encode($ret);

}

?>