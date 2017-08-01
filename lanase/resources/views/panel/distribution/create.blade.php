@extends('panel.main')
@section('title','Distribution')

@section('nav')
@include('admin.nav')
@endsection

@section('content')

{!! Form::open(['route' => 'distribution.store', 'method' => 'POST']) !!}

{!! Form::label('specimen_id', 'Specimen ID') !!}
{!! Form::text('specimen_id', null, ['class' => 'validate', 'required']) !!}

{!! Form::label('latitude', 'Latitude') !!}
{!! Form::text('latitude', null, ['class' => 'validate', 'required']) !!}

{!! Form::label('longitude', 'Longitude') !!}
{!! Form::text('longitude', null, ['class' => 'validate', 'required']) !!}

{!! Form::label('altitude', 'Altitude') !!}
{!! Form::text('altitude', null, ['class' => 'validate', 'required']) !!}

{!! Form::label('site', 'Site') !!}
{!! Form::text('site', null, ['class' => 'validate', 'required']) !!}

{!! Form::label('date', 'Date') !!}
{!! Form::date('date', null, ['class' => 'validate', 'required']) !!}

{!! Form::label('country', 'Country') !!}
{!! Form::text('country', null, ['class' => 'validate', 'required']) !!}

{!! Form::label('region', 'Region') !!}
{!! Form::text('region', null, ['class' => 'validate', 'required']) !!}

{!! Form::label('locality', 'Locality') !!}
{!! Form::text('locality', null, ['class' => 'validate', 'required']) !!}

{!! Form::label('sub_locality', 'Sub Locality') !!}
{!! Form::text('sub_locality', null, ['class' => 'validate', 'required']) !!}

{!! Form::submit('Guardar', ['class'=>'btn btn-large btn-block btn-block-large waves-effect waves-light']) !!}

{!! Form::close() !!}

@endsection