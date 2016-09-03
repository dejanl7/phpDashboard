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
<link href='css/plugins/full-calendar/fullcalendar.css' rel='stylesheet' />
<link href='css/plugins/full-calendar/fullcalendar.print.css' rel='stylesheet' media='print' />
</head>
<body  class="hold-transition skin-blue sidebar-mini <?php echo ($user->left_menu_collapse== '1' ? ' sidebar-collapse' : ''); ?>" data-menustate=<?php echo ($user->left_menu_collapse== '1' ? ' collapsed' : ' not-collapsed');  ?>>
<div class="se-pre-con"></div><!-- Preloader Div -->
	
<div class="wrapper" id='wrapper_user_calendar' style="
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
				<h1><span>Kalendar sa Obavezama</span></h1>
			</section><!-- #headline-basic-info -->

			<section id="basic-info-main-nav">
				<?php include("inc/main_menu.php"); ?><!-- Include file "main_menu.php" -->  
			</section><!-- #basic-info-main-nav -->
	
			<div class="container user-calendar-content">
		 	  <div class="row" id='wrap' >
		 		<section class="col-sm-12">
		 		   <div class="col-sm-12 col-xs-12 command-calendar">
		 			<div id='external-events' class="col-xs-12 col-sm-3 pull-left">
		 			  <div id="external-events-loader">
		 				<div id="all-events">
		 					<h4 class="text-center">Tip Obaveštenja</h4>	
							<div class='fc-event external-event' data-color='#D91E18' data-title="Poslovni Sastanak" style="background-color: #D91E18;">Poslovni Sastanak</div>
							<div class='fc-event external-event' data-color='#1F3A93' data-title="Kreiranje Izvestaja" style="background-color: #1F3A93;">Kreiranje Izvestaja</div>
							<?php 
								$personalNotifications = full_calendar_notification::show_notifications(); 
								foreach($personalNotifications as $notification):
							?>
								<div id="personalEventsLoader" class='fc-event external-event' data-notificationid="<?php echo $notification->notification_id; ?>" data-color='<?php echo $notification->notification_color ?>' data-title="<?php echo $notification->notification_title; ?>" style="background-color: <?php echo $notification->notification_color ?>;"><?php echo $notification->notification_title; ?></div>
							<?php endforeach; ?>
						</div><!-- #all-events -->	

						<button class="btn btn-warning" id="add-personal-specific-notification">Novo Obaveštenje &nbsp &nbsp &nbsp &nbsp</button>
						<div id="add-new-event">
							<h4 class="text-center">Novo Obaveštenje</h4>
							<form action="#" method="POST" id="add-new-notification-form">
								<div class="notification-form-control" id="notification-colors">
									<ul class="notification-color-picker" id="choose-color">
					                    <li><a href="#"><i class="fa fa-square fa-2x" data-color="#d35400" style="color: #d35400;"></i></a></li>
					                    <li><a href="#"><i class="fa fa-square fa-2x" data-color="#c0392b" style="color: #c0392b;"></i></a></li>
					                    <li><a href="#"><i class="fa fa-square fa-2x" data-color="#1F3A93" style="color: #1F3A93;"></i></a></li>
					                    <li><a href="#"><i class="fa fa-square fa-2x" data-color="#DB0A5B" style="color: #DB0A5B;"></i></a></li>
					                    <li><a href="#"><i class="fa fa-square fa-2x" data-color="#CF000F" style="color: #CF000F;"></i></a></li>
					                    <li><a href="#"><i class="fa fa-square fa-2x" data-color="#96281B" style="color: #96281B;"></i></a></li>
					                    <li><a href="#"><i class="fa fa-square fa-2x" data-color="#F7CA18" style="color: #F7CA18;"></i></a></li>
					                    <li><a href="#"><i class="fa fa-square fa-2x" data-color="#6C7A89" style="color: #6C7A89;"></i></a></li>
					                    <li><a href="#"><i class="fa fa-square fa-2x" data-color="#663399" style="color: #663399;"></i></a></li>
					                    <li><a href="#"><i class="fa fa-square fa-2x" data-color="#674172" style="color: #674172;"></i></a></li>
					                    <li><a href="#"><i class="fa fa-square fa-2x" data-color="#81CFE0" style="color: #81CFE0;"></i></a></li>
					                    <li><a href="#"><i class="fa fa-square fa-2x" data-color="#2C3E50" style="color: #2C3E50;"></i></a></li>
                    				</ul>
								</div>			
		                    	<div class="notification-form-control">
		                    		<input type="text" id="new-event" class="notification-form form-control"  placeholder="Naziv" required>
		                    		<span id="notification-color" class="hidden" aria-hidden="true"></span>
		                    	</div>
		                    	<div class="notification-form-control text-right">
		                    		<input type="submit" id="submit-new-notification" class="btn btn-primary" value="Dodaj">
		                    	</div><!-- /btn-group -->
							</form>
						</div>

					  </div>
					</div><!-- #external-events -->
					
					<div id='calendar' class="col-xs-12 col-sm-9"></div>

					<div id="fullcalendar-trash" class="col-xs-12 text-center">
						<div class="delete-notification">Obriši Obaveštenje</div>
						<img width="80" height="50" src="img/garbage-bin.png" alt="brisanje" />
					</div>
				  
				  </div>	
				</section>
			  </div>
			</div><!-- .user-messages-content -->

			<div class="user-message-footer">
				<?php include("inc/footer.php"); ?>
			</div><!-- .user-messages-footer -->
	</div><!-- .wrapper_user_message -->
	


<script src='js/plugins/full-calendar/moment.min.js'></script>
<script src='js/plugins/full-calendar/jquery-ui.custom.min.js'></script>
<script src='js/plugins/full-calendar/fullcalendar.min.js'></script>
<script src='js/plugins/full-calendar/lang/sr.js'></script>
<script>

	$(document).ready(function() {	 
	/*==========================================
		Initialize the external events
	============================================*/
		$('#external-events .fc-event').each(function() {
			// store data so the calendar knows to render an event upon drop
			$(this).data('event', {
				title: $.trim($(this).text()), // use the element's text as the event title
				stick: true // maintain when user navigates (see docs on the renderEvent method)
			});
			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});

		});


	/*==========================================
		Initialize the calendar
	============================================*/
		$('#calendar').fullCalendar({
			events: [
		        <?php
		        	$find_events = full_calendar::show_events();
		        	foreach( $find_events as $key => $event ){
		        		$event_info = $event->event;
		        			echo $event_info.',';
		           	}
		        ?>
		    ],
		    header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
		    editable: true,
		    eventDrop: function(event, delta, revertFunc) {
		    	if( event.event_id ){
		    		var event_id = event.event_id;
		    	}
		    		else{
		    			var event_id = '';
		    		}
		    	if( event.end === null ){
		    		var endDate = '';
		    	}
		    		else {
		    			var endDate = event.end.format();
		    		}
		    	var title 		= event.title;
		    	var startDate 	= event.start.format();
		    	var eventColor 	= event.color;

		    	$.ajax({
		    		type: 'POST',
		    		url: 'inc/pages/pages_insert_info.php',
		    		data: { title:title, startDate:startDate, event_id:event_id, endDate:endDate, eventColor:eventColor },
		    		success: function(data){
		    			$('.response').html(data);
		    			location.reload();
		    		},
		    		error: function(data){
		    			console.log('error during the sending request');
		    		}
		    	});
		    },
			droppable: true, // this allows things to be dropped onto the calendar
			drop: function(date) {
				var dropTitle 	= $(this).data('title');
				var dropDate 	= date.format();
				var dropColor 	= $(this).data('color'); 
				
				$.ajax({
		    		type: 'POST',
		    		url: 'inc/pages/pages_insert_info.php',
		    		data: { dropTitle:dropTitle, dropDate:dropDate, dropColor:dropColor },
		    		success: function(data){
		    			$('.response').html(data);
		    			location.reload();
		    		},
		    		error: function(data){
		    			console.log('error during the sending request');
		    		}
		    	});


				// If Option for Delete Event After Drop is Checked, Remove Dropped Event
				if ($('#drop-remove').is(':checked')) {
					$(this).remove();
				}
			},
			eventResize: function(event, delta, revertFunc) {
				var resizeId 	= event.event_id;
		        var resizeTitle = event.title;
		        var startDate 	= event.start.format();
		        var endDate 	= event.end.format();
		        var resizeColor = event.color;

		        $.ajax({
		    		type: 'POST',
		    		url: 'inc/pages/pages_insert_info.php',
		    		data: { resizeId:resizeId, resizeTitle:resizeTitle, startDate:startDate, endDate:endDate, resizeColor:resizeColor },
		    		success: function(data){
		    			location.reload();
		    		},
		    		error: function(data){
		    			console.log('error during the sending request');
		    		}
		    	});
		    },
		    eventDragStop: function(event, jsEvent) {
		    	//$(this).addClass('external-event');
			    var trashBin 		= $('#fullcalendar-trash');
			    // Offset
			    var elementOffset 	= trashBin.offset();
			    var leftOffset 		= elementOffset.left;
			    var topOffset 		= elementOffset.top;

			    // Dimensions
			    var trashBinWidth 	= trashBin.width();
			    var trashBinHeight 	= trashBin.height();

			    // Event ID
			    var delete_event_id = event.event_id;
			    if( jsEvent.pageX >= leftOffset && jsEvent.pageX <= leftOffset + trashBinWidth && jsEvent.pageY >= topOffset  && jsEvent.pageY <= topOffset + trashBinHeight ){  	
			    	$.ajax({
			    		type: 'POST',
			    		url: 'inc/pages/pages_insert_info.php',
			    		data: { delete_event_id:delete_event_id },
			    		success: function(data){
			    			$('.response').html(data);
			    			location.reload();
			    		},
			    		error: function(data){
			    			console.log('error during the sending request');
			    		}
			    	});
			    }

			}  
		});


	/*==========================================
		Trash Bin CSS Effect - dragover	
	============================================*/	
			$('.external-event').draggable();
		    $( "#fullcalendar-trash" ).droppable({
		    	over: function( event, ui ) {
		    		// Add Some CSS for Trash Bin
		    		$('#fullcalendar-trash').css('width','40%').css('border','3px solid #cccccc').css('border-style', 'dashed');
		    		
		    		if( typeof ui.draggable.data('notificationid') != 'undefined' ){
		    			var notificationId = ui.draggable.data("notificationid");
		    		}
		    			else {
		    				var notificationId = '';
		    				alert('"Poslovni Sastanak" i "Kreiranje Izvestaja" su sistemske varijable. One se ne mogu brisati.');
		    				$('#fullcalendar-trash').css('width','20%').css('border','3px solid #cccccc');
		    			}
		    			
		    		if( notificationId != '' ){
		    			//alert(notificationId);
		    			$.ajax({
		    				type: 'POST',
			    			url: 'inc/pages/pages_insert_info.php',
			    			data: { notificationId:notificationId },
				    		success: function(data){
				    			$('.response').html(data);
				    			location.reload();
				    		},
				    		error: function(data){
				    			console.log('error during the sending request');
				    		}
		    			});
		    		}
		    		
		    	},
		    	out: function( event, ui ){
		    		$('#fullcalendar-trash').css('width', '20%').css('border','none');
		    	},
		    	enter: function(event, ui){
		    		$('#fullcalendar-trash').css('width', '20%').css('border','none');
		    	}
		    });
	  	

	

	});

</script>
</body>
</html>