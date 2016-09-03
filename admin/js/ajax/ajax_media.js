/*=============================================================== 
	In this file, we are dealing with image functions.
	Functions for RESIZEING images, show or hide left image and 
	COLLECTION resize information are defined in file: 
	"ajax_abut_us.js" We defined all AJAX functions for page 
	"ABOUT.PHP". Now, in this file ("ajax_for_image_functions.js")
	we are dealing with all AJAX methods and functions for IMAGE 
	of ALL PAGES (index.php, about.php, gallery.php, contact.php. 				
===============================================================*/

$(document).ready(function(){


// For All Pages - Show Selected Image (background or image from page about.php - "Informacije o poslovanju")	
	selectImg('.remodal img.thumbnail', '.remodal img', 'thumbnail23');





	// ======================== BACKGROUND IS DEFINED IN PART "INDEX.PHP" =======================================

/*=============================================================== Page: INDEX.PHP ===============================================================*/
  // Insert carousel image into database...		
	carousel_image('#carousel_form','#carousel_uploaded_container','index.php #show_carousel_img_modal');

  // Delete carousel image
	delete_carousel_imgs('.delete_carousel')
	
	

/*=============================================================== Page: ABOUT.PHP ===============================================================*/
  //	RESIZED in about.php page 
	change_image_dimension('#business_info_left_image_dimension','#hide_img','inc/functions/pages_functions/show_files_via_ajax/about_businessInfo_div.php','.submit_img_business_info','#image','inc/pages/pages_insert_media.php','#image_container','about.php #hide_img');
	
  // CHANGE IMAGE - We can choose image in business_info div in page  "about.php" 	
	change_image('.left_image','#change_image_sub','inc/pages/pages_insert_media.php','#image_container','about.php #hide_img');
	
  // Toggle into business_info modal (about.php) 
	toggle_form_into_modal('#hidden_form','#show_hide_btn');
		
  // SHOW all uploaded images in MODAL dialog 			
	instantly_show_image_in_modal('#hidden_form','','#img_uploaded_container','inc/modals_dialog.php #show_uploaded_img_modal','.thumbnail','#change_image_sub','inc/pages/pages_insert_media.php','#image_container','about.php #hide_img');

  // SHOW ALL Uploaded BIOGRAPHY images 	
	upload_biography_images('#biography_form','','#insert_biography_images','inc/modals_dialog.php #show_biography_images','','');
		
  // All activities with biography (change image, delete member, change biography...)  	
	biography_activities();
	
  // DELETE biography for member  
	delete_biography_for_member();
	


/*=============================================================== Page: gallery.PHP ===============================================================*/
  // PAGINATION Function
	gallery_ajax_pagination('#gallery_container', '.pagination a', '#gallery_container','gallery.php?page=', ' #gallery_loader');

  // Insert new article
	insert_article('#add_product_form','#gallery_container','gallery.php #gallery_loader');

  // Delete article - choose button "Obriši" in big box area	
	delete_article('.delete_articles');
	
  // Delete product (service) 
	delete_article_info();

  // Update all info about product(service)
	update_article_info();



/*=============================================================== Page: PREVIEW.PHP ===============================================================*/
  // Insert new image for specify article...
	preview_all_article_imgs('#preview_form_add_new_img');

  // Delete images of specify article...
	delete_preview_article_imgs('.delete_article');






});			