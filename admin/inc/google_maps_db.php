<?php include("init.php"); ?>
<?php
	if(isset($_POST['update_google_maps'])){
		$latitude_values = $_POST['latitude_value'];
		$longitude_values = $_POST['longitude_value'];
		$id = $_POST['id'];
		
		/*foreach($latitude_values as $key => $latitude){
			echo $latitude. "<br/>";
			echo $longitude_values[$key];
			$con = mysqli_connect("localhost","root","","business_network");
			$query = "UPDATE contact_page SET latitude = '{$latitude}', longitude = '{$longitude_values[$key]}' WHERE contact_id='{$id[$key]}'";
			//echo $latitude.", ". $longitude_values[$key].", ".$id[$key];
			
			$result = mysqli_query($con,$query);
		}*/
		
		$result = contact::update_google_address($latitude_values, $longitude_values, $id);
		
	}

	if(isset($_POST['insert_location'])){
		$addresses = geocode($_POST['address']);
		$address = $_POST['address'];
		$latitude = $addresses[0];
		$longitude = $addresses[1];
		$description = $_POST['description'];
		
		$contact_address = new contact();
		$contact_address->user_id = $base->clear_string($_SESSION['user_id']);
		$contact_address->address = $base->clear_string($address);
		$contact_address->latitude = $base->clear_string($latitude);
		$contact_address->longitude = $base->clear_string($longitude);
		$contact_address->description = $base->clear_string($description);
		
		$contact_address->create();
		
	}
			
	
			
/*================================================ 
	Function to geocode address, it will return 
	false if unable to geocode address
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


		redirect("../contact.php");

?>