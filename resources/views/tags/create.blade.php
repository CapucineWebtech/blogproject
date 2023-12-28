@extends('layout')

@section('title', 'Création de tag')

@section('content')
    @include('tags.form')
    <a href="{{ route('tags.index') }}" class="btn btn-danger blog-btn blog-btn-left">Annuler</a>
@endsection
