@extends('layout')

@section('title', 'Articles')

@section('content')
    <h2>Filtres</h2>
    <div class="row mt-2">
        <div class="col-12 col-md-5 mb-2">
            <label for="category_id" class="form-label">Catégorie d'article</label>
            <select class="form-select" id="category_id" name="category_id">
                <option value=""></option>
                @foreach($categories as $category)
                    <option @selected(request('category_id') == $category->id) value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-md-5 mb-2">
            <label for="tag_id" class="form-label">Tag d'article</label>
            <select class="form-select" id="tag_id" name="tag_id">
                <option value=""></option>
                @foreach($tags as $tag)
                    <option @selected(request('tag_id') == $tag->id) value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-md-2 mb-2 d-flex">
            <button onclick="applyFilters()" class="btn btn-dark mt-auto w-100">Appliquer les filtres</button>
        </div>
    </div>

    <div class="row mt-4">
        @foreach($posts as $post)
            @include('components.post-card')
        @endforeach
    </div>

    <a href="{{ route('posts.create') }}" class="btn btn-primary blog-btn blog-btn-right">Nouveau</a>

    <script>
        function applyFilters() {
            var categoryId = document.getElementById('category_id').value;
            var tagId = document.getElementById('tag_id').value;
            var url = "{{ route('posts.index') }}";
            var queryParams = [];
            if (categoryId) {
                queryParams.push('category_id=' + categoryId);
            }
            if (tagId) {
                queryParams.push('tag_id=' + tagId);
            }
            if (queryParams.length > 0) {
                url += '?' + queryParams.join('&');
            }
            window.location.href = url;
        }
    </script>
@endsection
