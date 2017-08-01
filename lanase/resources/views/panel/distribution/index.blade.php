@extends('panel.main')
@section('title','Distribution')

@section('nav')
@include('admin.nav')
@endsection

@section('content')

<a href="{{ route('distribution.create') }}" class="btn waves-light waves-effect">Nuevo</a>

@endsection