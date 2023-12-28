@extends('layout')

@section('title', "Voir l'article")

@section('content')
    <h1 class="text-center mb-4">{{ $post->title }}</h1>
    <p class="mb-4">{!! $post->content !!}</p>
    <p class="mb-2">
        De : <a href="{{ route('users.show', $post->user) }}" class="card-link">{{ $post->user->name }}</a>, publié le {{ $post->created_at->format('d/m/Y') }}
    </p>
    <div class="mb-2"><strong>Catégorie : </strong>{{ $post->category->name }}</div>
    <div>
        <strong>Tags :</strong>
        @foreach ($post->tags as $tag)
            <span class="badge text-bg-secondary">{{ $tag->name }}</span>
        @endforeach
    </div>
    @auth
        @if(auth()->user()->id == $post->user_id || auth()->user()->hasRole('admin'))
            <a href="{{ url()->previous() }}" class="btn btn-danger blog-btn blog-btn-left">Retour</a>
            <a href="{{ route('posts.edite', $post) }}" class="btn btn-primary blog-btn blog-btn-right">Modifier</a>
        @else
            <a href="{{ url()->previous() }}" class="btn btn-danger blog-btn blog-btn-right">Retour</a>
        @endif
    @endauth
    @guest
        <a href="{{ url()->previous() }}" class="btn btn-danger blog-btn blog-btn-right">Retour</a>
    @endguest
@endsection
