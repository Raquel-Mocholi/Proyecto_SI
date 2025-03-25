<body class="">
  <div class=" ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="./" class="simple-text logo-normal" style="text-align:center;">
          <img src="/{ASSETS_PATH}/logo-turistic.png?nocache={rand(10,100)}">
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
		{foreach $navitems as $sections}
			{if count($sections['sections'])>0}
				<li {if $sections['active']}class="activado"{/if}>
					<a href="#">{$sections['admin_category_name']}<i class="fa fa-chevron-down"></i></a>
					<ul {if $sections['active']}style="display:block;"{/if}>
					{foreach $sections['sections'] as $navitem}
						<li {if ($navitem.active==1)}class="active"{/if}>
							<a href="./{$navitem.link}">
								<i class="{$navitem.icon}"></i>
								<p>{$navitem.name}</p>
							</a>
						</li>
					{/foreach} 
					</ul>
				</li>
			{/if}
		 {/foreach} 
        </ul>
      </div>
    </div>

