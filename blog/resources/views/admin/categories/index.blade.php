@extends('admin.template')

@section('h1', 'Liste des catégories')
    
@section('mycontent')
    <div class="d-flex justify-content-end align-items-center">
        <a href="{{ route('admin.categories.create')}}" class="bb btn btn-primary">Nouvelle Catégorie</a>

    </div>
@endsection

