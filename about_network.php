<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="author" content="Dejan Loncar, Unilink-Finance, Unilink-Network">
  <meta name="viewport" content="width=device-width, initial-scale = 1, maximum-scale=1, user-scalable=no">
  
  <title>Unilink - network</title>

    <link rel="stylesheet" href="admin/css/bootstrap-3.3.5/bootstrap.min.css"><!-- Bootstrap 3.3.5 -->
    <link href="admin/css/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link rel="stylesheet" href="admin/css/home-pages.css">
</head>
<body class="about_network_page">
<div class="se-pre-con"></div>
<?php require('admin/inc/home-files/home_index_page_navbar.php'); ?> 


    <div id="demo">
      <div class="container-fluid">
        <div class="row">
          <div class="span12">
            <div id="owl-demo" class="owl-carousel"> 
                <?php 
                  $background_images_array = array('admin/img/index-page/ideas.jpg', 'admin/img/index-page/hard-work.jpg', 'admin/img/index-page/hard-work1.jpg', 'admin/img/index-page/knowledge.jpg', 'admin/img/index-page/planning.jpg', 'admin/img/index-page/success.jpg', 'admin/img/index-page/success1.jpg', 'admin/img/index-page/tree.jpg');
                  foreach( $background_images_array as $bg_image ):
                ?>
                    <div class="item" style="background-image: url('<?php echo $bg_image; ?>');"></div>
                <?php endforeach; ?>

            </div><!-- .owl-carousel -->
          </div><!-- .span12 -->
        </div><!-- .row -->
      </div><!-- .container-fluid -->
    </div><!-- #demo -->

    <div class="container about-contact-content content-about">
           <h2 class="text-center">POLJE ZA UNOS SADRŽAJA</h2>
           <p>Lorem Ipsum је једноставно модел текста који се користи у штампарској и словослагачкој индустрији. Lorem ipsum је био стандард за модел текста још од 1500. године, када је непознати штампар узео кутију са словима и сложио их како би направио узорак књиге. Не само што је овај модел опстао пет векова, него је чак почео да се користи и у електронским медијима, непроменивши се. Популаризован је шездесетих година двадесетог века заједно са листовима летерсета који су садржали Lorem Ipsum пасусе, а данас са софтверским пакетом за прелом као што је Aldus PageMaker који је садржао Lorem Ipsum верзије.
          </p>
    </div>
  


    <footer class="homepages-footer">
        <p>Copyright © Unilink-finance 2016</p>
    </footer>



  <script src="admin/js/jquery-1.12.3.min.js"></script>
  <script src="admin/js/bootstrap.min.js"></script>
  <script src="admin/js/index-page-jquery.js"></script>
  <script src="admin/js/plugins/owl-carousel/owl.carousel.js"></script>
  <script src="admin/js/plugins/color_picker/js/jquery-2.1.4.min.js"></script>
  <script src="admin/js/jquery.form-validator.js"></script>
  <script src="admin/js/home-index-page.js"></script>

  <!-- Preloader -->
  <script>
    // Wait for window load
    $(window).load(function() {
      // Animate loader off screen
      $(".se-pre-con").fadeOut("slow");;
    });
  </script>

</body>
</html>