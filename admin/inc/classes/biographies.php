<?php

class biographies extends major_class{
	protected static $table = 'biography';
	protected static $table_id = 'biography_id';
	protected static $fields_in_table = array('biography_id','user_id','worker_name','worker_surname','worker_image','uploaded_time','worker_biography_document','proffesion');

	public $biography_id;
	public $user_id;
	public $worker_name;
	public $worker_surname;
	public $worker_image;
	public $uploaded_time;
	public $worker_biography_document;
	public $proffesion;

	public $biography_image_file = "img/biography_images";
	public $tmp_biography_image_path =""; //Original image name
	
	public $biography_document_file = "files/biography_files";
	public $tmp_biography_document_path = ""; //Original biography files name
	
	
	
/*================================================
 	Worker's images 
==================================================*/	
	public function worker_image_path(){
		return $this->biography_image_file . "/" . $this->worker_image; 
	}


/*================================================
	Worker's files 
==================================================*/	
	public function worker_files_path(){
		return $this->biography_document_file . "/" . $this->worker_biography_document; 
	}


/*================================================
	Set biography IMAGE for uploading 
==================================================*/	
	public function set_biography_image($biography_image){
		global $base; 

		$fileName = explode( '.', basename($biography_image['name']) );
		$acceptedExtension = array('jpg', 'jpeg', 'png', 'gif');

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
				$this->worker_image =  $_SESSION['user_id'].".".basename($biography_image['name']);
				$this->tmp_biography_image_path = $biography_image['tmp_name'];
				
				$this->user_id = $_SESSION['user_id'];
			}
	}


/*================================================ 
	Set biography FILE (DOCUMENT) for uploading 
==================================================*/	
	public function set_biography_document($biography_document){
		global $base;

		$fileName = explode( '.', basename($biography_document['name']) );
		$acceptedExtension = array('jpg', 'jpeg', 'png', 'gif', '.docsx', 'pdf');

		if(empty($biography_document) || !$biography_document || !is_array($biography_document)){
			$this->errors[] = "Ne postoji ni jedan fajl za upload.";
			return false;
		}
			else if($biography_document['error'] !=0){
				$this->errors[] = $this->errors_array[$biography_document['error']];
				return false;
			}
			else if ( $biography_document['size'] > 550000 || !in_array( $fileName[1], $acceptedExtension )  ){
				$this->errors = $this->errors_array[$carousel['error']];
			}
			else{
				$this->worker_biography_document =  $_SESSION['user_id'].".".basename($biography_document['name']);
				$this->tmp_biography_document_path = $biography_document['tmp_name'];
				$this->user_id = $_SESSION['user_id'];
			}
	}
	
	
/*================================================
	INSERT biography IMAGE and DOCUMENT 
==================================================*/	
	public function insert_biography_files(){
		if($this->biography_id){
			$this->update();
		}
		else{
			if(!empty($this->errors)){
				return false;
			}
			if(empty($this->worker_image) || empty($this->tmp_biography_image_path) || empty($this->worker_biography_document) || empty($this->tmp_biography_document_path)){
				$this->errors[] = "Fajl nije dostupan!";
				return false;
			}
			
			$target_path_image = SITE_ROOT . DS . $this->worker_image_path();
			$target_path_document = SITE_ROOT . DS . $this->worker_files_path();
				
				if(file_exists($target_path_image) || file_exists($target_path_document)){
					$this->errors[] = "Fajl {$this->worker_image} već postoji.";
					return false;
				}
				
				if(move_uploaded_file($this->tmp_biography_image_path, $target_path_image) && move_uploaded_file($this->tmp_biography_document_path, $target_path_document)){
					if($this->create()){
						unset($this->tmp_biography_image_path);
						unset($this->tmp_biography_document_path);
						return true;
					}
				}
					else{
						$this->errors[] ="Slika / fajl nema dozvolu za unos slike!";
						return false;
					}

		}
		
	}


/*================================================
	INSERT biography IMAGE for uploading 
==================================================*/	
	public function insert_biography_image(){
		if($this->biography_id){
			$this->update();
		}
		
		else{
			if(!empty($this->errors)){
				return false;
			}
			if(empty($this->worker_image) || empty($this->tmp_biography_image_path)){
				$this->errors[] = "Fajl nije dostupan!";
				return false;
			}
			
			$target_path = SITE_ROOT . DS . $this->worker_image_path();
				if(file_exists($target_path)){
					$this->errors[] = "Fajl {$this->worker_image} već postoji.";
					return false;
				}
				
				if(move_uploaded_file($this->tmp_biography_image_path, $target_path)){
					if($this->create()){
						unset($this->tmp_biography_image_path);
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
	INSERT biography FILE for uploading
==================================================*/	
	public function insert_biography_document(){
		if($this->biography_id){
			$this->update();
		}
		else{
			if(!empty($this->errors)){
				return false;
			}
			if(empty($this->worker_biography_document) || empty($this->tmp_biography_document_path)){
				$this->errors[] = "Fajl nije dostupan!";
				return false;
			}
			
			$target_path = SITE_ROOT . DS . DS . $this->worker_files_path();
				if(file_exists($target_path)){
					$this->errors[] = "Fajl {$this->worker_biography_document} već postoji.";
					return false;
				}
				
				if(move_uploaded_file($this->tmp_biography_document_path, $target_path)){
					if($this->create()){
						unset($this->tmp_biography_document_path);
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
 	UPDATE add_biography_document table. 
 	Column-name:"document_name". When we insert a
 	new biography document,automatically update
 	document name with new document name. 	
 ==================================================*/		
	public static function update_document_name($biography_id, $document_name){
		global $base;
		$clean_biography_id = $base->clear_string($biography_id);
		$clean_biography_document_name = $base->clear_string($document_name);
		
		$query = "UPDATE biography SET worker_biography_document = '{$clean_biography_document_name}' WHERE biography_id ='{$clean_biography_id}'";
			return $base->select_table($query);
	}

	
/*================================================ 
	UPLOAD INFO ABOUT MEMBERS.. There are info 
	like name, surname and proffesion.
==================================================*/
	public static function update_biography_info($biography_id, $worker_name, $worker_surname, $worker_proffesion){
		global $base;
		$clean_biography_id = $base->clear_string($biography_id);
		$clean_worker_name = $base->clear_string($worker_name);
		$clean_worker_surname = $base->clear_string($worker_surname);
		$clean_worker_proffesion = $base->clear_string($worker_proffesion);
		
		$query = "UPDATE biography SET worker_name = '{$clean_worker_name}', worker_surname = '{$clean_worker_surname}', proffesion = '{$clean_worker_proffesion}' 
				WHERE biography_id ='{$clean_biography_id}'";
		return $base->select_table($query);

	}
	

/*================================================ 
	DELETE MEMBER -	This function delete member 
	biography file from biography-file folder and
	biography image from biography_image folder	
==================================================*/
	public function delete_member(){
		global $base;
		if($this->delete()){
			$target_path_img = SITE_ROOT . DS . $this->worker_image_path();
			$target_path_document = SITE_ROOT . DS . $this->worker_files_path();
			unlink($target_path_img) ? true : false;
			unlink($target_path_document) ? true : false;
		}
			else{
				return false;
			}
	}
	
	
/*================================================ 
	DELETE Biography. When we upload new biography, 
	this function is deleting old DOCUMENT (CV)  
==================================================*/
	public function delete_document($biography_id){	
		global $base;
		
		$clean_biography_id = $base->clear_string($biography_id);
		$delete_biography_document = biographies::find_this_id($clean_biography_id);
			unlink(SITE_ROOT. DS . $delete_biography_document->worker_files_path()); 
		
		$query = "UPDATE biography SET worker_biography_document = '' WHERE biography_id ='{$clean_biography_id}'";
			return $base->select_table($query);
	}	
	


/*================================================ 
	Count All Records with FILES 
==================================================*/
	public static function count_all_biography_file(){
		global $base;
		
		$sql 	= "SELECT COUNT(*) FROM biography";
		$result = $base->select_table($sql);
		$row 	= mysqli_fetch_array($result);
			return array_shift($row);
	}


/*================================================ 
	Count All Records with FILES (specific ID)
==================================================*/
	public static function count_biography_file(){
		global $base;
		
		$sql 	= "SELECT COUNT(*) FROM biography WHERE user_id='{$base->clear_string($_SESSION['user_id'])}' AND worker_biography_document != ''";
		$result = $base->select_table($sql);
		$row 	= mysqli_fetch_array($result);
			return array_shift($row);
	}
	
}	