@extends('layout')

@section('title', 'Édition de catégorie')

@section('content')
    @include('categories.form')

    @if ($category->posts->isNotEmpty())
        <h3>Articles reliés à la catégorie</h3>
        <table class="table table-striped table-bordered mb-4">
            @foreach($category->posts as $post)
                <tr>
                    <td class="align-middle"><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></td>
                    <td style="width: 0%;">
                        <form method="POST" class="d-flex" action="{{ route('categories.reassign-posts', $category) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="posts[]" value="{{ $post->id }}">
                            <select class="form-select w-auto me-1" name="new_category">
                                @foreach($categories as $category_post)
                                    <option @selected($category_post->id == $category->id) value="{{ $category_post->id }}">{{ $category_post->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary">Réassigner</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        <h3>Réassigner les articles</h3>
        <form method="POST" class="row" action="{{ route('categories.reassign-posts', $category) }}">
            @csrf
            @method('PUT')
            <div class="col-12 col-md-6 mb-2">
                <select class="form-select w-100" name="new_category">
                    @foreach($categories as $category_post)
                        <option @selected($category_post->id == $category->id) value="{{ $category_post->id }}">{{ $category_post->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-6 mb-2">
                <button type="submit" class="btn btn-primary w-100">Tout réassigner</button>
            </div>
        </form>
    @endif

    <form method="POST" action="{{ route('categories.destroy', $category) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?');">
        @csrf
        @method("DELETE")
        <button type="submit" class="btn btn-danger blog-btn blog-btn-left">Supprimer</button>
    </form>
@endsection
