<?php 
class full_calendar extends major_class{
	protected static $table = "full_calendar_events";
	protected static $table_id = "event_id";
	protected static $fields_in_table = array('event_id', 'user_id', 'event');

	public $event_id;
	public $user_id;
	public $event;




/*=====================================
	Select Events From Full-Calendar
=======================================*/
	public static function show_events(){
		global $base;

		$clean_user_id  = $base->clear_string($_SESSION['user_id']);

		$query = "SELECT * FROM full_calendar_events WHERE user_id='{$clean_user_id}'";
			return static::find_this_query($query);
	}




/*=====================================
	Insert Events Into Full-Calendar
=======================================*/
	public static function insert_events($user_id, $title, $startDate, $eventColor){
		global $base;

		$clean_user_id  	= $base->clear_string($_SESSION['user_id']);
		$clean_title 		= $base->clear_string($title);
		$clean_startDate	= $base->clear_string($startDate);
		$clean_event_color	= $base->clear_string($eventColor);
		
		$json_events = array('title' => $clean_title, 'start' => $clean_startDate, 'color' => $clean_event_color);
		$events = json_encode($json_events);

		$sql = "INSERT INTO full_calendar_events(user_id, event) VALUES ('{$clean_user_id}', '{$events}')";
		if($base->select_table($sql)){
			$last_insert_id = $base->insert_id();
			$event_id = $last_insert_id;
		} 
			$clean_last_id = $base->clear_string($event_id);
			$push_last_id = array('event_id'=>$clean_last_id);
			$array_json = json_encode($push_last_id + $json_events); 

			$query = "UPDATE full_calendar_events SET event='{$array_json}' WHERE event_id = '{$clean_last_id}'";
				return $base->select_table($query);

	}



/*=====================================
	Update Specific Event
=======================================*/
	public static function update_events($event_id, $title, $startDate, $endDate, $eventColor){
		global $base;

		$clean_user_id  = $base->clear_string($_SESSION['user_id']);
		$clean_event_id = $base->clear_string($event_id);
		$clean_title 	= $base->clear_string($title);
		$clean_startDate= $base->clear_string($startDate);
		$clean_endDate = ( !empty($endDate) ? $base->clear_string($endDate) : '' );
		$clean_event_color	= $base->clear_string($eventColor);

		$json_events = array( 'event_id' => $clean_event_id, 'title' => $clean_title, 'start' => $clean_startDate, 'end' => $clean_endDate, 'color' => $clean_event_color );
		$events = json_encode($json_events);

		$query = "UPDATE full_calendar_events SET event='{$events}' WHERE user_id='{$clean_user_id}' AND event_id = '{$clean_event_id}'";
			return $base->select_table($query);

	}



/*=====================================
	Update Specific Event - Resize It
=======================================*/
	public static function resize_event($event_id, $title, $startDate, $endDate, $resizeColor){
		global $base;

		$clean_user_id  	= $base->clear_string($_SESSION['user_id']);
		$clean_event_id 	= $base->clear_string($event_id);
		$clean_title 		= $base->clear_string($title);
		$clean_startDate	= $base->clear_string($startDate);
		$clean_endDate 		= $base->clear_string($endDate);
		$clean_resizeColor 	= $base->clear_string($resizeColor);	

		$json_events = array( 'event_id' => $clean_event_id, 'title' => $clean_title, 'start' => $clean_startDate, 'end' => $clean_endDate, 'color' => $clean_resizeColor );
		$events = json_encode($json_events);

		$query = "UPDATE full_calendar_events SET event='{$events}' WHERE user_id='{$clean_user_id}' AND event_id = '{$clean_event_id}'";
			return $base->select_table($query);

	}



/*=====================================
	Delete Event According to Event ID
=======================================*/
	public static function delete_fullcalendar_event($event_id){
		global $base;

		$clean_event_id = $base->clear_string($event_id);

		$sql = "DELETE FROM full_calendar_events WHERE event_id = '{$clean_event_id}'";
			$base->select_table($sql);
	}



/*=====================================
	Curent Notification - Select and 
	Show Notification for this Day
=======================================*/
	public static function select_current_notification(){
		global $base;

		$clean_user_id  = $base->clear_string($_SESSION['user_id']);

		$query = "SELECT * FROM full_calendar_events WHERE user_id='{$clean_user_id}'";
		$thisNotification = static::find_this_query($query);

		$arrayLength = count($thisNotification);
		$json_data = '[';
		foreach( $thisNotification as $key => $notification_element ){
			if( $key == $arrayLength-1 ){
				$json_data .=$notification_element->event;
			}
			else{
				$json_data .=$notification_element->event.",";
			}
		}
		$json_data .= ']';

	 	return $jsonDecode = json_decode($json_data);// access title of $book object
		
	}



/*=====================================
	Sum of Current Notifications
=======================================*/
	public static function sum_current_notifications($user_id, $messages){
		global $base;

		$clean_user_id= $base->clear_string($user_id);
		$clean_messages = $base->clear_string($messages);

			$query = "SELECT * FROM full_calendar WHERE user_id = '{$clean_user_id}' AND message_read ='{$clean_messages}'  AND message_answer='' ";
			$rows = $base->while_loop($query);
				return mysqli_num_rows($rows);
	}




}




?>