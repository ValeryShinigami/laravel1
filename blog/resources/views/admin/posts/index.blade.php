@extends('admin.template')

@section('h1', 'Liste des articles')

@section('mycontent')

<div class="d-flex justify-content-center align-items-center">
        <a href="{{ route('admin.posts.create') }}" class="bnt btn-outline-primary btn-lg" type="button">Nouvel article</a>
</div>

<div class="barre table-responsive">
    <table class="table table-striped table-hover text-center">
        <thead class="theadImage">
            <tr>
                <th>Image</th>
                <th>Titre</th>
                <th>Catégorie</th>
                <th>Lire Contenu</th>
                <th>Publié ?</th>
                <th>Paramètres</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($posts as $post)
                    <tr>
                        {{--asset se positionne dans le dossier PUBLIC il va chercher le dossier upload/posts/images/ --}}
                        <td><img src="{{ asset($post->image) }}" width='100' height="100" alt="image"></td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category_id }}</td>
                        <td>
                            <a href="" class="lire btn btn-sm btn-info">Lire</a>
                        </td>
                        <td>{{ $post->published }}</td>
                        <td>
                            <a href="" class="modifier btn btn-sm btn-secondary">Modifier</a>
                            <form action="" method="POST">
                                @csrf
                                <input type="submit" value="Corbeille" class="btn btn-sm btn-danger" onclick="return confirm('Déplacer cette article dans la corbeille ?')">
                            </form>
                        </td>
                    </tr>                
            @endforeach
        </tbody>

    </table>
</div>
    
    
@endsection