<?php include("inc/init.php"); ?>
<?php
	if(!$session->session_status()){
		redirect("../login.php");
	}
?>


<?php 
 include("inc/functions/pages_functions/boxes.php"); 
 
	// Headline font weight and style 
	font_weight_and_style("headline_fontWeight","headline_font_weight_style_form","inc/pages/pages_insert_info.php", "headline_font_weight", "headline_font_weight_data", "headline_font_type", "headline_font_type_data", "sub_headlineWeight");
 
	// Headline font COLOR 
	background_and_font_color("about_us", "headline_fontColor","headline_font_color_form","inc/pages/pages_insert_info.php","headline_font_color_ajax","headline_font_color","color_pickerHeadline"); 
		
	// Main menu font COLOR 
	background_and_font_color("about_us", "top_menuColor","main_manu_font_color_form","inc/pages/pages_insert_info.php","submit_topmenuColor","menu_text_color","change_text_color_main_menu"); 
	
	// Main menu background COLOR 
	background_and_font_color("about_us", "top_menuBackgroundColor","main_menu_background_form","inc/pages/pages_insert_info.php","submit_topmenuBgColor","menu_bg_color","color_pickerBgTopmenu"); 

	// Main menu headline weight and style 
	font_weight_and_style("top_menu_headlineFont","select_text_weight_type_main_menu_form","inc/pages/pages_insert_info.php","menu_text_weight","menu_text_weight_data","menu_text_type","menu_text_type_data","sub_top_menu_headlineFont");
	
	// Business info headline font weight and style 
	font_weight_and_style("business_infoTop","business_info_headline_form","inc/pages/pages_insert_info.php","business_info_weight","business_info_weight_data","business_info_type","business_info_type_data","sub_businessInfo");

	// Business info headline COLOR 
	background_and_font_color("about_us", "business_infoHeadColor","business_info_headline_font_color_form","inc/pages/pages_insert_info.php","submit_business_info_headlineColor","business_info_color","color_pickerBusinessInfoHeadline"); 

	// Business info font weight and font style 
	font_weight_and_style("business_infoWeight","business_info_content_weight_type","inc/pages/pages_insert_info.php","business_info_content_weight","business_info_content_weight_data","business_info_content_type","business_info_content_type_data","sub_businessInfoWeight"); 
	
	// Business info content COLOR 
	background_and_font_color("about_us", "business_infoColor","business_info_font_color_form","inc/pages/pages_insert_info.php","submit_busines_info_textColor","business_info_content_color","color_pickerBusinessInfoBg"); 

	// Business info background of content COLOR 
	background_and_font_color("about_us", "business_infoBgColor","business_info_bg_color_form","inc/pages/pages_insert_info.php","submit_busines_info_BgColor","business_info_content_bgcolor","color_pickerBusinessInfo"); 

	// Show or hide LEFT IMAGE in business_info div 
	show_or_hide_part("business_infoImg","show_or_hide_left_image","inc/pages/pages_insert_info.php","show_left_image_or_hide","business_info_leftImg","sub_info_about_leftImg"); 
	
	// Show or hide OUR_TEAM DIV  
	show_or_hide_part("our_teamPart","visibility_our_team","inc/pages/pages_insert_info.php","our_team_visible","our_team_show_div","sub_our_team"); 

	// Our team headline font weight and style 
	font_weight_and_style("our_team_HeadlineWeight","our_team_headline_weight_form","inc/pages/pages_insert_info.php","our_team_headline_fontweight","our_team_headline_fontweight_data","our_team_headline_fonttype","our_team_headline_fonttype_data","sub_weight_ourteamHeadline");

	// Our team headline font COLOR 	
	background_and_font_color("about_us", "our_team_headlineColor","our_team_headline_font_color_form","inc/pages/pages_insert_info.php","submit_our_team_headline_fontcolor","our_team_headline_fontcolor","sub_headline_colorOurTeam"); 

	// Our team content font weight and type 	
	font_weight_and_style("our_team_content_fontWeight","our_team_text_weight_form","inc/pages/pages_insert_info.php","our_team_div_font_weight","our_team_div_font_weight_data","our_team_div_font_type","our_team_div_font_type_data","sub_weight_ourteam_content");

	// Our team content font COLOR 	
	background_and_font_color("about_us", "our_team_textColor","our_team_div_text_color_form","inc/pages/pages_insert_info.php","submit_our_team_content_font_color","our_team_div_text_color","sub_text_content_colorOurTeam"); 
	
	// Our team content background COLOR 	
	background_and_font_color("about_us", "our_team_backgroundColor","our_team_bg_color_form","inc/pages/pages_insert_info.php","submit_our_team_content_background_color","our_team_div_bg_color","sub_content_background_colorOurTeam"); 
	
	// Our team SHOW/HIDE images (biography)  
	show_or_hide_part("our_teamImg","visibility_our_team_pictures","inc/pages/pages_insert_info.php","show_hide_ourteam_images","our_team_show_picture","sub_our_team"); 
	
?>


