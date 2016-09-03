<?php include("inc/init.php"); ?>
<?php
if(!$session->session_status()){
	redirect("../login.php");
}

 include("inc/functions/pages_functions/boxes.php"); 
 
 // HEADLINE font weight and style 
	font_weight_and_style("index_headline_fontWeight","index_headline_font_weight_style_form","inc/pages/pages_insert_info.php", "first_headline_font_weight", "index_headline_font_weight_data", "first_headline_font_type", "index_headline_font_type_data", "index_sub_headlineWeight");
 
 // HEADLINE font COLOR 
	background_and_font_color("index_page", "index_headline_fontColor","first_headline_font_color_form","inc/pages/pages_insert_info.php","index_headline_font_color_ajax","first_headline_font_color","index_color_pickerHeadline"); 
		
 // Main menu FONT COLOR 
	background_and_font_color("index_page", "top_menuColor","main_manu_font_color_form","inc/pages/pages_insert_info.php","submit_topmenuColor","menu_text_color","change_text_color_main_menu"); 
	
 // Main menu BACKGROUND COLOR 
	background_and_font_color("index_page", "top_menuBackgroundColor","main_menu_background_form","inc/pages/pages_insert_info.php","submit_topmenuBgColor","menu_bg_color","color_pickerBgTopmenu"); 
	
 // Main menu HEADLINE weight and style 
	font_weight_and_style("top_menu_headlineFont","select_text_weight_type_main_menu_form","inc/pages/pages_insert_info.php","menu_text_weight","menu_text_weight_data","menu_text_type","menu_text_type_data","sub_top_menu_headlineFont");
	
 // First div FONT weight and style 	
	font_weight_and_style("first_div_headline","first_div_headline_form","inc/pages/pages_insert_info.php","first_div_font_weight","first_div_headline_weight_data","first_div_font_type","first_div_type_data","sub_first_div_headline");

 // First div FONT COLOR 
	background_and_font_color("index_page", "index_first_div_fontColor","index_first_div_font_color_form","inc/pages/pages_insert_info.php","index_first_div_font_color_ajax","first_div_font_color","index_color_picker_firstDiv"); 

 // First div BACKGROUND COLOR 
	background_and_font_color("index_page", "index_first_div_background_fontColor","index_background_first_div_font_color_form","inc/pages/pages_insert_info.php","index_first_div_background_font_color_ajax","first_div_background_color","index_color_picker_background_firstDiv"); 
	
	
 // Second div HEADLINE FONT weight and style 
	font_weight_and_style("second_div_headline","second_div_headline_form","inc/pages/pages_insert_info.php","second_headline_font_weight","second_div_headline_weight_data","second_headline_font_type","second_div_type_data","sub_second_div_headline");

 // Second div HEADLINE FONT COLOR 
	background_and_font_color("index_page", "index_second_div_fontColor","index_headline_second_div_font_color_form","inc/pages/pages_insert_info.php","index_second_div_font_color_ajax","second_headline_font_color","index_color_picker_secondDiv"); 
	

 // Second div content FONT weight and style 
	font_weight_and_style("second_div_content_font_weight","second_div_content_form","inc/pages/pages_insert_info.php","second_div_font_weight","second_div_content_weight_data","second_div_font_type","second_div_content_type_data","sub_second_div_content");

 // Second div content FONT COLOR 
	background_and_font_color("index_page", "index_second_div_content_fontColor","index_content_second_div_font_color_form","inc/pages/pages_insert_info.php","index_second_div_content_font_color_ajax","second_div_font_color","index_color_picker_content_secondDiv"); 
	
 // Second div content BACKGROUND COLOR 
	background_and_font_color("index_page", "index_second_div_background_fontColor","index_background_second_div_font_color_form","inc/pages/pages_insert_info.php","index_second_div_background_font_color_ajax","second_div_background_color","index_color_picker_background_secondDiv"); 
 
 
 ?>