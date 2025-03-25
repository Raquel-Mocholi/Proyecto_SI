<?php

/**
 * @author Alfonso Patiño
 * @copyright 2025
 */

ini_set('display_errors','on');
ini_set('memory_limit','1024M');

date_default_timezone_set('Europe/Madrid');

// Database
define('HOST', 'localhost'); 
define('MYSQL_USER', 'alpat_turistic'); 
define('MYSQL_PASSWORD', 'vNUdT9%!^225');
define('MYDB', 'alpat_turistic'); 

define('PAGE_TITLE','Turistic - 1º DAW');
define('PAGE_META_DESCRIPTION','Turistic - 1º DAW');
			
define('PLACE_IMAGE_PATH','data/img/');
define('PLACE_SPEECH_PATH','data/audio/');
define('ASSETS_PATH','data/assets/');

define('DEFAULT_PAGE_ITEMS',100);
define('DEFAULT_ITEMS_PER_ROW',3);

?>