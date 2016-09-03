$(document).ready(function(){
/*=============================================================== BOXES FOR PAGE "INDEX.PHP" ===============================================================*/
  // Headline box change font weight - right click
	index_two_parametars("#index_hl_weight","#index_headline_fontWeight","#index_hl_color");
	
  // Headline box change font color - right click
	index_two_parametars("#index_hl_color","#index_headline_fontColor","#index_hl_weight");	
	
  // First div change font weight and style
	index_three_parametars("#index_first_div_font_weight","#first_div_headline","#index_first_div_font_color","#index_first_div_background_color");
	
  // First div change font color
	index_three_parametars("#index_first_div_font_color","#index_first_div_fontColor","#index_first_div_font_weight","#index_first_div_background_color");		
	
  // First div change background color 
	index_three_parametars("#index_first_div_background_color","#index_first_div_background_fontColor","#index_first_div_font_weight","#index_first_div_font_color");		
	
  // Second div change HEADLINE font weight and font type 	
	index_two_parametars("#index_second_div_font","#second_div_headline","#index_second_div_color");	
	
  // Second div change HEADLINE font color 	
	index_two_parametars("#index_second_div_color","#index_second_div_fontColor","#index_second_div_font");	
	
  // Second div change CONTENT font weight and type 	
	index_four_parametars("#index_second_div_content_font_weight","#second_div_content_font_weight","#index_second_div_content_font_color","#index_second_div_background_color","#edit_index_second_div_content");	
		
  // Second div change CONTENT font color 	
	index_four_parametars("#index_second_div_content_font_color","#index_second_div_content_fontColor","#index_second_div_content_font_weight","#index_second_div_background_color","#edit_index_second_div_content");	
	
  // Second div change BACKGROUND font color 	
	index_four_parametars("#index_second_div_background_color","#index_second_div_background_fontColor","#index_second_div_content_font_weight","#index_second_div_content_font_color","#edit_index_second_div_content");	
		

															 
/*=============================================================== BOXES FOR PAGE "ABOUT.PHP" ===============================================================*/

  // Headline box change font weight - right click 
	about_two_parametars("#hl_weight","#headline_fontWeight","#hl_color");
	
  // Headline box change font color - right click 
	about_two_parametars("#hl_color","#headline_fontColor","#hl_weight");
	
	
		/*=================================================================
			Top menu is loaded here. We are using them in all pages... 
		===================================================================*/


  // Top Menu change font color - right click 
	about_three_parametars('#top_menu_color','#top_menuColor','#top_menu_background','#top_menu_font');

  // Top Menu change background color - right click 
	about_three_parametars('#top_menu_background','#top_menuBackgroundColor','#top_menu_font','#top_menu_color');

  // Top Menu font weight and type - right click 
	about_three_parametars('#top_menu_font','#top_menu_headlineFont','#top_menu_background','#top_menu_color');

		
  // Business Info HEADLINE font weight and type 
	about_two_parametars('#business_headline_weight','#business_infoTop','#business_headline_color');

  // Business Info HEADLINE COLOR 
	about_two_parametars('#business_headline_color','#business_infoHeadColor','#business_headline_weight');


  // Business Info font weight and type in contetnt 
	about_six_parametars('#business_info_weight','#business_infoWeight','#edit_text','#business_info_color','#business_info_BgColor','#radio_button','#turn_on_off');
	
  // Business Info COLOR - content 
	about_six_parametars('#business_info_color','#business_infoColor','#business_info_BgColor','#business_info_weight','#edit_text','#radio_button','#turn_on_off');

  // Business Info BACKGROUND COLOR - content 
	about_six_parametars('#business_info_BgColor','#business_infoBgColor','#business_info_color','#business_info_weight','#edit_text','#radio_button','#turn_on_off');

  // Business Info RADIO BUTTON 
	about_six_parametars('#radio_button','#business_infoImg','#business_info_color','#business_info_weight','#edit_text','#business_info_BgColor','#turn_on_off');
	
	
  // OUR TEAM headline - font weight and font type 
	about_two_parametars('#our_team_headline_weight','#our_team_HeadlineWeight','#our_team_headline_color');

  // OUR TEAM headline - font weight and font type 
	about_two_parametars('#our_team_headline_color','#our_team_headlineColor','#our_team_headline_weight');



  // OUR TEAM CONTENT - change font weight and type 
	about_six_parametars('#our_team_info_weight','#our_team_content_fontWeight','#edit_our_team','#our_team_divContent_color','#our_team_background_color','#show_hideImg','#biography');

  // OUR TEAM CONTENT - change text color 
	about_six_parametars('#our_team_divContent_color','#our_team_textColor','#edit_our_team','#our_team_info_weight','#our_team_background_color','#show_hideImg', '#biography');
	
  // OUR TEAM BACKGROUND - change background color 
	about_six_parametars('#our_team_background_color','#our_team_backgroundColor','#edit_our_team','#our_team_info_weight','#our_team_divContent_color','#show_hideImg','#biography');

  // Show or Hide images - OUR TEAM 
	about_six_parametars('#show_hideImg','#our_teamImg','#edit_our_team','#our_team_info_weight','#our_team_divContent_color','#our_team_background_color', '#biography');

  // Show or Hide WHOLE PART - OUR TEAM 
	about_six_parametars('#turn_on_off','#our_teamPart','#edit_text','#business_info_color','#business_info_BgColor','#radio_button','#business_info_weight', '#biography');






/*=============================================================== BOXES FOR PAGE "gallery.PHP" ===============================================================*/
  // HEADLINE font weight and type (style)
	gallery_two_parametars('#gallery_hl_weight','#gallery_headline_fontWeight','#gallery_hl_color');

  // HEADLINE font color
	gallery_two_parametars('#gallery_hl_color','#gallery_headline_fontColor','#gallery_headline_fontWeight');

  // CAROUSEL SLIDER - gallery
	gallery_three_parametars('#gallery_carousel_weight','#gallery_carousel_fontWeight','#gallery_carousel_color','#gallery_carousel_text_color');
	
  // CAROUSEL SLIDER font color
	gallery_three_parametars('#gallery_carousel_color','#gallery_carouselFontColor','#gallery_carousel_weight','#gallery_carousel_text_color');
	
  // CAROUSEL SLIDER background color
	gallery_three_parametars('#gallery_carousel_text_color','#gallery_carouselBackgroundColor','#gallery_carousel_weight','#gallery_carousel_color');
					
  // FIRST DIV HEADLINE font weight and type (style)					
	gallery_three_parametars('#gallery_mainDiv_weight','#gallery_firstDiv_fontWeight','#gallery_mainDiv_color');
					
  // FIRST DIV HEADLINE font color
	gallery_two_parametars('#gallery_mainDiv_color','#gallery_first_div_fontColor','#gallery_mainDiv_weight');					

	
  // FIRST (MAIN) DIV font weight and type -style
	gallery_six_parametars('#gallery_main_div_weight','#gallery_firstDiv_content_fontWeight','#add_product_content','#edit_product_content','#delete_product_content','#gallery_main_div_fontColor','#gallery_main_div_backgroundColor');
		
  // FIRST (MAIN) DIV font color
	gallery_six_parametars('#gallery_main_div_fontColor','#gallery_first_div_content_fontColor','#add_product_content','#edit_product_content','#delete_product_content','#gallery_main_div_weight','#gallery_main_div_backgroundColor');
	
  // FIRST (MAIN) DIV background color
	gallery_six_parametars('#gallery_main_div_backgroundColor','#gallery_first_div_background_fontColor','#add_product_content','#edit_product_content','#delete_product_content','#gallery_main_div_weight','#gallery_main_div_fontColor');
		






/*=============================================================== BOXES FOR PAGE "PREVIEW.PHP" ===============================================================*/
  // Headline - change font weight and font style (type)
	preview_two_parametars('#preview_hl_weight','#preview_headline_fontWeight','#preview_hl_color');

  // Headline - change font color
	preview_two_parametars('#preview_hl_color','#preview_headline_fontColor','#preview_hl_weight'); 

  // Background COLOR for FIRST DIV (CONTENT)
	preview_four_parametars('#preview_first_div_bg_color','#preview_background_fontColor','#add_product_content','#delete_product_content','#preview_first_div_show_hide');

  // SHOW OR HIDE marks
	preview_four_parametars('#preview_first_div_show_hide', '#article_marks_part', '#add_product_content','#delete_product_content', '#preview_first_div_bg_color');

  // PART "SPECIFIKACIJE" font weight and style (type)
	preview_six_parametars('#preview_specifications_font_weight_type', '#preview_specifications_fontWeight', '#preview_specifications_text_color','#preview_specifications_background_color', '#preview_specifications_show_hide', '#preview_comments_show_hide');

  // PART "SPECIFIKACIJE" font color
	preview_six_parametars('#preview_specifications_text_color', '#preview_specifications_fontColor', '#preview_specifications_font_weight_type','#preview_specifications_background_color', '#preview_specifications_show_hide', '#preview_comments_show_hide');

  // PART "SPECIFIKACIJE" background color
	preview_six_parametars('#preview_specifications_background_color', '#preview_specifications_backgroundColor', '#preview_specifications_font_weight_type','#preview_specifications_text_color', '#preview_specifications_show_hide', '#preview_comments_show_hide');

  // PART "SPECIFIKACIJE" show or hide option for coustomers (give mark) "Ocena artikla"
	preview_six_parametars('#preview_specifications_show_hide', '#article_customers_marks_part', '#preview_specifications_background_color','#preview_specifications_font_weight_type', '#preview_specifications_text_color', '#preview_comments_show_hide');

  // PART "SPECIFIKACIJE" show or hide Comments
	preview_six_parametars('#preview_comments_show_hide', '#article_comments_part', '#preview_specifications_background_color','#preview_specifications_font_weight_type', '#preview_specifications_text_color', '#preview_specifications_show_hide');

  // PART "KOMENTARI" (Title) Change font color
  	preview_two_parametars('#preview_comment_hl_color','#preview_commentsHeadline_fontColor','#preview_comment_hl_weight');

  // PART "KOMENTARI" (Title) Change font weight/style
  	preview_two_parametars('#preview_comment_hl_weight', '#preview_commentsHeadline_fontWeight', '#preview_comment_hl_color');

  // PART "KOMENTARI" (Content) Change font color
  	preview_three_parametars('#preview_comment_color','#preview_comments_fontColor','#preview_comment_weight','#preview_comment_background_color');
	
  // PART "KOMENTARI" (Content) Change background color
  	preview_three_parametars('#preview_comment_background_color','#preview_comments_backgroundColor','#preview_comment_weight','#preview_comment_color');
	
  // PART "KOMENTARI" (Content) Change background color
  	preview_three_parametars('#preview_comment_weight','#preview_comments_fontWeight','#preview_comment_background_color','#preview_comment_color');
	



/*=============================================================== BOXES FOR PAGE "CONTACT.PHP" ===============================================================*/

  // Contact page - headline font weight and font type
	contact_two_parametars('#contact_hl_weight','#contact_headline_fontWeightStyle','#contact_hl_color');

  // Contact page - headline font type 
	contact_two_parametars('#contact_hl_color','#contact_headline_fontColor','#contact_hl_weight');

  // Contact page - first div headline parametars
	contact_two_parametars('#contact_first_div_weight','#contact_headline_first_div','#contact_first_div_color');

  // Contact page - first div headline font color
	contact_two_parametars('#contact_first_div_color','#contact_headline_first_div_fontColor','#contact_first_div_weight');
	
  // Contact page - font weight and type 
	contact_five_parametars('#contact_first_div_content_font_weight','#contact_first_div_content_FontWeight','#contact_first_div_content_font_color','#contact_first_div_background_color','#contact_show_hide','#remodal_update_contact_info');

  // Contact page - font color
	contact_five_parametars('#contact_first_div_content_font_color','#contact_first_div_content_fontColor','#contact_first_div_content_font_weight','#contact_first_div_background_color','#contact_show_hide','#remodal_update_contact_info');

  // Contact page - background color
	contact_five_parametars('#contact_first_div_background_color','#content_first_div_background_fontColor','#contact_first_div_content_font_weight','#contact_first_div_content_font_color','#contact_show_hide','#remodal_update_contact_info');

  // Contact page - show or hide second div (div with contact FORM)
	contact_five_parametars('#contact_show_hide','#contact_form_hide_show','#contact_first_div_content_font_weight','#contact_first_div_content_font_color','#contact_first_div_background_color','#remodal_update_contact_info');



});