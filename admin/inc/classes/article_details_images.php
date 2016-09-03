<?php

class article_details_images extends major_class{
	protected static $table = "article_details_images";
	protected static $table_id = "article_details_images_id";
	protected static $fields_in_table = array('article_details_images_id','article_details_id','article_id','user_id','article_img_name','article_img_alt','article_img_uploaded_time');
	
	public $article_details_images_id;
	public $article_details_id;
	public $article_id;
	public $user_id;
	public $article_img_name;
	public $article_img_alt;
	public $article_img_uploaded_time;
	
	public $article_details_images_file = "img/articles_images";
	public $tmp_article_details_images_path =""; // Original image name
	
	
	
	
	
/*================================================
	Define article_details_img path		
==================================================*/
	public function article_details_images_file_path(){
		return $this->article_details_images_file . "/" . $this->article_img_name; 
	}


/*================================================
 	Set image for upload 	
 ================================================= */
	public function set_new_article_img($add_article_img){
		global $base;

		$fileName = explode( '.', basename($add_article_img['name']) );
		$acceptedExtension = array('jpg', 'jpeg', 'png', 'gif');


		if(empty($add_article_img) || !$add_article_img || !is_array($add_article_img)){
			$this->errors[] = "Ne postoji ni jedan fajl za upload.";
			return false;
		}
			else if($add_article_img['error'] !=0){
				$this->errors[] = $this->errors_array[$add_article_img['error']];
				return false;
			}
			else if ( $add_article_img['size'] > 550000 || !in_array( $fileName[1], $acceptedExtension )  ){
				$this->errors = $this->errors_array[$carousel['error']];
			}
			else{
				$this->article_img_name = $_SESSION['user_id'].".".basename($add_article_img['name']);
				$this->tmp_article_details_images_path = $add_article_img['tmp_name'];
				$this->user_id = $_SESSION['user_id'];
			}
	}


/*================================================
 	INSERT article IMAGE  
==================================================*/	
	public function insert_new_article_img(){
		if($this->article_details_images_id){
			$this->update();
		}
		
		else{
			if(!empty($this->errors)){
				return false;
			}
			if(empty($this->article_img_name) || empty($this->tmp_article_details_images_path)){
				$this->errors[] = "Fajl nije dostupan!";
				return false;
			}
			
			$target_path = SITE_ROOT . DS . $this->article_details_images_file_path();
				if(file_exists($target_path)){
					$this->errors[] = "Fajl {$this->article_img_alt} već postoji.";
					return false;
				}
				
				if(move_uploaded_file($this->tmp_article_details_images_path, $target_path)){
					if($this->create()){
						unset($this->tmp_article_details_images_path);
						return true;
					}
				}
				else{
					$this->errors[] ="Slika nema dozvolu za unos slike!";
					return false;
				}
		}
	}
	


/*================================================  
	DELETE image for specific article.
==================================================*/
	public function delete_article_image($article_image){	
		global $base;
		
		$clean_article_image = $base->clear_string($article_image);
		$delete_article_img = article_details_images::find_this_id($clean_article_image);
			unlink(SITE_ROOT. DS . $delete_article_img->article_details_images_file_path()); 
		
		$sql = "DELETE FROM article_details_images WHERE article_details_images_id = '{$clean_article_image}'";
			$base->select_table($sql);
	}	



	
	
	
	
	
	
	
	
	
	
}

?>