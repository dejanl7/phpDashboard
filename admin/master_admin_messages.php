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
		<?php include("inc/top_menu.php"); ?>
		<?php include("inc/master_left_menu.php"); ?>

			
			<section class="row" id="headline-basic-info">
				<h1><span>Poruke Administratora</span></h1>
			</section><!-- #headline-basic-info -->

		<div class="container master_user-whole-content">
			<section class="col-sm-11 col-sm-offset-0 col-xs-12 master_user-messages-content">
				<?php 			
					$current_page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
					$number_per_page = 10;
					$total_items = messages_admin::count_number_of_all_records($_SESSION['user_id']);
					$pagination = new pagination($current_page, $number_per_page, $total_items);

					$query = "SELECT * FROM messages_admin WHERE admin_id='". $base->clear_string($_SESSION['user_id']) ."' ORDER BY date DESC LIMIT {$number_per_page} OFFSET {$pagination->offset()}";
					$messages = messages_admin::find_this_query($query);
				?>
					<div class="container master-user-content">
				    <div class="col-sm-11 col-xs-12 master_user-messages">
						<div id="master_user-paginate-container-messages">
						  <div class="master_user-paginate-loader-messages">
							<h1 class="text-center">Inbox </h1>
							<div class="count-user-messages"> 
								<h4>Ukupno poruka: 
									<b><?php 
										$message_sum = messages_admin::count_number_of_all_records($_SESSION['user_id']);
											echo $message_sum;			 
									?></b>.
								</h4>

								<ul>
									<li>Pročitane: <b><?php echo messages_admin::sum_of_specific_messages($_SESSION['user_id'], '1'); ?>.</b></li>
									<li>Nepročitane: <b><?php echo messages_admin::sum_of_specific_messages($_SESSION['user_id'], '0'); ?>.</b></li>
								</ul>
							</div>
							<div id="master_user-paginate-container-message">
							  <div class="col-sm-11 master_user-paginate-loader-message">
								<form action="inc/functions/delete.php" method="POST" id="messages-select-form">
								<div id='options_container-messages' class='col-xs-4'>
									<select class='form-control' name='delete_admin_messages_options'>
										<option value=''>Izaberite opciju: </option>
										<option value='delete_messages'>Obriši</option>
									</select>
								</div><!-- .options-container -->
								<div class='col-xs-4'>
									<input type='submit' name="submit_admin_message_options" class='btn btn-success button_delete' value='Primeni' />
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
													<?php $info = user::find_this_id($message->client_id); ?>
												<tr>
													<?php 
													  // Add Class "message" if string length is higher than 177 characters
														$string = $message->content; 
														$length = strlen($string);

														if( $message->admin_id != NULL && $message->answer == '0' ):
													?>	
														<td class="text-center messages_admin_id <?php echo ( $message->read_msg == '0' ? ' unread_messages' : '') ?>">
															<input name="admin_messages_id[]" class="admin_messages_id <?php echo ( $message->read_msg == '0' ? ' unread_message' : 'read_message') ?>" type="checkbox" value="<?php echo $message->messages_admin_id; ?>">
														</td>
														<td class="text-center <?php echo ( $message->read_msg == '0' ? ' unread_messages' : '') ?>">
															<small>
																<a href="user_message.php?master_user=<?php echo $message->admin_id; ?>&message=<?php echo $message->messages_admin_id; ?>" class="hover-active">
																	<?php echo ( $message->client_id != '0' ? $info->name : $message->client_name ); ?>
																</a>
															</small>
														</td>
														<td class="text-center <?php echo ( $message->read_msg == '0' ? ' unread_messages' : '') ?>">
															<small>
																<?php echo ( $message->client_id != '0' ? $info->email : $message->client_email ); ?>
															</small>
														</td>
														<td class="text-center <?php echo ( $message->read_msg == '0' ? ' unread_messages' : '') ?>">
															<small>
																<?php echo ( $message->client_id != '0' ? $info->phone : $message->client_phone ); ?>
															</small>
														</td>
														<td class="text-center message <?php echo ( $message->read_msg == '0' ? ' unread_messages' : '') ?>">
															<a href="user_message.php?master_user=<?php echo $message->admin_id; ?>&message=<?php echo $message->messages_admin_id; ?>" class="hover-active">
																<?php 
																	$excerpt_message_content = substr( $message->content, 0, 45 );
																	if( $length > 45 ){
																		$message_text = ( $excerpt_message_content == '' || $excerpt_message_content == ' ' || $excerpt_message_content == '  ' ) ? 'Poruka bez Teksta' : $excerpt_message_content.'...';
																			echo $message_text; 
																	}
																		else {
																			echo $message->content.'...';
																		}
																	
																?>
															</a>
														</td>
														<td class="text-center message <?php echo ( $message->read_msg == '0' ? ' unread_messages' : '') ?>">
															<?php echo (messages_admin::count_answer($message->messages_admin_id) ? 'Odgovoreno' : 'Neodgovoreno' ); ?>
														</td>
														<td class="text-center <?php echo ( $message->read_msg == '0' ? ' unread_messages' : '') ?>">
															<small>
																<?php echo major_class::date_time_format($message->date); ?>
															</small>
														</td>
														<td class="text-center <?php echo ( $message->read_msg == '0' ? ' unread_messages' : '') ?>">
															<button data-id='<?php echo $message->messages_admin_id; ?>' id='<?php echo $message->messages_admin_id; ?>' data-type='delete_admin_message' data-table='messages_admin' class='submit-message delete_message'>
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

							<div class="master_user-pagination">
								<div class="master_user-paginate text-center">
									<div class="master_user-messages-paginate-container" >
										<ul class='pagination text-center'>
										<?php 
											if($pagination->sum_of_pages() > 1){
												if($pagination->is_previous_page()){
													echo "<li><a href='master_admin_messages.php?&page={$pagination->previous_page()}' rel= '{$pagination->previous_page()}'>&laquo</a></li>";
												}
												
													for($i=1; $i<=$pagination->sum_of_pages(); $i++){
														if($i == $pagination->current_page){
															echo "<li><a class='active btn btn-success' href='master_admin_messages.php?page='{$i}'  rel='{$i}'>$i</a></li>"; // Show current page in pagination slider !!!
														}
															else{
																echo "<li><a href='master_admin_messages.php?page={$i}' rel='{$i}'>$i</a></li>";
															}
													}
												
												if($pagination->is_next_page()){
													echo "<li><a href='master_admin_messages.php?page={$pagination->next_page()}' rel='{$pagination->next_page()}'> &raquo</a></li>";
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
				</div>
			</div>
			</section>
			
		</div>

		<div class="master_user-info-footer">
			<?php include("inc/footer.php"); ?>
		</div>
	</div>

</body>
</html>