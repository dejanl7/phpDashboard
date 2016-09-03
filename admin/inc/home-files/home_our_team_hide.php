<!-- "NAŠ TIM" part... -->		
<div class="col-sm-12" id="our_team_whole">
	<div class="box row" id="our_team_container" style="visibility:hidden; display:none;" >
	
			<h2 id="headline2" class="intro-text text-center">
				<div id="our_team_headline_container" style="
					font-size: <?php echo about_us::css("about_us","our_team_headline_fontweight", $base->clear_string($_GET['user_id'])); ?>;	
					font-family: <?php echo about_us::css("about_us","our_team_headline_fonttype", $base->clear_string($_GET['user_id'])); ?>;
				">
				<strong> NAŠ tim</strong>
				</div>
			</h2>
			
	<div id="our_team">
		<div id="our_team_content_container">	
		
<!-- NEXT DIV IS NOT for font color ONLY. We are using next div for loading information from remodal -->
<!-- INFORMATION are related with "NAŠ TIM" div -->
		<div id="our_team_container_for_font_color">
			<div class="text-justify" id="our_team_edit" style="
				font-size:<?php echo about_us::css('about_us', 'our_team_div_font_weight', $_GET['user_id']); ?>; 
				font-family:<?php echo about_us::css('about_us', 'our_team_div_font_type'); ?>;
			">
			<?php
				$show = "SELECT * FROM about_us WHERE user_id = ". $base->clear_string($_GET['user_id']);
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
			</div>	
		</div><!-- #our_team_container_for_font_color -->	
				<br><br>
				<div id="biography">
					<?php
						foreach($show_all as $show_me){
							if($show_me->our_team_show_picture == "1"){
					?>
					<div class="col-sm-4 text-center">
						<img class="img-responsive" width="245px" height="150px" src="../img/profile_picture_man.jpg" alt="">
						<h3>Jovan Njegić		
							<small>Profesor dr</small>
						</h3>
					</div>
					<div class="col-sm-4 text-center">
						<img class="img-responsive" width="245px" height="150px" src="../img/profile_picture_man.jpg" alt="">
						<h3>Dejan Lončar
							<small>PHP programer</small>
						</h3>
					</div>
					<div class="col-sm-4 text-center">
						<img class="img-responsive" width="245px" height="150px" src="../img/profile_picture_man.jpg" alt="">
						<h3>Marko Cvjetičanin
							<small>Trejder</small>
						</h3>
					</div>
				</div><!-- #biography -->
			<?php
					}
				}
			?>
			</div>
		</div><!-- NAŠ TIM end -->
	</div><!-- #our_team_container -->
</div><!-- #our_team_whole -->




