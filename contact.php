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
<body class="contact">
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

    <div class="container about-contact-content">
      <div class="">
            <div class="col-xs-12 contact-admin-info"><br>
               <span><b>Adresa: Ravanička 3, Novi Sad</b></span><br>
               <span><b>Telefon: 062/123-456</b></span><br>
               <span><b>Fax: 021/123-6544</b></span><br>
               <span><b>E-mail: jovan@njegic.com</b></span><br>
            </div>
            <div class="col-xs-12 contact-admin-info-form">
                <form role="form" action="admin/inc/pages/pages_insert_info.php" id="contact-admin-info-require" method="POST">
                    <div class="col-xs-12 ">
                        <label>Ime *</label>
                        <input type="text" name="client_name" id="client_name" class="form-control" placeholder="Unesite Vaše ime" autocomplete="off" required>
                    </div>
                    <div class="col-xs-12">
                        <label>E-mail *</label>
                        <input type="email" name="client_email" id="client_email" class="form-control" placeholder="Unesite Vašu e-mail adresu" autocomplete="off"  required>
                    </div>
                    <div class="col-xs-12">
                        <label>Broj telefona</label>
                        <input type="tel" name="client_phone" id="client_phone" class="form-control" placeholder="Unesite broj telefona - nije obavezno" autocomplete="off">
                    </div>
                    
                    <div class="col-xs-12">
                        <label>Poruka</label>
                        <textarea class="form-control " id="client_message_content" name="client_message_content" rows="7" required ></textarea>
                    </div>
                    <div class="col-xs-12">
                      <br><input type="submit" name="submit_client_message" id="submit_client_message" value="Pošalji Poruku" class="btn btn-warning" />
                    </div>
                </form><!-- End of Form -->
            </div>
      </div>
    </div>


    <footer class="homepages-footer contact-page">
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