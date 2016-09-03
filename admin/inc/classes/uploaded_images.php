<?php

class uploaded_image extends major_class{
	protected static $table = "uploaded_images";
	protected static $table_id = "uploaded_img_id";
	protected static $fields_in_table = array('uploaded_img_id','user_id','uploaded_img_name','uploaded_img_size','uploaded_img_type','uploaded_img_description','uploaded_img_time');

	public $uploaded_img_id;
	public $user_id;
	public $uploaded_img_name;
	public $uploaded_img_size;
	public $uploaded_img_type;
	public $uploaded_img_description;
	public $uploaded_img_time;
	
	public $image_file = "img/uploaded_images";
	public $tmp_path =""; //Original image name

	
/*==================================================== 
	PATH to the uploaded images 
======================================================*/	
	public function image_path(){
		return $this->image_file . '/' . $this->uploaded_img_name; 
	}

	
/*==================================================== 
	Function for setting image into form 
======================================================*/	
	public function set_image($image){
		global $base;
		
		$fileName = explode( '.', basename($image['name']) );
		$acceptedExtension = array('jpg', 'jpeg', 'png', 'gif');

		if(empty($image) || !$image || !is_array($image)){
			$this->errors = "Ne postoji slika za unos.";
		}
			else if($image['error'] != 0){
				$this->errors = $this->errors_array[$image['error']];
			}
			else if ( $image['size'] > 550000 || !in_array( $fileName[1], $acceptedExtension )  ){
				$this->errors = $this->errors_array[$carousel['error']];
			}
			else{
				$this->uploaded_img_name = $_SESSION['user_id'].".".basename($image['name']);
				$this->user_id = $base->clear_string($_SESSION['user_id']);
				$this->tmp_path = $image['tmp_name'];
				$this->uploaded_img_type = $image['type'];
				$this->uploaded_img_size = $image['size'];		
			}		
	}
	

/*==================================================== 
	Function for insert image into img folder 
		(uploaded_images -subfolder) 
======================================================*/	
	public function insert_image_in_database(){
		if($this->uploaded_img_id){
			$this->update();
		}
		else{
			if(!empty($this->errors)){
				return false;
			}
			
			$type = explode("/",$this->uploaded_img_type);
			$img_destination = SITE_ROOT . DS . $this->image_path();
				
			if(file_exists($img_destination)){
				echo $this->errors[] = "slika {$this->uploaded_img_name} već postoji.";
				return false;
			}
		
			if(move_uploaded_file($this->tmp_path, $img_destination)){
				$this->create();
				unset($this->tmp_path);
				return true;
			}
		}
	}
	
	

/*==================================================== 
	Delete Uploaded Image
======================================================*/
	public static function delete_uploaded_image($image_id){	
		global $base;
		
		$clean_image_id = $base->clear_string($image_id);
		$delete_image_file = uploaded_image::find_this_id($clean_image_id);
			unlink(SITE_ROOT. DS . $delete_image_file->image_path()); 
		
		$sql = "DELETE FROM uploaded_images WHERE uploaded_img_id = '{$clean_image_id}'";
			$base->select_table($sql);
	}	
	
	
}	
	
	
?>