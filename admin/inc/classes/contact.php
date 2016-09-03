<?php

class contact_page_css extends major_class{
	protected static $table = "contact_page_css";
	protected static $table_id = "contact_page_css_id";
	protected static $fields_in_table = array('contact_page_css_id','user_id','first_headline_content_weight','first_headline_content_type', 'first_headline_content_font_color','first_div_headline_font_weight',
		'first_div_headline_font_type','first_div_headline_font_color','first_div_content_font_weight','first_div_content_font_type','first_div_content_font_color','first_div_content_background_color','show_hide_second_div_contact');
	

	public $contact_page_css_id;
	public $user_id;
	public $first_headline_content_weight;
	public $first_headline_content_type;
	public $first_headline_content_font_color;
	public $first_div_headline_font_weight;
	public $first_div_headline_font_type;
	public $first_div_headline_font_color;
	public $first_div_content_font_weight;
	public $first_div_content_font_type;
	public $first_div_content_font_color;
	public $first_div_content_background_color;
	public $show_hide_second_div_contact;

}

?>