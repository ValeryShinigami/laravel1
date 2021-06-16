@extends('layouts.app')

@section('content')
    {{-- Ce content représente le dashboard de l administrateur --}}
    <div class="row" style="margin: 0px;">
        <div class="col-md-2 bg-ocean text-center sidebar">
           <ul class="list-group bg-ocean">
               <div class="list-group bg-ocean">
                   <a href="{{ route('admin.index') }}" class="list-group-item bg-ocean text-white">Accueil</a>
                   <a href="{{ route('admin.categories.index') }}" class="list-group-item bg-ocean text-white">Catégorie</a>
               </div>
           </ul>
        </div>
        <div class="col-md-10">
            @yield('mycontent')
        </div>

    </div>
@endsection