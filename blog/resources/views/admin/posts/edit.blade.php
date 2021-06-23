@extends('admin.template')

@section('summernote')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
@endsection

@section('h1','Modifier cet article')
    
@section('mycontent')

<div class="container">
    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data"> {{-- tjrs ajouter le enctype !!! pour le file --}}
    @csrf
    @method('put')
    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}"> 
        <div class="text-danger">{{ $errors->first('title', ':message') }}</div>
    </div>

    <div class="form-group">
        <label for="category_id">Catégorie</label>
        <select name="category_id" id="category_id" class="form-control" >
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : ''}}>{{ $category->name }}</option> {{-- cela permet de retrouver le nom dans la selection --}}
            @endforeach
        </select>
        <div class="text-danger">{{ $errors->first('category_id', ':message') }}</div>
    </div>
    <div class="form-group">
        <div class="d-flex justify-content-around align-items-center">
            <div>
                <p>Image actuelle</p>
                <img src="{{ asset($post->image)}}" alt="image" width="120" height="120">
            </div>
            <div>
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control-file">
                <div class="text-danger">{{ $errors->first('image', ":message")}}</div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="content">Contenu</label>
        <textarea name="content" id="content" class="form-control" rows="10">{{ $post->content }}</textarea>
        <script>
            $('#content').summernote({
              placeholder: 'Bonne rédaction',
              tabsize: 2,
              height: 100
            });
          </script>
        <div class="text-danger">{{ $errors->first('content', ':message') }}</div>
    </div>

    <div class="form-group text-center">
       <input type="submit" class=" sauv btn btn-primary" value="modifier">
    </div>

    </form>
</div>


@endsection
