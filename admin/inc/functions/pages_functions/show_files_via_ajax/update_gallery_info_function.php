<script type="text/javascript" src="js/plugins/autoNumeric-master/number_separate_jquery.min.js"></script>
<script type="text/javascript" src="js/plugins/autoNumeric-master/autoNumeric.js"></script>
<script type="text/javascript">
jQuery(function($) {
    $('.auto').autoNumeric('init');
});
</script>
	<?php
		include("../../../init.php");
	echo "
		<div id='modal_update_gallery_container'>
			<div id='modal_update_gallery_load'>";
		if(isset($_GET['article_id'])){ 
			$id_show = $_GET['article_id'];
			$search_articles = "SELECT * FROM articles WHERE article_id = '{$id_show}'";
			$find_information = articles::find_this_query($search_articles);
				foreach($find_information as $info):
		echo "
			<form method='POST' class='form-group' id='gallery_update_info_form' action='inc/pages/pages_insert_media.php' enctype='multipart/form-data'>
			<button type='button' class='close' data-remodal-action='cancel' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				<div class='hidden form-group'>
					<label for='update_article_id'> Id artikla </label>
					<input type='text' class='form-control' id='update_article_id' name='update_article_id' placeholder='Ime proizvoda' value='{$info->article_id}' />
				</div>
				<div class='form-group'>
					<label for='update_article_name'>Naziv </label>
					<input type='text' class='form-control' id='update_article_name' name='update_article_name' placeholder='Ime proizvoda' value='{$info->article_name}' />
				</div>
				<div class='form-group'>
					<label for='update_article_price'>Cena </label>
					<input type='text' class='form-control auto'  data-a-sep='.' data-a-dec=',' id='update_article_price' name='update_article_price'  value='{$info->article_price}' />	
				</div>	
				<div class='form-group' style='width:150;'>
					<label for='update_valute'>Valuta </label>
					<select class='form-control' id='update_valute' name='update_valute'>
						<option value='rsd'>rsd (dinar)</option>
						<option value='€'>€ (euro)</option>
						<option value='$'>$ (usd)</option>
					</select>
				</div>
				<div class='form-group'>
					<label for='update_article_img'>Slika  </label>
					<input type='file' class='form-control' id='update_article_img' name='update_article_img' />	
				</div>
				<div class='form-group'>
					<label for='update_article_discount' id='profesija1'>Popust: </label>
					<input type='text' class='form-control' id='update_article_discount' name='update_article_discount' placeholder='Popust'  value='{$info->article_discount}'  />
				</div>

					<input type='submit' class='btn btn-success pull-right submit_gallery' id='{$info->article_id}' name='sub_gallery' value='Ažuriraj podatke' />
				
				<div style='width:300px; padding-top: 215px; margin-top: -200px;'>
						<br/><br/><br/>
				</div>
			</form>";
				endforeach;
		}
			
			else{
				echo "<b>Došlo je do greške. Molimo Vas pritisnite dugme \"<b>Escape</b>\" na tastaturi, ili kliknite van ovog prozora i ponovite željenu aktivnost.</b></br><br/>";
			}
		echo"	
			</div>
		</div>";
		

		
	?>

    

	
