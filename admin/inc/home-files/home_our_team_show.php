<!-- "NAŠ TIM" part... -->	
	<div class="col-sm-12 about_second_big_box" id="our_team_whole">
		<div class="box row" id="our_team_container">
		
				<h2 id="headline2" class="intro-text text-center">
					<div id="our_team_headline_container" style="
						font-size: <?php echo about_us::css("about_us","our_team_headline_fontweight", $base->clear_string($_GET['user_id'])); ?>;	
						font-family: <?php echo about_us::css("about_us","our_team_headline_fonttype", $base->clear_string($_GET['user_id'])); ?>;
					">
					<strong> NAŠ tim </strong>
					</div>
				</h2>
				
		<div id="our_team">
			<div id="our_team_content_container">	
<!--NEXT DIV IS NOT for font color ONLY. We are using next div for loading information from remodal.-->
<!-- INFORMATION are related with "NAŠ TIM" div -->
			<div id="our_team_container_for_font_color">
				<div class="text-justify" id="our_team_edit" style="
					font-size:<?php echo about_us::css('about_us','our_team_div_font_weight', $base->clear_string($_GET['user_id'])); ?>; 
					font-family:<?php echo about_us::css('about_us','our_team_div_font_type', $base->clear_string($_GET['user_id'])); ?>;
				">
				<?php
					$show = "SELECT * FROM about_us WHERE user_id = '{$base->clear_string($_GET['user_id'])}'";
					$show_all = about_us::find_this_query($show);
					if($show_all){
						foreach($show_all as $show_me){
								if($show_me->our_team_text == ""){
									echo "&nbsp<b>Unesite informacije o Vašem timu.</b> Neophodno je da izvršite desni klik na OVAJ TEKST. Zatim izaberite \"Uredi opis\". Nakon što unesete tekst, potvrdite uneti tekst klikom na dugme \"Potvrdi\".
										Takođe, možete promeniti <b>Prikaz slika</b> ili isključiti kompletan deo \"<b>Naš tim</b>\" ukoliko želite da se isti ne prikaže na Vašoj stranici.";
								}
								else{
									echo "<p></p>&nbsp".$show_me->our_team_text;
								}
						}
					}
				?>
		<!-- This is place where we insert AJAX -->
				</div><!-- #our_team_edit -->
			</div><!-- #our_team_container_for_font_color -->
			
				<br><br>
			<div id="biography_store" class="container">
			<div id="store_our_team" class="col-sm-11 col-sm-offset-0 col-xs-10 col-xs-offset-1">
				<?php
					foreach($show_all as $show_me){
						if($show_me->our_team_show_picture == "1"){
							
							$cleaned_user_id = $base->clear_string($_GET['user_id']);
							$show_biography_image = "SELECT * FROM biography WHERE user_id = '{$cleaned_user_id}'";
							$biography_image = biographies::find_this_query($show_biography_image);
							foreach($biography_image as $biography_img):	
				?>
				<div class="pull-left" id="store_biog_image" style="padding-left:20px;">
				
<!-- CONDITION FOR SHOWING IMAGES. If worker biography document is not empty, we can see that biography on mouse click.--> 				
				<?php 
					if($biography_img->worker_biography_document != ""){
				?>
					<strong><a href="../admin/<?php echo $biography_img->worker_files_path(); ?>"><p><?php echo $biography_img->worker_name; ?></a></p></strong>				
					<img class="thumbnail biog_img" id="<?php echo $biography_img->biography_id; ?>" width="185px" height="180px" src="../admin/<?php echo $biography_img->worker_image_path(); ?>" data = "<?php echo $biography_img->biography_id; ?>" data1 = "<?php echo $biography_img->biography_id; ?>" alt="" />

<!-- IN OTHER CASE, We can see name of worker without biography...-->					
				<?php } else{ ?>
					<strong><p style="font-size: 20px; text-align:center; color: #0472CC; font-weight: bold; cursor:pointer;"><?php echo $biography_img->worker_name; ?></p></strong>				
					<img class="thumbnail biog_img" width="200px" height="180px" src="../admin/<?php echo $biography_img->worker_image_path(); ?>" data = "<?php echo $biography_img->biography_id; ?>" data1 = "<?php echo $biography_img->biography_id; ?>" alt="" />
				<?php } ?>
				</div>
					<?php endforeach; ?>
			</div>
			</div>
			<?php	
						}
					}
			?>
			</div>
		</div><!--NAŠ TIM end -->
	</div>
	</div>



