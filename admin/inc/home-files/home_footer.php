<footer>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<p>Copyright &copy; Unilink-finance 2016</p>
			</div>
		</div>
	</div>
	
<!-- SCRIPT Files -->
	<script src="../admin/js/jquery-1.12.3.min.js"></script>
	<script src="../admin/js/bootstrap.min.js"></script>
	<script src="../admin/js/jquery-ui.min.js"></script> <!-- Moving DIVS - DRAGGABLE -->
	<script src="../admin/js/menus.js"></script> <!-- Move left menu on click -->
	<script src="../admin/js/home-index-page.js"></script>


		<script>
			// Activates the Carousel
			$('.carousel').carousel({
				interval: 4000
			});
		</script>
	
	<script src="../admin/js/plugins/gallery_plugin/easyResponsiveTabs.js" type="text/javascript"></script>	
	<script src="../admin/js/plugins/gallery_plugin/jquery.etalage.js"></script>
	<!-- Preloader -->
	<script>
		// Wait for window load
		$(window).load(function() {
			// Animate loader off screen
			$(".se-pre-con").fadeOut("slow");;
		});
	</script>


	<!-- TINYMC -->
	<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
	<script>tinymce.init({selector:'textarea'});</script> <!-- Used! -->
	
	<script type="text/javascript">
		$('#search-company').keyup(function(){
         var search = $('#search-company').val(); 
         //alert(search);
			$.ajax({
				url:'../admin/search.php',
				data:{search: search},
				type: 'POST',
				success:function(data){
					if(!data.error) {
						$('#searching-result-company').html(data);
					}
				}
			});
        });		
	</script>
</footer>