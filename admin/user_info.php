<?php include("inc/header.php"); ?><!-- Include header -->
<?php
	if(!$session->session_status()){
		redirect("logout.php");
	}
?>

<?php 
	global $base;
	if( $user->active == 0 ){
		redirect('logout.php');
	}
?>

<?php 		
	if($user->role == 'master_admin' ){
		redirect('logout.php');
	}
?>

<?php 		
	// Take Data from User Database Table...
		$user_info = user::find_this_id( $base->clear_string($_SESSION['user_id']) ); 
?>
<!-- This File Using "morris.js" plugin. Licence:

	Copyright (c) 2012-2014, Olly Smith All rights reserved.

	Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:
	Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
	Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
	THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
-->
	<link rel="stylesheet" type="text/css" href="css/morris/morris.css">
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
			
			<?php 
				$count_uploaded_images 	= uploaded_image::count_number_of_records();
				$count_carousel_images 	= carousel_imgs::count_number_of_records();
				$count_biography_images = biographies::count_number_of_records();
				$count_article_images 	= articles::count_number_of_records() + article_details_images::count_number_of_records();
				$images_files_sum 		= $count_uploaded_images + $count_carousel_images + $count_biography_images + $count_article_images;
				$count_biography_files  = biographies::count_biography_file();

				$messages_sum 				  = messages::sum_of_all_messages($_SESSION['user_id']);
					$respond_messages_sum 	  = messages::sum_of_specific_messages($_SESSION['user_id'], '1');
					$not_respond_messages_sum = $messages_sum - $respond_messages_sum;

				$comments_sum 				= articles_marks::sum_of_comments($_SESSION['user_id']);
					$approve_comments_sum 	= articles_marks::sum_of_approved_comments($_SESSION['user_id']); 	
					$unnaprove_comments_sum = $comments_sum - $approve_comments_sum;	

				$count_notifications 	= count($check_today_notifications);
				$count_calendar_events	= phonebook::sum_of_all_contacts($_SESSION['user_id']); 
			?>
		
			<section class="row" id="headline-basic-info">
				<h1><span>Grafički Prikaz Podataka</span></h1>
			</section><!-- #headline-basic-info -->

			<section id="basic-info-main-nav">
				<?php include("inc/main_menu.php"); ?><!-- Include file "main_menu.php" -->  
			</section><!-- #basic-info-main-nav -->
	

	
		<div class="col-xs-10 col-xs-offset-1 user-info-content">
			<section class="col-sm-11 col-sm-offset-0 col-xs-10 col-xs-offset-1" id="basic-information">
				<div class="col-sm-6 col-xs-12 morris-barchart">
					<h1 class="text-center">Podaci o nalogu</h1>
						<div id="graph"></div>
				</div><!-- .morris-pies -->
				<div class="col-sm-4 col-sm-offset-2 col-xs-12 morris-barchart">
					<h1 class="text-center"><a href="user_phonebook.php">Podaci o kontaktima</a></h1>
						<div id="graph-contacts"></div>
				</div><!-- .morris-pies -->
				<div class="col-sm-12">
					<div class="col-sm-4 col-xs-12 morris-pies">
						<h1 class="text-center"><a href="user_images.php">Slike i Fajlovi</a></h1>
							<div id="graph-imgs_files"></div>
					</div><!-- .morris-pies -->
					<div class="col-sm-4 col-xs-12 morris-pies">
						<h1 class="text-center"><a href="user_messages.php">Poruke</a></h1>
							<div id="graph-message"></div>
					</div><!-- .morris-pies -->
					<div class="col-sm-4 col-xs-12 morris-pies">
						<h1 class="text-center"><a href="user_comments.php">Komentari</a></h1>
							<div id="graph-comment"></div>
					</div><!-- .morris-pies -->
				</div>
			</section><!-- #basic-information -->
		

		</div><!-- .basic-info-content -->
		
		<div class="basic-info-footer">
			<?php include("inc/footer.php"); ?>
			<script src="js/plugins/morris/morris.js"></script>
			<script src="js/plugins/morris/raphael-min.js"></script>
			<script type="text/javascript">
				// Use Morris.Bar for Display Info about images and files, messages and comments 
				Morris.Bar({
				  element: 'graph',
				  data: [
				    {x: 'Slike (fajl)', y: <?php echo $images_files_sum; ?>},
				    {x: 'Poruke', y: <?php echo $messages_sum; ?>},
				    {x: 'Komentari', y: <?php echo $comments_sum; ?>},
				    {x: 'Današnje Obaveze', y: <?php echo $count_notifications; ?>},
				  ],
				  xkey: 'x',
				  ykeys: ['y'],
				  labels: ['Ukupno'],
				  barColors: function (row, series, type) {
				   	if(row.label == "Slike (fajl)") return "#AD1D28";
					else if(row.label == "Poruke") return "#3498db";
					else if(row.label == "Komentari") return "#f1c40f";
					else if(row.label == "Današnje Obaveze") return "#1AB244";
				  },
				  resize: true
				});


				// Use Morris.Bar for Display Info about Contacts from phonebook
				Morris.Bar({
				  element: 'graph-contacts',
				  data: [
				    {x: 'Broj Kontakata (Imenik)', y: <?php echo $count_calendar_events; ?>}
				  ],
				  xkey: 'x',
				  ykeys: ['y'],
				  labels: ['Ukupno'],
				  barColors: function (row, series, type) {
				   	if(row.label == "Broj Kontakata (Imenik)") return "#3A539B";
				  },
				  resize: true
				});
				// Use Morris Donut for Images and Files
				Morris.Donut({
				  element: 'graph-imgs_files',
				  data: [
				    {value: <?php echo $count_uploaded_images; ?>, label: 'Slajder (Prva stranica)'},
				    {value: <?php echo $count_carousel_images; ?>, label: 'Slike ("O Nama")'},
				    {value: <?php echo $count_biography_images; ?>, label: 'Biografija'},
				    {value: <?php echo $count_article_images; ?>, label: 'Artikli'},
				    {value: <?php echo $count_biography_files; ?>, label: 'Fajlovi'}
				  ],
				  backgroundColor: '#ccc',
				  labelColor: '#000000',
				  colors: [
				    '#E87E04',
				    '#F7CA18',
				    '#BDC3C7',
				    '#663399',
				    '#F64747'
				  ],
				  formatter: function (x) { return x },
				  resize: true
				});

				// Use Morris Donut for Messages
				Morris.Donut({
				  element: 'graph-message',
				  data: [
				    {value: <?php echo $respond_messages_sum; ?>, label: 'Odgovorene'},
				    {value:  <?php echo $not_respond_messages_sum; ?>, label: 'Neodgovorene'}
				  ],
				  backgroundColor: '#cccccc',
				  labelColor: '#000000',
				  colors: [
				    '#1AB244',
				    '#AD1D28',
				  ],
				  formatter: function (x) { return x },
				  resize: true
				});

				// Use Morris Donut for Comments
				Morris.Donut({
				  element: 'graph-comment',
				  data: [
				    {value: <?php echo $approve_comments_sum; ?>, label: 'Odobreni'},
				    {value: <?php echo $unnaprove_comments_sum; ?>, label: 'Zabranjeni'}
				  ],
				  backgroundColor: '#ccc',
				  labelColor: '#000000',
				  colors: [
				    '#1AB244',
				    '#AD1D28',
				  ],
				  formatter: function (x) { return x },
				  resize: true
				});
			</script>
		</div><!-- .basic-info-footer -->
	</div><!-- .wrapper_basic_info -->

</body>
</html>