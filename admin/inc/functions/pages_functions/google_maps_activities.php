<?php
	include("../../init.php");
	
	if(!$session->session_status()){
		redirect("login.php");
	}

/*================================================ 	
    Update contact info
==================================================*/	
    if(isset($_GET['contact_id'])){
		echo $id = $_GET['contact_id'];
		echo $show_address = $_GET['address_form'];
			$address = geocode($_GET['address_form']);			
				echo $latitude_values = $address[0];
				echo $longitude_values = $address[1];	
		echo $phone_number = $_GET['phone_form'];
		echo $mobile_phone = $_GET['mobile_phone_form'];
		echo $e_mail = $_GET['email_form'];
		echo $fax = $_GET['fax_form'];

			$res = contact::update_address_information($id, $show_address, $latitude_values, $longitude_values, $phone_number, $mobile_phone, $e_mail, $fax);
			redirect("../../../contact.php");
	}


/*================================================ 
    Delete contact
==================================================*/	
    if(isset($_GET['delete_contact_id'])){
		$contact_id =  $_GET['delete_contact_id'];
		
		$delete_contact = new contact();
		$delete_contact->contact_id = $contact_id;
		$delete_contact->delete();
		
		redirect("../../../contact.php");
	}

					
/*================================================
    Function to geocode address, it will return 
    false if unable to geocode address.
==================================================*/
function geocode($address){
    // url encode the address
    $address = urlencode($address);
     
    // google map geocode api url
    $url = "http://maps.google.com/maps/api/geocode/json?address={$address}";
 
    // get the json response
    $resp_json = file_get_contents($url);
     
    // decode the json
    $resp = json_decode($resp_json, true);
 
    // response status will be 'OK', if able to geocode given address 
    if($resp['status']=='OK'){
 
        // get the important data
        $lati = $resp['results'][0]['geometry']['location']['lat'];
        $longi = $resp['results'][0]['geometry']['location']['lng'];
        $formatted_address = $resp['results'][0]['formatted_address'];
         
        // verify if data is complete
        if($lati && $longi && $formatted_address){
         
            // put the data in the array
            $data_arr = array();            
             
            array_push(
                $data_arr, 
                    $lati, 
                    $longi, 
                    $formatted_address
                );
             
            return $data_arr;
             
        }else{
            return false;
        }
         
    } else{
        return false;
    }
}

?>