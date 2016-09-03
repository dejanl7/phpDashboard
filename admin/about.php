<?php include("inc/header.php"); ?><!-- Include header -->
<?php
	if(!$session->session_status()){
		redirect("logout.php");
	}
?>
<?php 
	global $base;
	$status = user::find_this_id($base->clear_string($_SESSION['user_id']));
	if( $status->active == 0 ){
		redirect('logout.php');
	}

	if($user->role == 'master_admin' ){
		redirect('logout.php');
	}

?>
<link href="css/jquery-ui.css" rel="stylesheet" ><!-- jQuery for Change Image Dimenzions -->

<!-- STYLE FOR ALL PAGE -> using information from database for creating page style -->
<style>	
	#headline{
		color: <?php echo about_us::css('about_us',"headline_font_color"); ?>;	
	}		
	#top_menu{
		background-color:<?php echo about_us::css('about_us','menu_bg_color'); ?>;	
		color:<?php echo about_us::css('about_us','menu_text_color'); ?>;
	}
	.change_text_color{
		color:<?php echo about_us::css('about_us','menu_text_color'); ?>; 
	}
	#info_head{
		color:<?php echo about_us::css('about_us','business_info_color'); ?>;
	}
	#box_business_info{
		background-color:<?php echo about_us::css('about_us','business_info_content_bgcolor'); ?>;
		color:<?php echo about_us::css('about_us','business_info_content_color'); ?>;
	}
	#headline2{
		color:<?php echo about_us::css('about_us','our_team_headline_fontcolor'); ?>;	
	}
	#our_team_container{
		background-color:<?php echo about_us::css('about_us','our_team_div_bg_color'); ?>;
	}
	#our_team_container_for_font_color{
		color:<?php echo about_us::css('about_us','our_team_div_text_color'); ?>;
	}
</style> 

</head>
<body  class="hold-transition skin-blue sidebar-mini <?php echo ($user->left_menu_collapse== '1' ? ' sidebar-collapse' : ''); ?>" data-menustate=<?php echo ($user->left_menu_collapse== '1' ? ' collapsed' : ' not-collapsed');  ?>>
<div class="se-pre-con"></div><!-- Preloader Div -->

<div class="wrapper" id='wrapper_about'>
<!---INCLUDE ALL SEPARATED FILES -->
	<?php include("inc/top_menu.php");?>
	<?php include("inc/left_menu.php");?>
	
	<section class="bo" id="bo_about" style="
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

		<div id="headline_context" class="dropdown clearfix">
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px; cursor:pointer;">
			  <li><a tabindex="-1" id="hl_weight" data-font="headline" data-page="about_us">Izmenite font naslova</a></li>
			  <li><a tabindex="-1" id="hl_color" data-color="font_color" data-page="about_us" attr="<?php about_us::select_color_for_input_field('headline_font_color', 'about_us'); ?>">Promenite boju</a></li>
			</ul>
		</div>

		<div id="context_top_menu" class="dropdown clearfix">
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px; cursor:pointer;">
			  <li><a tabindex="-1" id="top_menu_color" data-color="font_color" data-page="about_us"  attr="<?php about_us::select_color_for_input_field('menu_text_color', 'about_us'); ?>">Boja slova</a></li>
			  <li><a tabindex="-1" id="top_menu_background" data-color="background_color"  data-page="about_us" attr="<?php about_us::select_color_for_input_field('menu_bg_color', 'about_us'); ?>">Boja pozadine glavnog menija</a></li>
			  <li><a tabindex="-1" id="top_menu_font" data-page="about_us">Izaberite font</a></li>
			</ul>
		</div>	
		
		<div id="context_businesInfo_headline" class="dropdown clearfix">
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px; cursor:pointer;">
			  <li><a tabindex="-1" id="business_headline_weight" data-font="title" data-page="about_us">Promenite font</a></li>
			  <li><a tabindex="-1" id="business_headline_color" data-color="font_color" data-page="about_us"  attr="<?php about_us::select_color_for_input_field('business_info_color', 'about_us'); ?>">Promenite boju</a></li>
			</ul>
		</div>
		
		<div id="context_business_info" class="dropdown clearfix">
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px;">
			  <li><a tabindex="-1" id="edit_text" class="remodal-bg" href="#" data-remodal-target="remodal_businessInfo">Uredi tekst</a></li>
			  <li><a tabindex="-1" id="business_info_weight" href="#" data-font="text" data-page="about_us">Izaberite font</a></li>
			  <li><a tabindex="-1" id="business_info_color" data-color="font_color" data-page="about_us"  href="#" attr="<?php about_us::select_color_for_input_field('business_info_content_color', 'about_us'); ?>">Izaberite boju teksta</a></li>
			  <li><a tabindex="-1" id="business_info_BgColor" data-color="background_color"  data-page="about_us" href="#" attr="<?php about_us::select_color_for_input_field('business_info_content_bgcolor', 'about_us'); ?>">Izaberite boju pozadine</a></li>
			  <li class="divider"></li>
			  <li><a tabindex="-1" id="radio_button" href="#">Prikaži sliku</a></li>
			  <li><a tabindex="-1" id="turn_on_off" href="#">Prikaz dela "NAŠ TIM" </a></li>
			</ul>
		</div>
		
		<div id="image_context_menu" class="dropdown clearfix">
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px;">
			  <li><a id="business_info_left_image_dimension" href="#" tabindex="-1">Promeni dimenzije</a></li>
			  <li><a id="business_info_left_image_change" class="remodal-bg" href="#" tabindex="-1" data-remodal-target="remodal_change_image">Promeni sliku</a></li>
			</ul>
		</div>
		
		<div id="our_team_headline_context_menu" class="dropdown clearfix">
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px; cursor:pointer;">
			  <li><a tabindex="-1" id="our_team_headline_weight" data-font="title" data-page="about_us">Promenite font</a></li>
			  <li><a tabindex="-1" id="our_team_headline_color" data-color="font_color" data-page="about_us"  attr="<?php about_us::select_color_for_input_field('our_team_headline_fontcolor', 'about_us'); ?>">Promenite boju</a></li>
			</ul>
		</div>
		
		<div id="our_team_context_menu" class="dropdown clearfix">
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px;">
			  <li><a tabindex="-1" id="edit_our_team" href="#" class="remodal-bg" data-remodal-target="remodal_teamInfo">Uredi opis</a></li>
			  <li><a tabindex="-1" id="our_team_info_weight" href="#" data-font="text" data-page="about_us">Izaberite font</a></li>
			  <li><a tabindex="-1" id="our_team_divContent_color" data-color="font_color" data-page="about_us" data-font="text"  href="#" attr="<?php about_us::select_color_for_input_field('our_team_div_text_color', 'about_us'); ?>">Promenite boju teksta </a></li>
			  <li><a tabindex="-1" id="our_team_background_color" data-color="background_color"  data-page="about_us" href="#" attr="<?php about_us::select_color_for_input_field('our_team_div_bg_color', 'about_us'); ?>">Promenite boju pozadine </a></li>
				<li class="divider"></li>
			  <li><a tabindex="-1" id="show_hideImg" href="#">Prikaz slika sa biografijom</a></li> 
			  <li><a tabindex="-1" id="biography" href="#" class="remodal-bg" data-remodal-target="add_biography">Dodaj člana</a></li> 
			</ul>
		</div>
		
		<div id="our_team_biography_context_menu" class="dropdown clearfix">
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px; cursor:pointer;">
			  <li><a tabindex="-1" id="change_biography_image" href="#" class="remodal-bg" data-remodal-target="remodal_change_biography_image">Uredi biografiju</a></li>
			  <li><a tabindex="-1" class="delete_link" id="delete_biography">Obrišite člana</a></li>
			</ul>
		</div>
		
<!-- END CONTEXT MENIES -->
	

<?php include("inc/pages/boxes_for_page_about.php"); ?><!-- Include file "boxes_for_page_about.php" -->
		<div id="headline" class="brand">
			<div id="headline_container" class="text-center" style="
				font-size: <?php echo about_us::css('about_us',"headline_font_weight"); ?>;	
				font-family: <?php echo about_us::css('about_us',"headline_font_type"); ?>;
			"><br>
				O NAMA 
			</div>
		</div>
			<br/><br/>
			
<?php include("inc/main_menu.php"); ?><!-- Include file "main_menu.php" -->   
			
<div class="container" style="min-height: 650px;">
        <div class="col-sm-12" id="about_first_big_box">
            <div class="box row" id="box_business_info">
                <div class="col-lg-12" id="info_head">
                    <div class="intro-text text-center" id="headlineBI" style="
							font-size:<?php echo about_us::css('about_us','business_info_weight'); ?>; 
							font-family:<?php echo about_us::css('about_us','business_info_type'); ?>; 
						">
						Informacije o <strong>poslovanju</strong>
					</div><!-- #headlineBI -->
                </div><!-- #info_head -->
				
                <div class="col-lg-12">
					
					<div id="image_container">
						<div id="hide_img" class="img img-responsive pull-left">
						<?php
							$clean_user_id = $base->clear_string($session->user_id_session);
							$show_img = "SELECT * FROM about_us WHERE user_id = '{$clean_user_id}'";
							$show_all_dimension = about_us::find_this_query($show_img);
							foreach($show_all_dimension as $show_partial_info):
							/*==================================================================================
								Now, we set condition left image is on (inserted 1 in database) - show it.
								In other case, left image will not be shown!
							====================================================================================*/
								if($show_partial_info->business_info_leftImg == "1"){
						?>
								<img class="left_image img img-responsive" width="<?php echo $show_partial_info->image_width; ?>px" height="<?php echo $show_partial_info->image_height; ?>px" align="left" src="
									<?php
										$show_imgs = new uploaded_image();
										$clean_user_id = $base->clear_string($_SESSION['user_id']);
										$query = "SELECT * FROM uploaded_images WHERE user_id = '{$clean_user_id}' AND uploaded_img_name = '{$show_partial_info->business_info_left_image_name}' ";
										$imgs = uploaded_image::find_this_query($query);
										if($show_partial_info->business_info_left_image_name != ""){
											foreach($imgs as $img){
												if($img){
													echo $img->image_path();
												}												
											}
										}
										else{
											echo "img/unilink.jpg";
										}
									?> " alt="slika..." />	
							<?php } endforeach; ?>
						</div><!-- #hide_img -->
					</div><!-- #image_conainer -->
					
					<div id="business_info_base" style="text-align:justify;" align="left">
						<div id = "bi_base_container" style="
							font-size:<?php echo about_us::css('about_us','business_info_content_weight'); ?>; 
							font-family:<?php echo about_us::css('about_us','business_info_content_type'); ?>;
						">
						<?php
							if(isset($_POST['sub_our_team'])){
								echo $show_hide_our_team = $_POST['our_time_visible'];
							}
								$show = "SELECT * FROM about_us WHERE user_id = '{$session->user_id_session}'";
								$show_all = about_us::find_this_query($show);
								foreach($show_all as $show_me){
									if($show_me->business_info_text == ""){
										echo "&nbspUbacite tekst u vezan za Vaše poslovanje  u deo \"Informacije o poslovanju\". To ćete izvršiti tako što ćete pritisnuti desni klik miša na površini koja obuhvata ovaj TEKST, 
										zatim izabrati opciju <b>\"Uredi informacije o poslovanju\"</b>. Takođe, ukoliko želite da uredite boju i vrstu fonta, izabraćete opcije: <b>\"Izaberite font\"</b> ili <b>\"Izaberite boju teksta\"</b>.
										Opcija <b>\"Izaberite boju pozadine\"</b> odnosi se na boju pozadine dela stranice koji obuhvata Inforamcije o poslovanju. Klikom na dato polje, možete izabrati boju koju želite. 
										Poslednja, izdvojena opcija je <b>\"Želim / ne želim sliku sa leve strane\"</b>. Ukoliko želite da ukinete prikaz slike sa leve strane, označite polje \"Sakrij\". 
										Ukoliko želite da promenite sliku, pritisnite desni klik na sliku, i izaberite opciju <b>\"Promeni sliku\"</b>.";		
									}
									else{
										echo "<br>".$show_me->business_info_text;
									}
								}
						?>
						</div><!-- #bi_base_container -->
					</div><!-- #business_info_base -->
                </div><!-- .col-lg-12 -->

            </div><!-- .box_business_info -->
        </div><!-- .row -->

<?php
	$show_img = "SELECT * FROM about_us WHERE user_id = ". $base->clear_string($session->user_id_session);
	$show_our_team_part = about_us::find_this_query($show_img);
	foreach($show_our_team_part as $show_our_team){
		if($show_our_team->our_team_show_div != "0"){		
			include("templates/about_php/our_team_show.php"); // "NAŠ TIM" PART
		}
			else{ ?>
					<?php include("templates/about_php/our_team_hide.php"); // "NAŠ TIM" PART ?>
			<?php
			} 
	}
?>
	
</div>
	<?php include("inc/footer.php"); ?>
	<script src="js/plugins/color_picker/docs_for_page_about.js"></script>

	
</section><!-- #bo_about -->		
</div><!-- #wrapper -->




</body>
</html>
