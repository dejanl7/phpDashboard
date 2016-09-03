<?php

class about_us extends major_class{
	protected static $table = "about_us";
	protected static $table_id = "about_us_id";
	protected static $fields_in_table = array('about_us_id','user_id','headline_font_weight','headline_font_type', 'headline_font_color','menu_text_color','menu_bg_color','menu_text_weight',
		'menu_text_type','business_info_text','business_info_weight','business_info_type','business_info_color','business_info_content_weight','business_info_content_type','business_info_content_color','business_info_content_bgcolor',
		'business_info_leftImg','business_info_left_image_name','image_width','image_height','our_team_text','our_team_headline_fontweight','our_team_headline_fonttype','our_team_headline_fontcolor','our_team_div_font_weight',
		'our_team_div_font_type','our_team_div_text_color','our_team_div_bg_color','our_team_show_picture','our_team_show_div');
	
	public $about_us_id;
	public $user_id;
	public $headline_font_weight;
	public $headline_font_type;
	public $headline_font_color;
	public $menu_text_color;
	public $menu_bg_color;
	public $menu_text_weight;
	public $menu_text_type;
	public $business_info_text;
	public $business_info_weight;
	public $business_info_type;
	public $business_info_color;
	public $business_info_content_weight;
	public $business_info_content_type;
	public $business_info_content_color;
	public $business_info_content_bgcolor;
	public $business_info_leftImg;
	public $business_info_left_image_name;
	public $image_width;
	public $image_height;
	public $our_team_text;
	public $our_team_headline_fontweight;
	public $our_team_headline_fonttype;
	public $our_team_headline_fontcolor;
	public $our_team_div_font_weight;
	public $our_team_div_font_type;
	public $our_team_div_text_color;
	public $our_team_div_bg_color;
	public $our_team_show_picture;
	public $our_team_show_div;

	public $image_file = "img/background_images";
	
/*================================================
	Show choosed image in div "business_info" 
==================================================*/	
	public function left_image_path(){
		return $this->image_file . "/" . $this->business_info_left_image_name; 
	}
	


/*================================================
	Show Left Image Dimension
==================================================*/	
	public static function show_img_dimension($dimension_type){
	$img_dimension = "SELECT * FROM about_us WHERE user_id = ".$base->clear_string($_SESSION['user_id'])."";
		$show_img_size = about_us::find_this_query($img_dimension);
		foreach($show_img_size as $img){
			echo $img->$dimension_type;
		}
	}





	

	
	
	
}

	
	
?>