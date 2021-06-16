@extends('admin.template')

@section('h1', 'Liste des catégories')

@if (session('success'))
    <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

    
@section('mycontent')
    <div class="d-flex justify-content-end align-items-center">
        <a href="{{ route('admin.categories.create')}}" class="bb btn btn-primary">Nouvelle Catégorie</a>

    </div>
@endsection

