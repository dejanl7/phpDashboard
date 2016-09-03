<?php require_once("inc/init.php"); ?>
<?php
	if( isset($_SESSION['user_id']) ){
		$user_offline = user::find_this_id($session->user_id_session);
		$user = $user_offline->offline($user_offline->user_id);
		$session->logout();
			redirect("../login.php");
	}
	else{
		header("Location: ../login.php");
	}
	
?>