<?php 
	include('admin/inc/init.php');
	
	if( isset($_POST['divName']) && $_POST['divName'] == 'companyName' ): 
		$checking_userCompanyName = user::checkout_new_user( 'name', $_POST['name'] );
		if( !empty($checking_userCompanyName) ){
			$name = "";
			foreach( $checking_userCompanyName as $user ){
				$name .= $user->name;
			}
		}
			else {
				$name = "";
				//header('Location: index.php'); 
			}
?>
			<div class="register-container"><?php echo ( empty($name) ? 'empty' : 'fill' ); ?></div>
<?php endif; ?>

<?php 
	if( isset($_POST['divName']) && $_POST['divName'] == 'companyUsername' ):
			$checking_userName = user::checkout_new_user( 'username', $_POST['name'] );
			if( !empty($checking_userName) ){
				$username = "";
				foreach( $checking_userName as $user ){
					$username .= $user->username;
				}
			}
				else {
					$username = "";
				}
?>
			<div class="register-container-username"><?php echo ( empty($username) ? 'empty' : 'fill' ); ?></div>	

<?php endif; ?>


		