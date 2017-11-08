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
<br>{{--dd($taxonomic)--}}


<div class="row">
	<div class="col s12 m3 l3">

		<div class="row">
	    	<div class="col s12 m12 l12">
				<!-- Switch -->
				<div class="switch">
					<label>
						Normal
						<input type="checkbox" id="mySwitch" >
						<span class="lever"></span>
						Advanced
					</label>
				</div>
			</div>	    	
	    </div>
	    <!-- Buscador -->
	    {!! Form::open(['route' => 'taxonomic.index', 'method' => 'GET']) !!}
		    
		    <div class="row">
		    	<!--Form Busqueda Normal-->
		    	<section id="norm">
			    	<div class="col s12 ">
				        <div class="row" id="searching">
				          <div class="input-field col s12"><!--
				          	{!! 
				          		Form::text('name', null, ['class' => 'form-control', 'id' => 'input_text']),
				          		Form::label('input_text','Buscar..') 
				          	!!}-->
				          	<input id="input_text" type="text" class="form-control" name="name" value="{{$request->name}}" >
		            		<label for="input_text" >Buscar..</label>
				          </div>
				      	</div>
			    	</div><br>
			    	<div class="col s12 " id="search">
			    		{!! 
			    			Form::button('Search', ['class' => 'btn waves-effect waves-light', 'type' => 'submit' ])
			    		!!}
			    	</div>
			    </section>
		    	<!--Fin Form Busqueda Normal-->
		{!! Form::close() !!}
		{!! Form::open(['route' => 'taxonomic.create', 'method' => 'GET']) !!}
		    	<!-- Form Busqueda Avanzada -->
		    	<section id="adv" hidden>
		    		<div class="col s12">
				        <div class="row" id="scientificname">
				          <div class="input-field col s12"><!--
				          	{!! 
				          		Form::text('name', null, ['class' => 'form-control', 'id' => 'input_text']),
				          		Form::label('input_text','Scientific Name..') 
				          	!!}-->
				          	<input id="input_text" type="text" class="form-control" name="sname" value="{{$request->sname}}" >
		            		<label for="input_text" >Scientific Name..</label>
				          </div>
				      	</div>
			    	</div>

			    	<div class="col s12">
				        <div class="row" id="especie">
				          <div class="input-field col s12"><!--
				          	{!! 
				          		Form::text('specie', null, ['class' => 'form-control', 'id' => 'input_text']),
				          		Form::label('input_text','Specie..') 
				          	!!}-->
				          	<input id="input_text" type="text" class="form-control" name="specie" value="{{$request->specie}}" >
		            		<label for="input_text" >Specie..</label>
				          </div>
				      	</div>
			    	</div>

			    	<div class="col s12">
				        <div class="row" id="familia">
				          <div class="input-field col s12"><!--
				          	{!! 
				          		Form::text('family', null, ['class' => 'form-control', 'id' => 'input_text']),
				          		Form::label('input_text','Family..') 
				          	!!}-->
				          	<input id="input_text" type="text" class="form-control" name="family" value="{{$request->family}}" >
		            		<label for="input_text" >Family..</label>
				          </div>
				      	</div>
			    	</div>

			    	<div class="col s12">
				        <div class="row" id="genero">
				          <div class="input-field col s12"><!--
				          	{!! 
				          		Form::text('genus', null, ['class' => 'form-control', 'id' => 'input_text']),
				          		Form::label('input_text','Genus..') 
				          	!!}-->
				          	<input id="input_text" type="text" class="form-control" name="genus" value="{{$request->genus}}" >
		            		<label for="input_text" >Genus..</label>
				          </div>
				      	</div>
			    	</div>

			    	<div class="col s12">
				        <div class="row" id="superReino">
				          <div class="input-field col s12"><!--
				          	{!! 
				          		Form::text('superkingdom', null, ['class' => 'form-control', 'id' => 'input_text']),
				          		Form::label('input_text','Super Kingdom..') 
				          	!!}-->
				          	<input id="input_text" type="text" class="form-control" name="superkingdom" value="{{$request->superkingdom}}" >
		            		<label for="input_text" >SuperKingdom..</label>
				          </div>
				      	</div>
			    	</div>

			    	<div class="col s12">
				        <div class="row" id="reino">
				          <div class="input-field col s12"><!--
				          	{!! 
				          		Form::text('kingdom', null, ['class' => 'form-control', 'id' => 'input_text']),
				          		Form::label('input_text','Kingdom..') 
				          	!!}-->
				          	<input id="input_text" type="text" class="form-control" name="kingdom" value="{{$request->kingdom}}" >
		            		<label for="input_text" >Kingdom..</label>
				          </div>
				      	</div>
			    	</div>
			    	<div class="col s12" id="searchadv">
				    	{!! 
			    			Form::button('Search', ['class' => 'btn waves-effect waves-light', 'type' => 'submit', 'name' => 'submit'])
			    		!!}
		    		</div>
			    </section>
		    	<!-- Fin Form Busqueda Avanzada -->
			</div>    
			<!-- FinFormBuscador -->
		{!! Form::close() !!}
	</div>

	<div class="col s12 m9 l9">
		<!--Inicio Table-->
		<div class="row" id="table_content">
			<div class="col s12" style="overflow:auto;">
	            <table class="datatable table table-striped centered" cellspacing="0" width="100%">
	                <thead>
	                    <tr>
	                        <!--th>ID</th-->
	                        <th>More Info</th>
							<th>Scientific Name</th>
							<th>Specie</th>
							<th>Family</th>
							<th>Genus</th>
							<th>Super kingdom</th>
							<th>Kingdom</th>
							<th>Phylum</th>
							<th>Subphylum</th>
							<th>Order</th>							
							<th>Tribe</th>
							
	                    </tr>
	                </thead>
	                <tbody>
	                	@foreach($taxonomic as $taxonomica)
	                		<tr>
	                			<!--td>{{$taxonomica->id}}</td-->
	                			<td><button type="button" class="btn-floating btn-sm waves-effect" onclick="alert('{{$taxonomica}}')"><i class="material-icons md-18">info_outline</i></button></td>
	                			<td>{{$taxonomica->scientific_name}}</td>
	                			<td>{{$taxonomica->specie}}</td>
	                			<td>{{$taxonomica->family}}</td>
	                			<td>{{$taxonomica->genus}}</td>
	                			<td>{{$taxonomica->superkingdom}}</td>
	                			<td>{{$taxonomica->kingdom}}</td>
	                			<td>{{$taxonomica->phylum}}</td>
	                			<td>{{$taxonomica->subphylum}}</td>
	                			<td>{{$taxonomica->order}}</td>	                			
	                			<td>{{$taxonomica->tribe}}</td>
	                			<td></td>
	                		</tr>
	                	@endforeach
	                </tbody>
	            </table>
	            {!!$taxonomic->appends(Request::all())->render()!!}
			</div>
			<div class="col s6 offset-s6">
				<a href="#" class="btn-success waves-effect waves-light btn-flat" id="btn-success-norm"><i class="material-icons left">cloud_download</i>Descargar Tabla</a>
			</div>
		</div>
		<!--End table-->

		<!--Inicio Table adv-->
		<div class="row" id="table_content_adv" hidden>
			<div class="col s12" style="overflow:auto;">
	            <table class="datatable table table-striped centered" cellspacing="0" width="100%">
	                <thead>
	                    <tr>
	                        <!--th>ID</th-->
	                        <th>More Info</th>
							<th>Scientific Name</th>
							<th>Specie</th>
							<th>Family</th>
							<th>Genus</th>
							<th>Super kingdom</th>
							<th>Kingdom</th>
							<th>Phylum</th>
							<th>Subphylum</th>
							<th>Order</th>							
							<th>Tribe</th>
	                    </tr>
	                </thead>
	                <tbody>
	                	@foreach($taxonomicadv as $taxonomica)
	                		<tr>
	                			<!--td>{{$taxonomica->id}}</td-->
	                			<td><button type="button" class="btn-floating btn-sm waves-effect" onclick="alert('{{$taxonomica}}')"><i class="material-icons md-18">info_outline</i></button></td>
	                			<td>{{$taxonomica->scientific_name}}</td>
	                			<td>{{$taxonomica->specie}}</td>
	                			<td>{{$taxonomica->family}}</td>
	                			<td>{{$taxonomica->genus}}</td>
	                			<td>{{$taxonomica->superkingdom}}</td>
	                			<td>{{$taxonomica->kingdom}}</td>
	                			<td>{{$taxonomica->phylum}}</td>
	                			<td>{{$taxonomica->subphylum}}</td>
	                			<td>{{$taxonomica->order}}</td>
	                			<td>{{$taxonomica->tribe}}</td>
	                		</tr>
	                	@endforeach
	                </tbody>
	            </table>
	            {!!$taxonomicadv->appends(Request::all())->render()!!}
			</div>
			<div class="col s6 offset-s6">
				<a href="#" class="btn-success waves-effect waves-light btn-flat" id="btn-success-adv"><i class="material-icons left">cloud_download</i>Descargar Tabla</a>
			</div>
		</div>
		<!--End table adv-->
	</div>
</div>

<section>
	<div class="row" id="VistaAdv">
		<div id="sidebar" class="col s4">

		</div>
		<div class="col s8">
		</div>
	</div>
</section>


	<script></script>
    <script>
    	
		$('#mySwitch').click(function(){
			if ($(this).is(":checked")){
  				$('#adv').show();
  				$('#norm').hide();
  				//$('#table_content_adv').show();
  				//$('#table_content').hide();
			}else{
 				$('#adv').hide();
 				$('#norm').show();
  				//$('#table_content_adv').hide();
  				//$('#table_content').show();
			}
		});


		$(document).ready(function (){
			function downloadCSVfile($table, filename){

				var csv = 'Scientific Name,Super kingdom,Kingdom,Phylum,Subphylum,Order,Family,Genus,Tribe,Specie\n';


				@foreach($taxotable as $taxonomica)
					csv+= '{{$taxonomica->scientific_name}},{{$taxonomica->superkingdom}},{{$taxonomica->kingdom}},{{$taxonomica->phylum}},{{$taxonomica->subphylum}},{{$taxonomica->order}},{{$taxonomica->family}},{{$taxonomica->tribe}},{{$taxonomica->genus}},{{$taxonomica->specie}}\n';
				@endforeach 

				 /**

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