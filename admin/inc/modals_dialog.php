<script type="text/javascript" src="js/plugins/autoNumeric-master/number_separate_jquery.min.js"></script>
<script type="text/javascript" src="js/plugins/autoNumeric-master/autoNumeric.js"></script>
<script type="text/javascript">
jQuery(function($) {
    $('.auto').autoNumeric('init');
});
</script>
<?php
include("init.php");
	if(!$session->session_status()){
		redirect("login.php");
	}
	
	
include("functions/pages_functions/modals.php");


/*======================================================
	MODALS DIALOG FOR LEFT MENU
========================================================*/
// Update Information into Phonebook Contact List
	update_phonebook_contact('phonebook_contact_id');


/*======================================================
	TinyMC Functions
========================================================*/
// TinyMC for page "INDEX.PHP"
	insert_tinyMc_into_db('function_name','content','index_page');
	
// TinyMC for page "ABOUT.PHP"
	insert_tinyMc_into_db('function_name', 'content', 'about_us');
	
// TinyMC for page "PREVIEW.PHP"
	insert_tinyMcArticles_into_db('function_name', 'content', 'article_id', 'article_details');



/*=============================================================== Page: index.php ===============================================================*/
  // Show modal for CAROUSEL images - first div (big courosel slider) ...
	insert_and_show_caurosel_imgs();
	
  // Delete image from caurosel slider
	delete_carousel_images();

  // Show modal in second div
	tinyMc_page_index('remodal_index_first_div','second_div_text','second_div_text','index_info_text','index_info_sub');




/*=============================================================== Page: about.php ===============================================================*/
  // Show modal in business_info
	tinyMc_page_about('remodal_businessInfo','businessInfo','business_info_text','business_info_text','business_info_sub');
 
  // Show modal in our_team 
	tinyMc_page_about('remodal_teamInfo','teamInfo','our_team_text','our_team_text','team_info_sub');
 
  // Show changed image options into business_info DIV 
	show_uploaded_images('remodal_change_image','uploaded_image','uploaded_images','uploaded_img_name','image_path','hidden_form');
	
  // Show modal for adding biography 
	add_form('add_biography');

  // Show modal with all update functionality in our_team div 
	show_uploaded_biography_images('remodal_change_biography_image','selected_id','worker_image','worker_image_path','biography_id','update_biography');
	

	
	
/*=============================================================== Page: gallery.php ===============================================================*/	
  // Add new product (service)	
	add_new_product_in_gallery('remodal_gallery_add_product');
	
  // Update article information...
	update_gallery_info();
	
  // Delete MORE articles...
	delete_more_articles();
	
	

	
/*=============================================================== Page: preview.php ===============================================================*/	
  // Insert new image for specify article...
	preview_insert_new_img();

  // Delete image(s) for specify article...	
	delete_article_images();
	
  // Edit information about specify article (product or service)...
	tinyMc_page_preview('remodal_preview_edit_article_info', 'article_details_info', 'article_specifications', 'article_id', 'article_specifications', 'submit_edit_article');
	



	
/*=============================================================== Page: contact.php ===============================================================*/	
  // Updateing info about address, phone, mobile_phone, e-mail and fax ACCORD contact_id! When user cilck in some address div, AJAX function will take
  // contact_id and forward that id up to this function...
	update_contacts();
		
		
		
		
		
		
		
		
		
?>
