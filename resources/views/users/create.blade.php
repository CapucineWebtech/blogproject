@extends('layout')

@section('title', "Création de compte")

@section('content')
    <h1 class="text-center mb-4">Création de compte</h1>
    @include('users.form')
    <p>Déjà un compte ? <a href="{{ route('auth.login') }}">Connectez-vous ici</a></p>
    <a href="{{ url()->previous() }}" class="btn btn-danger blog-btn blog-btn-left">Annuler</a>
@endsection
