<?php
$name = isset($_POST['sc_name']) ? $_POST['sc_name'] : false;
$row = isset($_POST['no_row']) ? $_POST['no_row'] : false;
$coords = isset($_POST['coordinates']) ? $_POST['coordinates'] : false;


if ($row!="" && $row!=null) {
	if ($name!="" && $name!=null) {
		global $row;
		$name2=str_replace("+", " ", $name);
		echo '<input type="hidden" name="scientific_name[]" value="'.$name2.'">';
		get_tax_info($name);
	}
}



function get_tax_info($name){
	global $coords;
	if ($name) {
		$name=str_replace(" ", "+", $name);
		$TaxID_xml=call_curl_command("https://eutils.ncbi.nlm.nih.gov/entrez/eutils/esearch.fcgi?db=taxonomy&term=".$name."&retmode=xml");
		if($TaxID_xml->IdList[0]->Id){
			$TaxID=$TaxID_xml->IdList[0]->Id[0];
			//echo "<b>".$TaxID."</b><br><br>";
			echo '<input type="hidden" name="id[]" value="'.$TaxID.'">';

			$tax_xml= get_xml_tax($TaxID);
			getTaxonomy($tax_xml);		//670 ms
			get_synonyms($tax_xml);	//650 - 700 ms
			get_NCBI_records($name); //950 ms
			get_external_links($TaxID); //700ms
			get_vernacular_names($name); //1s

			if ($coords!=""&&$coords!=null) {		//550ms
				get_distribution($coords);
			}

		}else{
			//echo "Registro no encontrado, verifique el nombre";
		}
	}
}


function getTaxonomy($Taxonomy_xml){
	//Array with taxonomic lineage.
	global $row;
	$Tax_values=array();
	if($Taxonomy_xml!=""&&$Taxonomy_xml!=null){
		
		//Check the condition that verify if there is a result
		if($Taxonomy_xml->Taxon[0]->OtherNames){

			for($j=0;$j<count($Taxonomy_xml->Taxon->LineageEx->Taxon);$j++){
				if($Taxonomy_xml->Taxon->LineageEx[0]->Taxon[$j]->Rank[0]!="no rank"){
					$Tax_values[]= $Taxonomy_xml->Taxon->LineageEx[0]->Taxon[$j]->Rank[0].';'.$Taxonomy_xml->Taxon->LineageEx[0]->Taxon[$j]->ScientificName;
				}
		    }
		}
		$Tax_values[]="rank_marker;".$Taxonomy_xml->Taxon->Rank[0];
	}
	for ($i=0; $i < count($Tax_values); $i++) {
		$tax_val=split(";", $Tax_values[$i]);
	
		echo '<input type="hidden" name="'.$tax_val[0].$row.'" value="'.$tax_val[1].'">';

	}


	return $Tax_values;
}

function get_synonyms($xml_data){
	global $row;
	$synonyms_list=array();

	
	if ($xml_data!=""&&$xml_data!=null) {
		for($j=0;$j<count($xml_data->Taxon->OtherNames->CommonName);$j++){
		    $synonyms_list[]= /*"CommonName:".*/$xml_data->Taxon->OtherNames->CommonName[$j];
		}

		for($j=0;$j<count($xml_data->Taxon->OtherNames->Synonym);$j++){
		    $synonyms_list[]= /*"Synonym:".*/$xml_data->Taxon->OtherNames->Synonym[$j];
		}

		for($j=0;$j<count($xml_data->Taxon->OtherNames->GenbankCommonName);$j++){
		    $synonyms_list[]= /*"GenbankCommonName:".*/$xml_data->Taxon->OtherNames->GenbankCommonName[$j];
		}

		for($j=0;$j<count($xml_data->Taxon->OtherNames->Name);$j++){
		    $synonyms_list[]= /*$xml_data->Taxon->OtherNames->Name[$j]->ClassCDE[0].':'.*/$xml_data->Taxon->OtherNames->Name[$j]->DispName[0];
		}

	}


	for ($i=0; $i < count($synonyms_list); $i++) { 
		echo '<input type="hidden" name="synonym'.$row.'[]" value="'.$synonyms_list[$i].'">';

	}
	return $synonyms_list;
}

function get_xml_tax($TaxID){
	if($TaxID!=""&&$TaxID!=null){
		$Taxonomy_xml=call_curl_command("https://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi?db=taxonomy&id=".$TaxID."&retmode=xml");
		return $Taxonomy_xml;
	}

}

function get_NCBI_records($name){
	global $row;
	$ncbi=array();

	if($name){
		$records_xml=call_curl_command("https://eutils.ncbi.nlm.nih.gov/gquery?term=".$name."&retmode=xml");
		//Check the condition that verify if there is a result
		
		for($j=0;$j<count($records_xml->eGQueryResult->ResultItem);$j++){
			if($records_xml->eGQueryResult->ResultItem[$j]->Count[0]!=0){
				//$ncbi[]= $records_xml->eGQueryResult->ResultItem[$j]->MenuName[0].";".$records_xml->eGQueryResult->ResultItem[$j]->DbName[0].';'.$records_xml->eGQueryResult->ResultItem[$j]->Count[0]."; "."https://www.ncbi.nlm.nih.gov/".$records_xml->eGQueryResult->ResultItem[$j]->DbName[0]."/?term=".$name;

				//With normal name
				$ncbi[]= $records_xml->eGQueryResult->ResultItem[$j]->MenuName[0].";"."https://www.ncbi.nlm.nih.gov/".$records_xml->eGQueryResult->ResultItem[$j]->DbName[0]."/?term=".$name;

				//With db name
				//$ncbi[]= $records_xml->eGQueryResult->ResultItem[$j]->DbName[0].';'."https://www.ncbi.nlm.nih.gov/".$records_xml->eGQueryResult->ResultItem[$j]->DbName[0]."/?term=".$name;
			}
		}
	}

	for ($i=0; $i < count($ncbi); $i++) {
		$ncbi_val=split(";", $ncbi[$i]);
		echo '<input type="hidden" name="record_name'.$row.'[]" value="'.$ncbi_val[0].'">';
		echo '<input type="hidden" name="direct_links'.$row.'[]" value="'.$ncbi_val[1].'">'; 
		//echo $ncbi[$i]."<br>";
	}
	return $ncbi;
}


function get_distribution($coords){
	global $row;
	$dist_info=array();
	$coord_values = split("%2C", $coords);
	$lat=$coord_values[0];
	$lon=$coord_values[1];

	if($coords){
		$coord_xml=call_curl_command("http://maps.googleapis.com/maps/api/geocode/xml?latlng=".$coords);

		echo '<input type="hidden" name="latitude'.$row.'" value="'.$lat.'">';
    	echo '<input type="hidden" name="longitude'.$row.'" value="'.$lon.'">';

    	if ($coord_xml->status=="OK") {
    		for($j=0;$j<count($coord_xml->result[0]->address_component);$j++){
	        	$dist_info[]= $coord_xml->result[0]->address_component[$j]->type[0].';'.$coord_xml->result[0]->address_component[$j]->long_name;
	    	}
	    	
	    	 for ($i=0; $i < count($dist_info); $i++) {
	    	 	$distribution_val=split(";", $dist_info[$i]);
	    	 	echo '<input type="hidden" name="'.$distribution_val[0].$row.'" value="'.$distribution_val[1].'">';

		    	//echo "$dist_info[$i].<br>";
		    }
    	}

		
	}
	//return $dist_info;
}

function get_external_links($taxid){
	global $row;
	$links=array();

	if ($taxid!=""&&$taxid!=null){
		//echo "string";
		$links_xml=call_curl_command("https://eutils.ncbi.nlm.nih.gov/entrez/eutils/elink.fcgi?dbfrom=taxonomy&id=".$taxid."&cmd=llinks&retmode=xml");

		for($j=0;$j<count($links_xml->LinkSet->IdUrlList->IdUrlSet->ObjUrl);$j++){

			//fields: provider_name;provider_abbr;url;subject;category;attribute

			$links[]= $links_xml->LinkSet->IdUrlList->IdUrlSet->ObjUrl[$j]->Provider[0]->Name[0].";".$links_xml->LinkSet->IdUrlList->IdUrlSet->ObjUrl[$j]->Provider[0]->NameAbbr.";".$links_xml->LinkSet->IdUrlList->IdUrlSet->ObjUrl[$j]->Url[0].";".$links_xml->LinkSet->IdUrlList->IdUrlSet->ObjUrl[$j]->SubjectType.";".$links_xml->LinkSet->IdUrlList->IdUrlSet->ObjUrl[$j]->Category.";".$links_xml->LinkSet->IdUrlList->IdUrlSet->ObjUrl[$j]->Attribute;
		}
	}

	for ($i=0; $i < count($links); $i++) {
		$link_val=split(";", $links[$i]);
		echo '<input type="hidden" name="provider_name'.$row.'[]" value="'.$link_val[0].'">';
		echo '<input type="hidden" name="provider_abbr'.$row.'[]" value="'.$link_val[1].'">';
		echo '<input type="hidden" name="url'.$row.'[]" value="'.$link_val[2].'">';
		echo '<input type="hidden" name="subject'.$row.'[]" value="'.$link_val[3].'">';
		echo '<input type="hidden" name="category'.$row.'[]" value="'.$link_val[4].'">';
		echo '<input type="hidden" name="attribute'.$row.'[]" value="'.$link_val[5].'">';
		 
	}
	return $links;
}

function get_vernacular_names($name){
	global $row;

	$gbif_vnm=array();
	$ch = curl_init();
	//curl_setopt($ch, CURLOPT_URL, "http://api.gbif.org/v1/species/match?verbose=true&name=".$name);
	curl_setopt($ch, CURLOPT_URL, "http://api.gbif.org/v1/species/match?name=".$name);

	// Set so curl_exec returns the result instead of outputting it.
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// Disable SSL verifier.
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	// Get the response and close the channel.
	$response = curl_exec($ch);
	curl_close($ch);
	//echo "<br><br>".$response;
	
	$obj = json_decode($response,true);
	//In case have multiple array
	//$gbif_id= $obj['speciesKey'];
	$gbif_id= $obj['usageKey'];



	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://api.gbif.org/v1/species/".$gbif_id."/vernacularNames");

	// Set so curl_exec returns the result instead of outputting it.
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// Disable SSL verifier.
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	// Get the response and close the channel.
	$response = curl_exec($ch);
	curl_close($ch);

	$obj = json_decode($response,true);

	foreach ($obj['results'] as $k){
		//$gbif_vnm[]= $k['vernacularName'].";".$k['language'];
		echo '<input type="hidden" name="vernacularName'.$row.'[]" value="'.$k['vernacularName'].'">'; 
		echo '<input type="hidden" name="language'.$row.'[]" value="'.$k['language'].'">';
	}

	/*for ($i=0; $i < count($gbif_vnm); $i++) {
		echo $gbif_vnm[$i]."<br>";
		$vn_val=split(";", $gbif_vnm[$i]);

		 
		//echo $gbif_vnm[$i]."<br>";
	}*/

	//Get species info with the id from gbif
	get_species_info($gbif_id);
	//return $gbif_vnm;
}

function get_species_info($gbif_id){
	global $row;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://api.gbif.org/v1/species/".$gbif_id."/speciesProfiles");

	// Set so curl_exec returns the result instead of outputting it.
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// Disable SSL verifier.
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	// Get the response and close the channel.
	$response = curl_exec($ch);
	curl_close($ch);
	$pruba=substr($response, strpos($response, 'results'));
	$pruba=substr($pruba, 0, strlen($pruba)-2);
	$pruba=str_replace('results":[{', "", $pruba);
	$pruba2=explode('},{', $pruba);
	for ($k=0; $k < count($pruba2); $k++) { 
		$pruba3=explode(",\"", $pruba2[$k]);
		//print_r($pruba3);

		for ($i=0; $i < count($pruba3); $i++) { 
			$pruba3[$i]=str_replace('"', '', $pruba3[$i]);
			if ($pruba3[$i]) {
				$pruba4= split(":", $pruba3[$i]);
				//echo 'name='.$pruba4[0].$row.' value="'.$pruba4[1].'"'."<br>"; 
				echo '<input type="hidden" name="'.$pruba4[0].$row.'[]" value="'.$pruba4[1].'">'; 
			}			
		}	
	}


/*

	for ($i=0; $i < count($pruba3); $i++) { 
		$pruba3[$i]=str_replace('"', '', $pruba3[$i]);
		if ($pruba3[$i]) {
			$pruba4= split(":", $pruba3[$i]);
			echo 'name='.$pruba4[0].$row.' value="'.$pruba4[1].'"'."<br>"; 
			//echo '<input type="hidden" name="'.$pruba4[0].$row.'[]" value="'.$pruba4[1].'">'; 
		}
		if (strpos($pruba3[$i], 'taxonKey')==false && strpos($pruba3[$i], 'source') == false && strpos($pruba3[$i], 'sourceTaxonKey')==false) {
			$pruba4= split(":", $pruba3[$i]);
			echo '<input type="hidden" name="'.$pruba4[0].$row.'[]" value="'.$pruba4[1].'">'; 
		}

		
	}*/
	//print_r($pruba2);


	//$obj = json_decode($response,true);
	

/*
	foreach ($obj['results'] as $k){
		if ($k['marine']) {
			echo "true";
		}else{
			echo "false";
		}
		
		//$gbif_vnm[]= $k['vernacularName'].";".$k['asd'];
	}

	for ($i=0; $i < count($gbif_vnm); $i++) {
		$vn_val=split(";", $gbif_vnm[$i]);

		echo '<input type="hidden" name="vernacularName'.$row.'[]" value="'.$vn_val[0].'">'; 
		echo '<input type="hidden" name="language'.$row.'[]" value="'.$vn_val[1].'">'; 
		//echo $gbif_vnm[$i]."<br>";
	}*/
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