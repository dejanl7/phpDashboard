/*====================================================================================== 
	RIGHT CLICK FUNCTION 
	This is first of the functions. When user clicks on some field, menu will be open. 
========================================================================================*/
	function right_click(variable_value, on_right_click){
		$(function(){
			var $variable = $(variable_value);
			  
			$(on_right_click).on("contextmenu", function(e) {
				var pathname = window.location.pathname; // Returns path only
				var splitPathname = pathname.split('/');
				var lastElement = splitPathname.length;
				
				if( splitPathname[lastElement-1] ==  "preview.php"){
					$variable.css({
					  	display: "block",
					  	left: e.pageX,
					  	top: e.pageY-40
					});
				}
				else{
					$variable.css({
					  	display: "block",
					  	left: e.pageX,
					  	top: e.pageY
					});
				}

				return false;
			});
				$variable.on("click", function() {
					$(variable_value).hide(); 
				});

				$("body").click(function(){
					$(variable_value).hide();
				});
				 
				$(document).on('keyup',function(evt){
					if (evt.keyCode == 27) {
					   $variable.hide(); //If press ESC key, this div will disapear
					}
				}); 
		});	
	}


/*======================================
	Close (x) button - close modal
========================================*/
	function close_modals(){
		$('.close').on('click', function(){
			$('.popup_msg').hide();
		});
	}




/*====================================	
 	Ask Admin (TinyMCE)
======================================*/ 
	function ask_admin(formId, full_content){
		$(formId).submit(function(e){
			e.preventDefault();
			var querstion_for_admin = tinyMCE.get(full_content).getContent();
				//alert(querstion_for_admin);
			$.ajax({
				type: "POST",
				url: 'inc/pages/pages_insert_info.php',
				data: {querstion_for_admin:querstion_for_admin},
				success: function(msg){
					$(formId)[0].reset();
					alert('Uspešno Ste poslali poruku za Administratora.');
					location.reload();
				},
				error: function(){
					alert("failure");
				}
			});
		});
	}



/*======================================
	Approve Comments
========================================*/
	function approve_comments(){
		$('.approve_comment').click(function(e){
			e.preventDefault();
			var approve_comment_id = $(this).data('id');
			//alert(approve_comment_id);
			if(confirm('Želite li da odobrite ovaj komentar?')){
				$.ajax({
					type:'POST',
					url: 'inc/pages/pages_insert_info.php',
					data:{approve_comment_id:approve_comment_id},
					success: function(data){
						if(!data.error){
							location.reload();
						}
					}
				});	
			}
		});
	}


/*======================================
	Approve or Block User
========================================*/
	function approve_block_user(approve_disable_user){
		$(approve_disable_user).click(function(e){
			e.preventDefault();
			var master_user_id 	 = $(this).data('id');
			var master_user_type = $(this).data('type');
			
			if(confirm('Želite li da odobrite pristup korisniku?')){
				$.ajax({
					type:'POST',
					url: 'inc/pages/pages_insert_info.php',
					data:{ master_user_id:master_user_id, master_user_type:master_user_type },
					success: function(data){
						if(!data.error){
							location.reload();
						}
					}
				});	
			}
		});
	}


/*======================================
	Disable Comments
========================================*/
	function disable_comments(){
		$('.disable_comment').click(function(e){
			e.preventDefault();
			var disable_comment_id = $(this).data('id');
			//alert(disable_comment_id);
			if(confirm('Želite li da zabranite prikaz komentara?')){
				$.ajax({
					type:'POST',
					url: 'inc/pages/pages_insert_info.php',
					data:{disable_comment_id:disable_comment_id},
					success: function(data){
						if(!data.error){
							location.reload();
						}
					}
				});	
			}
		});
	}


/*======================================
	Delete Comments
========================================*/
	function delete_comments(){
		$('.delete_comment').click(function(e){
			e.preventDefault();
			var delete_comment_id = $(this).data('id');
			//alert(delete_comment_id);
			if(confirm('Želite li da obrišete ovaj komentar?')){
				$.ajax({
					type:'POST',
					url: 'inc/pages/pages_insert_info.php',
					data:{delete_comment_id:delete_comment_id},
					success: function(data){
						if(!data.error){
							location.reload();
						}
					}
				});	
			}
		});
	}



/*======================================
	Delete Messages
========================================*/
	function delete_message(){
		$('.delete_message').click(function(e){
			e.preventDefault();
			var message_id = $(this).data('id');
			var url = $('#messages-select-form').attr('action');

			if(confirm('Želite li da obrišete ovu poruku?')){
				$.ajax({
					type: 'GET',
					url: url,
					data: { message_id:message_id },
					success: function(data){
						if(!data.error){
							location.reload();
						}
					},
					error: function(data){
						location.reload();
						console.log('Some mistake during the sending request.');
					}
				});
			}
		});
	}






/*====================================	
	SELECT ALL BOXES (CHECK ALL)
======================================*/
	function select_all_boxes(select_class_name, input_class_name){
		$(select_class_name).click(function(){
			if(this.checked){
				$(input_class_name).each(function(){
					this.checked = true;
				});	
			}
				else{
					$(input_class_name).each(function(){
						this.checked = false;
					});	
				}
		});
	}



/*====================================
	AJAX Pagination - Select All Boxes
======================================*/
function ajax_select_all_boxes(div_on_click, input_class_name_for_selecting_all, input_class_name_for_selecting_each){
	$(div_on_click).on('click', input_class_name_for_selecting_all, function(){
		if(this.checked){
			$(input_class_name_for_selecting_each).each(function(){
				this.checked = true;
			});	
		}
			else{
				$(input_class_name_for_selecting_each).each(function(){
					this.checked = false;
				});	
			}
	});
}



/*====================================
	Delete Something in Ajax Pagination
	This function will be use for building
	some object for delete into pagination loaders
======================================*/
function delete_something_pagination(delete_something){
	$(delete_something).click(function(e){
		e.preventDefault();
		var ajax_data;
		var tableName = $(this).data('table');
		var dataType  = $(this).data('type');
		var deleteObject = $(this).attr('id');
		var alertMsg;

		//alert(tableName + ', ' + dataType + ', ' + deleteObject );
		if(dataType == 'approve_comment'){
			alertMsg = 'Želite li da odobrite ovaj komentar?';
		}
		else if(dataType == 'disable_comment'){
			alertMsg = 'Želite li da zabranite prikaz komentara?';
		}
		else if(dataType == 'delete_comment'){
			alertMsg = 'Želite li da obrišete ovaj komentar?';
		}
		else {
			alertMsg = 'Želite li da obrišete izabranu stavku?';
		}
			if(confirm(alertMsg)){
				$.ajax({
					type:'GET',
					url: 'inc/functions/delete.php',
					data: { deleteObject:deleteObject, tableName:tableName, dataType:dataType },				
					success: function(data){
						if(!data.error){
							location.reload();
						}
						else{
							location.reload();
						}
					},
				});	
			}

	});
}



/*====================================
	Paginate function with AJAX	
======================================*/
	function ajax_pagination(onclick_field, paginate_class, container, address, div_loader, div_on_click, input_class_name_for_selecting_all, input_class_name_for_selecting_each, delete_something ){

		$(onclick_field).on('click', paginate_class, function (e){
			e.preventDefault(); 
			var page = $(this).attr('rel');
			//alert(page);
			$(container).load(address + page + div_loader, function(){
				ajax_select_all_boxes(div_on_click, input_class_name_for_selecting_all, input_class_name_for_selecting_each);
				delete_something_pagination(delete_something);
			});		
		});
	}
	

/*====================================
	SELECT BOXES in Select Form
======================================*/
	function selected_boxes(select_class_name, input_read, input_unread, input_all){
		$(select_class_name).change(function(){
			var singleValue = $(select_class_name).val();
			//alert(singleValue);
			if( singleValue == 'type_all' ){
				$(input_all).each(function(){
					this.checked = true;
				});
			}
			else if ( singleValue == 'remove_marks' ){
				$(input_all).each(function(){
					this.checked = false;
				});
			}		
			else if( singleValue == 'type_read' ){
				$(input_read).each(function(){
					$(input_unread).each(function(){
						this.checked = false;
					});	
					this.checked = true;
				});
			}
			else if( singleValue == 'type_unread' ){
				$(input_unread).each(function(){
					$(input_read).each(function(){
						this.checked = false;
					});	
					this.checked = true;
				});		
			}
			
		});
	}



/*====================================
	Paginate SELECTED OPTIONS BOXES
	function with AJAX	
======================================*/
	function ajax_selected_boxes_pagination(onclick_field, paginate_class, container, address, div_loader, select_class_name, input_read, input_unread, input_all, delete_something ){

		$(onclick_field).on('click', paginate_class, function (e){
			e.preventDefault(); 
			var page = $(this).attr('rel');
			//alert(page);
			$(container).load(address + page + div_loader, function(){
				selected_boxes(select_class_name, input_read, input_unread, input_all);
				delete_something_pagination(delete_something);
			});
		});	
	}



/*====================================
	Master Admin - Block and Approve
	Users 
======================================*/
	function ajax_approve_block_user_pagination(onclick_field, paginate_class, container, address, div_loader, select_class_name, input_read, input_unread, input_all, approve_disable_user){

		$(onclick_field).on('click', paginate_class, function (e){
			e.preventDefault(); 
			var page = $(this).attr('rel');
			//alert(page);
			$(container).load(address + page + div_loader, function(){
				selected_boxes(select_class_name, input_read, input_unread, input_all);
				approve_block_user(approve_disable_user);
			});
		});	
	}
	

/*====================================
	Master Admin - Answer 
======================================*/
	function send_userAnd_masterUser_answer(answerForm, answerTextarea, takeDataField, containerLoader, answerAlert, toggleField){
		$(answerForm).on('submit', function(e){
			e.preventDefault();
			var answer = tinyMCE.get(answerTextarea).getContent();
			var url = $(answerForm).attr('action');
			var sender_email = $(takeDataField).data("email");
			var message_id = $(takeDataField).data('messageid');
			var message_type = $(takeDataField).data('messagetype');	
			var pageId = $(takeDataField).data('page');

			if( message_type == 'user' ){
				page = 'user_message.php?user='+ pageId +'&message=' + message_id +' .answer-loader'
			}
			else if (message_type == 'master_user' ){
				page = 'user_message.php?master_user='+ pageId +'&message=' + message_id +' .answer-loader'
			}

			//alert(sender_email + ', ' + message_type + ', ' + message_id );

			if(confirm('Pošaljite odgovor na poruku?')){		
				$.ajax({
					type: 'POST',
					url: url,
					data: { answer:answer, sender_email:sender_email, message_id:message_id, message_type:message_type },
					success: function(response){
						if( !response.error ){
						   	$(containerLoader).load(page, function (){
						   		$(answerAlert).append('<span>Uspešno Ste poslali poruku.</span>').css("background-color","rgba(46, 204, 113,0.7)").css("margin-bottom","15px");
								setTimeout( function(){ 
					       			$(answerAlert).fadeOut(5000); 
					       		}, 3000);
						   		
						   	});
							$(answerForm)[0].reset();
							$(toggleField).slideToggle();

						}
						else {
							console.log('Greška' + response );
							$(answerAlert).append('<span>Uspešno Ste poslali poruku.</span>').css("background-color","rgba(231, 76, 60,1.0)").css("margin-bottom","15px");
								setTimeout( function(){ 
					       			$(answerAlert).fadeOut(5000); 
					       		}, 3000);
							$(answerForm)[0].reset();
							$(toggleField).slideToggle();
						}
						
					},
					error: function(data){
						console.log('Došlo je do greške...' + response);
					}
				});	
	
			}
			
		});
	}



/*======================================
	Create Pagination with "&" character
========================================*/
	function specific_pagination(onclick_field, paginate_class, article, container, address, page, div_loader, input_class_name_for_selecting_all, input_class_name_for_selecting_each  ){
		$(onclick_field).on('click', paginate_class, function(e){
	  		e.preventDefault();
	  		var page_id = $(this).attr('rel');
	  		var article_id = $(article).data("article-id");
	  		//alert(page_id);
	  		$(container).load(address + article_id + '&' + page + '=' + page_id + div_loader, function(){
	  			ajax_select_all_boxes(onclick_field, input_class_name_for_selecting_all, input_class_name_for_selecting_each);
	  		});

	  	});
	}

	

/*=====================================
	OWL Slider - Background Images
=======================================*/
	function owl_slider(){
	  	$("#owl-demo-new-products").owlCarousel({
		    autoPlay: 5000,
		    navigation : false,
		    items: 5,
		    paginationSpeed : 1000,
		    mouseDrag: true,
		    responsiveRefreshRate: true
	  	});
	}



/*=====================================
	Use jQuery to set HEADLINE FONT-SIZE
=======================================*/
	function jquery_set_headline_font_size(div_for_loading, page){
		var screen_width = screen.width;
		if(screen_width > 768){
			$(div_for_loading).css("font-size","<?php echo index_page::css(page,'first_div_font_weight');  ?>");
		}
		else{
			$(div_for_loading).css("font-size","24px");
		}
	}


/*====================================
	Use jQuery to set "P" tag FONT-SIZE
======================================*/
	function jquery_set_ptag_font_size(div_for_loading, page){
		var screen_width = screen.width;
		if(screen_width > 768){
			$(div_for_loading).css("font-size","<?php echo index_page::css(page,'first_div_font_weight');  ?>");
		}
		else{
			$(div_for_loading).css("font-size","15px");
		}
	}
	

/*====================================	
 	tinyMc function for insert text 
	into database
======================================*/ 
	function tinyMc_ajax(submit_button, full_content, db_column_name, address, load_tinyMc_div, content_for_loading){
		$(submit_button).click(function(){
			var content = tinyMCE.get(full_content).getContent();
			var function_name = $(db_column_name).attr('rel'); //take a column name
			alert(function_name);
			$.ajax({
				type: "POST",
				url: address,
				data: {function_name:function_name,content:content},
				success: function(msg){
					$(load_tinyMc_div).load(content_for_loading);
					$("#remodal").modal('hide');
				},
				error: function(){
					alert("failure");
				}
			});
		});
	}


/*====================================
	FUNCTION FOR SENDING INFO ABOUT 
	SHOW/HIDE (img, page part) and 
	FONT WEIGHT(STYLE) INTO DATABASE 
======================================*/
	function send_info_into_db(form_submit, div_container_load, div_for_loading, hide_div){
		$(form_submit).submit(function(evt){
		evt.preventDefault();
		var postData = $(this).serialize();
		var url = $(this).attr('action');
			$.post(url, postData, function(php_table_data){
				$(div_container_load).load(div_for_loading);
				$(hide_div).hide(); 
			});
		});	
	}
	

/*====================================
	FUNCTION FOR SENDING INFO ABOUT 
	FONT AND BACKGROUND COLOR INTO 
	DATABASE 
====================================*/
	function send_color_into_db(submit_form, hide_div){
		$(submit_form).submit(function(evt){
			evt.preventDefault();
			var postData = $(this).serialize();
			var url = $(this).attr('action');
			
			$.post(url, postData, function(php_table_data){
				$(hide_div).hide();
			});
		});	
	}






/*=============================================================== PAGE: "CONTACT.PHP" ===============================================================*/
/*====================================
	TOGGLE DIV - On button click, 
	hidden div will be open. Another
	click in the same button - div 
	will be close.
====================================*/
function toggle_div_into_modal(div_name, click_button){
	$(div_name).hide();
	$(click_button).click(function(){
		$(div_name).slideToggle('slow')();
	});
}	


/*==================================== 
	Take contact_id, when user click on some of the addresses. Id will be forward up to the modals_dialog.php.
======================================*/
function change_contact_info(){	
	$(".all_address_info").contextmenu(function(){
		var id_value = $(this).attr("id");
		//alert(id_value);
		
		$.ajax({
			type: "GET",
			url: "inc/modals_dialog.php",
			data: {id_value:id_value},
			success: function(msg){
				$('#remodal_update_contact_container').load('inc/modals_dialog.php?id_value='+id_value +' #remodal_update_contact_load', function(){
				// Update contact information...
					$('#update_contacts_form').on('submit',(function(e){
						//alert("test");
						//e.preventDefault();
						var formData = new FormData(this);
						//alert(formData);
						$.ajax({
							type:'POST',
							url: $(this).attr('action'),
							data:formData,
							cache:false,
							contentType: false,
							processData: false,
							success:function(data){
								window.location = 'contact.php';
								
							}
						});	
					}));
					
				// Delete contact	
					$('#delete_contact_info').click(function(){
						return confirm("Da li želite da obrišete ovaj kontakt?");
					});
				});
			},
			error: function(){
				alert("failure");
			}
		});
	});

}


/*=============================================================== PAGE: "PREVIEW.PHP" ===============================================================*/
/*====================================
	Form for insert comment and marks
	from clients and customers...
======================================*/	
	function insert_marks_and_comment(form_name){
		$(form_name).submit(function(evt){
			evt.preventDefault();
			var clientIp = $('.check-client-ip').attr('attr');
			//alert(clientIp);
			
				var commentContent = tinyMCE.get('comment_article').getContent();
				//alert(commentContent);
				var postData = $(this).serialize() + commentContent;
				var url = $(this).attr('action');
				$.post(url, postData, function(php_table_data){
					$(form_name)[0].reset();
					alert('Hvala Vam na glasanju.');
					location.reload();
					console.log(postData);
				});
			
		});	
	}


/*====================================
 	Edit information about specific
 	article. Insert and update info.
======================================*/
	function tinyMcArticle_ajax(submit_button, full_content, db_column_name, article_id1, address, load_tinyMc_div,content_for_loading){
		$(submit_button).click(function(){
			var content = tinyMCE.get(full_content).getContent();
			var function_name = $(db_column_name).attr('rel'); //take a column name
			var article_id = $(article_id1).attr('rel'); // take article_id
			//alert(article_id);
			//alert(function_name);
			$.ajax({
				type: "POST",
				url: address,
				data: {function_name:function_name,content:content, article_id:article_id},
				success: function(msg){
					$(load_tinyMc_div).load('preview.php?article_id='+ article_id + content_for_loading);
					$("#remodal").modal('hide');
				},
				error: function(){
					alert("failure");
				}
			});
		});
	}
	

/*====================================
	FUNCTION FOR SENDING INFO ABOUT 
	SHOW OR HIDE... This function is
	specific because we have parametar
	"article_id". For that reason, we 
	could not applay topic function 
	"send_info_into_db"
=======================================*/
	function send_specific_info_into_db(form_submit){		
		$(form_submit).submit(function(evt){
		var article_id = $('#edit_article_container').attr('rel');
			//alert(article_id);
		evt.preventDefault();
		var postData = $(this).serialize();
		var url = $(this).attr('action');
			$.post(url, postData, function(php_table_data){
				window.location = 'preview.php?article_id=' + article_id;
			});
		});	
	}


/*====================================
	Specific weight and type Info
======================================*/
	function send_sepcific_weight_type_info(form_submit, div_container_load, div_for_loading, hide_div){
		$(form_submit).submit(function(evt){
			var formName = $(form_submit).attr('id');
			if(formName == 'preview_commentsContent_font_weight_style_form' ){
				//alert('Test '+ formName);
				var article_id = $('#edit_article_container').attr('rel');
				var postData = $(this).serialize();
				var url = $(this).attr('action');
					$.post(url, postData, function(php_table_data){
						location.reload();
					});
			}	
			var article_id = $('#edit_article_container').attr('rel');
			evt.preventDefault();
			var postData = $(this).serialize();
			var url = $(this).attr('action');
				$.post(url, postData, function(php_table_data){
					$(div_container_load).load('preview.php?article_id=' + article_id + div_for_loading);
					$(hide_div).hide(); 
				});
		});	
	}
	


/*====================================
	jQuery Form Validator
======================================*/
// Check out Password Overlapping
	function new_password_validation(){
		$('#new-password-confirm').bind('click blur', function(){
			var pass1 = $('#new-password');
			var pass2 = $('#new-password-confirm');
			var message = $('#confirmMessageNewPass');
			var goodColor = '#66cc66';
			var badColor  = '#ff6666';
				//alert(pass1.val() + ', ' + pass2.val());
			if( pass1.val() == pass2.val() && pass1.val().length > 6 && pass2.val().length > 6 ){
				pass2.css( 'border-color', goodColor );
				message.html( 'Šifre se podudaraju. Možete potvrditi promene.' ).css('color', goodColor).css('font-weight', 'bold');
				$('#submit-new-password').prop('disabled', false);			
			}
				else if ( pass2.val().length <= 6 ){
					alert('Šifra mora sadržati najmanje 7 karaktera.');
					$('#submit-new-password').prop('disabled', true);
				}

				else if( pass1.val() != pass2.val() ) {
					pass2.css( 'border-color', badColor );
					message.html( 'Unete šifre se ne podudaraju.' ).css('color', badColor).css('font-weight', 'bold');
					$('#submit-new-password').prop('disabled', true);
				}

		});
	}


/*====================================
	Change Password
======================================*/
	function change_password( formName, passData ){
		$(formName).on('submit', function(e){
			e.preventDefault();
			var newPassword = $(passData).val();
			var url = $(formName).attr('action');
			//alert(newPassword + ', ' + url);

			$.ajax({
				method: 'POST',
				url: url,
				data: { newPassword:newPassword },
				success: function(data){
					$(formName)[0].reset();
					window.location = 'logout.php';
				},
				error: function(data){
					console.log('Error during the sending data...');
				}
			});
		});
	}


/*====================================
	Full Calendar - Add Personal Event
======================================*/
function returnColor(){
	$('.notification-color-picker > li a i').on('click', function(e){
		e.preventDefault();
		var color = $(this).data('color');

		$('#notification-color').val(color);
		$('#new-event').css('background-color', color);
	});
}

// New Event
function insertNewEvent(formName, eventTitle, eventColor){
	$(formName).submit(function(e){
		e.preventDefault();
		var notificationTitle = $(eventTitle).val();
		var notificationColor = $(eventColor).val();
		//alert(notificationColor + ', ' + notificationTitle);
		$.ajax({
			url: 'inc/pages/pages_insert_info.php',
			type: 'POST',
			data: { notificationTitle:notificationTitle, notificationColor:notificationColor },
			success: function(data){
				$(formName)[0].reset();
				location.reload();
			},
			error: function(data){
				console.log('Error during the sending request!');
			}

		});

	});
}



/*====================================
	"Imenik" - Phonebook Insert New
	Contact Information
======================================*/
	function insert_new_contact(form_name){		
		$(form_name).submit(function(e){
			e.preventDefault();
			var postData = $(this).serialize();
			var url = $(this).attr('action');
				$.post(url, postData, function(php_table_data){
					$(form_name)[0].reset();
					location.reload();					
				});
		});	
	}


/*====================================
	"Imenik" - Phonebook Delete Contact 
======================================*/
	function deleteContact(deleteButton){
		$(deleteButton).on('click', function(){
			var phonebookContactId = $(this).data('id');
				//alert(contactId);
			if(confirm('Želite li da obrišete ovaj kontakt?')){
				$.ajax({
					url: 'inc/pages/pages_insert_info.php',
					type: 'POST',
					data: { phonebookContactId:phonebookContactId },
					success: function(data){
						location.reload();
					},
					error: function(data){
						console.log('Error during the sending request...');
					}
				});
			}
		});
	}



/*====================================
	"Imenik" - Phonebook Delete Contact 
======================================*/

	function editPhonebookContact(updateIdClass){
		$('.edit-contact').on('click', function(){
			var phonebookContactId = $(this).data('id');
			$.ajax({
				url: 'inc/modals_dialog.php',
				type: 'GET',
				data: { phonebookContactId:phonebookContactId },
				success: function(data){
					$('#remodal_update_phonebook_contact_container').load('inc/modals_dialog.php?phonebook_contact_id='+phonebookContactId + ' #remodal_update_phonebook_contact_load', function(){
						$(updateIdClass).on('click', function(e){
							e.preventDefault();
							var phonebookDataType  = $(this).data('type');
							var editingPhonebookId = $(this).data('id');
							
							if( phonebookDataType == 'delete-phonebook-contact' ){
								var phonebookMsg = 'Želite li da obrišete ovaj kontakt?';
							}
							else if ( phonebookDataType == 'update-phonebook-contact' ){
								var phonebookMsg = 'Želite li da ažurirate ovaj kontakt?';
							}

							if(phonebookDataType == 'delete-phonebook-contact'){
								if( confirm(phonebookMsg) ){
									$.ajax({
										url: 'inc/pages/pages_insert_info.php',
										type: 'POST',
										data: { editingPhonebookId:editingPhonebookId, phonebookDataType:phonebookDataType },
										success: function(data){
											//console.log( phonebookDataType + ', ' + editingPhonebookId );
											window.location = 'user_phonebook.php';
										},
										error: function(data){
											console.log('Error during the sending request...');
										}
									});
								}
							}

							if(phonebookDataType == 'update-phonebook-contact'){
								if( confirm(phonebookMsg) ){
									var updatePhonebookName 	= $('#modal_phonebook_name').val();
									var updatePhonebookPhone 	= $('#modal_phonebook_phone').val();
									var updatePhonebookAddress 	= $('#modal_phonebook_address').val();
									var updatePhonebookEmail 	= $('#modal_phonebook_email').val();
									var updatePhonebookPerson 	= $('#modal_phonebook_contactperson').val();
									var updatePhonebookType 	= $('#modal_phonebook_contact_type').val();

									$.ajax({
										url: 'inc/pages/pages_insert_info.php',
										type: 'POST',
										data: { editingPhonebookId:editingPhonebookId, phonebookDataType:phonebookDataType, updatePhonebookName:updatePhonebookName, updatePhonebookPhone:updatePhonebookPhone, updatePhonebookAddress:updatePhonebookAddress, updatePhonebookEmail:updatePhonebookEmail, updatePhonebookPerson:updatePhonebookPerson, updatePhonebookType:updatePhonebookType  },
										success: function(data){
											//console.log( phonebookDataType + ', ' + editingPhonebookId );
											window.location = 'user_phonebook.php';
										},
										error: function(data){
											console.log('Error during the sending request...');
										}
									});
								}
							}
							
						});

					});
				},
				error: function(data){
					console.log('Error during the sending request...');
				}
			});
		});
	}



/*====================================
	"Imenik" - Phonebook Delete More
	Contact from DataTable 
======================================*/
/*$('.').on('submit', function(e){
	e.preventDefault();

});*/