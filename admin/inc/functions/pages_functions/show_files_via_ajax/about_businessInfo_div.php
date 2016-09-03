<?php 
	function image($image_name){
		echo $image_name;
	};
?>

<?php include("../../../init.php"); ?><!-- Include header -->
<?php
	if(!$session->session_status()){
		redirect("login.php");
	}
?>
<script>
  $(function() {
	$(".image_resize").resizable();
  });

</script>
<?php
	$clean_user_id = $base->clear_string($session->user_id_session);
	$show_img = "SELECT * FROM about_us WHERE user_id = '{$clean_user_id}'";
	$show_all_dimension = about_us::find_this_query($show_img);
	foreach($show_all_dimension as $show_partial_info):
		if($show_partial_info->business_info_left_image_name !=""){
?>
		
			<img id="<?php image('image'); ?>" class="img-responsive left_image image_resize"  width="<?php echo $show_partial_info->image_width; ?>px" height="<?php echo $show_partial_info->image_height; ?>px" align="left" 
			src="<?php
				$show_imgs = new uploaded_image();
				$clean_user_id = $base->clear_string($_SESSION['user_id']);
				$query = "SELECT * FROM uploaded_images WHERE user_id = '{$clean_user_id}' AND uploaded_img_name = '{$show_partial_info->business_info_left_image_name}' ";
				$imgs = uploaded_image::find_this_query($query);
				foreach($imgs as $img){
					echo $img->image_path();
				}
			?> " alt="slika..." /><br/>
			<button id="send_img_info" class="submit_img_business_info btn btn-info" align="bottom" >Sačuvaj dimenzije</button>

	<?php
		}
			else{
				echo '<img class="img-responsive left_image image_resize"  width="300px" height="250px" align="left" src="img/unilink.jpg" />';
			}
			
			endforeach;
	?>


	
