<?php include("../admin/inc/home-files/home_header.php"); ?><!-- Include header -->
<?php 
	global $base;
	$status = user::find_this_id( $base->clear_string($_GET['user_id']) );
?>
<!--  STYLE FOR ALL PAGE -> using information from database for creating page style  -->
<style>	
	#index_headline{
		color: <?php echo index_page::css("index_page","first_headline_font_color", $base->clear_string($_GET['user_id'])); ?>;	
	}		
	#top_menu{
		background-color:<?php echo about_us::css('about_us', 'menu_bg_color', $base->clear_string($_GET['user_id'])); ?>;	
		color:<?php echo about_us::css('about_us', 'menu_text_color', $base->clear_string($_GET['user_id'])); ?>;
	}
	.change_text_color{
		color:<?php echo about_us::css('about_us', 'menu_text_color', $base->clear_string($_GET['user_id'])); ?>; 
	}
	#change_first_div_background{
		color: <?php echo index_page::css("index_page","first_div_font_color", $base->clear_string($_GET['user_id'])); ?>;	
		background-color: <?php echo index_page::css("index_page","first_div_background_color"); ?>;
	}
	#second_div{
		color: <?php echo index_page::css("index_page","second_headline_font_color", $base->clear_string($_GET['user_id'])); ?>;	
	}
	#second_div_content{
		color: <?php echo index_page::css("index_page","second_div_font_color", $base->clear_string($_GET['user_id'])); ?>;
	}
	#second_div_background{
		background-color: <?php echo index_page::css("index_page","second_div_background_color", $base->clear_string($_GET['user_id'])); ?>;	
	}
</style>  

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="se-pre-con"></div><!-- Preloader Div -->

<div class="wrapper" id='wrapper_index'>
<?php include("../admin/inc/home-files/home_top_menu.php"); ?>
<section class="bo" id="bo_index" style="
		background: url('../admin/img/background_images/<?php
			$query = "SELECT * FROM users WHERE user_id = ". $base->clear_string($_GET['user_id']);
			$find = user::find_this_query($query);
			foreach($find as $background){
				echo $background->background_img;
			}
		?>') 
		no-repeat center center fixed;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover; 
		">

		<div id="index_headline" class="brand">
			<div id="index_headline_container" class="text-center" style="
				font-size: <?php echo index_page::css("index_page", "first_headline_font_weight", $base->clear_string($_GET['user_id'])); ?>;	
				font-family: <?php echo index_page::css("index_page", "first_headline_font_type", $base->clear_string($_GET['user_id'])); ?>;
			"><br>
				<?php 
				if( isset($_SESSION['user_id']) ):
				// Check Out if phone or email are allready into Phonebook
					$phonebook 		= phonebook::show_phonebook_information();
					$phonebook_company_id = array();

					foreach( $phonebook as $key => $phonebook_info ){
						$phonebook_company_id[$key] = $phonebook_info->phonebook_company_id;
					}
						
					$company_name 	= user::find_this_id($base->clear_string($_GET['user_id']));
						echo $company_name->name;

				// Checking Out Information and Return right Value
					$check_if_inarray = ( in_array($company_name->user_id, $phonebook_company_id) ? '1' : '0' );

				else:
					$company_name 	= user::find_this_id($base->clear_string($_GET['user_id']));
						echo $company_name->name;
				endif;
					
				?>
				<?php if( isset($_SESSION['user_id']) ): ?>
					<?php if( $check_if_inarray == '0' ): ?>
						<button id="company-contact-info-for-phonebook" class="btn btn-primary" data-id="<?php echo $company_name->user_id; ?>" data-name="<?php echo $company_name->name; ?>" data-phone="<?php echo $company_name->phone; ?>" data-address="<?php echo $company_name->city.', '.$company_name->address; ?>" data-email="<?php echo $company_name->email; ?>" data-contactperson="<?php echo $company_name->contact_person; ?>" >
							Dodaj Informacije u Imenik
						</button>
					<?php else: ?>
						<button id="update-company-information-phonebook" class="btn btn-primary" data-id="<?php echo phonebook::get_phonebook_id($_GET['user_id']); ?>" data-name="<?php echo $company_name->name; ?>" data-phone="<?php echo $company_name->phone; ?>" data-address="<?php echo $company_name->city.', '.$company_name->address; ?>" data-email="<?php echo $company_name->email; ?>" data-contactperson="<?php echo $company_name->contact_person; ?>">
							Ažurirajte Podatke u Imeniku
						</button>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
			<br><br>
<?php include("../admin/inc/home-files/home_main_menu.php"); ?><!-- Include file "main_menu.php" -->   
			
<div class="container container-company">
	<div class="col-sm-12">
       <div class="row">
            <div class="box index-first-part"  id="change_first_div_background">
                <div class="col-lg-12 text-center">
                    <div id="carousel-example-generic" class="carousel slide">	
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" id="caurosel_load">
						<?php 
							$query = "SELECT * FROM carousel_imgs WHERE user_id = ".$base->clear_string($_GET['user_id']);
							$carousel_result = carousel_imgs::find_this_query($query);
							$row_counter = $base->while_loop($query);
							
							if(mysqli_num_rows($row_counter) < 1){
						?>
								<div class="item active carousel-slider">
									<img class="img-responsive" src="../admin/img/grinder.jpg"  alt="" style="width:100%; height:400px;">
								</div>
								<div class="item">
									<img class="img-responsive carousel-slider" src="../admin/img/movement.jpg" alt="" style="width:100%; height:400px;"">
								</div>
								<div class="item">
									<img class="img-responsive carousel-slider" src="../admin/img/ipad.jpg"  alt="" style="width:100%; height:400px;">
								</div> 
						<?php
							}
							else{
								foreach($carousel_result as $key => $value):
									switch($key){
									case 0:{
						?>
										<div class="item active carousel-slider">
											<img class="img-responsive" src="../admin/<?php echo $value->carousel_path(); ?>" alt="">
										</div>
						<?php 		
										break;
									}
									
									default:
						?>
									<div class="item carousel-slider">
										<img class="img-responsive" src="../admin/<?php echo $value->carousel_path(); ?>" alt="">
									</div>
						<?php
									}
								endforeach;
							}
							
						?>
						</div>	<!-- #carousel_load -->			 
				 			
					    <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                            <span class="icon-prev"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                            <span class="icon-next"></span>
                        </a>
                    
					</div><!-- #carousel-example-generic -->

                    <div id="first_div_text">
						<h1 id="first_div_container">
							<span class="brand-name" style="
								font-size: <?php echo index_page::css("index_page", "first_div_font_weight", $base->clear_string($_GET['user_id'])); ?>;	
								font-family: <?php echo index_page::css("index_page", "first_div_font_type", $base->clear_string($_GET['user_id'])); ?>;">
								<?php 
									$company_name = user::find_this_id($base->clear_string($_GET['user_id']));
									echo $company_name->name;
								?>
							</span>
						</h1>
					</div>

                </div><!-- .col-lg-12 -->
            </div><!-- .box -->
          </div><!-- .row -->
        </div><!-- .col-sm-12 -->

        <div class="row">
          <div class="col-sm-12">
            <div class="box" id="second_div_background">
                <div class="col-lg-12">	
					<div id="second_div"><b>
						<h1 class=" text-center second_div_headline" id="second_div_headline" style="
							font-size:<?php echo index_page::css('index_page','second_headline_font_weight', $base->clear_string($_GET['user_id'])); ?>; 
							font-family:<?php echo index_page::css('index_page','second_headline_font_type', $base->clear_string($_GET['user_id'])); ?> ">
							PREZENTACIJA
						</h1></b>
					</div>
					<div id="second_div_content">  
						<div id="second_div_load" class="second_div_load" style="
							font-size:<?php echo index_page::css('index_page','second_div_font_weight', $base->clear_string($_GET['user_id'])); ?>; 
							font-family:<?php echo index_page::css('index_page','second_div_font_type', $base->clear_string($_GET['user_id'])); ?>;
						">
							<?php
								$show = "SELECT * FROM index_page WHERE user_id = '{$base->clear_string($_GET['user_id'])}'";
								$show_all = index_page::find_this_query($show);
								foreach($show_all as $show_me){
									if($show_me->second_div_text == ""){
										echo "<b>Unesite kratku prezentaciju Vašeg preduzeća. To ćete učitniti desnim klikom na ovaj tekst, zatim izborom polja: \"Uredi tekst\".<br/>
												Možete izvršiti promenu boje teksta, boje pozadine i veličine teksta, klikom na odgovarajuća polja. </b>";
									}				
									else{
										echo $show_me->second_div_text;
									}
								}												
							?>
						</div>
					</div><!-- #second_div_load -->
				</div><!-- .col-lg-12 -->
            </div><!-- #second_div_background -->
          </div><!-- .col-sm-12 -->
        </div>	<!-- .row -->


    </div>
		<?php include("../admin/inc/home-files/home_footer.php"); ?>
		<script>	
			function contact_info_from_button(buttonName){		
				$(buttonName).on('click', function(){
					if( buttonName == '#company-contact-info-for-phonebook' ){
						var phonebook_data_type = 'insert';
						var id					= $(this).data('id');
					}
						else if( buttonName == '#update-company-information-phonebook' ){
							var phonebook_data_type = 'update';
							var id 					= $(this).data('id');
						}
					
					var phonebook_name 			= $(this).data('name');
					var phonebook_phone 		= $(this).data('phone');
					var phonebook_address 		= $(this).data('address');
					var phonebook_email 		= $(this).data('email');
					var phonebook_contactperson = $(this).data('contactperson');
					var phonebook_cotntacttype 	= 'pravno_lice';
						//alert(phonebook_address);
					
					$.ajax({
						url: '../admin/inc/pages/pages_insert_info.php',
						type: 'POST',
						data: { phonebook_data_type:phonebook_data_type, id:id, phonebook_name:phonebook_name, phonebook_phone:phonebook_phone, phonebook_address:phonebook_address, phonebook_email:phonebook_email, phonebook_contactperson:phonebook_contactperson, phonebook_cotntacttype:phonebook_cotntacttype },
						success: function(data){
							location.reload();
						},
						error: function(data){
							console.log('Error during to the sending request!');
						}

					});

				});
			}
				contact_info_from_button('#company-contact-info-for-phonebook');
				contact_info_from_button('#update-company-information-phonebook');
		</script>
	<br/>
</section>		
</div>

</body>
</html>
