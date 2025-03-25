<?php /* Smarty version 3.1.24, created on 2025-03-20 12:02:44
         compiled from "template/admin/configuration.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:91473232767dbf5d46eaf19_89676769%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aa242a0538b9e09feda54f0f1956312e3b239875' => 
    array (
      0 => 'template/admin/configuration.tpl',
      1 => 1679357329,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '91473232767dbf5d46eaf19_89676769',
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_67dbf5d46f2e57_42442223',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_67dbf5d46f2e57_42442223')) {
function content_67dbf5d46f2e57_42442223 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '91473232767dbf5d46eaf19_89676769';
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
						<h5 class="card-title">Configuración y personalización</h5>
						<p class="description">Desde este apartado podrá configurar algunos parámetros de la web</p>
					</div>
				</div>
				
				<div class="card "> 
					<div class="card-header ">
					</div>
					<div class="card-body ">
						<form action="index.php?controller=configurationController&action=save" method="post" enctype="multipart/form-data">
							<div class="content">                         
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Contenido superior del correo de pedido</label>
											<textarea name="ORDER_MAIL_TOP_CONTENT"  id="ORDER_MAIL_TOP_CONTENT" class="form-control textarea"><?php echo $_smarty_tpl->tpl_vars['data']->value['ORDER_MAIL_TOP_CONTENT'];?>
</textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Contenido inferior del correo de pedido</label>
											<textarea name="ORDER_MAIL_BOTTOM_CONTENT" id="ORDER_MAIL_BOTTOM_CONTENT" class="form-control textarea"><?php echo $_smarty_tpl->tpl_vars['data']->value['ORDER_MAIL_BOTTOM_CONTENT'];?>
</textarea>
										</div>
									</div>
								</div>                         
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Contenido superior del correo de gestión de defectuosos</label>
											<textarea name="RETURN_PRODUCTS_MAIL_TOP_CONTENT"  id="RETURN_PRODUCTS_MAIL_TOP_CONTENT" class="form-control textarea"><?php echo $_smarty_tpl->tpl_vars['data']->value['RETURN_PRODUCTS_MAIL_TOP_CONTENT'];?>
</textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Contenido inferior del correo de gestión de defectuosos</label>
											<textarea name="RETURN_PRODUCTS_MAIL_BOTTOM_CONTENT" id="RETURN_PRODUCTS_MAIL_BOTTOM_CONTENT" class="form-control textarea"><?php echo $_smarty_tpl->tpl_vars['data']->value['RETURN_PRODUCTS_MAIL_BOTTOM_CONTENT'];?>
</textarea>
										</div>
									</div>
								</div> 
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Mensaje tras la finalización del proceso de gestión de defectuosos</label>
											<textarea name="RETURN_REQUEST_FINISH_TEXT" id="RETURN_REQUEST_FINISH_TEXT" class="form-control textarea"><?php echo $_smarty_tpl->tpl_vars['data']->value['RETURN_REQUEST_FINISH_TEXT'];?>
</textarea>
										</div>
									</div>
								</div> 
                                <div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>IPs de mantenimiento</label>
											<textarea name="MAINTENANCE_IPS" id="MAINTENANCE_IPS" class="form-control textarea"><?php echo $_smarty_tpl->tpl_vars['data']->value['MAINTENANCE_IPS'];?>
</textarea>
										</div>
									</div>
								</div>  
                                <div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Campos para exportar en el CSV de pedido</label>
											<textarea style="max-height:150px !important; height:150px !important" name="ORDER_PRODUCTS_FIELDS_TO_EXPORT" id="ORDER_PRODUCTS_FIELDS_TO_EXPORT" class="form-control textarea"><?php echo $_smarty_tpl->tpl_vars['data']->value['ORDER_PRODUCTS_FIELDS_TO_EXPORT'];?>
</textarea>
										</div>
										<div><span style="font-weight:bold;">FORMATO:</span> [o|op].nombre_del_campo_en_la_bbdd AS Nombre_a_mostrar_en_la_cabecera_de_la_columna. <br>La tabla "o" corresponde a los campos de la tabla "orders" y "op" a los campos de la tabla "order_products"</div>
									</div>
								</div> 
								<br>
                                <div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Rangos de disponibilidad</label>
											<input type="text" name="AVAILABILITY_RANGES" id="AVAILABILITY_RANGES" class="form-control input" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['AVAILABILITY_RANGES'];?>
">
										</div>
										<div><span style="font-weight:bold;">FORMATO:</span> A;B -> Siendo disponibilidad alta más de A%, disponibilidad media entre A% y B% y baja menos de B%</div>
									</div>
								</div>   
							</div>	
							<div class="row">
								<div class="update ml-auto mr-auto">
									<button type="submit" class="btn btn-primary btn-round">Guardar</button>
								</div>
							</div>								
						</form>
					</div>
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
			CKEDITOR.replace( 'ORDER_MAIL_BOTTOM_CONTENT',{filebrowserBrowseUrl:roxyFileman,
															filebrowserImageBrowseUrl:roxyFileman+'?type=image',
															removeDialogTabs: 'link:upload;image:upload'}); 
			CKEDITOR.replace( 'ORDER_MAIL_TOP_CONTENT',{filebrowserBrowseUrl:roxyFileman,
															filebrowserImageBrowseUrl:roxyFileman+'?type=image',
															removeDialogTabs: 'link:upload;image:upload'}); 
			CKEDITOR.replace( 'RETURN_PRODUCTS_MAIL_TOP_CONTENT',{filebrowserBrowseUrl:roxyFileman,
															filebrowserImageBrowseUrl:roxyFileman+'?type=image',
															removeDialogTabs: 'link:upload;image:upload'}); 
			CKEDITOR.replace( 'RETURN_PRODUCTS_MAIL_BOTTOM_CONTENT',{filebrowserBrowseUrl:roxyFileman,
															filebrowserImageBrowseUrl:roxyFileman+'?type=image',
															removeDialogTabs: 'link:upload;image:upload'}); 
			CKEDITOR.replace( 'RETURN_REQUEST_FINISH_TEXT',{filebrowserBrowseUrl:roxyFileman,
															filebrowserImageBrowseUrl:roxyFileman+'?type=image',
															removeDialogTabs: 'link:upload;image:upload'}); 		
		});

	<?php echo '</script'; ?>
>

<?php }
}
?>