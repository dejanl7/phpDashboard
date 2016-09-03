<footer>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<p>Copyright &copy; Unilink-finance 2016</p>
			</div>
		</div>
	</div>
	
<!-- SCRIPT Files -->
	<script src="js/jquery-1.12.3.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery-ui.min.js"></script> <!-- Moving DIVS - DRAGGABLE -->
	<script src="js/menus.js"></script> <!-- Move left menu on click -->
	
	<script src="js/ajax/right_click.js"></script>
	<script src="js/ajax/ajax_boxes.js"></script>
	

<!--  CUSTOM JAVASCRIPT - AJAX FOR INDEX.php   -->	
	<script  src="js/ajax/ajax_media.js"></script>
	<script  src="js/ajax/ajax_controls.js"></script>
	
	
<!-- Div moving - JQuery online -->
	<script>
	  $(function() {
		$( ".dropdown" ).draggable();
	  });
	  $(function() {
		$( ".popup_msg" ).draggable();
	  });
	</script>


<!--  VERY IMPORTANT!!!!!!!!!!!!!!!!! Include JAVASCRIPT FUNCTIONS into this page.  -->
	<script src="js/functions_js/js_media.js"></script>
	<script src="js/functions_js/js_controls.js"></script>
	<script src="js/functions_js/js_boxes.js" ></script>
		
		<script>
			// Activates the Carousel
			$('.carousel').carousel({
				interval: 4000
			});
		</script>
	
	<!-- Load local libraries -->
	<script src="js/plugins/color_picker/bootstrap-colorpicker.js"></script>
	<script src="js/plugins/gallery_plugin/easyResponsiveTabs.js" type="text/javascript"></script>	
	<script src="js/plugins/gallery_plugin/jquery.etalage.js"></script>
	<script src="js/plugins/owl-carousel/owl.carousel.js"></script>

	<!-- Preloader -->
	<script>
		// Wait for window load
		$(window).load(function() {
			// Animate loader off screen
			$(".se-pre-con").fadeOut("slow");;
		});
	</script>
		

	<script type="text/javascript">
		$('#search').keyup(function(){
         var search = $('#search').val(); 
         //alert(search);
			$.ajax({
				url:'search.php',
				data:{search: search},
				type: 'POST',
				success:function(data){
					if(!data.error) {
						$('#searching-result').html(data);
					}
				}
			});
        });		
	</script>
</footer>