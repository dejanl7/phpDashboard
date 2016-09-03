<?php

class articles extends major_class{
	protected static $table = "articles";
	protected static $table_id = "article_id";
	protected static $fields_in_table = array('article_id','user_id','article_name','article_price','valute','article_img','article_uploaded_time','article_discount');

	public $article_id;
	public $user_id;
	public $article_name;
	public $article_price;
	public $valute;
	public $article_img;
	public $article_uploaded_time;
	public $article_discount;

	public $acrticle_image_file = "img/articles_images";
	public $tmp_article_image_path =""; //Original image name
	
		
/*================================================
	Define article image's path		
==================================================*/
	public function article_image_path(){
		return $this->acrticle_image_file . "/" . $this->article_img; 
	}


/*================================================ 	
	Set image for upload 	
==================================================*/
	public function set_article_image($article_img){
		global $base;

		$fileName = explode( '.', basename($article_img['name']) );
		$acceptedExtension = array('jpg', 'jpeg', 'png', 'gif');

		if(empty($article_img) || !$article_img || !is_array($article_img)){
			$this->errors[] = "Ne postoji ni jedan fajl za upload.";
			return false;
		}
			else if($article_img['error'] !=0){
				$this->errors[] = $this->errors_array[$article_img['error']];
				return false;
			}
			else if ( $article_img['size'] > 550000 || !in_array( $fileName[1], $acceptedExtension )  ){
				$this->errors = $this->errors_array[$carousel['error']];
			}
			else{
				$this->article_img = $_SESSION['user_id'].".".basename($article_img['name']);
				$this->tmp_article_image_path = $article_img['tmp_name'];
				$this->user_id = $_SESSION['user_id'];
			}
	}


/*================================================
	INSERT article IMAGE  
==================================================*/	
	public function insert_article_image(){
		if($this->article_id){
			$this->update();
		}
		
		else{
			if(!empty($this->errors)){
				return false;
			}
			if(empty($this->article_img) || empty($this->tmp_article_image_path)){
				$this->errors[] = "Fajl nije dostupan!";
				return false;
			}
			
			$target_path = SITE_ROOT . DS . $this->article_image_path();
				if(file_exists($target_path)){
					$this->errors[] = "Fajl {$this->article_name} već postoji.";
					return false;
				}
				
				if(move_uploaded_file($this->tmp_article_image_path, $target_path)){
					if($this->create()){
						unset($this->tmp_article_image_path);
						return true;
					}
				}
				else{
					$this->errors[] ="Slika nema dozvolu za unos!";
					return false;
				}
		}
	}


/*================================================
	DELETE Articles (product/service) image(s)... 
==================================================*/
	public function delete_article($article_id){	
		global $base;
		
		$clean_article_id = $base->clear_string($article_id);
		$delete_article_img = articles::find_this_id($clean_article_id);

		$delete_related_images = "SELECT * FROM article_details_images WHERE article_id='{$clean_article_id}'";
		$delete_article_details_images = article_details_images::find_this_query($delete_related_images);

			unlink(SITE_ROOT. DS . $delete_article_img->article_image_path()); 
			foreach($delete_article_details_images as $img){
				unlink(SITE_ROOT. DS . $img->article_details_images_file_path());
			}
		
		$sql = "DELETE FROM articles WHERE article_id = '{$clean_article_id}'";
			$base->select_table($sql);
	}	
	


/*================================================
	DELETE MORE ARTICLES...
==================================================*/
	public function delete_more_articles($array, $select){
		if($array){
			foreach($array as $value){
				global $base;
				switch ($select){
					case "delete_articles":
						$clean_article_id = $base->clear_string($value);
						$delete_articles = articles::find_this_id($value);

						$delete_related_images = "SELECT * FROM article_details_images WHERE article_id='{$clean_article_id}'";
						$delete_article_details_images = article_details_images::find_this_query($delete_related_images);
							unlink(SITE_ROOT. DS . $delete_articles->article_image_path());

							foreach($delete_article_details_images as $img){
								unlink(SITE_ROOT. DS . $img->article_details_images_file_path());
							}
							
						$sql = "DELETE FROM articles WHERE article_id = '{$clean_article_id}'";
						$sql1 = "DELETE FROM articles_marks WHERE article_id = '{$clean_article_id}'";
							$base->select_table($sql);
							$base->select_table($sql1);
							
					break;
				}
			}
		}	

	}


/*================================================
	Update article_image name in table: "articles".
	We use this function when user want to change
	profile image of article (any articles...)
==================================================*/
	public static function update_article_name($article_id, $article_image_name){
		global $base;
		$clean_article_id = $base->clear_string($article_id);
		$clean_article_image_name = $base->clear_string($_SESSION['user_id']).'.'.$base->clear_string($article_image_name);
		
		$query = "UPDATE articles SET article_img = '{$clean_article_image_name}' WHERE article_id ='{$clean_article_id}'";
			return $base->select_table($query);
	}
	

/*================================================
	UPLOAD INFO ABOUT MEMBERS.. There are info
	about name, surname and proffesion.
==================================================*/
	public static function update_articles_info($article_id, $article_name, $article_price, $article_valute, $article_discount){
		global $base;
		$clean_article_id = $base->clear_string($article_id);
		$clean_article_name = $base->clear_string($article_name);
		$clean_article_price = $base->clear_string($article_price);
		$clean_article_valute = $base->clear_string($article_valute);
		$clean_article_discount = $base->clear_string($article_discount);
		
		$query = "UPDATE articles SET article_name = '{$clean_article_name}', article_price = '{$clean_article_price}', valute = '{$clean_article_valute}', article_discount = '{$clean_article_discount}' 
				WHERE article_id ='{$clean_article_id}'";
		return $base->select_table($query);

	}	
	
	

	
}
	
?>