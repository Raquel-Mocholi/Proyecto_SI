
    <div class="main-panel">
      <!-- Navbar -->
      {include file="admin/common/navbar.tpl"}
      <!-- End Navbar -->
	  
{if $action=="list"}
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
			
			{foreach $cms_data as $cms}
			 <div class="card "> 
				<div class="card-body">
					<div class="content">
						<div class="row">
							<div class="col-md-10">
								<div class="text-left" style="font-size:18px;font-weight:normal;">{$cms.cms_title}</div>
								<div class="text-left" style="font-size:12px;font-style:italic">{$cms.cms_date}</div>
								<div class="text-left" style="padding:5px 0px;font-size:12px;font-style:italic">{strip_tags($cms.cms_description)|truncate:150}...</div>
							</div>
							<div class="col-md-2">
								<a href="index.php?controller=cmsController&action=edit_cms&cms_id={$cms.cms_id}" class="btn btn-sm btn-round" >editar</a>
								<a href="index.php?controller=cmsController&action=delete_cms&cms_id={$cms.cms_id}" class="btn btn-sm btn-round btn-danger confirm-delete-cms"  >eliminar</a>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			{/foreach}

          </div>
        </div>
      </div>
    
	
	<script>
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
	</script>
	
	{elseif $action="edit"}
	
	
	<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card ">
				<div class="card-header ">
                <a href="javascript:history.back();" class="btn btn-primary btn-round" style="float:right"><i class="nc-icon nc-minimal-left"></i> volver</a>
				<h5 class="card-title">{if ($cms_data->cms_id==0)}Nueva sección{else}Editar sección{/if}</h5>
                <p class="card-category">Información de la sección</p>
              </div>
              <div class="card-body ">
				<form action="index.php?controller=cmsController&action=save_cms" method="post" enctype="multipart/form-data">
					<input type="hidden" name="cms_id" value="{$cms_data->cms_id}">
					  <div class="row">
						<div class="col-md-5 pr-1">
						  <div class="form-group"> 
							<label>Titulo de la sección</label>
							<input type="text" class="form-control" name="cms_title" placeholder="Título de la sección" required value="{$cms_data->cms_title}">
						  </div>
						</div>
					  </div> 					                                 
					  <div class="row">
						<div class="col-md-12">
						  <div class="form-group">
							<label>Descripción de la sección</label>
							<textarea name="cms_description"  id="cms_description" class="form-control textarea">{$cms_data->cms_description}</textarea>
						  </div>
						</div>
					  </div>

					  
					  <div class="row">
						<div class="update ml-auto mr-auto">
						  <button type="submit" class="btn btn-primary btn-round">{if ($cms_data->cms_id==0)}Crear la sección{else}Actualizar la sección{/if}</button>
						</div>
					  </div>
				</form>
              </div>
            </div>
          </div>
        </div>
      </div>
	  
	  
	{literal}
	<script src="../js/ckeditor/ckeditor.js"></script>
	<script>
		var roxyFileman = '../ext/fileman/index.html'; 
		$(function(){
			CKEDITOR.replace( 'cms_description',{filebrowserBrowseUrl:roxyFileman,
															filebrowserImageBrowseUrl:roxyFileman+'?type=image',
															removeDialogTabs: 'link:upload;image:upload'});					
		});
	</script>
	{/literal}
	
	
	{/if}