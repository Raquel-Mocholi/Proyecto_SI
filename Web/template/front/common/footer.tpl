	</div> {*End of id="content-body"*}
	<div class="footer-wide">
		<div class="container">
			<footer class="footer center-text">
				<div>
					<img style="width:100px;" src="img/brands/brand_{$brand->brand_id}.png">
				</div>	
				<div id="legal" class="no-print">
					<span><a class="main-color-2 footer-legal-items">(c) {date("Y")} Turistic APP</a></span> 
					<span><a class="footer-legal-items" href="index.php?controller=cmsController&cms_id=1">Aviso legal</a></span> 
					<span><a class="footer-legal-items" href="index.php?controller=cmsController&cms_id=4">Términos y condiciones</a></span> 
					<span><a class="footer-legal-items" href="index.php?controller=cmsController&cms_id=2">Política de privacidad</a></span> 
					<span><a class="footer-legal-items" href="index.php?controller=cmsController&cms_id=3">Política de cookies</a></span> 
					<br>
				</div>
			</footer>
		</div>
	</div>


	{assign var=unique_id value=10|mt_rand:20}
    
	<script src="js/general.js?nocache={$unique_id}" type="text/javascript"></script>
	
	<!-- Messages -->
	{include file="front/common/messages.tpl"}
	<!-- End Messages -->
</body>
</html>