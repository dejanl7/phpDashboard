<?php 
class phonebook extends major_class{
	protected static $table = "phonebook";
	protected static $table_id = "phonebook_id";
	protected static $fields_in_table = array('phonebook_id', 'user_id', 'phonebook_company_id', 'phonebook_name', 'phonebook_phone', 'phonebook_address', 'phonebook_email', 'phonebook_contactperson', 'contact_type');

	public $phonebook_id;
	public $user_id;
	public $phonebook_company_id;
	public $phonebook_name;
	public $phonebook_phone;
	public $phonebook_address;
	public $phonebook_email;
	public $phonebook_contactperson;
	public $contact_type;


/*=========================================
	Select Information From Phonebook 
===========================================*/
	public static function show_phonebook_information(){
		global $base;

		$clean_user_id  = $base->clear_string($_SESSION['user_id']);

		$query = "SELECT * FROM phonebook WHERE user_id='{$clean_user_id}' ORDER BY phonebook_id DESC";
			return static::find_this_query($query);
	}



/*=========================================
	Take phonebook_id From Query
===========================================*/
	public static function get_phonebook_id($id){
		global $base;

		$clean_id  = $base->clear_string($id);

		$query  = "SELECT * FROM phonebook WHERE phonebook_company_id='{$clean_id}'";
		$result = static::find_this_query($query);
			foreach( $result as $phonebook_info ){
				return $phonebook_info->phonebook_id;
			}
	}


/*=========================================
	Update Information Into Phonebook
===========================================*/
	public static function update_phonebook_info($id, $phonebookName, $phonebookPhone, $phonebookAddress, $phonebookEmail, $phonebookPerson, $contactType){
		global $base;

		$clean_id 					= $base->clear_string($id);
		$clean_user_id 				= $base->clear_string($_SESSION['user_id']);
		$clean_phonebook_name 		= $base->clear_string($phonebookName);
		$clean_phonebook_phone 		= $base->clear_string($phonebookPhone);
		$clean_phonebook_address 	= $base->clear_string($phonebookAddress);
		$clean_phonebook_email 		= $base->clear_string($phonebookEmail);
		$clean_phonebook_person 	= $base->clear_string($phonebookPerson);
		$clean_contact_type	 		= $base->clear_string($contactType);


		$query = "UPDATE phonebook SET phonebook_name='{$clean_phonebook_name}', phonebook_phone='{$clean_phonebook_phone}', phonebook_address='{$clean_phonebook_address}', phonebook_email='{$clean_phonebook_email}', phonebook_contactperson='{$clean_phonebook_person}', contact_type='{$clean_contact_type}' WHERE phonebook_id='{$clean_id}' AND user_id='{$clean_user_id}'";
		
			return $base->select_table($query);

	}



/*=========================================
	Delete Contact from Phonebook
===========================================*/
	public static function delete_phonebook_info($id){
		global $base;

		$clean_phonebook_id = $base->clear_string($id);

		$sql = "DELETE FROM phonebook WHERE phonebook_id = '{$clean_phonebook_id}'";
			return $base->select_table($sql);
	}



/*========================================
	Delete More Messages
==========================================*/
	public function delete_more_phonebook_contacts($array, $select){
		if($array){
			foreach($array as $value){
				global $base;
				switch ($select){
					case "delete_phonebook_contact":
						$clean_phonebook_id = $base->clear_string($value);
						$sql = "DELETE FROM phonebook WHERE phonebook_id='{$clean_phonebook_id}'";
							$base->select_table($sql);	
					break;
				}
			}
		}	

	}



/*========================================
	Sum Of All Messages
==========================================*/
	public static function sum_of_all_contacts($user_id){
		global $base;

		$clean_user_id= $base->clear_string($user_id);
		$query = "SELECT * FROM phonebook WHERE user_id = '{$clean_user_id}'";
			$rows = $base->while_loop($query);
				return mysqli_num_rows($rows);
	}

}




?>