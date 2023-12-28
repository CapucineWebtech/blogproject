@extends('layout')

@section('title', 'Connexion')

@section('content')
    <h1 class="text-center mb-4">Connexion</h1>
    @include('auth.form')
    <p>Pas encore de compte ? <a href="{{ route('users.create') }}">Créez le ici</a></p>
@endsection
