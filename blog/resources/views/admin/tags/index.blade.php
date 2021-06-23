@extends('admin.template')

@section('h1', 'Liste des tags')

@section('mycontent')

@if (session('success'))
    <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning text-center alert-dismissible fade show" role="alert">
        {{!! session('warning') !!}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
    

    <div class="d-flex justify-content-end align-items-center">
        <a href="{{ route('admin.tags.create')}}" class="bb btn btn-primary">Nouveau tag</a>

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
                @foreach ($tags as $tag)
                    <tr>
                        <td>{{ $tag->name}}</td>
                        <td>{{ $tag->created_at}}</td>
                        <td>{{ $tag->updated_at}}</td>
                        <td>
                            <a href="{{ route('admin.tags.edit', $tag->id) }}" class="btn btn-sm btn-secondary">Modifier</a>
                            <form action="{{ route('admin.tags.delete', $tag->id) }}" method="POST" class="d-inline">
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

