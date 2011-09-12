Overview
========

PHPOpen311 is a set of PHP classes for working with [the Open311 API](http://open311.org/).

Note - this library was developed for use with the first version of the Open311 API.  It is not compatible with the latest version of the Open311 spec.

To obtain a PHP library that was developed specifically for V2 of the Open311 spec, look [here](https://github.com/codeforamerica/open311_php).

Usage
=====

<pre>
<?php

// Include the Open 311 classes.
include('classes/PHPOpen311.php');

// Access credentials, see http://open311.org for more details.
define("BASE_URL", "");
define("API_KEY", "");
define("CITY_ID", "");

// A sample service request ID.
$sample_service_request_id = 294331;

try {
	// Create a new instance of the Open 311 class.
	$open311 = new Open311(BASE_URL, API_KEY, CITY_ID);
	
        // Get a the current status of a service request.
	$open311->statusUpdate(sample_service_request_id);
	$statusUpdateXML = new SimpleXMLElement($open311->getOutput());
	
        // Check to see if an error code and message were returned.
	if(strlen($statusUpdateXML->Open311Error->errorCode) > 0) {
		throw new status_updateException("API Error message returned: ".$statusUpdateXML->Open311Error->errorDescription);
	}
	
        // Display the current status of the service request.
	echo "Status of Service Request #sample_service_request_id: ".strtoupper($statusUpdateXML->Open311Status->status);	
}

catch (status_updateException $ex) {
	die("ERROR: ".$ex->getMessage());
}

catch (Exception $ex) {
	die("Sorry, a problem occured: ".$ex->getMessage());
}

?>
</pre>

Output
======
Status of Service Request #294331: OPEN
