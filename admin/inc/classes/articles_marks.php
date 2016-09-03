<?php

class articles_marks extends major_class{
	protected static $table = 'articles_marks';
	protected static $table_id = 'article_mark_id';
	protected static $fields_in_table = array('article_mark_id', 'article_id', 'user_id', 'client_name', 'client_mail', 'client_comment', 'client_approve_comment', 'customer_ip_address', 'price_mark', 'quality_mark', 'mark_time', 'read_unread_comment');
	
	public $article_mark_id;
	public $article_id;
	public $user_id;
	public $client_name;
	public $client_mail;
	public $client_comment;
	public $client_approve_comment;
	public $customer_ip_address;
	public $price_mark;
	public $quality_mark;
	public $mark_time;
	public $read_unread_comment;



/*================================================
	Select All Unread Comments Query
==================================================*/
	public static function select_unread_comments_query(){
		global $base;

		$clean_user_id = $base->clear_string($_SESSION['user_id']);
		$query = "SELECT * FROM articles_marks WHERE user_id = '{$clean_user_id}' AND read_unread_comment='0' LIMIT 3";
			return static::find_this_query($query);
	}


/*================================================
 	Make Unread Comments as Read Comments
==================================================*/
	public static function make_read_from_unread(){
		global $base;

		$clean_user_id = $base->clear_string($_SESSION['user_id']);
		$query = "UPDATE articles_marks SET read_unread_comment='1' WHERE user_id='{$clean_user_id}'";
			$base->select_table($query);
	}


/*================================================
	Block user abillity to give mark if user
	already gave mark for specific article. That
	mean user can give one mark for one article.
==================================================*/
	public static function block_double_mark($article_id, $customer_ip){
		global $base;
		
		$clean_article_id 	 = $base->clear_string($article_id);
		$clean_customer_ip   = $base->clear_string($customer_ip);
		
		$query = "SELECT * FROM articles_marks WHERE article_id ='{$clean_article_id}' AND customer_ip_address='{$clean_customer_ip}'";
		
		$rows = $base->while_loop($query);
			return mysqli_num_rows($rows);
	}

	
/*================================================
	Count NUMBER OF ROWS...
==================================================*/
	public static function number_of_rows($article_id){
		global $base;
		
		$clean_article_id = $base->clear_string($article_id);
		$query = "SELECT * FROM articles_marks WHERE article_id ='{$clean_article_id}' AND price_mark != '' AND quality_mark != '' AND client_approve_comment != '0'";
		
		$rows = $base->while_loop($query);
			return mysqli_num_rows($rows)* 2;
	}
	

/*================================================ 
	Count average mark...
==================================================*/
	public static function average_marks($article_id){
		global $base;
		
		$clean_article_id = $base->clear_string($article_id);
		$query = "SELECT SUM(quality_mark) + SUM(price_mark) AS 'value_sum' FROM articles_marks WHERE article_id ='{$clean_article_id}' AND client_approve_comment != '0'";

		$row_counter = $base->while_loop($query);
		while($row = mysqli_fetch_object($row_counter)){
			$value = $row->value_sum;
			if($value != 0){
				return $value / self::number_of_rows($clean_article_id);	
			}
			else{
				return $value / 1;
			}
		}
	}


/*================================================
 	Count number of users that gave mark for article
==================================================*/	
	public static function number_of_user($article_id){
		global $base;
		
		$clean_article_id = $base->clear_string($article_id);
		$query = "SELECT * FROM articles_marks WHERE article_id ='{$clean_article_id}' AND price_mark != '' AND quality_mark != ''";
		
		$rows = $base->while_loop($query);
			return mysqli_num_rows($rows);
	}
	


/*================================================
 	Count SUM of All Comments for One User
==================================================*/
	public static function sum_of_comments($user_id){
		global $base;
		
		$clean_user_id= $base->clear_string($user_id);
		$query = "SELECT * FROM articles_marks WHERE user_id = '{$clean_user_id}'";
		
		$rows = $base->while_loop($query);
			return mysqli_num_rows($rows);
	}


/*================================================
 	Count SUM of All APPROVED Comments 
==================================================*/
	public static function sum_of_approved_comments($user_id){
		global $base;
		
		$clean_user_id= $base->clear_string($user_id);
		$query = "SELECT * FROM articles_marks WHERE user_id = '{$clean_user_id}' AND client_approve_comment='1'";
		
		$rows = $base->while_loop($query);
			return mysqli_num_rows($rows);
	}



/*================================================
 	Count SUM of All DISABLED Comments 
==================================================*/
	public static function sum_of_all_approved_comments(){
		global $base;
		
		$clean_user_id= $base->clear_string($user_id);
		$query = "SELECT * FROM articles_marks WHERE client_approve_comment='1'";
		
		$rows = $base->while_loop($query);
			return mysqli_num_rows($rows);
	}




/*================================================
 	Count SUM of All DISABLED Comments (Sprecific ID)
==================================================*/
	public static function sum_of_disabled_comments($user_id){
		global $base;
		
		$clean_user_id= $base->clear_string($user_id);
		$query = "SELECT * FROM articles_marks WHERE user_id = '{$clean_user_id}' AND client_approve_comment='0'";
		
		$rows = $base->while_loop($query);
			return mysqli_num_rows($rows);
	}



/*================================================
	Count All Unread Comments
==================================================*/
	public static function sum_new_comments(){
		global $base;
		
		$clean_user_id= $base->clear_string($_SESSION['user_id']);
		$query = "SELECT * FROM articles_marks WHERE user_id = '{$clean_user_id}' AND read_unread_comment='0'";
		
		$rows = $base->while_loop($query);
			return mysqli_num_rows($rows);
	}




/*================================================
 	Approve Comment
==================================================*/
	public static function approve_comment_status($comment_id){
		global $base;

		$clean_comment_id = $base->clear_string($comment_id);
		$query = "UPDATE articles_marks SET client_approve_comment='1' WHERE article_mark_id='{$clean_comment_id}'";
			$base->select_table($query);

	}


/*================================================
 	Disable Comment
==================================================*/
	public static function disable_comment_status($comment_id){
		global $base;

		$clean_comment_id = $base->clear_string($comment_id);
		$query = "UPDATE articles_marks SET client_approve_comment='0' WHERE article_mark_id='{$clean_comment_id}'";
			$base->select_table($query);
	}


/*================================================
 	Delete Comment
==================================================*/
	public static function delete_comment($comment_id){
		global $base;

		$clean_comment_id = $base->clear_string($comment_id);
		$sql = "DELETE FROM articles_marks WHERE article_mark_id = '{$clean_comment_id}'";
			$base->select_table($sql);
	}



/*================================================
	Select Articles Marks element - according to 
	user_id
==================================================*/
	public static function show_hide_article_info($article_id){
		global $base;

		$clean_article_id = $base->clear_string($article_id);
		$query = "SELECT * FROM articles_marks WHERE article_id='{$clean_article_id}' AND user_id=".$base->clear_string($_SESSION['user_id'])." ORDER BY article_mark_id DESC";
			return $result = self::find_this_query($query);
			
	}	


/*================================================
	Check if comment exist...
==================================================*/
	public static function check_comment_exists($article_id, $id_user=''){
		global $base;

		$user_id = ( isset($_SESSION['user_id']) ? $_SESSION['user_id'] : $id_user );
		$clear_article_id = $base->clear_string($article_id);
		$clean_user_id = $base->clear_string($article_id);

		$query = "SELECT * FROM articles_marks WHERE article_id='{$clear_article_id}' AND user_id='{$clean_user_id}'";
		$result = self::find_this_query($query);
			return !empty($result)?array_shift($result) : false;
	}



/*==================================================== 
	Count All Records in Articles Table for ONE User
======================================================*/
	public static function count_number_of_all_records(){
		global $base;
		
		$sql 	= "SELECT COUNT(*) FROM articles_marks WHERE user_id='".$base->clear_string($_SESSION['user_id'])."' AND article_id IS NOT NULL";
		$result = $base->select_table($sql);
		$row 	= mysqli_fetch_array($result);
			return array_shift($row);
	}




/*================================================
	Count Number of Records for Specific Article
==================================================*/
	public static function count_article_records($article_id, $id_user=''){
		global $base;

		$user_id = ( isset($_SESSION['user_id']) ? $_SESSION['user_id'] : $id_user );
		$clear_article_id = $base->clear_string($article_id);
		$clean_user_id = $base->clear_string($user_id);
		
		$sql 	= "SELECT COUNT(*) FROM articles_marks WHERE user_id='{$clean_user_id}' AND article_id='{$clear_article_id}' AND client_approve_comment='1' AND client_comment != ''";
		$result = $base->select_table($sql);
		$row 	= mysqli_fetch_array($result);
			return array_shift($row);
	}



/*================================================
	COMMAND Part - Approve, Disable or Delete
	comment(s)
==================================================*/
	public function comments_manipulation($array, $select){
		if($array){
			foreach($array as $value){
				global $base;
				switch ($select){
					case "approve_comments":
						$clean_comment_id = $base->clear_string($value);
						$approve_comments = articles_marks::find_this_id($value);
						
						$query = "UPDATE articles_marks SET client_approve_comment='1' WHERE article_mark_id='{$clean_comment_id}'";
							$base->select_table($query);	
					break;
					case "disable_comments":
						$clean_comment_id = $base->clear_string($value);
						$disable_comments = articles_marks::find_this_id($value);
						
						$query = "UPDATE articles_marks SET client_approve_comment='0' WHERE article_mark_id='{$clean_comment_id}'";
							$base->select_table($query);	
					break;
					case "delete_comments":
						$clean_comment_id = $base->clear_string($value);
						$delete_comments = articles_marks::find_this_id($value);
						
						$query = "DELETE FROM articles_marks WHERE article_mark_id = '{$clean_comment_id}'";
							$base->select_table($query);	
					break;
				}
			}
		}	

	}





}

?>