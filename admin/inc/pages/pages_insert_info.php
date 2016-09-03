<?php include("../init.php"); ?><!-- Include header -->
<?php
	if(!$session->session_status()){
		//redirect("login.php");
	}
?>
<?php
include("../functions/pages_functions/insert_info.php");
	
/*====================================
	Collapse or Uncollapse Left menu
======================================*/
	collapse_uncollapse('sendingData');


/*====================================
	Send Question for Administrator
======================================*/
	ask_admin('querstion_for_admin');
	client_ask_admin('submit_client_message', 'client_name', 'client_email', 'client_phone', 'client_message_content');
	


/*=========================================================
	LEFT MENU - Command
===========================================================*/
/*========================
	"Osnovni Podaci"
==========================*/
	// Update First Form Data - "basic_info.php"
		info_about_company('submit-basic-info-form', 'basic-info-company-name', 'basic-info-place', 'basic-info-address', 'basic-info-pib', 'basic-info-maticni-broj', 'basic-info-mail', 'basic-info-phone', 'basic-info-contact-person' );

	// Update Business Info Activities 
		set_business_activity('submit-basic-info-activities', 'basic-info-activities');

	// Mark Check Field if Receiving Message Via E-mail is checked
		mark_receiving_message( 'submit-send-email-form', 'basic-info-send-email' );

	// Insert (update) Keywords and Description Field
		keywords_and_description('submit-basic-info-tags', 'basic-info-tags', 'seo_desc');

	// Change Password - Insert New Password for Current User
		change_password('newPassword');

/*========================
	"Komentari"
==========================*/
	// Approve Comments
		approve_comment('approve_comment_id'); 

	// Block Comments
		block_comment('disable_comment_id');

	// Delete Comments
		delete_comment('delete_comment_id');
		

/*========================
	"Poruke"
==========================*/
	// Insert Messages
		insert_messages("user_id", "sender_name", "sender_email", "sender_phone", "sender_message");
		
	// Insert Answer (Admin- ordinary users and Master Admin )
		insert_message_answer('answer', 'sender_email', 'message_id', 'message_type');



/*========================
	"Kalendar"
==========================*/
// Drag Left Options over Some Calendar Field and Insert New Notification
	add_new_notification('dropTitle', 'dropDate', 'dropColor');

// Drag Options over the Calendar Fields - Editable Curent Notification
	drag_events_over_calendar('title', 'startDate', 'endDate', 'event_id', 'eventColor');

// Drag and Resize Event 
	resize_event('resizeId', 'resizeTitle', 'startDate', 'endDate', 'resizeColor');

// Delete Event
	delete_event('delete_event_id');

// Add New Event (with title and color)
	add_new_event('notificationTitle', 'notificationColor');

// Delete Notification According to notification_id
	delete_notification('notificationId');


/*========================
	"Imenik"
==========================*/
  // Add New Contact from Contact Form
	add_new_phonebook_contact_from_contact_form('phonebook_contact_from_form', 'phonebook_name', 'phonebook_phone', 'phonebook_address', 'phonebook_email', 'phonebook_contactperson', 'phonebook_contact_type');

  // Add New Contact from Button
	add_new_phonebook_contact('phonebook_data_type', 'id', 'phonebook_name', 'phonebook_phone', 'phonebook_address', 'phonebook_email', 'phonebook_contactperson', 'phonebook_cotntacttype');
  
  // Delete Contact from Phonebook
	delete_contact_from_phonebook('phonebookContactId');

  // Editing Phonebook Contact Info - Modal Dialog
	editing_phonebook_contact_info('editingPhonebookId', 'phonebookDataType', 'updatePhonebookName', 'updatePhonebookPhone', 'updatePhonebookAddress', 'updatePhonebookEmail', 'updatePhonebookPerson', 'updatePhonebookType');


/*========================================================
	MASTER ADMIN 
==========================================================*/
// Approve or Block User
	approve_block_user('master_user_id', 'master_user_type');

// Approve or Block More Users
	approve_block_more_users('users_id', 'users-options');







/*======================================================
	Insert (Update) MORE fields with the same color
========================================================*/
  // Update ALL Fields in ALL Pages with the same Font Color
	set_font_color_for_all_fields_in_all_pages('font_color_all_tables');

  // Update ALL Fields in All Pages with same Background Color
	set_background_color_for_all_fields_all_pages('background_color_all_tables');

  // Update All Fields in ONE Page with the same Font Color
	set_font_color_one_page('page', 'color_this_page', 'color_type');


/*========================================================
	Insert (Update) MORE (all) Fields with the same style
==========================================================*/
  //Insert (Update) ALL Pages with the same font style. Recognized field type, and apply style.
	select_specific_font_style_for_specific_fields_all_pages('font_style', 'weight_type', 'font_type');

  // Insert (Update) ONE Page with the same font style.
	select_specific_font_style_for_one_page('font_size', 'font_type_one_page', 'page');	



/*======================================================================
	PAGE "INDEX.PHP" 	
========================================================================*/
// CHANGE FONT WEIGHT AND TYPE.... 	
  // Select font type and weight for headline in page "index.php"
	font_weight_and_font_style("index_page", "first_headline_font_weight", "index_headline_font_weight_data", "first_headline_font_type", "index_headline_font_type_data");

  // Select font type and weight for first div (headline) in page "index.php"
	font_weight_and_font_style("index_page", "first_div_font_weight", "first_div_headline_weight_data", "first_div_font_type", "first_div_type_data");

  // Select font type and weight for second div HEADLINE in page "index.php"
	font_weight_and_font_style("index_page", "second_headline_font_weight", "second_div_headline_weight_data", "second_headline_font_type", "second_div_type_data");

  // Select font type and weight for second div CONTENT in page "index.php"
	font_weight_and_font_style("index_page", "second_div_font_weight", "second_div_content_weight_data", "second_div_font_type", "second_div_content_type_data");


// CHANGE COLOR, BACKGROUND ETC.... 	
  // Change font color for first div headline 	
	font_or_background_color("index_page", "first_headline_font_color","index_color_pickerHeadline");
	
  // Change font	color for first div CONTENT	
	font_or_background_color("index_page", "first_div_font_color","index_color_picker_firstDiv");

  // Change background color for FIRST DIV	
	font_or_background_color("index_page", "first_div_background_color","index_color_picker_background_firstDiv");

  // Second headline Font color
	font_or_background_color("index_page", "second_headline_font_color", "index_color_picker_secondDiv");
	
  // Second DIV CONTENT Font color
	font_or_background_color("index_page", "second_div_font_color", "index_color_picker_content_secondDiv");
	
  // Second DIV BACKGROUND color	
	font_or_background_color("index_page", "second_div_background_color", "index_color_picker_background_secondDiv");
	
/*==========	END OF PAGE "INDEX.PHP" 	==========*/


/*=====================================================================
	PAGE "ABOUT.PHP" 	
=======================================================================*/	
// RADIO BUTTONS 
  // LEFT IMAGE in "INFORMACIJE O POSLOVANJU" part	
	show_or_hide("about_us", "business_info_leftImg","show_left_image_or_hide");
	
  // Part "OUR TEAM" - show or hide 	
	show_or_hide("about_us", "our_team_show_div","our_team_visible");
	
  // Show or hide image(with biography) in "NAŠ TIM" part 		
	show_or_hide("about_us", "our_team_show_picture","show_hide_ourteam_images");
	
	
// CHANGE COLOR, BACKGROUND ETC....
  // Change font color for Headline 	
	font_or_background_color("about_us", "headline_font_color","color_pickerHeadline");

  // Change font color Main menu 
	font_or_background_color("about_us", "menu_text_color","change_text_color_main_menu");
	
  // Change font BACKGROUND COLOR Main menu 		
	font_or_background_color("about_us", "menu_bg_color","color_pickerBgTopmenu");
	
  // Change font color for BUSINESS_INFO headline 		
	font_or_background_color("about_us", "business_info_color","color_pickerBusinessInfoHeadline");
	
  // Change font BUSINESS_INFO content color 		
	font_or_background_color("about_us", "business_info_content_color","color_pickerBusinessInfoBg");
	
  // Change font BUSINESS_INFO div background color 		
	font_or_background_color("about_us", "business_info_content_bgcolor","color_pickerBusinessInfo");
	
  // Change headline font color for OUR TEAM DIV 		
	font_or_background_color("about_us", "our_team_headline_fontcolor","sub_headline_colorOurTeam");
	
  // Change font color OUR TEAM DIV - content 		
	font_or_background_color("about_us", "our_team_div_text_color","sub_text_content_colorOurTeam");
	
  // Change BACKGROUND color OUR TEAM DIV 		
	font_or_background_color("about_us", "our_team_div_bg_color","sub_content_background_colorOurTeam");
	
		
	
// CHOOSE FONT TYPE AND FONT WEIGHT 		
  // Select font type and weight for headline in page "about.php"	
	font_weight_and_font_style("about_us", "headline_font_weight", "headline_font_weight_data", "headline_font_type", "headline_font_type_data");
	
  //  MAIN MENU - Select font type and weight	
	font_weight_and_font_style("about_us", "menu_text_weight", "menu_text_weight_data", "menu_text_type", "menu_text_type_data");
	
  //  BUSINESS_INFO HEADLINE - Select font type and weight	
	font_weight_and_font_style("about_us", "business_info_weight", "business_info_weight_data", "business_info_type", "business_info_type_data");
	
  //  BUSINESS_INFO CONTENT - Select font type and weight	
	font_weight_and_font_style("about_us", "business_info_content_weight", "business_info_content_weight_data", "business_info_content_type", "business_info_content_type_data");
	
  //  OUR_TEAM HEADLINE - Select font type and weight	
	font_weight_and_font_style("about_us", "our_team_headline_fontweight", "our_team_headline_fontweight_data", "our_team_fonttype", "our_team_fonttype_data");
	
  //  OUR_TEAM CONTENT - Select font type and weight	
	font_weight_and_font_style("about_us", "our_team_div_font_weight", "our_team_div_font_weight_data", "our_team_div_font_type", "our_team_div_font_type_data");

/*==========	END OF PAGE "ABOUT.PHP" 	==========*/


/*=====================================================================
	PAGE "gallery.PHP" 	
=======================================================================*/
// Page "gallery" Headline font weight and font type (style)...
	font_weight_and_font_style("gallery_page", "gallery_headline_font_weight", "gallery_headline_font_weight_data", "gallery_headline_font_type", "gallery_headline_font_type_data");
	
// Headilne font color
	font_or_background_color("gallery_page", "gallery_headline_font_color","gallery_color_pickerHeadline");

// gallery CAROUSEL font weight and type
	font_weight_and_font_style("gallery_page", "gallery_carousel_font_weight", "gallery_carousel_font_weight_data", "gallery_carousel_font_type", "gallery_carousel_font_type_data");

// Carousel slider font color
	font_or_background_color("gallery_page", "gallery_carousel_font_color","color_picker_CarouselFontColor");

//	CAROUSEL slider BACKGROUND color
	font_or_background_color("gallery_page", "gallery_carousel_background_color","color_picker_CarouselBackgroundColor");

// FIRST DIV Headilne font weight and type (style)
	font_weight_and_font_style("gallery_page", "gallery_first_div_font_weight", "gallery_firstDiv_font_weight_data", "gallery_first_div_font_type", "gallery_firstDiv_font_type_data");

// FIRST DIV Font color
	font_or_background_color("gallery_page", "gallery_first_div_font_color","color_picker_first_div_fontColor");

// FIRST DIV CONTENT font weight and type
	font_weight_and_font_style("gallery_page", "gallery_first_div_content_font_weight", "gallery_firstDiv_content_font_weight_data", "gallery_first_div_content_font_type", "gallery_firstDiv_content_font_type_data");

// FIRST DIV CONTENT font color
	font_or_background_color("gallery_page", "gallery_first_div_content_font_color","color_picker_first_div_content_fontColor");

// FIRST DIV CONTENT background color
	font_or_background_color("gallery_page", "gallery_first_div_background_color","color_picker_first_div_background_fontColor");


/*==========	END OF PAGE "gallery.PHP" 	==========*/
	




/*=====================================================================
	PAGE "PREVIEW.PHP" 
=======================================================================*/
// Page "PREVIEW" - Change font weight and font type (style)...
	font_weight_and_font_style("preview_page", "preview_headline_font_weight", "preview_headline_font_weight_data", "preview_headline_font_type", "preview_headline_font_type_data");

// Page "PREVIEW" - Change font color
	font_or_background_color("preview_page", "preview_headline_font_color","preview_color_pickerHeadline");
	
// Page "PREVIEW" - Change content background color
	font_or_background_color("preview_page","preview_content_background_color","preview_color_pickerBackground");

// Page "PREVIEW" - SHOW of HIDE marks in first div
	show_or_hide("preview_page","preview_content_show_hide","preview_marks_data");

// Page "PREVIEW" - Change font weight and font type
	font_weight_and_font_style("preview_page", "preview_specifications_font_weight", "preview_specifications_font_weight_data", "preview_specifications_font_type", "preview_headline_specifications_type_data");

// Page "PREVIEW" - Change font color
	font_or_background_color("preview_page", "preview_specifications_font_color","preview_specifications_pickerFont");

// Page "PREVIEW" - Change background color
	font_or_background_color("preview_page", "preview_specifications_background_color","preview_specifications_pickerBackground");

// Page "PREVIEW" - SHOW or HIDE div for giving marks
	show_or_hide("preview_page","preview_specifications_show_hide","article_customers_marks_data");

// Page "PREVIEW" - SHOW or HIDE COMMENTS
	show_or_hide("preview_page", "preview_comment_show_hide", "article_customer_comment_data");	

// Insert marks and comments about article into database...
	insert_articles_marks('article_id', 'user_id', 'name_of_user', 'email_of_user', 'star_mark_price', 'star_mark_quality', 'comment_article');
	
// Insert COMMENTS Headline color into database
	font_or_background_color("preview_page", "preview_commentsHeadline_font_color","preview_commentsHeadline_pickerFont");

// Insert COMMENTS HEADLINE Font Weight and Font Type
	font_weight_and_font_style("preview_page", "preview_commentsHeadline_font_weight", "preview_commentsHeadline_font_weight_data", "preview_commentsHeadline_font_type", "preview_commentsHeadline_type_data");

// Insert COMMENTS CONTENT color into database
	font_or_background_color("preview_page", "preview_commentsContent_font_color","preview_content_pickerFont");

// Insert COMMENTS BACKGROUND CONTENT color into database
	font_or_background_color("preview_page", "preview_content_commentBackground_color","preview_content_pickerBackground");

// Insert COMMENTS Font Weight and Font Type
	font_weight_and_font_style("preview_page", "preview_commentsContent_font_weight", "preview_commentsContent_font_weight_data", "preview_commentsContent_font_type", "preview_commentsContent_type_data");




/*==========	END OF PAGE "PREVIEW.PHP" 	==========*/
	
	
	
	
/*=====================================================================   
	PAGE "CONTACT.PHP" 
=======================================================================*/
// Headline font weight and font type (style)...
	font_weight_and_font_style("contact_page_css", "first_headline_content_weight", "contact_headline_font_weight_data", "first_headline_content_type", "contact_headline_font_type_data");
	
// Headline font color 
	font_or_background_color("contact_page_css", "first_headline_content_font_color","contact_color_pickerHeadline");
	
// First div headline font weight and font type (style)...
	font_weight_and_font_style("contact_page_css", "first_div_headline_font_weight", "contact_first_div_headline_font_weight_data", "first_div_headline_font_type", "contact_first_div_headline_font_type_data");
	
// First div headline - define font color ...
	font_or_background_color("contact_page_css", "first_div_headline_font_color", "contact_headline_color_picker_firstDiv");
	
// First div CONTENT font weight and font type (style)...
	font_weight_and_font_style("contact_page_css", "first_div_content_font_weight", "first_div_content_font_weight_data", "first_div_content_font_type", "first_div_content_font_type_data");
	
// First div CONTENT font color...
	font_or_background_color("contact_page_css", "first_div_content_font_color", "contact_color_picker_contentFontColor");

// First div CONTENT BACKGROUND color...
	font_or_background_color("contact_page_css", "first_div_content_background_color", "content_color_picker_background_firstDiv");	
	
// Show or hide SECOND DIV - contact form for set some question...		
	show_or_hide("contact_page_css", "show_hide_second_div_contact","contact_form_show_part");	


/*==========	END OF PAGE "CONTACT.PHP" 	==========*/
	






?>