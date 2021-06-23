@extends('admin.template')

@section('h1', 'Corbeille')

@section('mycontent')


@if (session('warning'))
    <div class="alert alert-warning alert -dismissible fade show" role="alert">
        {{ session('warning') }}
        <button type="button" class="close" data-dismiss="alert" aria-label=Close>
            <span aria-hidden="true">&times;</span>
        </button>

    </div>
@endif

@if (session('success'))
    <div class="alert alert-success alert -dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label=Close>
            <span aria-hidden="true">&times;</span>
        </button>

    </div>
@endif

<div class="barre table-responsive">
    <table class="table table-striped table-hover text-center">
        <thead class="theadImage">
            <tr>
                <th>Image</th>
                <th>Titre</th>
                <th>Catégorie</th>
                <th>Paramètres</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($posts as $post)
                    <tr>
                        {{--asset se positionne dans le dossier PUBLIC il va chercher le dossier upload/posts/images/ --}}
                        <td><img src="{{ asset($post->image) }}" width='100' height="100" alt="image"></td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category->name }}</td> {{--pour récupérer le nom de la catégorie pour la jointure --}}    
                        <td>
                            <a href="{{ route('admin.trash.posts.restore', $post->id) }}" class="modifier btn btn-sm btn-secondary">Restaurer</a>
                            <form action="{{ route('admin.trash.posts.delete', $post->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('delete')
                                <input type="submit" value="Supprimer" class="btn btn-sm btn-danger" onclick="return confirm('cette action supprimera définitivement votre article ?')">
                            </form>
                        </td>
                    </tr>                
            @endforeach
        </tbody>

    </table>
</div>
    
    
@endsection