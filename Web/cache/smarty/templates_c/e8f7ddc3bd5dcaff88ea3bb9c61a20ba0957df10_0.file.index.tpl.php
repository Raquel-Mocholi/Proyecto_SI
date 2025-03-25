<?php /* Smarty version 3.1.24, created on 2025-03-20 12:02:43
         compiled from "template/admin/index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:209617744367dbf5d3011725_15121662%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e8f7ddc3bd5dcaff88ea3bb9c61a20ba0957df10' => 
    array (
      0 => 'template/admin/index.tpl',
      1 => 1742339426,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '209617744367dbf5d3011725_15121662',
  'variables' => 
  array (
    'navitems' => 0,
    'sections' => 0,
    'navitem' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_67dbf5d3019b66_99177104',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_67dbf5d3019b66_99177104')) {
function content_67dbf5d3019b66_99177104 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '209617744367dbf5d3011725_15121662';
?>

<div class="main-panel">
	<!-- Navbar -->
	<?php echo $_smarty_tpl->getSubTemplate ("admin/common/navbar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

	<!-- End Navbar -->


	<div class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="card ">
					<div class="card-header ">
						<h5 class="card-title">Turistic APP</h5>
						<p class="card-category">Desde este panel puede visualizar y gestionar sus lugares de interés turístico.</p>
					</div>
					<div class="card-body ">
						
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
								<div class="row">
									<div class="col-12 col-md-12">
										<h4 style="width:100%; border-bottom:1px solid #333333;margin-top:25px;"><?php echo $_smarty_tpl->tpl_vars['sections']->value['admin_category_name'];?>
</h4>
									</div>
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
									
									<div class="col-6 col-md-2 home-icons">
										<a href="./<?php echo $_smarty_tpl->tpl_vars['navitem']->value['link'];?>
">
											<i class="<?php echo $_smarty_tpl->tpl_vars['navitem']->value['icon'];?>
"></i><br>
											<p><?php echo $_smarty_tpl->tpl_vars['navitem']->value['name'];?>
</p>
										</a>
									</div>
									<?php
$_smarty_tpl->tpl_vars['navitem'] = $foreach_navitem_Sav;
}
?> 
								</div>
							<?php }?>
						 <?php
$_smarty_tpl->tpl_vars['sections'] = $foreach_sections_Sav;
}
?> 

					</div>
					<div class="card-footer ">
						<hr>
		
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php }
}
?>