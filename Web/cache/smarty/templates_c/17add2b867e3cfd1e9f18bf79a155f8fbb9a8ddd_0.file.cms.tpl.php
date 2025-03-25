<?php /* Smarty version 3.1.24, created on 2025-03-19 00:51:42
         compiled from "template/admin/cms.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:203773350967da070e316551_76066380%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '17add2b867e3cfd1e9f18bf79a155f8fbb9a8ddd' => 
    array (
      0 => 'template/admin/cms.tpl',
      1 => 1676976936,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '203773350967da070e316551_76066380',
  'variables' => 
  array (
    'action' => 0,
    'cms_data' => 0,
    'cms' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_67da070e322b12_06309854',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_67da070e322b12_06309854')) {
function content_67da070e322b12_06309854 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_truncate')) require_once '/home/alpati0/www/turistic/smarty/plugins/modifier.truncate.php';

$_smarty_tpl->properties['nocache_hash'] = '203773350967da070e316551_76066380';
?>

    <div class="main-panel">
      <!-- Navbar -->
      <?php echo $_smarty_tpl->getSubTemplate ("admin/common/navbar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

      <!-- End Navbar -->
	  
<?php if ($_smarty_tpl->tpl_vars['action']->value == "list") {?>
      <div class="content">
	  
        <div class="row">
          <div class="col-md-12">
           <div class="card "> 
              <div class="card-header ">
                <a href="index.php?controller=cmsController&action=new_cms" class="btn btn-primary btn-round" style="float:right"><i class="nc-icon nc-simple-add"></i> Nueva sección</a>
				<h5 class="card-title">Secciones estáticas</h5>
                <p class="description">Desde este apartado podrá crear nuevas secciones estáticas.</p>
              </div>
			</div>
			
			<?php
$_from = $_smarty_tpl->tpl_vars['cms_data']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['cms'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['cms']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['cms']->value) {
$_smarty_tpl->tpl_vars['cms']->_loop = true;
$foreach_cms_Sav = $_smarty_tpl->tpl_vars['cms'];
?>
			 <div class="card "> 
				<div class="card-body">
					<div class="content">
						<div class="row">
							<div class="col-md-10">
								<div class="text-left" style="font-size:18px;font-weight:normal;"><?php echo $_smarty_tpl->tpl_vars['cms']->value['cms_title'];?>
</div>
								<div class="text-left" style="font-size:12px;font-style:italic"><?php echo $_smarty_tpl->tpl_vars['cms']->value['cms_date'];?>
</div>
								<div class="text-left" style="padding:5px 0px;font-size:12px;font-style:italic"><?php echo smarty_modifier_truncate(strip_tags($_smarty_tpl->tpl_vars['cms']->value['cms_description']),150);?>
...</div>
							</div>
							<div class="col-md-2">
								<a href="index.php?controller=cmsController&action=edit_cms&cms_id=<?php echo $_smarty_tpl->tpl_vars['cms']->value['cms_id'];?>
" class="btn btn-sm btn-round" >editar</a>
								<a href="index.php?controller=cmsController&action=delete_cms&cms_id=<?php echo $_smarty_tpl->tpl_vars['cms']->value['cms_id'];?>
" class="btn btn-sm btn-round btn-danger confirm-delete-cms"  >eliminar</a>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			<?php
$_smarty_tpl->tpl_vars['cms'] = $foreach_cms_Sav;
}
?>

          </div>
        </div>
      </div>
    
	
	<?php echo '<script'; ?>
>
        $(function() {    
			$('.confirm-delete-cms').confirm({
				text: "Borrar sección",
				title: "¿Está seguro que desea borrar la seccion?",
				cancel: function(button) {
					// nothing to do
				},
				confirmButton: "Sí, borrar",
				cancelButton: "No",
				post: false,
				confirmButtonClass: "btn-danger",
				cancelButtonClass: "btn-default",
				dialogClass: "modal-dialog modal-lg" // Bootstrap classes for large modal
			});
			
			
		});
	<?php echo '</script'; ?>
>
	
	<?php  } else { if (!isset($_smarty_tpl->tpl_vars['action'])) $_smarty_tpl->tpl_vars['action'] = new Smarty_Variable(null);if ($_smarty_tpl->tpl_vars['action']->value = "edit") {?>
	
	
	<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card ">
				<div class="card-header ">
                <a href="javascript:history.back();" class="btn btn-primary btn-round" style="float:right"><i class="nc-icon nc-minimal-left"></i> volver</a>
				<h5 class="card-title"><?php if (($_smarty_tpl->tpl_vars['cms_data']->value->cms_id == 0)) {?>Nueva sección<?php } else { ?>Editar sección<?php }?></h5>
                <p class="card-category">Información de la sección</p>
              </div>
              <div class="card-body ">
				<form action="index.php?controller=cmsController&action=save_cms" method="post" enctype="multipart/form-data">
					<input type="hidden" name="cms_id" value="<?php echo $_smarty_tpl->tpl_vars['cms_data']->value->cms_id;?>
">
					  <div class="row">
						<div class="col-md-5 pr-1">
						  <div class="form-group"> 
							<label>Titulo de la sección</label>
							<input type="text" class="form-control" name="cms_title" placeholder="Título de la sección" required value="<?php echo $_smarty_tpl->tpl_vars['cms_data']->value->cms_title;?>
">
						  </div>
						</div>
					  </div> 					                                 
					  <div class="row">
						<div class="col-md-12">
						  <div class="form-group">
							<label>Descripción de la sección</label>
							<textarea name="cms_description"  id="cms_description" class="form-control textarea"><?php echo $_smarty_tpl->tpl_vars['cms_data']->value->cms_description;?>
</textarea>
						  </div>
						</div>
					  </div>

					  
					  <div class="row">
						<div class="update ml-auto mr-auto">
						  <button type="submit" class="btn btn-primary btn-round"><?php if (($_smarty_tpl->tpl_vars['cms_data']->value->cms_id == 0)) {?>Crear la sección<?php } else { ?>Actualizar la sección<?php }?></button>
						</div>
					  </div>
				</form>
              </div>
            </div>
          </div>
        </div>
      </div>
	  
	  
	
	<?php echo '<script'; ?>
 src="../js/ckeditor/ckeditor.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
>
		var roxyFileman = '../ext/fileman/index.html'; 
		$(function(){
			CKEDITOR.replace( 'cms_description',{filebrowserBrowseUrl:roxyFileman,
															filebrowserImageBrowseUrl:roxyFileman+'?type=image',
															removeDialogTabs: 'link:upload;image:upload'});					
		});
	<?php echo '</script'; ?>
>
	
	
	
	<?php }}
}
}
?>