<?php include("../init.php"); ?><!-- Include header -->
<?php
	if(!$session->session_status()){
		redirect("login.php");
	}
?>
<?php
include("../functions/pages_functions/insert_media.php");


// Submit BACKGROUND IMAGE in ALL PAGES!!!!!!! 
	if(isset($_POST['bg_img_name'])){
		$clean_bg_img_name = $base->clear_string($_POST['bg_img_name']);
		$result = user::update_background_img($clean_bg_img_name);	
	}

/* ============================================================ PAGE "index.php" ==============================================================*/

// Insert image into carousel folder and carousel table in database
	carousel_images('carousel_image_choose','carousel_image_name');




/*============================================================ PAGE "about.php" ==============================================================*/
  // Change left(top) image in "business_info" div "INFORMACIJE O POSLOVANJU" 
	substitution_image('img_name','about_us','business_info_left_image_name');

  // IMAGE DIMENSION			
	image_dimension('imgWidth','imgHeight','about_us');
	
  // UPLOAD IMAGE 
	uploading_image('img');
	
  // In next part of code, we won't use function because function "LAST_INSERT_ID" makes problem when code is written like function. For that reason
  // we create code (without function) "UPLOAD BIOGRAPHY IMAGE" (table: biography, add_biography_image).
	// We use this function when we want to INSERT new BIOGRAPHY MEMBER. 
	// This function creates record in table biography and consist all inserted info about member's biography. In the same time, this function insert record into table: 
	//	"add_biography_image". We created this wey because we want to take image from table "add_biography_image" for changeable purposes... 
		if(isset($_FILES['biography_img'])){
			global $base;
			$biography = new biographies();
			$biography->worker_name = $_POST['name'];
			$biography->worker_surname = $_POST['surname'];
			$biography->proffesion = $_POST['proffesion'];
			$biography->uploaded_time = date('Y-m-d H:i:s');

			// If file for uploading biography document is empty, we will use condition "IF" 
			//We are selecting condition like ...['error'] == 4. Number 4 means that file no exist in some form field.		
			if($_FILES['biography_doc']['error'] == 4){
				$biography->set_biography_image($_FILES['biography_img']);
				$biography->insert_biography_image();
				
				$last_insert_id = $base->insert_id();
				$biography_name = $base->clear_string($_SESSION['user_id']).".".$_FILES['biography_img']['name'];
				$sql = "INSERT INTO add_biography_image(biography_id,user_id,image_name,uploaded_time) VALUES ('{$last_insert_id}','{$base->clear_string($_SESSION['user_id'])}','{$biography_name}','{$biography->uploaded_time}')";
					$base->select_table($sql);
				
			}
			else{
				$biography->set_biography_image($_FILES['biography_img']);
				$biography->set_biography_document($_FILES['biography_doc']);	
				$biography->insert_biography_files();	
				
				$last_insert_id = $base->insert_id();
				$biography_name = $base->clear_string($_SESSION['user_id']).".".$_FILES['biography_img']['name'];
				$sql = "INSERT INTO add_biography_image(biography_id,user_id,image_name,uploaded_time) VALUES ('{$last_insert_id}','{$base->clear_string($_SESSION['user_id'])}','{$biography_name}','{$biography->uploaded_time}')";
					$base->select_table($sql);
			}	
			header('Location: ../../about.php');		
		}

	
  // NEW BIOGRAPHY IMAGE - we use this function if we want to insert new image for the same member in our team part.... 	
	add_new_biography_image('azuriraj_sliku','azuriraj_dokument','data_append','azuriraj_ime','azuriraj_prezime','azuriraj_profesiju');	

  // DELETE DOCUMENT (CV) 
	delete_anything('delete_biography_CV', 'biographies', 'delete_document');
		
  // CHANGE biography PROFILE image 
	change_specify_image('personal_img_id','personal_img_name','biography','worker_image','biography_id');
	




/*============================================================ PAGE "gallery.php" ==============================================================*/	
  // Add article (product, services...). For some reason, articles can't be added if we create them like function ("insert_images_functions"). For that reason, complete code is written here...
	if(isset($_POST['product_name'])){
		$article = new articles();
		$clean_user = $base->clear_string($_SESSION['user_id']);
			$article->user_id = $clean_user;
		$article->article_name = $_POST['product_name'];
			$clean_article_dot = str_replace(".","",$_POST['product_price']);
			$clean_article_price = str_replace(",",".", $clean_article_dot);
		$article->article_price = $clean_article_price;
		$article->valute = $_POST['valute'];
		$article->set_article_image($_FILES['product_img']);
		$article->article_uploaded_time = date('Y-m-d H:i:s');
		$article->article_discount = $_POST['product_discount'];
		
		$article->insert_article_image();	
		
		// Insert info into "article_details" table...
		$last_insert_id = $base->insert_id();
			$sql = "INSERT INTO article_details(article_id,user_id, article_details_uploaded_time) VALUES ('{$last_insert_id}','{$base->clear_string($_SESSION['user_id'])}','{$article->article_uploaded_time}')";
				$base->select_table($sql);
	}
// Update information about article (article name, price, discount, valute and picture)...
	upload_gallery_article_info('update_article_id','update_article_name','update_article_price','update_valute','update_article_img','update_article_discount');



/*============================================================ PAGE "preview.php" ==============================================================*/	
	// Add new images for specify article
		 preview_new_img('preview_article_details_id', 'preview_article_id', 'preview_new_img', 'preview_new_img_choose');
























	
	
?>