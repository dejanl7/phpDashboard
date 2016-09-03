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
      $unread_messages_count  = messages_admin::sum_of_specific_messages($_SESSION['user_id'], '0');
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
          <a href="master_admin.php">
            <i class="fa fa-file"></i> <span>Pregled</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <a href="master_admin_messages.php">
            <i class="fa fa-inbox"></i> 
            <span>Poruke
               <?php if($unread_messages_count != 0): ?>
                  <small>(<?php echo $unread_messages_count; ?>)</small>
                <?php endif; ?>
            </span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          
        </li>
    </section>
    <!-- /.sidebar -->
</aside>