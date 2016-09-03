<?php include("inc/init.php"); ?>
<?php
	if(!$session->session_status()){
		redirect("../login.php");
	}


 include("inc/functions/pages_functions/boxes.php"); 
 
// Headline font weight and type - contact page.
	font_weight_and_style("contact_headline_fontWeightStyle","contact_headline_font_weight_style_form","inc/pages/pages_insert_info.php", "first_headline_content_weight", "contact_headline_font_weight_data", "first_headline_content_type", "contact_headline_font_type_data", "contact_sub_headlineWeight");

// Headline font color
	background_and_font_color("contact_page_css", "contact_headline_fontColor","contact_headline_font_color_form","inc/pages/pages_insert_info.php","contact_headline_font_color_ajax","first_headline_content_font_color","contact_color_pickerHeadline"); 
		
	
// Main menu FONT COLOR 
	background_and_font_color("contact_page_css", "top_menuColor","main_manu_font_color_form","inc/pages/pages_insert_info.php","submit_topmenuColor","menu_text_color","change_text_color_main_menu"); 
	
// Main menu BACKGROUND COLOR 
	background_and_font_color("contact_page_css", "top_menuBackgroundColor","main_menu_background_form","inc/pages/pages_insert_info.php","submit_topmenuBgColor","menu_bg_color","color_pickerBgTopmenu"); 
	
// Main menu HEADLINE weight and style 
	font_weight_and_style("top_menu_headlineFont","select_text_weight_type_main_menu_form","inc/pages/pages_insert_info.php","menu_text_weight","menu_text_weight_data","menu_text_type","menu_text_type_data","sub_top_menu_headlineFont");

	
	
// First div HEADLINE, change font weight and style
	font_weight_and_style("contact_headline_first_div","contact_headline_first_div_headline_form","inc/pages/pages_insert_info.php","first_div_headline_font_weight","contact_first_div_headline_font_weight_data", "first_div_headline_font_type","contact_first_div_headline_font_type_data", "sub_first_div_headline_fontColorWeight");

// First div HEADLINE, font color	
	background_and_font_color("contact_page_css", "contact_headline_first_div_fontColor","contact_headline_first_div_font_color_form","inc/pages/pages_insert_info.php","contact_headline_first_div_font_color_ajax","first_div_headline_font_color","contact_headline_color_picker_firstDiv"); 

	
	
// First div - content font weight and style
	font_weight_and_style("contact_first_div_content_FontWeight","first_div_content_form","inc/pages/pages_insert_info.php", "first_div_content_font_weight","first_div_content_font_weight_data","first_div_content_font_type","first_div_content_font_type_data","sub_first_div_content");

// First div - content font color
	background_and_font_color("contact_page_css", "contact_first_div_content_fontColor","contact_content_first_div_font_color_form","inc/pages/pages_insert_info.php","contact_first_div_content_font_color_ajax","first_div_content_font_color","contact_color_picker_contentFontColor"); 
	
// First div - BACKGROUND color
	background_and_font_color("contact_page_css", "content_first_div_background_fontColor","content_background_first_div_font_color_form","inc/pages/pages_insert_info.php","content_first_div_background_font_color_ajax", "first_div_content_background_color","content_color_picker_background_firstDiv"); 
	
// Contact page - show or hide first div (div with contact FORM)
	show_or_hide_part("contact_form_hide_show","visibility_contact_form","inc/pages/pages_insert_info.php","contact_form_show_part","show_hide_second_div_contact","sub_contact_form"); 


	
	
	



	
	
	

	
?>

</body>
</html>
	