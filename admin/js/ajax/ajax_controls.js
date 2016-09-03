$(document).ready(function(){

/*========================================================
	Command Left Menu
==========================================================*/
// CLOSE Modal Dialog (box) - on click on X
	close_modals();

// "Osnovni Podaci" - New Password Validation
	new_password_validation();
	
// "Osnovni Podaci" - toggle "Promena Šifre"
	toggle_form_into_modal( ".inputs-for-password", "#change-password" );

// "Osnovni Podaci" - Change Password. Insert New Password
	change_password('#new-password-insert', '#new-password-confirm');

// "Komentari" Approve Comments
	approve_comments();

// "Komentari" Disable Comments
	disable_comments();

// "Komentari" Delete Comments
	delete_comments();

// "Slike (fajlovi)" Select All Images (Command)
	select_all_boxes('.command_SelectAllImages','.images_files');

// "Komentari"Select All Comments (Command)
	selected_boxes('#select-comment-type', '.read_comment', '.unread_comment', '.comments_id');

// "Poruke" Select All Messages (Command)
	selected_boxes('#select-message-type', '.read_message', '.unread_message', '.messages_id');

// "Slike (fajlovi)" Paginate All Images (Command)
	ajax_pagination('.command-images', '.pagination a', '#command-paginate-container','user_images.php?page=', ' .command-paginate-loader', '.command-images', '.command_SelectAllImages', '.images_files', '.delete_file_imgs');

// "Komentari" Paginate All Comments (Command)
  // Delete Comment, Approve Comment and Block Comment
	ajax_selected_boxes_pagination('.command-comments', '.pagination a', '#command-paginate-container-comment','user_comments.php?page=', ' .command-paginate-loader-comment','#select-comment-type', '.read_comment', '.unread_comment', '.comments_id', 'button');


// "Poruke" Paginate All Messages (Command)
	ajax_selected_boxes_pagination('.command-messages', '.pagination a', '#command-paginate-container-message','user_messages.php?page=', ' .command-paginate-loader-message','#select-message-type', '.read_message', '.unread_message', '.messages_id', '.delete_message');


// "Poruke" Toggle Answer Field
	toggle_form_into_modal( ".answer-field", "#answer_message" );

// "Poruke" Delete Message
	delete_message();

// Full Calendar - Add New Event
	returnColor(); // Return Curent Color
	insertNewEvent('#add-new-notification-form', '#new-event', '#notification-color');
	toggle_div_into_modal('#add-new-event', '#add-personal-specific-notification');
	 
// "Imenik" Phonebook 
	toggle_form_into_modal( "#insert-new-contact", "#show-new-contact-form" ); // - Toggle Form
	insert_new_contact('#add-phone-contact'); // Add New Contact

	deleteContact('.delete-contact'); // Delete Contact
	editPhonebookContact('.editing_phonebook_contact_info'); // Edit Contact in Modal Dialog

	selected_boxes('#select-phonebook-type', '.pravno_lice', '.fizicko_lice',  '.phonebook_id'); // Select All Choosed Boxes



/*===================================
	Master Admin -> network manager
=====================================*/
// Page "master_admin.php" -  page with graphs and options for approve and block some user(s)
  // Select Boxes
  	selected_boxes('#select-users-type', '.regular_user', '.blocked_user', '.users_id');
  
  // Approve or Block User
  	approve_block_user('.approve-user');
  	approve_block_user('.block-user');

  // Ajax Pagination Approve or Block User
	ajax_approve_block_user_pagination('.command-users', '.pagination a', '#command-paginate-container-users','master_admin.php?page=', ' .command-paginate-loader-users', '#select-users-type', '.regular_user', '.blocked_user', '.users_id', '.approve_block_user_btn button');

  // Ask Admin, send some question to Administrator
	ask_admin('#id_ask_admin', 'ask_admin');

  // Select Boxes
	selected_boxes('#select-message-type', '.read_message', '.unread_message',  '.admin_messages_id'); // Select All Choosed Boxes
  
  // Admin Messages Pagination
	ajax_selected_boxes_pagination('.master-user-content', '.pagination a', '#master_user-paginate-container-messages','master_admin_messages.php?page=', ' .master_user-paginate-loader-messages','#select-message-type', '.read_message', '.unread_message', '.admin_messages_id', '.delete_message');




/*================================================
	Left Menu - Reply on Message Admin and Master
	Admin
==================================================*/
	send_userAnd_masterUser_answer('#answer-form', 'answer-message-textarea', '#send-answer', '#div-answer-content', '.answer-alert', '.answer-field' );




/*=============================================================== PAGE "INDEX.PHP" ===============================================================*/	
  // PAGINATION Function
	ajax_pagination('#delete_container', '.pagination a', '#delete_container','index.php?page=', ' #show_carousel_img_for_delete', '#carousel_delete_table', '.index_selectAllBoxes', '.checkBoxes', '.delete_carousel' );
	
  // SELECT ALL BOXES (CHECK ALL)
	select_all_boxes('.index_selectAllBoxes', '.checkBoxes');
	
  // Select special field...
	$('.checkBoxes').click(function(){
		var checkBoxes_value = $(this).attr('value');
	});
	
  // jQuery Font Size
	jquery_set_headline_font_size('.brand-name', 'index_page' );
	jquery_set_headline_font_size('.second_div_headline', 'index_page' );
	jquery_set_ptag_font_size('.second_div_load', 'index_page' );


  // TinyMc function for insert text into second div content
	tinyMc_ajax('#index_info_sub','second_div_text','#second_div_text','inc/modals_dialog.php','#second_div_content','index.php #second_div_load');

/*================================================ 
	Font and background COLOR 
==================================================*/
  // Headline color	
	send_color_into_db('#first_headline_font_color_form','#index_headline_fontColor');

  // FIRST DIV headline content color
	send_color_into_db('#index_first_div_font_color_form','#index_first_div_fontColor');

  // FIRST DIV headline background color	
	send_color_into_db('#index_background_first_div_font_color_form','#index_first_div_background_fontColor');

  // SECOND DIV headline font color
	send_color_into_db('#index_headline_second_div_font_color_form','#index_second_div_fontColor');
	
  // SECOND DIV content font color
	send_color_into_db('#index_content_second_div_font_color_form','#index_second_div_content_fontColor');
	
  // SECOND DIV background color
	send_color_into_db('#index_background_second_div_font_color_form','#index_second_div_background_fontColor');
	
/*================================================ 		
	FONT WEIGHT AND TYPE (STYLE) 	
==================================================*/
  // First div HEADLINE font_weight and type
	send_info_into_db('#index_headline_font_weight_style_form','#index_headline','index.php #index_headline_container','#index_headline_fontWeight');

  // First div CONTENT font weight and type. That is name of company... 
	send_info_into_db('#first_div_headline_form','#first_div_text','index.php #first_div_container','#first_div_headline');
	
  // Second div HEADLINE font_weight and type
	send_info_into_db('#second_div_headline_form','#second_div','index.php #second_div_headline','#second_div_headline');
	
  // Second div CONTENT font_weight and type
	send_info_into_db('#second_div_content_form','#second_div_content','index.php #second_div_load','#second_div_content_font_weight');





	
/*=============================================================== PAGE "ABOUT.PHP" ===============================================================*/		
				/*================================================ 
					SENDING INFO INTO DATABASE AND UPDATE INFORMATION 
				==================================================*/
  //tinyMc - send business_info content into database
	tinyMc_ajax('#business_info_sub','businessInfo','#businessInfo','inc/modals_dialog.php','#business_info_base','about.php #bi_base_container');
	
  // tinyMc - send our_team content into database		
	tinyMc_ajax('#team_info_sub','teamInfo','#teamInfo','inc/modals_dialog.php','#our_team_container_for_font_color','about.php #our_team_edit');
	
  // Send information about left image (show_hide) COLUMN from FORM 
	send_info_into_db('#show_or_hide_left_image','#image_container','about.php #hide_img','#business_infoImg');

  // Send information into our_team_show_picture COLUMN from FORM 
	send_info_into_db('#visibility_our_team_pictures','#our_team','about.php #our_team_content_container','#our_teamImg');
	
  // Send information into our_team_show_div COLUMN from FORM 
	send_info_into_db('#visibility_our_team','#our_team_whole','about.php #our_team_container','#our_teamPart');

					/*================================================ 		
						CHANGE COLOR 	
					==================================================*/
  // HEADLINE FONT COLOR 	
	send_color_into_db('#headline_font_color_form','#headline_fontColor');
	
  // MAIN MENU FONT COLOR 	
	send_color_into_db('#main_manu_font_color_form','#top_menuColor');

  // MAIN MENU BACKGROUND COLOR 	
	send_color_into_db('#main_menu_background_form','#top_menuBackgroundColor');
	 
  // Business info HEADLINE FONT COLOR 	
	send_color_into_db('#business_info_headline_font_color_form','#business_infoHeadColor');
	
  // Business info DIV FONT COLOR 
	send_color_into_db('#business_info_font_color_form','#business_infoColor');	
	
  // Business info DIV BACKGROUND COLOR 	
	send_color_into_db('#business_info_bg_color_form','#business_infoBgColor');
	
  // OUR TEAM headline font color 
	send_color_into_db('#our_team_headline_font_color_form','#our_team_headlineColor');
	
  // OUR TEAM div font(text) color 	
	send_color_into_db('#our_team_div_text_color_form','#our_team_textColor');
	
  // OUR TEAM div BACKGROUND color 
	send_color_into_db('#our_team_bg_color_form','#our_team_backgroundColor');	

			/*================================================
				CHANGE FONT TYPE, STYLE AND WEIGHT.
				In next cases, we are using function
				"send_info_into_db". This function is defined
				in top of this page!
			==================================================*/	
																									
  // HEADLINE font weight and type(style).  	
	send_info_into_db('#headline_font_weight_style_form','#headline','about.php #headline_container','#headline_fontWeight');
	
  // TOP MENU font weight and type(style) 	
	send_info_into_db('#select_text_weight_type_main_menu_form','#main_menu_font_color','about.php #top_menu_container','#top_menu_headlineFont');	

  // BUSINESS_INFO HEADLINE font weight and type(style) 	
	send_info_into_db('#business_info_headline_form','#info_head','about.php #headlineBI','#business_infoTop');		

  // BUSINES_INFO CONTENT font weight and type(style) 		
	send_info_into_db('#business_info_content_weight_type','#business_info_base','about.php #bi_base_container','#business_infoWeight');		
	
  // OUR_TEAM HEADLINE font weight and type(style) 		
	send_info_into_db('#our_team_headline_weight_form','#headline2','about.php #our_team_headline_container','#our_team_HeadlineWeight');

  // OUR_TEAM CONTENT (DIV) font weight and type(style) 		
	send_info_into_db('#our_team_text_weight_form','#our_team_container_for_font_color','about.php #our_team_edit','#our_team_content_fontWeight');
	




/*=============================================================== PAGE "GALLERY.PHP" ===============================================================*/	
  // OWL Slider
  	owl_slider();
  // PAGINATION for deleting more articles
	ajax_pagination('#articles_delete_container', '.pagination a', '#articles_delete_container','gallery.php?page=', ' #show_articles_for_delete', '#articles_delete_table', ' .gallery_slelect_all', ' .gallery_each_box','.delete_articles');

  // SELECT ALL BOXES (CHECK ALL)
	select_all_boxes('.gallery_slelect_all', '.gallery_each_box');
	
  // gallery HEADLINE - change font weight and font type (style)
	send_info_into_db('#gallery_headline_font_weight_style_form','#gallery_headline','gallery.php #gallery_headline_container','#gallery_headline_fontWeight');

  // gallery HEADLINE - change font color
	send_color_into_db('#gallery_headline_font_color_form','#gallery_headline_fontColor');
	
  // CAROUSEL SLIDER - change font weight and font type (style)
	send_info_into_db('#gallery_carousel_font_weight_style_form','#carousel_container','gallery.php #assortment','#gallery_carousel_fontWeight');

  // CAROUSEL SLIDER - change font color
	send_color_into_db('#gallery_carouselFontColor_form','#gallery_carouselFontColor');

  // CAROUSEL SLIDER - change background color
	send_color_into_db('#gallery_carouselBackgroundColor_form','#gallery_carouselBackgroundColor');

  // FIRST DIV headline - change font weight and style (type)
	send_info_into_db('#gallery_firstDiv_font_weight_style_form','#mainDiv_headline','gallery.php #assortment-mainDiv','#gallery_firstDiv_fontWeight');

  // FIRST DIV headline - change font color
	send_color_into_db('#gallery_first_div_fontColor_form','#gallery_first_div_fontColor');

  // FIRST DIV CONTENT - change font weight and font type 
	send_info_into_db('#gallery_firstDiv_content_font_weight_style_form','#text_offer','gallery.php #span_into_text','#gallery_firstDiv_content_fontWeight');
	
  // FIRST DIV CONTENT - change font color
	send_color_into_db('#gallery_first_div_content_fontColor_form','#gallery_first_div_content_fontColor');
	
  // FIRST DIV CONTENT - change background color
	send_color_into_db('#gallery_first_div_background_fontColor_form','#gallery_first_div_background_fontColor');




/*=============================================================== PAGE "PREVIEW.PHP" ===============================================================*/	
  // Insert marks and comment about article from client
	insert_marks_and_comment('#preview_marks_comment_form');	
	
  // Insert or Update info about specify article...
	tinyMcArticle_ajax('#submit_edit_article','article_details_info','#article_details_info', '#article_id_details', 'inc/modals_dialog.php','#edit_article_container',' #edit_article_info');

  // PREVIEW HEADLINE - send info about font weight and style into database...
	send_info_into_db('#preview_headline_font_weight_style_form','#preview_headline_container','preview.php #preview_headline','#preview_headline_fontWeight');

  // PREVIEW HEADLINE - send font color info for HEADLINE
	send_color_into_db('#preview_headline_font_color_form','#preview_headline_fontColor');

  // PREVIEW DIV CONTENT - change background color
	send_color_into_db('#preview_background_font_color_form','#preview_background_fontColor');

  // PREVIEW DIV SHOW/HIDE - show or hide rating	
	send_specific_info_into_db('#article_marks_part_form');

	
  // PREVIEW SPECIFICATION - change font weight and font style... In this exapmle,
  // We are using specific function - defined in part "PREVIEW" in js file: "change_font_style_type_bg_color_functions.js"
	send_sepcific_weight_type_info('#preview_specifications_font_weight_style_form','#edit_article_container',' #edit_article_info', ' #preview_specifications_fontWeight');

	
  // CHANGE FONT COLOR 
	send_color_into_db('#preview_specifications_font_color_form','#preview_specifications_fontColor');

  // CHANGE BACKGROUND COLOR
	send_color_into_db('#preview_specifications_backgroundColor_form','#preview_specifications_backgroundColor');

  // PREVIEW DIV SHOW/HIDE - show or hide Rating form	
	send_specific_info_into_db('#article_customers_marks_part_form');

  // PREVIEW DIV SHOW/HIDE - show or hide Comments Part	
  	send_specific_info_into_db('#article_comments_part_form');

  // PREVIEW COMMENTS - Send info about Headline Title Color for COMMENT Title
  	send_color_into_db('#preview_commentsHeadline_font_color_form','#preview_commentsHeadline_fontColor');

  // PREVIEW COMMENTS - Send Font Weight and Style info
  	send_sepcific_weight_type_info('#preview_commentsHeadline_font_weight_style_form','#comments_container',' #comments_headline', ' #preview_commentsHeadline_fontWeight');

  // PREVIEW COMMENTS - Send info about CONTET Color for COMMENT
  	send_color_into_db('#preview_comments_font_color_form','#preview_comments_fontColor');

  // PREVIEW COMMENTS - Send info about CONTET BACKGROUND Color for COMMENT
  	send_color_into_db('#preview_comments_background_color_form','#preview_comments_backgroundColor');

  // PREVIEW COMMENTS - Send CONTENT Font Weight and Style info
  	send_sepcific_weight_type_info('#preview_commentsContent_font_weight_style_form','#comment-content-container',' #comment-content', ' #preview_comments_fontWeight');

  // Pagination for Comments
	specific_pagination('#comments_div', ' .pagination a', '.pagination', '.big-comment-div', 'preview.php?article_id=', 'page', ' .comments-container' );

  // Pagination for Delete Images (if user has more images for one article)
  	specific_pagination('#preview_page_details', ' .pagination a', '.pagination', '.preview_deleteImage_container', 'preview.php?article_id=', 'pagemodal', ' .show_article_img_for_delete', '.selectAllPreviewImgs', '.previewImgsDelete' );

  // Select All Preview Images from One page (pagination page)
  	select_all_boxes('.selectAllPreviewImgs', '.previewImgsDelete');




/*=============================================================== FILE "CONTACT.PHP" ===============================================================*/	
// Hide and show form for insert new addresses	
	toggle_div_into_modal('#hide_div','#press');

// When user click on "Pošaljite nam poruku", CONTACT FORM WILL BE OPEN
	toggle_div_into_modal('#contact_form_container','#contact_us');

// Change (update) contact information (modal form called on right menu click "Uredite kontakt informacije")...
	change_contact_info();
	

/*================================================ 
	Font and background COLOR 
==================================================*/
  // Headline color	
	send_color_into_db('#contact_headline_font_color_form','#contact_headline_fontColor');

  // First div Headline color
	send_color_into_db('#contact_headline_first_div_font_color_form','#contact_headline_first_div_fontColor');

  // First div font color
	send_color_into_db('#contact_content_first_div_font_color_form','#contact_first_div_content_fontColor');

  // First div background color
	send_color_into_db('#content_background_first_div_font_color_form','#content_first_div_background_fontColor');
	
/*================================================ 
	Font weight and font style (type)
==================================================*/	
  // Headline font weight and font type	
	send_info_into_db('#contact_headline_font_weight_style_form','#first_div_contact_text_container','contact.php #first_div_contact_text','#contact_headline_fontWeightStyle');	

  // First div headline font weight and font type
	send_info_into_db('#contact_headline_first_div_headline_form','#first_div_contact','contact.php #company_location_headline','#contact_headline_first_div');
	
  // First div content font weight and font type
	send_info_into_db('#first_div_content_form','#address_info_div','contact.php #address_info_div','#contact_first_div_content_FontWeight');
	
/*================================================
 	SHOW / HIDE contact form div 
 =================================================*/
  // Show or hide div for contact
	send_info_into_db('#visibility_contact_form','#contact_form_container','contact.php #contact_form_load','#contact_form_hide_show');
	
	


});