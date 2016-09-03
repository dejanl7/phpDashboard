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
	//if($user->role == 'master_admin' ){
	//	redirect('logout.php');
	//}

	if( isset($_GET['user']) ){
		if( empty($_GET['user']) || empty($_GET['message']) ) {
			redirect('user_messages.php');
		}
		else {
			$checking_query = "SELECT * FROM messages WHERE message_id = ". $base->clear_string($_GET['message']) ." AND  user_id = ". $base->clear_string($_GET['user']);
			$checking_result = messages::find_this_query($checking_query);
			$rows = $base->while_loop($checking_query);
				if(  mysqli_num_rows($rows) != 1 ){
					redirect('user_messages.php');
				}
		}
	}
	else if( isset($_GET['master_user']) ){
		if( empty($_GET['master_user']) || empty($_GET['message']) ){
			redirect('master_admin_messages.php');
		}

		else {
			$checking_query_admin = "SELECT * FROM messages_admin WHERE messages_admin_id = ". $base->clear_string($_GET['message']) ." AND  admin_id = ". $base->clear_string($_GET['master_user']);
			$checking_admin_result = messages_admin::find_this_query($checking_query_admin);
			$rows_admin =  $base->while_loop($checking_query_admin);
			
			if(  mysqli_num_rows($rows_admin) != 1 ){
				redirect('master_admin_messages.php');
			}
		}
	}


?>
<?php
	// Mark Message Like "Read Message"
		messages::read_message($_GET['message']);
		messages_admin::read_message($_GET['message']);
?>
<body  class="hold-transition skin-blue sidebar-mini <?php echo ($user->left_menu_collapse== '1' ? ' sidebar-collapse' : ''); ?>" data-menustate=<?php echo ($user->left_menu_collapse== '1' ? ' collapsed' : ' not-collapsed');  ?>>
<div class="se-pre-con"></div><!-- Preloader Div -->
	
	<div class="wrapper" id='wrapper_user_messages' style="
		background: url(img/drive.jpg) no-repeat center center fixed;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover; 
		">

	<!-- INCLUDE ALL SEPARATED FILES -->
		<?php include("inc/top_menu.php");?>
		<?php ($user->role == 'master_admin') ? include('inc/master_left_menu.php') : include("inc/left_menu.php");?>
			<section class="row" id="headline-basic-info">
				<h1><span>Poruka</span></h1>
			</section><!-- #headline-basic-info -->

			<section id="basic-info-main-nav">
				<?php ($user->role == 'master_admin') ? '' : include("inc/main_menu.php"); ?><!-- Include file "main_menu.php" -->  
			</section><!-- #basic-info-main-nav -->
	
		<div class="container user-messages-content">
		  <div class="row">
			<section class="col-sm-12">
			  <div class="col-sm-12 col-xs-12 command-messages">
			 	<span class="col-sm-12 col-xs-12 answer-alert"></span>
				<h1 class="text-center">
					<?php 
						global $base;
						$clear_message_id = $base->clear_string($_GET['message']);
						//$sender_email =  messages::find_this_id($clear_message_id) ;
						//$sender_email_admin = messages_admin::find_this_id($clear_message_id);
						$sender_email = ( isset($_GET['user']) ? messages::find_this_id($clear_message_id) : messages_admin::find_this_id($clear_message_id) );
					?>
					<span style="text-transform: none;">
						<?php 
							if( isset($_GET['master_user']) ){
								$find_email = user::find_this_id($_GET['master_user']);
							}
						?>
						<?php echo ( isset($_GET['user']) ? $sender_email->sender_email : $find_email->email ); ?>
						<small>
							<?php
							 	if( !empty($sender_email->sender_name) ){
									echo $sender_email->sender_name;
								} 	
															
							?>
						</small>
					</span>
				</h1>
				
				<div class="col-xs-12 message-box" >
					<div class="col-xs-12 message-box-content">
						<small class="text-center message-time">
							<?php echo ( isset($_GET['user']) ? messages::date_time_format($sender_email->send_time, '\u H:i').'h' : messages_admin::date_time_format($sender_email->date, '\u H:i').'h'); ?>
						</small>
						<div class="message-content">
							<?php echo ( isset($_GET['user']) ? $sender_email->sender_name : $sender_email->content ); ?>
						</div><!-- .message-content -->
					</div><!-- .message-box-content -->
					

			<!-- Answer -->		
					<div id="div-answer-content">
					  <div class="answer-loader">
					  	<?php
							$answers = ( isset($_GET['user']) ? messages::show_answers($_GET['message']) : messages_admin::show_answers($_GET['message']) );
							if ( !empty($answers) ):
						?>
							<?php foreach( $answers as $answer ):  ?>
								<div class="col-xs-8 col-xs-offset-3 reply" id="reply">
									<h3 class="text-center">
										<?php echo $_SESSION['username']; ?> <small><?php echo ( isset($_GET['user']) ? messages::date_time_format($answer->message_answer_time, '\u H:i').'h' : messages_admin::date_time_format($answer->answer_time, '\u H:i').'h' ); ?></small>
									</h3>
									<?php echo ( isset($_GET['user']) ? $answer->message_content : $answer->content ); ?>
								</div>
							<?php  endforeach; ?>
						<?php endif; ?>	
					  </div><!-- .answer-loader -->
					</div><!-- #div-answer-content -->


					<div class="col-xs-12 col-sm-10 col-sm-offset-1 message-box-buttons">
						<button class="btn btn-warning pull-right answer" id="answer_message">Odgovori</button>
						<button class="btn btn-danger pull-left delete" id="delete_message">Obriši</button>
					</div><!-- .messge-box-buttons -->
					
					<div class="col-xs-10 col-xs-offset-1 answer-field">
						<form method="POST" action="inc/pages/pages_insert_info.php" id="answer-form">
							<textarea id="answer-message-textarea" name="answer-content"></textarea>
							<input type="submit" class="btn btn-block btn-warning" id="send-answer" data-page="<?php echo ( isset($_GET['user']) ? $_GET['user'] : $_GET['master_user'] ); ?>"  data-messagetype="<?php echo ( isset($_GET['user']) ? 'user' : 'master_user' ); ?>" data-messageid="<?php echo ( isset($_GET['user']) ? $sender_email->message_id : $sender_email->messages_admin_id ); ?>" data-email="<?php echo ( isset($_GET['user']) ? $sender_email->sender_email : user::find_this_id($sender_email->client_id)->email ); ?>" value="Pošalji Odgovor">
						</form>
					</div>

					

					<div class="col-xs-12 message-info">
						<small>
							<b>* Poruke poslate iz ovog menija, stizaće na E-mail korisnika kao poruke poslate sa E-mail adrese: unilink-network@cpanel.com</b>
						</small><br>
						<small>
							<b>* Ukoliko želite da ostvarite prijem poruka na E-mail adresu Vaše firme, potrebno je da označite polje "Prijem poruka preko e-mail adrese" u meniju "Osnovni Podaci"</b>
						</small><br>
						<small>
							<b>* Svaki put kada korisnik pošalje poruku, poruka će biti evidentirana kao nova primljena poruka u okviru menija "Poruke", nezavisno da li se ta poruka nadovezuje na prethodnu poruku.</b>
						</small>
					</div><!-- .message-info -->
				</div><!-- .message-box -->
			
			  </div><!-- .col-xs-12 -->
			</section>
		  </div>
		</div><!-- .user-messages-content -->

		<div class="user-message-footer">
			<?php include("inc/footer.php"); ?>
		</div><!-- .user-messages-footer -->
	</div><!-- .wrapper_user_message -->

</body>
</html>	