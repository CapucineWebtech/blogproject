@extends('layout')

@section('title', "Édition de compte")

@section('content')
    @include('users.form')
    <form method="POST" action="{{ route('users.destroy', $user) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce compte ?');">
        @csrf
        @method("DELETE")
        <button type="submit" class="btn btn-danger blog-btn blog-btn-left">Supprimer</button>
    </form>
    @if($user->posts->count() > 0)
    <h2>Articles</h2>
    <table class="table table-striped table-bordered">
        @foreach($user->posts as $post)
            <tr>
                <td class="align-middle"><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></td>
                <td style="width: 0%;">
                    <a href="{{ route('posts.edite', $post) }}" class="btn btn-primary">Modifier</a>
                </td>
                <td style="width: 0%;">
                    <form method="POST" action="{{ route('posts.destroy', $post) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette article ?');">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    @endif
@endsection
