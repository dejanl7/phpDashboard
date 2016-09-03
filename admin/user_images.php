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
	
<?php 
	/*=============================
		Count Records 
	===============================*/
	// Count Files Number into Databasae
		$count_biography_files = biographies::count_biography_file();

	// Count Images Number 
		$count_uploaded_images = uploaded_image::count_number_of_records();
		$count_carousel_images = carousel_imgs::count_number_of_records();
		$count_biography_images = biographies::count_number_of_records();
		$count_article_images = articles::count_number_of_records() + article_details_images::count_number_of_records();

		$sum = $count_uploaded_images + $count_carousel_images + $count_biography_images + $count_article_images;
		
?>
	
		<div class="container user-images-content">
		  <div class="row">
			<?php 
				global $base;
				$current_page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
				$number_per_page = 7;
				$total_items = $sum+$count_biography_files;

				$pagination = new pagination($current_page, $number_per_page, $total_items);

				$query_uploaded = "SELECT * FROM business_network_images_files WHERE user_id = '{$_SESSION['user_id']}' LIMIT {$number_per_page} OFFSET {$pagination->offset()}";
				$img_files = images_files_view::find_this_query($query_uploaded);

			?>
			<section class="col-sm-12 command-images">
				<div class="col-sm-12 col-xs-12 all_box_page">
					<h1 class="text-center">Slike - Opcije </h1>
					<div class="count-img-files"> 
						<h4>Ukupno: </h4>
						<ul>
							<li>Slike: <b><?php echo $sum; ?>.</b></li>
							<li>Fajlovi: <b><?php echo $count_biography_files; ?>.</b></li>
						</ul>
					</div>

					<div id="command-paginate-container">
					  <div class="command-paginate-loader">
						<form action="inc/functions/delete.php" method="POST" id="images-files-delete-form">
							<div id='options_container-delete-user-images' class='col-xs-4'>
								<select class='form-control' name='images-files-delete-option'>
									<option value=''>Izaberite opciju: </option>
									<option value='delete_images_files'>Obriši</option>
								</select>
							</div><!-- .options-container -->
							<div class='col-xs-4'>
								<input type='submit' class = 'btn btn-success button_delete' value='Primeni' />
							</div>	<br/><br/><br/>
							<div class="table-responsive">
								<table class="table user-images-table">
									<thead>
										<th class="text-center"><input type='checkbox' class='command_SelectAllImages' /></th>
										<th class="text-center">Naziv</th>
										<th class="text-center">Slika</th>
										<th class="text-center">Datum</th>
										<th class="text-center">Tip</th>
										<th class="text-center">Obriši</th>
									</thead>
									<tbody>
									<?php 	
										foreach($img_files as $key => $element ):
											if( $element->type == 'informacije' ){
												$img_src = 'img/uploaded_images';
												$anchor = 'about.php';
											}
											if( $element->type == 'slajder' ){
												$img_src = 'img/carousel_images';
												$anchor = 'index.php';
											}
											if( $element->type == 'biografija' ){
												$img_src = 'img/biography_images';
												$anchor = 'about.php';
											}
											if( $element->type == 'artikli' ){
												$img_src = 'img/articles_images';
												$anchor = 'galery.php';
											}
											if( $element->type == 'fajlovi' ){
												$img_src = 'img/file.jpg';
												$file_src = 'files/biography_files';
												$anchor = 'about.php';
											}							
									?>
										<tr>
											<?php if( !empty($element->image_name) ): ?>

												<td class="text-center">
													<input name="images_files_id[]" id="images_files_id" class="images_files" type="checkbox" value="<?php echo $element->image_file_id.", ". $element->db_table.", ".$element->type; ?>">
												</td>
												<td><?php echo major_class::show_img_name_without_id($element->image_name); ?></td>
												<td class="text-center">
													<?php 
														if( $element->type != 'fajlovi' ): ?>
															<a href="<?php echo $img_src."/".$element->image_name; ?>" target="_blank">
																<img src="<?php echo $img_src; ?>/<?php echo $element->image_name; ?>" alt="slike">
															</a>
														<?php else:	?>
																<a href="<?php echo $file_src."/".$element->image_name; ?>" target="_blank">
																	<img src="<?php echo $img_src; ?>" alt="fajlovi">
																</a>
														<?php 
															endif; ?>
													
												</td>
												<td class="text-center"><small><?php echo major_class::date_time_format($element->uploaded_time); ?></small></td>
												<td class="text-center"><a href="<?php echo $anchor; ?>"><?php echo $element->type; ?></a></td>
												<td class="text-center">
													<button class="btn btn-warning delete_file_imgs" id="<?php echo $element->image_file_id; ?>" data-table="<?php echo $element->db_table; ?>" data-type="<?php echo $element->type; ?>">Obriši</button>
												</td>
											<?php endif; ?>
										</tr>
									<?php
										endforeach;

									?>

									</tbody>
								</table>
							</div>
						</form>
						<div class="paginate text-center">
							<ul class='pagination text-center'>
							<?php 
								if($pagination->sum_of_pages() > 1){
									if($pagination->is_previous_page()){
										echo "<li><a href='user_images.php?page={$pagination->previous_page()}' rel= '{$pagination->previous_page()}'>&laquo</a></li>";
									}
									
										for($i=1; $i<=$pagination->sum_of_pages(); $i++){
											if($i == $pagination->current_page){
												echo "<li><a class='active btn btn-success' href='user_images.php?page={$i}' rel='{$i}'>$i</a></li>"; // Show current page in pagination slider !!!
											}
												else{
													echo "<li><a href='user_images.php?page={$i}' rel='{$i}'>$i</a></li>";
												}
										}
									
									if($pagination->is_next_page()){
										echo "<li><a href='user_images.php?page={$pagination->next_page()}' rel='{$pagination->next_page()}'> &raquo</a></li>";
									}
									
								}							
							?>				
							</ul>
						</div><!-- .paginate -->
					  </div><!-- .command-paginate-loader -->
					</div><!-- .command-paginate-container -->
				

				</div><!-- .col-xs-12 -->
			</section>
		  </div><!-- .all_box_page -->
		</div><!-- .user-images-content -->

		<div class="user-images-footer">
			<?php include("inc/footer.php"); ?>
		</div><!-- .user-images-footer -->

	</div><!-- .wrapper -->





</body>
</html>
