@extends('main')
@section('title','Search')

@section('nav')

  	<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
  	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
  	<!--script src="{{ asset('js/materialize.min.js') }}"></script-->


  	<link rel="stylesheet" type="text/css" href="./css/style.css">
  	<link rel="stylesheet" type="text/css" href="css/resptable.css">
  	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  	<meta name="csrf-token" id="pruba" content="{{ csrf_token() }}" />

@include('admin.nav')
@endsection

@section('content')
<br>{{--dd($sinonimo)--}}
<div class="row">
	<div class="col s12 m3 l3">

		<div class="row">
	    	<div class="col s12 m12 l12">
				<!-- Switch -->
				<div class="switch">
					<label>
						Normal
						<input type="checkbox" id="mySwitch" checked>
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
		    	<section id="norm" hidden>
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
		    	<section id="adv">
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
	            <table class="datatable bordered striped centered" cellspacing="0" width="100%">
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
	                			<td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal{{$taxonomica->id}}"><i class="material-icons md-18">info_outline</i></button></td>
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
	            {!!$taxonomicadv->appends(Request::all())->render()!!}
			</div>
			<div class="col s6 offset-s6">
				<a href="#" class="btn-success btn-flat" id="btn-success-norm"><i class="material-icons left">cloud_download</i>Descargar Tabla</a>
			</div>
		</div>
		<!--End table-->
		<!--button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button-->
	</div>





<!--#############################################################################################-->
<!-- Modal -->
@foreach($taxonomicadv as $taxonomica)
	<div class="modal fade" id="myModal{{$taxonomica->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <!--button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button-->
	        <h4 class="modal-title">{{$taxonomica->scientific_name}}</h4>
	      </div>
	      <div class="modal-body">

	      	<div class="row">
	      		<div class="col s6 m6 l6">
	      			</p><ins><b>Taxonomic Classification:</b></ins><br>
			        	<i>
			        		@if($taxonomica->kingdom)
				        		<b><em>Kingdom: </em></b>{{$taxonomica->kingdom}}<br>
				        	@endif

				        	@if($taxonomica->phylum)
				        		<b><em>Phylum: </em></b>{{$taxonomica->phylum}}<br>
				        	@endif

				        	@if($taxonomica->class)
				        		<b><em>Class: </em></b>{{$taxonomica->class}}<br>
				        	@endif

				        	@if($taxonomica->order)
				        		<b><em>Order: </em></b>{{$taxonomica->order}}<br>
				        	@endif

				        	@if($taxonomica->family)
				        		<b><em>Family: </em></b>{{$taxonomica->family}}<br>
				        	@endif

				        	@if($taxonomica->subfamily)
				        		<b><em>Subfamily: </em></b>{{$taxonomica->subfamily}}<br>
				        	@endif

				        	@if($taxonomica->tribe)
				        		@if($taxonomica->tribe != 'noneTribe')
				        			<b><em>Tribe: </em></b>{{$taxonomica->tribe}}<br>
				        		@endif
				        	@endif

				        	@if($taxonomica->genus)
				        		@if($taxonomica->genus != 'noneGenus')
				        			<b><em>Genus: </em></b>{{$taxonomica->genus}}<br>
				        		@endif
				        	@endif

				        	@if($taxonomica->specie)
				        		<b><em>Specie: </em></b>{{$taxonomica->specie}}<br>
				        	@endif

				        	@if($taxonomica->scientific_name)
				        		<b><em>Scientific Name: </em></b>{{$taxonomica->scientific_name}}
				        	@endif
			        	</i>
			        </p>
	      		</div>
	      		<div class="col s6 m6 l6">
	      			{{--
	      			@if($taxonomica->id == $sinonimo->taxonomy_id)
	      				<b><ins>Synonym: </ins></b><br>{{$sinonimo->synonym}}<br>
	      				<!--b><ins>Synonym tID: </ins></b><br-->$sinonimo->taxonomy_id<br>
	      				<!--b><ins>Synonym ID: </ins></b><br-->$sinonimo->id-
	      			@endif

	      			@if($taxonomica->id == $vernacular->taxonomy_id)
	      				<b><ins>Vernacular name: </ins></b><br>{{$vernacular->name}}<br>
	      			@endif

	      			@if($taxonomica->id == $ncbi->taxonomy_id)
	      				<b><ins>Vernacular name: </ins></b><br>{{$ncbi}}<br>
	      			@endif
	      			@if($taxonomica->id == $external->taxonomy_id)
	      				<b><ins>Vernacular name: </ins></b><br>{{$external}}<br>
	      			@endif

	      			--}}
	      		</div>
	      	</div>
	        
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
@endforeach
<!--#############################################################################################-->




</div>

<script>

  $(document).ready(function(){
		// the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
	    $('#myModal').modal('hide');  
	});

</script>

    <script>
    	
		$('#mySwitch').click(function(){
			if ($(this).is(":checked")){
  				$('#adv').show();
  				$('#norm').hide();
			}else{
 				$('#adv').hide();
 				$('#norm').show();
			}
		});

		$(document).ready(function (){
			function downloadCSVfile($table, filename){

				var csv = 'Scientific Name,Super kingdom,Kingdom,Phylum,Subphylum,Order,Family,Genus,Tribe,Specie\n';


				@foreach($taxotableadv as $taxonomica)
					csv+= '{{$taxonomica->scientific_name}},{{$taxonomica->superkingdom}},{{$taxonomica->kingdom}},{{$taxonomica->phylum}},{{$taxonomica->subphylum}},{{$taxonomica->order}},{{$taxonomica->family}},{{$taxonomica->tribe}},{{$taxonomica->genus}},{{$taxonomica->specie}}\n';
				@endforeach 

	            var csvData = 'data:application/csv;charset=utf-8,'+ encodeURIComponent(csv);

		        $(this).attr({
		            'download': filename,
		            'href': csvData,
		            'taget': '_blank'
		        });
	        }

	        $(".btn-success").on('click', function (event){
	            downloadCSVfile.apply(this, [$('#table_content_adv'), 'datatable.csv']);
	        });      
    	});    	
    </script>

@endsection