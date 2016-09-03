<?php




/*========================================================= PAGE "index.php" =============================================================*/
// Insert carousel IMAGE into carousel folder and carousel table in database
	function carousel_images($carousel_uploaded_img, $carousel_img_name){	
		if(isset($_FILES[$carousel_uploaded_img])){
			$courasel = new carousel_imgs();
			$courasel->set_carousel($_FILES[$carousel_uploaded_img]);
			$courasel->carousel_alt = $_POST[$carousel_img_name];
			$courasel->carousel_image_upload_date = date('Y-m-d H:i:s');
			
			$courasel->insert_carousel_in_database();

		}
	}



/*========================================================= PAGE "about.php" =============================================================*/
  // FUNCTION FOR INSERT IMAGE DIMENSION 		
	function image_dimension($width, $height, $column_name){
		if(isset($_POST[$width])){
			$width = $_POST[$width];
			$height = $_POST[$height];
			
			$insert_into_base = $column_name::img_width($width,$column_name);
			$insert_into_base = $column_name::img_height($height, $column_name);	
		}

	}
	
  // FUNCTION FOR CHANGE IMAGE (in page)    
	function substitution_image($image_name, $table_name, $column_name){
		if(isset($_POST[$image_name])){
			$image_name = $_POST[$image_name];
			$result = $table_name::change_image($image_name,$table_name,$column_name);
		}
	}

  // UPLOAD IMAGE (table: uploaded_images)      
	function uploading_image($image){
		if(isset($_FILES[$image])){
			$img = new uploaded_image();
			$img->set_image($_FILES[$image]);
			$img->uploaded_img_time = date('Y-m-d H:i:s');
			$img->insert_image_in_database();
		}	
	}

	
  // UPLOAD IMAGE (tables: add_biography_image, biography). Also - UPDATE info about each team member 
	function add_new_biography_image($image, $document, $biography_id, $name, $surname, $proffesion){
		global $base;
		// UPLOAD all info about member (name,last name, proffesion)... 
		if(isset($_POST[$biography_id])){	
			$biography_id_1 = $_POST[$biography_id];
			$name_1 = $_POST[$name];
			$surname_1 = $_POST[$surname];
			$proffesion_1 = $_POST[$proffesion];
			$result = biographies::update_biography_info($biography_id_1, $name_1, $surname_1, $proffesion_1);
			
		// If image exist, upload image and add new images... 	
			if(isset($_FILES[$image])){
				$img = new new_biography_image();
				$img->biography_id = $_POST[$biography_id];
				$img->set_new_biography_image($_FILES[$image]);
				$img->uploaded_time = date('Y-m-d H:i:s');
				$img->insert_new_biography_image();	
			}
		// If we want to change CV, we need to delete old CV, upload new CV and upload all other information 	
			if($_FILES[$document]['error'] != 4){
				
				$delete_member_images = biographies::find_this_id($_POST[$biography_id]);
				unlink(SITE_ROOT. DS .$delete_member_images->worker_files_path()); // Delete previous biography
				
			// Insert new biography document into "biography_files" 	
				move_uploaded_file($_FILES[$document]['tmp_name'], SITE_ROOT .DS. 'files/biography_files/'.$base->clear_string($_SESSION['user_id']).'.'.$_FILES[$document]['name']);
			
			// Update name of document in table (table: biography) ****************/		
				$update_document_name = biographies::update_document_name($_POST[$biography_id], $base->clear_string($_SESSION['user_id']).'.'.$_FILES[$document]['name']);
			}		
		}	
	}	

//	DELETE DOCUMENT (CV)	
						// It's not stricly bounded for page about.php                    3. 
	function delete_anything($cv, $class, $function){
		if(isset($_POST[$cv])){
			$delete = new $class();
			$result_of_delete = $delete->$function($_POST[$cv]);
		}
	}
	
// CHANGE Biography member IMAGE. We can choose among few images for each member and make choice about wanted picture. 			4. 	
	function change_specify_image($personal_img_id, $personal_img_name, $table_name, $column_name, $referent_column_name){
		if(isset($_POST[$personal_img_id])){
			$id = $_POST[$personal_img_id];
			$name = $_POST[$personal_img_name];
				$updated = biographies::change_specify_img($id, $name, $table_name, $column_name, $referent_column_name);
		}
	}
	

	
/*========================================================= PAGE "gallery.php" =============================================================*/
  // Add article (product, service)...
	function add_product($article_name, $article_price, $valute, $article_img, $user_id, $article_discount){
		if(isset($_POST[$article_name])){
			$article = new articles();
			$article->user_id = $user_id;
			$article->article_name = $_POST[$article_name];
				$clean_article_dot = str_replace(".","",$_POST[$article_price]);
				$clean_article_price = str_replace(",",".", $clean_article_dot);
			$article->article_price = $clean_article_price;
			$article->valute = $_POST[$valute];
			$article->set_article_image($_FILES[$article_img]);
			$article->article_uploaded_time = date('Y-m-d H:i:s');
			$article->article_discount = $_POST[$article_discount];
			
			$article->insert_article_image();	
			

		}
	}

  // Update article information...	
	function upload_gallery_article_info($article_id, $article_name, $article_price, $article_valute, $article_image, $article_discount){	
		if(isset($_POST[$article_id])){	
			global $base;

			$article_id1 = $_POST[$article_id];
			$article_name1 = $_POST[$article_name];
			$article_price_first_cleaning = str_replace(".","",$_POST[$article_price]);
				$article_price1 = str_replace(",",".", $article_price_first_cleaning);
			$article_valute1 = $_POST[$article_valute];
			$article_discount1 = $_POST[$article_discount];
			$result = articles::update_articles_info($article_id1, $article_name1, $article_price1, $article_valute1, $article_discount1);
			

		// We want to change image. First, we need to delete old image, then we need to upload new image, and at the end, we need to upload all other information 	
			if($_FILES[$article_image]['error'] != 4){
				$delete_article_image = articles::find_this_id($_POST[$article_id]);
				unlink(SITE_ROOT. DS .$delete_article_image->article_image_path()); // Delete previous biography
				
			// Insert new image into "articles_images" 
				$tmp_name = $_FILES[$article_image]['tmp_name'];
				$new_name = $base->clear_string($_SESSION['user_id']).'.'.$_FILES[$article_image]['name'];
				
				$fileName = explode( '.', basename($new_name) );
				$acceptedExtension = array('jpg', 'jpeg', 'png', 'gif');

				if ( $article_image['size'] > 550000 || !in_array( $fileName[2], $acceptedExtension )  ){
					return;
				}
				else{
					move_uploaded_file($tmp_name, SITE_ROOT .DS. 'img/articles_images/'.$new_name);
			
						// Update name of image in table (table: articles) ****************/		
							$update_image_name = articles::update_article_name($_POST[$article_id], $_FILES[$article_image]['name']);
				}

				
			}
			header("Location: ../../gallery.php");
		}	
	}
	


/*========================================================= PAGE "preview.php" =============================================================*/	
  // Add article (product, service)...
	function preview_new_img($preview_article_details_id, $preview_article_id, $preview_img_name, $preview_add_img ){	
		if(isset($_FILES[$preview_add_img])){
			$preview = new article_details_images();
			
			$preview->article_details_id = $_POST[$preview_article_details_id];
			$preview->article_id = $_POST[$preview_article_id];
			$preview->article_img_name = $_POST[$preview_img_name];
			$preview->article_img_uploaded_time = date('Y-m-d H:i:s');
			
			$preview->set_new_article_img($_FILES[$preview_add_img]);
			$preview->insert_new_article_img();

		}
	}






?>