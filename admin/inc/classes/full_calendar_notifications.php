<?php 
class full_calendar_notification extends major_class{
	protected static $table = "full_calendar_notifications";
	protected static $table_id = "notification_id";
	protected static $fields_in_table = array('notification_id', 'user_id', 'notification_title', 'notification_color');

	public $notification_id;
	public $user_id;
	public $notification_title;
	public $notification_color;


/*=====================================
	Select Notifications from 
	Full-Calendar
=======================================*/
	public static function show_notifications(){
		global $base;

		$clean_user_id  = $base->clear_string($_SESSION['user_id']);

		$query = "SELECT * FROM full_calendar_notifications WHERE user_id='{$clean_user_id}'";
			return static::find_this_query($query);
	}



/*=====================================
	Delete Notification According to 
	Notification ID
=======================================*/
	public static function delete_fullcalendar_notification($notification_id){
		global $base;

		$clean_notification_id = $base->clear_string($notification_id);

		$sql = "DELETE FROM full_calendar_notifications WHERE notification_id = '{$clean_notification_id}'";
			$base->select_table($sql);
	}


}


?>