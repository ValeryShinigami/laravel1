@extends('admin.template')

@section('h1')

{{ $post->titile}}   
@endsection

@section('mycontent')

    <div class="container">
         {{ $post->content}}
    </div>
    
@endsection