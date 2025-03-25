<?php /* Smarty version 3.1.24, created on 2025-03-20 12:01:09
         compiled from "template/front/common/messages.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:23028658767dbf575ab9720_21220163%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c7cad00f4f51356700071a1a24dfddc563e90d9f' => 
    array (
      0 => 'template/front/common/messages.tpl',
      1 => 1676976943,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '23028658767dbf575ab9720_21220163',
  'variables' => 
  array (
    'messages' => 0,
    'message' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_67dbf575ac1567_68166466',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_67dbf575ac1567_68166466')) {
function content_67dbf575ac1567_68166466 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '23028658767dbf575ab9720_21220163';
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