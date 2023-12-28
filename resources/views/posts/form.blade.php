<form method="POST" action="">
    @csrf
    @method($post->id?'PUT':'POST')
    <input type="hidden" name="user_id" value="{{ auth()->user()->getAuthIdentifier() }}">
    <div class="mb-3">
        <label for="title" class="form-label">Titre de votre article</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ isset($post) ? old('title', $post['title']) : '' }}">
        @error('title')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>
    <div class="row">
        <div class="col-12 col-md-6 mb-3">
            <label for="category_id" class="form-label">Catégorie de l'article</label>
            <select class="form-select" id="category_id" name="category_id">
                @foreach($categories as $category)
                    <option @selected(old("category_id", $post->category_id) == $category->id) value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-12 col-md-6 mb-3">
            <label for="tags" class="form-label">Tags de l'article</label>
            <select class="form-select js-select2" id="tags" name="tags[]" multiple>
                @foreach($tags as $tag)
                    <option @selected(in_array($tag->id, (array) old("tags", $post->tags->pluck('id')->toArray()))) value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
            @error('tags')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Contenu</label>
        <textarea class="form-control" id="editor" name="content">{{ isset($post) ? old('content', $post['content']) : '' }}</textarea>
        @error('content')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary blog-btn blog-btn-right">Enregistrer</button>


    <script>
        $(".js-select2").select2({
            closeOnSelect : false,
            placeholder : "",
            allowHtml: true,
            allowClear: true,
            tags: true
        });

        $('.icons_select2').select2({
            width: "100%",
            templateSelection: iformat,
            templateResult: iformat,
            allowHtml: true,
            placeholder: "",
            dropdownParent: $( '.select-icon' ),
            allowClear: true,
            multiple: false
        });


        function iformat(icon, badge,) {
            var originalOption = icon.element;
            var originalOptionBadge = $(originalOption).data('badge');

            return $('<span><i class="fa ' + $(originalOption).data('icon') + '"></i> ' + icon.text + '<span class="badge">' + originalOptionBadge + '</span></span>');
        }
    </script>
</form>
