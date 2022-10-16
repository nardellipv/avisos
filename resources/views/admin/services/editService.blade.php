@extends('layouts.main')

@section('css')
<link rel="stylesheet" href="{{ asset('styleWeb/assets/css/owl.carousel.min.css') }}" type="text/css">
<link href="{{ asset('styleWeb/assets/css/star-min.css') }}" rel="stylesheet">
@endsection

@section('content')
<section class="content">
    <section class="block">
        <div class="container">
            <form class="form form-submit" action="{{ route('adminService.update', $service) }}" method="POST"
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

                <section>
                    <h2>Location</h2>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Publish" class="col-form-label">Publish</label>
                                <select name="publish" id="Publish" data-placeholder="Seleccionar Publish">
                                    <option value="{{ $service->publish }}" selected>{{ $service->publish }}</option>
                                    <option value="">----------------</option>
                                    <option value="Free">Free</option>
                                    <option value="Destacado">Destacado</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="visit" class="col-form-label">Visitas</label>
                                <input name="visit" type="text" class="form-control" id="visit" value="{{ $service->visit }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="like" class="col-form-label">Likes</label>
                                <input name="like" type="text" class="form-control" id="like" value="{{ $service->like }}">
                            </div>
                        </div>
                    </div>
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