@extends('admin.template')

@section('h1', 'Nouvelle Catégorie')
    
@section('mycontent')
    <div class="container">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nanme">Nom</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"> 
                <div class="text-danger">{{ $errors->first('name', ':message')}}</div>
            </div>
            <div class="form-group text-center">
                <input type="submit" class="btn btn-success">
            </div> 
        </form>
    </div>
@endsection