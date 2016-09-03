<?php

class carousel_imgs extends major_class{
	protected static $table = "carousel_imgs";
	protected static $table_id = "carousel_id";
	protected static $fields_in_table = array('carousel_id','user_id','carousel_image_name','carousel_alt','carousel_image_upload_date');
	
	public $carousel_id;
	public $user_id;
	public $carousel_image_name;
	public $carousel_alt;
	public $carousel_image_upload_date;
	
	public $carousel_images = "img/carousel_images";
	public $carousel_tmp_path =""; 

	
/*==================================================== 
	PATH to the uploaded CAROUSEL images 
======================================================*/
	public function carousel_path(){
		return $this->carousel_images . '/' . $this->carousel_image_name; 
	}
	

/*====================================================
	Function for setting image into form 
======================================================*/	
	public function set_carousel($carousel){
		global $base;

		$fileName = explode( '.', basename($carousel['name']) );
		$acceptedExtension = array('jpg', 'jpeg', 'png', 'gif');

		if(empty($carousel) || !$carousel || !is_array($carousel)){
			$this->errors = "Ne postoji slika za unos.";
		}
			else if($carousel['error'] != 0){
				$this->errors = $this->errors_array[$carousel['error']];
			}
			else if ( $carousel['size'] > 550000 || !in_array( $fileName[1], $acceptedExtension )  ){
				$this->errors = $this->errors_array[$carousel['error']];
			}
			else{
				$this->carousel_image_name = $_SESSION['user_id'].".".basename($carousel['name']);
				$this->user_id = $base->clear_string($_SESSION['user_id']);
				$this->carousel_tmp_path = $carousel['tmp_name'];
	
			}		
	}
	

/*==================================================== 
	Function for MOVE CAROUSEL image into folder 
		(carousel_images - subfolder) 
======================================================*/	
	public function insert_carousel_in_database(){
		if($this->carousel_id){
			$this->update();
		}
		else{
			if(!empty($this->errors)){
				return false;
			}

			$carousel_destination = SITE_ROOT . DS . $this->carousel_path();
				
			if(file_exists($carousel_destination)){
				echo $this->errors[] = "slika {$this->carousel_image_name} vec postoji.";
				return false;
			}
		
			if(move_uploaded_file($this->carousel_tmp_path, $carousel_destination)){
				$this->create();
				unset($this->carousel_tmp_path);
				return true;
			}
		}
	}
	
	
/*====================================================
 	DELETE Carousel image... 
======================================================*/
	public static function delete_carousel($carousel_id){	
		global $base;
		
		$clean_carousel_id = $base->clear_string($carousel_id);
		$delete_carousel_file = carousel_imgs::find_this_id($clean_carousel_id);
			unlink(SITE_ROOT. DS . $delete_carousel_file->carousel_path()); 
		
		$sql = "DELETE FROM carousel_imgs WHERE carousel_id = '{$clean_carousel_id}'";
			$base->select_table($sql);
	}	
	
	
/*==================================================== 
	DELETE MORE Carousel images ...
======================================================*/
	public function delete_more_carousel($array, $select){
		if($array){
			foreach($array as $value){
				global $base;
				switch ($select){
					case "delete_carousel_imgs":
						$clean_carousel_id = $base->clear_string($value);
						$delete_imgs = carousel_imgs::find_this_id($value);
							unlink(SITE_ROOT. DS . $delete_imgs->carousel_path());
							
						$sql = "DELETE FROM carousel_imgs WHERE carousel_id = '{$clean_carousel_id}'";
							$base->select_table($sql);
							
					break;
				}
			}
		}	

	}




}




?>