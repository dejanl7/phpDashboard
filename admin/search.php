<?php include("inc/header.php"); ?><!-- Include header -->
<?php 
	global $base;
	$search = $base->clear_string($_POST['search']);

	if( !empty($search) ):

		$query = "SELECT * FROM users WHERE name LIKE '%$search%' OR username LIKE '%$search%' OR city LIKE '%$search%' OR address LIKE '%$search%' OR business_activities LIKE '%$search%' OR contact_person LIKE '%$search%' OR tags LIKE '%$search%' LIMIT 10";
		$search_query = user::find_this_query($query);
		$rows = $base->while_loop($query);
?>
		<div id="searching-box">
<?php
			if( mysqli_num_rows($rows) == 0 ){
				echo "<span><a href='#'>Nema rezultata za Vašu pretragu...</a></span>";
			}
				else {
					foreach($rows as $row) {
						$city 	 = ( !empty($row['city']) ? ' - '.$row['city'] : '' );
						$address = ( !empty($row['address']) ? ', '.$row['address'] : '' );

						if( $row['role'] != 'master_admin' ){
							echo "<span><a href='http://localhost/Dashboard/company/company-index.php?user_id=". $row['user_id'] . "'>". $row['name']."<small>". $city . $address . "</small></a></span>";
						}
						
					}
				}
?>
		</div>
<?php
	endif;	
?>