<?php require_once("admin/inc/init.php"); ?>
<?php 
	if( isset($_GET['confirmcode']) && !empty($_GET['confirmcode']) && !empty($_GET['username']) && !empty($_GET['email']) ){
		global $base;

		$username = $_GET['username'];
		$email 	  = $_GET['email'];
		$confirm  = $_GET['confirmcode'];
		
		$search = user::user_confirmation($username, $email, $confirm);
		echo ("
			<SCRIPT LANGUAGE='JavaScript'>
				window.alert('Uspešno Ste realizovali proces registracije. Možete se ulogovati na Vaš profil.')
				window.location.href='login.php';
			</SCRIPT>
		");
	}
	else {
		header('Location: index.php');
	}

?>