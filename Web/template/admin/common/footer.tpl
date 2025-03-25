	<footer class="footer footer-black  footer-white "> 
        <div class="container-fluid">
          <div class="row">


          </div>
		  </div>
      </footer>
    </div>


  
    <script src="../js/plugins/perfect-scrollbar.jquery.min.js"></script> 

	<!-- jQuery Confirm-->
	
	<script src="../js/jquery.confirm.min.js"></script>

	<!-- Chart JS -->
	<script src="../js/plugins/chartjs.min.js"></script>
	<!--  Notifications Plugin    -->
	<script src="../js/plugins/bootstrap-notify.js"></script>

	<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
	<script src="../js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
	<script src="../js/general-admin.js" type="text/javascript"></script>

	<script src="../js/bsmultiselect/js/BsMultiSelect.js"></script>
	<link rel="stylesheet" href="../js/bsmultiselect/css/BsMultiSelect.css">
	
	<!-- Messages -->
	{include file="admin/common/messages.tpl"}
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
	{literal}
	<script>
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
	</script>
{/literal}
</body>
</html>