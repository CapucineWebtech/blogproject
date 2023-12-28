@extends('layout')

@section('title', 'Catégories')

@section('content')
    <h1 class="text-center mb-4">Liste des catégories</h1>
    <table class="table table-dark table-striped">
        @foreach($categories as $category)
        <tr>
            <td class="align-middle">{{ $category->name }}</td>
            <td style="width: 1%;">
                <a class="btn btn-primary" href="{{ route('categories.edite', $category) }}">Modifier</a>
            </td>
            <td style="width: 1%;">
                <form method="POST" action="{{ route('categories.destroy', $category) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?');">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <a href="{{ route('categories.create') }}" class="btn btn-primary blog-btn blog-btn-right">Nouveau</a>
@endsection
