@extends('panel.main')
@section('title','send info')
@section('nav')
<script src="{{ asset('js/select_file.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
@endsection
@section('content')

<?php
$rows = isset($_POST['rows']) ? $_POST['rows'] : false;
$genus = isset($_POST['genus']) ? ($_POST['genus']) : false;
$specie = isset($_POST['specie']) ? ($_POST['specie']) : false;
$subspecie = isset($_POST['subspecie']) ? ($_POST['subspecie']) : false;
$lat = isset($_POST['latitude']) ? ($_POST['latitude']) : false;
$long = isset($_POST['longitude']) ? ($_POST['longitude']) : false;
?>

{!! Form::open(['route' => 'taxonomic.store', 'method' => 'POST', 'files'=>true]) !!}
<div style="visibility: none"><output id="taxonomic_inf">
	<?php
		for ($i=0; $i <$rows ; $i++) { 
		 	echo '<div id="div_taxt'.$i.'"></div>';
		 } 
	?>
</output></div>

<?php

//echo "$rows";
for ($i=0; $i < $rows; $i++) {

	upload_seq_file($i);
	upload_img_files($i);

	//echo Form::hidden('genus[]',$genus[$i]);
	echo Form::hidden('specie[]',$specie[$i]);
	echo Form::hidden('subspecie[]',$subspecie[$i]);
	//echo Form::hidden('myFiles'.$i.'[]',$images);
	//echo Form::file('myFiles'.$i.'[]',$images);
	if ($subspecie[$i]!="") {
		if ($lat[$i]!="" && $long[$i]!="") {
			echo '<script>taxonomic_form("'.$i.'","'.$genus[$i].'","'.$specie[$i].'","'.$lat[$i].'","'.$long[$i].'","'.$subspecie[$i].'");</script>';
		}else{
			echo '<script>taxonomic_form("'.$i.'","'.$genus[$i].'","'.$specie[$i].'","'.$subspecie[$i].'");</script>';
		}
	}else{
		if ($lat[$i]!="" && $long[$i]!="") {
				echo '<script>taxonomic_form("'.$i.'","'.$genus[$i].'","'.$specie[$i].'","'.$lat[$i].'","'.$long[$i].'");</script>';
		}else{
			echo '<script>taxonomic_form("'.$i.'","'.$genus[$i].'","'.$specie[$i].'");</script>';
		}
		
	}
	

}
echo Form::hidden('rows',$rows);


function upload_seq_file($i){

	foreach ($_FILES["seqFiles".$i]["tmp_name"] as $key => $tmp_name) {
		if ($_FILES["seqFiles".$i]["name"][$key]) {
			$target_file = "../storage/app/public/sequences/".$i."/";
			if (!is_dir($target_file) && !mkdir($target_file)){
			  die("Error creating folder $target_file");
			}
			$seq_name=basename($_FILES["seqFiles".$i]["tmp_name"][$key]);
			$seq_name=str_replace(".tmp","", $seq_name)."_".basename($_FILES["seqFiles".$i]["name"][$key]);
			$target_file.=$seq_name;
				
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if $uploadOk is set to 0 by an error
				
			if (move_uploaded_file($_FILES["seqFiles".$i]["tmp_name"][$key], $target_file)) {
				echo Form::hidden('seqFiles'.$i.'[]',$seq_name);
			    //echo "The file ". basename( $_FILES["seqFiles".$i]["name"][$key]). " has been uploaded.";
			} else {
			    echo "Sorry, there was an error uploading your file.";
			}			
		}
	}
}

function upload_img_files($i){

	check_img_format($i,"myFiles");
	check_img_format($i,"fileDir");

}

function check_img_format($i,$input_name){
	foreach ($_FILES[$input_name.$i]["tmp_name"] as $key => $tmp_name) {
		if ($_FILES[$input_name.$i]["name"][$key]) {
			//$target_file = $img_dir . basename($_FILES[$input_name.$i]["name"][$key]);

			$target_file = "../storage/app/public/images/".$i."/";
			if (!is_dir($target_file) && !mkdir($target_file)){
			  die("Error creating folder $target_file");
			}

			$img_name=basename($_FILES[$input_name.$i]["tmp_name"][$key]);
			$img_name=str_replace(".tmp","", $img_name)."_".basename($_FILES[$input_name.$i]["name"][$key]);

			$target_file.=$img_name;

			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
			    $check = getimagesize($_FILES[$input_name.$i]["tmp_name"][$key]);
			    if($check !== false) {
			        //echo "File is an image - " . $check["mime"] . ".";
			        $uploadOk = 1;
			    } else {
			        //echo "File is not an image.";
			        $uploadOk = 0;
			    }
			}

			// Check file size
			if ($_FILES[$input_name.$i]["size"][$key] > 500000) {
			    //echo "Sorry, your file is too large.";
			    $uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    //echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
			    if (move_uploaded_file($_FILES[$input_name.$i]["tmp_name"][$key], $target_file)) {
			        echo Form::hidden($input_name.$i.'[]',$img_name);
			    } else {
			        //echo "Sorry, there was an error uploading your file.";
			    }
			}
		}
			
	}
}
?>
<div class="col s12 border-bottom">
	<h4><b>Save Taxonomic Classification </b></h4>
</div>
<br>
<br>



<!--div id="div_progress" class="progress">
      <div class="indeterminate"></div>
</div-->

<div class="preloader-wrapper big active col s8 ">
<div class="spinner-layer spinner-green-only">
  <div class="circle-clipper left">
    <div class="circle"></div>
  </div><div class="gap-patch">
    <div class="circle"></div>
  </div><div class="circle-clipper right">
    <div class="circle"></div>
  </div>
</div>
</div>
<br>

 {!! Form::submit('Save', ['class'=>'btn btn-primary hidden', 'id'=>'btn_save']) !!}

{!! Form::close() !!}

<script>
	$('.preloader-wrapper').hide({{$rows*820}});
/*
	$(document).ready(function(){
		
		window.onLoad("#btn_save"){
			$('.progress').hide(100);
		}
		/*if(!$("btn_save").is(":hidden")){
			$('.progress').hide(100);
		}
		if($("btn_save").is(":hidden")){
			$('.progress').show(100);
		}
	});*/
</script>

@endsection