<?php

class preview_page extends major_class{
	public static $table = 'preview_page';
	public static $table_id = 'preview_page_id';
	public static $fields_in_table = array(
		'preview_page_id', 'user_id', 'preview_headliner_font_weight', 'preview_headline_font_type', 'preview_headline_font_color', 'preview_content_background_color', 'preview_content_show_hide', 'preview_specifications_font_weight', 'preview_specifications_font_type', 'preview_specifications_font_color', 'preview_specifications_background_color', 'preview_specifications_show_hide', 'preview_comment_show_hide', 'preview_commentsHeadline_font_color', 'preview_commentsHeadline_font_weight', '	preview_commentsHeadline_font_type', 'preview_commentsContent_font_color', 'preview_content_commentBackground_color', 'preview_commentsContent_font_weight', 'preview_commentsContent_font_type'
	);
		
	public $preview_page_id;
	public $user_id;
	public $preview_headline_font_weight;
	public $preview_headline_font_type;
	public $preview_headline_font_color;
	public $preview_content_background_color;
	public $preview_content_show_hide;
	public $preview_specifications_font_weight;
	public $preview_specifications_font_type;
	public $preview_specifications_font_color;
	public $preview_specifications_background_color;
	public $preview_specifications_show_hide;
	public $preview_comment_show_hide;
	public $preview_commentsHeadline_font_color;
	public $preview_commentsHeadline_font_weight;
	public $preview_commentsHeadline_font_type;
	public $preview_commentsContent_font_color;
	public $preview_content_commentBackground_color;
	public $preview_commentsContent_font_weight;
	public $preview_commentsContent_font_type;
	


/*================================================
	Select Comment Preview - according to user_id
==================================================*/
	public static function show_hide_comment($id_user=''){
		global $base;

		$user_id = ( isset($_SESSION['user_id']) ? $_SESSION['user_id'] : $id_user );
		$clean_user_id = $base->clear_string($user_id);

		$query = "SELECT * FROM preview_page WHERE user_id='{$clean_user_id}'";
		$result = self::find_this_query($query);
			return !empty($result)?array_shift($result) : false;
	}	
	
}

?>