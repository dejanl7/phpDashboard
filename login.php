<?php require_once("admin/inc/init.php"); ?>

<?php
global $base;

if(isset($_POST['submit'])){
	$username = $base->clear_string($_POST['username']);
	$password = $base->clear_string( md5($_POST['password']) );

	//Methode for checking does user exist in database...
	$user_found = user::check_user($username, $password);
	$user_id 	= user::find_user_id($username, $password); 
	$active_status = user::find_this_id($user_id)->active; 

		if( $user_found AND $active_status != 0 ){
			$role = user::find_this_id($user_id)->role; 
			$session->login($user_found);
			$user_found->online($session->user_id_session);
				
				if($role == 'master_admin'){
					redirect("admin/master_admin.php");
				} 
				else if($role == 'admin') {
					redirect("admin/index.php");	
				} 
		}
		else if ( $active_status == 0  ){
			$the_message = "Vaš nalog je blokiran. Za više informacija obratite se Administratoru.";
		}
			else{
				$the_message = "Vaš username ili šifra nisu odgovarajući!";
			}
}
	else{
		$username 		= "";
		$password 		= "";
		$the_message 	= "";
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
<body>
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

	
	<div class="container login-box">
		<div class="col-xs-10 col-sm-8 col-md-4 col-xs-offset-1 col-sm-offset-2 col-md-offset-4 custom-login-box">
		  	<div class="login-logo">
				<?php echo $the_message; ?>
		  	</div><!-- /.login-logo -->
				<div class="login-box-body">
					<p class="login-box-msg">Ulogujte se</p>			
					<form action="#" method="post" id="form-login">
						<div class="form-group has-feedback">
							<input type="text" class="form-control" name="username" placeholder="Korisničko ime" autocomplete="off" value="<?php echo htmlentities($username); ?>" />
							<span class="glyphicon glyphicon-user form-control-feedback"></span>
					  	</div>
					  	<div class="form-group has-feedback">
							<input type="password" class="form-control" name="password" placeholder="Šifra" autocomplete="off" value="<?php echo htmlentities($password); ?>" />
							<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					  	</div>
					  	<div class="row">
							<div class="col-sm-8 col-xs-12">
							</div><!-- /.col -->
							<div class="col-sm-4 col-xs-12 ">
							  <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Uloguj se</button>
							</div><!-- /.col -->
					  	</div>
					</form>

					<div class="social-auth-links text-center">
					  <h3></h3>
					  <a href="register.php" class="btn btn-block btn-social btn-facebook btn-flat"><i class="glyphicon glyphicon-hand-right"></i> Registrujte se</a>
					  <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="glyphicon glyphicon-hand-right"></i> Zaboravili Ste Šifru</a>
					</div><!-- /.social-auth-links -->

				</div><!-- /.login-box-body -->
		</div><!-- /.login-box -->
	</div><!-- .col-xs-12 -->
	

    <footer class="homepages-footer">
        <p>Copyright © Unilink-finance 2016</p>
    </footer>


	<script src="admin/js/jquery-1.12.3.min.js"></script>
	<script src="admin/js/bootstrap.min.js"></script>
	<script src="admin/js/index-page-jquery.js"></script>
  	<script src="admin/js/plugins/owl-carousel/owl.carousel.js"></script>
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