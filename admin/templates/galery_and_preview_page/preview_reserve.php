<div class="main">
	<div class="wrap" id="whole_preview_page">
	 	<div class="preview-page">

	 	  <div class="section group" id="whole_div">
			<div class="cont-desc span_1_of_2" id="whole_div_preview">
				
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
					<div class=" article-desc">Opis proizvoda i specifikacije</div>
				</div>
			    
			    <div class="container product-details" id="preview_info_div">	
				  <div class="grid images_3_of_2">
					<ul id="etalage">
						<li class="col-lg-12 col-md-12 col-sm-11 col-xs-11">
							<img class="etalage_thumb_image" src="img/articles_images/<?php 
									$etalage_first_img = $base->clear_string($_GET['article_id']);
									$result_of_search = articles::find_this_id($etalage_first_img);
									echo $result_of_search->article_img;
								?>" />
							<img class="etalage_source_image" src="img/articles_images/<?php 
									$etalage_first_img = $base->clear_string($_GET['article_id']);
									$result_of_search = articles::find_this_id($etalage_first_img);
									echo $result_of_search->article_img;
								?>" title="" />
					
						</li>
					<?php 
						$img_id = $base->clear_string($_GET['article_id']);
						$find_all_images_for_this_article = "SELECT * FROM article_details_images WHERE article_id='{$img_id}'";
						$result_of_search = article_details_images::find_this_query($find_all_images_for_this_article);
						foreach($result_of_search as $result):
					?>
					
						<li>
							<img class="etalage_thumb_image" src="img/articles_images/<?php echo $result->article_img_name; ?> " />
							<img class="etalage_source_image" src="img/articles_images/<?php echo $result->article_img_name; ?> "   title="" />
						</li>
						
					<?php  endforeach; ?>
					</ul><!-- #etalage -->
			      </div><!-- .images_3_of_2 -->
			
			<div class="col-lg-11 col-md-5 col-sm-8 col-xs-2 desc span_3_of_2">
			<?php 
				$id = $base->clear_string($_GET['article_id']);
				$find_all_info = "SELECT * FROM articles WHERE article_id='{$id}'";
				$result_info = articles::find_this_query($find_all_info);
				foreach($result_info as $each_result):
			
			?>
					<p>Naziv:</p>
					<h2><?php echo $each_result->article_name; ?></h2><br/>
				
					<p>Cena:</p><h2><?php echo number_format("{$each_result->article_price}",2,",",".")." ".$each_result->valute; ?></h2>
				
				<br/>
				<div class="product-details">
					    <span>Model:</span> &nbsp; <h2><?php
								$article_id = $base->clear_string($_GET['article_id']);
								$search_informations = "SELECT * FROM article_details WHERE article_id = '{$article_id}'";
								$result_of_query = article_details::find_this_query($search_informations);
								foreach($result_of_query as $take_result){
									echo $take_result->article_model;
								}
							?></h2>
					<br/><br/>
					<div class="col-xs-11 rating-xs" id="rating_container" >	
						<div id="rating_for_showing">
							<?php
								$show_hide_content_marks = "SELECT * FROM preview_page WHERE user_id = ". $base->clear_string($_SESSION['user_id']);
								$content_query = preview_page::find_this_query($show_hide_content_marks);
								foreach($content_query as $yes_or_no){
									$show_or_hide = $yes_or_no->preview_content_show_hide;
									if($show_or_hide == "1"){
								?>
									<ul class="col-xs-12 rating-system">
										<li><input value="<?php echo articles_marks::average_marks($base->clear_string($_GET['article_id'])); ?>" type="number" class="rating" min=0 max=5  data-size="sm" disabled />
											<div><?php echo number_format(articles_marks::number_of_user($base->clear_string($_GET['article_id']))); ?> korisnik(a) je ocenilo ovaj artikal.</div></li>
									</ul>
							<?php
								}
							}
							?>
					    </div><!-- #rating_for_showing -->
					</div><!-- #rating_container -->
				</div><!-- .product-details -->
			<?php endforeach; ?>
			</div><!-- .desc span_3_of_2 -->
			<div class="clear"></div>
	  	</div><!-- .preview-page -->
	
	<div class="product_desc">	
		<div id="horizontalTab">
			<ul class="resp-tabs-list" id="show_hide_marks_possibility_container">
			  <div id="show_hide_marks_possibility">	

			   <?php 
					$show_hide_specification_marks = "SELECT * FROM preview_page WHERE user_id = ". $base->clear_string($_SESSION['user_id']);
					$content_specification_query = preview_page::find_this_query($show_hide_specification_marks);
					foreach($content_specification_query as $solution){
						$info = $solution->preview_specifications_show_hide;
						if($info == 0){
			   ?>
						<li>Specifikacije</li>
						
						<div class="clear"></div>
			   <?php
						}
						else{
			   ?>
					   <li class="tabs-title">Specifikacije</li>
					   <li class="tabs-title">Ocenite artikal</li>
						<div class="clear"></div>
			   <?php 
						}
					}
			   ?>
			  </div>
			</ul>
			<div class="resp-tabs-container">
			  <div id="edit_article_container" rel="<?php echo $base->clear_string($_GET['article_id']); ?>">
				<div id="edit_article_info" class="product-specifications" style="
					font-size: <?php echo preview_page::css('preview_page',"preview_specifications_font_weight"); ?>;	
					font-family: <?php echo preview_page::css('preview_page',"preview_specifications_font_type"); ?>;
				
				">
					<?php 
						$search_article_specifications = "SELECT * FROM article_details WHERE article_id = ". $base->clear_string($_GET['article_id']);
						$article_description = article_details::find_this_query($search_article_specifications);
						foreach($article_description as $specifications){
							echo $specifications->article_specifications;
						}
					?>
			 	</div>
			  </div>
			<div class="review">
				<?php 
					$client_ip =  getenv('HTTP_CLIENT_IP') ? : getenv('HTTP_X_FORWARDED_FOR') ? : getenv('HTTP_X_FORWARDED') ? : getenv('HTTP_FORWARDED_FOR') ? : getenv('HTTP_FORWARDED') ? : getenv('REMOTE_ADDR');  
					$marks = articles_marks::block_double_mark( $base->clear_string($_GET['article_id']), $client_ip );
					$visibility = ($marks >= 1) ? 'hidden' : 'form-group';
				?>
				<div class="check-client-ip" attr="<?php echo $marks; ?>"></div>

				<h2>Ocenite ovaj artikal</h2>						
				<div class="your-review"><br/>
					<form method="POST" id="preview_marks_comment_form" action="inc/pages/pages_insert_info.php">
						<div class="form-group hidden" >
					    	<p><label>User Id<span class="red">*</span></label></p>
					    	<input type="text" class="form-control" name="user_id" value="<?php echo $base->clear_string($_SESSION['user_id']); ?>" required>
					    </div>
						<div class="form-group hidden" >
					    	<p><label>Id artikla<span class="red">*</span></label></p>
					    	<input type="text" class="form-control" name="article_id" value="<?php echo $base->clear_string($_GET['article_id']); ?>" required>
					    </div>
				    	<div class="form-group">
					    	<p><label>Vaše ime<span class="red">*</span></label></p>
					    	<input type="text" class="form-control" name="name_of_user" placeholder="Ime" required>
					    </div>
						<div class="form-group">
					    	<p><label>Vaše E-mail<span class="red">*</span></label></p>
					    	<input type="email" class="form-control" name="email_of_user" placeholder="E-mail" required>
					    </div>
						<div class="<?php echo $visibility;?>">
							<span><label>Cena:</label></span>
								<fieldset id='demo1' class="simple_rating">
									<input class="stars" type="radio" name="star_mark_price[]" id="star5" value="5" />
									<label class = "full" for="star5" title="Awesome - 5 stars"></label>
									<input class="stars" type="radio" name="star_mark_price[]" id="star4" value="4" />
									<label class = "full" for="star4" title="Pretty good - 4 stars"></label>
									<input class="stars" type="radio" name="star_mark_price[]" id="star3" value="3" />
									<label class = "full" for="star3" title="Meh - 3 stars"></label>
									<input class="stars" type="radio" name="star_mark_price[]" id="star2" value="2" />
									<label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
									<input class="stars" type="radio" name="star_mark_price[]" id="star1" value="1" />
									<label class = "full" for="star1" title="Sucks big time - 1 star"></label>	
								</fieldset>				
						</div><br/><br/>
						<div class="<?php echo $visibility; ?>"> 
							<span><label>Kvalitet:</label></span>
								<fieldset id='demo1' class="simple_rating">
									<input class="stars" type="radio" name="star_mark_quality[]" id="star5a" value="5" />
									<label class = "full" for="star5a" title="Awesome - 5 stars"></label>
									<input class="stars" type="radio" name="star_mark_quality[]" id="star4a" value="4" />
									<label class = "full" for="star4a" title="Pretty good - 4 stars"></label>
									<input class="stars" type="radio" name="star_mark_quality[]" id="star3a" value="3" />
									<label class = "full" for="star3a" title="Meh - 3 stars"></label>
									<input class="stars" type="radio" name="star_mark_quality[]" id="star2a" value="2" />
									<label class = "full" for="star2a" title="Kinda bad - 2 stars"></label>
									<input class="stars" type="radio" name="star_mark_quality[]" id="star1a" value="1" />
									<label class = "full" for="star1a" title="Sucks big time - 1 star"></label>	
								</fieldset>				
						</div>
					    <div><br/><br/>
					    	<span><label>Komentar <span class="red">*</span></label></span>
					    	<span><textarea id="comment_article" name="comment_article"> </textarea></span>
					    </div><br/><br/>
						<div>
					   		<span><input type="submit" id="submit_mark_comment_form" value="Oceni"></span>
						</div>
				    </form>
				</div>	
			</div>
		  </div>
	    </div><!-- #horizontalTab -->
		
		
		<?php 
			$query = preview_page::show_hide_comment();
			$comments_info = articles_marks::check_comment_exists($base->clear_string($_GET['article_id']));



			$current_page = !empty($_GET['page']) ? (int)$base->clear_string($_GET['page']) : 1;
			$number_per_page = 5;
			$total_items = articles_marks::count_article_records($base->clear_string($_GET['article_id']));
			$pagination = new pagination($current_page, $number_per_page, $total_items);


			$comments_query = "SELECT * FROM articles_marks WHERE user_id=".$base->clear_string($_SESSION['user_id'])." AND article_id=". $base->clear_string($_GET['article_id']). " AND client_comment!='' AND client_approve_comment='1'  ORDER BY article_mark_id DESC LIMIT {$number_per_page} OFFSET {$pagination->offset()}";
			$comments = articles_marks::find_this_query($comments_query);

			// Hide or Show Whole Comments Part 
			$show_hide_comment = ($query->preview_comment_show_hide == 0) ? "class='hidden'" : "class='comments_div'";

		?>
		<div id="comments_div" <?php echo $show_hide_comment; ?> >
			<div class="big-comment-div">
			  <div class="comments-container">
				<div class="col-sm-12 col-xs-12 comments">
					<div id="comments_container">
						<div class="text-center" id="comments_headline" style="
							font-size: <?php echo preview_page::css('preview_page',"preview_commentsHeadline_font_weight"); ?>;	
							font-family: <?php echo preview_page::css('preview_page',"preview_commentsHeadline_font_type"); ?>;
						">
							Komentari
						</div>
					</div><!-- #comments-container -->
					
					<?php if( !empty($comments) ): ?>
						<?php foreach( $comments as $key => $comment ): ?>
								<?php $comment_visibility = ($comment->client_approve_comment == 1) ? 'visible' : 'hidden'; ?>
								<div class="col-sm-12 col-xs-12 comments-div" style="visibility: <?php echo $comment_visibility; ?>;">
									<span><?php echo $comment->client_name; ?> 
										<small>&nbsp(<?php echo articles_marks::date_time_format($comment->mark_time); ?>)</small>
									</span>
									
									<div id="comment-content-container">
										<div id="comment-content" class="comment-content" style="
											font-size: <?php echo preview_page::css('preview_page',"preview_commentsContent_font_weight"); ?>;	
											font-family: <?php echo preview_page::css('preview_page',"preview_commentsContent_font_type"); ?>;">
											<?php echo $comment->client_comment; ?>
										</div><!-- .comment-content -->
									</div><!-- .comment-content-container -->

								</div><!-- .comments-div -->
						<?php endforeach; ?>
					<?php else: ?>
							<div class="hidden comments-div"></div><!-- .comments-div -->
					<?php endif; ?>

				</div><!-- .comments -->

				<div class="paginate text-center">
					<div class="comments-paginate-container" >
						<ul class='pagination text-center' data-article-id = "<?php echo $base->clear_string($_GET['article_id']); ?>">
						<?php 
							if($pagination->sum_of_pages() > 1){
								if($pagination->is_previous_page()){
									echo "<li><a href='preview.php?article_id=".$base->clear_string($_GET['article_id'])."&page={$pagination->previous_page()}' rel= '{$pagination->previous_page()}'>&laquo</a></li>";
								}
								
									for($i=1; $i<=$pagination->sum_of_pages(); $i++){
										if($i == $pagination->current_page){
											echo "<li><a class='active btn btn-success' href='preview.php?article_id=".$base->clear_string($_GET['article_id']). "&page='{$i}'  rel='{$i}'>$i</a></li>"; // Show current page in pagination slider !!!
										}
											else{
												echo "<li><a href='preview.php?article_id=".$base->clear_string($_GET['article_id'])."&page={$i}' rel='{$i}'>$i</a></li>";
											}
									}
								
								if($pagination->is_next_page()){
									echo "<li><a href='preview.php?article_id=".$base->clear_string($_GET['article_id'])."&page={$pagination->next_page()}' rel='{$pagination->next_page()}'> &raquo</a></li>";
								}
								
							}							
						?>				
						</ul>
					</div><!-- .comments-paginate-container -->
				</div><!-- .paginate -->
			  </div><!-- .comments-containe -->
			</div><!-- .big-comments-div -->
		</div><!-- .comments-div -->


    </div><!-- .product_desc -->
  </div>
	<div class="row rightsidebar span_3_of_1 sidebar" id="rightsidebar">
		<div id="article-sidebar"><a href="galery.php">Novo iz asortimana</a></div>
		<ul class="row popular-products">
		<?php 
			$search_new_articles = "SELECT * FROM articles WHERE user_id = ". $base->clear_string($_SESSION['user_id']) ." ORDER BY article_uploaded_time DESC LIMIT 3";
			$find_new_articles = articles::find_this_query($search_new_articles);
				foreach($find_new_articles as $new_articles): 
		?>
			<li class="border-info">
				<h2>	
					<a class="label" href="preview.php?article_id=<?php echo $new_articles->article_id; ?>">
						<?php echo $new_articles->article_name; ?>
					</a>
				</h2>
				<a href="preview.php?article_id=<?php echo $new_articles->article_id; ?>">
					<img src="img/articles_images/<?php echo $new_articles->article_img; ?>" alt="" />
				</a>
				  	<div class="price-details">
				        <div class="price-number">
							<p><span class="rupees"><?php echo number_format("{$new_articles->article_price}",2,",","."); ?> <?php echo $new_articles->valute; ?> </span></p>
					    </div>
					       		<div class="add-cart">								
									<h4><a href="preview.php?article_id=<?php echo $new_articles->article_id; ?>">Informacije</a></h4>
							     </div>
						<div class="clear"></div>
					</div>					 
			</li>
		<?php
				endforeach;
		?>
	    </ul><!-- .popular-products -->        
    </div><!-- #rightsidebar -->
</div>
</div>
</div>

</div><!-- .main -->