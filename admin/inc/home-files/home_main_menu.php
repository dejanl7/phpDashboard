<nav id="top_menu" class="navbar navbar-default" role="navigation">	
	<div class="container" id="top_menu_container" style="
		font-size: <?php echo about_us::css("about_us","menu_text_weight", $base->clear_string($_GET['user_id'])); ?>;	
		font-family: <?php echo about_us::css("about_us","menu_text_type", $base->clear_string($_GET['user_id'])); ?>;
	">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">Početna</a>
		</div>
		<div class="collapse navbar-collapse navbar-ex1-collapse">
		<!-- Collect the nav links, forms, and other content for toggling -->
			<ul class="nav navbar-nav2" id="main_menu_font_color">
				<li><a class="change_text_color" href="company-index.php?user_id=<?php echo $base->clear_string($_GET['user_id']); ?>">Glavna </a></li>
				<li><a class="change_text_color" href="company-about.php?user_id=<?php echo $base->clear_string($_GET['user_id']); ?>">O nama</a> </li>
				<li><a class="change_text_color" href="company-gallery.php?user_id=<?php echo $base->clear_string($_GET['user_id']); ?>">Proizvodi/usluge</a></li>
				<li><a class="change_text_color" href="company-contact.php?user_id=<?php echo $base->clear_string($_GET['user_id']); ?>">Kontakt</a></li>
			</ul>
		</div>
	</div><!-- /.container -->
</nav>