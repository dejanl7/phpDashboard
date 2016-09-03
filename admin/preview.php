<?php include("inc/header.php"); ?><!-- Include header -->
<?php
	if(!$session->session_status()){
		redirect("login.php");
	}
?>
<?php 
	global $base;
	$status = user::find_this_id( $base->clear_string($_SESSION['user_id']) );
	if( $status->active == 0 ){
		redirect('logout.php');
	}
	
	if($user->role == 'master_admin' ){
		redirect('logout.php');
	}

	if( empty($_GET['article_id']) ){
		redirect('gallery.php');
	}
?>
<!-- Bootstrap 3.3.5 - for showing STARS rating  -->
	<link href="css/bootstrap-3.3.5/bootstrap.min.css" rel="stylesheet" >
	<link href="css/plugins/star-rating-plugin/simple_rating_system.css" rel="stylesheet" type="text/css"/><!-- Simple Rating - for Vote -->


<!-- CSS Files for Display rating -->
	<link href="css/plugins/star-rating-plugin/star-rating.css" rel="stylesheet" media="all" rel="stylesheet" type="text/css"/>
	<link href="css/plugins/gallery-plugin/style_gallery.css" rel="stylesheet" type="text/css" media="all" >
	<link href="css/plugins/gallery-plugin/etalage.css" rel="stylesheet" type="text/css" media="all">
	<link href="css/plugins/gallery-plugin/easy-responsive-tabs.css" rel="stylesheet" type="text/css" media="all" >

<!-- STYLE FOR ALL PAGE -> using information from database for creating page style -->
<style>	
	#index_headline{
		color: <?php echo index_page::css("index_page","first_headline_font_color"); ?>;	
	}		
	
	#top_menu{
		background-color:<?php echo about_us::css('about_us', 'menu_bg_color'); ?>;	
		color:<?php echo about_us::css('about_us', 'menu_text_color'); ?>;
	}
	.change_text_color{
		color:<?php echo about_us::css('about_us', 'menu_text_color'); ?>; 
	}
	#preview_headline_container{
		color:<?php echo preview_page::css('preview_page','preview_headline_font_color'); ?>;
	}
	#preview_whole{
		background-color:<?php echo preview_page::css('preview_page','preview_content_background_color'); ?>;
	}
	#edit_article_container{
		color:<?php echo preview_page::css('preview_page','preview_specifications_font_color'); ?>;
		background-color:<?php echo preview_page::css('preview_page','preview_specifications_background_color'); ?>;
	}
	#comments_container {
		color:<?php echo preview_page::css('preview_page','preview_commentsHeadline_font_color'); ?>;
	}
	.comment-content-container {
		color:<?php echo preview_page::css('preview_page','preview_specifications_background_color'); ?>;
		background-color:<?php echo preview_page::css('preview_page','preview_specifications_background_color'); ?>;
	}
	.comments-div, .comments-div .comment-content {
		color:<?php echo preview_page::css('preview_page','preview_commentsContent_font_color'); ?>;
		background-color:<?php echo preview_page::css('preview_page','preview_content_commentBackground_color'); ?>;
	}
</style>  

</head>
<body  class="hold-transition skin-blue sidebar-mini <?php echo ($user->left_menu_collapse== '1' ? ' sidebar-collapse' : ''); ?>" data-menustate=<?php echo ($user->left_menu_collapse== '1' ? ' collapsed' : ' not-collapsed');  ?>>
<div class="se-pre-con"></div><!-- Preloader Div -->
<!-- 
	This Page uses jSimple-Star-Rating and Etalage Plugin
		Copyright (c) 2013 - 2016, Kartik Visweswaran
		Krajee.com
		All rights reserved.

		Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

		Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.

		Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.

		Neither the names of Kartik Visweswaran or Krajee nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.

		THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

	Etalage Licence:
	This document certifies the purchase of:
	ONE REGULAR LICENSE
	as defined in the standard terms and conditions on Envato Market.

	Licensor's Author Username: Frique
	Licensee: Dejan Loncar

	For the item:
	Etalage

	https://codecanyon.net/item/etalage/180719
	Item ID: 180719
 -->

<div class="wrapper" id='wrapper_index'>
<!-- INCLUDE ALL SEPARATED FILES -->
	<?php include("inc/top_menu.php"); ?>
	<?php include("inc/left_menu.php"); ?>

	
<section class="bo" id="bo_preview" style="
		background: url(img/background_images/<?php
			$query = "SELECT * FROM users WHERE user_id = ". $base->clear_string($_SESSION['user_id']);
			$find = user::find_this_query($query);
			foreach($find as $background){
				echo $background->background_img;
			}
			//echo background_image();
		?>)
		no-repeat center center fixed;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover; 
		">

		
<!-- CONTEXT MENUES -->
	<div id="body" class="dropdown clearfix">
		<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px;">
		  <li><a id="body_bg_image" class="remodal-bg" href="#" tabindex="-1" data-remodal-target="remodal_change_background_image">Promeni sliku pozadine</a></li>
		</ul>
	</div>	
	
	<div id="preview_headline_context" class="dropdown clearfix">
		<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px; cursor:pointer;">
		  <li><a tabindex="-1" id="preview_hl_weight" data-font="headline" data-page="preview_page">Izaberite font naslova</a></li>
		  <li><a tabindex="-1" id="preview_hl_color" data-color="font_color" data-page="preview_page"  attr="<?php preview_page::select_color_for_input_field('preview_headline_font_color', 'preview_page'); ?>" >Izaberite boju teksta</a></li>
		</ul>
	</div>
	
	<div id="context_top_menu" class="dropdown clearfix">
		<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px; cursor:pointer;">
		  <li><a tabindex="-1" id="top_menu_color" data-color="font_color" data-page="preview_page"  attr="<?php about_us::select_color_for_input_field('menu_text_color', 'about_us'); ?>">Boja slova</a></li>
		  <li><a tabindex="-1" id="top_menu_background" data-color="background_color"  data-page="preview_page"  attr="<?php about_us::select_color_for_input_field('menu_bg_color', 'about_us'); ?>">Boja pozadine glavnog menija</a></li>
		  <li><a tabindex="-1" id="top_menu_font">Izaberite font</a></li>
		</ul>
	</div>
	
	<div id="context_preview_new_img" class="dropdown clearfix">
		<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px;">
		  <li><a tabindex="-1" id="add_product_content" href="#" class="remodal-bg" data-remodal-target="remodal_preview_new_img">Dodaj sliku proizvoda ili usluge</a></li>
		  <li><a tabindex="-1" id="delete_product_content" href="#" class="remodal-bg" data-remodal-target="remodal_preview_delete_img">Obriši sliku proizvoda ili usluge</a></li>
		  <li><a tabindex="-1" id="preview_first_div_bg_color" data-color="background_color"  data-page="preview_page"  attr="<?php preview_page::select_color_for_input_field('preview_content_background_color', 'preview_page'); ?>">Izaberite boju pozadine</a></li>
		  <li><a tabindex="-1" id="preview_first_div_show_hide">Prikaži/sakrij ocene artikla</a></li>
		</ul>
	</div>
	
	<div id="context_preview_article_info" class="dropdown clearfix">
		<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px;">
		  <li><a tabindex="-1" id="preview_add_product_content" href="#" class="remodal-bg" data-remodal-target="remodal_preview_edit_article_info">Uredite informacije o artiklu</a></li>
		  <li><a tabindex="-1" id="preview_specifications_font_weight_type" data-font="text" data-page="preview_page">Izaberite font</a></li>
		  <li><a tabindex="-1" id="preview_specifications_text_color" data-color="font_color" data-page="preview_page"  attr="<?php preview_page::select_color_for_input_field('preview_specifications_font_color', 'preview_page'); ?>">Izaberite boju teksta</a></li>
		  <li><a tabindex="-1" id="preview_specifications_background_color" data-color="background_color"  data-page="preview_page"  attr="<?php preview_page::select_color_for_input_field('preview_specifications_background_color', 'preview_page'); ?>">Izaberite boju pozadine</a></li>
		  <li><a tabindex="-1" id="preview_specifications_show_hide"> Prikaži/sakrij deo za ocenu artikla</a></li>
		  <li><a tabindex="-1" id="preview_comments_show_hide"> Prikaži/sakrij deo za komentare</a></li>
		</ul>
	</div>

	<div id="preview_comment_headline_context" class="dropdown clearfix">
		<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px; cursor:pointer;">
		  <li><a tabindex="-1" id="preview_comment_hl_weight" data-font="title" data-page="preview_page">Izaberite font naslova</a></li>
		  <li><a tabindex="-1" id="preview_comment_hl_color" data-color="font_color" data-page="preview_page"  attr="<?php preview_page::select_color_for_input_field('preview_commentsHeadline_font_color', 'preview_page'); ?>" >Izaberite boju teksta</a></li>
		</ul>
	</div>

	<div id="preview_comment_context" class="dropdown clearfix">
		<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block; margin-bottom:5px; cursor:pointer;">
		  <li><a tabindex="-1" id="preview_comment_weight" data-font="text" data-page="preview_page">Izaberite font</a></li>
		  <li><a tabindex="-1" id="preview_comment_background_color" data-color="background_color"  data-page="preview_page" attr="<?php preview_page::select_color_for_input_field('preview_content_commentBackground_color', 'preview_page'); ?>">Izaberite boju pozadine</a></li>
		  <li><a tabindex="-1" id="preview_comment_color" data-color="font_color" data-page="preview_page"  attr="<?php preview_page::select_color_for_input_field('preview_commentsContent_font_color', 'preview_page'); ?>" >Izaberite boju teksta</a></li>

		</ul>
	</div>

<!-- END CONTEXT MENUES -->

	<?php include("inc/pages/boxes_for_page_preview.php"); ?><!-- Include file "boxes_for_page_about.php" -->
	<div id="preview_headline_container" class="brand">
		<div id="preview_headline" class="text-center" style="
			font-size: <?php echo preview_page::css('preview_page',"preview_headline_font_weight"); ?>;	
			font-family: <?php echo preview_page::css('preview_page',"preview_headline_font_type"); ?>;
		"><br>
			<?php 
				$company_name = user::find_this_id($session->user_id_session);
				echo $company_name->name;
			?>
		</div>
	</div><!-- .brand -->

		<br/><br/>

	<?php include("inc/main_menu.php"); ?><!-- Include file "main_menu.php" -->   
	<div class="container">
		<div class="box" id="preview_whole">
			<div class="col-sm-12">
				<?php include("templates/galery_and_preview_page/preview_template.php"); ?> <!-- Include template with jquery plugins and JAVASCRIPT and CSS files... -->
			</div><!-- .row -->
		</div><!-- #preview_whole -->
	</div>
<!-- lnclude Footer and other JavaScript Files. Specially coution is on Star Rating System... -->
	<?php include("inc/footer.php"); ?>

		<script src="js/plugins/gallery_plugin/js/easyResponsiveTabs.js"></script>
		<script src="js/plugins/gallery_plugin/js/star-rating.js"></script>
		<script src="js/plugins/star_rating/show_rating/star-rating.js"></script>

		<script src="js/plugins/color_picker/docs_for_page_preview.js"></script>

</section><!-- #bo_preview -->
</div><!-- #wrapper -->

</body>
</html>