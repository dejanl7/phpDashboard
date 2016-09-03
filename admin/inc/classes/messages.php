<?php 
class messages extends major_class {
	protected static $table 		= "messages";
	protected static $table_id 		= "message_id";
	protected static $id_user  		= "user_id";
	protected static $name_answer 	= 'message_answer';
	protected static $read_unread 	= 'message_read';

	protected static $fields_in_table = array('message_id','user_id','sender_name','sender_email','sender_phone', 'message_content', 'send_time', 'message_read', 'message_answer', 'message_answer_time' );
	
	public $message_id;
	public $user_id;
	public $sender_name;
	public $sender_email;
	public $sender_phone;
	public $message_content;
	public $send_time;
	public $message_read;
	public $message_answer;
	public $message_answer_time;


/*========================================
	Select All Unread Messages
==========================================*/
	public static function select_unread_messages_query(){
		global $base;

		$clean_user_id = $base->clear_string($_SESSION['user_id']);
		$query = "SELECT * FROM " . static::$table . " WHERE " . static::$id_user . "= '{$clean_user_id}' AND ". static::$read_unread ."=0  ORDER BY ".static::$table_id. " DESC LIMIT 3";
			return static::find_this_query($query);
	}


/*=======================================
	Sum Of All Messages
=========================================*/
	public static function sum_of_all_messages($user_id){
		global $base;

		$clean_user_id= $base->clear_string($user_id);

			$query = "SELECT * FROM " . static::$table . " WHERE " . static::$id_user . "= '{$clean_user_id}' AND ". static::$name_answer ."=''";
			$rows = $base->while_loop($query);
				return mysqli_num_rows($rows);
	}
	

/*========================================
	Sum Specific Messages (read or unread)
==========================================*/
	public static function sum_of_specific_messages($user_id, $messages){
		global $base;

		$clean_user_id= $base->clear_string($user_id);
		$clean_messages = $base->clear_string($messages);

			$query = "SELECT * FROM ". static::$table ." WHERE ". static::$id_user ." = '{$clean_user_id}' AND ". static::$read_unread ."='{$clean_messages}'  AND " . static::$name_answer . "='' ";
			$rows = $base->while_loop($query);
				return mysqli_num_rows($rows);
	}


/*========================================
	Count Number of All Messages
==========================================*/
	public static function count_number_of_all_records($user_id){
		global $base;
		
		$clean_user = $base->clear_string($user_id);

		$query = "SELECT * FROM ". static::$table ." WHERE ". static::$id_user ."='{$clean_user}'  AND ". static::$name_answer ."='' ";
		$rows = $base->while_loop($query);
			return mysqli_num_rows($rows);
	}




/*========================================
	Update Message - Make Read Message from
	Unread Message
==========================================*/
	public static function read_message($message_id){
		global $base;

		$clean_message_id = $base->clear_string($message_id);
		$query = "UPDATE " . static::$table . " SET " . static::$read_unread . "='1' WHERE ". static::$table_id ."='{$clean_message_id}'";
			return $base->select_table($query);

	}



/*========================================
	Show Answer Div - if answer(s) exists
==========================================*/
	public static function show_answers($message_id){
		global $base;

		$clean_message_id = $base->clear_string($message_id);
		$query = "SELECT * FROM ". static::$table ." WHERE ". static::$name_answer ."='{$clean_message_id}'";
		$result = self::find_this_query($query);		
			return $result;
	}




/*========================================
	Count All Answers
==========================================*/
	public static function count_all_answer(){
		global $base;

		$query = "SELECT * FROM ". static::$table ." WHERE ". static::$name_answer ." != '0' ";
			$rows = $base->while_loop($query);
				return mysqli_num_rows($rows);
	}


/*========================================
	Count Answer for Specific Message
==========================================*/
	public static function count_answer($message_id){
		global $base;

		$clean_message_id = $base->clear_string($message_id);
		$query = "SELECT * FROM ". static::$table ." WHERE ". static::$id_user ." = '{$base->clear_string($_SESSION['user_id'])}' AND ". static::$name_answer ."='{$clean_message_id}'";
			$rows = $base->while_loop($query);
				return mysqli_num_rows($rows);
	}



/*========================================
	Delete Message According to Id
==========================================*/
	public static function delete_message($message_id){
		global $base;

		$clean_message_id = $base->clear_string($message_id);
		$sql = "DELETE FROM ". static::$table ." WHERE ". static::$table_id ."='{$clean_message_id}' OR ". static::$name_answer ."='{$clean_message_id}'";
			$base->select_table($sql);

	}


/*========================================
	Delete More Messages
==========================================*/
	public function delete_more_messages($array, $select){
		if($array){
			foreach($array as $value){
				global $base;
				switch ($select){
					case "delete_messages":
						$clean_message_id = $base->clear_string($value);
						$sql = "DELETE FROM ". static::$table ." WHERE ". static::$table_id ."='{$clean_message_id}' OR ". static::$name_answer ."='{$clean_message_id}'";
						$base->select_table($sql);	
					break;
				}
			}
		}	

	}

}
	


?>