<?php

/**
 * @author Alfonso Patiño
 * @copyright 2022
 */
include_once('classes/client.php');
include_once('classes/brand.php');
include_once('classes/discountgroup.php');
include_once('classes/discountcategory.php');
include_once('classes/product.php');
include_once('classes/folder.php');
include_once('classes/clientzone.php');
include_once('classes/allocations.php');
 
class clientsController {
    var $params; 
	var $tpl;
	var $search_result;

    function init() {
		
		$this->params = Utils::getParams();
		$this->tpl = $GLOBALS['smarty'];
		
		if (isset($_GET['action']) && !empty($_GET['action'])){
			$action = $_GET['action'];
		} else {
			$action = "";
		}

		// Check actions with clients
		if (isset($_REQUEST['client_id']) && !in_array($_REQUEST['client_id'],$_SESSION['admin_login']['subclients']) && $_SESSION['admin_login']['superadmin']==0){
			Utils::addMessage("No tiene permisos para realizar esta acción",'error');
			Utils::redirect('index.php?controller=clientsController');
		}
				
		switch($action){
			case 'get_clients_csv':
			
				$clients_list = Client::getClientsCSV();
				header("Content-Type: text/csv");
				header("Content-Disposition: attachment; filename=clients_list.csv");
				echo $clients_list;
				exit();
				break;
			case 'new_client_address':
			case 'edit_client_address':
				$client_id = (int)$_GET['client_id'];
				$address_id = (int)$_GET['address_id'];

				$client = new Client($client_id);

				$this->tpl->assign(array(
					'url_referer_back'=>$_SESSION['url_referer_back'],
					'action' => 'edit_address',	
					'client_data'=> $client,
					'address_data'=> Client::getClientAddress($address_id)
				));
				return $this->display('admin/clients.tpl');


				break;
			case 'save_client_address':

				$address_id = (int)$_POST['address_id'];
				$client_id = (int)$_POST['client_id'];
				$address_erp_id = $_POST['address_erp_id'];
				$address_name = $_POST['address_name'];
				$address_info = $_POST['address_info'];
				$address_city = $_POST['address_city'];
				$address_CP = $_POST['address_CP'];
				$address_province = $_POST['address_province'];		
				
				if (Client::saveClientAddress($address_id,$client_id,$address_erp_id,$address_name,$address_info,$address_city,$address_CP,$address_province)) {
					Utils::addMessage("Dirección actualiazada correctamente");
                    Utils::redirect('index.php?controller=clientsController&action=edit_client&tab=3&client_id='.$client_id);
				} else {
					Utils::addMessage("No se ha podido actualizar la dirección","warning");
					Utils::redirect('index.php?controller=clientsController&client_id='.$client_id);
				}
			
				break;
			case 'delete_client_address':
				$client_id = (int)$_GET['client_id'];
				$address_id = (int)$_GET['address_id'];
				
                if(Client::deleteClientAddress($address_id)){
					Utils::addMessage("Dirección eliminada correctamente");
                    Utils::redirect('index.php?controller=clientsController&action=edit_client&tab=3&client_id='.$client_id);
				} else {
					Utils::addMessage("No se ha podido eliminar la dirección","warning");
					Utils::redirect('index.php?controller=clientsController');
				}
				break;
			case 'new_client':
			case 'edit_client':
				
				if ($action == "edit_client"){
					$client_id = (int)$_GET['client_id'];
				} else {
					$client_id = 0;					
				}
				
				$show_documents = false;
				
				if (isset($_GET['show_documents'])){
					$show_documents = true;
				}
	
				if (isset($_GET['tab'])){
					$tab = (int)$_GET['tab'];
				} else {
					$tab=1;
				}

				$client = new Client($client_id);	
				
				$this->tpl->assign(array(
                    'url_referer_back'=>$_SESSION['url_referer_back'],
					'action' => 'edit',
					'tab' => $tab,
					'show_documents_tab'=>$show_documents,
					'available_groups' => Brand::getAllGroups(),
					'discountgroups' => DiscountGroup::getAllDiscountGroups(),
					'all_client_list' => Client::getAllClients(-1),
					'all_client_zones' => Clientzone::getAllClientZones(-1),
					'client_data'=> $client
				));
				return $this->display('admin/clients.tpl');
				break;
			case 'save_client':
				
				$client = new Client((int)Utils::sanitize($_POST['client_id']));
				$client->client_username = Utils::sanitize($_POST['client_username']);
				$client->client_name = Utils::sanitize($_POST['client_name']);
				$client->client_email = Utils::sanitize($_POST['client_email']);
				$client->client_zone_id =(int)$_POST['client_zone_id'];
				$client->client_powerBI_iframe = addslashes($_POST['client_powerBI_iframe']);
				$client->discount_group_id = Utils::sanitize($_POST['discount_group_id']);
				$client->client_phone = Utils::sanitize($_POST['client_phone']);

				
				//Limits
				$client->client_limits = array();
				for ($k=0;$k<count($_POST['limit_brand_id']);$k++){
					// var_dump($_POST['limit_brand_id'][$k]);
					$client->client_limits[] = array('brand_id'=>intval($_POST['limit_brand_id'][$k]),
													'programming_limit_type'=>intval($_POST['programming_limit_type'][$k]),
													'programming_limit_quantity'=>intval($_POST['programming_limit_quantity'][$k]),
													'programming_limit_date_init'=> Utils::convertDate(Utils::sanitize($_POST['programming_limit_date_init'][$k])),
													'programming_limit_date_end'=>Utils::convertDate(Utils::sanitize($_POST['programming_limit_date_end'][$k])),
													'replenishment_limit_type'=>intval($_POST['replenishment_limit_type'][$k]),
													'replenishment_limit_quantity'=>intval($_POST['replenishment_limit_quantity'][$k]),
													'replenishment_limit_date_init'=>Utils::convertDate(Utils::sanitize($_POST['replenishment_limit_date_init'][$k])),
													'replenishment_limit_date_end'=>Utils::convertDate(Utils::sanitize($_POST['replenishment_limit_date_end'][$k])));
				}			

				
				//Fixed discounts
				$client->client_fixed_discounts = array();
				for ($k=0;$k<count($_POST['fixed_discount_brand_id']);$k++){
					$client->client_fixed_discounts[] = array('brand_id'=>intval($_POST['fixed_discount_brand_id'][$k]),
													'programming_fixed_discount'=>floatval($_POST['programming_fixed_discount'][$k]),
													'replenishment_fixed_discount'=>floatval($_POST['replenishment_fixed_discount'][$k]));
				}			


				
				
				if ($_SESSION['admin_login']['superadmin']==1){
					$client->client_admin_access =(int)$_POST['client_admin_access'];
					$client->client_superadmin =(int)$_POST['client_superadmin'];
				}

				$client->groups = array_map('intval',$_POST['groups']);

				if (!empty(Utils::sanitize($_POST['client_password']))){
					$client->client_password = Utils::encryptPassword(Utils::sanitize($_POST['client_password']));
				}
				
				$client->client_number = Utils::sanitize($_POST['client_number']);
				
				$client->client_addresses=array();
				// Addresses
				if (isset($_POST['address_id'])){
					for ($i=0;$i<count($_POST['address_id']);$i++){
											
						$address = array(
							'address_id' => (int)$_POST['address_id'][$i],
							'address_erp_id' => $_POST['address_erp_id'][$i],
							'address_name' => $_POST['address_name'][$i],
							'address_info' => $_POST['address_info'][$i],
							'address_city' => $_POST['address_city'][$i],
							'address_CP' => $_POST['address_CP'][$i],
							'address_province' => $_POST['address_province'][$i]				
						);
						
						$client->client_addresses[] = $address;
					}						
				}
				
				// All number of documents
				$count_old_docs = count($client->client_documents);
				// Documents
				$show_document_url = '';
				
				$client->client_documents = array();
				
				if (isset($_POST['document_ids'])){
					for ($i=0;$i<count($_POST['document_ids']);$i++){
						
						$document_id = ($_POST['document_ids'][$i] <= 0) ? 0 : $_POST['document_ids'][$i];
						
						$document = array(
							'client_document_id'=> $document_id,
							'filename' => $_FILES['documents']['name'][$i],
							'tmp_name' => $_FILES['documents']['tmp_name'][$i],
							'file_title' =>$_POST['document_title'][$i],
							'file_description' => $_POST['document_description'][$i],
							'folders' => $_POST['folders_' . $_POST['document_ids'][$i]]
						);
						
						$client->client_documents[] = $document;
						
						// Save folder of document
					}	
					
				}
				
				$count_new_docs =  count($client->client_documents);
				if ($count_new_docs != $count_old_docs) {
					$show_document_url = '&show_documents';
				}
				// var_dump($client);
				// exit();
				$client->save();
		
				Utils::addMessage("Cliente guardado correctamente");
                if($_POST['client_id'] == 0){
                    Utils::redirect('index.php?controller=clientsController&action=search&q='.$client->client_username);
                } else {
				    Utils::redirect('index.php?controller=clientsController&action=edit_client&client_id=' . (int)Utils::sanitize($_POST['client_id']) . $show_document_url);
                }
				break;
			case 'delete_client':
				$client = new client((int)Utils::sanitize($_GET['client_id']));
				if ($client->delete()){
					Utils::addMessage("Cliente eliminado correctamente");
				} else {
					Utils::addMessage("El cliente no se ha podido eliminar correctamente","warning");
				};
				Utils::redirect('index.php?controller=clientsController');
				break;
				
			case 'search':
				$query = Utils::sanitize($_GET['q']);
                
                $_SESSION['url_referer_back'] = $_SERVER['REQUEST_URI'];
                
				if (!empty($query)){
					$this->tpl->assign(array(
						'action' => 'list',
						'query' => $query,
						'clients_data'=> Client::seachClientsByUsername($query),
						'pagination' => array(	
							'total_papes'=>0,
							'items_per_page'=>0,
							'actual_page'=>0)
					));
					return $this->display('admin/clients.tpl');	
					break;				
				}
			
			case 'edit_allocations_client':
				$client_id = (int)$_GET['client_id'];
				
				if (isset($_GET['q'])){
					$query = $_GET['q'];
				} else {
					$query = "";
				}
				
				$client = new client($client_id);

				$this->tpl->assign(array(
					'url_referer_back'=>$_SESSION['url_referer_back'],
					'query'=>$query,
					'allocation_data'=> Allocation::getAllAllocations(0,0,$query),
					'client_data'=> $client,
					'client_allocations'=> Allocation::getClientAllocationsId($client_id),
					'brands'=> Brand::getAllBrands()
				));
			
				return $this->display('admin/clients-allocations.tpl');
				break;
				
				
				
			case 'ajax_set_allocation':
			
				// Save discount from ajax call	
				$data = Array();
				$data['code'] = 1;
				
				
				// Get data
				$product_id = 0;
				if (!empty($_POST['allocation_id']) && is_int((int)$_POST['allocation_id'])){
					$allocation_id = $_POST['allocation_id'];
				} else {
					$data['code'] = 2;
					$data['msg'] = 'Error. No existe identificador de allocation.';
					echo json_encode($data);
					break;
				}
				
				$client_id = 0;
				if (!empty($_POST['client_id']) && is_int((int)$_POST['client_id'])){
					$client_id = $_POST['client_id'];
				} else {
					$data['code'] = 3;
					$data['msg'] = 'Error. No existe identificador de cliente.';
					echo json_encode($data);
					break;
				}
				
				$checked = false;
				if (isset($_POST['checked']) && is_int((int)$_POST['checked'])){
					$checked = $_POST['checked'];
				} else {
					$data['code'] = 4;
					$data['msg'] = 'Error. No se ha recibido el cambio de estado.';
					echo json_encode($data);
					break;
				}
				
				// Remove or save 
				if (!$checked) {
					// Remove
					Allocation::assignAllocationToClient($allocation_id, $client_id, false);
					$data['msg'] = 'Asociación al allocation eliminada correctamente';
					
				} else {
					// Insert or update
					Allocation::assignAllocationToClient($allocation_id, $client_id);
					$data['msg'] = 'Producto asociado correctamente';
										
				}
				
				$data['allocation_id'] = $allocation_id;
				echo json_encode($data);
				break;	
				
		
				
			case 'search_programming_products_client':
				
				if (isset($_GET['q']) && is_int((int)$_GET['q'])){
					$query = $_GET['q'];
					$_SESSION["cp_admin_query"] = $_GET['q'];
				} else {
					if(isset($_SESSION["cp_admin_query"])) {
						$query = (int)$_SESSION["cp_admin_query"];
					} else {	
						$query = '';
						unset($_SESSION["cp_admin_query"]);
					}
				}
	
			case 'edit_programming_products_client':

				$client_id = 0;	
				if (!empty((int)Utils::sanitize($_GET['client_id']))){
					$client_id = (int)Utils::sanitize($_GET['client_id']);
				}
			
				if ($client_id == 0) {
					Utils::addMessage("Por favor, seleccione un cliente.","warning");
					Utils::redirect('index.php?controller=clientsController');
					break;
				}
				
				if (isset($_GET['brand_id']) && is_int((int)$_GET['brand_id'])){
					$brand_id = (int)$_GET['brand_id'];
					$_SESSION["cp_admin_brand_id"] = (int)$_GET['brand_id'];
				} else {
					if(isset($_SESSION["cp_admin_brand_id"])) {
						$brand_id = (int)$_SESSION["cp_admin_brand_id"];
					} else {	
						$brand_id = 0;
						unset($_SESSION["cp_admin_brand_id"]);
					}
				}
				
				if (isset($_GET['discount_category_id']) && is_int((int)$_GET['discount_category_id'])){
					$discount_category_id = (int)$_GET['discount_category_id'];
					$_SESSION["cp_admin_discount_category_id"] = (int)$_GET['discount_category_id'];
				} else {
					if(isset($_SESSION["cp_admin_discount_category_id"])) {
						$discount_category_id = (int)$_SESSION["cp_admin_discount_category_id"];
					} else {	
						$discount_category_id = 0;
						unset($_SESSION["cp_admin_discount_category_id"]);
					}
				}
				
				if (isset($_GET['associate']) && is_int((int)$_GET['associate'])){
					$associate = (int)$_GET['associate'];
					$_SESSION["cp_admin_associate"] = (int)$_GET['associate'];
				} else {
					if(isset($_SESSION["cp_admin_associate"])) {
						$associate = (int)$_SESSION["cp_admin_associate"];
					} else {	
						$associate = -1;
						unset($_SESSION["cp_admin_associate"]);
					}
				}			
				
				$discount_categories = Array();
				if ($brand_id > 0) {
					$discount_categories = Discountcategory::getDiscountCategories($brand_id);
				}
				
				if(!in_array($discount_category_id, array_column($discount_categories, 'discount_category_id')))
					$discount_category_id = 0;
		
				
				$client = new client($client_id);

					
				// if is search
				if (!empty($query)) {
					
					$this->tpl->assign(array(
                        'url_referer_back'=>$_SESSION['url_referer_back'],
						'action' => 'list',
						'query' => $query,
						'client_data'=> $client,
						'brand_id'=> $brand_id,
						'associate'=>$associate,
						'brands'=> Brand::getAllBrands(),
						'discount_category_selected'=>$discount_category_id,
						'discount_categories'=> $discount_categories,
						'products_data'=> Product::searchProductsByName($query, PRODUCTS_TYPE_PROGRAMMING, $brand_id, $discount_category_id, $client_id, $associate),
						'pagination' => array(	
							'total_papes'=>0,
							'items_per_page'=>0,
							'actual_page'=>0)
					));
					
					
					
				} else {
				// Regular list 
				
					if (isset($_GET['page'])){
						$page = (int)$_GET['page'];
					} else {
						$page = 0;
					}	
					
				
					$this->tpl->assign(array(
                        'url_referer_back'=>$_SESSION['url_referer_back'],
						'action' => 'list',
						'client_data'=> $client,
						'brand_id'=> $brand_id,
						'brands'=> Brand::getAllBrands(),
						'associate'=>$associate,
						'discount_category_selected'=>$discount_category_id,
						'discount_categories'=> $discount_categories,
						'products_data'=> Product::getAllproducts(DEFAULT_PAGE_ITEMS, $page, PRODUCTS_TYPE_PROGRAMMING, $brand_id, $discount_category_id, $client_id, $associate),
						'pagination' => array(	
							'total_pages'=>ceil(Product::getCountAllproducts(PRODUCTS_TYPE_PROGRAMMING, $brand_id, $discount_category_id, $client_id, $associate)/DEFAULT_PAGE_ITEMS),
							'items_per_page'=>DEFAULT_PAGE_ITEMS,
							'actual_page'=>$page)
					));
				}
				
				
				
				
				return $this->display('admin/clients-programming-products.tpl');
				
				break;
				
			case 'ajax_set_subclient':		
				$error = false;
				$client_id = (int)$_POST['client_id'];
				$checked = (int)$_POST['checked'];
				
				$subclient_id_list = explode(",",$_POST['subclient_id']);

				$data['msg']="";
				
				foreach ($subclient_id_list as $subclient_id){					
					$subclient_id = (int)$subclient_id;

					if ($client_id > 0 && $subclient_id > 0){
						
						$client = new client($client_id);
						
						if ($checked==0){
							if(!$client->removeSubclient($subclient_id)){
								$error = true;
								$data['code'] = 2;
								$data['msg'] .= 'Error. No se ha podido desasociar el cliente '. $subclient_id.' al administrador.'."\n";
							}
						} else if($checked==1) {				
							if(!$client->addSubclient($subclient_id)){
								$error = true;
								$data['code'] = 3;
								$data['msg'] .= 'Error. No se ha podido asociar el cliente '. $subclient_id.' al administrador.'."\n";
							}
						}
					}
				}
				
				if (count($subclient_id_list)>1){
					if (!$error){
						$data['code'] = 1;
						$data['msg'] = 'Clientes actualizados correctamente.';
					} 
				} else {
					if (!$error){
						$data['code'] = 1;
						$data['msg'] = 'Cliente actualizado correctamente.';
					}
				}
				
				
				echo json_encode($data);
				exit();
				break;
				
			case 'ajax_set_product':
			
				// Save discount from ajax call	
				$data = Array();
				$data['code'] = 1;
				
				
				// Get data
				$product_id = 0;
				if (!empty($_POST['product_id']) && is_int((int)$_POST['product_id'])){
					$product_id = $_POST['product_id'];
				} else {
					$data['code'] = 2;
					$data['msg'] = 'Error. No existe identificador de producto.';
					echo json_encode($data);
					break;
				}
				
				$client_id = 0;
				if (!empty($_POST['client_id']) && is_int((int)$_POST['client_id'])){
					$client_id = $_POST['client_id'];
				} else {
					$data['code'] = 3;
					$data['msg'] = 'Error. No existe identificador de cliente.';
					echo json_encode($data);
					break;
				}
				
				$checked = false;
				if (isset($_POST['checked']) && is_int((int)$_POST['checked'])){
					$checked = $_POST['checked'];
				} else {
					$data['code'] = 4;
					$data['msg'] = 'Error. No se ha recibido el cambio de estado.';
					echo json_encode($data);
					break;
				}
				
				// Remove or save 
				if (!$checked) {
					// Remove
					$clear_clients_products = "DELETE from clients_products WHERE product_id = " . (int)$product_id . " AND client_id = " . (int)$client_id;
					DB::getInstance()->query($clear_clients_products);
					$data['msg'] = 'Asociación a producto eliminada correctamente';
					
				} else {
					// Insert or update
					$insert_clients_products = "
											INSERT INTO clients_products 
											SET product_id = " . (int)$product_id . ", client_id = " . (int)$client_id . " 
											ON DUPLICATE KEY UPDATE product_id = " . (int)$product_id . ",client_id = " . (int)$client_id;
					
					DB::getInstance()->query($insert_clients_products);
					$data['msg'] = 'Producto asociado correctamente';
										
				}
				
				$data['product_id'] = $product_id;
				echo json_encode($data);
				break;
            case 'ajax_unset_all_product':
                // Save discount from ajax call	
    				$data = Array();
    				$data['code'] = 1;
		
    				// Get data
    				
    				$client_id = 0;
    				if (!empty($_POST['client_id']) && is_int((int)$_POST['client_id'])){
    					$client_id = $_POST['client_id'];
    				} else {
    					$data['code'] = 3;
    					$data['msg'] = 'Error. No existe identificador de cliente.';
    					echo json_encode($data);
    					break;
    				}
    				
    				// Remove 
    				$clear_clients_products = "DELETE from clients_products WHERE client_id = " . (int)$client_id;
					DB::getInstance()->query($clear_clients_products);
					$data['msg'] = 'Asociación a productos eliminada correctamente';
    				
    				$data['product_id'] = $product_id;
    				echo json_encode($data);
                break;
			case 'getClientsByName':
				// Only AJAX call
    			$clients_list = Client::getClientsByName($_POST['search']);
				echo json_encode($clients_list);
				exit();
				break;
			default:	
			
				if (isset($_GET['page'])){
					$page = (int)$_GET['page'];
				} else {
					$page = 0;
				}	

                $_SESSION['url_referer_back'] = $_SERVER['REQUEST_URI'];

				$this->tpl->assign(array(
                    'url_referer_back'=>$_SESSION['url_referer_back'],
					'action' => 'list',
					'clients_data'=> Client::getAllClients(DEFAULT_PAGE_ITEMS, $page),
					'pagination' => array(	
						'total_papes'=>ceil(Client::getCountAllClients()/DEFAULT_PAGE_ITEMS),
						'items_per_page'=>DEFAULT_PAGE_ITEMS,
						'actual_page'=>$page)
				));
				return $this->display('admin/clients.tpl');	
		}
		
    }
	
	private function display($tpl){
		
		if (isset($this->params['query']) && !empty($this->params['query'])){
			include('classes/search.php');
			$search = new Search();
			$search_result = $search->query($this->params['query']);
		} else {
			$search_result = '';
		}		
		
		$this->tpl->assign(array(
			'page_title'=> PAGE_TITLE,
			'meta_description'=> PAGE_META_DESCRIPTION,
			'navitems'=> Utils::getAdminNav('ClientsController'),
			'messages'=>Utils::getMessages(),
			'discountgroups'=>DiscountGroup::getAllDiscountGroups(),
			'superadmin'=>$_SESSION['admin_login']['superadmin'],
			'folders'=> Folder::getFullFolderTree()
		));
		
		$this->tpl->display('admin/common/head.tpl');	
		$this->tpl->display('admin/common/header.tpl');
		
        $this->tpl->display($tpl);
		
		$this->tpl->display('admin/common/footer.tpl');
		return true;
	}

}
?>