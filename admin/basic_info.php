<?php include("inc/header.php"); ?><!-- Include header -->
<?php
	if(!$session->session_status()){
		redirect("../login.php");
	}
?>

<?php 
	global $base;
	$status = user::find_this_id( $base->clear_string($_SESSION['user_id']) );
	if( $status->active == 0 ){
		redirect('../login.php');
	}
?>

<?php 		
	if($user->role == 'master_admin' ){
		redirect('logout.php');
	}
?>

</head>
<body  class="hold-transition skin-blue sidebar-mini <?php echo ($user->left_menu_collapse== '1' ? ' sidebar-collapse' : ''); ?>" data-menustate=<?php echo ($user->left_menu_collapse== '1' ? ' collapsed' : ' not-collapsed');  ?>>
<div class="se-pre-con"></div><!-- Preloader Div -->
	
	<div class="wrapper" id='wrapper_basic_info' style="
		background: url(img/drive.jpg) no-repeat center center fixed;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover; 
		">

	<!-- INCLUDE ALL SEPARATED FILES -->
		<?php include("inc/top_menu.php");?>
		<?php include("inc/left_menu.php");?>
		
		
			<section class="row" id="headline-basic-info">
				<h1><span>Osnovne Informacije o Vašem Poslovanju</span></h1>
			</section><!-- #headline-basic-info -->

			<section id="basic-info-main-nav">
				<?php include("inc/main_menu.php"); ?><!-- Include file "main_menu.php" -->  
			</section><!-- #basic-info-main-nav -->
	

	
		<div class="container basic-info-content">
			<section class="col-sm-11 col-sm-offset-0 col-xs-11 col-xs-offset-1" id="basic-information">
				<div class="col-sm-12 col-xs-12 ">
					<span class="basic-info-company-info">1. Informacije o Preduzeću</span>
						<form action="inc/pages/pages_insert_info.php" method="POST" id="basic-info-form" class="form">
							<div class="info-tabs">
								<label for="basic-info-company-name">Naziv</label>
						    	<tr><td>
						        	<input class="form-control" id="basic-info-company-name" name="basic-info-company-name" type="text" value="<?php echo $user->name; ?>">
						    	</td></tr>
						   	</div><!-- .info-tabs -->
							
						   	<div class="info-tabs">
								<label for="basic-info-place">Sedište</label>
						      	<tr><td>
									<input class="form-control" id="basic-info-place" name="basic-info-place" type="text" value="<?php echo $user->city; ?>">
						      	</td></tr>
						    </div><!-- .info-tabs -->
						    
						    <div class="info-tabs">
								<label for="basic-info-address">Adresa</label>
								<tr><td>
						        	<input class="form-control" id="basic-info-address" name="basic-info-address" type="text" value="<?php echo $user->address; ?>">
						        </td></tr>
						    </div><!-- .info-tabs -->

						    <div class="info-tabs">
						        <label for="basic-info-jmbg">PIB</label>
						        <tr><td>
						        	<input class="form-control" id="basic-info-pib" name="basic-info-pib" type="text" value="<?php echo $user->pib; ?>">
						        </td></tr>
							</div><!-- .info-tabs -->

						    <div class="info-tabs">
						    	<label for="basic-info-maticni-broj">Matični Broj</label>
						        <tr><td>
						        	<input class="form-control" id="basic-info-maticni-broj" name="basic-info-maticni-broj" type="text" value="<?php echo $user->mat_broj; ?>">
						        </td></tr>
							</div><!-- .info-tabs -->

						    <div class="info-tabs">
						    	<label for="basic-info-username">Korisničko ime</label>
						        <tr><td>
						        	<input class="form-control" id="basic-info-username" name="basic-info-username" type="text" value="<?php echo $_SESSION['username']; ?>" disabled>
						        </td></tr>
							</div><!-- .info-tabs -->

						    <div class="info-tabs">
						    	<label for="basic-info-mail">E-mail</label>
						        <tr><td>
						        	<input class="form-control" id="basic-info-mail" name="basic-info-mail" type="text" value="<?php echo $user->email; ?>">
						        </td></tr>
							</div><!-- .info-tabs -->

						    <div class="info-tabs">
						    	<label for="basic-info-phone">Telefon</label>
						        <tr><td>
							        <input class="form-control" id="basic-info-phone" name="basic-info-phone" type="text" value="<?php echo $user->phone; ?>">
							    </td></tr>
							</div><!-- .info-tabs -->

							<div class="info-tabs">
								<label for="basic-info-contact-person">Kontakt Osoba</label>
						        <tr><td>
						        	<input class="form-control" id="basic-info-contact-person" name="basic-info-contact-person" type="text" value="<?php echo $user->contact_person; ?>">
						      	</td></tr>
							</div><!-- .info-tabs -->

						    <div class="info-tabs">
						      	<tr><td></td><td><input type="submit" name="submit-basic-info-form" id="submit-basic-info-form" class="btn accept-basic-info-changes" value="Potvrdi Promene" >
						    	</td></tr>
						    </div><!-- .info-tabs -->
						</form>  



					<!-- CHANGE PASSWORD -->
						<span class="basic-info-company-info">2. Promenite Šifru </span>
						<div class="col-sm-12 text-left basic-info-fields" id="new-password-menu">
							<span>
								Ukoliko želite da promenite šifru, molimo Vas da označite traženo polje. Biće Vam prosleđen E-mail za identifikaciju naloga sa automatski generisanom novom šifrom.
							</span>
							<br><br>
							<button id="change-password" class="btn btn-warning">Promena Šifre</button><br>

							<div class="inputs-for-password">
								<form action="inc/pages/pages_insert_info.php" id="new-password-insert" method="POST">
									<div>
									  	<label for="new-password">Nova Šifra</label>
									    <input type="password" class="form-control" id="new-password" name="new-password"  data-validation="length" data-validation-length="min7" class="form-control" required />
									</div>
									<div>
									  	<label for="new-password-confirm">Ponovite Novu Šifru</label>
									    <input type="password" class="form-control" id="new-password-confirm" name="new-password-confirm" data-validation="length" data-validation-length="min7" class="form-control" required />
									    <span id="confirmMessageNewPass" class="confirmMessageNewPass"></span>
									</div>
										<input type="submit" id="submit-new-password" class="btn accept-basic-info-changes" value="Potvrdi Promene" />
								</form>
							</div>
						</div><!-- .text-left -->



					<!-- Allow or Forbide Sending E-mails -->
						<span class="basic-info-company-info">3. Odobri prijem obaveštenja o porukama na ličnu e-mail adresu </span>
						<div class="col-sm-12 text-left basic-info-fields">
							<span>Poruke koje Ste primili od klijenata i potencijalnih klijenata sa Unilink-Network mreže, stizaće na Vaš e-mail. Ukoliko označite ovo polje, informacije o porukama biće sadržane u okviru podmenija "Poruke" kao i na E-mail adresi Vašeg preduzeća. Ukoliko ovo polje ostane neoznačeno, informacije o porukama neće stizati na E-mail Vašeg preduzeća, već će biti prikazane samo u podmeniju "Poruke".</span>
							<div class="checkbox basic-info-send-mail">
								<form action="inc/pages/pages_insert_info.php" method="POST" id="basic-info-send-email-message">

									<div id="check-send-email">
										<div class="checkbox">
											<label for="basic-info-send-email"><input type="checkbox" name="basic-info-send-email" id="basic-info-send-email" value="1" <?php echo ($user->allow_email_message) ? 'checked' : ''; ?>>Prijem poruka preko e-mail adrese</label>
										</div>
										
										<input type="submit" class="btn accept-basic-info-changes" name="submit-send-email-form" value="Potvrdi Promene">
									</div>
								</form>
							</div><!-- .checkbox -->	
						</div><!-- .text-left -->



					<!-- Information about Business Activity -->
						<span class="basic-info-company-info">4. Podaci o delatnosti </span>
						<div class="col-sm-12 text-left basic-info-fields">
							<span>Kako bi Vaše preduzeće postojalo unutar pretrage među ostalim preduzećima, potrebno je da izaberete tip delatnosti.</span>
							<div class="basic-info-business-activities">
								<form action="inc/pages/pages_insert_info.php" method="POST" id="form-basic-activities" >
									<div >
										<label for="basic-info-activities">Izaberite Tip Delatnosti</label>
										 
									    <select class="form-control" name="basic-info-activities" id="basic-info-activities">
									        <option>Izaberite Tip Delatnosti</option>
									        <option value="Proizvodnja" <?php echo ($user->business_activities == 'Proizvodnja') ? 'selected' : ''; ?>>Proizvodnja</option>
									        <option value="Trgovina" <?php echo ($user->business_activities == 'Trgovina') ? 'selected' : ''; ?>>Trgovina</option>
									        <option value="Ugostiteljstvo" <?php echo ($user->business_activities == 'Ugostiteljstvo') ? 'selected' : ''; ?>>Ugostiteljstvo</option>
									        <option value="Transport" <?php echo ($user->business_activities == 'Transport') ? 'selected' : ''; ?>>Transport</option>
									        <option value="Uslužna Delatnost" <?php echo ($user->business_activities == 'Uslužna Delatnost') ? 'selected' : ''; ?>>Uslužna Delatnost</option>
		      							</select>
	      						  	</div>
									<input type="submit" id="submit-basic-info-activities" name="submit-basic-info-activities" class="btn accept-basic-info-changes" value="Potvrdi Promene" >
								</form>
							</div><!-- .basic-info-business-activities -->
						</div><!-- .basic-info-fields -->


					
					<!-- Key Words - TAGS -->
						<span class="basic-info-company-info">5. Ključne Reči </span>
						<div class="col-sm-12 text-left basic-info-fields">
							<span>Radi efikasnosti pretrage, molimo Vas da unesete nekoliko ključnih reči koje bliže određuju Vaše poslovanje. Na primer, možete uneti nazive proizvoda (usluga), naziv preduzeća, karakteristike poslovanja i td. Ključne reči odvajajte zarezima ili kosim crtama. Predonst je ukoliko opišete svoje poslovanje u polju ispod ključnih reči.</span>
							<div class="basic-info-tags">
								<form action="inc/pages/pages_insert_info.php" method="POST" id="form-basic-tags">
									<div  id="key_words">
										<input type="text" class="form-control" id="basic-info-tags" name="basic-info-tags" placeholder="roba x, roba y, kvalitet, iskustvo, tradicija ..." value="<?php echo $user->tags; ?>">
									</div>
									<div  id="seo_description">
										<label for="seo_desc">Kratak opis poslovanja</label>
										<textarea name="seo_desc" id="seo_desc" cols="30" rows="10">
											<?php echo $user->business_description; ?>
										</textarea>
									</div>
										<input type="submit" name="submit-basic-info-tags" id="submit-basic-info-tags" class="btn accept-basic-info-changes" value="Potvrdi Promene" >
								</form>
							</div><!-- .basic-info-tags -->
						</div><!-- .basic-info-fields -->


				</div><!-- .row -->
			</section><!-- #basic-information -->
		

		</div><!-- .basic-info-content -->
		
		<div class="basic-info-footer">
			<?php include("inc/footer.php"); ?>
			
			<script src="js/jquery.form-validator.js"></script>
			<script>$.validate();</script>
		
		</div><!-- .basic-info-footer -->
	</div><!-- .wrapper_basic_info -->

</body>
</html>