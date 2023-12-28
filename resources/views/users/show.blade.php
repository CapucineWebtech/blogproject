@extends('layout')

@section('title', $user == auth()->user() ? "Mon Compte" : "Voir un compte")

@section('content')
    <h1>{{ $user->name }}</h1>
    @if ($user->hasRole('admin'))
        <span class="badge text-bg-info">Administrateur</span>
    @endif
    @auth
    @if ($user->id == auth()->user()->getAuthIdentifier() || auth()->user()->hasRole('admin'))
        <p class="mt-2">{{ $user->email }}</p>
    @endif
    @endauth
    <h2 class="mt-4">Articles :</h2>
    <div class="row">
        @foreach($user->posts as $post)
            @include('components.post-card')
        @endforeach
    </div>
    @auth
    @if ($user->id == auth()->user()->getAuthIdentifier())
        <a href="{{ route('users.edite', $user) }}" class="btn btn-primary blog-btn blog-btn-right">Modifier</a>
        <form method="POST" action="{{ route('auth.logout') }}" onsubmit="return confirm('Êtes-vous sûr de vouloir vous déconnecter ?');">
            @csrf
            @method("POST")
            <button type="submit" class="btn btn-warning blog-btn blog-btn-left">Déconnecter</button>
        </form>
    @elseif(auth()->user()->hasRole('admin'))
        <a href="{{ route('users.edite', $user) }}" class="btn btn-primary blog-btn blog-btn-right">Modifier</a>
    @endif
    @endauth

@endsection
