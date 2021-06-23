@extends('admin.template')

@section('h1')

{{ $post->titile}}   
@endsection

@section('mycontent')

    <div class="container">
         {!! $post->content !!} {{-- pour retirer les balises html dans la rédaction pour lire --}}
    </div>
    
@endsection