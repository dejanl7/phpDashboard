<?php include("../admin/inc/home-files/home_header.php"); ?><!-- Include header -->
<?php 
	global $base;
	$status = user::find_this_id($base->clear_string($_GET['user_id']));
?>
<!-- STYLE FOR ALL PAGE -> using information from database for creating page style -->
<style>	
	#headline{
		color: <?php echo about_us::css('about_us',"headline_font_color", $base->clear_string($_GET['user_id'])); ?>;	
	}		
	#top_menu{
		background-color:<?php echo about_us::css('about_us','menu_bg_color', $base->clear_string($_GET['user_id'])); ?>;	
		color:<?php echo about_us::css('about_us','menu_text_color', $base->clear_string($_GET['user_id'])); ?>;
	}
	.change_text_color{
		color:<?php echo about_us::css('about_us','menu_text_color', $base->clear_string($_GET['user_id'])); ?>; 
	}
	#info_head{
		color:<?php echo about_us::css('about_us','business_info_color', $base->clear_string($_GET['user_id'])); ?>;
	}
	#box_business_info{
		background-color:<?php echo about_us::css('about_us','business_info_content_bgcolor', $base->clear_string($_GET['user_id'])); ?>;
		color:<?php echo about_us::css('about_us','business_info_content_color', $base->clear_string($_GET['user_id'])); ?>;
	}
	#headline2{
		color:<?php echo about_us::css('about_us','our_team_headline_fontcolor', $base->clear_string($_GET['user_id'])); ?>;	
	}
	#our_team_container{
		background-color:<?php echo about_us::css('about_us','our_team_div_bg_color', $base->clear_string($_GET['user_id'])); ?>;
	}
	#our_team_container_for_font_color{
		color:<?php echo about_us::css('about_us','our_team_div_text_color', $base->clear_string($_GET['user_id'])); ?>;
	}
</style> 

</head>
<body  class="hold-transition skin-blue sidebar-mini">
<div class="se-pre-con"></div><!-- Preloader Div -->
<div class="wrapper" id='wrapper_about'>
<?php include("../admin/inc/home-files/home_top_menu.php"); ?>
	
<section class="bo" id="bo_about" style="
		background: url(../admin/img/background_images/<?php
			$query = "SELECT * FROM users WHERE user_id = ". $base->clear_string($_GET['user_id']);
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

	<div id="headline" class="brand">
		<div id="headline_container" class="text-center" style="
			font-size: <?php echo about_us::css('about_us',"headline_font_weight", $base->clear_string($_GET['user_id'])); ?>;	
			font-family: <?php echo about_us::css('about_us',"headline_font_type", $base->clear_string($_GET['user_id'])); ?>;
		"><br>
			O NAMA 
		</div>
	</div>
			<br/><br/>
			
			
<?php include("../admin/inc/home-files/home_main_menu.php"); ?><!-- Include file "main_menu.php" -->   
			
<div class="container container-company"  style="min-height: 700px;">
    <div class="col-sm-12" id="about_first_big_box">
        <div class="box row" id="box_business_info">
            <div class="col-lg-12" id="info_head">
                <div class="intro-text text-center" id="headlineBI" style="
						font-size:<?php echo about_us::css('about_us','business_info_weight', $base->clear_string($_GET['user_id'])); ?>; 
						font-family:<?php echo about_us::css('about_us','business_info_type', $base->clear_string($_GET['user_id'])); ?>; 
					">
					Informacije o <strong>poslovanju</strong>
				</div><!-- #headlineBI -->
            </div><!-- #info_head -->
			
            <div class="col-lg-12">
				
				<div id="image_container">
					<div id="hide_img" class="img img-responsive pull-left">
					<?php
						$clean_user_id = $base->clear_string($_GET['user_id']);
						$show_img = "SELECT * FROM about_us WHERE user_id = '{$clean_user_id}'";
						$show_all_dimension = about_us::find_this_query($show_img);
						foreach($show_all_dimension as $show_partial_info):
						/*==================================================================================
							Now, we set condition left image is on (inserted 1 in database) - show it.
							In other case, left image will not be shown!
						====================================================================================*/
							if($show_partial_info->business_info_leftImg == "1"){
					?>
							<img class="left_image img img-responsive" width="<?php echo $show_partial_info->image_width; ?>px" height="<?php echo $show_partial_info->image_height; ?>px" align="left" src="../admin/
								<?php
									$show_imgs = new uploaded_image();
									$clean_user_id = $base->clear_string($_GET['user_id']);
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
										echo "../admin/img/unilink.jpg";
									}
								?> " alt="slika..." />	
					<?php 
							} 
						endforeach; 
					?>
					</div><!-- #hide_img -->
				</div><!-- #image_conainer -->
				
				<div id="business_info_base" style="text-align:justify;" align="left">
					<div id = "bi_base_container" style="
						font-size:<?php echo about_us::css('about_us','business_info_content_weight', $base->clear_string($_GET['user_id'])); ?>; 
						font-family:<?php echo about_us::css('about_us','business_info_content_type', $base->clear_string($_GET['user_id'])); ?>;
					">
					<?php
						if(isset($_POST['sub_our_team'])){
							echo $show_hide_our_team = $_POST['our_time_visible'];
						}
							$show = "SELECT * FROM about_us WHERE user_id = '{$base->clear_string($_GET['user_id'])}'";
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
	$show_img = "SELECT * FROM about_us WHERE user_id = ". $base->clear_string($_GET['user_id']);
	$show_our_team_part = about_us::find_this_query($show_img);
	foreach($show_our_team_part as $show_our_team){
		if($show_our_team->our_team_show_div != "0"){		
			include("../admin/inc/home-files/home_our_team_show.php"); // "NAŠ TIM" PART
		}
			else{ ?>
					<?php include("../admin/inc/home-files/home_our_team_hide.php"); // "NAŠ TIM" PART ?>
			<?php
			} 
	}
?>
	
</div>
	<?php include("../admin/inc/home-files/home_footer.php"); ?>
</section><!-- #bo_about -->		
</div><!-- #wrapper -->




</body>
</html>
