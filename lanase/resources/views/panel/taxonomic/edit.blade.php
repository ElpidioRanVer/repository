@extends('panel.main')
@section('title','Distribution')

@section('nav')
@include('admin.nav')
@endsection

@section('content')

{!! Form::open(['route' => ['taxonomic.store', $taxonomics->id], 'method' => 'PUT']) !!}
<div class="row">
	<div class="col s3">
		{!! Form::label('scientific_name', 'scientific_name') !!}
		{!! Form::text('scientific_name', $taxonomics->scientific_name, ['class' => 'validate', 'required']) !!}
	</div>
	<div class="col s3">
		{!! Form::label('canonic_name', 'canonic_name') !!}
		{!! Form::text('canonic_name', null, ['class' => 'validate', 'required']) !!}
	</div>
	<div class="col s3">
		{!! Form::label('infra_generic', 'infra_generic') !!}
		{!! Form::text('infra_generic', null, ['class' => 'validate', 'required']) !!}
	</div>
	<div class="col s3">
		{!! Form::label('infra_epiteto_specific', 'infra_epiteto_specific') !!}
		{!! Form::text('infra_epiteto_specific', null, ['class' => 'validate', 'required']) !!}
	</div>
	<div class="col s3">
		{!! Form::label('rank_marker', 'rank_marker') !!}
		{!! Form::text('rank_marker', null, ['class' => 'validate', 'required']) !!}
	</div>
	<div class="col s3">
		{!! Form::label('specific_epithet', 'specific_epithet') !!}
		{!! Form::number('specific_epithet', null, ['class' => 'validate', 'required']) !!}
	</div>
	<div class="col s3">
		{!! Form::label('superkingdom', 'superkingdom') !!}
		{!! Form::text('superkingdom', null, ['class' => 'validate', 'required']) !!}
	</div>
	<div class="col s3">
		{!! Form::label('kingdom', 'kingdom') !!}
		{!! Form::text('kingdom', null, ['class' => 'validate', 'required']) !!}
	</div>
	<div class="col s3">
		{!! Form::label('phylum', 'phylum') !!}
		{!! Form::text('phylum', null, ['class' => 'validate', 'required']) !!}
	</div>
	<div class="col s3">
		{!! Form::label('subphylum', 'subphylum') !!}
		{!! Form::text('subphylum', null, ['class' => 'validate', 'required']) !!}
	</div>
	<div class="col s3">
		{!! Form::label('superclass', 'superclass') !!}
		{!! Form::text('superclass', null, ['class' => 'validate', 'required']) !!}
	</div>
	<div class="col s3">
		{!! Form::label('class', 'class') !!}
		{!! Form::text('class', null, ['class' => 'validate', 'required']) !!}
	</div>
	<div class="col s3">
		{!! Form::label('subclass', 'subclass') !!}
		{!! Form::text('subclass', null, ['class' => 'validate', 'required']) !!}
	</div>
	<div class="col s3">
		{!! Form::label('infraclass', 'infraclass') !!}
		{!! Form::text('infraclass', null, ['class' => 'validate', 'required']) !!}
	</div>
	<div class="col s3">
		{!! Form::label('superorder', 'superorder') !!}
		{!! Form::text('superorder', null, ['class' => 'validate', 'required']) !!}
	</div>
	<div class="col s3">
		{!! Form::label('order_2', 'order_2') !!}
		{!! Form::text('order_2', null, ['class' => 'validate', 'required']) !!}
	</div>
	<div class="col s3">
		{!! Form::label('suborder', 'suborder') !!}
		{!! Form::text('suborder', null, ['class' => 'validate', 'required']) !!}
	</div>
	<div class="col s3">
		{!! Form::label('infraorder', 'infraorder') !!}
		{!! Form::text('infraorder', null, ['class' => 'validate', 'required']) !!}
	</div>
	<div class="col s3">
		{!! Form::label('parvorder', 'parvorder') !!}
		{!! Form::text('parvorder', null, ['class' => 'validate', 'required']) !!}
	</div>
	<div class="col s3">
		{!! Form::label('superfamily', 'superfamily') !!}
		{!! Form::text('superfamily', null, ['class' => 'validate', 'required']) !!}
	</div>
	<div class="col s3">
		{!! Form::label('family', 'family') !!}
		{!! Form::text('family', null, ['class' => 'validate', 'required']) !!}
	</div>
	<div class="col s3">
		{!! Form::label('subfamily', 'subfamily') !!}
		{!! Form::text('subfamily', null, ['class' => 'validate', 'required']) !!}
	</div>
	<div class="col s3">
		{!! Form::label('tribe', 'tribe') !!}
		{!! Form::text('tribe', null, ['class' => 'validate', 'required']) !!}
	</div>
	<div class="col s3">
		{!! Form::label('genus', 'genus') !!}
		{!! Form::text('genus', null, ['class' => 'validate', 'required']) !!}
	</div>
	<div class="col s3">
		{!! Form::label('subgenus', 'subgenus') !!}
		{!! Form::text('subgenus', null, ['class' => 'validate', 'required']) !!}
	</div>
	<div class="col s3">
		{!! Form::label('subspecie', 'subspecie') !!}
		{!! Form::text('subspecie', null, ['class' => 'validate', 'required']) !!}
	</div>
</div>
<div class="row">
	{!! Form::submit('Guardar', ['class'=>'btn btn-large btn-block btn-block-large waves-effect waves-light']) !!}
</div>
{!! Form::close() !!}

@endsection