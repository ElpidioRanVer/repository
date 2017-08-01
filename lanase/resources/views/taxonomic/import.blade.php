
@extends('main')
@section('title','Dashboard')
@section('nav')



  <script src="{{ asset('js/select_file.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
  <script src="{{ asset('js/pagination.js') }}"></script>

  
  <link rel="stylesheet" type="text/css" href="./css/style.css">
  <link rel="stylesheet" type="text/css" href="css/resptable.css">
  <meta name="csrf-token" id="pruba" content="{{ csrf_token() }}" />

  

<style>
  .thumb {
    height: 200px;
    border: 1px solid #000;
    margin: 10px 5px 0 0;
  }
  .galeriaprev:hover{
  opacity: 0.8;
  cursor: pointer;
  transition:all ease 2s;
}
  .galeriaprev {
    width: 40px;
    height: 40px;
    margin: 5px;
    border-radius: 40px;
    border: solid #52accc;
    transition:all ease 2s;
}
</style>
@include('admin.nav')
@endsection
@section('content')


  


    <br>
	  <form action="#">
    <div class="file-field input-field">
      <div class="btn">
        <span>File</span>
        <input type="file" id="files" class="file" name="files[]" onchange="handleFiles(this.files)" accept=".csv">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
  </form>
  <br><br>
  <div>
    <!--<input type="button" class="btn btn-default btn-lg" onclick="send_info()" value="Guardar">-->
    <input type="button" class="btn btn-default btn-lg" onclick="rm_data()" value="Borrar tabla">
    <input type="button" class="btn btn-default btn-lg" onclick="alert('chido')" value="To Metadata">
  </div>
  <br>


  <output id="list" name="list"></output>
  <output id="result_info" name="result_info"></output>
  <div id="tax_content" class="simages">
    <output id="tax_info" name="tax_info"></output>
  </div>
  <output id="check_id" name="check_id"></output>
@endsection