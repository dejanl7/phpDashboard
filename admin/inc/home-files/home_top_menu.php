<?php include('../admin/inc/init.php'); ?>
<header class="main-header company-header">
  <!-- Logo -->
  <?php if( isset($_SESSION['user_id']) ): ?>
    <a href="../admin/index.php" class="logo">
      <i class="fa fa-home"></i>&nbsp
      <span>Moj Profil</span>
    </a>
  <?php else: ?>
    <a href="../index.php" class="logo">
      <i class="fa fa-home"></i>&nbsp
      <span>Početna stranica</span>
    </a>
  <?php endif; ?>
  
  <nav class="navbar navbar-static-top" role="navigation" >
    <span class="top-menu-search-form company-search-menu">
      <form action="#" class="top-menu-search-form-company">
        <input type="text" name="search-company" id="search-company" placeholder="Pretraga" class="form-control">
      </form>
    </span>
    <div class="company-home">
        <?php if( isset($_SESSION['user_id']) ): ?>
          <a href="../admin/index.php" class="company-home-button">
            <i class="fa fa-home"></i>&nbsp
          </a>
        <?php else: ?>
          <a href="../index.php" class="company-home-button">
            <i class="fa fa-home"></i>&nbsp
          </a>
        <?php endif; ?>
    </div>
  </nav><!-- .navbar-static-top -->
  
  <div id="searching-result-company"></div>
</header><!-- .main-header -->                      