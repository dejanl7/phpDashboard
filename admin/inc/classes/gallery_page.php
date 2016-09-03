<?php

class gallery_page extends major_class{
	public static $table = 'gallery_page';
	public static $table_id = 'gallery_page_id';
	public static $fields_in_table = array('gallery_page_id','user_id','gallery_headline_font_weight','gallery_headline_font_type','gallery_headline_font_color', 'gallery_carousel_font_weight','gallery_carousel_font_type', 'gallery_carousel_font_color', 'gallery_carousel_background_color', 'gallery_first_div_font_weight', 'gallery_first_div_font_type', 'gallery_first_div_font_color','gallery_first_div_content_font_weight', 'gallery_first_div_content_font_type', 'gallery_first_div_content_font_color','gallery_first_div_background_color');
		
	public $gallery_page_id;
	public $user_id;
	public $gallery_headline_font_weight;
	public $gallery_headline_font_type;
	public $gallery_headline_font_color;
	public $gallery_carousel_font_weight;
	public $gallery_carousel_font_type;
	public $gallery_carousel_font_color;
	public $gallery_carousel_background_color;
	public $gallery_first_div_font_weight;
	public $gallery_first_div_font_type;
	public $gallery_first_div_font_color;
	public $gallery_first_div_content_font_weight;
	public $gallery_first_div_content_font_type;
	public $gallery_first_div_content_font_color;
	public $gallery_first_div_background_color;
	
	
	
	
}


?>