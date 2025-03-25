
<div class="main-panel">
	<!-- Navbar -->
	{include file="admin/common/navbar.tpl"}
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
						
						{foreach $navitems as $sections}
							{if count($sections['sections'])>0}
								<div class="row">
									<div class="col-12 col-md-12">
										<h4 style="width:100%; border-bottom:1px solid #333333;margin-top:25px;">{$sections['admin_category_name']}</h4>
									</div>
									{foreach $sections['sections'] as $navitem}
									
									<div class="col-6 col-md-2 home-icons">
										<a href="./{$navitem.link}">
											<i class="{$navitem.icon}"></i><br>
											<p>{$navitem.name}</p>
										</a>
									</div>
									{/foreach} 
								</div>
							{/if}
						 {/foreach} 

					</div>
					<div class="card-footer ">
						<hr>
		
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
