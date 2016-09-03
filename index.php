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
  <link rel="stylesheet" href="admin/css/home-pages.css">>     
</head>
<body>
<div class="se-pre-con"></div>
<?php require('admin/inc/home-files/home_index_page_navbar.php'); ?> 

    <div id="demo" class="container-fluid">
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
  	</div><!-- #demo -->
    
      <div class="col-sm-4 col-xs-12 search-bar">
    	    <form method="GET" action="searching_results.php" class="form-group search-company">
    	      <input type="text" name="search_company_input" class="search_company_input" placeholder="Unesite naziv preduzeća" autocomplete="off" />
    	      <button type="submit" id="search_submit" class="glyphicon glyphicon-search"></button>
    	    </form><!-- .search-company -->
              <div class="index-searching-result-company"></div>

              <div class="col-sm-6 col-xs-10 col-xs-offset-1 advanced-search-options">
                <button class="btn advance-search-button">NAPREDNA PRETRAGA</button>
                <div class="col-xs-10 col-xs-offset-1 advance-searching">
                      <h4 class="text-center"><b>Napredna Pretraga</b></h4>
                      <div class="row advance-searching-form-client">
                        <form method="GET" action="searching_results.php">
                            <div class="col-sm-4 col-xs-12 client-advance-search-form">
                              <label for="client-search-info-activities">Područje Delatnosti</label>
                              <select class="form-control client-search-info-activities" name="client-search-info-activities" >
                                  <option value="">Izaberite Tip Delatnosti</option>
                                  <option value="Proizvodnja">Proizvodnja</option>
                                  <option value="Trgovina">Trgovina</option>
                                  <option value="Ugostiteljstvo">Ugostiteljstvo</option>
                                  <option value="Transport">Transport</option>
                                  <option value="Uslužna Delatnost">Uslužna Delatnost</option>
                              </select>
                            </div>
                            <div class="col-sm-4 col-xs-12 client-advance-search-form>">
                                <label for="search-by-city-client">Sedište Preduzeća</label>
                                  <tr><td>
                                    <input  type="text" class="form-control client-search-by-city" name="client-search-by-city" placeholder="Sedište" autocomplete="off" />
                                  </td></tr>
                            </div>
                            <div class="col-sm-4 col-xs-12 client-advance-search-form">
                                <label for="search-by-key-words">Ključne Reči</label>
                                  <tr><td>
                                    <input  type="text" class="form-control client-search-by-key-words" name="client-search-by-key-words"  placeholder="Ključne reči" autocomplete="off" />
                                  </td></tr>
                            </div>
                            <div class="col-sm-12 col-xs-12 client-advance-search-form-submit">
                                  <tr><td>
                                    <input  type="submit" class="btn btn-warning" id="submit-advance-searching" name="submit-advance-searching" value="Pretraži" />
                                  </td></tr>
                            </div>
                        </form>

                      </div><!-- /.row -->
                </div><!-- .advance-searching -->
              </div>
      </div><!-- .search-bar-->
      
      


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