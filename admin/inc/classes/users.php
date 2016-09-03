<?php
class user extends major_class{
	protected static $table = "users";
	protected static $table_id = "user_id";
	protected static $fields_in_table = array('user_id', 'role', 'background_img', 'name','pib','mat_broj','username','password','email', 'phone', 'city','address', 'allow_email_message', 'active','register_time','status', 'email_confirm', 'left_menu_collapse', 'contact_person', 'tags', 'business_description', 'business_activities', 'subsidiaries_address', 'ip_address', 'current_ip_address');

	public $user_id;
	public $role;
	public $background_img;
	public $name;
	public $pib;
	public $mat_broj;
	public $username;
	public $password;
	public $email;
	public $phone;
	public $city;
	public $address;
	public $allow_email_message;
	public $active;
	public $register_time;
	public $status;
	public $email_confirm;
	public $left_menu_collapse;
	public $contact_person;
	public $tags;
	public $business_description;
	public $business_activities;
	public $subsidiaries_address;
	public $ip_address;
	public $current_ip_address;


/*====================================================
	If New Username or Company Name is equal with some 
	Username of Comapny Name in database, return 0
======================================================*/
public static function checkout_new_user($table_element, $user_info){
	global $base;
	
	$clean_table_element 	= $base->clear_string($table_element);
	$clean_user_info 		= $base->clear_string($user_info);

	$query  = "SELECT * FROM users WHERE  ". $clean_table_element."='{$clean_user_info}'";
	$result = self::find_this_query($query);
		return $result;
}




/*==================================================== 
	Approve Some User from Master Admin Panel
======================================================*/
public static function do_approve_user($user_id){
	global $base;
	$clean_user = $base->clear_string($user_id);
	
	$sql = "UPDATE users SET active = '1' WHERE user_id = '{$clean_user}'"; 
	$base->select_table($sql);
}


/*==================================================== 
	Block Some User from Master Admin Panel
======================================================*/
public static function do_block_user($user_id){
	global $base;
	$clean_user = $base->clear_string($user_id);
	
	$sql = "UPDATE users SET active = '0' WHERE user_id = '{$clean_user}'"; 
	$base->select_table($sql);
}

/*====================================================
	Block User if Acitve is equal to 0
======================================================*/
public static function block_user($user_id){
	global $base;

	$clean_user_id = $base->clear_string($user_id);

	$query = "SELECT * FROM users WHERE user_id='{$clean_user_id}' AND status IS NOT '{0}'";
	$result = self::find_this_query($query);
		return $result;
}


/*==================================================== 
	Chack out if user exists in database... 
======================================================*/
public static function check_user($username, $password){
	global $base;
	$clean_username = $base -> clear_string($username);
	$clean_password = $base -> clear_string($password);
		$query = "SELECT * FROM users WHERE username='{$clean_username}' AND password = '{$clean_password}'";
		
		$result = self::find_this_query($query);
		return !empty($result) ? array_shift($result) : false;
}


/*==================================================== 
	Find User id While User try to login
======================================================*/
public static function find_user_id($username, $password){
	global $base;
	$clean_username = $base -> clear_string($username);
	$clean_password = $base -> clear_string($password);
		$query = "SELECT * FROM users WHERE username='{$clean_username}' AND password = '{$clean_password}'";
		$result = self::find_this_query($query);

			foreach( $result as $info ) {
				return $info->user_id;
			}
}


/*==================================================== 
	Check if user is on-line.
======================================================*/
	public function online($user_id){
		global $base;
		$clean_user = $this->user_id = $base->clear_string($user_id);
		$ip =  getenv('HTTP_CLIENT_IP') ? : getenv('HTTP_X_FORWARDED_FOR') ? : getenv('HTTP_X_FORWARDED') ? : getenv('HTTP_FORWARDED_FOR') ? : getenv('HTTP_FORWARDED') ? : getenv('REMOTE_ADDR');
		$sql = "UPDATE users SET status = '1', current_ip_address ='{$ip}' WHERE user_id = '{$clean_user}'"; 
		$base->select_table($sql);
	}


/*==================================================== 
	User is off-line. 
======================================================*/
	public function offline($user_id){
		global $base;
		$clean_user = $this->user_id = $base->clear_string($user_id);
		$sql = "UPDATE users SET status = '0' WHERE user_id = '{$clean_user}'";
		$base->select_table($sql);
	}
	

/*==================================================== 
	Insert user into database 
======================================================*/
	public function insert_user($name,$username,$password,$email,$date,$confirm){
		global $base;
		$clean_name = $this->name = $base->clear_string($name);
		$clean_username = $this->username = $base->clear_string($username);
		$clean_password = $this->password = $base->clear_string($password);
		$clean_email = $this->email = $base->clear_string($email);
		$clean_date = $this->register_time = $base->clear_string($date);
		$clean_confirmation = $this->email_confirm = $base->clear_string($confirm);
		$ip =  getenv('HTTP_CLIENT_IP') ? : getenv('HTTP_X_FORWARDED_FOR') ? : getenv('HTTP_X_FORWARDED') ? : getenv('HTTP_FORWARDED_FOR') ? : getenv('HTTP_FORWARDED') ? : getenv('REMOTE_ADDR');

		$sql = "INSERT INTO users(name,username,password,email,register_time,email_confirm,ip_address) VALUES('{$clean_name}','{$clean_username}','{$clean_password}','{$clean_email}','{$clean_date}', '{$clean_confirmation}', '{$ip}')";
		if($base->select_table($sql)){
			$last_insert_id = $base->insert_id();
			$this->user_id = $last_insert_id;
		} 

		$clean_last_id = $base->clear_string($this->user_id);
		
	// After inserting user, we need to prepare our tables. 
	// We start with table "index_page" - put some information into this table...
	// Purpose of this code is to create an appropriate info in 5 tables. After some time, we will use that information for css purpose...
		$sql_index = "INSERT INTO index_page(user_id) VALUES('{$clean_last_id}')";
		$base->select_table($sql_index);
		
		// Insert data in about_us PAGE...
		$sql_aboutUs = "INSERT INTO about_us(user_id) VALUES('{$clean_last_id}')";
			$base->select_table($sql_aboutUs);
			
		// Insert data in galery_page PAGE...
		$galery_page = "INSERT INTO gallery_page(user_id) VALUES('{$clean_last_id}')";
			$base->select_table($galery_page);
			
		// Insert data in preview_page PAGE...
		$preview_page = "INSERT INTO preview_page(user_id) VALUES('{$clean_last_id}')";
			$base->select_table($preview_page);
			
		
		// Insert data in contact_page_css PAGE...
		$contact_page = "INSERT INTO contact_page_css(user_id) VALUES('{$clean_last_id}')";
			$base->select_table($contact_page);
	}




/*==================================================== 
	Show User Information, and Update info.
======================================================*/
	public static function update_user_info( $company_name, $city, $address, $pib, $mat_broj, $username, $email, $phone, $contact_person ){
		global $base;
		$clean_company_name 	= $base->clear_string($company_name);
		$clean_city				= $base->clear_string($city);
		$clean_address 			= $base->clear_string($address);
		$clean_pib 				= $base->clear_string($pib);
		$clean_mat_broj 		= $base->clear_string($mat_broj);
		$clean_username 		= $base->clear_string($username);
		$clean_email 			= $base->clear_string($email);
		$clean_phone 			= $base->clear_string($phone);
		$clean_contact_person	= $base->clear_string($contact_person);

		$sql = "UPDATE users SET name='{$clean_company_name}', city='{$clean_city}', address='{$clean_address}', pib='{$clean_pib}', mat_broj='{$clean_mat_broj}', username='{$clean_username}', email='{$clean_email}', phone='{$clean_phone}', contact_person='{$clean_contact_person}' WHERE user_id = ".$base->clear_string($_SESSION['user_id']);
		
			return $base->select_table($sql);
	}
	



/*==================================================== 
	Allow (or not) Sending Info about Customer Message
	in personal E-mail of Company.
======================================================*/
	public static function update_sending_mail_message($check_field){
		global $base;

		$clean_check_field = $base->clear_string($check_field);

		$sql = "UPDATE users SET allow_email_message = '{$clean_check_field}' WHERE user_id = ".$base->clear_string($_SESSION['user_id']);
			return $base->select_table($sql);
	}


/*==================================================== 
	Update Info about Type of Business Acitvity
======================================================*/
	public static function update_business_activity($activity) {
		global $base;

		$clean_activity = $base->clear_string($activity);

		$sql = "UPDATE users SET business_activities = '{$clean_activity}' WHERE user_id = ".$base->clear_string($_SESSION['user_id']);
			return $base->select_table($sql);
	}


/*==================================================== 
	Update Info about Tags - key words
======================================================*/
	public static function update_key_words($words, $description) {
		global $base;

		$clean_words = $base->clear_string($words);
		$clean_description = $base->clear_string($description);

		$sql = "UPDATE users SET tags = '{$clean_words}', business_description = '{$clean_description}' WHERE user_id = ".$base->clear_string($_SESSION['user_id']);
			return $base->select_table($sql);
	}


/*==================================================== 
	Collapse or Uncollapse Left Menu
======================================================*/
	public static function sidebar_collapse($collapse){
		global $base;

		$clean_collapse = $base->clear_string($collapse);

		$sql = "UPDATE users SET left_menu_collapse = '{$clean_collapse}' WHERE user_id = ".$base->clear_string($_SESSION['user_id']);
			return $base->select_table($sql);

	}


/*==================================================== 
	Change Password - Insert New Password
======================================================*/
	public static function change_password($password) {
		global $base;

		$clean_password = $base->clear_string($password);

		$sql = "UPDATE users SET password = '{$clean_password}' WHERE user_id = ".$base->clear_string($_SESSION['user_id']);
			return $base->select_table($sql);
	}


/*==================================================== 
	Count All Users that are On-line
======================================================*/
	public static function count_online_users(){
		global $base;

		$query = "SELECT * FROM users WHERE status != '0' ";
			$rows = $base->while_loop($query);
				return mysqli_num_rows($rows);
	
	}



/*==================================================== 
	Count Master Admin Users
======================================================*/
	public static function count_master_admin_users(){
		global $base;

		$query = "SELECT * FROM users WHERE role = 'master_admin' ";
			$rows = $base->while_loop($query);
				return mysqli_num_rows($rows);
	
	}

/*==================================================== 
	Operations with Array -> More Users Approve or 
	Block
======================================================*/
	public static function users_manipulation($array, $select){
		if($array){
			foreach($array as $value){
				global $base;
				switch ($select){
					case "approve_status":
						$clean_user_id = $base->clear_string($value);
						
						$query = "UPDATE users SET active='1' WHERE user_id='{$clean_user_id}'";
							$base->select_table($query);	
					break;
					case "block_status":
						$clean_user_id = $base->clear_string($value);
					
						$query = "UPDATE users SET active='0' WHERE user_id='{$clean_user_id}'";
							$base->select_table($query);	
					break;
				}
			}
		}	

	}




/*====================================================
	E-mail Confirmation, check if user register. If 
	user is registered, update column "active" with 1
======================================================*/
	public static function user_confirmation($username, $email, $confirm_code){
		global $base;

		$clean_username = $base->clear_string($username);
		$clean_email 	= $base->clear_string($email);
		$clean_confirm	= $base->clear_string($confirm_code);

		$query = "SELECT * FROM users WHERE username='{$clean_username}' AND email='{$clean_email}' AND email_confirm='{$clean_confirm}'";
		$search = $base->select_table($query);

			foreach( $search as $info ) {
				if ( $info['username'] == $clean_username && $info['email'] == $clean_email && $info['email_confirm'] == $clean_confirm ){
					$sql = "UPDATE users SET active = '1' WHERE username='{$clean_username}' AND email='{$clean_email}' AND email_confirm='{$clean_confirm}'"; 
						$base->select_table($sql);
				}
				else {
					return;
				}
			}

	}




}

?>