@extends('site.main')
@section('title','Home')

@section('content')

<section id="section-1">
    <div class="row">
        <div class="col s6 offset-m1 center-align">
            <div class="card transparent">
                {{-- <h5>Investigación</h5>
                <p>Lorem ipsum dolor sit amet, consectetur</p><br>
                <button class="btn waves-effect waves-light">Ver más</button> --}}
                <img src="{{ asset('images/logo-lanase.png') }}" class="responsive-img">
            </div>
        </div>
        {{-- <div class="col s4">
            <div class="card center-align">
                <h5>Proyectos</h5>
                <p>Lorem ipsum dolor sit amet, consectetur</p><br>
                <button class="btn waves-effect waves-light">Ver más</button>
            </div>
        </div> --}}
        <div class="col s4 offset-m1">
            <div class="card center-align">
                <h5>Repositorio</h5>
                <p>Lorem ipsum dolor sit amet, consectetur</p><br>
                <button class="btn waves-effect waves-light blue darken-3">Ver más</button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s4 center-align">
            <div class="card">
                <h5>Investigación</h5>
                <p>Lorem ipsum dolor sit amet, consectetur</p><br>
                <button class="btn waves-effect waves-light blue darken-3">Ver más</button>
            </div>
        </div>
        <div class="col s4">
            <div class="card center-align">
                <h5>Proyectos</h5>
                <p>Lorem ipsum dolor sit amet, consectetur</p><br>
                <button class="btn waves-effect waves-light blue darken-3">Ver más</button>
            </div>
        </div>
        <div class="col s4">
            <div class="card center-align">
                <h5>Servicios</h5>
                <p>Lorem ipsum dolor sit amet, consectetur</p><br>
                <button class="btn waves-effect waves-light blue darken-3">Ver más</button>
            </div>
        </div>
    </div>

</section>

<section id="section-2">
    <div class="row">
        <div class="col s12 m6">
            <h6 class="underline"><b>Proyectos</b></h6>
        </div>
        <div class="col s12">
            @foreach( $projects as $project)
            <div class="col s12 m3">
                <div class="card">
                    <div class="card-image">
                        <img src="{{ asset('images/projects').'/'.$project->title_es.'/'.$project->image }}">
                        <a class="btn halfway-fab waves-effect waves-light red">ver mas</a>
                    </div>
                    <div class="card-content">
                        <span class="card-title">{{ ucwords($project->title_es) }}</span>
                        <p>{{ $project->abstract_es }}</p>
                    </div>
              </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
    
<section id="section-3">
    <div class="row">
        <div class="col s6">
     
            <h6 class="underline"><b>Próximo eventos</b></h6>
            <ul class="collection mt-15">
                <li class="collection-item1 col s12">
                    <div class="col s2">
                        <h3 class="date">24</h3>
                        <p>Abril</p>
                    </div>
                    <div class="col s10 info">
                        <p class="title">Investigacion</p>
                        <p class="more">Lanase Morelia</p>
                        <a href="#!" class="secondary-content"><i class="material-icons">more</i></a>
                    </div>
                </li>

                <li class="collection-item1 col s12">
                    <div class="col s2">
                        <h3 class="date">28</h3>
                        <p>Abril</p>
                    </div>
                    <div class="col s10 info">
                        <p class="title">Exposición</p>
                        <p class="more">Centro cultural</p>
                        <a href="#!" class="secondary-content"><i class="material-icons">more</i></a>
                    </div>
                </li>

                <li class="collection-item1 col s12">
                    <div class="col s2">
                        <h3 class="date">02</h3>
                        <p>Mayo</p>
                    </div>
                    <div class="col s10 info">
                        <p class="title">Conferencia...</p>
                        <p class="more">Sala C</p>
                        <a href="#!" class="secondary-content"><i class="material-icons">more</i></a>
                    </div>
                </li>

            </ul>
          
        </div>
        <div class="col s6">
            
        </div>
        
    </div>
</section>

<section>
    
</section>

@endsection