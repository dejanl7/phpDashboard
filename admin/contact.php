<?php include("inc/header.php"); ?><!-- Include header -->
<?php
	if(!$session->session_status()){
		redirect("logout.php");
	}
?>
<?php 
	global $base;
	$status = user::find_this_id( $base->clear_string($_SESSION['user_id']) );
	if( $status->active == 0 ){
		redirect('logout.php');
	}
	
	if($user->role == 'master_admin' ){
		redirect('logout.php');
	}
?>

<!-- STYLE FOR ALL PAGE -> using information from database for creating page style -->
<style>	
	#first_div_contact_text_container{
		color: <?php echo contact_page_css::css("contact_page_css","first_headline_content_font_color"); ?>;	
	}		
	#top_menu{
		background-color:<?php echo about_us::css('about_us', 'menu_bg_color'); ?>;	
		color:<?php echo about_us::css('about_us', 'menu_text_color'); ?>;
	}
	.change_text_color{
		color:<?php echo about_us::css('about_us', 'menu_text_color'); ?>; 
	}
	#first_div_contact{
		color:<?php echo contact_page_css::css('contact_page_css', 'first_div_headline_font_color'); ?>; 
	}
	#address_info_div{
		color:<?php echo contact_page_css::css('contact_page_css', 'first_div_content_font_color'); ?>; 
	}
	#all_first_div{
		background-color:<?php echo contact_page_css::css('contact_page_css', 'first_div_content_background_color'); ?>; 
	}
</style>  
<!-- END OF STYLE FOR PAGE "contact.php" -->
</head>
<body  class="hold-transition skin-blue sidebar-mini <?php echo ($user->left_menu_collapse== '1' ? ' sidebar-collapse' : ''); ?>" data-menustate=<?php echo ($user->left_menu_collapse== '1' ? ' collapsed' : ' not-collapsed');  ?>>
<div class="se-pre-con"></div><!-- Preloader Div -->
	
<div class="wrapper" id="wrapper_contact">
<!-- INCLUDE ALL SEPARATED FILES -->
	<?php include("inc/top_menu.php"); ?>
	<?php include("inc/left_menu.php"); ?>

	
	<section class="bo" id="bo_contact" style="
			background: url(img/background_images/<?php
				$query = "SELECT * FROM users WHERE user_id = ". $base->clear_string($_SESSION['user_id']);
				$find = user::find_this_query($query);
				foreach($find as $background){
					echo $background->background_img;
				}
				//echo background_image();
			?>)
			no-repeat center center fixed;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover; 
			">
<!-- CONTEXT MENUES -->
		<div id="body" class="dropdown clearfix">
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px;">
				<li><a id="body_bg_image" class="remodal-bg" href="#" tabindex="-1" data-remodal-target="remodal_change_background_image">Promeni sliku pozadine</a></li>
			</ul>
		</div>
		
		<div id="contact_headline_context" class="dropdown clearfix">
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px;">
				<li><a tabindex="-1" id="contact_hl_weight" data-font="headline" data-page="contact_page_css">Izmenite font naslova</a></li>
				<li><a tabindex="-1" id="contact_hl_color" data-color="font_color" data-page="contact_page_css"   attr="<?php contact_page_css::select_color_for_input_field('first_headline_content_font_color', 'contact_page_css'); ?>">Promenite boju</a></li>
			</ul>
		</div>
		
		<div id="context_top_menu" class="dropdown clearfix">
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px; cursor:pointer;">
			  <li><a tabindex="-1" id="top_menu_color" data-color="font_color" data-page="contact_page_css"   attr="<?php about_us::select_color_for_input_field('menu_text_color', 'about_us'); ?>">Boja slova</a></li>
			  <li><a tabindex="-1" id="top_menu_background" data-color="background_color" data-page="contact_page_css"  attr="<?php about_us::select_color_for_input_field('menu_bg_color', 'about_us'); ?>">Boja pozadine glavnog menija</a></li>
			  <li><a tabindex="-1" id="top_menu_font" data-font="text" data-page="contact_page_css">Izaberite font</a></li>
			</ul>
		</div>
		
		<div id="first_div_contact_headline_context" class="dropdown clearfix">
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px;">
				<li><a tabindex="-1" id="contact_first_div_weight" data-font="title" data-page="contact_page_css">Izmenite font naslova</a></li>
				<li><a tabindex="-1" id="contact_first_div_color" data-color="font_color" data-page="contact_page_css"   attr="<?php contact_page_css::select_color_for_input_field('first_div_headline_font_color', 'contact_page_css'); ?>">Promenite boju</a></li>
			</ul>
		</div>
		
		<div id="update_contact_info" class="dropdown clearfix">
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px;">
				<li><a id="update_address" class="remodal-bg" href="#" tabindex="-1" data-remodal-target="remodal_update_contact_info">Uredite kontakt informacije</a></li>
				<li><a tabindex="-1" id="contact_first_div_content_font_color" href="#" data-color="font_color" data-page="contact_page_css"   attr="<?php contact_page_css::select_color_for_input_field('first_div_content_font_color', 'contact_page_css'); ?>">Promenite boju teksta </a></li>
				<li><a tabindex="-1" id="contact_first_div_background_color" href="#" data-color="background_color" data-page="contact_page_css"   attr="<?php contact_page_css::select_color_for_input_field('first_div_content_background_color', 'contact_page_css'); ?>">Promenite boju pozadine </a></li>
				<li><a tabindex="-1" id="contact_first_div_content_font_weight" href="#" data-font="text" data-page="contact_page_css">Izaberite font</a></li>
				<li><a tabindex="-1" id="contact_show_hide" href="#">Prikaži / sakrij prozor za kontakt </a></li>
			</ul>
		</div>
<!-- END CONTEXT MENUES -->

		<?php include("inc/pages/boxes_for_page_contact.php"); ?><!-- Include file "boxes_for_page_contact.php" -->		

		<div id="first_div_contact_text_container" class="brand">
			<div class="text-center" id="first_div_contact_text" style="
					font-size: <?php echo contact_page_css::css('contact_page_css','first_headline_content_weight'); ?>;	
					font-family: <?php echo contact_page_css::css('contact_page_css','first_headline_content_type'); ?>;
				"><br>
				Kontakt preduzeća 
					<?php 
						$search_company_name = "SELECT * FROM users WHERE user_id = ".$base->clear_string($_SESSION['user_id']); 
						$res = user::find_this_query($search_company_name);
						foreach($res as $user_name){
							echo $user_name->name;
						}
					?>
			</div>
		</div>
			<?php $search_contact_info = "SELECT * FROM users WHERE user_id = ". $base->clear_string($_SESSION['user_id']); 
				$contact_result = user::find_this_query($search_contact_info);
				foreach($contact_result as $contact_info){
					echo "<div class='address-bar'>{$contact_info->city} | {$contact_info->address} | {$contact_info->phone}</div>";
				}
			?>
    	
    <div id="empty-div"></div>



<?php include("inc/main_menu.php"); ?><!-- Include file "main_menu.php" -->  

    <div class="container">
		<div class="box" id="all_first_div">
			<div id="first_div_contact_headline_container" >
                <div id="first_div_contact" class="col-sm-12">
                    <hr>
						<h2 id="company_location_headline" class="intro-text text-center" style="
							font-size: <?php echo contact_page_css::css('contact_page_css','first_div_headline_font_weight'); ?>;	
							font-family: <?php echo contact_page_css::css('contact_page_css','first_div_headline_font_type'); ?>;
						">
							Informacije o preduzeću, <strong>Lokacija</strong>
						</h2>
                    <hr>
                </div><!-- #first_div_contact -->
            </div><!-- #first_div_contact_container -->
				
	<?php
		global $base;
		$chack_if_exist = "SELECT * FROM contact_page WHERE user_id = ". $base->clear_string($_SESSION['user_id']);	
		$find_query = $base->select_table($chack_if_exist);
			$result = mysqli_num_rows($find_query);
			if($result > 0){
	?>
			<div class="col-xs-12  col-sm-12 col-md-12 col-lg-12">
				<!-- Include script files for google maps and jquery -->
				<script src="http://maps.google.com/maps/api/js?sensor=false"  type="text/javascript"></script>
				
				<!-- Update google maps address on marker dragg -->
					<br/><br/>
						<div id="map" class="col-xs-12 map-div" ></div><!-- Include google maps.... -->
				<!-- Next, we need to create div for load two forms. First form is form for adding new address. -->
				<!-- Second form is form for updateing location(s) in map. For this purposes, we are using dragg function of google map marks! -->
					<br/><br/>
					<div id="forms_container" class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<div id="first_form" class="col-xs-12">
							<form method="POST" class="col-xs-5" action="inc/google_maps_db.php">
								<div class="hidden">
									<?php
										$query = "SELECT * FROM contact_page WHERE user_id = ". $base->clear_string($_SESSION['user_id']);
										$search_addresses = contact::find_this_query($query);
										foreach($search_addresses as $search_address):
											
									?>
											id: <input type='text' name='id[]' value='<?php echo $search_address->contact_id; ?>' style='visibility:hidden;' />
											Latitude: <input type='text' name="latitude_value[]" id='latitude<?php echo $search_address->contact_id; ?>' value='<?php echo $search_address->latitude; ?>'/>
											Longitude: <input type='text' name="longitude_value[]" id='lognitude<?php echo $search_address->contact_id; ?>' value='<?php echo $search_address->longitude; ?>'/> <br/>	
									<?php
										endforeach;
									?>	
								</div>
								<input class="btn btn-success" id="update_map_positions" type="submit" name="update_google_maps" value="Ažurirajte pozicije na mapi" />
							</form>
						</div><!-- #first_form -->
						<!-- Insert new address -->
						<div id="second_form"  class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							<button id="press" class="btn btn-warning">Ubacite novu adresu</button>
							<div id="hide_div" class="col-xs-9">
								<form method="POST" action="inc/google_maps_db.php" >
									<div>
										<label for="autocomplete"> Puna adresa</label>
										<input  type="text" name="address" class="form-control" id="autocomplete" placeholder="Mesto, ulica i broj" >
									</div>
									
									<div id="add-new-address-textarea">
										<label for="description" >Unesite tekst koji će se prikazati klikom na marker</label>
										<textarea type="text" name="description" class="form-control" id="marker" ></textarea>
											<small>* ukoliko se ne prikazuje tačna adresa na mapi, unesite i naziv pokrajine</small> <br/>
											<small>* npr: Novi Sad, Slovačka 1, Vojvodina</small> 
									</div>
									
									<div>
										<input type="submit" class="btn btn-success" id="insert_location" name="insert_location" value="Dodajte Vašu lokaciju" />
									</div>		
								</form>
							</div>
						</div>
					</div>
				<!-- Script files for google maps markers and other functions -->	
					<script type="text/javascript">
						var locations = <?php
							$query = "SELECT * FROM contact_page WHERE user_id = ". $base->clear_string($_SESSION['user_id']);
								echo "[";
							$search_query = contact::find_this_query($query);
								foreach($search_query as $res){
									echo "['".$res->address."', ".$res->latitude.", ".$res->longitude.",".$res->contact_id.",'".$res->description."'],";
								}
								echo "]";
						?>
						
						var map = new google.maps.Map(document.getElementById('map'), {
						  zoom: 14,
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
							draggable: true
						  });

						  google.maps.event.addListener(marker, 'click', (function(marker, i) {
							return function() {
								infowindow.setContent(locations[i][4]);
								infowindow.open(map, marker);
							}
						  })(marker, i));

						  // Dragg marker into map and pick up latitude and longitude	
							google.maps.event.addListener(marker, 'dragend', function (event) {
								document.getElementById('latitude'+ this.id).value = event.latLng.lat();
								document.getElementById('lognitude'+ this.id).value = event.latLng.lng();
							});	
						}
					</script>
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
					
					<!-- Insert new address -->
										<br/><br/>
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							<button id="press" class="btn btn-warning btn-block">Ubacite novu adresu</button>
							<div id="hide_div">
								<form method="POST" action="inc/google_maps_db.php">
									<div class="col-lg-12 col-xs-12">
										<div>
											<label for="autocomplete"> Puna adresa</label>
											<input  type="text" name="address" class="form-control" id="autocomplete" placeholder="Mesto, ulica i broj" >
										</div>
										
										<div>
											<label for="marker">Unesite tekst koji će se prikazati klikom na marker</label>
											  <textarea class="form-control col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-2" id="marker" name="sender_message" rows="10" style="color:red;"></textarea>
												<small>* ukoliko se ne prikazuje tačna adresa na mapi, unesite i naziv države</small> <br/>
												<small>* npr: Novi Sad, Slovačka 1, Srbija</small> 
										</div>
										
										<div>
											<input type="submit" class="btn btn-success" id="insert_location" name="insert_location" value="Dodajte Vašu lokaciju" />
										</div>		
									</div><!-- .row -->
									</form><!-- End of Form -->
							</div><!-- #hide_div -->
						</div><!-- #second_form -->
				</div><!-- .col-lg-12 -->
	<?php
			}
	?>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pull-left" id="address_info_div" style="width:1100px;
					font-size: <?php echo contact_page_css::css('contact_page_css','first_div_content_font_weight'); ?>;	
					font-family: <?php echo contact_page_css::css('contact_page_css','first_div_content_font_type'); ?>;
				">
					<div id="address_info_div_load">
					<?php 
						$show_inforamtion = "SELECT * FROM contact_page WHERE user_id = ". $base->clear_string($_SESSION['user_id']);
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
 	 </div><!-- .container -->
		
		<div class="container" id="contact_form_container">
		  <div id="contact_form_load" >
			<?php 
			$query_show_hide = "SELECT * FROM contact_page_css WHERE user_id = ". $base->clear_string($_SESSION['user_id']);
			$find_show_hide = contact_page_css::find_this_query($query_show_hide);
			foreach($find_show_hide as $res_of_show_hide){
				if($res_of_show_hide->show_hide_second_div_contact === "0"){
				} else{
			?>
	            <div class="box" id="contact-form-message">
	                <div id="third-form-send-message">
	                    	<hr>
	                    <h2 class="intro-text text-center"><strong>Kontaktirajte nas</strong></h2>
	                    	<hr>
	                    <p class="sending-form">Ukoliko želite određene informacije, budite slobodni da nam se obratite putem ove forme. </p>
	                    <form role="form" id="send-message-form" action="inc/pages/pages_insert_info.php" method="POST">
	                        <div class="row">
	                        	<div class="hidden col-xs-12">
	                                <label>Id korisnika</label>
	                                <input type="text" name="user_id" class="form-control" value="<?php echo ( isset($_GET['user']) ? $base->clear_string($_GET['user']) : $base->clear_string($_SESSION['user_id']) ); ?>" required>
	                            </div>
	                            <div class="col-xs-12 ">
	                                <label>Ime</label>
	                                <input type="text" name="sender_name" id="sender_name" class="form-control" placeholder="Unesite Vaše ime" required>
	                            </div>
	                            <div class="col-xs-12">
	                                <br><label>E-mail</label>
	                                <input type="email" name="sender_email" id="sender_email" class="form-control" placeholder="Unesite Vašu e-mail adresu" required>
	                            </div>
	                            <div class="col-xs-12">
	                                <br><label>Broj telefona</label>
	                                <input type="tel" name="sender_phone" id="sender_phone" class="form-control" placeholder="Unesite broj telefona - nije obavezno">
	                            </div>
	                            
	                            <div class="col-xs-12">
	                                <br><label>Poruka</label>
	                                <textarea class="form-control col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-2" id="message-content" name="sender_message" rows="10"></textarea>
	                            </div>
	                            <div class="col-xs-12">
	                            	<br><input type="submit" name="submit_message" id="submit_message" value="Pošalji Poruku" class="btn btn-warning" />
	                            </div>
	                        </div><!-- .row -->
	                    </form><!-- End of Form -->
	                </div><!--  .sending-form  -->
	            </div><!-- .box -->

			<?php
					}
				}
			?>
		  </div><!-- #contact_form_load -->
		</div><!-- #contact_form_container -->
	</div>

		<?php include("inc/footer.php");?>

		
		<script src="js/plugins/color_picker/docs_for_page_contact.js"></script>
   </section>
  </div>
  </div>


</body>
</html>
