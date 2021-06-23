@extends('layouts.app')

@section('content')
    {{-- Ce content représente le dashboard de l administrateur --}}
    <div class="row" style="margin: 0px;">
        <div class="col-md-2 bg-ocean text-center sidebar">
           <ul class="list-group bg-ocean">
               <div class="list-group bg-ocean">
                   <a href="{{ route('admin.index') }}" class="list-group-item bg-ocean text-white">Accueil</a>
                   <a href="{{ route('admin.categories.index') }}" class="list-group-item bg-ocean text-white">Catégories</a>
                   <a href="{{ route('admin.posts.index') }}" class="list-group-item bg-ocean text-white">Articles</a>
                   <a href="{{ route('admin.tags.index') }}" class="list-group-item bg-ocean text-white">Tags</a>
                   <a href="{{ route('admin.trash.index') }}" class="list-group-item bg-ocean text-white">Corbeille</a>
               </div>
           </ul>
        </div>
        <div class="col-md-10">
            <h1 class="text-center text-ocean my-3">
                @yield('h1')
            </h1>
            @yield('mycontent')
        </div>

    </div>
@endsection