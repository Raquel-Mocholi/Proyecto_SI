<?php 
/**
 * @author Alfonso Patiño
 * @copyright 2021
 */
chdir ("../img/");

$image_width = 165;
$image_height =165;
$image_quality = 80;
$image_directory = "products-mini";
		
$image_path = urldecode($_SERVER['REQUEST_URI']);
$image_path_array = explode("/",$image_path);
$image_name = $image_path_array[count($image_path_array)-1];


// *****************  Generación del thumb  ***************************

// Get orignal file complete path

$original_file = 'products/'.$image_name;

$original_file=urldecode($original_file);

// Check if orignal file exists
if (!file_exists($original_file)){
    header("HTTP/1.0 404 Not Found");	
    exit('File not found');
}

$ext = pathinfo($original_file, PATHINFO_EXTENSION); 
$ext = strtolower($ext);

$image_type = exif_imagetype ($original_file);

switch($image_type){
    case 1:
        $image_source = @imagecreatefromgif($original_file);
        break;
    
    case 2:
        $image_source = @imagecreatefromjpeg($original_file);
        break;
    
    case 3:
        $image_source = @imagecreatefrompng($original_file);
        break;
    default:
        header("HTTP/1.0 500 Internal Server Error");
        exit('Internal Server Error');
}


// Get the original image size
$orig_src_w = imagesx($image_source); 
$orig_src_h = imagesy($image_source); 

 if (($image_width/$image_height)>($orig_src_w/$orig_src_h)){
	 // Quedará espacio a los lados
	 $src_w = $orig_src_w;
	 $src_h = $orig_src_h; 
				
	 $src_x = 0;
	 $src_y = 0;
	  
	 $dst_x = (int)(($image_width - ($src_w/$src_h)*$image_height)/2);
	 $dst_y = 0;
	 
	 $dst_w = (int)(($src_w/$src_h)*$image_height);
	 $dst_h = $image_height;
} else {
	 // Quedará espacio arriba y abajo
	 $src_w = $orig_src_w;
	 $src_h = $orig_src_h;
	 
	 $src_x = 0;
	 $src_y = 0;
	 
	 $dst_x = 0;
	 $dst_y = ($image_height - ($src_h/$src_w)*$image_width)/2;
	 
	 $dst_w = $image_width;
	 $dst_h = ($src_h/$src_w)*$image_width;
}

// Create destination image canvas
$thumb_image=imagecreatetruecolor($image_width,$image_height);

//Set background color
$bg_color = imagecolorallocate($thumb_image, 255, 255, 255);
if ($ext=="png") {
	imagefill($thumb_image, 0, 0, $bg_color);
	imagealphablending($thumb_image,true);
}else {
	imagefill($thumb_image, 0, 0, $bg_color);
}


// Copy resampled thumbnail
ImageCopyResampled($thumb_image,$image_source,$dst_x,$dst_y,$src_x,$src_y,$dst_w,$dst_h,$src_w,$src_h);

switch($ext){
	case "jpeg":
	case "jpg":	
		imageJpeg($thumb_image,$image_directory.'/'.$image_name,$image_quality); 
		break;
	case "gif": 
		imagegif($thumb_image,$image_directory.'/'.$image_name,$image_quality); 
		break;
	case "png": 
		imagepng($thumb_image,$image_directory.'/'.$image_name,9); 
		break;
}


//Show image
$image2show = file_get_contents($image_directory.'/'.$image_name);

switch($ext){
	case "jpeg":
	case "jpg":	
		header("Content-type: image/jpeg"); 
		break;
	case "gif": 
		header("Content-type: image/gif"); 
		break;
	case "png": 
		header("Content-type: image/png");
		break;
}

header("Content-length: " .strlen($image2show)); 
header("Keep-Alive: timeout=5, max=100"); 
echo $image2show;

?>