@extends('layouts.app')

@section('content')
    {{-- Ce content représente le dashboard de l administrateur --}}
    <div class="row">
        <div class="col-md-2">
           <ul class="list-group">
               <div class="list-group">
                   <a href="#" class="list-group-item list-group-item-action">Accueil</a>
                   <a href="#" class="list-group-item list-group-item-action">Catégorie</a>
               </div>
           </ul>
        </div>
        <div class="col-md-10">
            @yield('mycontent')
        </div>

    </div>
@endsection