@extends('layout')

@section('title', 'Édition de tag')

@section('content')
    @include('tags.form')
    <form method="POST" action="{{ route('tags.destroy', $tag) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce tag ?');">
        @csrf
        @method("DELETE")
        <button type="submit" class="btn btn-danger blog-btn blog-btn-left">Supprimer</button>
    </form>
@endsection
