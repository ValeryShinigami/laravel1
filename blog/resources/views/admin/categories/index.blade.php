@extends('admin.template')

@section('mycontent')
    <h1 class="text-center text-ocean my-3">Liste des catégories</h1>

    <div class="d-flex justify-content-end align-items-center">
        <a href="{{ route('admin.categories.create') }}" class=" bb btn btn-primary">Nouvelle catégorie</a>
    </div>
    
@endsection

