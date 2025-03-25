<?php /* Smarty version 3.1.24, created on 2025-03-20 12:17:14
         compiled from "template/admin/common/footer.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:86863688367dbf93a4997b0_54227038%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e6b9f5fbd14c1b613b8e758d1c7b952ff301ad74' => 
    array (
      0 => 'template/admin/common/footer.tpl',
      1 => 1680698190,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '86863688367dbf93a4997b0_54227038',
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_67dbf93a49ab97_54062953',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_67dbf93a49ab97_54062953')) {
function content_67dbf93a49ab97_54062953 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '86863688367dbf93a4997b0_54227038';
?>
	<footer class="footer footer-black  footer-white "> 
        <div class="container-fluid">
          <div class="row">


          </div>
		  </div>
      </footer>
    </div>


  
    <?php echo '<script'; ?>
 src="../js/plugins/perfect-scrollbar.jquery.min.js"><?php echo '</script'; ?>
> 

	<!-- jQuery Confirm-->
	
	<?php echo '<script'; ?>
 src="../js/jquery.confirm.min.js"><?php echo '</script'; ?>
>

	<!-- Chart JS -->
	<?php echo '<script'; ?>
 src="../js/plugins/chartjs.min.js"><?php echo '</script'; ?>
>
	<!--  Notifications Plugin    -->
	<?php echo '<script'; ?>
 src="../js/plugins/bootstrap-notify.js"><?php echo '</script'; ?>
>

	<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
	<?php echo '<script'; ?>
 src="../js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="../js/general-admin.js" type="text/javascript"><?php echo '</script'; ?>
>

	<?php echo '<script'; ?>
 src="../js/bsmultiselect/js/BsMultiSelect.js"><?php echo '</script'; ?>
>
	<link rel="stylesheet" href="../js/bsmultiselect/css/BsMultiSelect.css">
	
	<!-- Messages -->
	<?php echo $_smarty_tpl->getSubTemplate ("admin/common/messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

	<!-- End Messages -->
	<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="nc-icon  nc-minimal-up"></i></button>
	<style>
		#myBtn {
			display: none; 
			position: fixed; 
			bottom: 20px; 
			right: 30px; 
			z-index: 99;
			border: none; 
			outline: none;
			background-color: red; 
			color: white; 
			cursor: pointer;
			padding: 15px 18px 13px 18px; 
			border-radius: 10px; 
			font-size: 18px;
			font-weight:bold;
		}

		#myBtn:hover {
			background-color: #555; /* Add a dark-grey background on hover */
		}
	</style>
	
	<?php echo '<script'; ?>
>
	mybutton = document.getElementById("myBtn");

	// When the user scrolls down 20px from the top of the document, show the button
	window.onscroll = function() {scrollFunction()};

	function scrollFunction() {
	  if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
		mybutton.style.display = "block";
	  } else {
		mybutton.style.display = "none";
	  }
	}

	// When the user clicks on the button, scroll to the top of the document
	function topFunction() {
	  document.body.scrollTop = 0; // For Safari
	  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
	}
	<?php echo '</script'; ?>
>

</body>
</html><?php }
}
?>