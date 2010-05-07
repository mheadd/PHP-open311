Overview
========

PHPOpen311 is a set of PHP classes for working with [the Open311 API](http://open311.org/). 

Usage
=====

<pre>
<?php    

include('classes/PHPOpen311.php');

define("BASE_URL", "");
define("API_KEY", "");
define("CITY_ID", "");

$sample_service_request_id = 294331;

try {
	
	$open311 = new Open311(BASE_URL, API_KEY, CITY_ID);
	
	$open311->statusUpdate(sample_service_request_id);
	$statusUpdateXML = new SimpleXMLElement($open311->getOutput());
	
	if(strlen($statusUpdateXML->Open311Error->errorCode) > 0) {
		throw new status_updateException("API Error message returned: ".$statusUpdateXML->Open311Error->errorDescription);
	}
	
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

  
?>    
