@extends('layouts.main')

@section('content')
<section class="content">
    <section class="block">
        <div class="container">
            <form class="form form-submit" action="{{ route('service.store') }}" method="POST"
                onsubmit="submitButton.disabled = true; return true;" enctype="multipart/form-data">
                @csrf
                <section>
                    <h2>Publicar Nuevo Servicio</h2>
                    @include('web.alerts.error')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="city" class="col-form-label required">Categoría</label>
                                <select name="category_id" id="category-group" data-placeholder="Seleccionar Categoría" required
                                    onchange="window.location.href=this.options[this.selectedIndex].value;">
                                    @if (request()->input(['id']))
                                    <option value="{{ $category->id }}">{{ $category->name }}
                                    </option>
                                    @else
                                    <option>Seleccionar Categoría</option>
                                    <option disabled>-----------------</option>
                                    @endif
                                    @foreach ($categories as $category)
                                    <option value="{{ route('service.createCategoySelect', ['id' => $category]) }}">
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="city" class="col-form-label required">Sub Categoría</label>
                                <select name="subcategory_id" id="category-group" data-placeholder="Seleccionar Sub Categoría"
                                    required>
                                    @if (isset($subCategories))
                                    <option value="0">Elegir una Sub Categoría</option>
                                    <option disabled>-----------------</option>
                                    @foreach ($subCategories as $subcategory)
                                    <option value="{{ $subcategory->id }}">
                                        {{ $subcategory->name }}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="title" class="col-form-label required">Título</label>
                                <input name="title" value="{{ old('title') }}" type="text" class="form-control"
                                    id="title" placeholder="Título del servicio" required>
                                <small>No debe superar los 60 caracteres. </small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone" class="col-form-label">Teléfono</label>
                                <input name="phone" value="{{ old('phone') }}" type="text" class="form-control"
                                    id="phone" placeholder="Teléfono de contacto">
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
                        <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                    </div>
                    <small>Ingresar un mínimo de 100 caracteres. </small>
                </section>

                {{--  <section>
                    <h2>Horario disponible <small>(opcional)</small></h2>
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="accordion-heading-1">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#accordion-collapse-1" aria-expanded="false" aria-controls="accordion-collapse-1">
                                        <i class="fa fa-clock-o"></i>Agregar horarios
                                    </a>
                                </h4>
                            </div>
                            <!--end panel-heading-->
                            <div id="accordion-collapse-1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="accordion-heading-1">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 horizontal-input-title">
                                            <strong>Monday</strong>
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="open_hours_monday[]" placeholder="Inicio">
                                            </div>
                                            <!--end form-group-->
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="close_hours_monday[]" placeholder="Fin">
                                            </div>
                                            <!--end form-group-->
                                        </div>
                                        <!--end col-md-4-->
                                    </div>
                                    <!--end row-->
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 horizontal-input-title">
                                            <strong>Tuesday</strong>
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="open_hours_tuesday[]" placeholder="Inicio">
                                            </div>
                                            <!--end form-group-->
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="close_hours_tuesday[]" placeholder="Fin">
                                            </div>
                                            <!--end form-group-->
                                        </div>
                                        <!--end col-md-4-->
                                    </div>
                                    <!--end row-->
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 horizontal-input-title">
                                            <strong>Wednesday</strong>
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="open_hours_wednesday[]" placeholder="Inicio">
                                            </div>
                                            <!--end form-group-->
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="close_hours_wednesday[]" placeholder="Fin">
                                            </div>
                                            <!--end form-group-->
                                        </div>
                                        <!--end col-md-4-->
                                    </div>
                                    <!--end row-->
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 horizontal-input-title">
                                            <strong>Thursday</strong>
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="open_hoursthursday[]" placeholder="Inicio">
                                            </div>
                                            <!--end form-group-->
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="close_hours_thursday[]" placeholder="Fin">
                                            </div>
                                            <!--end form-group-->
                                        </div>
                                        <!--end col-md-4-->
                                    </div>
                                    <!--end row-->
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 horizontal-input-title">
                                            <strong>Friday</strong>
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="open_hours_friday[]" placeholder="Inicio">
                                            </div>
                                            <!--end form-group-->
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="close_hours_friday[]" placeholder="Fin">
                                            </div>
                                            <!--end form-group-->
                                        </div>
                                        <!--end col-md-4-->
                                    </div>
                                    <!--end row-->
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 horizontal-input-title">
                                            <strong>Saturday</strong>
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="open_hours_saturday[]" placeholder="Inicio">
                                            </div>
                                            <!--end form-group-->
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="close_hours_saturday[]" placeholder="Fin">
                                            </div>
                                            <!--end form-group-->
                                        </div>
                                        <!--end col-md-4-->
                                    </div>
                                    <!--end row-->
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 horizontal-input-title">
                                            <strong>Sunday</strong>
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="open_hours_sunday[]" placeholder="Inicio">
                                            </div>
                                            <!--end form-group-->
                                        </div>
                                        <!--end col-md-4-->
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="close_hours_sunday[]" placeholder="Fin">
                                            </div>
                                            <!--end form-group-->
                                        </div>
                                        <!--end col-md-4-->
                                    </div>
                                    <!--end row-->
                                </div>
                            </div>
                            <!--end panel-collapse-->
                        </div>
                        <!--end panel-->
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="phoneWsp">
                            <small> Disponible las 24hs.</small>
                        </label>
                    </div>
                </section>  --}}


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
                        <button type="submit" class="btn btn-primary large icon float-right">Crear Servicio<i
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
@endsection