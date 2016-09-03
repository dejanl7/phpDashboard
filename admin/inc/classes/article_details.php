<?php

class article_details extends major_class{
	protected static $table = "article_details";
	protected static $table_id = "article_details_id";
	protected static $fields_in_table = array('article_details_id','article_id','user_id','article_model','article_specifications','article_details_uploaded_time');
	
	public $article_details_id;
	public $article_id;
	public $user_id;
	public $article_model;
	public $article_specifications;
	public $article_details_uploaded_time;
	
	
/*================================================
	TinyMc function -> insert text into 
	an appropriate table and Appropriate column
==================================================*/
	public static function tinyMc_insert_dataArticle($table_name, $column_name, $text, $article_id){
		global $base;
		
		$clean_table_name = $base->clear_string($table_name);
		$clean_column_name = $base->clear_string($column_name);
		$clean_text = $base->clear_string($text);
		$clean_article_id = $base->clear_string($article_id);

		$sql = "UPDATE  ". $clean_table_name . " SET ". $clean_column_name ." = '{$clean_text}' WHERE article_id = '{$clean_article_id}'";
		return $base->select_table($sql);
	}
	
	
	
	
	
	
	
}

?>