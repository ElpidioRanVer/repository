@extends('main')
@section('title','Search')

@section('nav')

	<!--script src="{{ asset('js/bootstrap.min.js') }}"></script-->
  	<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>

  	<link rel="stylesheet" type="text/css" href="./css/style.css">
  	<link rel="stylesheet" type="text/css" href="css/resptable.css">
  	<meta name="csrf-token" id="pruba" content="{{ csrf_token() }}" />

@include('admin.nav')
@endsection

@section('content')
<br>
<div class="row">
	<div class="col s12 m3 l12">

		<div class="row">
	    	<div class="col s3">
				<!-- Switch -->
				<div class="switch">
					<label>
						Normal
						<input type="checkbox" id="mySwitch">
						<span class="lever"></span>
						Advanced
					</label>
				</div>
			</div>	    	
	    </div>
	    	
	    <!-- Buscador -->
	    {!! Form::open(['route' => 'taxonomic.index', 'method' => 'GET']) !!}
		    <div class="row">
		    	<section id="norm">
			    	<div class="col s12 l9">
				        <div class="row" id="searching">
				          <div class="input-field col s12">
				          	{!! 
				          		Form::text('name', null, ['class' => 'form-control', 'id' => 'input_text']),
				          		Form::label('input_text','Buscar..') 
				          	!!}
				          </div>
				      	</div>
			    	</div><br>
			    	<div class="col s12 l3" id="search">
			    		{!! 
			    			Form::button('Search', ['class' => 'btn waves-effect waves-light', 'type' => 'submit', 'name' => 'submit'])
			    		!!}
			    	</div>
			    </section>

		    	<!--Busqueda Avanzada-->
		    	<section id="adv" hidden>
			    	<div class="col s12 m12 l3">
				        <div class="row" id="especie">
				          <div class="input-field col s12">
				            <input id="input_text" type="text" value="" >
				            <label for="input_text" >Especie..</label>
				          </div>
				      	</div>
			    	</div>

			    	<div class="col s12 m12 l3">
				        <div class="row" id="familia">
				          <div class="input-field col s12">
				            <input id="input_text" type="text" value="" >
				            <label for="input_text" >Familia..</label>
				          </div>
				      	</div>
			    	</div>

			    	<div class="col s12 m12 l3">
				        <div class="row" id="genero">
				          <div class="input-field col s12">
				            <input id="input_text" type="text" value="" >
				            <label for="input_text" >Genero..</label>
				          </div>
				      	</div>
			    	</div>

			    	<div class="col s12 m12 l3">
				        <div class="row" id="nomdeposito">
				          <div class="input-field col s12">
				            <input id="input_text" type="text" value="" >
				            <label for="input_text" >Nombre Deposito..</label>
				          </div>
				      	</div>
			    	</div>

			    	<div class="col s12 m12 l3">
				        <div class="row" id="scientname">
				          <div class="input-field col s12">
				            <input id="input_text" type="text" value="" >
				            <label for="input_text" >Nombre Cientifico..</label>
				          </div>
				      	</div>
			    	</div>

			    	<div class="col s12 m12 l3">
				        <div class="row" id="canonicname">
				          <div class="input-field col s12">
				            <input id="input_text" type="text" value="24:00" >
				            <label for="input_text" >Nombre Canonico..</label>
				          </div>
				      	</div>
			    	</div>
			    	<div class="col s12 m12 l3" id="searchadv">
				    	{!! 
			    			Form::button('Search', ['class' => 'btn waves-effect waves-light', 'type' => 'submit', 'name' => 'submit'])
			    		!!}
		    		</div>
			    </section>
		    	<!--Fin Busqueda Avanzada-->
			</div>    
			<!-- FinBuscador -->
		{!! Form::close() !!}
	</div>

	<div class="col s12 m9 l12">
		<!--Inicio Table-->
		<div class="row" id="table_content">
			<div class="col s12" style="overflow:auto;">
	            <table class="datatable table table-striped" cellspacing="0" width="100%">
	                <thead>
	                    <tr>
	                        <!--th>ID</th-->
							<th>Scientific Name</th>
							<th>Superkingdom</th>
							<th>Kingdom</th>
							<th>Phylum</th>
							<th>Subphylum</th>
							<th>Order</th>
							<th>Family</th>
							<th>Genus</th>
							<th>Tribe</th>
							<th>Specie</th>
	                    </tr>
	                </thead>
	                <tbody>
	                	@foreach($taxonomic as $taxonomica)
	                		<tr>
	                			<!--td>{{$taxonomica->id}}</td-->
	                			<td>{{$taxonomica->scientific_name}}</td>
	                			<td>{{$taxonomica->superkingdom}}</td>
	                			<td>{{$taxonomica->kingdom}}</td>
	                			<td>{{$taxonomica->phylum}}</td>
	                			<td>{{$taxonomica->subphylum}}</td>
	                			<td>{{$taxonomica->order}}</td>
	                			<td>{{$taxonomica->family}}</td>
	                			<td>{{$taxonomica->tribe}}</td>
	                			<td>{{$taxonomica->genus}}</td>
	                			<td>{{$taxonomica->specie}}</td>
	                		</tr>
	                	@endforeach
	                </tbody>
	            </table>
	            {!!$taxonomic->render()!!}
			</div>
			<div class="col s5 offset-s7 ">
				<a href="#" class="btn-success waves-effect waves-light btn-flat"><i class="material-icons left">cloud_download</i>Descargar Tabla</a>
			</div>
		</div>
		<!--End table-->
	</div>
</div>

    <script>
		$('#mySwitch').click(function(){
			if ($(this).is(":checked")){
  				$('#adv').show();
  				$('#norm').hide();
  				//$('#searchadv').show();
  				//$('#search').hide();
			}else{
 				$('#adv').hide();
 				$('#norm').show();
  				//$('#searchadv').hide();
  				//$('#search').show();
			}
		});

		/*$('#buscar').click(function(){
			//alert("submit");
			$('#table_content').show();
		});*/


		$(document).ready(function (){
			function downloadCSVfile($table, filename){

				var csv = 'Scientific Name,Superkingdom,Kingdom,						Phylum,Subphylum,Order,Family,Genus,Tribe,Specie\n';
				@foreach($taxotable as $taxonomica)
					csv+= '{{$taxonomica->scientific_name}},{{$taxonomica->superkingdom}},{{$taxonomica->kingdom}},{{$taxonomica->phylum}},{{$taxonomica->subphylum}},{{$taxonomica->order}},{{$taxonomica->family}},{{$taxonomica->tribe}},{{$taxonomica->genus}},{{$taxonomica->specie}}\n';
				@endforeach

				/*

				var $rows = $table.find('tr'),
				tmpColDel = String.fromCharCode(11),
            	tmpRowDel = String.fromCharCode(0),
	            colDel = ',',
	            rowDel = '\r\n',

	            csv = $rows.map(function(i, row){
	            	var $row = $(row),
	                	$colshead = $row.find('th');
	                return $colshead.map(function(j,colhead){
	                	var $colhead = $(colhead),
	                		text = $colhead.text();
	                    return text.replace(/"/g, '""');
	                }).get().join(tmpColDel);
	            }).get().join(tmpRowDel)
	            	.split(tmpColDel).join(colDel);

	            csv += $rows.map(function(k, row){
	                var $row = $(row),
	                	$cols = $row.find('td');
	                return $cols.map(function(l,col){
	                    var $col = $(col),
	                        text = $col.text();
	                    return text.replace(/"/g, '""');
	                }).get().join(tmpColDel);
	            }).get().join(tmpRowDel)
	                .split(tmpRowDel).join(rowDel)
	                .split(tmpColDel).join(colDel);*/

	            var csvData = 'data:application/csv;charset=utf-8,'+ encodeURIComponent(csv);

		        $(this).attr({
		            'download': filename,
		            'href': csvData,
		            'taget': '_blank'
		        });
	        }

	        $(".btn-success").on('click', function (event){
	            downloadCSVfile.apply(this, [$('#table_content'), 'datatable.csv']);
	        });        
    	});    	
    </script>

@endsection