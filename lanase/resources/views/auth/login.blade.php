@extends('panel.main')
@section('title','Dashboard')
@section('content')

<div class="container">
        
    <div class="row mt-150">

            {!! Form::open(['url' => 'login', 'method' => 'POST', 'class' => 'col s6 col-center', 'style' => 'padding:30px' ]) !!}

                <div class="row">
                    
                    <div class="input-field col s12">
                        
                        {!! Form::label('email', 'Email') !!}
                        {!! Form::email('email', null, ['class' => 'validate', 'required']) !!}

                    </div>

                    <div class="input-field col s12">
                        
                        {!! Form::label('password', 'Password') !!}
                        {!! Form::password('password', null, ['class' => 'validate', 'required']) !!}

                    </div>

                </div>

                <div class="row">
                    
                    <div class="col m12 col-center mt-15">
                    
                        <div class="col s6">
                            <a href="">Olvide mi contraseña</a>
                        </div> 
                        <div class="col s6">
                            {!! Form::submit('Log in', ['class' => 'btn btn-block btn-block-large waves-effect waves-light']) !!}
                        </div>

                    </div>

                </div>

            {!! Form::close() !!}

    </div>

    <div class="row">
        
        <div class="col s5 col-center mt-50">
            
            <p id="response" class="center-align red-text"></p>

        </div>

    </div>

</div>

@endsection
