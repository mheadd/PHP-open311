<?php

/**
 * 
 * Copyright 2010 Mark J. Headd
 * http://www.voiceingov.org
 *
 * This file is part of PHPOpen311
 * 
 * PHPOpen311 is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * PHPOpen311 is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public License
 * along with PHPOpen311.  If not, see <http://www.gnu.org/licenses/>.
 *  
 */

/**
 * Useage example: Create a new 311 service request.
 */

// Include the Open 311 classes.
include('classes/PHPOpen311.php');

define("BASE_URL", "");
define("API_KEY", "");
define("CITY_ID", "");

// Service request information.
$service_code = '021';
$lat = '37.76524078';
$lon = '-122.4212043';
$address_string = '123 Some Street, San Francisco, CA 94114';
$customer_email = 'john_q_public@gmail.com';
$device_id = 'se4H173nxaQsddl';
$account_id = '1234567890';
$first_name = 'John';
$last_name = 'Public';
$phone_number = '4151234567';
$description = 'There is a major pothole at this location.';
$media_url = 'http://sf.streetsblog.org/wp-content/uploads/2009/06_18/bike.route.pothole.jpg';

try {
	
	// Create a new instance of the Open 311 class.
	$open311 = new Open311(BASE_URL, API_KEY, CITY_ID);
	
	// Create a new 311 Service request.
	$open311->createRequest($service_code, $lat, $lon, $address_string, $customer_email, $device_id, 
				$account_id, $first_name, $last_name, $phone_number, $description, $media_url);	
							
	$createRequestXML = new SimpleXMLElement($open311->getOutput());
	
	// Check to see if an error code and message were returned.
	if(strlen($createRequestXML->Open311Error->errorCode) > 0) {
		throw new create_requestException("API Error message returned: ".$createRequestXML->Open311Error->errorDescription);
	}
	
	// Display the ID of the service request.
	echo "Service Request ID: ".$createRequestXML->Open311Create->service_request_id;
}

catch (create_requestException $ex) {
	die("ERROR: ".$ex->getMessage());
}

catch (Exception $ex) {
	die("Sorry, a problem occured: ".$ex->getMessage());
}

?>
