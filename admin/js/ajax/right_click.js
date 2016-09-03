$(document).ready(function(){
/*================================================ 
	Edit body 
==================================================*/
	right_click('#body','body');


/*================================================
	TOP MENU - select topic color and change 
	font weight and style 
==================================================*/
	right_click('#context_top_menu','#top_menu');

	
	
/*=============================================================== 	Page "INDEX.PHP"	===============================================================*/	
  //  Edit headline
	right_click('#index_headline_context','#index_headline');
	
  //  Carousel...
	right_click('#carousel_context_menu','#caurosel_load');
	
  //  Edit first_div	
	right_click('#index_first_div_context','#first_div_text');
	
  //  Sedond div - select topic color and change font weight and style
	right_click('#context_second_div_headline','#second_div');	
	
  //  Second div content - page index.php *****************/
	right_click('#context_second_div_content','#second_div_content');	
	
	

/*===============================================================  Page: "ABOUT.PHP"    ===============================================================*/	
  //  Edit headline 
	right_click('#headline_context','#headline');

  //  Edit Business Info headline 
	right_click('#context_businesInfo_headline','#info_head');

  //  Business Info - description - click on business_info_base div 
	right_click('#context_business_info','#business_info_base');

  //  Business Info - change image...	 
	right_click('#image_context_menu','#image_container');

  //  Our team HEADLINE - right click options 
	right_click('#our_team_headline_context_menu','#headline2');
	
  //  Our team - right click options 
	right_click('#our_team_context_menu','#our_team_whole');
	
  //  Our team - biography images 
	right_click('#our_team_biography_context_menu','.biog_img');
	

/*===============================================================  Page: "gallery.PHP"    ===============================================================*/		

  //  Open page headline options...
	right_click('#gallery_headline_context', '#gallery_headline');
	
  //  Open slider (courosel) options...
	right_click('#gallery_carousel_context','#ocarousel_slider');
	
  //  Open main div HEADLINE...
	right_click('#gallery_mainDiv_headline','#mainDiv_headline');

  //  Open editing options...
	right_click('#context_div_manipulation','#text_offer');

  //  Open special menues for each product (service)
	right_click('#edit_product_info','#gallery_container');
	
	


/*=============================================================== 	Page: "PREVIEW.PHP"    ===============================================================*/	
  //  Open context menu for adding new image
	right_click('#context_preview_new_img','#preview_info_div');
	
  //  Open context menu for edit information about article (product or service)...
	right_click('#context_preview_article_info','#horizontalTab');

  // PREVIEW page HEADLINE
	right_click('#preview_headline_context','#preview_headline_container');

  // PREVIEW page COMMENT Headline 
  	right_click('#preview_comment_headline_context','#comments_container');

  // PREVIEW page COMMENT Content
  	right_click('#preview_comment_context','#comments_div');



/*=============================================================== 	Page: "CONTACT.PHP"   ===============================================================*/		
  //  Right click for modal dialog... Open modals dialog for update or delete info...	
	right_click('#update_contact_info','#address_info_div');
	
  //  Edit headline (font weight and font style)
	right_click('#contact_headline_context','#first_div_contact_text_container');
	
  //  Edit first div font weight and style
	right_click('#first_div_contact_headline_context','#first_div_contact');

  // First div change background color, change font weight, font style and font color...
	right_click('#first_div_contact_context','#contact_background_color');
	
	
	
	
	
	
	
	
	
	
	
	
	
});