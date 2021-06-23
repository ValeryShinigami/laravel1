@extends('admin.template')

@section('h1', 'Modifier le Tag')
    
@section('mycontent')
    <div class="container">
        <form action="{{ route('admin.tags.update', $tag->id) }}" method="POST">
            @csrf
            @method('patch')
            {{--@method('put') utiliser lorsque l'on envoie une info modifiée via un formulaire--}} 
            <div class="form-group">
                <label for="nanme">Nom</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $tag->name }}"> 
                <div class="text-danger">{{ $errors->first('name', ':message')}}</div>
            </div>
            <div class="form-group text-center">
                <input type="submit" class="btn btn-success">
            </div> 
        </form>
    </div>
@endsection