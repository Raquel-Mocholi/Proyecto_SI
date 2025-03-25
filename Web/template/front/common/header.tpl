<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-circle-up"></i></button>
<body class="">
	<div id="header-top">
		<div class="container-fluid">
			<div class="row">
				
				<div class="col-2 d-block d-sm-none">
					<a href="./" class="simple-text logo-normal center-text" style="text-align:center;">
						<img id="brand-logo" src="img/brands/brand_{$brand->brand_id}.png">
					</a>
				</div>
				
				<div id="client-menu" class="col-2 left-text d-none d-md-block">
					{if ($product_type==PRODUCTS_TYPE_REPLENISHMENT)}
						<span title="Actualmente estás realizando pedidos de REPOSICIÓN" style="cursor:default;">Estás en <strong>REPOSICIÓN</strong></span>
					{else}
						<span title="Actualmente estás realizando pedidos de PROGRAMACIÓN" style="cursor:default;">Estás en <strong>PROGRAMACIÓN</strong></span>
					{/if}
				</div>
				<div id="client-menu" class="col-10 right-text d-none d-md-block">
					<span><i class="fa fa-user main-color-2"  style="font-size:14px;vertical-align:absmiddle;"></i> <a title="Accede a tu &aacute;rea de cliente" href="index.php?controller=clientController" class="main-color-2">Hola {if (!empty($client_data->client_name))}{$client_data->client_name}{else}{$client_data->username}{/if}</a> {if $client_data->client_current_superclient['id']>0}<span style="font-size:12px;padding:0;margin:0;text-align:right;">(Gestionado por {$client_data->client_current_superclient['username']})</span>{/if}</a></span>
						{*<span><i class="fa fa-user main-color-2"  style="font-size:14px;vertical-align:absmiddle;"></i> <a href="index.php?controller=clientController">Mi cuenta</a> |*}

					
					{if ($product_type==PRODUCTS_TYPE_REPLENISHMENT)}
						{if (Client::hasProgrammingProducts($client_data->client_id, $brand->brand_id))}
						<span><i class="fa main-color-2 fa-random"  style="font-size:14px;vertical-align:absmiddle;"></i> <a href="index.php?controller=clientController&action=switchcartype&cart_product_type=1" style=""  title="Actualmente estás en reposición. Cambia a programación pulsando este enlace" >Cambiar a programación</a>	</span>
						{/if}
					{else}
						<span><i class="fa main-color-2 fa-random"  style="font-size:14px;vertical-align:absmiddle;"></i> <a href="index.php?controller=clientController&action=switchcartype&cart_product_type=0" title="Actualmente estás en programación. Cambia a reposición pulsando este enlace style=";">Cambiar a reposición</a> 	</span>
					{/if}
				
					
					{*<i class="fa fa-sign-out main-color-2"></i> <a href="index.php?controller=loginController&action=logout">Cerrar sesión</a></span>*}
					<span><i class="fa main-color-2 fa-shopping-cart" style="font-size:14px;vertical-align:absmiddle;"></i> <a href="index.php?controller=cartController" title="Ver el contenido completo de tu cesta actual"> Cesta (<span class="total-cart-items">{$cart_total_products}</span>)</a></span>
				</div>
				<div id="client-menu-phone" class="col-8 right-text d-md-none">
					<span><a href="index.php?controller=clientController"><i class="fa fa-user" style="font-size:30px;vertical-align:middle;"></i></a></span>
					<span><a href="index.php?controller=cartController"><i class="fa fa-shopping-cart" style="font-size:30px;vertical-align:middle;"></i> <span class="main-color-1 total-cart-items-xs">(<span class="total-cart-items-xs">{$cart_total_products}</span>)</span></a></span>
				</div>
				<div id="toggle-menu" class="col-1 d-block d-md-none">
					<a onClick="toggle_menu()"><i class="fa fa-bars" style="font-size:30px;"></i></a>
				</div>
			</div>
		</div>
	</div>	
	<div id="menu">
		<div class="container-fluid">
			<div class="menu-row">
				<div class=" d-none d-sm-block">
					<a href="./" class="simple-text logo-normal center-text" style="text-align:center;">
						<img id="brand-logo" src="img/brands/brand_{$brand->brand_id}.png">
					</a>
				</div>
			
			{*var_dump($nabvar)*}
				<div class=" left-text">
					<nav class="topnav">
					
						{* define the function *}                             
                            {function tree level=0}
							<ul {if ($level==0)}class="menu"{elseif ($level==1)}class="sub-menu"{else}class="sub-menu"{/if}>
								{foreach $data as $entry}
    								{if (is_array($entry.children) && (count($entry.children)) && $level<2)}
    					
						{*
										<li class="menu-item has-children"><a href="" onClick="event.preventDefault();" >
											{if isset($entry.category_name)}
												{$entry.category_name}
											{else}
												{$entry.discount_category_name}
											{/if}
											<span class="dropdown-icon"></span></a>
    									   {tree data=$entry.children level=$level+1}
    								    </li>
						*}			
										
										
										{if (isset($entry.category_id))}
    								        <li class="menu-item"><a href="index.php?controller=categoryController&category_menu_id={$entry.category_menu_id}&category_id={$entry.category_id}{foreach $entry.category_menu_features as $category_menu_feature}&features%5B%5D={$category_menu_feature}{/foreach}" >
												
												{$entry.category_name}<span class="dropdown-icon" onClick="event.preventDefault();"></span></a>
												{tree data=$entry.children level=$level+1}</li>
                                        {else}
											{if (isset($entry.discount_category_id) && ($entry.discount_category_id>0))}
												<li class="menu-item"><a href="index.php?controller=discountCategoryController&discount_category_menu_id={$entry.discount_category_menu_id}&discount_category_id={$entry.discount_category_id}{foreach $entry.discount_category_menu_features as $discount_category_menu_feature}&features%5B%5D={$discount_category_menu_feature}{/foreach}">{$entry.discount_category_name}<span class="dropdown-icon" onClick="event.preventDefault();"></span></a>
    									   {tree data=$entry.children level=$level+1}</li>
											{else}
												<li class="menu-item"><a href="index.php?controller=discountCategoryController&discount_category_menu_id={$entry.discount_category_menu_id}{foreach $entry.discount_category_menu_features as $discount_category_menu_feature}&features%5B%5D={$discount_category_menu_feature}{/foreach}">{$entry.discount_category_name}<span class="dropdown-icon" onClick="event.preventDefault();"></span></a>
    									   {tree data=$entry.children level=$level+1}</li>
											{/if}
                                        {/if}
										
										
    								{else}
                                        {if (isset($entry.category_id))}
    								        <li class="menu-item"><a href="index.php?controller=categoryController&category_menu_id={$entry.category_menu_id}&category_id={$entry.category_id}{foreach $entry.category_menu_features as $category_menu_feature}&features%5B%5D={$category_menu_feature}{/foreach}">{$entry.category_name}</a></li>
                                        {else}
											{if (isset($entry.discount_category_id) && ($entry.discount_category_id>0))}
												<li class="menu-item"><a href="index.php?controller=discountCategoryController&discount_category_menu_id={$entry.discount_category_menu_id}&discount_category_id={$entry.discount_category_id}{foreach $entry.discount_category_menu_features as $discount_category_menu_feature}&features%5B%5D={$discount_category_menu_feature}{/foreach}">{$entry.discount_category_name}</a></li>
											{else}
												<li class="menu-item"><a href="index.php?controller=discountCategoryController&discount_category_menu_id={$entry.discount_category_menu_id}{foreach $entry.discount_category_menu_features as $discount_category_menu_feature}&features%5B%5D={$discount_category_menu_feature}{/foreach}">{$entry.discount_category_name}</a></li>
											{/if}
                                        {/if}
    								{/if}
							     {/foreach}
							  </ul>
							{/function}
							
							{tree data=$nabvar}	
                            
					</nav>

				</div>
				<div id="searchbox" class="">
					<img src="img/assets/icons/icon-search.png" onClick="doSearch('')">
					<form class="form-searchbox" id="search_form" method="get" action="index.php">
						<input type="hidden" name="controller" value="searchController">
						<input type="search" placeholder="Buscar..." name="query" aria-label="Buscar productos">
					</form>
				</div>
			</div>
		</div>
	</div>
	<div id="searchbox-mobile">
		<img src="img/assets/icons/icon-search.png" onClick="doSearch('xs')">
		<form class="form-searchbox" id="search_form_xs"  method="get" action="index.php">
			<input type="hidden" name="controller" value="searchController">
			<input type="search" placeholder="Buscar productos..." name="query" aria-label="Buscar productos">
		</form>
	</div>
	<div id="content-body">