<!-- Remodal and jquery -->
    <link rel="stylesheet" href="css/plugins/remodal-plugin/remodal.css">
    <link rel="stylesheet" href="css/plugins/remodal-plugin/remodal-default-theme.css">
    <script src="js/plugins/remodal/remodal.js"></script>
	<script type="text/javascript" src="js/ajax/ajax_media.js"></script>
	
	

	
<body>

<!-- =============================================================
	CHANGE BACKGROUND IMAGE ALL PAGES
==================================================================-->
	<div class="remodal remodal-background" data-remodal-id="remodal_change_background_image">
		<div id="bg_img_container">	
			<?php
				$show_bg_imgs = new background_image();
				$query = "SELECT * FROM background_images";
				$bg_imgs = background_image::find_this_query($query);
				foreach($bg_imgs as $bg_img):
			?>
		<img class="thumbnail bg_background_img" style="cursor:pointer;" width="200px" height="150px" align="left" data="<?php echo $bg_img->bg_image_name; ?>" src="<?php echo $bg_img->bg_image_path();?>" alt="slika..." />					
			<?php
				endforeach;
			?>
		</div>
		<div>
			<div style="float:right;">	
				<a data-remodal-action="cancel" class="btn btn-warning" style="width:200px;">Odustani</a>
				<input type="submit" data-remodal-action="confirm" class="btn btn-success" style="width:200px;" id="change_bg_image_sub" value="Potvrdi" />	
			</div>
		</div>
	</div>
	

<!-- =============================================================
	ASK ADMIN ALL PAGES (Top Menu)
==================================================================-->
	<div class="remodal remodal-background" data-remodal-id="remodal-ask-admin" id="ask-admin-form">
		<h1 class="text-center"><b>Postavite Pitanje Administratoru</b></h1>
		<p><b>Sva pitanja i nedoumice možete poslati ovim putem. Odgovor na Vaše pitanje će biti realizovan u najkraćem roku.</b></p>
		<form action="inc/pages/pages_insert_info.php" method="POST" id="id_ask_admin">
			<div class="ask-admin">
				<textarea name="ask_admin" id="ask_admin" data-role="master_admin"></textarea>
			</div>
			<button class="btn btn-warning pull-left" data-remodal-action="cancel">Odustani</button>
			<input type="submit" name="send_querstion_to_admin" class="btn btn-success pull-right" id="send-ask-to-admin" value="Pošalji">
		</form>
	</div>






<!-- ============================================================= 
	TinyMC Functions
================================================================== -->	
<?php 
	function insert_tinyMc_into_db($function_name, $content, $table_name){
		if(isset($_POST[$function_name])){
			$column_name = $_POST[$function_name];
			$text = $_POST[$content];
			$insert_into_base = $table_name:: tinyMc_insert_text($table_name, $column_name, $text);
		}
	}
	
	
	function insert_tinyMcArticles_into_db($function_name, $content, $article_id1, $table_name){
		if(isset($_POST[$function_name])){
			$column_name = $_POST[$function_name];
			$text = $_POST[$content];
			$article_id = $_POST[$article_id1];
			$insert_into_base = $table_name:: tinyMc_insert_dataArticle($table_name, $column_name, $text, $article_id);
		}
	}

?>



<!-- ============================================================= 
	Modals for page: "INDEX.PHP"
================================================================== -->
<!-- Second div modal, page: "INDEX.PHP" -->
<?php
function tinyMc_page_index($remodal, $remodal_name, $remodal_rel, $column_name, $submit_button){	
	echo "<div class='remodal remodal-tinymc' data-remodal-id='{$remodal}'>
		<table style='margin-left:120px;'>
			<textarea type='text' name='{$remodal_name}' id='{$remodal_name}' rel='{$remodal_rel}' />";
			global $base;

			$show_index_text = "SELECT * FROM index_page WHERE user_id = ". $base->clear_string($_SESSION['user_id']);
			$search_text = index_page::find_this_query($show_index_text);
			foreach($search_text as $find_text){
				echo $find_text->$remodal_name;
			}
	echo	"</textarea>
				<br/>
			<tr>
				<a data-remodal-action='cancel' class='btn btn-warning' style='float:left; width:200px;' href='javascript:void(0)'>Odustani</a>
				<input type='submit' data-remodal-action='confirm' class='btn btn-success' style='float:right; width:200px;' id='{$submit_button}' value='Potvrdi' />
			</tr>
		</table>	
	</div>";
}
?>


<!-- Show images for CAUROSEL and insert images... For that acitvities, we use function: insert_and_show_caurosel_imgs()-->
<?php 
function insert_and_show_caurosel_imgs(){
	echo "<div class='remodal remodal_images' data-remodal-id='remodal_carousel_images'>
		<button type='button' class='close' data-remodal-action='cancel' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		<div id='input_form_carousel' class='pull-left' style='width:240px;'>
			<form id='carousel_form'  method = 'POST' action='inc/pages/pages_insert_media.php' enctype='multipart/form-data'>
				<div class='form-group' style='width:240px;'>
					<label for='carousel_image_name'>Naziv slike </label>
					<input type='text' class='form-control' id='carousel_image_name' name='carousel_image_name' placeholder='Naziv slike'/>
				</div>
				<div class='form-group' style='width:240px;'>
					<label for='carousel_image_choose'>Izaberite sliku</label>
					<input type='file' class='form-control' id='carousel_image_choose' name='carousel_image_choose' />
				</div>
				<div class='form-group' style='width:240px;'>
					<input type='submit' class='btn btn-success' class='form-control' id='submit_caurosel' name='submit_caurosel' value='Ubaci sliku'/>
				</div>
			</form>
		</div>
		<div id='carousel_uploaded_container' class='pull-right' style='width:670px;'>
			<div id='show_carousel_img_modal'>";
				global $base;
				$query = "SELECT * FROM carousel_imgs WHERE user_id = ". $base->clear_string($_SESSION['user_id']);
				$imgs = carousel_imgs::find_this_query($query);
				
				$row_counter = $base->while_loop($query);
				if(mysqli_num_rows($row_counter) < 1){
					echo "Niste uneli niti jednu sliku. Ukoliko želite da postavite sopstvene slike u slajder, to možete učiniti preko forme sa leve strane.";
				}
				
				else{	
					foreach($imgs as $img){
						echo "<img class='biography_thumbnail' style='cursor:pointer;' width='100px' height='80px' align='left' src='{$img->carousel_path()}' alt='slika...' />";	
					}
				}
	echo	"</div>
		</div>
	</div>";
}
?>


<!-- Delete images from CAUROSEL and caurosel folder...-->
<?php 
function delete_carousel_images(){

	echo "<div class='remodal remodal_images' data-remodal-id='delete_carousel_images'>
			<button type='button' class='close' data-remodal-action='cancel' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			<form method='post' action='inc/functions/delete.php'>
				<div id='options_container' class='col-xs-4'>
					<select class='form-control' name='select_form'>
						<option value=''>Izaberite opciju: </option>
						<option value='delete_carousel_imgs'>Obriši</option>
					</select>
				</div>
					<div class='col-xs-4'>
						<input type='submit' class = 'btn btn-success button_delete' value='Primeni' />
					</div>	<br/><br/><br/>
				
		<div id='delete_container' class='pull-left' style='width:900px;'>
			<div id='show_carousel_img_for_delete'>";
	echo		"<table id='carousel_delete_table' class='table'>";
				global $base;
				$current_page = !empty($_GET['page']) ? (int)$base->clear_string($_GET['page']) : 1;
				$number_per_page = 5;
				$total_items = carousel_imgs::count_number_of_records();

				$pagination = new pagination($current_page, $number_per_page, $total_items);
				$query = "SELECT * FROM carousel_imgs WHERE user_id = ". $base->clear_string($_SESSION['user_id']) ." LIMIT {$number_per_page} OFFSET {$pagination->offset()}";
				$imgs = carousel_imgs::find_this_query($query);
	echo		"<thead>
					<th> <input type='checkbox' class='index_selectAllBoxes' /></th>
					<th> Slika </th>
					<th> Datum (vreme) upload-a </th>
					<th> Dugme za brisanje </th>
				</thead>
					<tbody id='body_of_index_carousel'>";
					foreach($imgs as $img){
						echo "<tr><td><input type='checkbox' class='checkBoxes' name='array_of_checkboxes[]' value='{$img->carousel_id}' /></td><td><img class='biography_thumbnail' style='cursor:pointer;' width='100px' height='80px' align='left' src='{$img->carousel_path()}' alt='slika...' /></td>
								  <td>"; echo date('d. m. Y', strtotime($img->carousel_image_upload_date)); echo" </td>
								  <td><button class='btn btn-warning delete_carousel' data-table='delete_carousel' id='{$img->carousel_id}' style='margin-left: 20px;'>Obriši</button></td>";	
					}

	echo		"	</tbody>
				</table>";
	echo		" <div class='row' style='width: 100%;' align='center'>
					<ul class='pagination' style='align: center;'>";
							if($pagination->sum_of_pages() > 1){
								if($pagination->is_previous_page()){
									echo "<li><a href='index.php?page={$pagination->previous_page()}' rel= '{$pagination->previous_page()}'>&laquo</a></li>";
								}
								
									for($i=1; $i<=$pagination->sum_of_pages(); $i++){
										if($i == $pagination->current_page){
											echo "<li><a class='active btn btn-success' href='index.php?page={$i}' rel='{$i}'>$i</a></li>"; // Show current page in pagination slider !!!
										}
											else{
												echo "<li><a href='index.php?page={$i}' rel='{$i}'>$i</a></li>";
											}
									}
								
								if($pagination->is_next_page()){
									echo "<li><a href='index.php?page={$pagination->next_page()}' rel='{$pagination->next_page()}'> &raquo</a></li>";
								}
								
							}							
	echo "					
					</ul>
				 </div>
			</div>
		</div>
		</form>
	</div>";
}
?>
<!-- End page: "INDEX.PHP" -->


<!--=========================================================
	Modals for page: "ABOUT.PHP" 
============================================================= -->
<!-- Business info modal, page: "ABOUT.PHP" -->
<?php
function tinyMc_page_about($remodal, $remodal_name, $remodal_rel, $column_name, $submit_button){	
	echo "<div class='remodal remodal-tinymc' data-remodal-id='{$remodal}'>
		<table style='margin-left:120px;'>
			<textarea type='text' name='{$remodal_name}' id='{$remodal_name}' rel='{$remodal_rel}' />";
					global $base;
					$find_description = "SELECT * FROM about_us WHERE user_id = ". $base->clear_string($_SESSION['user_id']);
					$search = about_us::find_this_query($find_description);
					foreach($search as $find_info){
						echo $find_info->$column_name;
					}
	echo	"</textarea>
				<br/>
			<tr>
				<a data-remodal-action='cancel' class='btn btn-warning' style='float:left; width:200px;' href='javascript:void(0)'>Odustani</a>
				<input type='submit' data-remodal-action='confirm' class='btn btn-success' style='float:right; width:200px;' id='{$submit_button}' value='Potvrdi' />
			</tr>
		</table>	
	</div>";
}
?>


<!-- Change image modal - page "ABOUT.PHP" -->
<?php 
function show_uploaded_images($remodal_name, $class, $table, $img_name, $img_path, $form_name){
	echo "<div class='remodal remodal_change_about_image' data-remodal-id='{$remodal_name}'>
	<button type='button' class='close' data-remodal-action='cancel' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		<div id='img_uploaded_container'>
			<div id='show_uploaded_img_modal'>";
				global $base;
				$show_imgs = new $class();
				$query = "SELECT * FROM ". $table."	WHERE user_id = ". $base->clear_string($_SESSION['user_id']);
				$imgs = $class::find_this_query($query);
				foreach($imgs as $img){
					echo "<img class='left_image thumbnail' style='cursor:pointer;' width='200px' height='150px' align='left' data='{$img->$img_name}' src='{$img->$img_path()}' alt='slika...' />";	
				}
	echo	"</div>
		</div>
		<div id = 'buttons'>
			<a class='btn btn-info' id='show_hide_btn' style='width:200px; float:left;'>Dodaj novu sliku</a>
			<div style='float:right;'>	
				<input type='submit' data-remodal-action='confirm' class='btn btn-success' style='width:200px;' id='change_image_sub' value='Potvrdi' />	
			</div><br/><br/>
			<form method='POST' class='form-group' id='{$form_name}' action='inc/pages/pages_insert_media.php' enctype='multipart/form-data' style='float:left;'>
				<div class='form-group'>
					<label for='file'>Izaberite sliku</label>
					<input type='file' class='form-control' id='img_from_form' name='img' />
				</div>
				<input type='submit' class='btn btn-success' id='img_form_sub' name='btn' value='Ubaci sliku' />
			</form>
		</div>
	</div>";
}
?>


<!-- ADD FORM for adding biography (an example): page: "ABOUT.PHP". -->
<!-- We don't need to write this function. Reson: this function is not repeatable. 
We are using this function only in page about.php for adding biography! -->
<?php 
function add_form($remodal_name){
	echo "<div class='remodal' data-remodal-id='{$remodal_name}'>
	<button type='button' class='close' data-remodal-action='cancel' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
	<div id='biography_upload_container'>
		<div class='pull-left' style='width:250;'>
			<form method='POST' id='biography_form' action='inc/pages/pages_insert_media.php' enctype='multipart/form-data'>
				<div class='form-group' style='width:230;'>
					<label for='biography_name'>Ime člana</label>
					<input type='text' class='form-control' id='biography_name' name='name' />
				</div>
				<div class='form-group' style='width:230;'>
					<label for='biography_surname'>Prezime člana</label>
					<input type='text' class='form-control' id='biography_surname' name='surname' />
				</div>
				<div class='form-group' style='width:230;'>
					<label for='biography_proffesion'>Zanimanje (titula)</label>
					<input type='text' class='form-control' id='biography_proffesion' name='proffesion' />
				</div>
				<div class='form-group' style='width:230;'>
					<label for='biography_image'>Izaberite sliku</label>
					<input type='file' class='form-control' id='biography_image' name='biography_img' />
				</div>
				<div class='form-group' style='width:230;'>
					<label for='biography_document'>Biografija (pdf,word)</label>
					<input type='file' class='form-control' id='biography_document' name='biography_doc' />
				</div>
				<input type='submit' class='btn btn-success' id='biography_image_submit' name='sub_biography' value='Dodaj korisnika' />
			</form>
		</div>
		<div id='show_biography_images'>
			<div id='insert_biography_images'>";
	?>
			<?php 
				global $base; 
				$show_biography_imgs = new biographies();
				$biography_query = "SELECT * FROM biography WHERE user_id = ". $base->clear_string($_SESSION['user_id']);
				$biography_imgs = biographies::find_this_query($biography_query);
				foreach($biography_imgs as $biography_img){
					echo "<img class='biography_thumbnail' style='cursor:pointer;' width='100px' height='80px' align='left' data='{$biography_img->worker_image}' src='{$biography_img->worker_image_path()}' alt='biografija' />";	
				}

	echo "</div>
			</div>
		<div style='clear:both;'></div>
	</div>
	</div>";
}


/*====================================================================== 	
	Show all uploaded biography images for each member. 		
	We can update each member and choose image (set in our_team_div)
========================================================================*/
function show_uploaded_biography_images($remodal_name, $selected_id, $img_name, $img_path, $img_id, $form_name){
	echo "<div class='remodal remodal_biography_images' data-remodal-id='{$remodal_name}'>
		<button type='button' class='close' data-remodal-action='cancel' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		<div id='biography_img_uploaded_container'>
			<div id='show_uploaded_biography_img_modal'>";
			if(isset($_GET['selected_id'])){
				global $base;
				$result = $base->clear_string($_GET[$selected_id]);
				$show_imgs = new biographies();
				$query = "SELECT * FROM biography WHERE  biography_id = '{$result}'";
				$imgs = biographies::find_this_query($query);
				foreach($imgs as $img){
					echo "<div id = 'buttons' class='row pull-left' style='width:400px;'>
					<div id='buttons_container'>
						<form method='POST' class='form-group' id='{$form_name}' action='inc/pages/pages_insert_media.php' enctype='multipart/form-data'>
							<div class='form-group'>
								<label for='azuriraj_ime'>Ime: </label>
								<input type='text' class='form-control' id='ime' name='azuriraj_ime' placeholder='Ime' value='{$img->worker_name}'/>
							</div>
							<div class='form-group'>
								<label for='azuriraj_prezime'>Prezime: </label>
								<input type='text' class='form-control' id='prezime' name='azuriraj_prezime' placeholder='Prezime' value='{$img->worker_surname}'/>
							</div>
							<div class='form-group'>
								<label for='azuriraj_sliku'>Izaberite novu sliku</label>
								<input type='file' class='form-control' id='slika' name='azuriraj_sliku' />";
								if($img->$img_path() != ''){
										echo "<img src='{$img->$img_path()}' class='biography_images' data='{$img->biography_id}' width='180px' height='90px' alt='{$img->worker_image}' />";
								}
						echo "
							</div>
							<div class='form-group'>
								<label for='azuriraj_dokument'>Biografija (pdf, word...) </label>
								<input type='file' class='form-control' id='dokument' name='azuriraj_dokument' />";
								if($img->worker_biography_document != ''){
										echo "<img src='img/file.jpg' width='100px' height='90px' alt='{$img->worker_biography_document}' /> &nbsp" ;
										echo "<span data='{$img->biography_id}' class='biography_CV btn btn-danger glyphicon glyphicon-remove'> Obriši CV </span>";
								}
						echo "		
							</div>
							<div class='form-group'>
								<label for='azuriraj_profesiju' id='profesija1'>Profesija: </label>
								<input type='text' class='form-control' id='profesija' name='azuriraj_profesiju' placeholder='Profesija' value='{$img->proffesion}' />
							</div>
						<div class='form-group'>	
							<a data-remodal-action='cancel' class='btn btn-warning' id='cancel' style='width:120px; float:left;'>Izađi</a>
							<input type='submit' class='btn btn-success' name='azuriraj_podatke' id='potvrdi_azuriranje' style='float:right; width:150px;' value='Ažuriraj' />
						</div>
						</form>
					</div>
					</div>";
				echo 	"<div class='' id='personal_biography_images_and_change_image' stlye='width:100%;'>";	
				echo	"<div class='' style='padding-left: 20px; width:100%; height:20%;' id='personal_biography_imgs'>";	
				echo	"<div id='personal_biography_imgs_container' style='padding-left: 20px;'>";
							$query_for_two_tables = "SELECT * FROM add_biography_image WHERE biography_id='{$result}'";		
							
						// Showing biography images from table "biography" and "add_biography_image" toggether 					
							$imgs_from_two_tables = new_biography_image::find_this_query($query_for_two_tables);
							foreach($imgs_from_two_tables as $img_for_more){
								if($img_for_more->image_name != ""){
									echo "<img class='thumbnail pull-left all_personal_biography_imgs' style='cursor:pointer;' width='100px' height='80px' align='left'  src='img/biography_images/{$img_for_more->image_name}' data='{$img_for_more->image_name}' alt='slika...' />";	
								}
							}
							
				
				echo	"</div>";
				echo	"</div>";
				echo	"<div class='row' style='height:250px; padding-top: 10px; padding-left:570px;' id='center_image'>";							
						echo "<img class='thumbnail' src='{$img->$img_path()}' width='250px' height='200px' alt='{$img->worker_biography_document}' />";
				echo 	"</div>";
				echo	"</div>";

			
				}
			}//END OF STATEMENT "IF"
				
				else{
					echo "<b>Došlo je do greške. Molimo Vas pritisnite dugme \"<b>Izađi</b>\" i ponovite željenu aktivnost.</b></br><br/>";
				}
		echo "	
		</div>
		</div>	
	</div>";
}

?>	
<!-- End page: "ABOUT.PHP" -->





<!-- ======================================================== 
	Modals for page: "gallery.PHP" 
============================================================= -->
<?php	
// Modal for adding new articles...
function add_new_product_in_gallery($remodal_name){
	echo "<div class='remodal remodal-new-product' data-remodal-id='{$remodal_name}'>
	<div id='gallery_add_product_conatiner'>
		<button type='button' class='close' data-remodal-action='cancel' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		<div class='pull-left' style='width:250;'>
			<form method='POST' id='add_product_form' action='inc/pages/pages_insert_media.php' enctype='multipart/form-data'>
				<div class='form-group' style='width:230;'>
					<label for='product_name'>Naziv proizvoda</label>
					<input type='text' class='form-control' id='product_name' name='product_name' />
				</div>
				<div class='form-group' style='width:230;'>
					<label for='product_price'>Cena</label>
					<input type='text' name='product_price' id='product_price' class='form-control auto' data-a-sep='.' data-a-dec=',' />
				</div>
				<div class='form-group' style='width:150;'>
					<label for='valute'>Valuta </label>
					<select class='form-control' id='valute' name='valute'>
						<option value='rsd'>rsd (dinar)</option>
						<option value='€'>€ (euro)</option>
						<option value='$'>$ (usd)</option>
					</select>
				</div>
				<div class='form-group' style='width:230;'>
					<label for='product_img'>Slika proizvoda</label>
					<input type='file' class='form-control' id='product_img' name='product_img' />
				</div>
				
				<div class='form-group' style='width:230;'>
					<label for='product_discount'>Popust u %</label>
					<input type='number' name='product_discount' style='width:100px' id='product_discount' class='form-control' />
				</div>
				
				<input type='submit' class='btn btn-success pull-right' id='product_adding_submit' style='width:100px;' name='sub_biography' value='Dodaj' />
			</form>
		</div>
	</div>
	</div>";
}

// Modal for update article (product, service) information... 
// I had a problem with this function. Problem is related with forwarding address_id via AJAX. For SOME reason, I don't know why, function excelent works when complete form into divs is at other file...
// My file is: "inc/functions/pages_functions/show_files_via_ajax/update_gallery_info_function"
function update_gallery_info(){
	echo 
	"<div class='remodal remodal_gallery_images' data-remodal-id='remodal_edit_product'>
		<div id='modal_update_gallery_container1'>
		
		</div>
	</div>";
}


?>	
	

<!-- Delete MORE ARTICLES...-->
<?php 
function delete_more_articles(){
	echo "<div class='remodal delete-more-articles' data-remodal-id='remodal_gallery_delete_product'>
		<button type='button' class='close' data-remodal-action='cancel' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		   <form method='POST' action='inc/functions/delete.php'>
				<div id='articles_options_container' class='col-xs-4'>
					<select class='form-control' name='select_articles_form'>
						<option value=''>Izaberite opciju: </option>
						<option value='delete_articles'>Obriši</option>
					</select>
				</div>
					<div class='col-xs-4'>
						<input type='submit' class = 'btn btn-success button_delete' value='Primeni' />
					</div>	<br/><br/><br/>
		<div id='articles_delete_container' class='pull-left'>
			<div id='show_articles_for_delete'>";
	echo		"<table id='articles_delete_table' class='table'>";
				global $base;
				$current_page = !empty($_GET['page']) ? (int)$base->clear_string($_GET['page']) : 1;
				$number_per_page = 5;
				$total_items = articles::count_number_of_records();

				$pagination = new pagination($current_page, $number_per_page, $total_items);
				$query = "SELECT * FROM articles WHERE user_id = ". $base->clear_string($_SESSION['user_id']) ." LIMIT {$number_per_page} OFFSET {$pagination->offset()}";
				$imgs = articles::find_this_query($query);
	echo			"<thead>
						<th style='padding-right: 20px; align:left;'><input type='checkbox' class='gallery_slelect_all' </th>
						<th style='padding-left: 20px; align:left;'> Slika </th>
						<th style='padding-left: 50px; align:left;'> Datum (vreme) upload-a </th>
						<th style='padding-left: 50px; align:left;'> Dugme za brisanje </th>
					</thead>
					<tbody id='body_of_gallery_asortment' style='width:1900px;'>";
					foreach($imgs as $img){
						echo "<tr><td style='padding-right: 20px; align:left;'><input type='checkbox'  name='array_of_articles_checkbox[]' class='gallery_each_box' value='{$img->article_id}' /></td>
								  <td  style='padding-left: 20px; align:left;'><img class='biography_thumbnail' style='cursor:pointer;' width='100px' height='80px' align='left' src='{$img->article_image_path()}' alt='slika...' /></td>
								  <td style='padding-left: 50px; align:left;'>"; echo date('d. m. Y', strtotime($img->article_uploaded_time)); echo" </td>
								  <td style='padding-left: 50px; align:left;'><button class='btn btn-warning delete_articles' data-table='delete_article' id='{$img->article_id}' style='margin-left: 20px;'>Obriši</button></td>
							  </tr>";	
					}

	echo		"	</tbody>
				</table>";
	echo		" <div class='row' style='width: 100%;' align='center'>
					<ul class='pagination' style='align: center;'>";
							if($pagination->sum_of_pages() > 1){
								if($pagination->is_previous_page()){
									echo "<li><a href='gallery.php?page={$pagination->previous_page()}' rel= '{$pagination->previous_page()}'>&laquo</a></li>";
								}
								
									for($i=1; $i<=$pagination->sum_of_pages(); $i++){
										if($i == $pagination->current_page){
											echo "<li><a class='active btn btn-success' href='gallery.php?page={$i}' rel='{$i}'>$i</a></li>"; // Show current page in pagination slider !!!
										}
											else{
												echo "<li><a href='gallery.php?page={$i}' rel='{$i}'>$i</a></li>";
											}
									}
								
								if($pagination->is_next_page()){
									echo "<li><a href='gallery.php?page={$pagination->next_page()}' rel='{$pagination->next_page()}'> &raquo</a></li>";
								}
								
							}							
	echo "					
					</ul>
				 </div>
			</div>
		</div>
	  </form>
	</div>";
}
?>	
	
<!--  End page: "gallery.PHP" -->	

<!-- ============================================================= 
	Page: "PREVIEW.PHP" 
================================================================== -->	
<!-- Show images for specific article in page "PREVIEW.PHP" and insert images...  -->
<?php 
function preview_insert_new_img(){
	echo "<div class='remodal remodal_images' data-remodal-id='remodal_preview_new_img' style='width:900px;'>
		<button type='button' class='close' data-remodal-action='cancel' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		<div id='preview_add_img_form' class='pull-left' style='width:240px;'>";
			if(isset($_GET['article_id'])){
				global $base;
				$find_details_id = "SELECT * FROM article_details WHERE article_id = '{$base->clear_string($_GET['article_id'])}'";
				$specify_image_for_this_article = article_details::find_this_query($find_details_id);
				echo"
				<form id='preview_form_add_new_img'  method = 'POST' action='inc/pages/pages_insert_media.php' enctype='multipart/form-data'>
					<div class='form-group' style='visibility: hidden; height: 0px; margin-top: -20px;'>
						<label for='preview_article_details_id'>Detalji Id </label>
						<input type='text' class='form-control' id='preview_article_details_id' name='preview_article_details_id' value='";
							foreach($specify_image_for_this_article as $found_image){
								echo $found_image->article_details_id;
							}
					echo"' />
					</div>
					<div class='form-group' style='visibility:hidden; height: 0px;'>
						<label for='preview_article_id'>Id artikla </label>
						<input type='text' class='form-control' id='preview_article_id' name='preview_article_id' value='{$base->clear_string($_GET['article_id'])}' />
					</div>
					<div class='form-group' style='width:240px;'>
						<label for='preview_new_img'>Naziv slike </label>
						<input type='text' class='form-control' id='preview_new_img' name='preview_new_img' placeholder='Naziv slike'/>
					</div>
					<div class='form-group' style='width:240px;'>
						<label for='preview_new_img_choose'>Izaberite sliku</label>
						<input type='file' class='form-control' id='preview_new_img_choose' name='preview_new_img_choose' />
					</div><br/><br/>
					<div class='form-group' style='width:240px;'>
						<input type='submit' class='btn btn-success pull-right' class='form-control' id='preview_new_img_sub' name='preview_new_img_sub' attr='{$base->clear_string($_GET['article_id'])}' value='Ubaci sliku'/>
					</div>
				</form>";
			}
		echo"	
		</div>
		<div id='preview_uploaded_container' class='pull-right'>
			<div id='show_preview_img_modal'>";
				global $base;
				$query = "SELECT * FROM article_details_images WHERE article_id = '{$base->clear_string($_GET['article_id'])}'";
				$imgs = article_details_images::find_this_query($query);
				
				$row_counter = $base->while_loop($query);
				if(mysqli_num_rows($row_counter) < 1){
					echo "Niste uneli dodatnu sliku. Ukoliko želite da unesete više slika za ovaj proizvod, to možete uraditi preko forme sa leve strane.";
				}
				
				else{	
					foreach($imgs as $img){
						echo "<img class='biography_thumbnail' style='cursor:pointer;' width='100px' height='80px' align='left' src='{$img->article_details_images_file_path()}' alt='slika...' />";	
					}
				}
	echo	"</div>
		</div>
	</div>";
}
?>


<!--  Function for editing information about articles details... -->
<?php
function tinyMc_page_preview($remodal, $remodal_name, $remodal_rel, $article_id, $column_name, $submit_button){	
		global $base;
	echo "<div class='remodal remodal-tinymc' data-remodal-id='{$remodal}'>
		<table style='margin-left:120px;'>";
		if(isset($_GET['article_id'])){
			echo"
			<div id='article_id_details' style='visibility: hidden;' rel='{$base->clear_string($_GET[$article_id])}'></div>
			<textarea type='text' name='{$remodal_name}' id='{$remodal_name}' rel='{$remodal_rel}' />";
			$find_description = "SELECT * FROM article_details WHERE article_id = '{$base->clear_string($_GET['article_id'])}'";
					$search = article_details::find_this_query($find_description);
					foreach($search as $find_info){
						echo $find_info->$column_name;
					}
	echo	"</textarea>";
		}
		echo"
				<br/>
			<tr>
				<a data-remodal-action='cancel' class='btn btn-warning' style='float:left; width:200px;' href='javascript:void(0)'>Odustani</a>
				<input type='submit' data-remodal-action='confirm' class='btn btn-success' style='float:right; width:200px;' id='{$submit_button}' value='Potvrdi' />
			</tr>
		</table>	
	</div>";
}

// Delete article image(s)...
function delete_article_images(){
	global $base;
	if( isset ($_GET['article_id']) ) {
	echo "<div class='remodal remodal_images' id='preview_page_details' data-id='". $base->clear_string($_GET['article_id']) ."' data-remodal-id='remodal_preview_delete_img' style='width:900px;'>
		<button type='button' class='close' data-remodal-action='cancel' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		<div class='preview_deleteImage_container pull-left' style='width:900px;'>
			<div class='show_article_img_for_delete'>";
				$current_page = !empty($_GET['pagemodal']) ? (int)$base->clear_string($_GET['pagemodal']) : 1;
				$number_per_page = 5;
				$total_items = article_details_images::count_number_of_records();

				$pagination = new pagination($current_page, $number_per_page, $total_items);

				if(isset($_GET['article_id'])){
				$query = "SELECT * FROM article_details_images WHERE article_id = '{$base->clear_string($_GET['article_id'])}' LIMIT {$number_per_page} OFFSET {$pagination->offset()}";
				$imgs = article_details_images::find_this_query($query);
				
	echo		"<form action='inc/functions/delete.php' method='POST' id='details-images-files-delete-form'>
					<div id='options_container-delete-user-images' class='col-xs-4'>
						<select class='form-control' name='preview-images-files-delete-option'>
							<option value=''>Izaberite opciju: </option>
							<option value='preview_delete_details-images_files'>Obriši</option>
						</select>
					</div>
					<div class='col-xs-4'>
						<input type='submit' class='btn btn-success button_delete' value='Primeni' />
					</div>	<br/><br/><br/>
					<table id='article_delete_table' class='table'>
					<thead>
						<th><input type='checkbox' class='selectAllPreviewImgs' /></th>
						<th> Slika </th>
						<th> Datum (vreme) upload-a slike </th>
						<th> Dugme za brisanje </th>
					</thead>
					<tbody>";
					foreach($imgs as $img){
						echo "<tr>
								  <td><input type='checkbox' class='previewImgsDelete' name='preview_images_files_id[]' value='{$img->article_details_images_id}' /></td>
								  <td>
								  	<img class='article_thumbnail' style='cursor:pointer;' width='100px' height='80px' align='left' src='{$img->article_details_images_file_path()}' alt='slika...' />
								  	</td>
								  <td>"; echo date('d. m. Y', strtotime($img->article_img_uploaded_time)); echo "</td>
								  <td>
								  	<button class='btn btn-warning delete_article' rel='{$img->article_id}' id='{$img->article_details_images_id}' style='margin-left: 20px;'>Obriši
								  	</button>
								  </td>	
							 </tr>";
					}

	echo		"	</tbody>
				</table>
				</form>";
	echo		" <div class='row paginate-class' style='width: 100%;' align='center'>"; ?>
					<ul class='pagination text-center' data-article-id = "<?php echo $base->clear_string($_GET['article_id']); ?>">
						<?php 
							if($pagination->sum_of_pages() > 1){
								if($pagination->is_previous_page()){
									echo "<li><a href='preview.php?article_id=".$base->clear_string($_GET['article_id'])."&pagemodal={$pagination->previous_page()}' rel= '{$pagination->previous_page()}'>&laquo</a></li>";
								}
								
									for($i=1; $i<=$pagination->sum_of_pages(); $i++){
										if($i == $pagination->current_page){
											echo "<li><a class='active btn btn-success' href='preview.php?article_id=".$base->clear_string($_GET['article_id']). "&pagemodal='{$i}'  rel='{$i}'>$i</a></li>"; // Show current page in pagination slider !!!
										}
											else{
												echo "<li><a href='preview.php?article_id=".$base->clear_string($_GET['article_id'])."&pagemodal={$i}' rel='{$i}'>$i</a></li>";
											}
									}
								
								if($pagination->is_next_page()){
									echo "<li><a href='preview.php?article_id=".$base->clear_string($_GET['article_id'])."&pagemodal={$pagination->next_page()}' rel='{$pagination->next_page()}'> &raquo</a></li>";
								}
								
							}							
						?>				
						</ul>
<?php echo"	 </div>";

				}
	echo "
			</div>
		</div>
	</div>";
	}
}
?>

<!--  End page: "PREVIEW.PHP" -->	



<!-- ============================================================= 
	Modals for page: "CONTACT.PHP" 
================================================================== -->	
<?php 
function update_contacts(){
	echo "<div class='remodal contact-update' data-remodal-id='remodal_update_contact_info'>
		<div id='remodal_update_contact_container'>
		  <div id='remodal_update_contact_load'>";
		  
		if(isset($_GET['id_value'])){ 
			global $base;
			$id_show = $base->clear_string($_GET['id_value']);
			$search_address = "SELECT * FROM contact_page WHERE contact_id = '{$id_show}'";
			$find_information = contact::find_this_query($search_address);
				foreach($find_information as $info):
				echo"
				<button type='button' class='close' data-remodal-action='cancel' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				<form class='form-vertical' id='update_contacts_form' action='inc/functions/pages_functions/google_maps_activities.php'>
					<div class='form-group hidden'>
						<label for='contact_id' class='control-label'>Id</label>
						<div class=''>
						  <input type='text' name='contact_id' class='form-control' id='contact_id' value='{$info->contact_id}'>
						</div>
					</div>
					
					<div class='form-group'>
						<label for='adress_form' class='control-label'>Adresa</label>
						<div class='conctact-info'>
						  <input type='text' class='form-control' name='address_form' id='adress_form' value='{$info->address}'>
						</div>
					</div>
					
					<div class='form-group'>
						<label for='phone_phorm' class='control-label'>Telefon</label>
						<div class='conctact-info'>
						  <input type='text' class='form-control' name='phone_form' id='phone_form' value='{$info->phone_number}'>
						</div>
					</div>
					
					<div class='form-group'>
						<label for='mobile_phone_form' class='control-label'>Mob. tel.</label>
						<div class='conctact-info'>
						  <input type='text' class='form-control' name='mobile_phone_form' id='mobile_phone_form' value='{$info->mobile_phone}'>
						</div>
					</div>
					
					<div class='form-group'>
						<label for='email_form' class='control-label'>E-mail</label>
						<div class='conctact-info'>
						  <input type='email' class='form-control' name='email_form' id='email_form' value='{$info->e_mail}'>
						</div>
					</div>
					
					<div class='form-group'>
						<label for='fax_form' class='control-label'>Fax</label>
						<div class='conctact-info'>
						  <input type='text' class='form-control' name='fax_form' id='fax_form' value='{$info->fax}'>
						</div>
					</div> 
					
					<a class='btn btn-danger pull-right' href='inc/functions/pages_functions/google_maps_activities.php?delete_contact_id={$info->contact_id}' id='delete_contact_info' name='delete_contact_info'> Obriši ovaj kontakt </a>
					";
				endforeach;
						
			echo		"<div>
							<input type='submit' class='btn btn-success pull-left' id='sub_id_update_contact' name='sub_update_contact' value='Ažuriraj podatke' />
						</div>
					</form>";
			}else{
				echo "<b>Došlo je do greške. Molimo Vas pritisnite dugme \"<b>Escape</b>\" na tastaturi, ili kliknite van ovog prozora i ponovite željenu aktivnost.</b></br><br/>";
			}
			
	echo"
		  </div>
		</div>
	  </div>";
}
	
?>


<!--- End page: "CONTACT.PHP" -->	

<!-- LEFT MENUS OPTIONS "-->

<!-- ============================================================= 
	Modals for page: "user_phonebook.php" Left Menu Options "Imenik" 
================================================================== -->
<?php 
	function update_phonebook_contact($phonebookContactId){
		echo 
		"<div class='remodal phone-contact-update' data-remodal-id='remodal_update_phone_contact'>
			<div id='remodal_update_phonebook_contact_container'>
		  		<div id='remodal_update_phonebook_contact_load'>";
		  	echo '<table id="unilink-contact-table-modal" class="table">
                    <thead>
                        <tr>
                            <th>Naziv (Ime)</th>
                            <th>Telefon</th>
                            <th>Adresa</th>
                            <th>E-mail</th>
                            <th>Osoba</th>
                            <th>Tip</th>
                        </tr>
                    </thead>
                    <tbody>';
                    global $base;        	
                	
                	if( isset($_GET[$phonebookContactId]) ):
                	    $result = phonebook::find_this_id($base->clear_string( $_GET[$phonebookContactId]) );
?>						
				<button type='button' class='close' data-remodal-action='cancel' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
						<form action="#" role="form" method="POST" id="modal-update-phonebook-contact-info">
                        	<tr>
                                <td>
                               		<input type="text" class="form-control" id="modal_phonebook_name" name="modal_phonebook_name" value="<?php echo $result->phonebook_name; ?>" />
                                </td>
                                <td>
                                	<input type="text" class="form-control" id="modal_phonebook_phone" name="modal_phonebook_phone" value="<?php echo $result->phonebook_phone; ?>" />
                              	</td>
                                <td>
                                	<input type="text" class="form-control" id="modal_phonebook_address" name="modal_phonebook_address" value="<?php echo $result->phonebook_address; ?>" />
                                </td>
                                <td>
                                	<input type="email" class="form-control" id="modal_phonebook_email" name="modal_phonebook_email" value="<?php echo $result->phonebook_name; ?>" />
                               	</td>
                                <td> 
                                	<input type="text" class="form-control" id="modal_phonebook_contactperson" name="modal_phonebook_contactperson" value="<?php echo $result->phonebook_contactperson; ?>" />
                                </td>
                                <td>
	                                <select id="modal_phonebook_contact_type" class='form-control' name='modal_phonebook_contact_type'>
	                                    <option value=''>Izaberite opciju: </option>
	                                    <option value='pravno_lice' <?php echo ($result->contact_type == 'pravno_lice' ? 'selected' : ''); ?> >
	                                    	Preduzeće
	                                    </option>
	                                    <option value='fizicko_lice' <?php echo ($result->contact_type == 'fizicko_lice' ? 'selected' : ''); ?> >
	                                    	Fizičko Lice
	                                    </option>
	                                </select>
                                </td>
                            </tr>
                            <tr class="modal-jumb-tr"></tr>
                            <tr>
                            	<td>
                            		<button class="btn btn-danger pull-right editing_phonebook_contact_info" name="delete_phonebook_contact_info" data-id="<?php echo $result->phonebook_id; ?>" data-type="delete-phonebook-contact"> 
                            			Obriši ovaj kontakt 
                            		</button>
								</td>
								<td>
									<button class="btn btn-warning pull-right editing_phonebook_contact_info" name="update_phonebook_contact_info" data-id="<?php echo $result->phonebook_id; ?>" data-type="update-phonebook-contact" data-name="<?php echo $result->phonebook_name; ?>" data-phone="<?php echo $result->phonebook_phone; ?>" data-address="<?php echo $result->phonebook_address; ?>" data-email="<?php echo $result->phonebook_email; ?>" data-contactperson="<?php echo $result->phonebook_contactperson; ?>" data-contacttype="<?php echo $result->contact_type; ?>"> 
                            			Ažuriraj ovaj kontakt 
                            		</button>
								</td>
                            </tr>
                        </form>
                  	<?php endif; ?>
<?php 
                   	echo '
                    </tbody>
                </table>

				</div>
			</div>
		</div>';
	}


?>

	
<!-- TINYMC -->
	<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
	<script>tinymce.init({selector:'textarea'});</script> <!-- Used! -->
</body>
</html>