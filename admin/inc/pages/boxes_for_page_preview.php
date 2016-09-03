<?php include("inc/init.php"); ?>
<?php
	if(!$session->session_status()){
		redirect("login.php");
	}

 include("inc/functions/pages_functions/boxes.php"); 
 	
// PREVIEW font weight and font style
	font_weight_and_style("preview_headline_fontWeight","preview_headline_font_weight_style_form","inc/pages/pages_insert_info.php", "preview_headline_font_weight", "preview_headline_font_weight_data", "preview_headline_font_type", "preview_headline_font_type_data", "preview_sub_headlineWeight");

// PREVIEW font color
	background_and_font_color("preview_page", "preview_headline_fontColor","preview_headline_font_color_form","inc/pages/pages_insert_info.php","preview_headline_font_color_data","preview_headline_font_color","preview_color_pickerHeadline"); 


// Main menu font COLOR 
	background_and_font_color("preview_page", "top_menuColor","main_manu_font_color_form","inc/pages/pages_insert_info.php","submit_topmenuColor","menu_text_color","change_text_color_main_menu"); 

// Main menu background COLOR 
	background_and_font_color("preview_page", "top_menuBackgroundColor","main_menu_background_form","inc/pages/pages_insert_info.php","submit_topmenuBgColor","menu_bg_color","color_pickerBgTopmenu"); 

// Main menu headline weight and style 
	font_weight_and_style("top_menu_headlineFont","select_text_weight_type_main_menu_form","inc/pages/pages_insert_info.php","menu_text_weight","menu_text_weight_data","menu_text_type","menu_text_type_data","sub_top_menu_headlineFont");

	
	
	
// PREVIEW CONTENT background color
	background_and_font_color("preview_page", "preview_background_fontColor","preview_background_font_color_form","inc/pages/pages_insert_info.php","preview_background_color_data","preview_content_background_color","preview_color_pickerBackground"); 	
	
// SHOW OR HIDE MARKS
	show_or_hide_part("article_marks_part","article_marks_part_form","inc/pages/pages_insert_info.php","preview_marks_data","preview_content_show_hide","sub_article_marks_part"); 

// 	Specifications FONT weight and font style (type)
	font_weight_and_style("preview_specifications_fontWeight","preview_specifications_font_weight_style_form","inc/pages/pages_insert_info.php", "preview_specifications_font_weight", "preview_specifications_font_weight_data", "preview_specifications_font_type", "preview_headline_specifications_type_data", "preview_sub_specifications");

// Specifications FONT color
	background_and_font_color("preview_page", "preview_specifications_fontColor","preview_specifications_font_color_form","inc/pages/pages_insert_info.php","preview_specifications_color_data","preview_specifications_font_color","preview_specifications_pickerFont"); 	
	
// Specifications BACKGROUND color
	background_and_font_color("preview_page", "preview_specifications_backgroundColor","preview_specifications_backgroundColor_form","inc/pages/pages_insert_info.php","preview_specifications_background_data","preview_specifications_background_color","preview_specifications_pickerBackground"); 	
	
// SHOW OR HIDE OPTION FOR CUSTOMERS TO GIVE OWN MARK
	show_or_hide_part("article_customers_marks_part","article_customers_marks_part_form","inc/pages/pages_insert_info.php","article_customers_marks_data","preview_specifications_show_hide","sub_article_customers_marks_part"); 
	
// SHOW OR HIDE Comments Part
	show_or_hide_part("article_comments_part", "article_comments_part_form", "inc/pages/pages_insert_info.php", "article_customer_comment_data", "preview_comment_show_hide", "sub_preview_comments_part" );
	
// Comments Headline FONT Color
	background_and_font_color("preview_page", "preview_commentsHeadline_fontColor","preview_commentsHeadline_font_color_form","inc/pages/pages_insert_info.php","preview_commentsHeadline_color_data","preview_commentsHeadline_font_color","preview_commentsHeadline_pickerFont"); 

// Comments Headline FONT Weight and Style
	font_weight_and_style("preview_commentsHeadline_fontWeight","preview_commentsHeadline_font_weight_style_form","inc/pages/pages_insert_info.php", "preview_commentsHeadline_font_weight", "preview_commentsHeadline_font_weight_data", "preview_commentsHeadline_font_type", "preview_commentsHeadline_type_data", "preview_sub_commentsHeadline");

// Comments Content FONT Color
	background_and_font_color("preview_page", "preview_comments_fontColor","preview_comments_font_color_form","inc/pages/pages_insert_info.php","preview_comments_color_data","preview_commentsContent_font_color","preview_content_pickerFont"); 

// Comments Content BACKGROUND Color
	background_and_font_color("preview_page", "preview_comments_backgroundColor","preview_comments_background_color_form","inc/pages/pages_insert_info.php","preview_comments_background_data","preview_content_commentBackground_color","preview_content_pickerBackground");

// Comments CONTENT Font Weight and Style
	font_weight_and_style("preview_comments_fontWeight","preview_commentsContent_font_weight_style_form","inc/pages/pages_insert_info.php", "preview_commentsContent_font_weight", "preview_commentsContent_font_weight_data", "preview_commentsContent_font_type", "preview_commentsContent_type_data", "preview_sub_commentsContent");




?>
