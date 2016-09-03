<?php

/*===========================================================
	Functions for Collapse or Uncollapse Left Menu 
=============================================================*/	
	function collapse_uncollapse($collapse){
		if( isset($_POST[$collapse]) ){
			$do_collapse_function = $_POST[$collapse];
			$result = user::sidebar_collapse($do_collapse_function);
		}
	}


/*===========================================================
	TinyMC for "Ask Administrator" 
=============================================================*/
	function ask_admin($querstion_for_admin){
		if( isset($_POST[$querstion_for_admin]) ){
			global $base;

			$content = $base->clear_string($_POST[$querstion_for_admin]);

			$query = "SELECT * FROM users WHERE role='master_admin'";
            $find_id = user::find_this_query($query);
            $master_admin_id='';
	            foreach ($find_id as $id) {
	                $master_admin_id = $id->user_id;
				}

			$user = user::find_this_id( $base->clear_string($_SESSION['user_id']) );

			$messages_admin = new messages_admin();
			$messages_admin->admin_id	= $master_admin_id;
			$messages_admin->client_id 	= $user->user_id;
			$messages_admin->content 	= $content;
			$messages_admin->date 		= date('Y-m-d H:i:s');

			
			$messages_admin->create();

			mail('dejan.loncar@unilink.mycpanel.rs', 'Pitanje Korisnika: '.$user->name, $content, "From: ".$user->email);

		}
	}


/*===========================================================
	TinyMC for "Ask Administrator" From external user
=============================================================*/
	function client_ask_admin($submit_button, $client_name, $client_email, $client_phone, $client_msg_content){
		if( isset($_POST[$submit_button]) ){
				global $base;

				$query = "SELECT * FROM users WHERE role='master_admin'";
	            $find_id = user::find_this_query($query);
	            $master_admin_id='';
		            foreach ($find_id as $id) {
		                $master_admin_id = $id->user_id;
					}

				$messages_admin = new messages_admin();
				$messages_admin->admin_id		= $master_admin_id;
				$messages_admin->client_name	= $_POST[$client_name];
				$messages_admin->client_email	= $_POST[$client_email];
				$messages_admin->client_phone	= $_POST[$client_phone];
				$messages_admin->content 		= $_POST[$client_msg_content];
				$messages_admin->date 			= date('Y-m-d H:i:s');

				
				$messages_admin->create();

				mail( 'dejan.loncar@unilink.mycpanel.rs', 'Pitanje Externog Korisnika: '.$base->clear_string($_POST[$client_name]), $base->clear_string($_POST[$client_msg_content]), "From: ".$base->clear_string($_POST[$client_email]) );
				

				echo ("
					<SCRIPT LANGUAGE='JavaScript'>
						window.alert('Uspešno Ste poslali poruku. Odgovor će Vam biti prosleđen na E-mail.')
				    	window.location.href='../../../contact.php';
				    </SCRIPT>
				");

			}
}







/*===========================================================
	 Function for showing/hide some page parts or images 
=============================================================*/	
	function show_or_hide($table, $column, $radio_option){
		if(isset($_POST[$column])){
			$show_column_name = $_POST[$column];
			$show_hide = $_POST[$radio_option];
			$result = $table::insert_info_about_page($table, $show_column_name,$show_hide);
		}	
	}

/*===========================================================
	BACKGROUND AND FONT COLOR FUNCTION 
=============================================================*/	
	function font_or_background_color($table, $color_column, $color){
		if(isset($_POST[$color_column])){
			$color_column_name = $_POST[$color_column];
			$show_color = $_POST[$color];
			$result = $table::insert_info_about_page($table, $color_column_name, $show_color);
		}
	}

/*===========================================================
	UPDATE ALL PAGES WITH SPECIFIC FONT COLOR  
=============================================================*/	
	function set_font_color_for_all_fields_in_all_pages($color){
		if( isset($_POST[$color]) ){
			$take_color = $_POST[$color];
			major_class::select_font_color_for_all_fields_all_pages($take_color);
		}
	}

/*===========================================================
	UPDATE ALL PAGES WITH SPECIFIC BACKGROUND COLOR  
=============================================================*/	
	function set_background_color_for_all_fields_all_pages($color){
		if( isset($_POST[$color]) ){
			$take_color = $_POST[$color];
			major_class::select_background_color_for_all_fields_all_pages($take_color);
		}
	}

/*===========================================================
	UPDATE ONE PAGE WITH SPECIFIC FONT COLOR  
=============================================================*/
	/*========================
		Function Font Colors
	==========================*/	
	function set_font_color_one_page($page, $color, $color_type){
		if(isset($_POST[$color])){
			$take_page = $_POST[$page];
			$show_color = $_POST[$color];
			$color_purpose = $_POST[$color_type];

			if( $color_purpose === 'font_color' ){
				if($take_page == "index_page"){
					$fields =  array('first_headline_font_color', 'first_div_font_color', 'second_headline_font_color', 'second_div_font_color');
					$result = $take_page::select_color_for_all_fields_in_one_page( $take_page, $show_color, $fields );
				}	

				if($take_page == "about_us"){
					$fields =  array('headline_font_color', 'business_info_color', 'business_info_content_color', 'our_team_headline_fontcolor', 'our_team_div_text_color');
					$result = $take_page::select_color_for_all_fields_in_one_page( $take_page, $show_color, $fields );
				}

				if($take_page == "gallery_page"){
					$fields =  array('gallery_headline_font_color', 'gallery_carousel_font_color', 'gallery_first_div_font_color', 'gallery_first_div_content_font_color');
					$result = $take_page::select_color_for_all_fields_in_one_page( $take_page, $show_color, $fields );
				}

				if($take_page == "preview_page"){
					$fields =  array('preview_headline_font_color', 'preview_specifications_font_color', 'preview_commentsHeadline_font_color', '	preview_commentsContent_font_color');
					$result = $take_page::select_color_for_all_fields_in_one_page( $take_page, $show_color, $fields );
				}

				if($take_page == "contact_page_css"){
					$fields =  array('first_headline_content_font_color', 'first_div_headline_font_color', 'first_div_content_font_color');
					$result = $take_page::select_color_for_all_fields_in_one_page( $take_page, $show_color, $fields );
				}
			}

	/*================================
		Function Background Colors
	==================================*/
			if( $color_purpose === 'background_color'){
				if($take_page == "index_page"){
					$fields =  array('first_div_background_color', 'second_div_background_color');
					$result = $take_page::select_color_for_all_fields_in_one_page( $take_page, $show_color, $fields );
				}	

				if($take_page == "about_us"){
					$fields =  array('business_info_content_bgcolor', 'our_team_div_bg_color');
					$result = $take_page::select_color_for_all_fields_in_one_page( $take_page, $show_color, $fields );
				}

				if($take_page == "gallery_page"){
					$fields =  array('gallery_carousel_background_color', 'gallery_first_div_background_color');
					$result = $take_page::select_color_for_all_fields_in_one_page( $take_page, $show_color, $fields );
				}

				if($take_page == "preview_page"){
					$fields =  array('preview_content_background_color', 'preview_specifications_background_color', 'preview_content_commentBackground_color');
					$result = $take_page::select_color_for_all_fields_in_one_page( $take_page, $show_color, $fields );
				}

				if($take_page == "contact_page_css"){
					$fields =  array('first_div_content_background_color');
					$result = $take_page::select_color_for_all_fields_in_one_page( $take_page, $show_color, $fields );
				}

			}

		}
	}


/*===========================================================	
	FUNCTION FOR SET FONT TYPE AND FONT WEIGHT
=============================================================*/		
	function font_weight_and_font_style($table_name, $db_column_name, $font_weight_load, $db_column2_name, $font_type){
		if(isset($_POST[$db_column_name])){		
			$database_column1_name = $_POST[$db_column_name];
			$font_weight = $_POST[$font_weight_load];
			$database_column2_name = $_POST[$db_column2_name];
			$text_type = $_POST[$font_type];		
			
			$result = $table_name::text_weight_type($table_name, $database_column1_name, $font_weight, $database_column2_name, $text_type);
		}
	}	


/*===========================================================	
	FUNCTION FOR SET THE SAME FONT WEIGHT AND STYLE
	We made difference between font_styles types. 
	On right click, there are recognized TITLE, TEXT and HEADLINE
	fields...
=============================================================*/
function select_specific_font_style_for_specific_fields_all_pages($font_style, $weight_type, $font_type){
	if( isset($_POST[$font_style]) ){
		$font_weight = $_POST[$weight_type];
		$font_type = $_POST[$font_type];
		$font_style = $_POST[$font_style];

		if( $font_style == 'headline'){
			$result = major_class::select_headlinefield_font_style_for_all_pages($font_weight, $font_type);
		}

		if( $font_style == 'title'){
			$result = major_class::select_title_font_style_for_all_pages($font_weight, $font_type);
		}

		if( $font_style == 'text' ){
			$result = major_class::select_textfield_font_style_for_all_pages($font_weight, $font_type);
		}


	}

}



/*===========================================================	
	FUNCTION FOR SET THE SAME FONT WEIGHT AND STYLE IN
	ONE (specific) PAGE
=============================================================*/	
function select_specific_font_style_for_one_page($weight, $type, $page){
	if( isset($_POST[$weight]) ){
		$font_weight 	= $_POST[$weight];
		$font_type 		= $_POST[$type];
		$take_page		= $_POST[$page];

		if( $take_page == 'index_page' ){
			$weight_fields  = array('first_headline_font_weight', 'first_div_font_weight', 'second_headline_font_weight', 'second_div_font_weight');
			$type_fields 	= array('first_headline_font_type', 'first_div_font_type', 'second_headline_font_type', 'second_div_font_type');
			$take_page::select_font_style_for_one_page($take_page, $font_weight, $font_type, $weight_fields, $type_fields);
		}

		if( $take_page == 'about_us' ){
			$weight_fields  = array('headline_font_weight', 'business_info_weight', 'business_info_content_weight', 'our_team_headline_fontweight', 'our_team_div_font_weight');
			$type_fields 	= array('headline_font_type', 'business_info_type', 'business_info_content_type', 'our_team_headline_fonttype', 'our_team_div_font_type');
			$take_page::select_font_style_for_one_page($take_page, $font_weight, $font_type, $weight_fields, $type_fields);
		}

		if( $take_page == 'gallery_page' ){
			$weight_fields  = array('gallery_headline_font_weight', 'gallery_carousel_font_weight', 'gallery_first_div_font_weight', 'gallery_first_div_content_font_weight');
			$type_fields 	= array('gallery_headline_font_type', 'gallery_carousel_font_type', 'gallery_first_div_font_type', 'gallery_first_div_content_font_type');
			$take_page::select_font_style_for_one_page($take_page, $font_weight, $font_type, $weight_fields, $type_fields);
		}

		if( $take_page == 'preview_page' ){
			$weight_fields  = array('preview_headline_font_weight', 'preview_specifications_font_weight','preview_commentsHeadline_font_weight', 'preview_commentsContent_font_weight');
			$type_fields 	= array('preview_headline_font_type', 'preview_specifications_font_type', 'preview_commentsHeadline_font_type', '	preview_commentsContent_font_type' );
			$take_page::select_font_style_for_one_page($take_page, $font_weight, $font_type, $weight_fields, $type_fields);
		}

		if( $take_page == 'contact_page_css' ){
			$weight_fields  = array('first_headline_content_weight', 'first_div_headline_font_weight', 'first_div_content_font_weight');
			$type_fields 	= array('first_headline_content_type', 'first_div_headline_font_type', 'first_div_content_font_type' );
			$take_page::select_font_style_for_one_page($take_page, $font_weight, $font_type, $weight_fields, $type_fields);
		}


		
	}
}

		
/*=====================================================================
	FUNCTION FOR INSERT MARKS INTO DATABASE, TABLE: "ARTICLES_MARKS"
=======================================================================*/			
	function insert_articles_marks($article_id, $user_id, $client_name, $client_mail, $price_mark, $quality_mark, $comment_article){
		if( isset($_POST[$price_mark]) && isset($_POST[$quality_mark]) ){
			$set_article_id 	= $_POST[$article_id];
			$set_user_id 		= $_POST[$user_id];
			$set_client_name 	= $_POST[$client_name];
			$set_client_mail 	= $_POST[$client_mail];
			$set_price_mark 	= $_POST[$price_mark];
			$set_quality_mark 	= $_POST[$quality_mark];
			$set_client_comment = $_POST[$comment_article];
			$set_client_comment_time = date('Y-m-d H:i:s');
			
			$mark = new articles_marks();
			$client_ip =  getenv('HTTP_CLIENT_IP') ? : getenv('HTTP_X_FORWARDED_FOR') ? : getenv('HTTP_X_FORWARDED') ? : getenv('HTTP_FORWARDED_FOR') ? : getenv('HTTP_FORWARDED') ? : getenv('REMOTE_ADDR'); 

				foreach($set_price_mark as $key => $pr):
					$mark->article_id = $set_article_id;
					$mark->user_id = $set_user_id;
					$mark->client_name = $set_client_name;
					$mark->client_mail = $set_client_mail;
					$mark->client_comment = $set_client_comment;
					$mark->customer_ip_address = $client_ip;
					$mark->price_mark = $pr;
					$mark->quality_mark = $set_quality_mark[$key];
					$mark->mark_time = $set_client_comment_time;
				endforeach;	
				
			$mark->create();
		}

		if( isset($_POST[$client_name]) && !$_POST[$price_mark] && !$_POST[$quality_mark]){
			$set_article_id = $_POST[$article_id];
			$set_user_id 	= $_POST[$user_id];
			$set_client_name = $_POST[$client_name];
			$set_client_mail = $_POST[$client_mail];
			$set_price_mark = '';
			$set_quality_mark = '';
			$set_client_comment = $_POST[$comment_article];
			$set_client_comment_time = date('Y-m-d H:i:s');

			$mark = new articles_marks();
			$client_ip =  getenv('HTTP_CLIENT_IP') ? : getenv('HTTP_X_FORWARDED_FOR') ? : getenv('HTTP_X_FORWARDED') ? : getenv('HTTP_FORWARDED_FOR') ? : getenv('HTTP_FORWARDED') ? : getenv('REMOTE_ADDR'); 

			$mark->article_id = $set_article_id;
			$mark->user_id = $set_user_id;
			$mark->client_name = $set_client_name;
			$mark->client_mail = $set_client_mail;
			$mark->client_comment = $set_client_comment;
			$mark->customer_ip_address = $client_ip;
			$mark->price_mark = $pr;
			$mark->quality_mark = $set_quality_mark[$key];
			$mark->mark_time = $set_client_comment_time;
				
			$mark->create();
		}
	}
	


/*=====================================================================
	FUNCTION FOR INSERT INFORMATION ABOUT USER (Company)
=======================================================================*/
	function info_about_company($submit_button, $company_name, $company_place, $company_address, $company_pib, $company_mat_br, $company_mail, $company_phone, $company_contact_person){
		if( isset($_POST[$submit_button]) ){
			$company_name 	= $_POST[$company_name];
			$city 		  	= $_POST[$company_place];
			$address 	  	= $_POST[$company_address];
			$pib 		  	= $_POST[$company_pib];
			$mat_broj 	  	= $_POST[$company_mat_br];
			$username 	  	= $_SESSION['username'];
			$email 		  	= $_POST[$company_mail];
			$phone 		 	= $_POST[$company_phone];
			$contact_person = $_POST[$company_contact_person];		

			//user::update_user_info( $company_name, $city, $address, $jmbg, $mat_broj, $username, $email, $phone, $contact_person );
			user::update_user_info( $company_name, $city, $address, $pib, $mat_broj, $username, $email, $phone, $contact_person );
				header("location: ../../basic_info.php");
		}
	}
	


/*=====================================================================
	UPDATE BUSINESS ACTIVITY INFO - 4. "basic_info.php"
=======================================================================*/
	function set_business_activity($submit_activities, $activities){
		if( isset($_POST[$submit_activities]) ){
			$business_activity = $_POST[$activities];
			user::update_business_activity($business_activity);

				header("location: ../../basic_info.php");
		} 	
	} 	



/*=====================================================================
	CHECK FIELD IF MESSAGE RECEIVING IS CHECKED 3. "basic_info.php"
=======================================================================*/ 	
	function mark_receiving_message($submit_mark_form, $state_check_mail_option){
		if( isset($_POST[$submit_mark_form]) ){
			if( !empty($_POST[$state_check_mail_option]) ){
				user::update_sending_mail_message($_POST[$state_check_mail_option]);
				header("location: ../../basic_info.php");
			}
			else {
				$checkbox_insert = 0;
				user::update_sending_mail_message($checkbox_insert);
				header("location: ../../basic_info.php");
			}

		}
	}				
	


/*=====================================================================
	UPDATE KEYWORDS AND BUSINESS DESCRIPTION FIELDS
=======================================================================*/ 
	function keywords_and_description($submit_keywords, $keywords, $seo_desc){
		if( isset($_POST[$submit_keywords]) ){
			$key_words  = $_POST[$keywords];
			$short_desc = $_POST[$seo_desc]; 
			user::update_key_words($key_words, $short_desc);

				header("location: ../../basic_info.php");
		}
	}


/*=====================================================================
	OPERATIONS WITH COMMENTS (Approve, Disable, Delete)
=======================================================================*/
	// Approve Comment(s)
	function approve_comment($approve_comment_id){
		if( isset($_POST[$approve_comment_id]) ){
			$comment_id = $_POST[$approve_comment_id];
			articles_marks::approve_comment_status($comment_id);
		}	
	}

	// Disable Comment(s)
	function block_comment($disable_comment_id){
		if( isset($_POST[$disable_comment_id]) ){
			$comment_id = $_POST[$disable_comment_id];
			articles_marks::disable_comment_status($comment_id);
		}
	}

	// Delete Comment(s)
	function delete_comment($delete_comment_id){
		if( isset($_POST[$delete_comment_id]) ){
			$comment_id = $_POST[$delete_comment_id];
			articles_marks::delete_comment($comment_id);
		}
	}


/*=====================================================================
	FUNCTION FOR INSERT MESSAGES INTO DATABASE
=======================================================================*/
	function insert_messages( $user_id, $sender_name, $sender_email, $sender_phone, $sender_message ){
		global $base;

		if( isset($_POST['submit_message'] ) ){
			$user_id 	= $_POST[$user_id];
			$name 		= $_POST[$sender_name];
			$mail 		= $_POST[$sender_email];
			$phone 		= $_POST[$sender_phone];
			$content 	= $_POST[$sender_message];
			

			$msg = new messages();
			$msg->user_id 			= $base->clear_string($user_id);
			$msg->sender_name 		= $base->clear_string($name);
			$msg->sender_email 		= $base->clear_string($mail);
			$msg->sender_phone 		= $base->clear_string($phone);
			$msg->message_content 	= $content;
			$msg->send_time 		= date('Y/m/d H:i:s');;

			$msg->create();

			$user = user::find_this_id($user_id);

			if( $user->allow_email_message == '1'){		
				mail($user->email, 'Unilink-finance, Poruka', 'Poruka od: '. $base->clear_string($mail) .'<br>'. $base->clear_string($content) );
			}
				
				//redirect('../../../company/company-contact.php?user_id='.$user_id);
				echo ("
					<SCRIPT LANGUAGE='JavaScript'>
						window.alert('Uspešno Ste poslali poruku.')
				    	window.location.href='../../../company/company-contact.php?user_id=".$user_id."';
				    </SCRIPT>
				");
			
		}
	}



/*=====================================================================
	TinyMC for Left Menu "Poruke" - answer on message
=======================================================================*/
	function insert_message_answer($answer, $sender_email, $message_id, $message_type){
		if( isset($_POST[$answer]) ){
			global $base;
			
			$answer_msg		= $_POST[$answer];
			$sender_email 	= $_POST[$sender_email];
			$message_id 	= $_POST[$message_id];
			$message_type 	= $_POST[$message_type];

			switch ($message_type) {
				case 'user':
					$messages = new messages();
					$messages->user_id 				= $base->clear_string($_SESSION['user_id']);
					$messages->message_content 		= $answer_msg;
					$messages->message_answer_time 	= date('Y/m/d H:i:s');
					$messages->message_read 		= 1;
					$messages->message_answer 		= $message_id;

					$messages->create();

					$user = user::find_this_id( $_SESSION['user_id'] );
					
					mail($base->clear_string($sender_email), 'Unilink-finance, Odgovor', 'Poruka od: '. $user->email .'<br>'. $base->clear_string($answer_msg) );


				break;
				
				case 'master_user':
					// In every "client_id" field into MASTER ADMIN ACCOUNT, when master admin answering on question, we will insert master admin id into client_id field
					// On that way, we will recognize distinguish between answers and questions.
					// Answers HAS THE SAME ID into "admin_id" and "client_id" fields
					$messages_admin = new messages_admin();
					$messages_admin->admin_id	 = $base->clear_string($_SESSION['user_id']);
					$messages_admin->client_id 	 = $base->clear_string($_SESSION['user_id']); 
					$messages_admin->read_msg 	 = 1;
					$messages_admin->content 	 = $answer_msg;
					$messages_admin->answer 	 = $message_id;
					$messages_admin->answer_time = date('Y-m-d H:i:s');

					
					$messages_admin->create();

					mail($base->clear_string($sender_email), 'Unilink-finance, Odgovor', $base->clear_string($answer_msg), 'From: dejan.loncar@unilink.mycpanel.rs');
				break;
			}



		}	
	}
	

/*=====================================================================
	"Osnovni Podaci" - Change Password - Insert New Password
	Confirmation
=======================================================================*/
	function change_password($password){
		if( isset($_POST[$password]) ){
			$new_password = $_POST[$password];

			$result = user::change_password($new_password);
		}
	}



/*=====================================================================
	"Kalendar" - Full Calendar Events
=======================================================================*/
// Drag Left Options over Some Calendar Field and Insert New Notification
	//add_new_notification($_POST['dropTitle'], $_POST['dropDate']);
	function add_new_notification($dropTitle, $dropDate, $dropColor){
		if( isset($_POST['dropTitle']) ){
			global $base;

			$title = $_POST[$dropTitle];
			$date  = $_POST[$dropDate];
			$color = $_POST[$dropColor];

			$json_data = array( 'title'=>$title, 'start'=>$date, 'color'=>$color );
			$events = json_encode($json_data);

			$result = full_calendar::insert_events($_SESSION['user_id'], $title, $date, $color);
		}
	}
	

// Drag Options over the Calendar Fields - Editable Curent Notification
	//drag_events_over_calendar($_POST['title'], $_POST['startDate'], $_POST['endDate'], $_POST['event_id']);
	function drag_events_over_calendar($title, $start, $end, $event_id, $eventColor){
		if( isset($_POST['title']) ){
			$title 		= $_POST[$title];
			$start 		= $_POST[$start];
			$end   		= $_POST[$end];
			$event_id 	= $_POST[$event_id];
			$color		= $_POST[$eventColor];

			$find_events = full_calendar::show_events();
	    	$event_info='';
        	foreach( $find_events as $key => $event ){
        		$event_info .= $event->event;
        	}
	        	full_calendar::update_events($event_id, $title, $start, $end, $color);
		}
	}


// Drag and Resize Event 
	//resize_event($_POST['resizeId'], $_POST['resizeTitle'], $_POST['startDate'], $_POST['endDate']);
	function resize_event($resizeId, $resizeTitle, $startDate, $endDate, $resizeColor){
		if ( isset($_POST[$resizeId]) ){
			$id 	= $_POST[$resizeId];
			$title  = $_POST[$resizeTitle];
			$start  = $_POST[$startDate];
			$end 	= $_POST[$endDate];
			$color 	= $_POST[$resizeColor];

				full_calendar::resize_event($id, $title, $start, $end, $color);
		}
	}


// Delete Event
	function delete_event($delete_event_id){
		if ( isset($_POST[$delete_event_id]) ){
			$id	= $_POST[$delete_event_id];
			full_calendar::delete_fullcalendar_event($id);
		}	
	}


// Add New Event (with title and color)
	function add_new_event($eventName, $eventColor){
		if( isset($_POST[$eventName]) ){
			global $base;
			
			$title 	= $_POST[$eventName];
			$color 	= $_POST[$eventColor];

			$full_calendar_notifications = new full_calendar_notification();

			$full_calendar_notifications->user_id = $base->clear_string($_SESSION['user_id']);
			$full_calendar_notifications->notification_title = $title;
			$full_calendar_notifications->notification_color = $color;

			$full_calendar_notifications->create();
		}
	}



// Delete Notification(s)
	function delete_notification($notificationId){
		if( isset($_POST[$notificationId]) ){
			$notification_id = $_POST[$notificationId];
				full_calendar_notification::delete_fullcalendar_notification($notification_id);
		}
	}



/*=====================================================================
	"Imenik" Phonebook 
=======================================================================*/
// Add New Contact From Contact Form
	function add_new_phonebook_contact_from_contact_form( $contactFromForm, $name, $phone, $address, $email, $contactPerson, $contactType){
		if( isset($_POST[$contactFromForm]) ){
			global $base;
			$phonebook = new phonebook();

			//$phonebook->phonebook_company_id 	= '0';
			$phonebook->user_id 				= $base->clear_string($_SESSION['user_id']);
			$phonebook->phonebook_name 			= $_POST[$name];
			$phonebook->phonebook_phone 		= $_POST[$phone];
			$phonebook->phonebook_address 		= $_POST[$address];
			$phonebook->phonebook_email			= $_POST[$email];
			$phonebook->phonebook_contactperson = $_POST[$contactPerson];
			$phonebook->contact_type 			= $_POST[$contactType];

			$phonebook->create();
		}
	}

// Add New Contacts From Button ("Dodaj Informacije u Imenik")
	function add_new_phonebook_contact($phonebook_data_type, $id, $name, $phone, $address, $email, $contactPerson, $contactType){
		if( isset($_POST[$phonebook_data_type]) ){
			global $base;
			switch ($_POST[$phonebook_data_type]) {
				case 'insert':
					$phonebook = new phonebook();
		
					$phonebook->phonebook_company_id 	= $_POST[$id];
					$phonebook->user_id 				= $base->clear_string($_SESSION['user_id']);
					$phonebook->phonebook_name 			= $_POST[$name];
					$phonebook->phonebook_phone 		= $_POST[$phone];
					$phonebook->phonebook_address 		= $_POST[$address];
					$phonebook->phonebook_email			= $_POST[$email];
					$phonebook->phonebook_contactperson = $_POST[$contactPerson];
					$phonebook->contact_type 			= $_POST[$contactType];

					$phonebook->create();
					break;

				case 'update':
					phonebook::update_phonebook_info($_POST[$id], $_POST[$name], $_POST[$phone], $_POST[$address], $_POST[$email],  $_POST[$contactPerson], $_POST[$contactType]);
					break;
			}

		}

	}


// Delete Contact from Phonebook 
	function delete_contact_from_phonebook($contact_id){
		if( isset($_POST[$contact_id]) ){
			phonebook::delete_phonebook_info($_POST[$contact_id]);
		}
	}


// Editing Contact Info - Modal Dialog (Update and Delete options)
	function editing_phonebook_contact_info($phoneContactId, $phoneContactType, $name, $phone, $address, $email, $contactPerson, $contactType){
		if( isset($phoneContactId) ){
			global $base;

			$contact_id 	= $base->clear_string($_POST[$phoneContactId]);
			$contact_type 	= $base->clear_string($_POST[$phoneContactType]);
			
			switch($contact_type){
				case 'delete-phonebook-contact':
					phonebook::delete_phonebook_info($contact_id);
				break;

				case 'update-phonebook-contact':
					phonebook::update_phonebook_info($contact_id, $_POST[$name], $_POST[$phone], $_POST[$address], $_POST[$email],  $_POST[$contactPerson], $_POST[$contactType]);
				break;
			}

		}

	}



/*===================================================
	MASTER ADMIN - Approve or Block User
=====================================================*/
	function approve_block_user($master_user_id, $master_user_type){
		if( isset($master_user_id) ){
			global $base;

			$id 	= $base->clear_string($_POST[$master_user_id]);
			$type 	= $base->clear_string($_POST[$master_user_type]);
			
			switch($type){
				case 'approve_status':
					user::do_approve_user($id);
				break;

				case 'block_status':
					user::do_block_user($id);
				break;
			}

		}

	}

/*===================================================
	MASTER ADMIN - Approve or Block MORE Users
=====================================================*/
	function approve_block_more_users($users_id, $users_type){
		if( isset($_POST[$users_id]) ){
			global $base;
			
			user::users_manipulation($_POST[$users_id], $_POST[$users_type]);
			redirect('../../master_admin.php');
		}

	}

?>