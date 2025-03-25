<?php

/**
 * @author Alfonso Patiño
 * @copyright 2025
 */

// MySQL Conection
require('classes/db.php');
require('classes/utils.php');

// Smarty initialization
require('smarty/Smarty.class.php');
$smarty = new Smarty;

$smarty->caching = 0;

$smarty->template_dir = 'template/';
$smarty->compile_dir = 'cache/smarty/templates_c/';
$smarty->config_dir = 'cache/smarty/configs/';
$smarty->cache_dir = 'cache/smarty/cache/';

$smarty->force_compile = true;
$smarty->debugging = false;

Utils::initSession();

// Load configuration values
Utils::loadConfiguration();
