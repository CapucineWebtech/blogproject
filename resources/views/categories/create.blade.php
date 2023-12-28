@extends('layout')

@section('title', 'Création de catégorie')

@section('content')
    @include('categories.form')
    <a href="{{ route('categories.index') }}" class="btn btn-danger blog-btn blog-btn-left">Annuler</a>
@endsection
