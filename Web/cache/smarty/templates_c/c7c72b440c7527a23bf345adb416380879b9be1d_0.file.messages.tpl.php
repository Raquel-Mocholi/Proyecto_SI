<?php /* Smarty version 3.1.24, created on 2025-03-20 12:17:14
         compiled from "template/admin/common/messages.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:83623354667dbf93a49d740_38300051%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c7c72b440c7527a23bf345adb416380879b9be1d' => 
    array (
      0 => 'template/admin/common/messages.tpl',
      1 => 1676976940,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '83623354667dbf93a49d740_38300051',
  'variables' => 
  array (
    'messages' => 0,
    'message' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_67dbf93a49f274_25498140',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_67dbf93a49f274_25498140')) {
function content_67dbf93a49f274_25498140 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '83623354667dbf93a49d740_38300051';
?>
<?php echo '<script'; ?>
>
<?php
$_from = $_smarty_tpl->tpl_vars['messages']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['message'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['message']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['message']->value) {
$_smarty_tpl->tpl_vars['message']->_loop = true;
$foreach_message_Sav = $_smarty_tpl->tpl_vars['message'];
?>
	$.notify({
		message: '<?php echo $_smarty_tpl->tpl_vars['message']->value['message'];?>
'
	},{
		type: '<?php echo $_smarty_tpl->tpl_vars['message']->value['type'];?>
'
	});
<?php
$_smarty_tpl->tpl_vars['message'] = $foreach_message_Sav;
}
?>
<?php echo '</script'; ?>
><?php }
}
?>