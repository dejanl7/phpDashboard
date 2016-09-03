<?php 
class messages_admin extends messages {
	protected static $table 		= "messages_admin";
	protected static $table_id 		= "messages_admin_id";
	protected static $id_user  		= "admin_id";
	protected static $name_answer 	= 'answer';
	protected static $read_unread 	= 'read_msg';

	protected static $fields_in_table = array('messages_admin_id', 'admin_id', 'client_id', 'client_name', 'client_email', 'client_phone', 'content', 'date', 'read_msg', 'answer', 'answer_time');
	
	public $messages_admin_id;
	public $admin_id;
	public $client_id;
	public $client_name;
	public $client_email;
	public $client_phone;
	public $content;
	public $date;
	public $read_msg;
	public $answer;
	public $answer_time;


}

?>