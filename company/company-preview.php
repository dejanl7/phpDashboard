<?php
 	if( empty($_GET['article_id']) ){
		header('Location: ../index.php');
	} 
?>
<?php include("../admin/inc/home-files/home_header.php"); ?><!-- Include header -->
<?php 
	global $base;
	$status = user::find_this_id( $base->clear_string($_GET['user_id']) );
?>
<!-- Bootstrap 3.3.5 - for showing STARS rating  -->
	<link href="../admin/css/bootstrap-3.3.5/bootstrap.min.css" rel="stylesheet" >
	<link href="../admin/css/plugins/star-rating-plugin/simple_rating_system.css" rel="stylesheet" type="text/css"/><!-- Simple Rating - for Vote -->


<!-- CSS Files for Display rating -->
	<link href="../admin/css/plugins/star-rating-plugin/star-rating.css" rel="stylesheet" media="all" rel="stylesheet" type="text/css"/>
	<link href="../admin/css/plugins/gallery-plugin/style_gallery.css" rel="stylesheet" type="text/css" media="all" >
	<link href="../admin/css/plugins/gallery-plugin/etalage.css" rel="stylesheet" type="text/css" media="all">
	<link href="../admin/css/plugins/gallery-plugin/easy-responsive-tabs.css" rel="stylesheet" type="text/css" media="all" >

<!-- STYLE FOR ALL PAGE -> using information from database for creating page style -->
<style>	
	#index_headline{
		color: <?php echo index_page::css("index_page","first_headline_font_color", $_GET['user_id']); ?>;	
	}		
	
	#top_menu{
		background-color:<?php echo about_us::css('about_us', 'menu_bg_color', $_GET['user_id']); ?>;	
		color:<?php echo about_us::css('about_us', 'menu_text_color', $_GET['user_id']); ?>;
	}
	.change_text_color{
		color:<?php echo about_us::css('about_us', 'menu_text_color', $_GET['user_id']); ?>; 
	}
	#preview_headline_container{
		color:<?php echo preview_page::css('preview_page','preview_headline_font_color', $_GET['user_id']); ?>;
	}
	#preview_whole{
		background-color:<?php echo preview_page::css('preview_page','preview_content_background_color', $_GET['user_id']); ?>;
	}
	#edit_article_container{
		color:<?php echo preview_page::css('preview_page','preview_specifications_font_color', $_GET['user_id']); ?>;
		background-color:<?php echo preview_page::css('preview_page','preview_specifications_background_color', $_GET['user_id']); ?>;
	}
	#comments_container {
		color:<?php echo preview_page::css('preview_page','preview_commentsHeadline_font_color', $_GET['user_id']); ?>;
	}
	.comment-content-container {
		color:<?php echo preview_page::css('preview_page','preview_specifications_background_color', $_GET['user_id']); ?>;
		background-color:<?php echo preview_page::css('preview_page','preview_specifications_background_color', $_GET['user_id']); ?>;
	}
	.comments-div, .comments-div .comment-content {
		color:<?php echo preview_page::css('preview_page','preview_commentsContent_font_color', $_GET['user_id']); ?>;
		background-color:<?php echo preview_page::css('preview_page','preview_content_commentBackground_color', $_GET['user_id']); ?>;
	}
</style>  

</head>
<body class="hold-transition skin-blue sidebar-mini">
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
<?php include("../admin/inc/home-files/home_top_menu.php"); ?>
			
<section class="bo" id="bo_preview" style="
		background: url(../admin/img/background_images/<?php
			$query = "SELECT * FROM users WHERE user_id = ". $base->clear_string($_GET['user_id']);
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

	<div id="preview_headline_container" class="brand text-center">
		<div id="preview_headline" style="
			font-size: <?php echo preview_page::css('preview_page',"preview_headline_font_weight", $base->clear_string($_GET['user_id'])); ?>;	
			font-family: <?php echo preview_page::css('preview_page',"preview_headline_font_type", $base->clear_string($_GET['user_id'])); ?>;
		"><br>
			<?php 
				$company_name = user::find_this_id($base->clear_string($_GET['user_id']));
				echo $company_name->name;
			?>
		</div>
	</div><!-- .brand -->

		<br/><br/>

	<?php include("../admin/inc/home-files/home_main_menu.php"); ?><!-- Include file "main_menu.php" -->  
	<div class="container">
		<div class="box" id="preview_whole">
			<div class="row">
				<?php include("../admin/inc/home-files/home_preview_page_template.php"); ?> <!-- Include template with jquery plugins and JAVASCRIPT and CSS files... -->
			</div><!-- .row -->
		</div><!-- #preview_whole -->

<!-- lnclude Footer and other JavaScript Files. Specially coution is on Star Rating System... -->
	<?php include("../admin/inc/home-files/home_footer.php"); ?>

	<script src="../admin/js/jquery-1.12.3.min.js"></script>

	<script src="../admin/js/functions_js/js_media.js"></script>
	<script src="../admin/js/plugins/gallery_plugin/easyResponsiveTabs.js" type="text/javascript"></script>	
	<script src="../admin/js/plugins/gallery_plugin/jquery.etalage.js"></script>
	<script src="../admin/js/plugins/star_rating/show_rating/star-rating.js"></script>



</section><!-- #bo_preview -->
</div><!-- #wrapper -->

</body>
</html>