 <body class="login-body">
  <div class=" ">
	  <div class="container">
			<div class="row">
				<div class="col-md-4 offset-md-4 login-box" style="padding-top:30px;">
					<div class="center-text"><h1>Login</h1></div>
					<div>
						<form id="search" action="index.php?controller=loginController&action=login" method="post">
							<fieldset>
								  <div class="form-group">
									<label for="client_username">Usuario</label>
									<input type="text" class="form-control" id="client_username" name="client_username" placeholder="Nombre de usuario">
								  </div>
								  <div class="form-group">
									<label for="client_password">Contraseña</label>
									<input type="password" class="form-control" id="client_password" name="client_password" placeholder="Contraseña">
								  </div>
								  <button type="submit" class="btn btn-primary">Entrar</button>
							</fieldset>
						</form>	
					</div>
				</div>
			</div>
		</div>
	</div>
	 <div id="footer-login" class=" login-footer">
		 <div class="container">
			<div class="row">
				<div class="col-sm-12 center-text">
					<span><a href="">(c) {date("Y")} TuristicAPP</a></span>
				</div>
			</div>
		</div>
	</div>
	
	<!--  Notifications Plugin    -->
	<script src="../js/plugins/bootstrap-notify.js"></script>
	<!-- Messages -->
	
	{include file="front/common/messages.tpl"}
	<!-- End Messages -->
</body>