
<?php
$name = isset($_POST['sc_name']) ? $_POST['sc_name'] : false;
$numb = isset($_POST['no_row']) ? $_POST['no_row'] : false;
if ($name!="" && $name!=null) {
	get_tax_info($name,$numb);
}





function get_tax_info($name,$numb){
	if ($name) {
		$name=str_replace(" ", "+", $name);

		//echo $name."<br>";
		$TaxID_xml=call_curl_command("https://eutils.ncbi.nlm.nih.gov/entrez/eutils/esearch.fcgi?db=taxonomy&term=".$name."&retmode=xml");
		if($TaxID_xml->IdList[0]->Id){
			$TaxID=$TaxID_xml->IdList[0]->Id[0];
			echo "<script type='text/javascript'>print_if_exists(true,$numb);</script>";
		 }else{
		 	$colecta .="$numb";
			echo "<script type='text/javascript'>print_if_exists(false,$numb);</script>";
		 }
	}
}


function call_curl_command($URL){

	// Initialize session and set URL.
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $URL);

	// Set so curl_exec returns the result instead of outputting it.
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// Disable SSL verifier.
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	// Get the response and close the channel.
	$response = curl_exec($ch);
	curl_close($ch);
	
	//Convert the HTML response to XML object
	$xml=simplexml_load_string($response) or die("Error: Cannot create object");
	echo $xml;
	return $xml;
}
?>