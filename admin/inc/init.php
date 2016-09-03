<?php
defined('DS')?null : define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT')? null : define('SITE_ROOT', DS. 'xampp' . DS. 'htdocs'. DS. 'Dashboard' . DS . 'admin');
 
defined('INCLUDES_PATH')? null : define('INCLUDES_PATH', SITE_ROOT .DS . 'img' . DS. 'uploaded_images');
	
	require_once("classes/connection.php");
	require_once("classes/database.php");
	require_once("classes/major_class.php");
	require_once("classes/biographies.php");
	require_once("classes/users.php");
	require_once("classes/index_page.php");
	require_once("classes/carousel_images.php");
	require_once("classes/about_us.php");
	require_once("classes/articles.php");
	require_once("classes/article_details.php");
	require_once("classes/article_details_images.php");
	require_once("classes/gallery_page.php");
	require_once("classes/preview_page.php");
	require_once("classes/contact.php");
	require_once("classes/contact_address.php");
	require_once("classes/sessions.php");
	require_once("classes/background_images.php");
	require_once("classes/uploaded_images.php");
	require_once("classes/add_new_biography_img.php");
	require_once("classes/articles_marks.php");
	require_once("classes/messages.php");
	require_once("classes/messages_admin.php");
	require_once("classes/view_images_files.php");
	require_once("classes/pagination.php");
	require_once("classes/full_calendar.php");
	require_once("classes/full_calendar_notifications.php");
	require_once("classes/phonebook.php");
	
	
	
	
	
/*===========================
	INCLUDE FUNCTIONS
=============================*/	
	require_once("functions/redirect.php");



?>