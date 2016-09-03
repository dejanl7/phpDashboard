<?php

class images_files_view extends major_class{
	public static $table = 'business_network_images_files';
	public static $table_id = 'user_id';
	public static $fields_in_table = array('user_id','image_file_id','image_name','uploaded_time', 'type', 'db_table');
		
	public $user_id;
	public $image_file_id;
	public $image_name;
	public $uploaded_time;
	public $type;
	public $db_table;



}