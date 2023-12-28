@extends('layout')

@section('title', 'Tags')

@section('content')
    <h1 class="text-center mb-4">Liste des tags</h1>
    <table class="table table-dark table-striped">
        @foreach($tags as $tag)
            <tr>
                <td class="align-middle">{{ $tag->name }}</td>
                <td style="width: 1%;">
                    <a class="btn btn-primary" href="{{ route('tags.edite', $tag) }}">Modifier</a>
                </td>
                <td style="width: 1%;">
                    <form method="POST" action="{{ route('tags.destroy', $tag) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce tag ?');">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <a href="{{ route('tags.create') }}" class="btn btn-primary blog-btn blog-btn-right">Nouveau</a>
@endsection
