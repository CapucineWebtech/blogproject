@extends('layout')

@section('title', "Création d'article")

@section('start-script')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
@endsection

@section('end-script')
    <script>
        ClassicEditor.create(document.querySelector('#editor'), {
            toolbar: {
                items: [
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    'link',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'undo',
                    'redo'
                ]
            },
            language: 'fr',
        })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection

@section('content')
    @include('posts.form')
    <a href="{{ route('posts.index') }}" class="btn btn-danger blog-btn blog-btn-left">Annuler</a>
@endsection
