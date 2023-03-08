@extends('layouts.admin')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 my-5">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2>Dettaglio progetto {{$post->title}}</h2>
                    </div>
                    <div>
                        <a href="{{route('admin.posts.index')}}" class="btn btn-sm btn-primary">Torna all'elenco</a>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <img src="{{ asset('storage/' .$post->cover_image) }}" alt="{{$post->title}}" class="w-25">
                <p>
                  <strong>Slug:</strong>  
                  {{$post->slug}}
                </p>
                <p>
                    <strong>Tipo:</strong>
                    {{$post->type ? $post->type->name : 'Senza tipologia'}}
                </p>
                <p>
                    <strong>Tecnologie:</strong>  
                    @forelse ($post->technologies as $technology)
                        {{$technology->name}}
                    @empty
                        Nessuna tecnologia
                    @endforelse
                </p>
                <label class="d-block">
                    <strong>Contenuto:</strong>
                </label>
                <p>{{$post->content}}</p>
            </div>
        </div>
    </div>

@endsection