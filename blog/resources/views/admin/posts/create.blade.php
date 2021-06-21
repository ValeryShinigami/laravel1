@extends('admin.template')

@section('h1','Nouvel article')
    
@section('mycontent')

<div class="container">
    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data"> {{-- tjrs ajouter le enctype !!! pour le file --}}
    @csrf
    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}"> {{-- value= old() permet de garder les anciennes données --}}
        <div class="text-danger">{{ $errors->first('title', ':message') }}</div>
    </div>

    <div class="form-group">
        <label for="category_id">Catégorie</label>
        <select name="category_id" id="category_id" class="form-control" >
            <option selected disabled> --- </option> {{-- pour avoir le trait non cliquable --}}
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option> {{-- --}}
            @endforeach
        </select>
        <div class="text-danger">{{ $errors->first('category_id', ':message') }}</div>
    </div>

    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" class="form-control-file" id="image">
        <div class="text-danger">{{ $errors->first('image', ':message') }}</div>
    </div>

    <div class="form-group">
        <label for="content">Contenu</label>
        <textarea name="content" id="content" class="form-control" rows="10">{{old('content')}}</textarea>
        <div class="text-danger">{{ $errors->first('content', ':message') }}</div>
    </div>

    <div class="form-group text-center">
       <input type="submit" class=" sauv btn btn-primary" value="sauvegarder">
    </div>

    </form>
</div>


@endsection


