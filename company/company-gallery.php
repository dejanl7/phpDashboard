<?php include("../admin/inc/home-files/home_header.php"); ?><!-- Include header -->
<?php 
	global $base;
	$status = user::find_this_id( $base->clear_string($_GET['user_id']) );
?>
<!-- STYLE FOR ALL PAGE -> using information from database for creating page style -->
	<style>	
		#gallery_headline{
			color: <?php echo gallery_page::css("gallery_page","gallery_headline_font_color", $base->clear_string($_GET['user_id'])); ?>;	
		}		
		
		#top_menu{
			background-color:<?php echo about_us::css('about_us', 'menu_bg_color', $base->clear_string($_GET['user_id'])); ?>;	
			color:<?php echo about_us::css('about_us', 'menu_text_color', $base->clear_string($_GET['user_id'])); ?>;
		}
		.change_text_color{
			color:<?php echo about_us::css('about_us', 'menu_text_color', $base->clear_string($_GET['user_id'])); ?>; 
		}
		#ocarousel_slider{
			background-color: <?php echo gallery_page::css("gallery_page","gallery_carousel_background_color", $base->clear_string($_GET['user_id'])); ?>;	
		}
		#carousel_container{
			color: <?php echo gallery_page::css("gallery_page","gallery_carousel_font_color", $base->clear_string($_GET['user_id'])); ?>;	
		}
		#mainDiv_headline{
			color: <?php echo gallery_page::css("gallery_page","gallery_first_div_font_color", $base->clear_string($_GET['user_id'])); ?>;
		}
		#text_offer{
			color: <?php echo gallery_page::css("gallery_page","gallery_first_div_content_font_color", $base->clear_string($_GET['user_id'])); ?>
		}		
		#div_all_content{
			background-color: <?php echo gallery_page::css("gallery_page","gallery_first_div_background_color", $base->clear_string($_GET['user_id'])); ?>
		}
	</style>  

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="se-pre-con"></div><!-- Preloader Div -->

<div class="wrapper" id='wrapper_gallery'>
<?php include("../admin/inc/home-files/home_top_menu.php"); ?>
		
<section class="bo" id="bo_gallery" style="
		background: url(../admin/img/background_images/<?php
			$query = "SELECT * FROM users WHERE user_id = ". $base->clear_string($_GET['user_id']);
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
<?php include("../admin/inc/home-files/home_top_menu.php"); ?>
	
	<div id="gallery_headline" class="brand">
		<div id="gallery_headline_container" class="text-center" style="
			font-size: <?php echo gallery_page::css("gallery_page", "gallery_headline_font_weight", $base->clear_string($_GET['user_id'])); ?>;	
			font-family: <?php echo gallery_page::css("gallery_page", "gallery_headline_font_type", $base->clear_string($_GET['user_id'])); ?>;
		"><br>
			PROIZVODI I USLUGE
		</div>
	</div>
			<br/><br/>
			
<?php include("../admin/inc/home-files/home_main_menu.php"); ?><!-- Include file "main_menu.php" --> 
    <div class="container container-company" id="all_page"  style="min-height: 700px;" >
        <div class="col-sm-12" id="all">
            <div class="box row" id="div_all_content">
                <div class="main">
				  <div class="content" id="content">
						<div class="content_top" id="ocarousel_slider">
							<div class="wrap" id="carousel_container">
							   <span id="assortment" style="
									font-size: <?php echo gallery_page::css("gallery_page", "gallery_carousel_font_weight", $base->clear_string($_GET['user_id'])); ?>;	
									font-family: <?php echo gallery_page::css("gallery_page", "gallery_carousel_font_type", $base->clear_string($_GET['user_id'])); ?>;	
							   "> Najnovije iz asortimana</span>
							</div><!-- #carousel_container -->
							
 							<div class="new-carousel-products">
						      <div class="container-fluid">
						        <div class="row">
						          <div class="col-xs-11 col-xs-offset-1">
						            <div id="owl-demo-new-products" class="owl-carousel"> 
							          	<?php 
											$search_new_articles = "SELECT * FROM articles WHERE user_id = ". $base->clear_string($_GET['user_id']). " ORDER BY article_uploaded_time DESC LIMIT 10";
											$find_new_articles = articles::find_this_query($search_new_articles);
												foreach($find_new_articles as $new_articles): 
										?>
									      		<div class="item article-slider">
									      			<a href="company-preview.php?user_id=<?php echo $base->clear_string($_GET['user_id']); ?>&article_id=<?php echo $new_articles->article_id; ?>" title="<?php echo $new_articles->article_name; ?>">
									      				<img width="120" height="90" src="../admin/img/articles_images/<?php echo $new_articles->article_img; ?> " alt="">  
									      				<p><?php echo $new_articles->article_name; ?></p>  
									      			</a>
									      		</div>
									      			
							           	<?php endforeach; ?>
							        </div>
						          </div><!-- .span12 -->
						        </div><!-- .row -->
						      </div><!-- .container-fluid -->
						  	</div><!-- #demo -->	

					    </div><!-- .content_top -->
						<br><br>
						
								<h2 id="mainDiv_headline">
									<span id="assortment-mainDiv" style="
										font-size: <?php echo gallery_page::css("gallery_page", "gallery_first_div_font_weight", $base->clear_string($_GET['user_id'])); ?>;	
										font-family: <?php echo gallery_page::css("gallery_page", "gallery_first_div_font_type", $base->clear_string($_GET['user_id'])); ?>;
									"> Naš  asortiman </span>
								</h2>
								

						<div id="text_offer">
								<span id="span_into_text" style="
									font-size: <?php echo gallery_page::css("gallery_page", "gallery_first_div_content_font_weight", $base->clear_string($_GET['user_id'])); ?>;	
									font-family: <?php echo gallery_page::css("gallery_page", "gallery_first_div_content_font_type", $base->clear_string($_GET['user_id'])); ?>;	
								">Iz ponude izdvajamo sledeće:
								</span>
						</div>

					<div class="col-sm-12" id="gallery_container">
					  <div id="gallery_loader" class="col-sm-12" >
						<div class="pull-left"> <!-- DIV - involve all except pagination part -->				
					<!-- Remain code + PAGINATION -->		
							<?php 
								global $base;
								$current_page = !empty($_GET['page']) ? (int)$base->clear_string($_GET['page']) : 1;
								$number_per_page = 8;
								$total_items = articles::count_number_of_records($base->clear_string($_GET['user_id']));

								$pagination = new pagination($current_page, $number_per_page, $total_items);
								$search = "SELECT * FROM articles WHERE user_id = ". $base->clear_string($_GET['user_id']). " LIMIT {$number_per_page} OFFSET {$pagination->offset()}";
								$find_all = articles::find_this_query($search);
								foreach($find_all as $article):
							?>
								<div class="thumbnail pull-left gallery_images" id="<?php echo $article->article_id; ?>">
									 <h2><a href="company-preview.php?user_id=<?php echo $base->clear_string($_GET['user_id']); ?>&article_id=<?php echo $article->article_id; ?>"><?php echo $article->article_name; ?></a></h2>
										<a href="company-preview.php?user_id=<?php echo $base->clear_string($_GET['user_id']); ?>&article_id=<?php echo $article->article_id; ?>"><img src="<?php 
											if($article->article_img == ''){
												echo '../admin/img/product.jpg';
											}
											else{
												echo '../admin/'.$article->article_image_path(); 
											}
											
											?>" alt="<?php echo $article->article_name; ?>" style='width:200px; height:120px;' />
										</a><br/>
									  <div class="price-details">
										<div class="price-number">
											<span class="rupees"><?php echo number_format("{$article->article_price}",2,",","."); ?> <?php echo $article->valute; ?></span>
										</div>
												<div class="add-cart">								
													<h4><a href="company-preview.php?article_id=<?php echo $article->article_id; ?>">Informacije</a></h4>
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
									<ul class="pagination" data-userid="<?php echo $base->clear_string($_GET['user_id']); ?>">
										<?php
											if($pagination->sum_of_pages() > 1){
												if($pagination->is_previous_page()){
													echo "<li><a href='company-gallery.php?user_id={$base->clear_string($_GET['user_id'])}&page={$pagination->previous_page()}' rel= '{$pagination->previous_page()}'>&laquo</a></li>";
												}
												
													for($i=1; $i<=$pagination->sum_of_pages(); $i++){
														if($i == $pagination->current_page){
															echo "<li><a class='active btn btn-success' href='company-gallery.php?user_id={$base->clear_string($_GET['user_id'])}&page={$i}' rel='{$i}'>$i</a></li>"; // Show current page in pagination slider !!!
														}
															else{
																echo "<li><a href='company-gallery.php?user_id={$base->clear_string($_GET['user_id'])}&page={$i}' rel='{$i}'>$i</a></li>";
															}
													}
												
												if($pagination->is_next_page()){
													echo "<li><a href='company-gallery.php?user_id={$base->clear_string($_GET['user_id'])}&page={$pagination->next_page()}' rel='{$pagination->next_page()}'> &raquo</a></li>";
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
	<?php include("../admin/inc/home-files/home_footer.php"); ?>
	<script src="../admin/js/plugins/owl-carousel/owl.carousel.js"></script>
	<script>
		$("#owl-demo-new-products").owlCarousel({
		    autoPlay: 5000,
		    navigation : false,
		    items: 5,
		    paginationSpeed : 1000,
		    mouseDrag: true,
		    responsiveRefreshRate: true
	  	});
	</script>
</section>
</div><!-- #wrapper -->

</body>
</html>
