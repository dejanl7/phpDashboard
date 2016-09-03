/*=============================================================== 
	In this file, we are dealing with image functions. 
	Functions for RESIZEING images, show or hide left image and 
	COLLECTION resize information are defined in file: 
	"ajax_abut_us.js". -> In that file,	we defined all AJAX functions
	for page "ABOUT.PHP". Now, in this file 
	("ajax_for_image_functions.js") we are dealing with all AJAX 
	methods and functions for IMAGE of ALL PAGES 
	(index.php, about.php, gallery.php, contact.php ...); 				
==================================================================*/





/*=============================================================== Page: ALL PAGES!!! ==================================================================*/

/*================================================
// Right Click Dropdown Menu - CSS Settings. 
		Define Left Margins
==================================================*/
$(document).ready(function(){
	$(".dropdown ul li a").click(function(){
		var rightClickDivWidth = $(this).width();
		$(".popup_msg").css('margin-left', rightClickDivWidth+20);
		$(".popup_msg").css('margin-top', '-20px');
	});

});


/*================================================
	Change Background Image
==================================================*/
$(document).ready(function(){
	$(".bg_background_img").click(function(){
		var bg_img_name = $(this).attr('data');
		//alert(bg_img_name);
		$("#change_bg_image_sub").click(function(){
			$.ajax({
				url: "inc/pages/pages_insert_media.php",
				data:{bg_img_name:bg_img_name},
				type: "POST",
				success: function(data){
					if(!data.error){
						location.reload();
					}
				}		
			});
		});
	});
});




/*================================================
	Show Selected Thumbnail Image - Change Background 
	or Change Img (about.php)
==================================================*/
function selectImg(imgClass, targetElement, classNameAddon){
	$(imgClass).on('click', function(){
		$(targetElement).removeClass(classNameAddon);
		$(this).addClass(classNameAddon);
	});
}


/*================================================
	Left Menu - Delete Image(s)
==================================================*/
$(document).ready(function(){
	$('.delete_file_imgs').click(function(e){
		e.preventDefault();
		var id = $(this).attr('id');
		var table = $(this).data('table');
		var type = $(this).data('type');

		if( table == 'uploaded_images' ){
			var uploaded_image = id;
			//alert(uploaded_image);
			if(confirm('Želite li da obrišete izabranu sliku (fajl)?')){
				$.ajax({
					type:'GET',
					url: 'inc/functions/delete.php',
					data:{uploaded_image:uploaded_image},
					success: function(data){
						if(!data.error){
							location.reload();
						}
					}
				});	
			}
		}

		if( table == 'biography' && type != 'fajlovi' ){
			var delete_biography_id = id;
			//alert(delete_biography_id);
			if(confirm('Želite li da obrišete izabranu sliku (fajl)?')){
				$.ajax({
					type:'GET',
					url: 'inc/functions/delete.php',
					data:{delete_biography_id:delete_biography_id},
					success: function(data){
						if(!data.error){
							location.reload();
						}
					}
				});	
			}
		}

		if( table == 'biography' && type=='fajlovi'){
			var delete_biography_CV = id;
			//alert(type);
			if(confirm('Želite li da obrišete izabranu sliku (fajl)?')){
				$.ajax({
					type:'POST',
					url: 'inc/pages/pages_insert_media.php',
					data:{delete_biography_CV:delete_biography_CV},
					success: function(data){
						if(!data.error){
							location.reload();
						}
					}
				});	
			}
		}
		if( table == 'carousel_imgs'){
			var delete_staff = id;
			if(confirm('Želite li da obrišete izabranu sliku (fajl)?')){
				$.ajax({
					type:'GET',
					url: 'inc/functions/delete.php',
					data:{delete_staff:delete_staff},
					success: function(data){
						if(!data.error){
							location.reload();
						}
					}
				});	
			}
		}
		if( table == 'articles'){
			var delete_gallery_img = id;
			//alert(delete_gallery_img);
			if(confirm('Želite li da obrišete izabrani artikal?')){
				$.ajax({
					type:'GET',
					url: 'inc/functions/delete.php',
					data:{delete_gallery_img:delete_gallery_img},
					success: function(data){
						if(!data.error){
							//location.reload();
						}
					}
				});	
			}
		}
		if( table == 'article_details_images'){
			var delete_article_img = id;
			//alert(delete_article_img);
			if(confirm('Želite li da obrišete izabranu s (fajl)?')){
				$.ajax({
					type:'GET',
					url: 'inc/functions/delete.php',
					data:{delete_article_img:delete_article_img},
					success: function(data){
						if(!data.error){
							location.reload();
						}
					}
				});	
			}
		}

	});
});



		
/*================================================ 
	Delete carousel image or more images
==================================================*/
	function delete_carousel_imgs(form_name){
		$(form_name).click(function(e){
			e.preventDefault();
			var delete_staff = $(this).attr('id');
			//alert(delete_staff);
			if(confirm('Želite li da obrišete izabranu sliku / slike?')){
				$.ajax({
					type:'GET',
					url: 'inc/functions/delete.php',
					data:{delete_staff:delete_staff},
					success: function(data){
						if(!data.error){
							window.location = 'index.php';
						}
					}
				});	
			}
		});
	}
	

	
/*=============================================================== Page: "INDEX.PHP" ==================================================================*/
/*================================================ 
	Insert carousel image - ajax function. Show 
	all inserted images (after inserting) without 
	refresh of the page.
==================================================*/
		function carousel_image(form_name, load_div, div_for_loading){
			$(form_name).on('submit',(function(e) {
			e.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				type:'POST',
				url: $(this).attr('action'),
				data:formData,
				cache:false,
				contentType: false,
				processData: false,
				success:function(data){
					$(form_name)[0].reset();
					$(load_div).load(div_for_loading);
				},
				error: function(data){
					console.log("error");
					console.log(data);
				}
			});
			}));
			
		}


		
		
/*=============================================================== Page: "ABOUT.PHP" ==================================================================*/
/*================================================ 
	Function for RESIZEING IMAGES!!! 	
==================================================*/
	function change_image_dimension(menu_option, div_load_resized_img, address_to_the_resized_file, submit_button, resized_image, address_for_insert,img_container, show_img){
		$(menu_option).click(function(e){
		e.preventDefault();
		
		$(div_load_resized_img).load(address_to_the_resized_file,function(){
			$(submit_button).click(function(){
				var imgWidth = $(resized_image).width();
				var imgHeight = $(resized_image).height();
				$.ajax({
					type: "POST",
					url: address_for_insert,
					data: {imgWidth:imgWidth, imgHeight:imgHeight},
					success: function(img){
						$(img_container).load(show_img);
					},
					error: function(){
						console.log("failure");
					}
				});
			});	
		});		
		});		
	}
	

/*================================================
	CHANGE IMAGE - set images in business_info div. 
	We can choose image. 
==================================================*/
	function change_image(all_images, select_image, url_address, div_load, address_for_loading){
		$(all_images).click(function(){
			var img_name = $(this).attr('data');
			$(select_image).click(function(){
				$.ajax({
					url: url_address,
					data:{img_name:img_name},
					type: "POST",
					success: function(data){
						if(!data.error){
							$(div_load).load(address_for_loading);
						}
					}
				});
			});
		});
	}


/*================================================
	Toggle fields into modal or out of the modal
==================================================*/ 		
	function toggle_form_into_modal(form_name, button_click){
		$(form_name).hide();
		$(button_click).on('click', function(){
			$(form_name).slideToggle('slow')();
		});
	}
	


/*================================================
 	FUNCTION FOR  SHOW all uploaded images in 
 	MODAL dialog 	
==================================================*/	
	function instantly_show_image_in_modal(form_name,data_append, div_for_load,loaded_info,select_image,submit_button,ajax_address, show_info_div,info_load){
		$(form_name).on('submit',(function(e) {
			e.preventDefault();
			var formData = new FormData(this);
			formData.append('data_append',data_append);
			$.ajax({
				type:'POST',
				url: $(this).attr('action'),
				data:formData,
				cache:false,
				contentType: false,
				processData: false,
				success:function(data){
					$(form_name)[0].reset();
					$(div_for_load).load(loaded_info,function(){
						$(select_image).click(function(){
							var img_name = $(this).attr('data');
							$(submit_button).click(function(){
								$.ajax({
									url: ajax_address,
									data:{img_name:img_name},
									type: "POST",
									success: function(data){
										if(!data.error){
											$(show_info_div).load(info_load);
											$(form_name)[0].reset();
										}
									}
									
								});
							});
						});
					});
				},
				error: function(data){
					console.log("error");
					console.log(data);
				}
			});
		}));
		
	}	
		
/*================================================
	FUNCTION FOR INSERT new member with biography,
	CV image and CV document... 	
==================================================*/
	function upload_biography_images(form_name,data_append, div_for_load,loaded_info,global_load_div,global_load_info){
		$(form_name).on('submit',(function(e) {
			e.preventDefault();
			var formData = new FormData(this);
			formData.append('data_append',data_append);
			$.ajax({
				type:'POST',
				url: $(this).attr('action'),
				data:formData,
				cache:false,
				contentType: false,
				processData: false,
				success:function(data){
					$(form_name)[0].reset();
					$(div_for_load).load(loaded_info);
					$(global_load_div).load(global_load_info);
					window.location = 'about.php'; // Refresh page -> send to page: about.php
				},
				error: function(data){
					console.log("error");
					console.log(data);
				}
			});
		}));
		
	}
	
/*================================================
	Part for biographies ->change image, 
	change biography document.
==================================================*/ 		
function biography_activities(){
	$('.biog_img').contextmenu(function(){	
		var selected_id = $(this).attr('data');
		//alert(selected_id);
		$.ajax({
			url: 'inc/modals_dialog.php',
			data:{selected_id:selected_id},
			type: 'GET',
			success: function(data){
				if(!data.error){
				// Send info about biography_id 	
					$('#biography_img_uploaded_container').load('inc/modals_dialog.php?selected_id='+selected_id +' #show_uploaded_biography_img_modal',function(){
					
					// Change biography image (show in page: about.php) 
						$('.all_personal_biography_imgs').click(function(){
							var personal_img_name = $(this).attr('data');
							var personal_img_id = selected_id;
							$.ajax({
								type:'POST',
								url: 'inc/pages/pages_insert_media.php',
								data:{personal_img_id:personal_img_id, personal_img_name:personal_img_name},
								success:function(data){
									window.location = 'about.php';
								}
							});	
						});
					
					// Delete biography document (CV) 
						$('.biography_CV').click(function(){
							var delete_biography_CV = $(this).attr('data');
							if(confirm('Obrišite CV dokument?')){
								$.ajax({
									type:'POST',
									url: 'inc/pages/pages_insert_media.php',
									data:{delete_biography_CV:delete_biography_CV},
									success:function(data){
										window.location = 'about.php';
									}
								});	
							}
						});
						
					// Update all information from form (name, last name, proffesion, change image...) 	
						$('#update_biography').on('submit',(function(e){
							e.preventDefault();
							value_for_me = $('.biography_images').attr('data');
							//alert(value_for_me);
							var formData = new FormData(this);
							formData.append('data_append', value_for_me);
							$.ajax({
								type:'POST',
								url: $(this).attr('action'),
								data:formData,
								cache:false,
								contentType: false,
								processData: false,
								success:function(data){
									//$('#update_biography').load('inc/modals_dialog?selected_id= '+value_for_me+ ' #update_biography');
									//$('#update_biography')[0].reset();
									//$('#slika').val('');
									//$('#dokument').val('');
									//$('#personal_biography_imgs').load('inc/modals_dialog.php?selected_id=' + value_for_me + ' #personal_biography_imgs_container');
									window.location = 'about.php';
									
								}
							});	
						}));
					});	
				}
			}
		});
	});	
	
	}
	

 /*================================================
 	DELETE MEMBER and all information ABOUT BIOGRAPHY
 ==================================================*/  	
	function delete_biography_for_member(){	
		$('.biog_img').contextmenu(function(){	
			var delete_biography_id = $(this).attr('data');
				//alert(delete_biography_id);
			$('#delete_biography').click(function(){
			if(confirm('Želite li da obrišete biografiju korisnika?')){
				$.ajax({
					url:'inc/functions/delete.php',
					type:'GET',
					data:{delete_biography_id:delete_biography_id},
					success: function(data){
						//window.location = 'about.php'; // Refresh page -> send to page: about.php
						location.reload();
					}
				});
			}
			});
				
		});		
	}
	
	



/*===============================================================  Page: "gallery.PHP" ==================================================================*/
/*================================================ 
	Insert article...		
==================================================*/	
	function insert_article(form_name, load_div, div_for_loading){
	  $(form_name).on('submit',(function(e) {
		e.preventDefault();
		var formData = new FormData(this);
		$.ajax({
			type:'POST',
			url: $(this).attr('action'),
			data:formData,
			cache:false,
			contentType: false,
			processData: false,
			success:function(data){
				$(form_name)[0].reset();
				$(load_div).load(div_for_loading);
			},
			error: function(data){
				console.log("error");
				console.log(data);
			}
		});
	  }));
		
	}


/*================================================
	Delete article and all information about 
	article ON RIGHT CLICKE ON ARTICLE
==================================================*/
	function delete_article_info(){	
		$('.gallery_images').on('contextmenu', function(){	
			var delete_gallery_img = $(this).attr('id');
				//alert(delete_gallery_img);
			$('#delete_product_service').click(function(){
			if(confirm('Želite li da obrišete ovaj artikal?')){
				$.ajax({
					url:'inc/functions/delete.php',
					type:'GET',
					data:{delete_gallery_img:delete_gallery_img},
					success: function(data){
						window.location = 'gallery.php';
					}
				});
			}
			});
				
		});		
	}


/*================================================
	Paginate function with AJAX	
==================================================*/
	function gallery_ajax_pagination(onclick_field, paginate_class, container, address, div_loader){
		$(onclick_field).on('click', paginate_class, function (e){
			e.preventDefault(); 
			var page = $(this).attr('rel');
			//alert(page);
			$(container).load(address + page + div_loader, function(){
				delete_article_info();
				update_article_info();
			});
		});
	}

	
/*================================================
 	Delete ARTICLE (BIG TEXT BOX - with option for 
 	delete once or more product)
 ==================================================*/
	function delete_article(form_name){
		$(form_name).click(function(e){
			e.preventDefault();
			var article_for_delete = $(this).attr('id');	
			if(confirm('Želite li da obrišete izabrani artikal?')){
				$.ajax({
					type:'POST',
					url: 'inc/functions/delete.php',
					data:{article_for_delete:article_for_delete},
					success: function(data){
						if(!data.error){
							window.location = 'gallery.php';
						}
					}
				});	
			}
		});
	}

	
/*================================================ 
	Update article (product, service) info.
==================================================*/		
	function update_article_info(){
		$('.gallery_images').contextmenu(function(){	
			var article_id = $(this).attr('id');
			//alert(article_id);
			$.ajax({
				url: 'inc/modals_dialog.php',
				data:{article_id:article_id},
				type: 'GET',
				success: function(data){
					if(!data.error){
					// Send info about biography_id 	
						$('#modal_update_gallery_container1').load('inc/functions/pages_functions/show_files_via_ajax/update_gallery_info_function.php?article_id='+article_id,function(){
							$('#gallery_update_info_form').on('submit',(function(){
								var take_id = $('.submit_gallery').attr('id');
								//alert(take_id);
								var formData = new FormData(this);
								formData.append('data_append', take_id);
								$.ajax({
									type:'POST',
									url: $(this).attr('action'),
									data:formData,
									cache:false,
									contentType: false,
									processData: false,
									success:function(data){
										window.location.href = 'gallery.php';
										//$('#gallery_container').load('gallery.php #gallery_loader');
									}
								});	
							}));
						});	
					}
				}
			});
		});	
	}
	
	


/*===============================================================  Page: "PREVIEW.PHP" ==================================================================*/	
	
/*================================================ 
	Etalage for Preview Page
==================================================*/
$(document).ready(function(){
	$('#etalage').etalage({
		thumb_image_width: 300,
		thumb_image_height: 400,
		source_image_width: 900,
		source_image_height: 1200,
		show_hint: true,
		click_callback: function(image_anchor, instance_id){
			alert('Callback example:\nYou clicked on an image with the anchor: "'+image_anchor+'"\n(in Etalage instance: "'+instance_id+'")');
		}
	});
});


/*================================================ 
	Horizontal Tabs Preview Page
==================================================*/
$(document).ready(function () {
    $('#horizontalTab').easyResponsiveTabs({
        type: 'default', //Types: default, vertical, accordion           
        width: 'auto', //auto or any width like 600px
        fit: true   // 100% fit in a container
    });
});

				

/*================================================ 
	Insert new image for specific article.
==================================================*/
	function preview_all_article_imgs(form_name){
		$(form_name).on('submit',(function(e){
		var article_id = $("#preview_new_img_sub").attr('attr');
			//alert(article_id);
		e.preventDefault();
		var formData = new FormData(this);
			$.ajax({
				type:'POST',
				url: $(this).attr('action'),
				data:formData,
				cache:false,
				contentType: false,
				processData: false,
				success:function(data){
					$(form_name)[0].reset();
					$('#preview_uploaded_container').load('preview.php?article_id=' +article_id+' #show_preview_img_modal');
				},
				error: function(data){
					console.log("error");
					console.log(data);
				}
			});
		}));
		
	}

/*================================================
	Function for delete image of specific article
==================================================*/
	function delete_preview_article_imgs(form_name){
		$(form_name).click(function(){
			var article_id = $(this).attr('rel');
			var delete_article_img = $(this).attr('id');
				//alert(delete_article_img);
			if(confirm('Želite li da obrišete izabranu sliku / slike?')){
				$.ajax({
					type:'GET',
					url: 'inc/functions/delete.php',
					data:{delete_article_img:delete_article_img},
					success: function(data){
						window.location = 'preview.php?article_id=' + article_id;
					}
				});	
			}
		});
	}	