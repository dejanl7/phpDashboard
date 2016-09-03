<?php

class index_page extends major_class{
	protected static $table = "index_page";
	protected static $table_id = "index_id";
	protected static $fields_in_table = array('index_id','user_id', 'first_headline_font_weight','first_headline_font_type', 'first_headline_font_color','first_div_font_weight','first_div_font_type','first_div_font_color',
		'first_div_background_color','second_headline_font_weight','second_headline_font_type','second_headline_font_color','second_div_font_weight','second_div_font_type','second_div_text','second_div_font_color','second_div_background_color');
	
	public $index_id;
	public $user_id;
	public $first_headline_font_weight;
	public $first_headline_font_type;
	public $first_headline_font_color;
	public $first_div_font_weight;
	public $first_div_font_type;
	public $first_div_font_color;
	public $first_div_background_color;
	public $second_headline_font_weight;
	public $second_headline_font_type;
	public $second_headline_font_color;
	public $second_div_text;
	public $second_div_font_weight;
	public $second_div_font_type;
	public $second_div_font_color;
	public $second_div_background_color;



}

?>