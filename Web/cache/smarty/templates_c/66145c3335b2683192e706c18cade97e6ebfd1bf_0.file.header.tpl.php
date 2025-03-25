<?php /* Smarty version 3.1.24, created on 2025-03-20 12:17:14
         compiled from "template/admin/common/header.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:166449166667dbf93a46ab27_29709707%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '66145c3335b2683192e706c18cade97e6ebfd1bf' => 
    array (
      0 => 'template/admin/common/header.tpl',
      1 => 1742303797,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '166449166667dbf93a46ab27_29709707',
  'variables' => 
  array (
    'navitems' => 0,
    'sections' => 0,
    'navitem' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_67dbf93a479b80_99854632',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_67dbf93a479b80_99854632')) {
function content_67dbf93a479b80_99854632 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '166449166667dbf93a46ab27_29709707';
?>
<body class="">
  <div class=" ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="./" class="simple-text logo-normal" style="text-align:center;">
          <img src="/<?php echo ASSETS_PATH;?>
/logo-turistic.png?nocache=<?php echo rand(10,100);?>
">
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
		<?php
$_from = $_smarty_tpl->tpl_vars['navitems']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['sections'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['sections']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['sections']->value) {
$_smarty_tpl->tpl_vars['sections']->_loop = true;
$foreach_sections_Sav = $_smarty_tpl->tpl_vars['sections'];
?>
			<?php if (count($_smarty_tpl->tpl_vars['sections']->value['sections']) > 0) {?>
				<li <?php if ($_smarty_tpl->tpl_vars['sections']->value['active']) {?>class="activado"<?php }?>>
					<a href="#"><?php echo $_smarty_tpl->tpl_vars['sections']->value['admin_category_name'];?>
<i class="fa fa-chevron-down"></i></a>
					<ul <?php if ($_smarty_tpl->tpl_vars['sections']->value['active']) {?>style="display:block;"<?php }?>>
					<?php
$_from = $_smarty_tpl->tpl_vars['sections']->value['sections'];
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['navitem'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['navitem']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['navitem']->value) {
$_smarty_tpl->tpl_vars['navitem']->_loop = true;
$foreach_navitem_Sav = $_smarty_tpl->tpl_vars['navitem'];
?>
						<li <?php if (($_smarty_tpl->tpl_vars['navitem']->value['active'] == 1)) {?>class="active"<?php }?>>
							<a href="./<?php echo $_smarty_tpl->tpl_vars['navitem']->value['link'];?>
">
								<i class="<?php echo $_smarty_tpl->tpl_vars['navitem']->value['icon'];?>
"></i>
								<p><?php echo $_smarty_tpl->tpl_vars['navitem']->value['name'];?>
</p>
							</a>
						</li>
					<?php
$_smarty_tpl->tpl_vars['navitem'] = $foreach_navitem_Sav;
}
?> 
					</ul>
				</li>
			<?php }?>
		 <?php
$_smarty_tpl->tpl_vars['sections'] = $foreach_sections_Sav;
}
?> 
        </ul>
      </div>
    </div>

<?php }
}
?>