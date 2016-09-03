<?php
include("../init.php");
	global $base;
	if(!$session->session_status()){
		redirect("login.php");
	}
?>


<?php
/*=====================================================
	Left Menu "Slike (fajlovi)" - Delete More Images 
	(files)
=======================================================*/
	if( isset($_POST['images-files-delete-option']) && isset($_POST['images_files_id']) ){
		$delete_more = $_POST['images_files_id'];
		foreach( $delete_more as $delete_once ){
			$take_id = explode(", ", $delete_once);

			if( $take_id[1] == 'carousel_imgs'){
				$delete_slider_imgs = carousel_imgs::find_this_id($take_id[0]);
				unlink(SITE_ROOT. DS . $delete_slider_imgs->carousel_path());
				
				$sql = "DELETE FROM carousel_imgs WHERE carousel_id = '{$take_id[0]}'";
				$base->select_table($sql);
			}

			if( $take_id[1] == 'uploaded_images'){
				$delete_uploaded_imgs = uploaded_image::find_this_id($take_id[0]);
				unlink(SITE_ROOT. DS . $delete_uploaded_imgs->image_path());
				
				$sql = "DELETE FROM uploaded_images WHERE uploaded_img_id = '{$take_id[0]}'";
				$base->select_table($sql);
			}

			if( $take_id[1] == 'biography' && $take_id[2] == 'biografija' ){
				$delete_biography_document = biographies::find_this_id($take_id[0]);
				$delete_new_biography_document = new_biography_image::find_this_query("SELECT * FROM add_biography_image WHERE biography_id = '{$take_id[0]}'");
				
				unlink(SITE_ROOT. DS . $delete_biography_document->worker_image_path());	
				unlink(SITE_ROOT. DS . $delete_biography_document->worker_files_path()); 
				
					foreach($delete_new_biography_document as $delete_images){
						//$delete_images->delete_new_biography_image();
						$delete_images->delete();
						unlink(SITE_ROOT. DS .$delete_images->biography_image_path());
					}

				$sql = "DELETE FROM biography WHERE biography_id ='{$take_id[0]}'";
				$sql1 = "DELETE FROM new_biography_image WHERE biography_id ='{$take_id[0]}'";
					$base->select_table($sql);	
					$base->select_table($sql1);	

					redirect('../../user_images.php');
			}

			if( $take_id[1] == 'biography' && $take_id[2] == 'fajlovi'){
				$delete_biography_document = biographies::find_this_id($take_id[0]);
						
				unlink(SITE_ROOT. DS . $delete_biography_document->worker_files_path());
				$query = "UPDATE biography SET worker_biography_document = '' WHERE biography_id ='{$take_id[0]}'"; 
					$base->select_table($query);

					redirect('../../user_images.php');	
			}

			if( $take_id[1] == 'articles'){
				$delete_articles = articles::find_this_id($take_id[0]);
				unlink(SITE_ROOT. DS . $delete_articles->article_image_path());
		
				$sql = "DELETE FROM articles WHERE article_id = '{$take_id[0]}'";
				$base->select_table($sql);
			}

			if( $take_id[1] == 'article_details_images'){
				$delete_article_img = article_details_images::find_this_id($take_id[0]);
				unlink(SITE_ROOT. DS . $delete_article_img->article_details_images_file_path()); 
				
				$sql = "DELETE FROM article_details_images WHERE article_details_images_id = '{$take_id[0]}'";
				$base->select_table($sql);
			}

		}
			redirect('../../user_images.php');	
	}



/*================================================
	DELETE Carousel image
==================================================*/
	if( isset($_GET['deleteObject']) && $_GET['tableName'] == 'carousel_imgs' || isset($_GET['deleteObject']) && $_GET['tableName'] == 'delete_carousel' ){
		$result = carousel_imgs::delete_carousel( $base->clear_string($_GET['deleteObject']) );
		redirect("../../index.php");
	}

	if( isset($_GET['delete_staff']) ){
		$result = carousel_imgs::delete_carousel( $base->clear_string($_GET['delete_staff']) );
	}
	

/*================================================ 
	DELETE MORE Carousel images
==================================================*/
	if(isset($_POST['array_of_checkboxes'])){
		$carousel_imgs = new carousel_imgs();
		$carousel_imgs->delete_more_carousel($_POST['array_of_checkboxes'], $_POST['select_form']);
		
		redirect("../../index.php");
	}
	

/*================================================ 
	DELETE Uploaded Image
==================================================*/
	if( isset($_GET['deleteObject']) && $_GET['tableName'] == 'uploaded_images' ){
		$result = $result = uploaded_image::delete_uploaded_image($_GET['deleteObject']);
			redirect("../../user_images.php");
	}

	if( isset($_GET['uploaded_image']) ){
		$result = uploaded_image::delete_uploaded_image($_GET['uploaded_image']);
			redirect("../../about.php");
	}	


/*================================================ 
	DELETE BIOGRAPHY 
==================================================*/
	if(isset($_GET['delete_biography_id'])){
		if(empty($_GET['delete_biography_id'])){
			redirect("../../about.php");
		}
		
		$clean_id = $base->clear_string($_GET['delete_biography_id']);
		$member_of_team = biographies::find_this_id($_GET['delete_biography_id']);
		
		//Delete added image for each member...	
		$delete_member_images = new_biography_image::find_this_query("SELECT * FROM add_biography_image WHERE biography_id = '{$clean_id}'");

		if($member_of_team){
			$member_of_team->delete_member();
			$member_of_team->delete();
			
			foreach($delete_member_images as $delete_images){
				//$delete_images->delete_new_biography_image();
				$delete_images->delete();
				unlink(SITE_ROOT. DS .$delete_images->biography_image_path());
			}
			
			redirect("../../about.php");
		}
			else{
				redirect("../../about.php");
			}
	}
		

/*================================================ 
	DELETE BIOGRAPHY on click "Obriši" from Left
	Menu
==================================================*/
	if( isset($_GET['deleteObject']) && $_GET['tableName'] == 'biography' && $_GET['dataType'] == 'biografija' ){
		global $base;
		
		$clean_member_id = $base->clear_string($_GET['deleteObject']);
		$member = biographies::find_this_id($clean_member_id);
		
		$delete_member_images = new_biography_image::find_this_query("SELECT * FROM add_biography_image WHERE biography_id = '{$clean_member_id}'");

		if($member){
			$member->delete_member();
			$member->delete();
			
			foreach($delete_member_images as $delete_images){
				//$delete_images->delete_new_biography_image();
				$delete_images->delete();
				unlink(SITE_ROOT. DS .$delete_images->biography_image_path());
			}
			
			redirect("../../user_images.php");
		}
			else{
				redirect("../../user_images.php");
			}

	}



/*================================================ 
	DELETE Attachment (CV) on click "Obriši" from
	Left Menu
==================================================*/
	if( isset($_GET['deleteObject']) && $_GET['tableName'] == 'biography' && $_GET['dataType'] == 'fajlovi' ){
		$clean_member_id = $base->clear_string($_GET['deleteObject']);
		$delete_biography_document = biographies::find_this_id($clean_member_id);
						
		unlink(SITE_ROOT. DS . $delete_biography_document->worker_files_path());
		$query = "UPDATE biography SET worker_biography_document = '' WHERE biography_id ='{$clean_member_id}'"; 
			$base->select_table($query);

			redirect('../../user_images.php');
	}



/*================================================ 
	Delete gallery image		
==================================================*/	
	if( isset($_GET['deleteObject']) && $_GET['tableName'] == 'delete_article' || isset($_GET['deleteObject']) && $_GET['tableName'] == 'articles' ){
		$result = articles::delete_article($base->clear_string($_GET['deleteObject']));	
			redirect("../../gallery.php");
	}

	if( isset($_GET['delete_gallery_img']) ){
		$result = articles::delete_article( $base->clear_string($_GET['delete_gallery_img']) );
	}

	if(isset($_POST['article_for_delete'])){
		$result = articles::delete_article($_POST['article_for_delete']);
			redirect("../../gallery.php");
	}



/*================================================ 
	DELETE MORE gallery Images (Articles)
==================================================*/	
	if(isset($_POST['array_of_articles_checkbox'])){
		$articles = new articles();
		echo $articles->delete_more_articles($_POST['array_of_articles_checkbox'], $_POST['select_articles_form']);
		
		redirect("../../gallery.php");
	}

	
/*================================================ 
	Delete Article Detail Image	
==================================================*/	
	if(isset($_GET['deleteObject']) && $_GET['tableName'] == 'article_details_images'){
		$result = article_details_images::delete_article_image($base->clear_string($_GET['deleteObject']));
			redirect("../../gallery.php");
	}



/*================================================ 
	Delete More Article Detail Images	
==================================================*/
	if( isset($_POST['preview-images-files-delete-option']) && isset($_POST['preview_images_files_id']) ){
		$delete_more = $_POST['preview_images_files_id'];
		foreach( $delete_more as $delete_once ){
			echo $take_id = explode(", ", $delete_once);

			$delete_article_img = article_details_images::find_this_id($take_id[0]);
			unlink(SITE_ROOT. DS . $delete_article_img->article_details_images_file_path()); 	
			$sql = "DELETE FROM article_details_images WHERE article_details_images_id = '{$take_id[0]}'";
				$base->select_table($sql);
		}
			redirect("../../gallery.php");
	}



/*================================================ 
	Delete More Images from Article Details Images
==================================================*/	
	if(isset($_POST['array_of_details_article_images_checkboxes'])){
		$article_details_images = new article_details_images();
		$article_details_images->delete_more_article_images($_POST['array_of_details_article_images_checkboxes'], $_POST['select_article_detail_form']);
		
		redirect("../../gallery.php");
	}



/*================================================ 
	Approve, Disable or Delete More Comments
==================================================*/									
	if( isset($_POST['submit_comment_options']) ){
		$array = $_POST['comments_id'];
		$comment_id = $_POST['comment-options'];

		if( !empty($comment_id) ){
			$articles = new articles_marks();
			$articles->comments_manipulation($array, $comment_id);
				redirect("../../user_comments.php");
		}
			else {
				redirect("../../user_comments.php");
			}
	} 


/*================================================ 
	Approve Comment through Ajax Paginate
==================================================*/
	if( isset($_GET['deleteObject']) && $_GET['dataType'] == 'approve_comment' ){
		// In this case variable "deleteObject" represents id of comment
		$id = $_GET['deleteObject'];
			articles_marks::approve_comment_status($id);
	}
	

/*================================================ 
	Block (disable) Comment through Ajax Paginate
==================================================*/
	if( isset($_GET['deleteObject']) && $_GET['dataType'] == 'disable_comment' ){
		// In this case variable "deleteObject" represents id of comment
		$id = $_GET['deleteObject'];
			articles_marks::disable_comment_status($id);
	}


/*================================================ 
	Delete Comment through Ajax Paginate
==================================================*/
	if( isset($_GET['deleteObject']) && $_GET['dataType'] == 'delete_comment' ){
		// In this case variable "deleteObject" represents id of comment
		$id = $_GET['deleteObject'];
			articles_marks::delete_comment($id);
	}	
	

/*=================================================
	Delete One Message - Left Menu "Poruke"
===================================================*/
	if( isset($_GET['message_id']) ){
		echo	$message = $_GET['message_id'];
		messages::delete_message($message);
			//redirect('../../user_messages.php');
	}

	// Ajax Pagination Delete Message ( One Message)
		if( isset($_GET['deleteObject']) && $_GET['dataType'] == 'delete_message' ){
			echo	$message = $_GET['deleteObject'];
			messages::delete_message($message);
				//redirect('../../user_messages.php');
		}


/*=================================================
	Delete One Message - Master Admin
===================================================*/
	if( isset($_GET['message_id']) ){
		echo	$message = $_GET['message_id'];
		messages_admin::delete_message($message);
			//redirect('../../user_messages.php');
	}

	// Ajax Pagination Delete Admin Message ( One Message)
		if( isset($_GET['deleteObject']) && $_GET['dataType'] == 'delete_admin_message' ){
			echo	$message = $_GET['deleteObject'];
			messages_admin::delete_message($message);
				//redirect('../../user_messages.php');
		}

	
/*=================================================
	Delete More Messages - Left Menu "Poruke"
===================================================*/	
	if( isset($_POST['submit_message_options']) ){
		$array = $_POST['messages_id'];
		$message_id = $_POST['delete_messages_options'];

		if( !empty($message_id) ){
			$messages = new messages();
			$messages->delete_more_messages($array, $message_id);
				redirect("../../user_messages.php");
		}
			else {
				redirect("../../user_messages.php");
			}
	} 


/*=================================================
	Delete More Messages - ADMIN
===================================================*/	
	if( isset($_POST['submit_admin_message_options']) ){
		$array = $_POST['admin_messages_id'];
		$message_id = $_POST['delete_admin_messages_options'];

		print_r($array);
		echo $message_id;
		if( !empty($message_id) ){
			$messages = new messages_admin();
			$messages->delete_more_messages($array, $message_id);
				redirect("../../master_admin_messages.php");
		}
			else {
				redirect("../../master_admin_messages.php");
			}
	} 
	


/*=================================================
	Delete More Contacts - Left Menu "Imenik"
===================================================*/	
	if( isset($_POST['submit_phonebook_options']) ){
		$array = $_POST['phonebook_id'];
		$delete_option = $_POST['delete_phonebook_contacts'];

		if( !empty($delete_option) ){
			$phonebook = new phonebook();
			$phonebook->delete_more_phonebook_contacts($array, $delete_option);
				redirect("../../user_phonebook.php");
		}
			else {
				redirect("../../user_phonebook.php");
			}
	}
	
	
	
	
	
	
	
	
	
?>	
