<?php
$name = isset($_POST['sc_name']) ? $_POST['sc_name'] : false;
$coords = isset($_POST['coordinates']) ? $_POST['coordinates'] : false;



//echo "<p>sd</p>";
if ($name!="" && $name!=null) {
	//echo count($arr_data);



	echo "<h1><b>$name</b></h1>";
	get_tax_info($name,$coords);


//show_table($fields,$arr_data);
}

/*function show_table($titles,$row_data){

	echo "<br><br><h2>Table</h2><br>";

	$content="";
	$content.='<div id="test" name="test"><table class="responstable" id="table_content">';

    //$row_data[$i]=str_replace("undefined", "", $row_data[$i]);
    $content.= '<tr>';
    for ($i=0; $i<count($titles); $i++) {
    	$content.='<th id="'.$titles[$i].'">'.$titles[$i].'</th>';
    	//echo "$titles[$i]<br>";
    }

    $content.= '</tr>';

    for ($i=0; $i < count($row_data); $i++) {
    	$content.= '<tr>';
		$row_data[$i]=str_replace("undefined", "", $row_data[$i]);
		$field=split(",", $row_data[$i]);
		for ($j=0; $j < count($field)-1; $j++) { 
			$content.='<td  contenteditable="true" id="'.$i.'">'.$field[$j].'</td>';
		}
		 $content.= '</tr>';
	}
	$content.='</table></div>';
	echo $content;

}*/



function get_tax_info($name,$coords){
	if ($name) {
		$name=str_replace(" ", "+", $name);

		echo $name."<br>";
		$TaxID_xml=call_curl_command("https://eutils.ncbi.nlm.nih.gov/entrez/eutils/esearch.fcgi?db=taxonomy&term=".$name."&retmode=xml");
		if($TaxID_xml->IdList[0]->Id){
			$TaxID=$TaxID_xml->IdList[0]->Id[0];
			echo "<b>".$TaxID."</b><br><br>";
			echo "<input type=\"hidden\" name=\"_token\" value=\"".$TaxID."\"";

			$tax_xml= get_xml_tax($TaxID);
			getTaxonomy($tax_xml);		//670 ms
			get_synonyms($tax_xml);	//650 - 700 ms

			if ($coords!=""&&$coords!=null) {		//550ms
				get_distribution($coords);
			}

			get_NCBI_records($name); //950 ms
			get_vernacular_names($name); //1s
			get_external_links($TaxID); //700ms
		}else{
			echo "Registro no encontrado, verifique el nombre";
		}
	}
}


function get_synonyms($xml_data){
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

	echo "<br><br><b>Synonyms</b><br>";
	for ($i=0; $i < count($synonyms_list); $i++) { 
		echo $synonyms_list[$i]."<br>";

	}
	return $synonyms_list;
}

function getTaxonomy($Taxonomy_xml){
	//Array with taxonomic lineage.
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
	echo "<br><br><b>Taxonomy</b><br>";
	for ($i=0; $i < count($Tax_values); $i++) {
		//$tax_val=split(":", $Tax_values[$i]); 
		echo $Tax_values[$i]."<br>";
		
		
	}


	return $Tax_values;
}

function get_xml_tax($TaxID){
	if($TaxID!=""&&$TaxID!=null){
		$Taxonomy_xml=call_curl_command("https://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi?db=taxonomy&id=".$TaxID."&retmode=xml");
		return $Taxonomy_xml;
	}

}

function get_NCBI_records($name){
	echo "<br><br><b>NCBI Records</b><br>";
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
		echo $ncbi[$i]."<br>";
	}
	return $ncbi;
}


function get_distribution($coords){
	echo "<br><br>";
	$dist_info=array();

	if($coords){
		$coord_xml=call_curl_command("http://maps.googleapis.com/maps/api/geocode/xml?latlng=".$coords);

		if ($coord_xml->status=="OK") {
			for($j=0;$j<count($coord_xml->result[0]->address_component);$j++){
	        	$dist_info[]= $coord_xml->result[0]->address_component[$j]->type[0].';'.$coord_xml->result[0]->address_component[$j]->long_name;
	    	}
	    	 for ($i=0; $i < count($dist_info); $i++) { 
		    	echo "$dist_info[$i].<br>";
		    }
		}

		
	}
	//return $dist_info;
}

function get_external_links($taxid){
	echo "<br><br><b>External Links</b><br>";
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
		echo $links[$i]."<br>";
	}
	return $links;
}

function get_vernacular_names($name){
	echo "<br><br><b>Vernaculra Names</b><br>";
	$gbif_vnm=array();
	$ch = curl_init();
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
	//echo "<br><br>".$response."<br><br>";

	$obj = json_decode($response,true);

	foreach ($obj['results'] as $k){
		$gbif_vnm[]= $k['vernacularName'].";".$k['language'];
	}

	for ($i=0; $i < count($gbif_vnm); $i++) { 
		echo $gbif_vnm[$i]."<br>";
	}
	return $gbif_vnm;
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
