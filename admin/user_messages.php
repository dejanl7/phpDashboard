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
	$current_page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
	$number_per_page = 7;
	$total_items = messages::sum_of_all_messages($_SESSION['user_id']);
	$pagination = new pagination($current_page, $number_per_page, $total_items);
	$messages_query = "SELECT * FROM messages WHERE user_id=".$base->clear_string($_SESSION['user_id']). " AND message_answer='' ORDER BY message_id DESC LIMIT {$number_per_page} OFFSET {$pagination->offset()} ";
	$messages = messages::find_this_query($messages_query);
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
				<h1><span>Vaše Primljene Poruke i Prepiska</span></h1>
			</section><!-- #headline-basic-info -->

			<section id="basic-info-main-nav">
				<?php include("inc/main_menu.php"); ?><!-- Include file "main_menu.php" -->  
			</section><!-- #basic-info-main-nav -->
	

	
		<div class="container user-messages-content">
		 <div class="row">
		  <section class="col-sm-12">
		    <div class="col-sm-12 col-xs-12 command-messages">
				<h1 class="text-center">PORUKE </h1>
					<div class="count-img-messages"> 
						<h4>Ukupno poruka: 
							<b><?php 
								$message_sum = messages::sum_of_all_messages($_SESSION['user_id']);
									echo $message_sum;			 
							?></b>.
						</h4>

						<ul>
							<li>Pročitane: <b><?php echo messages::sum_of_specific_messages($_SESSION['user_id'], '1'); ?>.</b></li>
							<li>Nepročitane: <b><?php echo messages::sum_of_specific_messages($_SESSION['user_id'], '0'); ?>.</b></li>
						</ul>
					</div>
				<div id="command-paginate-container-message">
				  <div class="command-paginate-loader-message">
					<form action="inc/functions/delete.php" method="POST" id="messages-select-form">
					<div id='options_container-messages' class='col-xs-4'>
						<select class='form-control' name='delete_messages_options'>
							<option value=''>Izaberite opciju: </option>
							<option value='delete_messages'>Obriši</option>
						</select>
					</div><!-- .options-container -->
					<div class='col-xs-4'>
						<input type='submit' name="submit_message_options" class='btn btn-success button_delete' value='Primeni' />
					</div>	<br/><br/><br/>
					
					<div class="table-responsive">
						<table class="table messages-table">
							<thead>
								<th class="text-center">
									<select class='form-control' name='select-message-type' id="select-message-type">
										<option value='remove_marks'>Ništa</option>
										<option value='type_all'>Sve</option>
										<option value='type_read'>Pročitane</option>
										<option value='type_unread'>Nepročitane</option>
									</select>
								</th>
								<th class="text-center">Pošiljalac</th>
								<th class="text-center">E-mail</th>
								<th class="text-center">Telefon</th>
								<th class="text-center">Sadržaj</th>
								<th class="text-center">Odgovor</th>
								<th class="text-center">Datum</th>
								<th class="text-center">Obriši</th>
							</thead>
							<tbody>

									<?php foreach( $messages as $message ): ?>
									<tr>
										<?php 
										  // Add Class "message" if string length is higher than 177 characters
											$string = $message->message_content; 
											$length = strlen($string);

											if( $message->message_id != NULL ):
										?>	
											<td class="text-center message_id <?php echo ( $message->message_read == '0' ? ' unread_messages' : '') ?>">
												<input name="messages_id[]" class="messages_id <?php echo ( $message->message_read == '0' ? ' unread_message' : 'read_message') ?>" type="checkbox" value="<?php echo $message->message_id; ?>">
											</td>
											<td class="text-center <?php echo ( $message->message_read == '0' ? ' unread_messages' : '') ?>">
												<small>
													<a href="user_message.php?user=<?php echo $message->user_id; ?>&message=<?php echo $message->message_id; ?>" class="hover-active">
														<?php echo $message->sender_name; ?>
													</a>
												</small>
											</td>
											<td class="text-center <?php echo ( $message->message_read == '0' ? ' unread_messages' : '') ?>">
												<small>
													<?php echo $message->sender_email; ?>
												</small>
											</td>
											<td class="text-center <?php echo ( $message->message_read == '0' ? ' unread_messages' : '') ?>">
												<small>
													<?php echo $message->sender_phone; ?>
												</small>
											</td>
											<td class="text-center message <?php echo ( $message->message_read == '0' ? ' unread_messages' : '') ?>">
												<a href="user_message.php?message=<?php echo $message->message_id; ?>"  class="hover-active">
													<?php 
														$excerpt_message_content = substr( $message->message_content, 0, 45 );
														if( $length > 45 ){
															$message_text = ( $excerpt_message_content == '' || $excerpt_message_content == ' ' || $excerpt_message_content == '  ' ) ? 'Poruka bez Teksta' : $excerpt_message_content.'...';
																echo $message_text; 
														}
															else {
																echo $message->message_content.'...';
															}
														
													?>
												</a>
											</td>
											<td class="text-center message <?php echo ( $message->message_read == '0' ? ' unread_messages' : '') ?>">
												<?php echo (messages::count_answer($message->message_id) ? 'Odgovoreno' : 'Neodgovoreno' ); ?>
											</td>
											<td class="text-center <?php echo ( $message->message_read == '0' ? ' unread_messages' : '') ?>">
												<small>
													<?php echo major_class::date_time_format($message->send_time); ?>
												</small>
											</td>
											<td class="text-center <?php echo ( $message->message_read == '0' ? ' unread_messages' : '') ?>">
												<button data-id='<?php echo $message->message_id; ?>' id='<?php echo $message->message_id; ?>' data-type='delete_message' data-table="messages" class="submit-message delete_message">
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
						<div class="command-messages-paginate-container" >
							<ul class='pagination text-center'>
							<?php 
								if($pagination->sum_of_pages() > 1){
									if($pagination->is_previous_page()){
										echo "<li><a href='user_messages.php?&page={$pagination->previous_page()}' rel= '{$pagination->previous_page()}'>&laquo</a></li>";
									}
									
										for($i=1; $i<=$pagination->sum_of_pages(); $i++){
											if($i == $pagination->current_page){
												echo "<li><a class='active btn btn-success' href='user_messages.php?page='{$i}'  rel='{$i}'>$i</a></li>"; // Show current page in pagination slider !!!
											}
												else{
													echo "<li><a href='user_messages.php?page={$i}' rel='{$i}'>$i</a></li>";
												}
										}
									
									if($pagination->is_next_page()){
										echo "<li><a href='user_messages.php?page={$pagination->next_page()}' rel='{$pagination->next_page()}'> &raquo</a></li>";
									}
									
								}							
							?>				
							</ul>
						</div><!-- .messages-paginate-container -->
					</div><!-- .paginate -->
				</div><!-- .command-pagination -->
				</div> <!-- .command-message-paginate-loader -->
			</div><!-- .command-message-paginate-container -->
		  </div><!-- .command-messages -->
		</section>
		</div><!-- .row -->
	</div><!-- .user-messages-content -->

		<div class="user-messages-footer">
			<?php include("inc/footer.php"); ?>
		</div><!-- .user-messages-footer -->

	</div><!-- .wrapper -->





</body>
</html>
