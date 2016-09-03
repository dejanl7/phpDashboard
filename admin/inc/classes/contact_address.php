<?php

class contact extends major_class{
	protected static $table = 'contact_page';
	protected static $table_id ='contact_id';
	protected static $fields_in_table = array('contact_id','user_id','address','latitude','longitude','description','phone_number','mobile_phone','fax','e_mail');
	
	public $contact_id;
	public $user_id;
	public $address;
	public $latitude;
	public $longitude;
	public $description;
	public $phone_number;
	public $mobile_phone;
	public $fax;
	public $e_mail;
	
/*==================================================== 
	Update address on dragg google maps MARKER(S) 
======================================================*/
	public static function update_google_address($latitude_values, $longitude_values, $contact_id){
		global $base;
		
		foreach($latitude_values as $key => $latitude){
			$query = "UPDATE contact_page SET latitude = '{$base->clear_string($latitude)}', longitude = '{$base->clear_string($longitude_values[$key])}' 
				WHERE contact_id='{$base->clear_string($contact_id[$key])}'";
				$base->select_table($query);
		}
	}
	

/*==================================================== 
	Update contact information - modal dialog.
======================================================*/
	public static function update_address_information($id, $address, $latitude, $longitude, $phone_number, $mobile_phone, $email, $fax){
		global $base;
		$clean_id = $base->clear_string($id);
		$clean_address = $base->clear_string($address);
		$clean_latitude = $base->clear_string($latitude);
		$clean_longitude = $base->clear_string($longitude);
		$clean_phone_number = $base->clear_string($phone_number);
		$clean_mobile_phone = $base->clear_string($mobile_phone);
		$clean_email = $base->clear_string($email);
		$clean_fax = $base->clear_string($fax);
				
		$query = "UPDATE contact_page SET address = '{$clean_address}', latitude = '{$clean_latitude}', longitude = '{$clean_longitude}', phone_number = '{$clean_phone_number}', mobile_phone = '{$clean_mobile_phone}', 
			e_mail = '{$clean_email}', fax = '{$clean_fax}' WHERE contact_id = '{$clean_id}'";
			return $base->select_table($query);
	}



	
}

?>