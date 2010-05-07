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
 * Useage example: Get a list of 311 service types.
 */

// Include the Open 311 classes.
include('classes/PHPOpen311.php');

define("BASE_URL", "");
define("API_KEY", "");
define("CITY_ID", "");

try {
	
	// Create a new instance of the Open 311 class.
	$open311 = new Open311(BASE_URL, API_KEY, CITY_ID);
	
	// Get a list of service types and descriptions.
	$open311->selectService();
	$serviceTypesXML = new SimpleXMLElement($open311->getOutput());
	
	// Check to see if an error code and message were returned.
	if(strlen($serviceTypesXML->Open311Error->errorCode) > 0) {
		throw new service_listException("API Error message returned: ".$serviceTypesXML->Open311Error->errorDescription);
	}
	
	// Loop through each service type and write out the code, name and description.
	foreach ($serviceTypesXML->Open311ServiceList->service as $service) {
		echo $service['service_code'].": ".$service['service_name'].": ".$service['service_description']."<br />";
	}
	
}

catch (service_listException $ex) {
	die("ERROR: ".$ex->getMessage());
}

catch (Exception $ex) {
	die("Sorry, a problem occured: ".$ex->getMessage());
}

?>
