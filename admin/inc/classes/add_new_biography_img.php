<?php

class new_biography_image extends major_class{
	protected static $table = 'add_biography_image';
	protected static $table_id = 'new_biography_id';
	protected static $fields_in_table = array('new_biography_id','biography_id','user_id','image_name','uploaded_time');

	public $new_biography_id;
	public $biography_id;
	public $user_id;
	public $image_name;
	public $uploaded_time;

	public $new_biography_image_file = "img/biography_images";
	public $new_tmp_biography_image_path =""; //Original image name
	

/*================================================
	Images Path 
==================================================*/
	public function biography_image_path(){
		return $this->new_biography_image_file . "/" . $this->image_name; 
	}

/*================================================
	Set biography IMAGE for uploading 
==================================================*/	
	public function set_new_biography_image($biography_image){
		global $base;

		$fileName = explode( '.', basename($biography_image['name']) );
		$acceptedExtension = array('jpg', 'jpeg', 'png', 'gif', '.docsx', 'pdf');

		if(empty($biography_image) || !$biography_image || !is_array($biography_image)){
			$this->errors[] = "Ne postoji ni jedan fajl za upload.";
			return false;
		}
			else if($biography_image['error'] !=0){
				$this->errors[] = $this->errors_array[$biography_image['error']];
				return false;
			}
			else if ( $biography_image['size'] > 550000 || !in_array( $fileName[1], $acceptedExtension )  ){
				$this->errors = $this->errors_array[$carousel['error']];
			}
			else{
				$this->image_name =  $_SESSION['user_id'].".".basename($biography_image['name']);
				$this->new_tmp_biography_image_path = $biography_image['tmp_name'];
				$this->user_id = $_SESSION['user_id'];
			}
	}

/*================================================
	INSERT biography IMAGE 
================================================*/	
	public function insert_new_biography_image(){
		if($this->new_biography_id){
			$this->update();
		}
		else{
			if(!empty($this->errors)){
				return false;
			}
			if(empty($this->image_name) || empty($this->new_tmp_biography_image_path)){
				$this->errors[] = "Fajl nije dostupan!";
				return false;
			}
			
			$target_path = SITE_ROOT .DS . $this->biography_image_path();
			
				if(file_exists($target_path)){
					$this->errors[] = "Fajl {$this->image_name} već postoji.";
					return false;
				}
				
				if(move_uploaded_file($this->new_tmp_biography_image_path, $target_path)){
					if($this->create()){
						unset($this->new_tmp_biography_image_path);
						return true;
					}
				}
				else{
					$this->errors[] ="Slika nema dozvolu za unos slike!";
					return false;
				}

		}
		
	}








}	
	
?>