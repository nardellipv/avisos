@extends('layouts.mainAdminSite')

@section('css')
<link rel="stylesheet" href="{{ asset('admin/assets/bundles/summernote/summernote-bs4.css') }}">
<link rel="stylesheet" href="{{ asset('admin/assets/bundles/jquery-selectric/selectric.css') }}">
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Crear Post</h4>
            </div>
            <form action="{{ route('blog.storePost') }}" class="form-horizontal" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
            <div class="card-body">
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Título</label>
                    <div class="col-sm-12 col-md-7">
                        <input type="text" name="title" class="form-control">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Categoría</label>
                    <div class="col-sm-12 col-md-7">
                        <select name="category_blog_id" class="form-control selectric">
                            <option>Seleccione una categoría</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Contenido</label>
                    <div class="col-sm-12 col-md-7">
                        <textarea class="summernote" name="body"></textarea>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>
                    <div class="col-sm-12 col-md-7">
                        <input type="file" name="photo" class="form-control">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                    <div class="col-sm-12 col-md-7">
                        <button class="btn btn-primary">Publicar</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('admin/assets/bundles/summernote/summernote-bs4.js') }}"></script>
<script src="{{ asset('admin/assets/bundles/codemirror/mode/javascript/javascript.js') }}"></script>
<script src="{{ asset('admin/assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('admin/assets/bundles/ckeditor/ckeditor.js') }}"></script>
<!-- Page Specific JS File -->
<script src="{{ asset('admin/assets/js/page/ckeditor.js') }}"></script>
@endsection