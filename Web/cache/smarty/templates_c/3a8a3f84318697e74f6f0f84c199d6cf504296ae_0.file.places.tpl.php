<?php /* Smarty version 3.1.24, created on 2025-03-20 12:17:14
         compiled from "template/admin/places.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:15003266867dbf93a47d237_44259251%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3a8a3f84318697e74f6f0f84c199d6cf504296ae' => 
    array (
      0 => 'template/admin/places.tpl',
      1 => 1742381034,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15003266867dbf93a47d237_44259251',
  'variables' => 
  array (
    'action' => 0,
    'places_data' => 0,
    'place' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_67dbf93a491ec9_16836615',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_67dbf93a491ec9_16836615')) {
function content_67dbf93a491ec9_16836615 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_truncate')) require_once '/home/alpati0/www/turistic/smarty/plugins/modifier.truncate.php';

$_smarty_tpl->properties['nocache_hash'] = '15003266867dbf93a47d237_44259251';
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
                <a href="index.php?controller=placesController&action=new_place" class="btn btn-primary btn-round" style="float:right"><i class="nc-icon nc-simple-add"></i> Nueva lugar de interés</a>
				<h5 class="card-title">Lugar de interéss</h5>
                <p class="description">Desde este apartado podrá crear nuevas lugar de interéss.</p>
              </div>
			</div>
			
			<?php
$_from = $_smarty_tpl->tpl_vars['places_data']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['place'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['place']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['place']->value) {
$_smarty_tpl->tpl_vars['place']->_loop = true;
$foreach_place_Sav = $_smarty_tpl->tpl_vars['place'];
?>
			 <div class="card "> 
              <div class="card-body ">
			  
				<div class="content">
					<div class="row">
						<div class="col-md-2">
							<?php if ((file_exists("data/img/place_".((string)$_smarty_tpl->tpl_vars['place']->value['place_id']).".jpg"))) {?>
							<p class="text-left" ><img src="../data/img/place_<?php echo $_smarty_tpl->tpl_vars['place']->value['place_id'];?>
.jpg" style="max-width:150px;max-height:100px;" title="<?php echo $_smarty_tpl->tpl_vars['place']->value['place_title'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['place']->value['place_title'];?>
"></p>
							<?php }?>
						</div>
						<div class="col-md-7">
							<div class="text-left" style="font-size:18px;font-weight:normal;"><?php echo $_smarty_tpl->tpl_vars['place']->value['place_title'];?>
</div>
							<div class="text-left" style="font-size:12px;font-style:italic"><?php echo $_smarty_tpl->tpl_vars['place']->value['place_date'];?>
</div>
							<div class="text-left" style="padding:5px 0px;font-size:12px;font-style:italic"><?php echo smarty_modifier_truncate(strip_tags($_smarty_tpl->tpl_vars['place']->value['place_description']),150);?>
...</div>
						</div>
						<div class="col-md-1">
							<p class="text-left" ><img src="/index.php?controller=qrController&hash=<?php echo $_smarty_tpl->tpl_vars['place']->value['place_hash'];?>
" style="width:100px;" title="QR Code de <?php echo $_smarty_tpl->tpl_vars['place']->value['place_title'];?>
" alt="QR Code de <?php echo $_smarty_tpl->tpl_vars['place']->value['place_title'];?>
"></p>
						</div>
						<div class="col-md-2">
							<a href="index.php?controller=placesController&action=edit_place&place_id=<?php echo $_smarty_tpl->tpl_vars['place']->value['place_id'];?>
" class="btn btn-sm btn-round" >editar</a>
							<a href="index.php?controller=placesController&action=delete_place&place_id=<?php echo $_smarty_tpl->tpl_vars['place']->value['place_id'];?>
" class="btn btn-sm btn-round confirm-delete-place"  >eliminar</a>
						</div>
					</div>
				</div>

					
				</div>
				
			</div>
			<?php
$_smarty_tpl->tpl_vars['place'] = $foreach_place_Sav;
}
?>

          </div>
        </div>
      </div>
    
	
	<?php echo '<script'; ?>
>
        $(function() {    
			$('.confirm-delete-place').confirm({
				text: "Al borrar una marca, se borran todos los grupos asociados",
				title: "¿Está seguro que desea borrar la marca?",
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
			
			$('.confirm-delete-group').confirm({
				text: "Al borrar el grupo, todos los usuarios asociados a dicho grupo saldrán del mismo.",
				title: "¿Está seguro que desea borrar el grupo",
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
				<h5 class="card-title"><?php if (($_smarty_tpl->tpl_vars['places_data']->value->place_id == 0)) {?>Nueva lugar de interés<?php } else { ?>Editar lugar de interés<?php }?></h5>
                <p class="card-category">Información de la lugar de interés</p>
              </div>
              <div class="card-body ">
				<form action="index.php?controller=placesController&action=save_place" method="post" enctype="multipart/form-data">
					<input type="hidden" name="place_id" value="<?php echo $_smarty_tpl->tpl_vars['places_data']->value->place_id;?>
">
					  <div class="row">
						<div class="col-md-5 pr-1">
						  <div class="form-group"> 
							<label>Titulo del lugar de interés</label>
							<input type="text" class="form-control" name="place_title" placeholder="Título de la lugar de interés" required value="<?php echo $_smarty_tpl->tpl_vars['places_data']->value->place_title;?>
">
						  </div>
						</div>
					  </div> 					                  
					  <div class="row">
						<div class="col-md-12">
							<label>Imagen del lugar de interés (.jpg)</label>
							<input type="file" name="place_image" class="form-control-file" id="place_image"><br>
							<?php if ((file_exists("data/img/place_".((string)$_smarty_tpl->tpl_vars['places_data']->value->place_id).".jpg"))) {?>
								<p class=" text-left" ><img src="../data/img/place_<?php echo $_smarty_tpl->tpl_vars['places_data']->value->place_id;?>
.jpg" style="max-width:100px;vertical-align:middle;" title="<?php echo $_smarty_tpl->tpl_vars['places_data']->value->place_title;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['places_data']->value->place_title;?>
"></p>
							<?php }?>
						</div>
					  </div>  					                  
					  <div class="row">
						<div class="col-md-12">
							<label>Locución explicativa del lugar de interés (.mp3)</label>
							<input type="file" name="place_speech" class="form-control-file" id="place_speech"><br>
							<?php if ((file_exists("data/audio/place_".((string)$_smarty_tpl->tpl_vars['places_data']->value->place_id).".mp3"))) {?>
								<p class=" text-left" >
									<audio controls>
										<source src="../data/audio/place_<?php echo $_smarty_tpl->tpl_vars['places_data']->value->place_id;?>
.mp3" type="audio/mpeg">
										Your browser does not support the audio element.
									</audio>
								</p>
							<?php }?>
						</div>
					  </div>                 
					  <div class="row">
						<div class="col-md-12">
						  <div class="form-group">
							<label>Descripción del lugar de interés</label>
							<textarea name="place_description"  id="place_description" class="form-control textarea"><?php echo $_smarty_tpl->tpl_vars['places_data']->value->place_description;?>
</textarea>
						  </div>
						</div>
					  </div>
					  
					  
					  
					  
					  
						<div id="map" style="width: 100%; height: 400px;"></div>

					  <div class="row">
						<div class="col-md-12">
						  <div class="form-group">
							<label>Latitud</label>
							<input type="text" id="latitude" name="place_latitude" value="<?php echo $_smarty_tpl->tpl_vars['places_data']->value->place_latitude;?>
">
						  </div>
						</div>
					  </div>
					  <div class="row">
						<div class="col-md-12">
						  <div class="form-group">
							<label>Longitud</label>
							<input type="text" id="longitude" name="place_longitude" value="<?php echo $_smarty_tpl->tpl_vars['places_data']->value->place_longitude;?>
">
						  </div>
						</div>
					  </div>
		  
					  
					  
					  
					  
					  

					  
					  <div class="row">
						<div class="update ml-auto mr-auto">
						  <button type="submit" class="btn btn-primary btn-round"><?php if (($_smarty_tpl->tpl_vars['places_data']->value->place_id == 0)) {?>Crear la lugar de interés<?php } else { ?>Actualizar la lugar de interés<?php }?></button>
						</div>
					  </div>
				</form>
              </div>
            </div>
          </div>
        </div>
      </div>
	  
	  
	
	<?php echo '<script'; ?>
 src="https://maps.googleapis.com/maps/api/js?sensor=false"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
>
	 async function initMap() {
	  // Request needed libraries.
	  const { Map } = await google.maps.importLibrary("maps");
	  const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary(
		"marker",
	  );
	  let markerViewWithText;
	  
	  const map = new Map(document.getElementById("map"), {
		center: { lat: 39.45981568859527, lng:-0.4702914165885419 },
		zoom: 14,
		mapId: "4504f8b37365c3d0",
	  });
	  
	  
	 
	  // Configure the click listener.
	  map.addListener("click", (mapsMouseEvent) => {
		// Delete previous marker 
		if (markerViewWithText){
			markerViewWithText.setMap(null);
		}

		markerViewWithText = new AdvancedMarkerElement({
			map,
			position:  mapsMouseEvent.latLng,
			title: "Punto de interés",
		  });
		  
		document.querySelector("#latitude").value= mapsMouseEvent.latLng.toJSON().lat; 
		document.querySelector("#longitude").value= mapsMouseEvent.latLng.toJSON().lng; 
		  
	  });
	}

	initMap();
		
	<?php echo '</script'; ?>
>
	
	<?php echo '<script'; ?>
 src="../js/ckeditor/ckeditor.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
>
		var roxyFileman = '../ext/fileman/index.html'; 
		$(function(){
			CKEDITOR.replace( 'place_description',{filebrowserBrowseUrl:roxyFileman,
															filebrowserImageBrowseUrl:roxyFileman+'?type=image',
															removeDialogTabs: 'link:upload;image:upload'});					
		});
	<?php echo '</script'; ?>
>
	
	
	
	<?php }}
}
}
?>