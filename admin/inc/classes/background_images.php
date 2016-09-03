<?php

class background_image extends major_class{
	protected static $table = "background_images";
	protected static $table_id = "bg_image_id";
	protected static $fields_in_table = array('bg_image_id','user_id','bg_image_name','bg_image_alt_text','selected_background_image');

	public $bg_image_id;
	public $user_id;
	public $bg_image_name;
	public $bg_image_alt_text;
	public $selected_background_image;
	
	public $image_file = "img/background_images";

	
/*================================================
	PATH to the background image 
==================================================*/
	public function bg_image_path(){
		return $this->image_file . "/" . $this->bg_image_name; 
	}
	

/*================================================ 
	CHANGE BACKGROUND IMAGE!!! 
==================================================*/
	public static function change_bg_image($bg_image_name){
		global $base;
		$clean_bg_image_name = $base->clear_string($bg_image_name);

		$sql_height = "UPDATE background_images SET selected_background_image = '1' WHERE bg_image_name = '{$clean_bg_image_name}'";
		$base->select_table($sql_height);
		
		$sql_height_other_images = "UPDATE background_images SET selected_background_image = '0' WHERE bg_image_name != '{$clean_bg_image_name}'";
		$base->select_table($sql_height_other_images);
	}	

}	
	
	
?>