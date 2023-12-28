@extends('layout')

@section('title', 'Comptes')

@section('content')
    <h1 class="text-center mb-4">Liste des utilisateurs</h1>
    <table class="table table-dark table-striped">
        @foreach($users as $user)
            <tr>
                <td class="align-middle">{{ $user->name }}</td>
                <td style="width: 1%;">
                    <a class="btn btn-success" href="{{ route('users.show', $user) }}">Voir</a>
                </td>
            </tr>
        @endforeach
    </table>
    <a href="{{ route('users.create') }}" class="btn btn-primary blog-btn blog-btn-right">Nouveau</a>
@endsection
