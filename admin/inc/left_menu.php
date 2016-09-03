<aside class="main-sidebar">
  <?php 
      global $base;
      $notifications = full_calendar::select_current_notification();
        $check_today_notifications = array();
          foreach($notifications as $key => $elements ){
            if( date("Y-m-d") == $elements->start){
                $check_today_notifications[$key] = $elements->start;
            }
          }
      $unread_comments        = articles_marks::sum_new_comments();
      $unread_messages_count  = messages::sum_of_specific_messages($_SESSION['user_id'], '0');
  ?>
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="img/logo - okrugli_s.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>UniLink-Finance</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">GLAVNI MENI</li>
        <li class="all-left-menu-optons">
          <a href="basic_info.php">
            <i class="fa fa-file"></i> <span>Osnovni Podaci</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <a href="user_info.php">
            <i class="fa fa-pie-chart"></i> <span>Info</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <a href="user_images.php">
            <i class="fa fa-picture-o"></i> <span>Slike <small>(fajlovi)</small></span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <a href="user_comments.php" class="<?php echo ($unread_comments == '' ? '' : 'not_seen'); ?>">
            <i class="fa fa-comments"></i> 
              <span>Komentari
                <?php if($unread_comments != 0): ?> 
                  <small>(<?php echo $unread_comments; ?>)</small>
                <?php endif; ?>
              </span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <a href="user_messages.php" class="<?php echo ($unread_messages_count == '' ? '' : 'not_seen'); ?>">
            <i class="fa fa-inbox"></i> 
              <span>Poruke
                <?php if($unread_messages_count != 0): ?>
                  <small>(<?php echo $unread_messages_count; ?>)</small>
                <?php endif; ?>
              </span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <a href="user_calendar_event.php" class="<?php echo (count($check_today_notifications) == '' ? '' : 'not_seen' ); ?>">
            <i class="fa fa-calendar-check-o"></i> 
              <span>Kalendar
              <?php if( (count($check_today_notifications) != '') ): ?>
                    <small>(<?php echo (count($check_today_notifications) > 0 ? count($check_today_notifications) : '' ); ?>)</small>
              <?php endif; ?>
              </span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <a href="user_phonebook.php">
            <i class="fa fa-book"></i> 
              <span>Imenik</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
        </li>
    </section>
    <!-- /.sidebar -->
</aside>