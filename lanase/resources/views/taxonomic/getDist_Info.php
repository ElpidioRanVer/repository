<?php

$name = isset($_POST['coords']) ? $_POST['coords'] : false;

if ($name) {

    $dist_info=array();

	// Initialize session and set URL.
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://maps.googleapis.com/maps/api/geocode/xml?latlng=".$name);


	// Set so curl_exec returns the result instead of outputting it.
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// Get the response and close the channel.
	$response = curl_exec($ch);
	curl_close($ch);
	//echo $response;

	$xml=simplexml_load_string($response) or die("Error: Cannot create object");
	for($j=0;$j<count($xml->result[0]->address_component);$j++){
        $dist_info[]= $xml->result[0]->address_component[$j]->type[0].':'.$xml->result[0]->address_component[$j]->long_name;
    }

    for ($i=0; $i < count($dist_info); $i++) { 
    	echo "$dist_info[$i].<br>";
    }
	//echo $content;

	
}
?>