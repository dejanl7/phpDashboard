<?php 
    require_once("inc/init.php"); 
    global $base;

    if( isset($_GET['user_id']) || isset($_SESSION['user_id']) ){
        $user_id = ( isset($_GET['user_id']) ) ? $base->clear_string($_GET['user_id']) : $_SESSION['user_id'];
        $user = user::find_this_id($user_id);
    }
?>
<!DOCTYPE html>
<html lang="en"> <!-- WE ARE USEING THIS FILE TO INCLUDE IN ALL OTHER FILES EXCEPT "calendar.php"-->
  <head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="keywords" content="<?php echo (isset($_GET['user_id']) || isset($_SESSION['user_id']) ) ? $user->tags : ''; ?>"/>
    <meta name="description" content="<?php echo $user->business_description; ?>">
    
    <title>Unilink-Network</title>  
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.css"> <!-- Font Awesome -->
    <link rel="stylesheet" href="css/admin-general-style.css"><!-- General Dashboard Design  (Menus, Sidebars, Buttons and other basic elements) -->
    <link rel="stylesheet" href="css/plugins/color-picker-plugin/bootstrap-colorpicker.min.css" ><!-- Color Picker Plugin -->
    <link rel="stylesheet" href="css/bootstrap.min.css" rel="stylesheet" type="text/css" /><!-- Bootstrap min version -->
    <link rel="stylesheet" href="css/plugins/gallery-plugin/style_gallery.css" rel="stylesheet" type="text/css" media="all"/> <!-- CSS for moving-top -->
    <link rel="stylesheet" href="css/plugins/owl-carousel/owl.carousel.css">
    
    <!-- CustomCSS here -->
	<link href="css/style.css" rel="stylesheet" >