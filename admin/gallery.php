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
		#gallery_headline{
			color: <?php echo gallery_page::css("gallery_page","gallery_headline_font_color"); ?>;	
		}		
		
		#top_menu{
			background-color:<?php echo about_us::css('about_us', 'menu_bg_color'); ?>;	
			color:<?php echo about_us::css('about_us', 'menu_text_color'); ?>;
		}
		.change_text_color{
			color:<?php echo about_us::css('about_us', 'menu_text_color'); ?>; 
		}
		#ocarousel_slider{
			background-color: <?php echo gallery_page::css("gallery_page","gallery_carousel_background_color"); ?>;	
		}
		#carousel_container{
			color: <?php echo gallery_page::css("gallery_page","gallery_carousel_font_color"); ?>;	
		}
		#mainDiv_headline{
			color: <?php echo gallery_page::css("gallery_page","gallery_first_div_font_color"); ?>;
		}
		#text_offer{
			color: <?php echo gallery_page::css("gallery_page","gallery_first_div_content_font_color"); ?>
		}		
		#div_all_content{
			background-color: <?php echo gallery_page::css("gallery_page","gallery_first_div_background_color"); ?>
		}
	</style>  

</head>
<body  class="hold-transition skin-blue sidebar-mini <?php echo ($user->left_menu_collapse== '1' ? ' sidebar-collapse' : ''); ?>" data-menustate=<?php echo ($user->left_menu_collapse== '1' ? ' collapsed' : ' not-collapsed');  ?>>
<div class="se-pre-con"></div><!-- Preloader Div -->
	

<div class="wrapper" id='wrapper_gallery'>
<!-- INCLUDE ALL SEPARATED FILES -->
	<?php include("inc/top_menu.php"); ?>
	<?php include("inc/left_menu.php"); ?>	

	
<section class="bo" id="bo_gallery" style="
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

<!-- CONTEXT MENUES -->
		<div id="body" class="dropdown clearfix">
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px;">
			  <li><a id="body_bg_image" class="remodal-bg" href="#" tabindex="-1" data-remodal-target="remodal_change_background_image">Promeni sliku pozadine</a></li>
			</ul>
		</div>
		
		<div id="gallery_headline_context" class="dropdown clearfix">
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px; cursor:pointer;">
			  <li><a tabindex="-1" id="gallery_hl_weight" data-font="headline" data-page="gallery_page">Izaberite font naslova</a></li>
			  <li><a tabindex="-1" id="gallery_hl_color" data-color="font_color" data-page="gallery_page"  attr="<?php gallery_page::select_color_for_input_field('gallery_headline_font_color', 'gallery_page'); ?>">Izaberite boju</a></li>
			</ul>
		</div>
		
		<div id="gallery_carousel_context" class="dropdown clearfix">
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px; cursor:pointer;">
			  <li><a tabindex="-1" id="gallery_carousel_weight" data-font="title" data-page="gallery_page">Izaberite font naslova</a></li>
			  <li><a tabindex="-1" id="gallery_carousel_color" data-color="font_color" data-page="gallery_page"  attr="<?php gallery_page::select_color_for_input_field('gallery_carousel_font_color', 'gallery_page'); ?>">Izaberite boju teksta</a></li>
			  <li><a tabindex="-1" id="gallery_carousel_text_color" data-color="background_color" data-page="gallery_page"  attr="<?php gallery_page::select_color_for_input_field('gallery_carousel_background_color', 'gallery_page'); ?>">Izaberite boju pozadine</a></li>
			</ul>
		</div>
		
		<div id="gallery_mainDiv_headline" class="dropdown clearfix">
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px; cursor:pointer;">
			  <li><a tabindex="-1" id="gallery_mainDiv_weight" data-font="title" data-page="gallery_page">Izaberite font</a></li>
			  <li><a tabindex="-1" id="gallery_mainDiv_color" data-color="font_color" data-page="gallery_page" attr="<?php gallery_page::select_color_for_input_field('gallery_first_div_font_color', 'gallery_page'); ?>">Izaberite boju teksta</a></li>
			</ul>
		</div>
		
		
		<div id="context_top_menu" class="dropdown clearfix">
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px; cursor:pointer;">
			  <li><a tabindex="-1" id="top_menu_color" data-color="font_color" data-page="gallery_page"  attr="<?php about_us::select_color_for_input_field('menu_text_color', 'about_us'); ?>">Boja slova</a></li>
			  <li><a tabindex="-1" id="top_menu_background" data-color="background_color" data-page="gallery_page"  attr="<?php about_us::select_color_for_input_field('menu_bg_color', 'about_us'); ?>">Boja pozadine glavnog menija</a></li>
			  <li><a tabindex="-1" id="top_menu_font" data-font="title" data-page="gallery_page">Izaberite font</a></li>
			</ul>
		</div>	
		
		<div id="context_div_manipulation" class="dropdown clearfix">
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px;">
			  <li><a tabindex="-1" id="add_product_content" href="#" class="remodal-bg" data-remodal-target="remodal_gallery_add_product">Dodaj proizvod (uslugu)</a></li>
			  <li><a tabindex="-1" id="delete_product_content" href="#" class="remodal-bg" data-remodal-target="remodal_gallery_delete_product">Obriši proizvode (usluge)</a></li>
			  <li><a tabindex="-1" id="gallery_main_div_weight" data-font="text" data-page="gallery_page">Izaberite font</a></li>
			  <li><a tabindex="-1" id="gallery_main_div_fontColor" href="#" data-color="font_color" data-page="gallery_page"  class="remodal-bg" attr="<?php gallery_page::select_color_for_input_field('gallery_first_div_content_font_color', 'gallery_page'); ?>">Izaberite boju teksta </a></li>
			  <li><a tabindex="-1" id="gallery_main_div_backgroundColor" href="#" class="remodal-bg" data-color="background_color" data-page="gallery_page"  attr="<?php gallery_page::select_color_for_input_field('gallery_first_div_background_color', 'gallery_page'); ?>">Izaberite boju pozadine</a></li>
			</ul>
		</div>
		
		<div id="edit_product_info" class="dropdown clearfix">
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px;">
			  <li><a tabindex="-1" id="edit_product_service" href="#" class="remodal-bg" data-remodal-target="remodal_edit_product">Uredi ovu stavku</a></li>
			  <li><a tabindex="-1" id="delete_product_service" href="#" >Obriši ovu stavku</a></li>
			</ul>
		</div>
		
<!-- END CONTEXT MENUES-->
	<?php include("inc/pages/boxes_for_page_gallery.php"); ?><!-- Include file "boxes_for_page_about.php" -->
	
		<div id="gallery_headline" class="brand">
			<div id="gallery_headline_container" class="text-center" style="
				font-size: <?php echo gallery_page::css("gallery_page", "gallery_headline_font_weight"); ?>;	
				font-family: <?php echo gallery_page::css("gallery_page", "gallery_headline_font_type"); ?>;
			"><br>
				PROIZVODI I USLUGE
			</div>
		</div>
		
			<br/><br/>
			
<?php include("inc/main_menu.php"); ?><!-- Include file "main_menu.php" -->   
    <div class="container" id="all_page" style="min-height: 650px;">
        <div class="col-sm-12" id="all">
            <div class="box row" id="div_all_content">
                <div class="main">
				  <div class="content" id="content">
						<div class="content_top" id="ocarousel_slider">
							<div class="wrap" id="carousel_container">
							   <span id="assortment" style="
									font-size: <?php echo gallery_page::css("gallery_page", "gallery_carousel_font_weight"); ?>;	
									font-family: <?php echo gallery_page::css("gallery_page", "gallery_carousel_font_type"); ?>;	
							   "> Najnovije iz asortimana</span>
							</div><!-- #carousel_container -->
							
						    <div class="new-carousel-products">
						      <div class="container-fluid">
						        <div class="row">
						          <div class="col-xs-11 col-xs-offset-1">
						            <div id="owl-demo-new-products" class="owl-carousel"> 
						            	<?php 
											$search_new_articles = "SELECT * FROM articles WHERE user_id = ". $base->clear_string($_SESSION['user_id']) ." ORDER BY article_uploaded_time DESC LIMIT 10";
											$find_new_articles = articles::find_this_query($search_new_articles);
												foreach($find_new_articles as $new_articles): ?>
													<div class="item article-slider">
														<a href="preview.php?article_id=<?php echo $new_articles->article_id; ?>" title="<?php echo $new_articles->article_name; ?>">
															<img width="120" height="70" src="img/articles_images/<?php echo $new_articles->article_img; ?>" alt="">
															<p><?php echo $new_articles->article_name; ?></p>
														</a>
													</div>
											<?php endforeach; ?> 	
						            </div><!-- .owl-carousel -->
						          </div><!-- .span12 -->
						        </div><!-- .row -->
						      </div><!-- .container-fluid -->
						  	</div><!-- #demo -->	
					    </div><!-- .content_top -->
						
						<br>
								<h2 id="mainDiv_headline">
									<span id="assortment-mainDiv" style="
										font-size: <?php echo gallery_page::css("gallery_page", "gallery_first_div_font_weight"); ?>;	
										font-family: <?php echo gallery_page::css("gallery_page", "gallery_first_div_font_type"); ?>;
									"> Naš  asortiman </span>
								</h2>
								

						<div id="text_offer">
								<span id="span_into_text" style="
									font-size: <?php echo gallery_page::css("gallery_page", "gallery_first_div_content_font_weight"); ?>;	
									font-family: <?php echo gallery_page::css("gallery_page", "gallery_first_div_content_font_type"); ?>;	
								">Iz ponude izdvajamo sledeće:
								</span>
						</div>

					<div class="col-sm-12" id="gallery_container">
					  <div id="gallery_loader" class="col-sm-12">
						<div class="pull-left"> <!-- DIV - involve all except pagination part -->				
					<!-- Remain code + PAGINATION -->		
							<?php 
								global $base;
								$current_page = !empty($_GET['page']) ? (int)$base->clear_string($_GET['page']) : 1;
								$number_per_page = 8;
								$total_items = articles::count_number_of_records();

								$pagination = new pagination($current_page, $number_per_page, $total_items);
								$search = "SELECT * FROM articles WHERE user_id = ". $base->clear_string($_SESSION['user_id']). " LIMIT {$number_per_page} OFFSET {$pagination->offset()}";
								$find_all = articles::find_this_query($search);
								foreach($find_all as $article):
							?>
								<div class="thumbnail pull-left gallery_images" id="<?php echo $article->article_id; ?>">
									 <h2><a href="preview.php?article_id=<?php echo $article->article_id; ?>"><?php echo $article->article_name; ?></a></h2>
										<a href="preview.php?article_id=<?php echo $article->article_id; ?>"><img src="<?php 
											if($article->article_img == ''){
												echo 'img/product.jpg';
											}
											else{
												echo $article->article_image_path(); 
											}
											
											?>" alt="<?php echo $article->article_name; ?>" style='width:200px; height:120px;' />
										</a><br/>
									  <div class="price-details">
										<div class="price-number">
											<span class="rupees"><?php echo number_format("{$article->article_price}",2,",","."); ?> <?php echo $article->valute; ?></span>
										</div>
												<div class="add-cart">								
													<h4><a href="preview.php?article_id=<?php echo $article->article_id; ?>">Informacije</a></h4>
												</div>
											<div class="clear"></div>
									  </div><!-- .price-details -->				 
								</div><!-- .gallery_images -->
							<?php 
								endforeach;
							?>	
						</div> <!-- END OF DIV FOR DEPART pagination from article divs -->
								<!-- SET UP OF PAGINATION AT THE END OF ASORTMENT -->
								<div id="clear_div"></div>
								<div class="row" id="pagination">
									<ul class="pagination" >
										<?php
											if($pagination->sum_of_pages() > 1){
												if($pagination->is_previous_page()){
													echo "<li><a href='gallery.php?page={$pagination->previous_page()}' rel= '{$pagination->previous_page()}'>&laquo</a></li>";
												}
												
													for($i=1; $i<=$pagination->sum_of_pages(); $i++){
														if($i == $pagination->current_page){
															echo "<li><a class='active btn btn-success' href='gallery.php?page={$i}' rel='{$i}'>$i</a></li>"; // Show current page in pagination slider !!!
														}
															else{
																echo "<li><a href='gallery.php?page={$i}' rel='{$i}'>$i</a></li>";
															}
													}
												
												if($pagination->is_next_page()){
													echo "<li><a href='gallery.php?page={$pagination->next_page()}' rel='{$pagination->next_page()}'> &raquo</a></li>";
												}							
											}		
										?>
									</ul>
								</div><!-- .row -->
						
					  </div><!-- .gallery_loader -->
					</div><!-- #gallery_container -->


	  			  </div><!-- #content -->
	  			</div><!-- .main -->
    		</div><!-- #div_all_content -->
    	</div><!-- #all -->
    </div><!-- #all_page -->

<!-- Include JavaScript Files from footer and Specific File for ColorPIcker AND OTHER PLGUINS... -->
    <?php include("inc/footer.php");?>
		<script type="text/javascript" src="js/plugins/gallery_plugin/easing.js"></script>
		<script src="js/plugins/color_picker/docs_for_page_gallery.js"></script>
</section>
</div><!-- #wrapper -->

</body>
</html>
