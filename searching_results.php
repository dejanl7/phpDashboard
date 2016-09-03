<?php   

    if( isset($_GET['search_company_input']) ){
      if( empty($_GET['search_company_input']) ){
          header('Location: index.php'); 
      }
    } 

    else if( isset($_GET['submit-advance-searching']) ){
      $business_activity = $_GET['client-search-info-activities'];
      $business_place    = $_GET['client-search-by-city'];
      $key_words         = $_GET['client-search-by-key-words'];
        if( empty($business_activity) && empty($business_place) && empty($key_words) ){
            header('Location: index.php'); 
        }
    } 
  
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="author" content="Dejan Loncar, Unilink-Finance, Unilink-Network">
  <meta name="viewport" content="width=device-width, initial-scale = 1, maximum-scale=1, user-scalable=no">
  
  <title>Unilink - network</title>

    <link rel="stylesheet" href="admin/css/bootstrap-3.3.5/bootstrap.min.css"><!-- Bootstrap 3.3.5 -->
    <link href="admin/css/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link rel="stylesheet" href="css/datatables/jquery.dataTables.min.css">
    <link rel="stylesheet" href="admin/css/home-pages.css">
</head>
<body>
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
                    <div class="item item-reasearch" style="background-image: url('<?php echo $bg_image; ?>');"></div>
                <?php endforeach; ?>

            </div><!-- .owl-carousel -->
          </div><!-- .span12 -->
        </div><!-- .row -->
      </div><!-- .container-fluid -->
    </div><!-- #demo -->

  
    <div class="col-sm-8 col-xs-9 col-xs-offset-1 searching-results">

        <!--<div class="row advance-searching">
          <h3 class="text-center">Napredna Pretraga</h3>
        </div>-->
      <?php
        include("admin/inc/init.php");
          if( !empty($_GET['search_company_input']) ) { 
            $search = $base->clear_string($_GET['search_company_input']);
            $query = "SELECT * FROM users WHERE name LIKE '%$search%' OR username LIKE '%$search%' OR city LIKE '%$search%' OR address LIKE '%$search%' OR business_activities LIKE '%$search%' OR contact_person LIKE '%$search%' OR tags LIKE '%$search%'";
          }
            else if( !empty($_GET['client-search-info-activities']) && empty($_GET['client-search-by-city']) && empty($_GET['client-search-by-key-words']) ){
              $clean_business_activity  = $base->clear_string($_GET['client-search-info-activities']);
              if( !empty($clean_business_activity) ){
                $query = "SELECT * FROM users WHERE business_activities LIKE '%$clean_business_activity%'";
              }
            }
            else if( !empty($_GET['client-search-by-city']) && empty($_GET['client-search-info-activities']) && empty($_GET['client-search-by-key-words']) ){
                $clean_business_place = $base->clear_string($_GET['client-search-by-city']);
                  $query = "SELECT * FROM users WHERE city LIKE '%$clean_business_place%'";
            }
            else if( !empty($_GET['client-search-by-key-words'])  && empty($_GET['client-search-info-activities']) && empty($_GET['client-search-by-city'])  ){
                $clean_key_words = $base->clear_string($_GET['client-search-by-key-words']);
                  $query = "SELECT * FROM users WHERE tags LIKE '%$clean_key_words%'";
            }

            else if( !empty($_GET['client-search-info-activities']) && !empty($_GET['client-search-by-city']) && empty($_GET['client-search-by-key-words']) ){
              $clean_business_activity  = $base->clear_string($_GET['client-search-info-activities']);
              $clean_business_place     = $base->clear_string($_GET['client-search-by-city']);
                $query = "SELECT * FROM users WHERE business_activities LIKE '%$clean_business_activity%' AND city LIKE '%$clean_business_place%'";
            }

            else if( !empty($_GET['client-search-info-activities']) && !empty($_GET['client-search-by-key-words']) && empty($_GET['client-search-by-city']) ){
              $clean_business_activity  = $base->clear_string($_GET['client-search-info-activities']);
              $clean_key_words = $base->clear_string($_GET['client-search-by-key-words']);
                $query = "SELECT * FROM users WHERE business_activities LIKE '%$clean_business_activity%' AND tags LIKE '%$clean_key_words%'";
            }

            else if( empty($_GET['client-search-info-activities']) && !empty($_GET['client-search-by-key-words']) && !empty($_GET['client-search-by-city']) ){
              $clean_business_place  = $base->clear_string($_GET['client-search-by-city']);
              $clean_key_words       = $base->clear_string($_GET['client-search-by-key-words']);
                $query = "SELECT * FROM users WHERE city LIKE '%$clean_business_place%' AND tags LIKE '%$clean_key_words%'";
            }

            else if( !empty($_GET['client-search-info-activities']) && !empty($_GET['client-search-by-key-words']) && !empty($_GET['client-search-by-city']) ){
              $clean_business_activity  = $base->clear_string($_GET['client-search-info-activities']);
              $clean_business_place  = $base->clear_string($_GET['client-search-by-city']);
              $clean_key_words       = $base->clear_string($_GET['client-search-by-key-words']);
                $query = "SELECT * FROM users WHERE business_activities LIKE '%$clean_business_activity%' AND city LIKE '%$clean_business_place%' AND tags LIKE '%$clean_key_words%'";
            }

            

            $searching_results = user::find_this_query($query);
            $data = $base->while_loop($query);

            
       ?>
      <div class="table-responsive">
          <p><table id="client-searching-table" class="table" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th>Naziv<i class="fa fa-arrow-down" aria-hidden="true"></i></th>
                      <th>Telefon<i class="fa fa-arrow-down" aria-hidden="true"></i></th>
                      <th>Mesto<i class="fa fa-arrow-down" aria-hidden="true"></i></th>
                      <th>Adresa<i class="fa fa-arrow-down" aria-hidden="true"></i></th>
                      <th>E-mail<i class="fa fa-arrow-down" aria-hidden="true"></i></th>
                      <th>Kontakt Osoba<i class="fa fa-arrow-down" aria-hidden="true"></i></th>
                  </tr>
              </thead>
              <tbody>
                <?php 
                  if( mysqli_num_rows($data) == 0 ):
                    echo "<tr><td>Nema rezultata za Vašu pretragu...</td></tr>";
                  else:
                ?>
                <?php foreach($data as $show_info): ?>
                    <tr>
                        <td><a href="company/company-index.php?user_id=<?php echo $show_info['user_id']; ?>"><?php echo $show_info['name']; ?></a></td>
                        <td><a href="company/company-index.php?user_id=<?php echo $show_info['user_id']; ?>"><?php echo $show_info['phone']; ?></a></td>
                        <td><a href="company/company-index.php?user_id=<?php echo $show_info['user_id']; ?>"><?php echo $show_info['city']; ?></a></td>
                        <td><a href="company/company-index.php?user_id=<?php echo $show_info['user_id']; ?>"><?php echo $show_info['address']; ?></a></td>
                        <td><a href="company/company-index.php?user_id=<?php echo $show_info['user_id']; ?>"><?php echo $show_info['email']; ?></a></td>
                        <td><a href="company/company-index.php?user_id=<?php echo $show_info['user_id']; ?>"><?php echo $show_info['contact_person']; ?></a></td>
                    </tr>
                  <?php 
                      endforeach; 
                    endif;
                  ?>
              </tbody>
          </table></p>
        </div>

      <button  class="btn advance-search-button-second" >PRETRAŽI PONOVO</button>
        <div class="container-fluid">
          <div class="new-searching">
              <div class="col-sm-6 col-xs-12 new-search-bar">
                  <h4 class="text-center"><b>Pretraga</b></h4>
                  <form method="GET" action="searching_results.php" class="new-search-company">
                    <label for="search_company_input">Naziv Preduzeća</label><br>
                    <input type="text" name="search_company_input" class="search_company_input" placeholder="Unesite naziv preduzeća" autocomplete="off" />
                    <button type="submit" id="new_search_submit" class="glyphicon glyphicon-search"></button>
                  </form><!-- .search-company -->
                    <div class="index-searching-result-company"></div>
              </div>
              <div class="col-sm-6 col-xs-12 advance-searching-second">
                  <h4 class="text-center"><b>Napredna Pretraga</b></h4>
                    <div class="col-sm-12 advance-searching-form-client">
                      <form method="GET" action="searching_results.php">
                          <div class="col-md-6 col-sm-12 col-xs-12 client-advance-search-form">
                            <label for="client-search-info-activities">Područje Delatnosti</label>
                            <select class="form-control" name="client-search-info-activities" class="client-search-info-activities">
                                <option value="">Izaberite Tip Delatnosti</option>
                                <option value="Proizvodnja">Proizvodnja</option>
                                <option value="Trgovina">Trgovina</option>
                                <option value="Ugostiteljstvo">Ugostiteljstvo</option>
                                <option value="Transport">Transport</option>
                                <option value="Uslužna Delatnost">Uslužna Delatnost</option>
                            </select>
                          </div>
                          <div class="col-md-6 col-sm-12 col-xs-12 client-advance-search-form>">
                              <label for="search-by-city-client">Sedište Preduzeća</label>
                                <tr><td>
                                  <input  type="text" class="form-control client-search-by-city" name="client-search-by-city" placeholder="Sedište" />
                                </td></tr>
                          </div>
                          <div class="col-md-12 col-xs-12 client-advance-search-form">
                              <label for="search-by-key-words">Ključne Reči</label>
                                <tr><td>
                                  <input  type="text" class="form-control client-search-by-key-words" name="client-search-by-key-words"  placeholder="Ključne reči" />
                                </td></tr>
                          </div>
                          <div class="col-md-12 col-xs-12 client-advance-search-form-submit">
                                <tr><td>
                                  <input  type="submit" class="btn btn-warning submit-advance-searching" name="submit-advance-searching" value="Pretraži" />
                                </td></tr>
                          </div>
                      </form>
                    </div><!-- /.row -->          
                </div><!-- .advance-searching-second -->
            </div>
    </div><!-- .searching-results -->


    <footer class="homepages-footer searching_results_footer">
        <p>Copyright © Unilink-finance 2016</p>
    </footer>



  <script src="admin/js/jquery-1.12.3.min.js"></script>
  <script src="admin/js/bootstrap.min.js"></script>
  <script src="admin/js/index-page-jquery.js"></script>
  <script src="admin/js/owl-carousel/owl.carousel.js"></script>
  <script src="admin/js/plugins/color_picker/js/jquery-2.1.4.min.js"></script>
  <script src="admin/js/jquery.form-validator.js"></script>
  <script src="admin/js/home-index-page.js"></script>
  <script src="admin/js/datatables/jquery.dataTables.min.js"></script>
  <script src="admin/js/datatables/dataTables.buttons.min.js"></script>
  <script src="admin/js/datatables/pdfmake.min.js"></script>
  <script src="admin/js/datatables/vfs_fonts.js"></script>
  <script src="admin/js/datatables/buttons.html5.min.js"></script>
  <script src="admin/js/datatables/buttons.print.min.js"></script>
  <script type="text/javascript">
      $(document).ready(function(){
          $('#client-searching-table').DataTable({
              "order": [ 1, "asc" ],
              "language": {
                  "url" : "admin/js/datatables/serbian.json"
              },  
              
              "lengthMenu": [[10, 25, 50, -1], [5, 7, 10, "12"]],
          });        
      });
  </script>
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