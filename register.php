<?php require_once("admin/inc/init.php"); ?>
<?php 
	$user 		= new user();
	$about_us 	= new about_us();
	if( isset($_POST['submit']) ){
		if($user){
			$name 		= $_POST['name'];
			$username 	= $_POST['username'];
			$email 		= $_POST['email'];
			$password 	= md5($_POST['pass_confirmation']);
			$date 		= date('Y:m:d H:i:s');

			// E-mail Confirmation
				$random = md5( rand() );
				$message = 'Potvrdite Vaš nalog klikom na sledeći link: \n
				http://localhost/Dashboard/email_confirm.php?username='.$username.'&email='.$email.'&confirmcode='.$random;


			$user->insert_user($name, $username, $password, $email, $date, $random);

			$msg = 'Validacioni Link je poslat na Vašu E-mail adresu. Molimo Vas da kliknete na taj link, kako biste postupak registracije priveli kraju.';
			// Sending E-mail
			mail($email, "Unilink-Finance Validacija Naloga", $message, "From: dejan.loncar@unilink.mycpanel.rs");

				//redirect("login.php");
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
    <link href="admin/css/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="admin/css/home-pages.css" rel="stylesheet">
</head>
<body id="registerPage">
<div class="se-pre-con"></div>
<?php require('admin/inc/home-files/home_index_page_navbar.php'); ?> 


    <div id="demo">
      <div class="container-fluid">
        <div class="row">
          <div class="span12">
            <div id="owl-demo" class="owl-carousel"> 
                <?php 
                  	$background_images_array = array(
                  		'ideas.jpg', 'hard-work.jpg', 'hard-work1.jpg', 'knowledge.jpg', 'planning.jpg', 'success.jpg', 'success1.jpg', 'tree.jpg'
                  	);
                  	
                  	foreach( $background_images_array as $bg_image ):
                ?>
                    	<div class="item" style="background-image: url('admin/img/index-page/<?php echo $bg_image; ?>');"></div>
                <?php endforeach; ?>

            </div><!-- .owl-carousel -->
          </div><!-- .span12 -->
        </div><!-- .row -->
      </div><!-- .container-fluid -->
  	</div><!-- #demo -->

	
	<div class="container custom-register-box">
		<?php if( !empty($msg) ): ?>
			<div class="email-validation-message"><p><?php echo ( !empty($msg) ? $msg : ''); ?></p></div>
		<?php endif; ?>

   		<div class="col-xs-10 col-sm-8 col-md-4 col-xs-offset-1 col-sm-offset-2 col-md-offset-4">
   			<div class="register-box-body" >
		    <h3 class="login-box-msg">Registracija novog člana</h3>

			   	<form action="register.php" id="form-register" method="POST">
		          <div class="form-group has-feedback">
		            <input type="text" name="name" id="register-form-company-name" data-validation="length" data-validation-length="min2" class="form-control" placeholder="Naziv preduzeća" autocomplete="off" required="required" />
		            <span class="glyphicon glyphicon-home form-control-feedback"></span>
		            <span id="coutionName"></span>
		          </div>

		          <div class="form-group has-feedback">
		            <input type="email" name="email" data-validation="email" class="form-control" placeholder="E-mail" autocomplete="off" required="required" />
		            <span class="glyphicon glyphicon-envelope form-control-feedback" required="required"></span>
		          </div>

		          <div class="form-group has-feedback">
		            <input type="text" name="mat_broj" data-validation="mat_broj" class="form-control" placeholder="Matični broj" autocomplete="off" required="required" />
		            <span class="glyphicon glyphicon-magnet form-control-feedback"></span>
		          </div>

		          <div class="form-group has-feedback">
		            <input type="text" name="mesto" data-validation="mesto" class="form-control" placeholder="Mesto" autocomplete="off" required="required" />
		            <span class="glyphicon glyphicon-info-sign form-control-feedback"></span>
		          </div>

				  <div class="form-group has-feedback">
		            <input type="text" name="username" id="register-form-company-username" data-validation="length" data-validation-length="min2"  class="form-control" placeholder="Korisničko ime" autocomplete="off" required="required" >
		            <span class="glyphicon glyphicon-user form-control-feedback"></span>
		            <span id="coutionUsername"></span>
		          </div>

		          <div class="form-group has-feedback">
		            <input type="password" name="pass_confirmation" id="pass_confirmation" class="form-control"  data-validation="length" data-validation-length="min7"  placeholder="Izaberite šifru" autocomplete="off" required="required" />
		             <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
		          </div>

		          <div class="form-group has-feedback">
		            <input type="password" name="pass" id="pass" data-validation="length" data-validation-length="min7" class="form-control" placeholder="Ponovite šifru" autocomplete="off" required="required" />
		            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
					<span id="confirmMessage" class="confirmMessage"></span>
		          </div>

		          <div class="row">
		            <div class="col-sm-5 col-sm-offset-7">
		              <input type="submit" name="submit" id="register-sub"  class="btn btn-primary" value="Registruj se" />
		            </div><!-- /.col-sm-4 -->
		          </div> <!-- .row -->
		        </form>	
			
			<div class="social-auth-links text-center">
	          <a href="login.php" class="btn btn-block btn-social btn-facebook btn-flat"><i class="glyphicon glyphicon-hand-right"></i> &nbsp Uloguj se</a>
	        </div>
		
		</div><!-- .register-box-body -->
		</div><!-- .col-sm-5 -->
    </div><!-- .container -->

    <footer class="homepages-footer">
        <p>Copyright © Unilink-finance 2016</p>
    </footer>


	<script src="admin/js/jquery-1.12.3.min.js"></script>
	<script src="admin/js/bootstrap.min.js"></script>
	<script src="admin/js/index-page-jquery.js"></script>
  	<script src="admin/js/plugins/owl-carousel/owl.carousel.js"></script>
	<script src="admin/js/plugins/color_picker/js/jquery-2.1.4.min.js"></script>
	<script src="admin/js/jquery.form-validator.js"></script>
	<script>$.validate();</script>
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



