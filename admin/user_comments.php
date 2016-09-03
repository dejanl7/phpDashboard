<?php include("inc/header.php"); ?><!-- Include header -->
<?php
	if(!$session->session_status()){
		redirect("logout.php");
	}
?>
<?php 
	global $base;
	
	if( $user->active == 0 ){
		redirect('logout.php');
	}
?>
<?php 		
	if($user->role == 'master_admin' ){
		redirect('logout.php');
	}
?>
<?php
	// Update Unread Comments as Read Comments
		articles_marks::make_read_from_unread();
		
	// Take Data from User Database Table...
		$user_info = user::find_this_id($_SESSION['user_id']); 
	
	// Set Query
		$current_page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
		$number_per_page = 7;
		$total_items = articles_marks::count_number_of_all_records();
		$pagination = new pagination($current_page, $number_per_page, $total_items);
		

		$comments_query = "SELECT * FROM articles_marks WHERE user_id=".$base->clear_string($_SESSION['user_id']). " ORDER BY article_mark_id DESC LIMIT {$number_per_page} OFFSET {$pagination->offset()} ";
		$comments = articles_marks::find_this_query($comments_query);
?>
</head>
<body  class="hold-transition skin-blue sidebar-mini <?php echo ($user->left_menu_collapse== '1' ? ' sidebar-collapse' : ''); ?>" data-menustate=<?php echo ($user->left_menu_collapse== '1' ? ' collapsed' : ' not-collapsed');  ?>>
<div class="se-pre-con"></div><!-- Preloader Div -->
		
	<div class="wrapper" id='wrapper_basic_info' style="
		background: url(img/drive.jpg) no-repeat center center fixed;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover; 
		">

	<!-- INCLUDE ALL SEPARATED FILES -->
		<?php include("inc/top_menu.php");?>
		<?php include("inc/left_menu.php");?>

			<section class="row" id="headline-basic-info">
				<h1><span>Sve Slike i Fajlovi</span></h1>
			</section><!-- #headline-basic-info -->

			<section id="basic-info-main-nav">
				<?php include("inc/main_menu.php"); ?><!-- Include file "main_menu.php" -->  
			</section><!-- #basic-info-main-nav -->
	

	
		<div class="container user-comments-content">
		 <div class="row">
		  <section class="col-sm-12">
		    <div class="col-sm-12 col-xs-12 command-comments">
				<h1 class="text-center">Komentari </h1>
					<div class="count-img-files"> 
						<h4>Ukupno: 
							<?php 
								$comments_sum = articles_marks::sum_of_comments($_SESSION['user_id']);
								if( $comments_sum == '0' || $comments_sum == '1' ){
									echo $comments_sum." komentar.";
								}
									else {
										echo $comments_sum." komentara.";
									} 
							?>
						</h4>

						<ul>
							<li>Odobreni: <b><?php echo articles_marks::sum_of_approved_comments($_SESSION['user_id']); ?>.</b></li>
							<li>Neodobreni: <b><?php echo articles_marks::sum_of_disabled_comments($_SESSION['user_id']); ?>.</b></li>
						</ul>
					</div>
				<div id="command-paginate-container-comment">
				  <div class="command-paginate-loader-comment">
					<form action="inc/functions/delete.php" method="POST" id="comments-select-form">
					<div id='options_container-comments' class='col-xs-4'>
						<select class='form-control' name='comment-options'>
							<option value=''>Izaberite opciju: </option>
							<option value='delete_comments'>Obriši</option>
							<option value='approve_comments'>Odobri</option>
							<option value='disable_comments'>Zabrani</option>
						</select>
					</div><!-- .options-container -->
					<div class='col-xs-4'>
						<input type='submit' name="submit_comment_options" class='btn btn-success button_delete' value='Primeni' />
					</div>	<br/><br/><br/>
					
					<div class="table-responsive">
						<table class="table comments-table">
							<thead>
								<th class="text-center">
									<select class='form-control' name='select-comment-type' id="select-comment-type">
										<option value='remove_marks'>Ništa</option>
										<option value='type_all'>Svi</option>
										<option value='type_read'>Odobreni</option>
										<option value='type_unread'>Neodobreni</option>
									</select>
								</th>
								<th class="text-center">Ime</th>
								<th class="text-center">E-mail</th>
								<th class="text-center">Artikal</th>
								<th class="text-center">Komentar</th>
								<th class="text-center">Cena</th>
								<th class="text-center">Kvalitet</th>
								<th class="text-center">Status</th>
								<th class="text-center">Aktivnosti</th>
							</thead>
							<tbody>

								<?php foreach( $comments as $comment ): ?>
								<tr>
									<?php 
									  // Add Class "comment" if string length is higher than 177 characters
										$string = $comment->client_comment; 
										$length = strlen($string);

										$comment_length = ($length > '177') ? 'comment' :'';
										if( $comment->article_id != NULL ):
									?>	
										<td class="text-center <?php echo ( $comment->client_approve_comment == '0' ? ' unread_comments' : ''); ?>" >
											<input name="comments_id[]" class="comments_id <?php echo ( $comment->client_approve_comment == '0' ? ' unread_comment' : 'read_comment') ?>" type="checkbox" value="<?php echo $comment->article_mark_id; ?>">
										</td>
										<td class="<?php echo ( $comment->client_approve_comment == '0' ? ' unread_comments' : ''); ?>">
											<small>
												<a href="preview.php?article_id=<?php echo $comment->article_id; ?>" target="_blank">
													<?php echo $comment->client_name; ?>		
												</a>
											</small>
										</td>
										<td class="text-center <?php echo ( $comment->client_approve_comment == '0' ? ' unread_comments' : ''); ?>">
											<small>
												<?php echo $comment->client_mail; ?>
											</small>
										</td>
										<td class="text-center <?php echo ( $comment->client_approve_comment == '0' ? ' unread_comments' : ''); ?>"><?php $article_img = articles::find_this_id($comment->article_id); ?>
											<a href="preview.php?article_id=<?php echo $comment->article_id; ?>" target="_blank">
												<img src="<?php echo "img/articles_images/".$article_img->article_img; ?>" alt="">
											</a>
										</td>
										<td class="text-center <?php echo ( $comment->client_approve_comment == '0' ? ' unread_comments' : ''); ?> <?php echo $comment_length; ?>">
											<?php 
												$comment_text = ( $comment->client_comment == '' || $comment->client_comment == ' ' || $comment->client_comment == '  ' ) ? 'Bez komentara' : $comment->client_comment;
												echo $comment_text; 
											?><br><br>
											<small>
												( <?php echo major_class::date_time_format($comment->mark_time); ?>)
											</small>	
										</td>
										<td class="text-center <?php echo ( $comment->client_approve_comment == '0' ? ' unread_comments' : ''); ?>">
											<small>
												<?php echo ($comment->price_mark != 0) ? $comment->price_mark : 'bez ocene'; ?>
											</small>
										</td>
										<td class="text-center <?php echo ( $comment->client_approve_comment == '0' ? ' unread_comments' : ''); ?>">
											<small>
												<?php echo ($comment->quality_mark != 0) ? $comment->quality_mark : 'Bez ocene' ; ?>
											</small>
										</td>
										<td class="text-center <?php echo ( $comment->client_approve_comment == '0' ? ' unread_comments' : ''); ?>"><small><b>
											<?php echo $comment_status = ($comment->client_approve_comment == '0') ? 'Zabranjen' : 'Odobren'; ?>	
											</b></small>
										</td>
										<td class="text-center <?php echo ( $comment->client_approve_comment == '0' ? ' unread_comments' : ''); ?>">
											<button id='<?php echo $comment->article_mark_id ?>' data-id='<?php echo $comment->article_mark_id; ?>' data-type="approve_comment" id='<?php echo $comment->article_mark_id; ?>' class="btn submit-comment btn-success approve_comment">
												Odobri
											</button>
											<button data-id='<?php echo $comment->article_mark_id ?>' data-type="disable_comment" id='<?php echo $comment->article_mark_id; ?>' class="btn submit-comment btn-default disable_comment">
												Blokiraj
											</button>
											<button data-id='<?php echo $comment->article_mark_id; ?>' data-type="delete_comment" id='<?php echo $comment->article_mark_id; ?>' class="btn submit-comment btn-warning delete_comment">
												Obriši
											</button>
										</td>
									<?php endif; ?>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					  </div>
					</form>

				<div class="command-pagination">
					<div class="command-paginate text-center">
						<div class="command-comments-paginate-container" >
							<ul class='pagination text-center'>
							<?php 
								if($pagination->sum_of_pages() > 1){
									if($pagination->is_previous_page()){
										echo "<li><a href='user_comments.php?&page={$pagination->previous_page()}' rel= '{$pagination->previous_page()}'>&laquo</a></li>";
									}
									
										for($i=1; $i<=$pagination->sum_of_pages(); $i++){
											if($i == $pagination->current_page){
												echo "<li><a class='active btn btn-success' href='user_comments.php?page='{$i}'  rel='{$i}'>$i</a></li>"; // Show current page in pagination slider !!!
											}
												else{
													echo "<li><a href='user_comments.php?page={$i}' rel='{$i}'>$i</a></li>";
												}
										}
									
									if($pagination->is_next_page()){
										echo "<li><a href='user_comments.php?page={$pagination->next_page()}' rel='{$pagination->next_page()}'> &raquo</a></li>";
									}
									
								}							
							?>				
							</ul>
						</div><!-- .comments-paginate-container -->
					</div><!-- .paginate -->
				</div><!-- .command-pagination -->
				</div> <!-- .command-comment-paginate-loader -->
			</div><!-- .command-comment-paginate-container -->
		  </div><!-- .command-comments -->
		</section>
		</div><!-- .row -->
	</div><!-- .user-comments-content -->

		<div class="user-comments-footer">
			<?php include("inc/footer.php"); ?>
		</div><!-- .user-comments-footer -->

	</div><!-- .wrapper -->





</body>
</html>
