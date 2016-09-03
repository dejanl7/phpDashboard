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
?>

<?php 		
	$role = $user->role;
	if( $role != 'master_admin' ){
		redirect('logout.php');
	}
?>
<!-- This File Using "morris.js" plugin. Licence:

	Copyright (c) 2012-2014, Olly Smith All rights reserved.

	Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:
	Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
	Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
	THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
-->
<link rel="stylesheet" type="text/css" href="css/morris/morris.css">
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
		<?php include("inc/master_left_menu.php");?>
			
			<?php 
				$count_master_admin_users	= user::count_master_admin_users();
				$count_all_accounts 		= user::count_number_of_all_records_master_admin() - $count_master_admin_users;
					$count_online_accounts 	= user::count_online_users();
					$count_offline_users 	= $count_all_accounts - $count_online_accounts;


				$count_uploaded_images 	= uploaded_image::count_number_of_all_records_master_admin();
				$count_carousel_images 	= carousel_imgs::count_number_of_all_records_master_admin();
				$count_biography_images = biographies::count_number_of_all_records_master_admin();
				$count_article_images 	= articles::count_number_of_all_records_master_admin() + article_details_images::count_number_of_all_records_master_admin();
				$images_files_sum 		= $count_uploaded_images + $count_carousel_images + $count_biography_images + $count_article_images;
				$count_biography_files  = biographies::count_all_biography_file();

				$messages_sum 				  = messages::count_number_of_all_records_master_admin();
					$respond_messages_sum 	  = messages::count_all_answer();
					$not_respond_messages_sum = $messages_sum - $respond_messages_sum;

				$comments_sum 				= articles_marks::count_number_of_all_records_master_admin();
					$approve_comments_sum 	= articles_marks::sum_of_all_approved_comments(); 	
					$unnaprove_comments_sum = $comments_sum - $approve_comments_sum;	


				$count_phonebook_records 	= phonebook::count_number_of_all_records_master_admin();
				

			?>
		
			<section class="row" id="headline-basic-info">
				<h1><span>DIJAGRAMI AKTIVNOSTI NA MREŽI</span></h1>
			</section><!-- #headline-basic-info -->

		<div class="row">
		  <div class="col-sm-9 col-sm-offset-2 col-xs-10 col-xs-offset-1 user-info-content">
			<section class="col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1">
				<h5 class="text-left">U okviru ove stranice nalaze se svi podaci vezani za naloge svih korisnika. Grafikoni pokazuju ZBIR podataka SVIH članova. Tabela ispod grafikona pruža mogućnost blokiranja ili odobravanja naloga korisnicima.</h5>
				<div class="row">
					<div class="col-sm-4 col-xs-12 morris-barchart">
						<h1 class="text-center">Podaci o nalozima</h1>
							<div id="graph"></div>
					</div><!-- .morris-pies -->
					<div class="col-sm-4 col-xs-12 morris-barchart">
						<h1 class="text-center">Imenik (svi kontakti)</h1>
							<div id="graph-contacts"></div>
					</div><!-- .morris-pies -->
					<div class="col-sm-4 col-xs-12 morris-barchart">
						<h1 class="text-center">Aktivni/Blokirani Nalozi</h1>
							<div id="graph-accounts-blocked-available"></div>
					</div><!-- .morris-pies -->
				</div>
				<div class="row">
					<div class="col-sm-4 col-xs-12 morris-pies">
						<h1 class="text-center">Sve Slike i Fajlovi
							<small><b> (<?php echo $images_files_sum + $count_biography_files; ?>) </b></small>
						</h1>
							<div id="graph-imgs_files"></div>
					</div><!-- .morris-pies -->
					<div class="col-sm-4 col-xs-12 morris-pies">
						<h1 class="text-center">Sve Poruke
							<small><b>(<?php echo $messages_sum; ?>)</b></small>
						</h1>
							<div id="graph-message"></div>
					</div><!-- .morris-pies -->
					<div class="col-sm-4 col-xs-12 morris-pies">
						<h1 class="text-center">Komentari
								<small><b>(<?php echo $comments_sum; ?>)</b></small>
						</h1>
							<div id="graph-comment"></div>
					</div><!-- .morris-pies -->

				</div>
			</section><!-- #basic-information -->
			<section class="col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1 user_operations">
				<h1>Opcije rada sa Nalozima</h1>
				<?php 
					$current_page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
					$number_per_page = 10;
					$total_items = user::count_number_of_all_records_master_admin();
					$pagination = new pagination($current_page, $number_per_page, $total_items);
				?>
					<div class=" master-user-content">
				    <div class="col-sm-11 col-xs-12 command-users">
						<div id="command-paginate-container-users">
						  <div class="command-paginate-loader-users">
							
							<form action="inc/pages/pages_insert_info.php" method="POST" id="users-select-form">
							<div id='options_container-users' class='col-xs-4'>
								<select class='form-control' name='users-options'>
									<option value=''>Izaberite opciju: </option>
									<option value='approve_status'>Odobri</option>
									<option value='block_status'>Blokiraj</option>
								</select>
							</div><!-- .options-container -->
							<div class='col-xs-4'>
								<input type='submit' name="submit_users_options" class='btn btn-success button_delete' value='Primeni' />
							</div>	<br/><br/><br/>
							<?php 
								$query = "SELECT * FROM users WHERE role!='master_admin' ORDER BY user_id DESC LIMIT {$number_per_page} OFFSET {$pagination->offset()}";
								$users = user::find_this_query($query);
							?>
							<div class="table-responsive">
								<table class="table users-table" id="users-table">
									<thead>
										<th class="text-center">
											<select class='form-control' name='select-users-type' id="select-users-type">
												<option value=''>#</option>
												<option value='remove_marks'>Ništa</option>
												<option value='type_all'>Sve</option>
												<option value='type_read'>Odobreni</option>
												<option value='type_unread'>Neodobreni</option>
											</select>
										</th>
										<th class="text-center">Naziv</th>
										<th class="text-center">Username</th>
										<th class="text-center">E-mail</th>
										<th class="text-center">Telefon</th>
										<th class="text-center">Grad</th>
										<th class="text-center">Adresa</th>
										<th class="text-center">Aktivnosti</th>
									</thead>
									<tbody>
										<?php foreach( $users as $user ): ?>
										<tr>
											<td class="text-center <?php echo ( $user->active == '0' ? ' blocked' : ''); ?>" >
												<input name="users_id[]" class="users_id <?php echo ( $user->active == '0' ? ' blocked_user' : 'regular_user'); ?>" type="checkbox" value="<?php echo $user->user_id; ?>">
											</td>
											<td class="<?php echo ( $user->active == '0' ? ' blocked' : ''); ?>">
												<small>
													<a href="../company/company-index.php?user_id=<?php echo $user->user_id; ?>" target="_blank">
														<?php echo $user->name; ?>		
													</a>
												</small>
											</td>
											<td class="text-center <?php echo ( $user->active == '0' ? ' blocked' : ''); ?>">
												<small>
													<?php echo $user->username; ?>
												</small>
											</td>
											<td class="text-center <?php echo ( $user->active == '0' ? ' blocked' : ''); ?>">
												<small>
													<?php echo $user->email; ?>
												</small>
											</td>
											<td class="text-center <?php echo ( $user->active == '0' ? ' blocked' : ''); ?>" >
												<small>
													<?php echo $user->phone; ?>
												</small>
											</td>
											<td class="text-center <?php echo ( $user->active == '0' ? ' blocked' : ''); ?>">
												<small>
													<?php echo $user->city; ?>
												</small>
											</td>
											<td class="text-center <?php echo ( $user->active == '0' ? ' blocked' : ''); ?>">
												<small>
													<?php echo $user->address; ?>
												</small>
											</td>
											<td class="text-center <?php echo ( $user->active == '0' ? ' blocked' : ''); ?> approve_block_user_btn">
												<button class="approve-user" data-id="<?php echo $user->user_id ?>" data-type="approve_status" > Odobri </button> 
                                                <button class="block-user" data-id="<?php echo $user->user_id ?>" data-type="block_status" > Blokiraj </button>
											</td>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							  </div>
							</form>

						<div class="command-pagination">
							<div class="command-paginate text-center">
								<div class="command-users-paginate-container" >
									<ul class='pagination text-center'>
									<?php 
										if($pagination->sum_of_pages() > 1){
											if($pagination->is_previous_page()){
												echo "<li><a href='master_admin.php?&page={$pagination->previous_page()}' rel= '{$pagination->previous_page()}'>&laquo</a></li>";
											}
											
												for($i=1; $i<=$pagination->sum_of_pages(); $i++){
													if($i == $pagination->current_page){
														echo "<li><a class='active btn btn-success' href='master_admin.php?page='{$i}'  rel='{$i}'>$i</a></li>"; // Show current page in pagination slider !!!
													}
														else{
															echo "<li><a href='master_admin.php?page={$i}' rel='{$i}'>$i</a></li>";
														}
												}
											
											if($pagination->is_next_page()){
												echo "<li><a href='master_admin.php?page={$pagination->next_page()}' rel='{$pagination->next_page()}'> &raquo</a></li>";
											}
											
										}							
									?>				
									</ul>
								</div>
							</div>
						</div>
						</div>
					</div>
				</div>
			</div>
			</section>
		  </div>
		</div>
		
		<div class="master_user-info-footer">
			<?php include("inc/footer.php"); ?>
			<script src="js/plugins/morris/morris.js"></script>
			<script src="js/plugins/morris/raphael-min.js"></script>
			<script type="text/javascript">
				// Use Morris.Bar for Display Info about images and files, messages and comments 
				Morris.Bar({
				  element: 'graph',
				  data: [
				    {x: 'Ukupno', y: <?php echo $count_all_accounts; ?>},
				    {x: 'Na mreži', y: <?php echo $count_online_accounts; ?>},
				    {x: 'Van mreže', y: <?php echo $count_offline_users; ?>},
				  ],
				  xkey: 'x',
				  ykeys: ['y'],
				  labels: ['Y'],
				  barColors: function (row, series, type) {
				   	if(row.label == "Ukupno") return "#3498db";
					else if(row.label == "Na mreži") return "#f1c40f";
					else if(row.label == "Van mreže") return "#AD1D28";
				  },
				  resize: true
				});


				// Use Morris.Bar for Display Info about Contacts from phonebook
				Morris.Bar({
				  element: 'graph-contacts',
				  data: [
				    {x: 'Broj Svih Kontakata (Imenik)', y: <?php echo $count_phonebook_records; ?>}
				  ],
				  xkey: 'x',
				  ykeys: ['y'],
				  labels: ['Y'],
				  barColors: function (row, series, type) {
				   	if(row.label == "Broj Svih Kontakata (Imenik)") return "#3A539B";
				  },
				  resize: true
				});
				// Use Morris Donut for Images and Files
				Morris.Donut({
				  element: 'graph-imgs_files',
				  data: [
				    {value: <?php echo $count_uploaded_images; ?>, label: 'Slajder (Prva stranica)'},
				    {value: <?php echo $count_carousel_images; ?>, label: 'Slike ("O Nama")'},
				    {value: <?php echo $count_biography_images; ?>, label: 'Biografija'},
				    {value: <?php echo $count_article_images; ?>, label: 'Artikli'},
				    {value: <?php echo $count_biography_files; ?>, label: 'Fajlovi'}
				  ],
				  backgroundColor: '#ccc',
				  labelColor: '#000000',
				  colors: [
				    '#E87E04',
				    '#F7CA18',
				    '#BDC3C7',
				    '#663399',
				    '#F64747'
				  ],
				  formatter: function (x) { return x },
				  resize: true
				});

				// Use Morris Donut for Messages
				Morris.Donut({
				  element: 'graph-message',
				  data: [
				    {value: <?php echo $respond_messages_sum; ?>, label: 'Odgovorene'},
				    {value:  <?php echo $not_respond_messages_sum; ?>, label: 'Neodgovorene'}
				  ],
				  backgroundColor: '#cccccc',
				  labelColor: '#000000',
				  colors: [
				    '#1AB244',
				    '#AD1D28',
				  ],
				  formatter: function (x) { return x },
				  resize: true
				});

				// Use Morris Donut for Comments
				Morris.Donut({
				  element: 'graph-comment',
				  data: [
				    {value: <?php echo $approve_comments_sum; ?>, label: 'Odobreni'},
				    {value: <?php echo $unnaprove_comments_sum; ?>, label: 'Zabranjeni'}
				  ],
				  backgroundColor: '#ccc',
				  labelColor: '#000000',
				  colors: [
				    '#1AB244',
				    '#AD1D28',
				  ],
				  formatter: function (x) { return x },
				  resize: true
				});
				
				// Use Morris.Bar for Display Info about Available and Block Account
				Morris.Bar({
				  element: 'graph-accounts-blocked-available',
				  data: [
				    {x: 'Odobreni Nalozi', y: 2<?php //echo $count_all_accounts; ?>},
				    {x: 'Zabranjeni Nalozi', y: 1<?php //echo $count_online_accounts; ?>},
				  ],
				  xkey: 'x',
				  ykeys: ['y'],
				  labels: ['Y'],
				  barColors: function (row, series, type) {
				   	if(row.label == "Odobreni Nalozi") return "#3498db";
					else if(row.label == "Zabranjeni Nalozi") return "#f1c40f";
				  },
				  resize: true
				});
			</script>
		</div><!-- .basic-info-footer -->

	</div><!-- .wrapper_basic_info -->

</body>
</html>