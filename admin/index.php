<?php include("inc/header.php"); ?><!-- Include header -->
<?php
	if(!$session->session_status()){
		redirect("logout.php");
	}
?>
<?php 
	global $base;
	$status = $user->active;
	if( $status == 0 ){
		redirect('logout.php');
	}

		if($user->role == 'master_admin' ){
			redirect('logout.php');
		}

?>
<!--  STYLE FOR ALL PAGE -> using information from database for creating page style  -->
<style>	
	#index_headline{
		color: <?php echo index_page::css("index_page","first_headline_font_color"); ?>;	
	}		
	#top_menu{
		background-color:<?php echo about_us::css('about_us', 'menu_bg_color'); ?>;	
		color:<?php echo about_us::css('about_us', 'menu_text_color'); ?>;
	}
	.change_text_color{
		color:<?php echo about_us::css('about_us', 'menu_text_color'); ?>; 
	}
	#change_first_div_background{
		color: <?php echo index_page::css("index_page","first_div_font_color"); ?>;	
		background-color: <?php echo index_page::css("index_page","first_div_background_color"); ?>;
	}
	#second_div{
		color: <?php echo index_page::css("index_page","second_headline_font_color"); ?>;	
	}
	#second_div_content{
		color: <?php echo index_page::css("index_page","second_div_font_color"); ?>;
	}
	#second_div_background{
		background-color: <?php echo index_page::css("index_page","second_div_background_color"); ?>;	
	}
</style>  

</head>

<body  class="hold-transition skin-blue sidebar-mini <?php echo ($user->left_menu_collapse== '1' ? ' sidebar-collapse' : ''); ?>" data-menustate=<?php echo ($user->left_menu_collapse== '1' ? ' collapsed' : ' not-collapsed');  ?>>
<div class="se-pre-con"></div><!-- Preloader Div -->
	
<div class="wrapper" id='wrapper_index'>
<!-- INCLUDE ALL SEPARATED FILES -->
	<?php include("inc/top_menu.php");?>
	<?php include("inc/left_menu.php");?>
	
<section class="bo" id="bo_index" style="
		background: url(img/background_images/<?php
			$query = "SELECT * FROM users WHERE user_id = ". $base->clear_string($_SESSION['user_id']);
			$find = user::find_this_query($query);
			foreach($find as $background){
				echo $background->background_img;
			}
		?>) 
		no-repeat center center fixed;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover; 
		">

					
<!--  CONTEXT MENUES  -->
		<div id="body" class="dropdown clearfix">
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px;">
			  <li><a id="body_bg_image" class="remodal-bg" href="#" tabindex="-1" data-remodal-target="remodal_change_background_image">Promeni sliku pozadine</a></li>
			</ul>
		</div>
		
		<div id="index_headline_context" class="dropdown clearfix">
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px; cursor:pointer;">
			  <li><a tabindex="-1" id="index_hl_weight" data-font="headline" data-page="index_page">Izmenite font naslova</a></li>
			  <li><a tabindex="-1" id="index_hl_color" data-color="font_color" data-page="index_page" attr="<?php index_page::select_color_for_input_field('first_headline_font_color', 'index_page'); ?>">Promenite boju</a></li>
			</ul>
		</div>
		
		
		<div id="context_top_menu" class="dropdown clearfix">
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px; cursor:pointer;">
			  <li><a tabindex="-1" id="top_menu_color" data-color="font_color" data-page="index_page" attr="<?php about_us::select_color_for_input_field('menu_text_color', 'about_us'); ?>">Boja slova</a></li>
			  <li><a tabindex="-1" id="top_menu_background" data-color="background_color" data-page="index_page"  attr="<?php about_us::select_color_for_input_field('menu_bg_color', 'about_us'); ?>">Boja pozadine glavnog menija</a></li>
			  <li><a tabindex="-1" id="top_menu_font" data-font="text" data-page="index_page">Izaberite font</a></li>
			</ul>
		</div>	
		
		
		<div id="carousel_context_menu" class="dropdown clearfix">
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px;">
			  <li><a id="carousel_insert_images" class="remodal-bg" href="#" tabindex="-1" data-remodal-target="remodal_carousel_images">Ubacite slike u slajder</a></li>
			   <li><a id="carousel_delete_images" class="remodal-bg" href="#" tabindex="-1" data-remodal-target="delete_carousel_images">Obrišite slike iz slajdera</a></li>
			</ul>
		</div>
		
		
		<div id="index_first_div_context" class="dropdown clearfix">
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px; cursor:pointer;">
			  <li><a tabindex="-1" id="index_first_div_font_weight" data-font="title" data-page="index_page">Izmenite font</a></li>
			  <li><a tabindex="-1" id="index_first_div_font_color" data-color="font_color" data-page="index_page" attr="<?php index_page::select_color_for_input_field('first_div_font_color', 'index_page'); ?>">Promenite boju teksta</a></li>
			  <li><a tabindex="-1" id="index_first_div_background_color" data-color="background_color" data-page="index_page"   data-page="index_page" attr="<?php index_page::select_color_for_input_field('first_div_background_color', 'index_page'); ?>">Promenite boju pozadine</a></li>
			</ul>
		</div>
		
		<div id="context_second_div_headline" class="dropdown clearfix">
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px;">
			  <li><a tabindex="-1" id="index_second_div_font" href="#" data-font="title" data-page="index_page">Izaberite font</a></li>
			  <li><a tabindex="-1" id="index_second_div_color" href="#" data-color="font_color" data-page="index_page" attr="<?php index_page::select_color_for_input_field('second_headline_font_color', 'index_page'); ?>">Izaberite boju teksta</a></li>
			</ul>
		</div>
		
		<div id="context_second_div_content" class="dropdown clearfix">
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px;">
			  <li><a tabindex="-1" id="edit_index_second_div_content" href="#" class="remodal-bg" data-remodal-target="remodal_index_first_div">Uredi tekst</a></li>
			  <li><a tabindex="-1" id="index_second_div_content_font_weight" href="#" data-font="text" data-page="index_page">Izaberite font</a></li>
			  <li><a tabindex="-1" id="index_second_div_content_font_color" href="#" data-color="font_color" data-page="index_page" attr="<?php index_page::select_color_for_input_field('second_div_font_color', 'index_page'); ?>">Promenite boju teksta </a></li>
			  <li><a tabindex="-1" id="index_second_div_background_color" href="#" data-color="background_color" data-page="index_page"   data-page="index_page" attr="<?php index_page::select_color_for_input_field('second_div_background_color', 'index_page'); ?>">Promenite boju pozadine </a></li>
			</ul>
		</div>
		
	
<!--  END CONTEXT MENUES  -->
	

<?php include("inc/pages/boxes_for_page_index.php"); ?><!-- Include file "boxes_for_page_about.php" -->
		<div id="index_headline" class="brand">
			<div id="index_headline_container" class="text-center" style="
				font-size: <?php echo index_page::css("index_page", "first_headline_font_weight"); ?>;	
				font-family: <?php echo index_page::css("index_page", "first_headline_font_type"); ?>;
			"><br>
				<?php 
					$company_name = user::find_this_id($base->clear_string($session->user_id_session));
					echo $company_name->name;
				?>
			</div>
		</div>
			<br><br>
<?php include("inc/main_menu.php"); ?><!-- Include file "main_menu.php" -->   
			
<div class="container">

       <div class="row" id="index-first-big-part">
		 <div class="col-sm-12">
            <div class="box index-first-part"  id="change_first_div_background">
                <div class="col-lg-12 text-center">
                    <div id="carousel-example-generic" class="carousel slide">	
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" id="caurosel_load">
						<?php 
							$query = "SELECT * FROM carousel_imgs WHERE user_id = ". $base->clear_string($_SESSION['user_id']);
							$carousel_result = carousel_imgs::find_this_query($query);
							$row_counter = $base->while_loop($query);
							
							if(mysqli_num_rows($row_counter) < 1){
						?>
								<div class="item active carousel-slider">
									<img class="img-responsive" src="img/grinder.jpg"  alt="" style="width:100%; height:400px;">
								</div>
								<div class="item">
									<img class="img-responsive carousel-slider" src="img/movement.jpg" alt="" style="width:100%; height:400px;"">
								</div>
								<div class="item">
									<img class="img-responsive carousel-slider" src="img/ipad.jpg"  alt="" style="width:100%; height:400px;">
								</div> 
						<?php
							}
							else{
								foreach($carousel_result as $key => $value):
									switch($key){
									case 0:{
						?>
										<div class="item active carousel-slider">
											<img class="img-responsive" src="<?php echo $value->carousel_path(); ?>" alt="">
										</div>
						<?php 		
										break;
									}
									
									default:
						?>
									<div class="item carousel-slider">
										<img class="img-responsive" src="<?php echo $value->carousel_path(); ?>" alt="">
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
								font-size: <?php echo index_page::css("index_page", "first_div_font_weight"); ?>;	
								font-family: <?php echo index_page::css("index_page", "first_div_font_type"); ?>;">
								<?php 
									$company_name = user::find_this_id($base->clear_string($session->user_id_session));
									echo $company_name->name;
								?>
							</span>
						</h1>
					</div>

                </div><!-- .col-lg-12 -->
            </div><!-- .box -->
          </div> <!-- col-sm-12 -->
        </div><!-- .row -->

          <div class="row index-second-part">
           <div class="col-sm-12">
            <div class="box"  id="second_div_background">
                <div class="col-lg-12">	
					<div id="second_div"><b>
						<h1 class=" text-center second_div_headline" id="second_div_headline" style="
							font-size:<?php echo index_page::css('index_page','second_headline_font_weight'); ?>; 
							font-family:<?php echo index_page::css('index_page','second_headline_font_type'); ?> ">
							PREZENTACIJA
						</h1></b>
					</div>
					<div id="second_div_content">  
						<div id="second_div_load" class="second_div_load" style="
							font-size:<?php echo index_page::css('index_page','second_div_font_weight'); ?>; 
							font-family:<?php echo index_page::css('index_page','second_div_font_type'); ?>;
						">
							<?php
								$show = "SELECT * FROM index_page WHERE user_id = ". $base->clear_string($session->user_id_session);
								$show_all = index_page::find_this_query($show);


								foreach($show_all as $show_me){
									if($show_me->second_div_text == ""){
										echo "<b>Unesite kratku prezentaciju Vašeg preduzeća. To ćete učitniti desnim klikom na ovaj tekst, zatim izborom polja: \"Uredi tekst\".<br/>
												Možete izvršiti promenu boje teksta, boje pozadine i veličine teksta, klikom na odgovarajuća polja. </b>";

												echo $show_me -> index_id;
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
        </div><!-- .row -->


    </div>
	<?php include("inc/footer.php"); ?>
	<br/>
</section>		
</div>

	<script src="js/plugins/color_picker/docs_for_page_index.js"></script>


 </body>
</html>
