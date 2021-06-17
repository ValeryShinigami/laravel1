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

    <div class="table-responsive">
        <table class="text-center table table-striped table-hover">
            <thead class="bg-ocean text-white">
                <tr>
                    <th>Nom</th>
                    <th>Date de création</th>
                    <th>Date de modif</th>
                    <th>Paramètres</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name}}</td>
                        <td>{{ $category->created_at}}</td>
                        <td>{{ $category->updated_at}}</td>
                        <td>
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-secondary">Modifier</a>
                            <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('delete')
                                <input type="submit" value="supprimer" class="btn btn-sm btn-danger" onclick="return confirm('confirmer la suppression ?')">
                            </form>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

