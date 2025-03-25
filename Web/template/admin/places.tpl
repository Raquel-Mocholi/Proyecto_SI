
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
                <a href="index.php?controller=placesController&action=new_place" class="btn btn-primary btn-round" style="float:right"><i class="nc-icon nc-simple-add"></i> Nueva lugar de interés</a>
				<h5 class="card-title">Lugar de interéss</h5>
                <p class="description">Desde este apartado podrá crear nuevas lugar de interéss.</p>
              </div>
			</div>
			
			{foreach $places_data as $place}
			 <div class="card "> 
              <div class="card-body ">
			  
				<div class="content">
					<div class="row">
						<div class="col-md-2">
							{if (file_exists("data/img/place_`$place.place_id`.jpg"))}
							<p class="text-left" ><img src="../data/img/place_{$place.place_id}.jpg" style="max-width:150px;max-height:100px;" title="{$place.place_title}" alt="{$place.place_title}"></p>
							{/if}
						</div>
						<div class="col-md-7">
							<div class="text-left" style="font-size:18px;font-weight:normal;">{$place.place_title}</div>
							<div class="text-left" style="font-size:12px;font-style:italic">{$place.place_date}</div>
							<div class="text-left" style="padding:5px 0px;font-size:12px;font-style:italic">{strip_tags($place.place_description)|truncate:150}...</div>
						</div>
						<div class="col-md-1">
							<p class="text-left" ><img src="/index.php?controller=qrController&hash={$place.place_hash}" style="width:100px;" title="QR Code de {$place.place_title}" alt="QR Code de {$place.place_title}"></p>
						</div>
						<div class="col-md-2">
							<a href="index.php?controller=placesController&action=edit_place&place_id={$place.place_id}" class="btn btn-sm btn-round" >editar</a>
							<a href="index.php?controller=placesController&action=delete_place&place_id={$place.place_id}" class="btn btn-sm btn-round confirm-delete-place"  >eliminar</a>
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
	</script>
	
	{elseif $action="edit"}
	
	
	<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card ">
				<div class="card-header ">
                <a href="javascript:history.back();" class="btn btn-primary btn-round" style="float:right"><i class="nc-icon nc-minimal-left"></i> volver</a>
				<h5 class="card-title">{if ($places_data->place_id==0)}Nueva lugar de interés{else}Editar lugar de interés{/if}</h5>
                <p class="card-category">Información de la lugar de interés</p>
              </div>
              <div class="card-body ">
				<form action="index.php?controller=placesController&action=save_place" method="post" enctype="multipart/form-data">
					<input type="hidden" name="place_id" value="{$places_data->place_id}">
					  <div class="row">
						<div class="col-md-5 pr-1">
						  <div class="form-group"> 
							<label>Titulo del lugar de interés</label>
							<input type="text" class="form-control" name="place_title" placeholder="Título de la lugar de interés" required value="{$places_data->place_title}">
						  </div>
						</div>
					  </div> 					                  
					  <div class="row">
						<div class="col-md-12">
							<label>Imagen del lugar de interés (.jpg)</label>
							<input type="file" name="place_image" class="form-control-file" id="place_image"><br>
							{if (file_exists("data/img/place_`$places_data->place_id`.jpg"))}
								<p class=" text-left" ><img src="../data/img/place_{$places_data->place_id}.jpg" style="max-width:100px;vertical-align:middle;" title="{$places_data->place_title}" alt="{$places_data->place_title}"></p>
							{/if}
						</div>
					  </div>  					                  
					  <div class="row">
						<div class="col-md-12">
							<label>Locución explicativa del lugar de interés (.mp3)</label>
							<input type="file" name="place_speech" class="form-control-file" id="place_speech"><br>
							{if (file_exists("data/audio/place_`$places_data->place_id`.mp3"))}
								<p class=" text-left" >
									<audio controls>
										<source src="../data/audio/place_{$places_data->place_id}.mp3" type="audio/mpeg">
										Your browser does not support the audio element.
									</audio>
								</p>
							{/if}
						</div>
					  </div>                 
					  <div class="row">
						<div class="col-md-12">
						  <div class="form-group">
							<label>Descripción del lugar de interés</label>
							<textarea name="place_description"  id="place_description" class="form-control textarea">{$places_data->place_description}</textarea>
						  </div>
						</div>
					  </div>
					  
					  
					  
					  
					  
						<div id="map" style="width: 100%; height: 400px;"></div>

					  <div class="row">
						<div class="col-md-12">
						  <div class="form-group">
							<label>Latitud</label>
							<input type="text" id="latitude" name="place_latitude" value="{$places_data->place_latitude}">
						  </div>
						</div>
					  </div>
					  <div class="row">
						<div class="col-md-12">
						  <div class="form-group">
							<label>Longitud</label>
							<input type="text" id="longitude" name="place_longitude" value="{$places_data->place_longitude}">
						  </div>
						</div>
					  </div>
		  
					  
					  
					  
					  
					  

					  
					  <div class="row">
						<div class="update ml-auto mr-auto">
						  <button type="submit" class="btn btn-primary btn-round">{if ($places_data->place_id==0)}Crear la lugar de interés{else}Actualizar la lugar de interés{/if}</button>
						</div>
					  </div>
				</form>
              </div>
            </div>
          </div>
        </div>
      </div>
	  
	  
	{literal}
	<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script>
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
		
	</script>
	
	<script src="../js/ckeditor/ckeditor.js"></script>
	<script>
		var roxyFileman = '../ext/fileman/index.html'; 
		$(function(){
			CKEDITOR.replace( 'place_description',{filebrowserBrowseUrl:roxyFileman,
															filebrowserImageBrowseUrl:roxyFileman+'?type=image',
															removeDialogTabs: 'link:upload;image:upload'});					
		});
	</script>
	{/literal}
	
	
	{/if}