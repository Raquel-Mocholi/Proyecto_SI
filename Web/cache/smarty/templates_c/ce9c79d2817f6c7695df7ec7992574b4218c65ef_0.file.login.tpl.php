<?php /* Smarty version 3.1.24, created on 2025-03-20 12:01:09
         compiled from "template/admin/login.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:17891622067dbf575aa2531_62590937%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ce9c79d2817f6c7695df7ec7992574b4218c65ef' => 
    array (
      0 => 'template/admin/login.tpl',
      1 => 1676976935,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17891622067dbf575aa2531_62590937',
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_67dbf575ab6819_03273759',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_67dbf575ab6819_03273759')) {
function content_67dbf575ab6819_03273759 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '17891622067dbf575aa2531_62590937';
?>
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
					<span><a href="">(c) <?php echo date("Y");?>
 TuristicAPP</a></span>
				</div>
			</div>
		</div>
	</div>
	
	<!--  Notifications Plugin    -->
	<?php echo '<script'; ?>
 src="../js/plugins/bootstrap-notify.js"><?php echo '</script'; ?>
>
	<!-- Messages -->
	
	<?php echo $_smarty_tpl->getSubTemplate ("front/common/messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

	<!-- End Messages -->
</body><?php }
}
?>