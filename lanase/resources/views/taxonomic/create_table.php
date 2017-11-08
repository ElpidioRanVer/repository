<?php
$fields = isset($_POST['arr_fields']) ? json_decode($_POST['arr_fields']) : false;
$arr_data = isset($_POST['arr_content']) ? json_decode($_POST['arr_content']) : false;
$token = isset($_POST['token_val']) ? ($_POST['token_val']) : false;


if ($fields && $arr_data) {
	$content="";
	$content.= '<div class="sombra"></div><div id="test" name="test"><form action="test" method="post" enctype="multipart/form-data"><input type="hidden" name="_token" value="'.$token.'">';
	#$content.='<input type="submit" value="Upload Information" name="submit">';
	$content.= '<br><button class="btn waves-effect waves-light" type="submit" value="Upload Information" name="submit">Upload Information<i class="material-icons right">send</i></button>';
	$content.= '<table class="responstable" id="table_content"><tr><th id=number>No.</th>';
    foreach ($fields as $f) {
    	$content.='<th id="'.$f.'">'.$f.'</th>';
    }
    $content.= '<th id=images>Images</th><th id="seq_files">Files</th><th id=detailed_info>More info</th></tr>';
    $i=0;
    $contar=count($arr_data);

	while ($i < $contar) { 
		$arr_data[$i] = str_replace("undefined", "", $arr_data[$i]);
		$content_2 = explode(",", $arr_data[$i]);
		$contar2 = (count($content_2)-1);
		$content.= '<tr id="tr'.$i.'"><td>'.($i+1).'</td>';
		$col_name;
		
		$j=0;
		while ($j < $contar2) { 
			if ($j == 0) {
				$col_name="genus[]";
			}elseif ($j==1) {
				$col_name="specie[]";
			}elseif ($j==2) {
				$col_name="subspecie[]";
			}elseif ($j==3) {
				$col_name="latitude[]";
			}elseif ($j==4) {
				$col_name="longitude[]";
			}else{
				$col_name="no_name";
			}
			$content.='<td contenteditable="true" id="'.$i.$j.'">'.$content_2[$j].'<input type="hidden" name="'.$col_name.'" value="'.$content_2[$j].'"></td>';
			$j++;
		}
		$content.= '<td> <button type="button" class="btn btn-default btn-sm" id="files'.$i.'" onclick="select_images("'.$i.'")"><i class="material-icons md-18">crop_original</i></button></td><td><button type="button" class="btn btn-default btn-sm" onclick="$("#seqFiles'.$i.'").trigger("click");"><i class="material-icons md-18">receipt</i></button><input type="file" id="seqFiles'.$i.'" name="seqFiles'.$i.'[]" style="display:none;" mulltiple></td>';
		$content.='<div id="hiden'.$i.'" class="simages"><button  type="button" class="btn btn-danger btn-sm" onclick="select_images('.$i.')" >Cerrar</i></button><br><br><input type="file" id="myFiles'.$i.'" name="myFiles'.$i.'[]" multiple/> <input id="fileDir'.$i.'" type="file" name = "fileDir'.$i.'[]" webkitdirectory mozdirectory /><div class="box" id="imagenes'.$i.'"></div> <script>$("#fileDir'.$i.'").change(function(){prevImages(this,"'.$i.'", "imagenes'.$i.'");});$("#myFiles'.$i.'").change(function(){prevImages(this,"'.$i.'", "imagenes'.$i.'");});</script></div>';
		$content.='<td><button type="button" class="btn btn-default btn-sm" onclick="more_info(\''.$i.'\')"><i class="material-icons md-18">info_outline</i></button><!--input type="button" class="btn btn-default btn-sm" onclick="more_info(\''.$i.'\')" value="More"--></td></tr>';
		$i++;	
	}
	$content.='</table><div id="no_rows"><input name = "rows" value ="'.$i.'"/></div></form></div><script>$(document).ready(function(){$("#table_content").paginationTdA({elemPerPage: 100});});</script>';
    echo $content.'';
}

#####6###############################################################################
/*
?>
#este es el de antaño
<?php
$fields = isset($_POST['arr_fields']) ? json_decode($_POST['arr_fields']) : false;
$arr_data = isset($_POST['arr_content']) ? json_decode($_POST['arr_content']) : false;
$token = isset($_POST['token_val']) ? ($_POST['token_val']) : false;


if ($fields && $arr_data) {
	//echo "<br><br><h2>Table</h2><br>";
	$content="";
	$content.= '<div class="sombra"></div>';
	$content.='<div id="test" name="test"><form action="test" method="post" enctype="multipart/form-data"><input type="hidden" name="_token" value="'.$token.'"><input type="submit" value="Upload Information" name="submit">';
    $content.= '<table class="responstable" id="table_content">';
    $content.='<tr><th id=number>No.</th>';
    foreach ($fields as $f) {
    #for ($i=0; $i<count($fields); $i++) {
    	$content.='<th id="'.$f.'">'.$f.'</th>';
    }
    $content.= '<th id=images>Images</th>';
    $content.= '<th id=seq_files>Files</th>';
    $content.= '<th id=detailed_info>More info</th>';
    echo $content.= '</tr>';
    //$content.= '<tbody id="myTable">';
    $i=0;
    $contar=count($arr_data);

	while ($i < $contar) { 
		$arr_data[$i]=str_replace("undefined", "", $arr_data[$i]);
		$content_2=explode(",", $arr_data[$i]);

		/*$name=$content_2[0]."+".$content_2[1];
		if($content_2[2]!="" && $content_2[2]!=null){
			$name.="+".$content_2[2];
		}* #aqui va una /

		$content= '<tr id="tr'.$i.'">';
		#$aux=$i+1;
		$content.='<td>'.($i+1).'</td>';
		$col_name;
		
		$j=0;
		while ($j < count($content_2)-1) { 
			if ($j==0) {
				$col_name="genus[]";
			}elseif ($j==1) {
				$col_name="specie[]";
			}elseif ($j==2) {
				$col_name="subspecie[]";
			}elseif ($j==3) {
				$col_name="latitude[]";
			}elseif ($j==4) {
				$col_name="longitude[]";
			}else{
				$col_name="no_name";
			}
			$content.='<td contenteditable="true" id="'.$i.$j.'">'.$content_2[$j].'<input type="hidden" name="'.$col_name.'" value="'.$content_2[$j].'"></td>';
			++$j;
		}
		$content.= '<td> <button type="button" class="btn btn-default btn-sm" id="files'.$i.'" onclick="select_images('.$i.')"><i class="material-icons md-18">crop_original</i></button></td>';
		$content.= '<td><button type="button" class="btn btn-default btn-sm" onclick="$(\'#seqFiles'.$i.'\').trigger(\'click\');"><i class="material-icons md-18">receipt</i></button><input type="file" id="seqFiles'.$i.'" name="seqFiles'.$i.'[]" style="display:none;" mulltiple></td>';
		$content.= '<div id= "hiden'.$i.'" class="simages"><button  type="button" class="btn btn-danger btn-sm" onclick="select_images('.$i.')" >Cerrar</i></button><br><br><input type="file" id="myFiles'.$i.'" name="myFiles'.$i.'[]" multiple/> <input id="fileDir'.$i.'" type="file" name = "fileDir'.$i.'[]" webkitdirectory mozdirectory /><div class="box" id="imagenes'.$i.'"></div> <script>$("#fileDir'.$i.'").change(function(){prevImages(this,"'.$i.'", "imagenes'.$i.'");});$("#myFiles'.$i.'").change(function(){prevImages(this,"'.$i.'", "imagenes'.$i.'");});</script></div>';
		echo $content.= '<td><button type="button" class="btn btn-default btn-sm" onclick="more_info(\''.$i.'\')"><i class="material-icons md-18">info_outline</i></button><!--input type="button" class="btn btn-default btn-sm" onclick="more_info(\''.$i.'\')" value="More"--></td></tr>';
		++$i;	
	}
	//$content.='</tbody>';//<tfoot></tfoot>';//line for paginated
	$content='</table><div id="no_rows"><input name = "rows" value ="'.$i.'"/></div></form></div>';
	$content.='<script>$(document).ready(function(){$("#table_content").paginationTdA({elemPerPage: 100});});</script>';
    echo $content.'';
}
*/
########################################################################################
?>