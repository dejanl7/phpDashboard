<?php include("../admin/inc/home-files/home_header.php"); ?><!-- Include header -->
<?php 
	global $base;
	$status = user::find_this_id($base->clear_string($_GET['user_id']));
?>

<!-- STYLE FOR ALL PAGE -> using information from database for creating page style -->
<style>	
	#first_div_contact_text_container{
		color: <?php echo contact_page_css::css("contact_page_css","first_headline_content_font_color", $base->clear_string($_GET['user_id'])); ?>;	
	}		
	#top_menu{
		background-color:<?php echo about_us::css('about_us', 'menu_bg_color',$base->clear_string($_GET['user_id'])); ?>;
	}
	.change_text_color{
		color:<?php echo about_us::css('about_us', 'menu_text_color', $base->clear_string($_GET['user_id'])); ?>; 
	}
	#first_div_contact{
		color:<?php echo contact_page_css::css('contact_page_css', 'first_div_headline_font_color', $base->clear_string($_GET['user_id'])); ?>; 
	}
	#address_info_div{
		color:<?php echo contact_page_css::css('contact_page_css', 'first_div_content_font_color', $base->clear_string($_GET['user_id'])); ?>; 
	}
	#all_first_div{
		background-color:<?php echo contact_page_css::css('contact_page_css', 'first_div_content_background_color', $base->clear_string($_GET['user_id'])); ?>; 
	}
</style>  
<!-- END OF STYLE FOR PAGE "contact.php" -->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="se-pre-con"></div><!-- Preloader Div -->

<div class="wrapper" id="wrapper_contact">
<?php include("../admin/inc/home-files/home_top_menu.php"); ?>
		
	<section class="bo" id="bo_contact" style="
			background: url('../admin/img/background_images/<?php
				$query = "SELECT * FROM users WHERE user_id = ". $base->clear_string($_GET['user_id']);
				$find = user::find_this_query($query);
				foreach($find as $background){
					echo $background->background_img;
				}
				//echo background_image();
			?>')
			no-repeat center center fixed;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover; 
			">

		<div id="first_div_contact_text_container" class="brand">
			<div id="first_div_contact_text" class="text-center" style="
					font-size: <?php echo contact_page_css::css('contact_page_css','first_headline_content_weight', $base->clear_string($_GET['user_id'])); ?>;	
					font-family: <?php echo contact_page_css::css('contact_page_css','first_headline_content_type', $base->clear_string($_GET['user_id'])); ?>;
				"><br>
				Kontakt preduzeća 
					<?php 
						$search_company_name = "SELECT * FROM users WHERE user_id =".$base->clear_string($_GET['user_id']); 
						$res = user::find_this_query($search_company_name);
						foreach($res as $user_name){
							echo $user_name->name;
						}
					?>
			</div>
		</div>
			<?php $search_contact_info = "SELECT * FROM users WHERE user_id = ". $base->clear_string($_GET['user_id']); 
				$contact_result = user::find_this_query($search_contact_info);
				foreach($contact_result as $contact_info){
					echo "<div class='address-bar'>{$contact_info->city} | {$contact_info->address} | {$contact_info->phone}</div>";
				}
			?>
    	
    <div id="empty-div" style="height: 14px;"></div>


<?php include("../admin/inc/home-files/home_main_menu.php"); ?><!-- Include file "main_menu.php" --> 

    <div class="container container-company">
		<div class="box" id="all_first_div">
			<div id="first_div_contact_container">
                <div id="first_div_contact" class="col-lg-12">
                    <hr>
						<h2 id="company_location_headline" class="intro-text text-center" style="
							font-size: <?php echo contact_page_css::css('contact_page_css','first_div_headline_font_weight', $base->clear_string($_GET['user_id'])); ?>;	
							font-family: <?php echo contact_page_css::css('contact_page_css','first_div_headline_font_type', $base->clear_string($_GET['user_id'])); ?>;
						">
							Informacije o preduzeću, <strong>Lokacija</strong>
						</h2>
                    <hr>
                </div><!-- #first_div_contact -->
            </div><!-- #first_div_contact_container -->
				
	<?php
		global $base;
		$chack_if_exist = "SELECT * FROM contact_page WHERE user_id = ". $base->clear_string($_GET['user_id']);	
		$find_query = $base->select_table($chack_if_exist);
			$result = mysqli_num_rows($find_query);
			if($result > 0){
	?>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<!-- Include script files for google maps and jquery -->
				<script src="http://maps.google.com/maps/api/js?sensor=false"  type="text/javascript"></script>
				
				<!-- Update google maps address on marker dragg -->
					<br/><br/>
						<div id="map" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 map-div" ></div><!-- Include google maps.... -->
				<!-- Next, we need to create div for load two forms. First form is form for adding new address. -->
				<!-- Second form is form for updateing location(s) in map. For this purposes, we are using dragg function of google map marks! -->
					<br/><br/>
					
			<script>
					var locations = <?php
							$query = "SELECT * FROM contact_page WHERE user_id = ". $base->clear_string($_GET['user_id']);
								echo "[";
							$search_query = contact::find_this_query($query);
								foreach($search_query as $res){
									echo "['".$res->address."', ".$res->latitude.", ".$res->longitude.",".$res->contact_id.",'".$res->description."'],";
								}
								echo "]";
						?>
			      // This example displays a marker at the center of Australia.
			      // When the user clicks the marker, an info window opens.

			      function initMap() {       
					var map = new google.maps.Map(document.getElementById('map'), {
					  zoom: 13,
					  center: new google.maps.LatLng(locations[0][1], locations[0][2]),
					  mapTypeId: google.maps.MapTypeId.ROADMAP
					});

					var infowindow = new google.maps.InfoWindow();
					var marker, i;

					for (i = 0; i < locations.length; i++) {  
					  marker = new google.maps.Marker({
						position: new google.maps.LatLng(locations[i][1], locations[i][2]),
						map: map,
						id: locations[i][3],
						draggable: false
					  });

					  google.maps.event.addListener(marker, 'click', (function(marker, i) {
						return function() {
							infowindow.setContent(locations[i][4]);
							infowindow.open(map, marker);
						}
					  })(marker, i));
	
						}
			      }
    		</script>
    		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAABX1BjYdE0wzgQU1I4K_MvJlGB1vgtrw&callback=initMap"></script>
            </div><!-- .container -->
    <?php
			}
			else{		
	?>
				<div id="marker-form" class="col-md-8 col-lg-12">
					<!-- Embedded Google Map using an iframe - to select your location find it on Google maps and paste the link as the iframe src. If you want to use the Google Maps API instead then have at it! -->
					<div class="map-div">	
						<iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?hl=en&amp;ie=UTF8&amp;ll=44.5333333333,19.3&amp;spn=56.506174,79.013672&amp;t=m&amp;z=6&amp;output=embed"></iframe>
					</div><!-- .map-div -->
				</div><!-- .col-lg-12 -->
	<?php
			}
	?>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pull-left" id="address_info_div" style="width:1100px;
					font-size: <?php echo contact_page_css::css('contact_page_css','first_div_content_font_weight', $base->clear_string($_GET['user_id'])); ?>;	
					font-family: <?php echo contact_page_css::css('contact_page_css','first_div_content_font_type', $base->clear_string($_GET['user_id'])); ?>;
				">
					<div id="address_info_div_load">
					<?php 
						global $base;
						$show_inforamtion = "SELECT * FROM contact_page WHERE user_id = ". $base->clear_string($_GET['user_id']);
						$find_results = contact::find_this_query($show_inforamtion);
						foreach($find_results as $each_result_column):
					?>
						<div class = "col-xs-12 col-sm-12 col-md-6 col-lg-4 all_address_info pull-left"  style="padding-right: 50px; padding-top: 50px;" id="<?php echo $each_result_column->contact_id; ?>">
							Adresa: <strong><?php echo $each_result_column->address; ?></strong><br/>
							Telefon: <strong><?php echo $each_result_column->phone_number; ?></strong><br/>
							Mobilni telefon: <strong><?php echo $each_result_column->mobile_phone; ?></strong><br/>
							E-mail: <strong><?php echo $each_result_column->e_mail; ?></strong><br/>
							Fax: <strong><?php echo $each_result_column->fax; ?></strong>
						</div>
						
					<?php
						endforeach;
					?>
					</div>
                </div><!-- .col-lg-12 -->
                
                <div class="clearfix"></div>				

				<span id="contact_us" class="btn btn-default">Pošaljite nam poruku</span>

    	</div><!-- #all_first_div -->
 	 </div><!-- .container -->
		
		<div class="container container-company" id="contact_form_container">
		  <div id="contact_form_load">
			<?php 
			$query_show_hide = "SELECT * FROM contact_page_css WHERE user_id = ". $base->clear_string($_GET['user_id']);
			$find_show_hide = contact_page_css::find_this_query($query_show_hide);
			foreach($find_show_hide as $res_of_show_hide){
				if($res_of_show_hide->show_hide_second_div_contact === "0"){
					//echo "Da";
				} else{
			?>

	            <div class="box" id="contact-form-message">
	                <div id="third-form-send-message">
	                    	<hr>
	                    <h2 class="intro-text text-center"><strong>Kontaktirajte nas</strong></h2>
	                    	<hr>
	                    <p class="sending-form">Ukoliko želite određene informacije, budite slobodni da nam se obratite putem ove forme. </p>
	                    <form role="form" id="send-message-form" action="../admin/inc/pages/pages_insert_info.php" method="POST">
	                        <div class="row">
	                        	<div class="hidden form-group col-xs-12 col-sm-12 col-md-6 col-lg-4">
	                                <label>Id korisnika</label>
	                                <input type="text" name="user_id" class="form-control" value="<?php echo $base->clear_string($_GET['user_id']); ?>" required>
	                            </div>
	                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-4">
	                                <label>Ime</label>
	                                <input type="text" name="sender_name" id="sender_name" class="form-control" placeholder="Unesite Vaše ime" required>
	                            </div>
	                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-4">
	                                <label>E-mail</label>
	                                <input type="email" name="sender_email" id="sender_email" class="form-control" placeholder="Unesite Vašu e-mail adresu" required>
	                            </div>
	                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-4">
	                                <label>Broj telefona</label>
	                                <input type="tel" name="sender_phone" id="sender_phone" class="form-control" placeholder="Unesite broj telefona - nije obavezno">
	                            </div>
	                            
	                            <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12" >
	                                <label>Poruka</label>
	                                <textarea class="form-control col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-2" id="message-content" name="sender_message" rows="10"></textarea>
	                            </div>
	                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-4">
	                            	<input type="submit" name="submit_message" id="submit_message" value="Send Message" class="btn btn-warning" />
	                            </div>
	                        </div><!-- .row -->
	                    </form><!-- End of Form -->
	                </div><!--  .col-lg-12  -->
	            </div><!-- .box -->

			<?php
					}
				}
			?>
		  </div><!-- #contact_form_load -->
		</div><!-- #contact_form_container -->


		<?php include("../admin/inc/home-files/home_footer.php");?>


   </section>
  </div>
  </div>


</body>
</html>
