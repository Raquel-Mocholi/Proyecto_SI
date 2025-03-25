<?php /* Smarty version 3.1.24, created on 2025-03-20 12:17:14
         compiled from "template/admin/common/navbar.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:40173553667dbf93a495de6_49958889%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd699c21eda01c4e7caa9039b13e5b56b55aa6238' => 
    array (
      0 => 'template/admin/common/navbar.tpl',
      1 => 1742339428,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '40173553667dbf93a495de6_49958889',
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_67dbf93a496489_00225777',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_67dbf93a496489_00225777')) {
function content_67dbf93a496489_00225777 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '40173553667dbf93a495de6_49958889';
?>
<nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
	<div class="container-fluid">
	  <div class="navbar-wrapper">
		<div class="navbar-toggle">
		  <button type="button" class="navbar-toggler">
			<span class="navbar-toggler-bar bar1"></span>
			<span class="navbar-toggler-bar bar2"></span>
			<span class="navbar-toggler-bar bar3"></span>
		  </button>
		</div>
		<a class="navbar-brand" href="#">Turistic APP</a>&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<a class="navbar-brand" href="index.php?controller=loginController&action=logout"><i class="fa fa-power-off"> Cerrar sesión </i></a>
	  </div>
	</div>
  </nav><?php }
}
?>