/*
 * @author Alfonso Patiño
 * @copyright 2019
 */
 
// ********************* FORM VALIDATION SECTION ********************* //

function preprocess_form() {
	$('#lstBox2 option').prop('selected', true);
	$('#total_looks_select option').prop('selected', true);
	$('#copy_desc_select option').prop('selected', true);
	process_images();
	
	// Select list of related products
}

// Preprocess form of assign programming products template to clients
/*
function preprocess_assign_clients_form() {
	$('#lstBox2 option').prop('selected', true);
}

*/
function filter_clients(){
	
	q = $("input[name='clients_query']").val();
	q = q.toLowerCase();
	
	console.log(q);
	//if no query then show all
	if (q == ""){
		$("tr[id^='c_']").show();
		return false;
	}
	
	//if there is a query
	$("tr[id^='c_']").each(function( index ) {
		 if ($(this).find("input[class='checkbox_product']:checked").length == 0)
		 {
			 $(this).hide();
		 }
	});
	
	search_array = q.split(" ");
	console.log(search_array);
	for (i=0;i<search_array.length;i++){
		$("tr[data-username*='"+search_array[i]+"']").show();
		$("tr[data-discountgroup*='"+search_array[i]+"']").show();	
	}

	
	
	return false;	
}

function check_items(){
	$("tr[id^='c_']:visible").each(function( index ) {
		$(this).find("input[class^='checkbox_']").prop('checked', true);
	});
	
}

// ********************* END FORM VALIDATION  SECTION ********************* //


// ********************* IMAGES SECTION ********************* //

var images = new Array();

function attach_image(element,type) {
	if (type=='product'){
		image_path = '../img/products/';
	} else if (type=='category'){
		image_path = '../img/categories/sliders/';
	} else if (type=='discountcategory'){
		image_path = '../img/discount_categories/sliders/';
	}
	newPosition = images.length;
	images[newPosition] = new Array(1);
	images[newPosition][0] = element;

	extension = element.split('.').pop()
	
	var liElement = document.createElement('li');
	liElement.setAttribute('id', 'a_' + newPosition);
	liElement.setAttribute('style', 'height:130px;');
	liElement.setAttribute('class', 'row');
	if (extension.toLowerCase() == "jpg" || extension.toLowerCase() == "jpeg" || extension.toLowerCase() == "png"|| extension.toLowerCase() == "webp"){
		liElement.innerHTML = '<div class="col-3 col-sm-1"><img src="' + image_path + element + '" align="left" style="max-height:120px;padding:2px;" /></div><div class="col-9 col-sm-11 "><div style="background-color:#EEEEEE;font-weight:bold;" class="image-name">' + element + '</div><div><span class="deleteImgConfirm btn btn-sm btn-round"><i class="nc-icon nc-simple-remove"></i> Eliminar imagen</span></div></div>';
	}else{
		liElement.innerHTML = '<div class="col-3 col-sm-1"><i class="fa fa-video-camera" align="left" style="font-size: 72px"></i></div><div class="col-9 col-sm-11 "><div style="background-color:#EEEEEE;font-weight:bold;" class="image-name">' + element + '</div><div><span class="deleteImgConfirm btn btn-sm btn-round"><i class="nc-icon nc-simple-remove"></i> Eliminar imagen</span></div></div>';
	
	}
	
	
	document.getElementById("image_list").appendChild(liElement);
	update_events();
}

function update_events() {
	$('.deleteImgConfirm').confirm({
		title: "¿Está seguro que desea borrar la imagen?",
		cancel: function(button) {
			// nothing to do
		},
		confirm: function(button) {
			button.parent().parent().parent().remove();
		},
		confirmButton: "Sí, borrar",
		cancelButton: "No",
		post: false,
		confirmButtonClass: "btn-danger",
		cancelButtonClass: "btn-default",
		dialogClass: "modal-dialog modal-lg" // Bootstrap classes for large modal
	});
}
	
// Get images info from list and insert into a form input
function process_images() {
	var images_str = "";
	
	$('#image_list').children('li').each(function(i) { 
		images_str += $(this).find(".image-name").text() + ";";
	});

	// Set value into the hidden input field
	$('#images').val(images_str);
}
// ********************* END IMAGES SECTION ********************* //


// ********************* COMBINATIONS SECTION ********************* //

function update_option_values() {
	// Emtpy values list
	$("#values-list").empty();
	 
	// Get selected option
	selected_option = $("#options-list").val();
	
	
	for(i=0;i<option_values.length;i++){
		if (option_values[i][0].product_option_id==selected_option) {
			for(j=0;j<option_values[i][1].length;j++){
				$("#values-list").append('<option value="'+option_values[i][1][j].product_option_value_id+'">'+option_values[i][1][j].product_option_value_name +' (' + option_values[i][1][j].product_option_value_internal_name+ ')</option>');
			}
		}
	}
}

// Add option and value to combination list (call in modal)
function add_option_value() {
	selected_option_id = $("#options-list").val();
	selected_option_text = $("#options-list option:selected").text();
	
	selected_value_id = $("#values-list").val();
	selected_value_text = $("#values-list option:selected").text();
	
	// Only append element if its selected
	if ((selected_option_id > 0) && (selected_value_id >0)){
		combination_item_html = '<li class="row no-gutters">';
		combination_item_html += '	<input name="options[]" type="hidden" value="'+selected_option_id+'">';
		combination_item_html += '	<input name="values[]" type="hidden" value="'+selected_value_id+'">';
		combination_item_html += '	<input name="captions[]" type="hidden" value="'+selected_option_text+': '+selected_value_text+'">';
		combination_item_html += '	<span class="col-10">'+selected_option_text+': '+selected_value_text+'</span><span class="col-2"><span onClick="delete_option_value(this)" class="confirm-delete-option" style="cursor:pointer;"><i class="nc-icon nc-simple-remove"></i></a></span>';
		combination_item_html += '</li>';
		
		$("#combination-list").append(combination_item_html);	
	} else {
		alert('Seleccione una opción y su valor');
	}

}

// Delete option and value from combination list (call in modal)
function delete_option_value(item) {
	$(item).parent().parent().remove();
}

// Get values and add combination (call in modal)
function add_combination() {
	
	var combination_options = $("input[name='options[]']")
              .map(function(){return $(this).val();}).get();
	var combination_values = $("input[name='values[]']")
              .map(function(){return $(this).val();}).get();
	var combination_caption_array = $("input[name='captions[]']")
              .map(function(){return $(this).val();}).get();
			  
	var combination_caption = combination_caption_array.join('; ')
			  
	var combination_id = $('#combination_id').val();
	var combination_reference = $('#combination_reference').val();
	var combination_ean = $('#combination_ean').val();
	var combination_upc = $('#combination_upc').val();
	// console.log(combination_id + "--" + combination_options + "--" + combination_values + "--" + combination_reference + "--" + combination_ean + "--" + combination_upc + "--" + combination_caption);
	window.parent.attach_combination(combination_id, combination_options, combination_values, combination_reference, combination_ean, combination_upc, combination_caption);
	
	// Close modal
	$('#close-modal', window.parent.document).click();
	
	// Reload content
	location.reload();
}

// Attach elements (call in parent)
function attach_combination(combination_id, combination_options, combination_values, combination_reference, combination_ean, combination_upc, combination_caption) {
	combination_row = '<li class="row  no-gutters">';
	combination_row += '	<span  class="col-10">';
	combination_row += '		<input type="hidden" name="product_combination_id[]" value="'+combination_id+'">';
	combination_row += '		<input type="hidden" name="product_combination_options[]" value="'+combination_options+'">';
	combination_row += '		<input type="hidden" name="product_combination_values[]" value="'+combination_values+'">';
	combination_row += '		<input type="hidden" name="product_combination_reference[]" value="'+combination_reference+'">';
	combination_row += '		<input type="hidden" name="product_combination_EAN[]" value="'+combination_ean+'">';
	combination_row += '		<input type="hidden" name="product_combination_UPC[]" value="'+combination_upc+'">';
	combination_row += '		<span>'+combination_caption+' Ref:'+combination_reference+' EAN:'+combination_ean+'</span>';
	combination_row += '	</span>		';
	combination_row += '	<span  class="col-2">';
	combination_row += '		<a onClick="delete_combination(this)" class="confirm-delete-category"><i class="nc-icon nc-simple-remove"></i></a>';
	combination_row += '	</span>';
	combination_row += '</li>';
	
	$('#combination_list').append(combination_row);	
}
	
function delete_combination(item) {
	$(item).parent().parent().remove();
}	
	
// ********************* END COMBINATIONS SECTION ********************* //

// ********************* PACKS SECTION ********************* //	

function add_item_to_pack(combination, combination_caption, date, product_id, product_name, product_price, product_reference, promotion_discount, promotion_price, qty){
	
	if (parseInt(product_id)<=0 || parseInt(combination)<=0 || parseInt(qty)<=0){
		alert("Debe selección el producto, la combinación y la cantidad");
	} else {
		if ($("#pack_list").children().length > 0){
			$("#pack-title").show();
		}
		
		pack_row = '<li class="row  no-gutters">';
		pack_row += '	<span  class="col-10">';
		pack_row += '		<input type="hidden" name="pack_product_id[]" value="'+product_id+'">';
		pack_row += '		<input type="hidden" name="pack_combination_id[]" value="'+combination+'">';
		pack_row += '		<input type="hidden" name="pack_product_reference[]" value="'+product_reference+'">';
		pack_row += '		<input type="hidden" name="pack_product_price[]" value="'+product_price+'">';
		pack_row += '		<input type="hidden" name="pack_promotion_discount[]" value="'+promotion_discount+'">';
		pack_row += '		<input type="hidden" name="pack_quantity[]" value="'+qty+'">';	
		pack_row += '		<span><strong>Producto: </strong>'+product_name+' ('+combination_caption+') - <strong>Cantidad: </strong>: '+qty+' unidades.</span>';
		pack_row += '	</span>		';
		pack_row += '	<span  class="col-2">';
		pack_row += '		<a onClick="delete_pack(this)" class="confirm-delete-category"><i class="nc-icon nc-simple-remove"></i></a>';
		pack_row += '	</span>';
		pack_row += '</li>';
		
		$('#pack_list').append(pack_row);
		
		if ($("#pack_list").children().length > 0){
		
		}
	}
	
	
}

function delete_pack(item) {
	$(item).parent().parent().remove();
	if ($("#pack_list").children().length == 0){
		$("#pack-title").hide();
	}
}

// ********************* END PACKS SECTION ********************* //

// ********************* DATES AND STOCK SECTION ********************* //

function add_date() {
	
	//remove previous datepicker
	$( "input[name*='date']").datepicker( "destroy" );
	$( "input[name*='date']").removeClass("hasDatepicker").removeAttr('id');	
	
	// Clone last node
	$("#stocks_list").children().last().clone().appendTo("#stocks_list");
	
	// empty new inputs
	$("#stocks_list").children().last().find('input').val('');
	
	//add datepicker again
	$( "input[name*='date']").datepicker({ dateFormat: 'dd/mm/yy', firstDay: 1  }).val();
}


// ********************* END DATES AND STOCK SECTION ********************* //

// ********************* CLIENTS SECTION ********************* //

function add_client_address(address_id, address_erp_id, address_name, address_info, address_city, address_CP, address_province) {

	new_address_row = '<div class="address-item">';
	new_address_row += '<input  class="form-control" type="hidden" name="address_id[]" value="'+address_id+'">';
	new_address_row += '<div class="row form-group"><label class=" col-2">Identificador de la dirección en el ERP: </label><span class=" col-10"><input  class="form-control" type="text" name="address_erp_id[]" value="'+address_erp_id+'" required></span></div>';
	new_address_row += '<div class="row form-group"><label class=" col-2">Nombre de la dirección: </label><span class="col-10"><input class="form-control"  type="text" name="address_name[]" value="'+address_name+'" required></span></div>';	
	new_address_row += '<div class="row form-group"><label class=" col-2">Dirección (calle y número): </label><span class="col-10"><input class="form-control"  type="text" name="address_info[]" value="'+address_info+'"></span></div>';	
	new_address_row += '<div class="row form-group"><label class=" col-2">Población: </label><span class="col-10"><input class="form-control"  type="text" name="address_city[]" value="'+address_city+'"></span></div>';	
	new_address_row += '<div class="row form-group"><label class=" col-2">Código Postal: </label><span class="col-10"><input class="form-control"  type="text" name="address_CP[]" value="'+address_CP+'"></span></div>';	
	new_address_row += '<div class="row form-group"><label class=" col-2">Provincia: </label><span class="col-10"><input class="form-control"  type="text" name="address_province[]" value="'+address_province+'"></span></div>';	
	new_address_row += '</span><div style="padding: 5px 20px"><a style="color:#FFF" class="btn btn-sm btn-round confirm-delete-address">Eliminar esta dirección</a></div></div>';
	if(address_id <= 0){
	   $('#addresses_list').prepend(new_address_row);
	} else {
	   $('#addresses_list').append(new_address_row);
	}	

}

function add_client_document(document_id,filename,document_title,document_description,folders, current_document_folders) {

	new_cument_row = '<div class="document-item">';
	new_cument_row += '<div class="row form-group"><label class=" col-2">Título del documento: </label><span class=" col-10"><input  class="form-control" type="text" name="document_title[]" value="'+document_title+'"></span></div>';
	new_cument_row += '<div class="row form-group"><label class=" col-2">Descripción: </label><span class="col-10"><input class="form-control"  type="text" name="document_description[]" value="'+document_description+'"></span></div>';
	// Folders tree
	new_cument_row += '<div class="row form-group"><label class=" col-2">Carpetas: </label>';
	new_cument_row += '<div class="col-10">';
	new_cument_row += folders_tree(JSON.parse(folders), document_id, 0, JSON.parse(current_document_folders));
	new_cument_row += '</div></div>';
	
	new_cument_row += '<input type="hidden" name="document_ids[]" value="'+document_id+'"><br>';
	new_cument_row += '<div class="row "><label class=" col-2">Seleccionar archivo: </label><span class="col-10"><input type="file" name="documents[]">';
	
	if (filename != ""){
		new_cument_row += '	<div style="padding:5px 0px;"><i>archivo actual: '+filename+'</i><a href="index.php?controller=downloadController&document_id='+document_id+'" target="_blank" style="padding-left: 10px">Ver documento</a></div>';
	}
	
	
	new_cument_row += '</span><div style="padding: 5px 20px"><a style="color:#FFF" class="btn btn-sm btn-round confirm-delete-document">Eliminar este documento</a></div></div>';
	if(document_id < 0){
	   $('#document_list').prepend(new_cument_row);
	} else {
	   $('#document_list').append(new_cument_row);
	}	
	
	// Open tree view product path 
	$(function() { 
		$("#treeView"+document_id).find( "input:checked" ).parents(".nested").addClass('active');
		$("#treeView"+document_id).find( "input:checked" ).parents(".nested").siblings(".caret-tree").addClass('caret-tree-down');
	});
		
	var toggler = $("#treeView"+document_id).find(".caret-tree");
		
	for (toggler_index = 0; toggler_index < toggler.length; toggler_index++) {
		toggler[toggler_index].addEventListener("click", function() {
			this.parentElement.querySelector(".nested").classList.toggle("active");
			this.classList.toggle("caret-tree-down");
		});
	}
}

// Mount the folder tree

function folders_tree(folders, document_id, level, current_document_folders) {
	
	new_cument_row = '';
	
	if (level == 0) {
		new_cument_row += '<ul id="treeView'+document_id+'" class="treeView">';
	} else {
		new_cument_row += '<ul class="nested">';
	}
	
	$.each(folders, function(index, folder) {
		
		
		new_cument_row += '<li><input type="checkbox" name="folders_'+document_id+'[]" id="folder_'+folder['folder_id']+'_'+document_id+'" value="'+folder['folder_id']+'" ';
		new_cument_row += (current_document_folders.includes(folder['folder_id'])) ? 'checked' : '';
		new_cument_row += '>&nbsp;';
		
		label = '<label for="folder_'+folder['folder_id']+'_'+document_id+'">'+folder['folder_name']+'</label>';
	
		if (Array.isArray(folder['childrens']) && (folder['childrens'].length>0)) {
			
			new_cument_row += '<span class="caret-tree">'+label+'</span>';
			new_cument_row += folders_tree(folder['childrens'], document_id, level+1, current_document_folders);
			
		} else {
			new_cument_row += label;
			
		}
		
		new_cument_row += '</li>';
	
	});
	
	new_cument_row += '</ul>';
	return new_cument_row;
}
	
// ********************* END CLIENTS SECTION ********************* //

// ********************* DISCOUNTS SECTION *********************** //

function add_discount(categories, discount_group_id, selector_id) {
	// Create node 
	node = "<div id='discount_0' class='col-sm-12 col-md-6' style='margin: 15px 0px; border-top: 1px solid #51cbce; padding-top: 15px; background-color: rgb(201, 255, 201)'>";
	node += 	'<div class="form-group top_discount">';
	node += 		'<div class="btn btn-danger btn-sm delete_button confirm-delete-discount" id="confirm-delete-discount_0" onClick="delete_discount(0);" style="float: right;">';
	node += 			'<i class="nc-icon nc-simple-remove"></i>';
	node += 		'</div>';
	node += 		'<div class="btn btn-info btn-sm glyphicon glyphicon-save save_button" onClick="save_discount(0,'+discount_group_id+');" style="float: right;">';
	node +=				'Guardar';
	node += 		'</div>';
	node += 		'<h6>Descuento</h6>';
	node +=		'</div>';
	node +=		'<div class="form-group">';
	node +=			'<div class="form-group">';
	node += 			'<label>Categorías</label>';
	node += 			'<div class="category_container">';
	node += 				'<select name="discount_category_0[]" id="discount_category_0" multiple>';
							categories.forEach(function(category) {
	node +=						'<option value="' + category.discount_category_id + '">' + category.discount_category_name + '</option>';
							});
	node +=					'</select>';
	node +=					'<script id="discount_category_script_0">';
	node +=						'$( function() {$("#discount_category_0").bsMultiSelect();} );';
	node +=					'</script>';
	node +=				'</div>';
	node +=			'</div>'
	node +=			'<div class="dc_table_row table_header">';
	node +=				'<div class="dc_row_column">Mínimo</div>';
	node +=				'<div class="dc_row_column">Máximo</div>';
	node +=				'<div class="dc_row_column">Porcentaje</div>';
	node +=				'<div class="dc_row_column"></div>';
	node +=			'</div>';
	node += 		'<div id="discount_group_0">';
	node +=				'<div class="dc_table_row">';
	node +=					'<input type="hidden" class="discount_value_id" name="discount_value_id_0[]" value="0">';
	node +=					'<div class="dc_row_column">';
	node +=						'<input class="discount_value_min" type="number" name="discount_value_min_0[]" value="0">';
	node +=					'</div>';
	node +=					'<div class="dc_row_column">';
	node +=						'<input class="discount_value_max" type="number" name="discount_value_max_0[]" value="0">';
	node +=					'</div>';
	node +=					'<div class="dc_row_column">';
	node +=						'<input class="discount_value_percentage" type="number" name="discount_value_percentage_0[]" value="0">';
	node +=					'</div>';
	node +=					'<div class="dc_row_column actions">';
	node +=						'<div onClick="delete_discount_value(this,0)" class="confirm-delete-discountvalue">';
	node +=							'<i class="nc-icon nc-simple-remove"></i>';
	node +=						'</div>';
	node +=					'</div>';
	node +=				'</div>'; 
	node += 		'</div>';
	node +=			'<span class="btn btn-primary add_discount_value" onClick="add_discount_value(0);">Nuevo rango</span>';
	node +=		'</div>';
	node += '</div>';
	
	// Disbled add discount button
	$("#add_discount_button").attr("disabled", true);
	
	// Append to the final
	$("#discounts").append(node);
}

function add_discount_value(id) {
	
	if(checkDiscountValueIsValid(id)) {
		
		// Clone last node
		last_line.clone().appendTo("#discount_group_" + id);
		clone_line = $("#discount_group_" + id).children().last();
		clone_line.css("background-color", "#c9ffc9");
		
		// empty max and percenteageinputs
		clone_line.find('.discount_value_min').val(parseInt(last_line_max_value)+1);
		clone_line.find('.discount_value_max').val('0');
		clone_line.find('.discount_value_percentage').val('0');	
		
		// Change the id for 0
		clone_line.find('.discount_value_id').val('0');
		
	}
}

function delete_discount_value(item, discount_value_id) {
	// check if is last node
	if ($(item).parent().parent().parent().find('.dc_table_row').length == 1) {
		// empty nputs
		$(item).parent().parent().find('input').val('0');
	} else {	
		// remove the <div> node
		$(item).parent().parent().remove();
	}
	
	$('#discount_' + discount_value_id).css("background-color", "#c9ffc9");
}	
 

function delete_discount(discount_id_to_remove) {
	// check if is last node
	$('#confirm-delete-discount_' + discount_id_to_remove).confirm({
		text: "Va a proceder a eliminar el descuento",
		title: "¿Está seguro que desea borrar el descuento?",
		cancel: function(button) {
				// nothing to do
		},
		confirm: function(button) {
			// if discount_id is zero, then remove div directly because results dont save yet
			if(discount_id_to_remove == 0) {
				// Remove div with discount
				$("#discount_0").remove();
				// Enabled add discount button
				$("#add_discount_button").attr("disabled", false);
				
				$.notify({
					message: 'Descuento borrado correctamente'
				},{
					type: 'success'
				});
			} else {
				
				// ajax call to remove data
				$.ajax({
				  method: "POST",
				  dataType: 'JSON',
				  url: "index.php?controller=discountgroupsController&action=ajax_delete_discount",
				  data: { discount_id_to_remove: discount_id_to_remove}
				})
				.done(function( data ) {
					
					console.log(data);
					
					console.log(discount_id_to_remove);
					if (data['code'] == 1){
						// Remove div with discount
						$("#discount_" + discount_id_to_remove).remove();
						$.notify({
							message: 'Descuento borrado correctamente'
						},{
							type: 'success'
						});
					} else if (data['code'] == 2){
						$.notify({
							message: 'Ha ocurrido un error. El identificador de descuento no es válido. En caso de persistir el fallo, contacte con soporte mandando un correo a la dirección turistic@alpati.net'
						},{
							type: 'error'
						});
					} else {
						$.notify({
							message: data['msg']
						},{
							type: 'error'
						});
					}
					
				});
				
			}
		},
		confirmButton: "Sí, borrar",
		cancelButton: "No",
		post: false,
		confirmButtonClass: "btn-danger",
		cancelButtonClass: "btn-info",
		dialogClass: "modal-dialog modal-lg" // Bootstrap classes for large modal
	});
}	


function save_discount(discount_id, discount_group_id) {
	
	new_discount = false;
	if (discount_id == 0) {
		new_discount = true;
	}
	
	// Check if last element is ok
	if(checkDiscountValueIsValid(discount_id)) {
		
		

		// Get discount categories for the id
		var discount_categories = $("#discount_category_" + discount_id).children("option:selected").map(function(){ return this.value }).get().join(", ");;
		
		// Get discount values id (useless at the moment because we remove all values and recreate again)
		var discount_values_id = [];
		$('input[name^="discount_value_id_' + discount_id + '"]').each(function() {
			discount_values_id.push($(this).val());
		});
		
		// Get discount values min 
		var discount_values_min = [];
		$('input[name^="discount_value_min_' + discount_id + '"]').each(function() {
			discount_values_min.push($(this).val());
		});
		
		// Get discount values max 
		var discount_values_max = [];
		$('input[name^="discount_value_max_' + discount_id + '"]').each(function() {
			discount_values_max.push($(this).val());
		});
		
		// Get discount values percentage
		var discount_values_percentage = [];
		$('input[name^="discount_value_percentage_' + discount_id + '"]').each(function() {
			discount_values_percentage.push($(this).val());
		});
		
		// Create the discount_value_array data
		var discount_values = [];
		for (var position in discount_values_id) {
			discount_values.push( {
				"discount_value_id":discount_values_id[position],
				"discount_value_min":discount_values_min[position],
				"discount_value_max":discount_values_max[position],
				"discount_value_percentage":discount_values_percentage[position]
			});
		}
		
		$.ajax({
		  method: "POST",
		  url: "index.php?controller=discountgroupsController&action=ajax_save_discount",
		  dataType: 'JSON',
		  data: { discount_id: discount_id, discount_group_id: discount_group_id, discount_categories : discount_categories, discount_values: discount_values}
		})
		.done(function( data ) {
			// Check code returned
			if(data['code'] == 1) { // OK
			
				$.notify({
					message: data['msg']
				},{
					type: 'success'
				});
				
				// Get id
				discount_id = data['discount_id'];
				
				// if the discount is new, enable the add discount button
				// and change ids
				if (new_discount) {
					$("#add_discount_button").attr("disabled", false);
					$('#discount_0 .save_button').attr("onClick","save_discount("+ discount_id +","+ discount_group_id +");");
					$('#discount_0 .delete_button').attr("onClick","delete_discount("+ discount_id +");");
					$('#discount_0 .delete_button').attr("id","confirm-delete-discount_"+ discount_id);
					$('#discount_group_0').attr('id','discount_group_' + discount_id);
					$('#discount_0 .discount_value_id').attr('name','discount_value_id_' + discount_id + '[]');
					$('#discount_0 .discount_value_id').val( discount_id );
					$('#discount_0 .discount_value_max').attr('name','discount_value_max_' + discount_id + '[]');
					$('#discount_0 .discount_value_min').attr('name','discount_value_min_' + discount_id + '[]');
					$('#discount_0 .discount_value_percentage').attr('name','discount_category_' + discount_id + '[]');
					
					$('#discount_0 .confirm-delete-discountvalue').attr("onClick","delete_discount_value(this,"+ discount_id +");");
					$('#discount_group_0').attr('id','discount_group_' + discount_id);
					
					// Remove the div with changes
					$('#discount_0 .dashboardcode-bsmultiselect').remove();
					$('#discount_category_0').remove();
					$('#discount_category_script_0').remove();
					
					// Create new multiselector
					new_selector = '<select class="discount_category" name="discount_category_' + discount_id + '[]" id="discount_category_' + discount_id + '" multiple="multiple">';
					
					discount_categories = data['discount_categories'];
					selected_discount_categories = data['selected_discount_categories'];
					
					// Fill new selector
					$.each(discount_categories, function(index, discount_category) {
						new_selector += '<option value="' + discount_category['discount_category_id'] + '"';
						if($.inArray(discount_category['discount_category_id'], selected_discount_categories) > -1) new_selector += ' selected="selected"'; 
						new_selector += '>' + discount_category['discount_category_name'] + ' - ' + discount_category['brand_name'] + '</option>'
					});
					
					new_selector += '</select>';
					
					// Rename discount div
					old_discount = $('#discount_0');
					old_discount.attr('id','discount_' + discount_id);
					
					// Add multiselector to new div
					$( "#discount_" + discount_id + " .category_container" ).append(new_selector);
					
					// Create multiselector
					$('#discount_category_' + discount_id).bsMultiSelect();
				}
				
				
				// Clear change color after save changes succesfully
				$("#discount_" + discount_id).css("background-color","#FFF");
				$("#discount_" + discount_id).find('.dc_table_row').css("background-color","#FFF");
				
			} else {
				if (typeof data['msg'] !== 'undefined') {
					$.notify({
					message: data['msg']
				},{
					type: 'warning'
				});
				} else {
					$.notify({
						message: 'Ha ocurrido un error. Por favor, inténtelo otra vez. En caso de persistir el fallo, contacte con soporte mandando un correo a la dirección soporte@Alfonso Patiño.es'
					},{
						type: 'error'
					});
				}
			}
			
		});
	}
}	

function checkDiscountValueIsValid(discount_id) {
	
	last_line = $("#discount_group_" + discount_id).children().last();
	last_line_min_value = $("#discount_group_" + discount_id).children().last().find('.discount_value_min').val();
	last_line_max_value = $("#discount_group_" + discount_id).children().last().find('.discount_value_max').val();
	last_line_per_value = $("#discount_group_" + discount_id).children().last().find('.discount_value_percentage').val();
	if(parseFloat(last_line_min_value) > parseFloat(last_line_max_value)) {

		$.notify({
				message: 'El último descuento aplicado es erroneo. El valor máximo es menor que el mínimo'
			},{
				type: 'danger'
			});
			
		return false;
	}
	
	
	if(parseFloat(last_line_min_value) == parseFloat(last_line_max_value)) {

		$.notify({
				message: 'El último descuento aplicado es erroneo. El valor máximo y el mínimo son iguales'
			},{
				type: 'danger'
			});
			
		return false;
	}
	
	return true;
}	




function addPromotionRange() {
	
	if(checkPromotionRange()) {
		last_line = $("#promotion_ranges").children().last();
		
		
		// Clone last node
		last_line.clone().appendTo("#promotion_ranges");
		
		clone_line = $("#promotion_ranges").children().last();
		clone_line.css("background-color", "#c9ffc9");
		
		console.log(clone_line.find('.promotion_min_qty'));
		
		// empty max and percenteageinputs
		clone_line.find('.promotion_min_qty').val(parseInt(last_line_max_value));
		clone_line.find('.promotion_max_qty').val('0');
		clone_line.find('.promotion_discount_percentage').val('0');	
		
		// Change the promotion_id for 0
		clone_line.find('.promotion_value_id').val('0');
		
	} else {
		console.log(":-(");
	}
}

function deletePromotionRange(item, promotion_value_id) {
	// check if is last node
	if ($(item).parent().parent().parent().find('.dc_table_row').length == 1) {
		// empty nputs
		$(item).parent().parent().find('input').val('0');
	} else {	
		// remove the <div> node
		$(item).parent().parent().remove();
	}
}	

function checkPromotionRange() {
	last_line = $("#promotion_ranges").children().last();
	last_line_min_value = $("#promotion_ranges").children().last().find('.promotion_min_qty').val();
	last_line_max_value = $("#promotion_ranges").children().last().find('.promotion_max_qty').val();
	last_line_per_value = $("#promotion_ranges").children().last().find('.promotion_discount_percentage').val();
	if(parseFloat(last_line_min_value) > parseFloat(last_line_max_value)) {

		$.notify({
				message: 'El último rango aplicado es erróneo. El valor máximo es menor que el mínimo'
			},{
				type: 'danger'
			});
			
		return false;
	}
	
	
	if(parseFloat(last_line_min_value) == parseFloat(last_line_max_value)) {

		$.notify({
				message: 'El último descuento aplicado es erroneo. El valor máximo y el mínimo son iguales'
			},{
				type: 'danger'
			});
			
		return false;
	}
	
	return true;
}
