<?php

/**
 * @author Alfonso Patiño
 * @copyright 2025
 */

include('ext/phpqrcode/qrlib.php');


class QrController {
    var $params; 
	var $tpl;
	var $search_result;

    function init() {
		// Initialize Smarty var
		$this->tpl = $GLOBALS['smarty'];
		
		$this->params = Utils::getParams();

		if (isset($_GET['hash']) && !empty($_GET['hash'])){
			$hash = $_GET['hash'];
		} else {
			QRcode::png('PHP QR Code :)');
			die();
		}
	
		$url = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]/index.php?controller=placeController&$hash";
		QRcode::png($url);

		
		
		
    }


}
?>