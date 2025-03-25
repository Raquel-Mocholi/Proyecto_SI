<?php /* Smarty version 3.1.24, created on 2025-03-20 12:17:20
         compiled from "template/front/common/head.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:27808424267dbf940d45943_51795694%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '05ef6c30000e8be2fef0e446502c26ed66a97482' => 
    array (
      0 => 'template/front/common/head.tpl',
      1 => 1742432632,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27808424267dbf940d45943_51795694',
  'variables' => 
  array (
    'nocache_id' => 0,
    'placesData' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_67dbf940d747a3_53674643',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_67dbf940d747a3_53674643')) {
function content_67dbf940d747a3_53674643 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '27808424267dbf940d45943_51795694';
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Turistic APP</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	
	<link rel="apple-touch-icon" href="/data/assets/logo-turistic-icon.png?nocache=<?php echo rand(10,100);?>
">
	
	<!--     Fonts and icons     -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">

	<?php echo '<script'; ?>
 src="js/jquery-3.3.1.min.js"><?php echo '</script'; ?>
>

	<!-- CSS Files -->
	<link href="js/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	
	<?php $_smarty_tpl->tpl_vars['nocache_id'] = new Smarty_Variable(mt_rand(10,20), null, 0);?>
	<link href="css/stylesheet-fo.css?nocache=<?php echo $_smarty_tpl->tpl_vars['nocache_id']->value;?>
" rel="stylesheet" />
	
	<!-- jquery-ui -->
	<link href="js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
	<?php echo '<script'; ?>
 src="js/jquery-ui/jquery-ui.min.js"><?php echo '</script'; ?>
>
	
	<?php echo '<script'; ?>
 src="js/general.js?nocache=<?php echo $_smarty_tpl->tpl_vars['nocache_id']->value;?>
"><?php echo '</script'; ?>
>
	

	
	<?php echo '<script'; ?>
 src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-_861lMGSKL-WmuIymjpy6IjfyyppeWU"><?php echo '</script'; ?>
>
	
	<?php echo '<script'; ?>
>
		var places=<?php echo $_smarty_tpl->tpl_vars['placesData']->value;?>
;
	<?php echo '</script'; ?>
>
</head>
<?php }
}
?>