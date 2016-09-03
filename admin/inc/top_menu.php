<header class="main-header">
  <!-- Logo -->
  <a href="../" class="logo">
    <span class="logo-mini">Link</span><!-- Responsive Logo (Mini Version) -->
    <span class="logo-lg"><b><?php echo $session->username_session; ?></b></span>
  </a>
  
  
  <nav class="navbar navbar-static-top" role="navigation" >
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"></a>
    
        <span class="top-menu-search-form">
          <form action="#">
            <input type="text" name="search" id="search" placeholder="Pretraga" class="form-control">
          </form>
        </span>

  
    <?php 
      global $base;
      $notifications = full_calendar::select_current_notification();
      $check_today_notifications = array();
      
        foreach($notifications as $key => $elements ){
            $start_time = explode('T', $elements->start);

           // echo $start_time[0];
            if( date('Y-m-d') == $start_time[0] ){
              $check_today_notifications[$key] = $start_time[0];
            }
            else if ( isset( $elements->end ) ){
             $end_time = $elements->end;
                if( date('Y-m-d') == $elements->end ){
                  echo $check_today_notifications[$key] = $end_time;
                }
                  else if ( date('Y-m-d') >= $start_time || date('Y-m-d') <= $end_time ){
                    echo $check_today_notifications[$key] = $end_time;
                  }
              }
            }
            /*if( date("Y-m-d") == $elements->start){
              
            }*/


          

      $unread_comments            = articles_marks::sum_new_comments();
      $select_all_unread_comments = articles_marks::select_unread_comments_query();
      $unread_messages_count      = ($user->role != 'master_admin' ? messages::sum_of_specific_messages($_SESSION['user_id'], '0') : messages_admin::sum_of_specific_messages($_SESSION['user_id'], '0') ); 
      $select_all_unread_message  =  ($user->role != 'master_admin' ? messages::select_unread_messages_query() : messages_admin::select_unread_messages_query() );

        include("inc/modals_dialog.php"); // Include Modal Dialogs
          
    ?>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
         <li class="dropdown user user-menu <?php echo ($user->role == 'admin' ? '' : ' hidden'); ?>" >
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-globe fa-lg  <?php echo ( count($check_today_notifications) > 0 ? 'new_notification_exists' : '' ); ?>">
              <sup>  
                <?php 
                  echo ( count($check_today_notifications) > 0 ? count($check_today_notifications) : '' ); 
                ?>
              </sup>

            </i>
          </a>
          <?php if( !empty($notifications) ): ?>
            <ul class="dropdown-menu">
              <?php foreach( $notifications as $elements ): ?>
                <?php if( date("Y-m-d") == $elements->start ): ?>
                    <a href="#" class="dropdown-element">
                      <li class="user-footer new-element-container">
                        <div class="element-content">
                          <small class="new-element">
                            <?php 
                              echo major_class::date_time_format($elements->start); 
                              if( !empty($elements->end) ){
                                echo ' - '. major_class::date_time_format($elements->end);
                              }
                            ?>
                          </small>
                          <div class="new-element-content">
                            <?php echo $elements->title; ?>  
                          </div>
                        </div>
                      </li>
                    </a>
                <?php endif; ?>
              <?php endforeach; ?>
              <div class="text-center">
                <a href="user_calendar_event.php" class="see-all-elements" style="background-color: transparent !important;">Kalendar Obaveza</a>
              </div>
            </ul><!-- .drodown-menu -->
          <?php else: ?>
            <ul class="dropdown-menu">
              <div class="text-center">
                <p>Nemate novih obaveza</p><br>
                <a href="user_calendar_event.php" class="see-all-elements" style="background-color: transparent !important;">Kalendar Obaveza</a>
              </div>
            </ul>
        <?php endif; ?>
        </li>
         <li class="dropdown user user-menu  <?php echo ($unread_comments == '' ? '' : 'unread_li'); ?> <?php echo ($user->role == 'admin' ? '' : ' hidden'); ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-comment fa-lg <?php echo ($unread_comments == '' ? '' : 'unread_elements_exists'); ?>" aria-hidden="true"><sup> <?php echo ( $unread_comments == '0' ? '' : $unread_comments ); ?></sup></i>
          </a>
          <?php if( $unread_comments != 0 ): ?>
            <ul class="dropdown-menu">
              <?php foreach( $select_all_unread_comments as $unread_info ): ?>
                <a href="user_comments.php" class="dropdown-element">
                  <li class="user-footer new-element-container">
                    <div class="element-content">
                      <small class="new-element"><?php echo $unread_info->client_mail; ?></small>
                      <div class="new-element-content">
                        <?php echo substr($unread_info->client_comment, 0, 40); ?>  
                      </div>
                    </div>
                  </li>
                </a>
              <?php endforeach; ?>
              <div class="text-center">
                <a href="user_comments.php" class="see-all-elements" style="background-color: transparent !important;">Svi Komentari</a>
              </div>
            </ul><!-- .drodown-menu -->
          <?php else: ?>
            <ul class="dropdown-menu">
              <div class="text-center">
                <p>Nemate novih komentara</p><br>
                <a href="user_comments.php" class="see-all-elements" style="background-color: transparent !important;">Svi Komentari</a>
              </div>
            </ul>
        <?php endif; ?>
        </li>
        <li class="dropdown user user-menu <?php echo ($unread_messages_count == '' ? '' : 'unread_li'); ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-envelope fa-lg <?php echo ($unread_messages_count == '' ? '' : 'unread_elements_exists'); ?>" aria-hidden="true"><sup> <?php echo ( $unread_messages_count == '0' ? '' : $unread_messages_count ); ?></sup></i>
          </a>
          <?php if( $unread_messages_count != 0 ): ?>
            <ul class="dropdown-menu">
              <?php foreach( $select_all_unread_message as $unread_info ): ?>
                <a href="user_message.php?<?php echo ( $user->role != 'master_admin' ? 'user' : 'master_user'); ?>=<?php echo $_SESSION['user_id']; ?>&message=<?php echo ( $user->role != 'master_admin' ? $unread_info->message_id : $unread_info->messages_admin_id) ; ?>" class="dropdown-element">
                  <li class="user-footer new-element-container">
                    <div class="element-content">
                      <small class="new-element"><?php echo ( $user->role != 'master_admin' ? $unread_info->sender_email : ($user->role == 'master_admin' && $unread_info->client_id != '0' ? User::find_this_id($unread_info->client_id)->email : $unread_info->client_email ) ); ?></small>
                      <div class="new-element-content">
                        <?php 
                          echo  ( $user->role != 'master_admin' ? substr($unread_info->message_content, 0, 45) : substr($unread_info->content, 0, 45)  );
                        ?>
                      </div>
                    </div>
                  </li>
                </a>
              <?php endforeach; ?>
              <div class="text-center">
                <a href="<?php echo ($user->role == 'admin' ? 'user_messages.php' : 'master_admin_messages.php');  ?>" class="see-all-elements" style="background-color: transparent !important;">Sve Poruke</a>
              </div>
            </ul><!-- .drodown-menu -->
          <?php else: ?>
            <ul class="dropdown-menu">
              <div class="text-center">
                <p>Nemate novih poruka</p><br>
                <a href="user_messages.php" class="see-all-elements" style="background-color: transparent !important;">Sve Poruke</a>
              </div>
            </ul>
        <?php endif; ?>
        </li>

        <li class="dropdown user user-menu user-company-name">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="img/logo - okrugli_s.png" class="user-image" alt="User Image">
            <span class="company-name">UniLink Finance</span>
          </a>

          <ul class="dropdown-menu">
            <li class="user-header">
              <img src="img/logo - okrugli_s.png" class="img-circle" alt="User Image">
              <p>UniLink-Network<small>Osnivač</small></p>
            </li><!-- .user-header -->

            <!-- User Footer-->
            <li class="user-footer">
              <div class="profile pull-left <?php echo ($user->role == 'admin' ? '' : ' hidden'); ?>">
                <a href="#" class="btn btn-block btn-top-menu edit-contact remodal-bg" data-remodal-target="remodal-ask-admin">Pitaj Admin-a</a>
              </div>
              <div class="logout pull-left">
                <a href="logout.php" class="btn btn-block btn-top-menu">Odjavi se</a>
              </div>
            </li><!-- .user-footer -->

          </ul><!-- .drodown-menu -->
        </li><!-- .user-menu -->
      </ul><!-- .navbar-nav -->
    </div><!-- .navbar-custom-menu -->

  </nav><!-- .navbar-static-top -->
    <div id="searching-result"></div>
</header><!-- .main-header -->  

