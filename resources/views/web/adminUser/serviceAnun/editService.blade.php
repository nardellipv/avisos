@extends('layouts.main')

@section('css')
<link rel="stylesheet" href="{{ asset('styleWeb/assets/css/owl.carousel.min.css') }}" type="text/css">
<link href="{{ asset('styleWeb/assets/css/star-min.css') }}" rel="stylesheet">
@endsection

@section('content')
<section class="content">
    <section class="block">
        <div class="container">
            <form class="form form-submit" action="{{ route('service.update', $service) }}" method="POST"
                onsubmit="submitButton.disabled = true; return true;" enctype="multipart/form-data">
                @csrf
                <section>
                    <h2>Publicar Nuevo Servicio</h2>
                    @include('web.alerts.error')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="city" class="col-form-label required">Categoría</label>
                                <select name="category_id" id="category-group" disabled>
                                    <option>{{ $service->category->name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="city" class="col-form-label required">Sub Categoría</label>
                                <select name="subcategory_id" id="category-group" disabled>
                                    @if ($subCategory)
                                    <option>{{ $subCategory->name }}</option>
                                    @else
                                    <option>Sin Sub Categoría</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="title" class="col-form-label required">Título</label>
                                <input name="title" type="text" class="form-control" id="title" required
                                    value="{{ old('title', $service->title) }}">
                                <small>No debe superar los 60 caracteres. </small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone" class="col-form-label">Teléfono</label>
                                <input name="phone" type="text" class="form-control"
                                    value="{{ old('phone', $service->phone) }}" id="phone"
                                    placeholder="Teléfono de contacto">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" checked name="phoneWsp">
                                        <small> Habilitado para whatsapp</small>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <label for="description" class="col-form-label required">Descripción</label>
                    <div class="form-group">
                        <textarea name="description" id="description" class="form-control"
                            rows="4">{{ old('description', $service->description) }}</textarea>
                    </div>
                    <small>Ingresar un mínimo de 100 caracteres. </small>
                </section>


                @if ($service->photo)
                <div class="gallery-carousel owl-carousel">
                    @foreach ($images as $key=>$image)
                    <img src="{{ asset('users/' . $service->user->id . '/service/' . $image->name) }}"
                        alt="{{ $service->category->name }}">
                    @endforeach
                </div>
                <div class="gallery-carousel-thumbs owl-carousel">
                    @foreach ($images as $key => $image)
                    <a href="#{{ $key }}" class="owl-thumb background-image">
                        <img src="{{ asset('users/' . $service->user->id . '/service/' . $image->name) }}"
                            alt="{{ $service->category->name }}">                            
                    </a>
                    <a href="{{ route('service.deletePhoto', $image) }}" class="btn btn-danger small" id="deleteImage"> Eliminar
                        </a>
                    @endforeach
                </div>
                @else
                <img alt="{{ $service->title }}" src="{{ asset('styleWeb/assets/sin_imagen.jpg') }}"
                    class="image-wrapper background-image">
                @endif


                <section>
                    <h2>Galeria</h2>
                    <label for="file-upload" class="col-form-label">Imágenes</label>
                    <div class="file-upload-previews"></div>
                    <div class="file-upload">
                        <input type="file" name="photo[]" class="file-upload-input with-preview">
                        <span><i class="fa fa-plus-circle"></i>Seleccione las imagenes</span>
                    </div>
                    <small>Máximo 3 imágenes.</small>
                </section>

                <section class="clearfix">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary large icon float-right">Actualizar Servicio<i
                                class="fa fa-chevron-right"></i></button>
                    </div>
                </section>
            </form>
        </div>
    </section>
</section>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
<script src="{{ asset('styleWeb/assets/js/jQuery.MultiFile.min.js') }}"></script>
<script src="{{ asset('styleWeb/assets/js/owl.carousel.min.js') }}"></script>
@endsection