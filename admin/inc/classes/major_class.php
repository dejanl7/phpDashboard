<?php

class major_class{
	public $errors = array();
	public $errors_array = array(
			UPLOAD_ERR_OK 			=> "Nema greške",
			UPLOAD_ERR_INI_SIZE 	=> "Veličina fajla prevazilazi 'upload_max_filesize' dozvoljenu veličinu za upload.",
			UPLOAD_ERR_FORM_SIZE	=> "Veličina fajla prevazilazi 'MAX_FILE_SIZE' dozvoljenu veličinu za upload.",
			UPLOAD_ERR_PARTIAL		=> "Fajl je delimično upload-ovan.",
			UPLOAD_ERR_NO_FILE		=> "Fajl nije upload-ovan.",
			UPLOAD_ERR_NO_TMP_DIR	=> "Ne postoji direktorijum za preuzimanje fajla.",
			UPLOAD_ERR_CANT_WRITE	=> "Greška prilikom upisa fajla na disk.",
			UPLOAD_ERR_EXTENSION	=> "PHP ekstenzija je zaustavila upload fajla. "
		);


/*==================================================== 
	Find all users, comments, pictures... 
======================================================*/
public static function find_all(){
	global $base;
	$info = static::find_this_query("SELECT * FROM ".static::$table." ORDER BY ".static::$table_id." DESC"); //table - defined in file "database.php" That is name of table from database
	return $info;
}


/*==================================================== 
	Find by id - We are looking for information by 
	Id criteria... 
======================================================*/
public static function find_this_id($id){
	global $base;
	$thisId = static::find_this_query("SELECT * FROM ".static::$table." WHERE ".static::$table_id. " = '{$id}'");
	return !empty($thisId)?array_shift($thisId) : false;
}

	
/*==================================================== 
	Next function is fint_this_query... We are using this
	function to find and fetch information about users... 
======================================================*/
public static function find_this_query($query){
	global $base;
	
	$result = $base->select_table($query);
	$users_array = array();
	while($row = mysqli_fetch_object($result)){
		$users_array[] = static::all_data($row);
	}
		return $users_array;
}


/*====================================================  
	Break the array... We need to break array from 
	previous function. 
======================================================*/
public static function all_data($array){
	global $base;
	$the_objects = get_called_class();
	$object = new $the_objects;
	foreach($array as $key=>$value){
			if($object->consists_attributes($key)){
				$object->$key = $value;
			}
		}
		return $object;	
	}
	
/*====================================================  
	In next function we are checiking does object 
	consist function. 
======================================================*/
private function consists_attributes($key){
	$all_keys = get_object_vars($this);
	return array_key_exists($key, $all_keys);
}


/*====================================================  
	We need to defined keys and grant value for each key 
======================================================*/
private function values(){
	global $base;
	
	$values = array();
	foreach(static::$fields_in_table as $field=>$field_value){
		if(property_exists($this, $field_value)){
			$values[$field_value] = $this->$field_value;
		}
	}
	return $values;	
}


/*==================================================== 
	Now, we have to clean field_values from sql 
	injections... 
======================================================*/
private function clear_values(){
	global $base;
	
	$clean_values = array();
	foreach($this->values() as $key => $val){
		$clean_values[$key] = $base->clear_string($val);
	}
		return $clean_values;
	
}


/*==================================================== 
	Function "save". If table doesn't exist, this 
	method will create new elements like user, comments,
	pictures... In other case, this method will save 
	updates of table... 
======================================================*/
	public function save(){
		if(static::$table === 'users'){
			return isset($this->user_id) ? $this->update() : $this->create();
		}
		/*if(static::$tabela === 'slike'){
			return isset($this->id_slike) ? $this->azuriraj() : $this->kreiraj();
		}
		if(static::$tabela === 'fajlovi'){
			return isset($this->id_fajla) ? $this->azuriraj() : $this->kreiraj();
		}
		if(static::$tabela === 'komentari'){
			return isset($this->komentar_id) ? $this->azuriraj() : $this->kreiraj();
		}*/
	}



/*==================================================== 
	Create new (user, comment,message or anything else) 
	One note -> Inserting user defined in users.php
	because we need insert info into "about_us" table,
	in the same time when we are inserting user. 
======================================================*/
public function create(){
	global $base;
	$all_values = $this->clear_values();	
		
	$sql = "INSERT INTO ".static::$table ."(". implode(",", array_keys($all_values)) . ")";
	$sql .= "VALUES ('". implode("','", array_values($all_values))."')";
		//Insert new ID
			if($base->select_table($sql)){
					$this->user_id = $base->insert_id();
					return true;
				} 
					else{
						return false;
					}
			$sql .= $base->insert_id();

}	


/*==================================================== 
	Update user,comment,status or something else. 
======================================================*/
public function update(){
	global $base;
	$values = $this->clear_values();
	$values_for_update = array();
	foreach($values as $key => $value){
		$values_for_update[] = "{$key}='{$value}'";
	}
	if(static::$table === "users"){
		$sql = "UPDATE users SET ";
		$sql .= implode(", ", $values_for_update);
		$sql .= " WHERE user_id = ".$base->clear_string($this->user_id);
		$base->select_table($sql);
			return (mysqli_affected_rows($base->database_connection) == 1) ? true : false;
	}
	
}
	

/*==================================================== 
	DELETE 
======================================================*/
	public function delete(){
		global $base;
			if(static::$table === "biography"){
				$sql = "DELETE FROM biography WHERE biography_id = ".$base->clear_string($this->biography_id);
				$base->select_table($sql);
					return (mysqli_affected_rows($base->database_connection) == 1) ? true : false;
			}
			if(static::$table === "add_biography_image"){
				$sql = "DELETE FROM add_biography_image WHERE biography_id = ".$base->clear_string($this->biography_id);
				$base->select_table($sql);
					return (mysqli_affected_rows($base->database_connection) == 1) ? true : false;
			}
			if(static::$table === "contact_page"){
				$sql = "DELETE FROM contact_page WHERE contact_id = ".$base->clear_string($this->contact_id);
				$base->select_table($sql);
					return (mysqli_affected_rows($base->database_connection) == 1) ? true : false;
			}
	}
	
	
/*====================================================		
	Update background name for all pages	
======================================================*/	
	public static function update_background_img($background_img){
		global $base;
		$clean_background_img = $base->clear_string($background_img);
		
		$query = "UPDATE users SET background_img = '{$clean_background_img}' WHERE user_id ='{$_SESSION['user_id']}'";
			return $base->select_table($query);
	}

	
	
	
/*=================================================== 
	FUNCTION FOR IMAGE WIDTH AND HEIGHT WILL BE USE
	FOR	MORE PAGES. For that reason, I put these 
	functions in major class. 
======================================================*/	
/*==================================================== 
	Update img and insert WIDTH for img 
======================================================*/
	public static function img_width($img_width, $table_name){
		global $base;
		$clean_width = $base->clear_string($img_width);
		$clean_table_name = $base->clear_string($table_name);

		$sql_width = "UPDATE ". $clean_table_name. " SET image_width = '{$clean_width}' WHERE user_id = ".$base->clear_string($_SESSION['user_id'])."";
		return $base->select_table($sql_width);
		
	}


/*==================================================== 
	Update img and insert HEIGHT for img 
======================================================*/
	public static function img_height($img_height, $table_name){
		global $base;
		$clean_height = $base->clear_string($img_height);
		$clean_table_name = $base->clear_string($table_name);

		$sql_height = "UPDATE ". $clean_table_name. " SET image_height = '{$clean_height}' WHERE user_id = ".$base->clear_string($_SESSION['user_id'])."";
		return $base->select_table($sql_height);
	}
	

/*==================================================== 
	Update img - CHANGE IMAGE!!! We can use this 
	function to change any image from any table or 
	column.
======================================================*/
	public static function change_image($image_name, $table_name, $set_column){
		global $base;
		$clean_image_name = $base->clear_string($image_name);
		$clean_table_name = $base->clear_string($table_name);
		$clean_column_name = $base->clear_string($set_column);

		$sql_height = "UPDATE ". $clean_table_name." SET ".$clean_column_name." = '{$clean_image_name}' WHERE user_id = ".$base->clear_string($_SESSION['user_id'])."";
		return $base->select_table($sql_height);
	}

	
/*==================================================== 
	Update img - CHANGE SPECIFY IMG. We use this 
	function to change specify image. Example: 
	change biography member image (profile image)... 
======================================================*/	
	public static function change_specify_img($id, $image_name, $table_name, $column_name, $referent_column_name){
		global $base;

		$clean_id = $base->clear_string($id);
		$clean_image_name = $base->clear_string($image_name);
		$clean_table_name = $base->clear_string($table_name);
		$clean_column_name = $base->clear_string($column_name);
		$clean_referent_column_name = $base->clear_string($referent_column_name);
		
		$query = "UPDATE ". $clean_table_name ." SET ". $clean_column_name ." = '{$clean_image_name}' WHERE ". $clean_referent_column_name ." ='{$clean_id}'";
			return $base->select_table($query);	
	}
	
	
/*====================================================
	TinyMc function -> insert text into an appropriate
	table and column...
======================================================*/
	public static function tinyMc_insert_text($table_name, $column_name, $text){
		global $base;
		
		$clean_table_name = $base->clear_string($table_name);
		$clean_column_name = $base->clear_string($column_name);
		$clean_text = $base->clear_string($text);

		$sql = "UPDATE  ". $clean_table_name . " SET ". $clean_column_name ." = '{$clean_text}' WHERE user_id = " . $base->clear_string($_SESSION['user_id'])."";
		return $base->select_table($sql);
	}

	
/*====================================================
	INSERT INFORMATION FOR FONT TYPE AND WEIGHT
======================================================*/	
	public static function text_weight_type($table_name, $database_column1_name, $text_weight, $database_column2_name, $text_type){
		global $base;
		
		$clean_database_column1_name = $base->clear_string($database_column1_name);
		$clean_text_weight = $base->clear_string($text_weight);
		$clean_database_column2_name = $base->clear_string($database_column2_name);
		$clean_text_type = $base->clear_string($text_type);
		
		$sql = "UPDATE ". $table_name ." SET ".$clean_database_column1_name." = '$clean_text_weight' WHERE user_id = ".$base->clear_string($_SESSION['user_id'])."";
		$sql1 = "UPDATE ". $table_name ." SET ".$clean_database_column2_name." = '$clean_text_type' WHERE user_id = ".$base->clear_string($_SESSION['user_id'])."";
		
		$base->select_table($sql);
		$base->select_table($sql1);
	}
	

/*==================================================== 
	INSERT information into database from form
	(color, bgcolor, show/hide some part of page,
	show/hide pictures)
======================================================*/
	public static function insert_info_about_page($table_name, $database_column_name, $variable){
		global $base;
		
		$clean_database_column_name = $base->clear_string($database_column_name);
		$clean_variable = $base->clear_string($variable);
		$sql = "UPDATE ". $table_name ." SET ".$clean_database_column_name." = '$clean_variable' WHERE user_id = ".$base->clear_string($_SESSION['user_id']);
		return $base->select_table($sql);
		
	}


/*==================================================== 
	CSS FUNCTIONS 
======================================================*/ 	
	public static function css($table, $column, $id_user=''){
		global $base;
		
		$user_id = ( isset($id_user) && !empty($id_user) ? $id_user : $_SESSION['user_id'] );

		$clean_table = $base->clear_string($table);
		$clean_column = $base->clear_string($column);
		$clean_user_id = $base->clear_string($user_id);

		$looking_for_column = "SELECT * FROM " . $clean_table ." WHERE user_id = ". $user_id ."";
		$find = $clean_table::find_this_query($looking_for_column);
		
		foreach($find as $found){
			return $found->$clean_column;
		}
	}



/*==================================================== 
	COUNT ALL RECORD FROM SPECIFIC TABLE
======================================================*/
	public static function count_number_of_all_records_master_admin(){
		global $base;

		$sql 	= "SELECT COUNT(*) FROM ".static::$table;
		$result = $base->select_table($sql);
		$row 	= mysqli_fetch_array($result);
			return array_shift($row);
	}

/*==================================================== 
	COUNT ALL RECORD FROM SPECIFIC TABLE  WITH
	SPECIFIC ID
======================================================*/
	public static function count_number_of_records($id_user=''){
		global $base;

		$user_id = ( isset($_SESSION['user_id']) ? $_SESSION['user_id'] : $id_user );
		$clean_user_id = $base->clear_string($user_id);

		$sql 	= "SELECT COUNT(*) FROM ".static::$table. " WHERE user_id='{$clean_user_id}'";
		$result = $base->select_table($sql);
		$row 	= mysqli_fetch_array($result);
			return array_shift($row);
	}


/*====================================================
	Select Color Value for Specific Field on 
	SpecificPage
======================================================*/
	public static function select_color_for_input_field($column_name, $table_name){
		global $base;
		
		$query 			= "SELECT ". $column_name ." FROM ". $table_name ." WHERE user_id = '{$base->clear_string($_SESSION['user_id'])}' ";
		$all_recorords 	= $base->while_loop($query);

			while( $row = mysqli_fetch_object($all_recorords) ){
				echo $row->$column_name;
			}
	}	


/*====================================================
	Choose FONT Color Value for All Fields 
		(in all pages)	
======================================================*/
	public static function select_font_color_for_all_fields_all_pages($color){
		global $base;

		$clean_colors = $base->clear_string($color);
		
		$sql = "UPDATE index_page SET first_headline_font_color = '{$clean_colors}', first_div_font_color = '{$clean_colors}', second_headline_font_color = '{$clean_colors}', second_div_font_color = '{$clean_colors}' WHERE user_id = ".$base->clear_string($_SESSION['user_id']);
		
		$sql1 = "UPDATE about_us SET headline_font_color='{$clean_colors}', business_info_color='{$clean_colors}', business_info_content_color='{$clean_colors}', our_team_headline_fontcolor='{$clean_colors}', our_team_div_text_color='{$clean_colors}' WHERE user_id = ".$base->clear_string($_SESSION['user_id']);

		$sql2 = "UPDATE gallery_page SET gallery_headline_font_color='{$clean_colors}', gallery_carousel_font_color='{$clean_colors}', gallery_first_div_font_color = '{$clean_colors}', gallery_first_div_content_font_color='{$clean_colors}' WHERE user_id = ".$base->clear_string($_SESSION['user_id']);
		
		$sql3 = "UPDATE preview_page SET preview_headline_font_color='{$clean_colors}', preview_specifications_font_color='{$clean_colors}', preview_commentsHeadline_font_color='{$clean_colors}', preview_commentsContent_font_color='{$clean_colors}' WHERE user_id = ".$base->clear_string($_SESSION['user_id']);

		$sql4 = "UPDATE contact_page_css SET first_headline_content_font_color='{$clean_colors}', first_div_headline_font_color='{$clean_colors}', first_div_content_font_color='{$clean_colors}' WHERE user_id = ".$base->clear_string($_SESSION['user_id']);	

		$base->select_table($sql);
		$base->select_table($sql1);
		$base->select_table($sql2);
		$base->select_table($sql3);
		$base->select_table($sql4);
	}

/*====================================================
	Choose BACKGROUND Color Value for All Fields 
		(in all pages)
======================================================*/
	public static function select_background_color_for_all_fields_all_pages($color){
		global $base;
	
		$clean_colors = $base->clear_string($color);
		
		$sql = "UPDATE index_page SET first_div_background_color = '{$clean_colors}', second_div_background_color = '{$clean_colors}' WHERE user_id = ".$base->clear_string($_SESSION['user_id']);

		$sql1 = "UPDATE about_us SET business_info_content_bgcolor='{$clean_colors}', our_team_div_bg_color='{$clean_colors}' WHERE user_id = ".$base->clear_string($_SESSION['user_id']);

		$sql2 = "UPDATE gallery_page SET gallery_carousel_background_color='{$clean_colors}', gallery_first_div_background_color='{$clean_colors}' WHERE user_id = ".$base->clear_string($_SESSION['user_id']);		

		$sql3 = "UPDATE preview_page SET preview_content_background_color='{$clean_colors}', preview_specifications_background_color='{$clean_colors}', preview_content_commentBackground_color='{$clean_colors}' WHERE user_id = ".$base->clear_string($_SESSION['user_id']);

		$sql4 = "UPDATE contact_page_css SET first_div_content_background_color='{$clean_colors}' WHERE user_id = ".$base->clear_string($_SESSION['user_id']);


		$base->select_table($sql);
		$base->select_table($sql1);
		$base->select_table($sql2);
		$base->select_table($sql3);
		$base->select_table($sql4);
	}


/*====================================================
	Choose Font and Background Color Value for 
	SPECIFIC Page "index.php or about.php or gallery.php,
	or preview.php, or contact.php"	
======================================================*/
	public static function select_color_for_all_fields_in_one_page( $page, $color, $fields_array = array() ){
		global $base;
		
		$clean_page 	= $base->clear_string($page);
		$clean_colors 	= $base->clear_string($color);
		$count_array 	= sizeof($fields_array);

		$sql = "UPDATE ". $clean_page ." SET ";
		foreach($fields_array as $key => $field){
			if( $key < $count_array -1 ){
				$sql .=  $base->clear_string($field) ." = '{$clean_colors}', ";
			}
				else {
					$sql .=  $base->clear_string($field) ." = '{$clean_colors}' ";
				}
		}

		$sql .= " WHERE user_id = ". $base->clear_string($_SESSION['user_id']);
		
		$base->select_table($sql);
	}


/*====================================================
   Choose The Same Font Weight and Font Type for 
   ALL HEADLINE FIELDS in ALL Pages
======================================================*/
public static function select_headlinefield_font_style_for_all_pages($weight, $type){
	global $base;

	$clean_weight 	= $base->clear_string($weight);
	$clean_type 	= $base->clear_string($type);
	
	$sql = "UPDATE index_page SET first_headline_font_weight = '{$clean_weight}', first_headline_font_type = '{$clean_type}'  WHERE user_id = ".$base->clear_string($_SESSION['user_id']);

	$sql1 = "UPDATE about_us SET headline_font_weight = '{$clean_weight}', headline_font_type = '{$clean_type}'  WHERE user_id = ".$base->clear_string($_SESSION['user_id']);

	$sql2 = "UPDATE gallery_page SET gallery_headline_font_weight = '{$clean_weight}', gallery_headline_font_type = '{$clean_type}' WHERE user_id = ".$base->clear_string($_SESSION['user_id']);

	$sql3 = "UPDATE preview_page SET preview_headline_font_weight = '{$clean_weight}', preview_headline_font_type = '{$clean_type}', preview_commentsHeadline_font_weight='{$clean_weight}', preview_commentsHeadline_font_type='{$clean_type}'  WHERE user_id = ".$base->clear_string($_SESSION['user_id']);

	$sql4 = "UPDATE contact_page_css SET first_headline_content_weight = '{$clean_weight}', first_headline_content_type = '{$clean_type}' WHERE user_id = ".$base->clear_string($_SESSION['user_id']);
	

	$base->select_table($sql);
	$base->select_table($sql1);
	$base->select_table($sql2);
	$base->select_table($sql3);
	$base->select_table($sql4);
	
}


/*====================================================
	Choose The Same Font Weight and Font Type for 
	ALL TITLES in ALL Pages
======================================================*/
public static function select_title_font_style_for_all_pages($weight, $type){
	global $base;

	$clean_weight = $base->clear_string($weight);
	$clean_type = $base->clear_string($type);
	
	$sql = "UPDATE index_page SET first_div_font_weight = '{$clean_weight}', first_div_font_type = '{$clean_type}', second_headline_font_weight = '{$clean_weight}', second_headline_font_type = '{$clean_type}' WHERE user_id = ".$base->clear_string($_SESSION['user_id']);

	$sql1 = "UPDATE about_us SET business_info_weight = '{$clean_weight}', business_info_type = '{$clean_type}', our_team_headline_fontweight = '{$clean_weight}', our_team_headline_fonttype = '{$clean_type}' WHERE user_id = ".$base->clear_string($_SESSION['user_id']);

	$sql2 = "UPDATE gallery_page SET gallery_carousel_font_weight = '{$clean_weight}', gallery_carousel_font_type = '{$clean_type}', gallery_first_div_font_weight = '{$clean_weight}', gallery_first_div_font_type='{$clean_type}' WHERE user_id = ".$base->clear_string($_SESSION['user_id']);

	$sql3 = "UPDATE preview_page SET preview_commentsHeadline_font_weight = '{$clean_weight}', preview_commentsHeadline_font_type = '{$clean_type}' WHERE user_id = ".$base->clear_string($_SESSION['user_id']);
	
	$sql4 = "UPDATE contact_page_css SET first_div_headline_font_weight = '{$clean_weight}', first_div_headline_font_type = '{$clean_type}' WHERE user_id = ".$base->clear_string($_SESSION['user_id']);


	$base->select_table($sql);
	$base->select_table($sql1);
	$base->select_table($sql2);
	$base->select_table($sql3);
	$base->select_table($sql4);

}


/*====================================================
   Choose The Same Font Weight and Font Type for 
   ALL TEXT FIELDS in ALL Pages
======================================================*/
public static function select_textfield_font_style_for_all_pages($weight, $type){
	global $base;

	$clean_weight 	= $base->clear_string($weight);
	$clean_type 	= $base->clear_string($type);
	
	$sql = "UPDATE index_page SET second_div_font_weight = '{$clean_weight}', second_div_font_type = '{$clean_type}' WHERE user_id = ".$base->clear_string($_SESSION['user_id']);

	$sql1 = "UPDATE about_us SET business_info_content_weight = '{$clean_weight}', business_info_content_type = '{$clean_type}', our_team_div_font_weight = '{$clean_weight}', our_team_div_font_type = '{$clean_type}' WHERE user_id = ".$base->clear_string($_SESSION['user_id']);

	$sql2 = "UPDATE gallery_page SET gallery_first_div_content_font_weight = '{$clean_weight}', gallery_first_div_content_font_type = '{$clean_type}' WHERE user_id = ".$base->clear_string($_SESSION['user_id']);

	$sql3 = "UPDATE preview_page SET preview_specifications_font_weight = '{$clean_weight}', preview_specifications_font_type = '{$clean_type}', preview_commentsContent_font_weight='{$clean_weight}', preview_commentsContent_font_type='{$clean_type}' WHERE user_id = ".$base->clear_string($_SESSION['user_id']);

	$sql4 = "UPDATE contact_page_css SET first_div_content_font_weight = '{$clean_weight}', first_div_content_font_type = '{$clean_type}',  WHERE user_id = ".$base->clear_string($_SESSION['user_id']);
	

	$base->select_table($sql);
	$base->select_table($sql1);
	$base->select_table($sql2);
	$base->select_table($sql3);
	$base->select_table($sql4);
	
}



/*====================================================
   Choose The Same Font Weight and Font Type for 
   SPECIFIC Page (One page)
======================================================*/
	public static function select_font_style_for_one_page( $page, $weight, $type, $font_weight_fields = array(), $font_type_fields = array() ){
		global $base;
		
		global $base;
		
		$clean_page 	= $base->clear_string($page);
		$clean_size 	= $base->clear_string($weight);
		$clean_type 	= $base->clear_string($type);
		$count_array 	= sizeof($font_weight_fields);

		$sql = "UPDATE ". $clean_page ." SET ";
		foreach($font_weight_fields as $key => $field){
			if( $key < $count_array -1 ){
				$sql .=  $base->clear_string($field) ." = '{$clean_size}', " . $base->clear_string($font_type_fields[$key]) . " = '{$clean_type}', ";
			}
				else {
					$sql .=  $base->clear_string($field) ." = '{$clean_size}', " . $base->clear_string($font_type_fields[$key]) . " = '{$clean_type}'";
				}
		}

		$sql .= " WHERE user_id = ". $base->clear_string($_SESSION['user_id']);
		
		$base->select_table($sql);
	}




/*====================================================
	Date/Time Format
======================================================*/
	public static function date_time_format($date_time, $right_time=""){
		global $base;

		$clean_date_time = $base->clear_string($date_time);
		$clean_right_time = $base->clear_string($right_time);
		$date_content = new DateTime($clean_date_time);

		return date_format($date_content, "d.m.Y. ". $right_time); 
	}
	



/*====================================================
	Image Size - Create MB from KB
======================================================*/
	public static function create_mb_from_kb($kb){
		global $base;

		$clean_kb = $base->clear_string($kb);
		$value = $clean_kb/1024;

		return round($value)." MB";

	}



/*====================================================
	Image Name - Show Image Name Without ID
======================================================*/
	public static function show_img_name_without_id($img_name){
		global $base;

		$clean_img_name = $base->clear_string($img_name);
		
		$explode_img_name = explode(".",$clean_img_name);
		$string_length = sizeof($explode_img_name);
		
		return $explode_img_name[1].".".$explode_img_name[$string_length-1];

	}

	


}

?>