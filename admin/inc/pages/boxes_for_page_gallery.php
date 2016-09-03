<?php include("inc/init.php"); ?>
<?php
	if(!$session->session_status()){
		redirect("../login.php");
	}

include("inc/functions/pages_functions/boxes.php"); 
 	
// gallery HEADLINE font weight and font style
	font_weight_and_style("gallery_headline_fontWeight","gallery_headline_font_weight_style_form","inc/pages/pages_insert_info.php", "gallery_headline_font_weight", "gallery_headline_font_weight_data", "gallery_headline_font_type", "gallery_headline_font_type_data", "gallery_sub_headlineWeight");

// gallery HEADLINE font COLOR
	background_and_font_color("gallery_page", "gallery_headline_fontColor","gallery_headline_font_color_form","inc/pages/pages_insert_info.php","gallery_headline_font_color_data","gallery_headline_font_color","gallery_color_pickerHeadline"); 
	


// Main menu font COLOR 
	background_and_font_color("gallery_page", "top_menuColor","main_manu_font_color_form","inc/pages/pages_insert_info.php","submit_topmenuColor","menu_text_color","change_text_color_main_menu"); 

// Main menu background COLOR 
	background_and_font_color("gallery_page", "top_menuBackgroundColor","main_menu_background_form","inc/pages/pages_insert_info.php","submit_topmenuBgColor","menu_bg_color","color_pickerBgTopmenu"); 

// Main menu headline weight and style 
	font_weight_and_style("top_menu_headlineFont","select_text_weight_type_main_menu_form","inc/pages/pages_insert_info.php","menu_text_weight","menu_text_weight_data","menu_text_type","menu_text_type_data","sub_top_menu_headlineFont");

	

// gallery CAROUSEL SLIDER font weight and style 
	font_weight_and_style("gallery_carousel_fontWeight","gallery_carousel_font_weight_style_form","inc/pages/pages_insert_info.php", "gallery_carousel_font_weight", "gallery_carousel_font_weight_data", "gallery_carousel_font_type", "gallery_carousel_font_type_data", "gallery_sub_carouselWeight");

// gallery CAROUSEL SLIDER font color
	background_and_font_color("gallery_page", "gallery_carouselFontColor","gallery_carouselFontColor_form","inc/pages/pages_insert_info.php","submit_galleryCarouselFontColor","gallery_carousel_font_color","color_picker_CarouselFontColor"); 

// gallery CAROUSEL SLIDER background color
	background_and_font_color("gallery_page", "gallery_carouselBackgroundColor","gallery_carouselBackgroundColor_form","inc/pages/pages_insert_info.php","submit_galleryCarouselBackgroundColor","gallery_carousel_background_color","color_picker_CarouselBackgroundColor"); 

// gallery FIRST(MAIN) DIV headline font weight and type
	font_weight_and_style("gallery_firstDiv_fontWeight","gallery_firstDiv_font_weight_style_form","inc/pages/pages_insert_info.php", "gallery_first_div_font_weight", "gallery_firstDiv_font_weight_data", "gallery_first_div_font_type", "gallery_firstDiv_font_type_data", "gallery_sub_firstDiv");

// gallery FIRST (MAIN) DIV headline font color
	background_and_font_color("gallery_page", "gallery_first_div_fontColor","gallery_first_div_fontColor_form","inc/pages/pages_insert_info.php","submit_gallery_first_div_fontColor","gallery_first_div_font_color","color_picker_first_div_fontColor"); 

// gallery FIRST (MAIN) DIV font weight and style
	font_weight_and_style("gallery_firstDiv_content_fontWeight","gallery_firstDiv_content_font_weight_style_form","inc/pages/pages_insert_info.php", "gallery_first_div_content_font_weight", "gallery_firstDiv_content_font_weight_data", "gallery_first_div_content_font_type", "gallery_firstDiv_content_font_type_data", "gallery_sub_content_firstDiv");

// gallery FIRST (MAIN) DIV font color
	background_and_font_color("gallery_page", "gallery_first_div_content_fontColor","gallery_first_div_content_fontColor_form","inc/pages/pages_insert_info.php","submit_gallery_first_div_content_fontColor","gallery_first_div_content_font_color","color_picker_first_div_content_fontColor"); 

// gallery FIRST(MAIN) DIV background color
	background_and_font_color("gallery_page", "gallery_first_div_background_fontColor","gallery_first_div_background_fontColor_form","inc/pages/pages_insert_info.php","submit_gallery_first_div_background_fontColor","gallery_first_div_background_color","color_picker_first_div_background_fontColor"); 

	
	
	
?>