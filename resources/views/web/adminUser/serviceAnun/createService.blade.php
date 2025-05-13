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
                                    <label for="category-group" class="col-form-label required">Categoría</label>
                                    @if (request()->input('id'))
                                        <input type="hidden" name="category_id" value="{{ request()->input('id') }}">
                                    @endif

                                    <select name="category_id_display"
                                            id="category-group"
                                            data-placeholder="Seleccionar Categoría"
                                            required
                                            onchange="window.location.href=this.options[this.selectedIndex].value;"
                                            @if (request()->input('id')) disabled @endif >

                                        @if (!request()->input('id'))
                                            <option value="">Seleccionar Categoría</option>
                                            <option disabled>-----------------</option>
                                        @endif

                                        @foreach ($categories as $category)
                                            <option value="{{ route('service.createCategoySelect', ['id' => $category->id]) }}"
                                                    @if (request()->input('id') == $category->id) selected @endif >
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subcategory_id" class="col-form-label required">Sub Categoría</label>
                                    <select name="subcategory_id" id="subcategory_id"
                                        data-placeholder="Seleccionar Sub Categoría" required>
                                        <option value="">Elegir una Sub Categoría</option>
                                        @if (isset($subCategories))
                                            <option disabled>-----------------</option>
                                            @foreach ($subCategories as $subcategory)
                                                <option value="{{ $subcategory->id }}"
                                                        {{ old('subcategory_id') == $subcategory->id ? 'selected' : '' }}>
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
                                            <input type="checkbox" name="phoneWsp" {{ old('phoneWsp') ? 'checked' : '' }}>
                                            <small> Habilitado para whatsapp</small>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="social_facebook" class="col-form-label">Facebook</label>
                                    <input name="social_facebook" type="text" class="form-control" id="social_facebook"
                                        value="{{ old('social_facebook') }}" placeholder="Cuenta">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="social_instagram" class="col-form-label">Instagram</label>
                                    <input name="social_instagram" type="text" class="form-control" id="social_instagram"
                                        value="{{ old('social_instagram') }}" placeholder="Usuario">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="social_website" class="col-form-label">Web Site</label>
                                    <input name="social_website" type="text" class="form-control" id="social_website"
                                        value="{{ old('social_website') }}" placeholder="sitio web">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="years_of_experience" class="col-form-label required">Años de
                                        experiencia</label>
                                    <select name="years_of_experience" id="years_of_experience"
                                        data-placeholder="Seleccionar Rango" required>
                                        <option value=""></option>
                                        <option value="0" {{ old('years_of_experience') == '0' ? 'selected' : '' }}>Menos de 1 año</option>
                                        <option value="1" {{ old('years_of_experience') == '1' ? 'selected' : '' }}>1 a 3 años</option>
                                        <option value="3" {{ old('years_of_experience') == '3' ? 'selected' : '' }}>3 a 5 años</option>
                                        <option value="5" {{ old('years_of_experience') == '5' ? 'selected' : '' }}>5 a 10 años</option>
                                        <option value="10" {{ old('years_of_experience') == '10' ? 'selected' : '' }}>Más de 10 años</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="payment_methods" class="col-form-label required">Metodos de pago</label>
                                    <select name="payment_methods[]" id="payment_methods"
                                        data-placeholder="Seleccionar métodos" multiple required>
                                        @php
                                            $oldPaymentMethods = old('payment_methods', []);
                                        @endphp
                                        <option value="Efectivo" {{ in_array('Efectivo', $oldPaymentMethods) ? 'selected' : '' }}>Efectivo</option>
                                        <option value="Transferencia Bancaria" {{ in_array('Transferencia Bancaria', $oldPaymentMethods) ? 'selected' : '' }}>Transferencia Bancaria</option>
                                        <option value="Mercado Pago" {{ in_array('Mercado Pago', $oldPaymentMethods) ? 'selected' : '' }}>Mercado Pago</option>
                                        <option value="Tarjeta de Credito" {{ in_array('Tarjeta de Credito', $oldPaymentMethods) ? 'selected' : '' }}>Tarjeta de Crédito</option>
                                        <option value="Tarjeta de Debito" {{ in_array('Tarjeta de Debito', $oldPaymentMethods) ? 'selected' : '' }}>Tarjeta de Débito</option>
                                        <option value="Cheque" {{ in_array('Cheque', $oldPaymentMethods) ? 'selected' : '' }}>Cheque</option>
                                        <option value="Otro" {{ in_array('Otro', $oldPaymentMethods) ? 'selected' : '' }}>Otro</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="estimate_cost" class="col-form-label required">Presupuesto a
                                        domicilio</label>
                                    <select name="estimate_cost" id="estimate_cost"
                                        data-placeholder="Seleccionar presupuesto" required>
                                        <option value=""></option>
                                        <option value="Gratis" {{ old('estimate_cost') == 'Gratis' ? 'selected' : '' }}>Gratis</option>
                                        <option value="Con Cargo" {{ old('estimate_cost') == 'Con Cargo' ? 'selected' : '' }}>Con Cargo</option>
                                        <option value="A Convenir" {{ old('estimate_cost') == 'A Convenir' ? 'selected' : '' }}>A Convenir</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section>
                        <label for="description" class="col-form-label required">Descripción</label>
                        <div class="form-group">
                            <textarea name="description" id="description" class="form-control" placeholder="Descripción del servicio"
                                rows="4" required>{{ old('description') }}</textarea>
                        </div>
                        <small>Ingresar un mínimo de 100 caracteres. </small>
                    </section>

                    <section>
                        <h2>Horario disponible <small>(opcional)</small></h2>
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="accordion-heading-1">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion"
                                            href="#accordion-collapse-1" aria-expanded="false"
                                            aria-controls="accordion-collapse-1">
                                            <i class="fa fa-clock-o"></i>Agregar horarios
                                        </a>
                                    </h4>
                                </div>
                                <div id="accordion-collapse-1" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="accordion-heading-1">
                                    <div class="panel-body">

                                        @php
                                            $oldHours = old('hours', []);
                                            $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                                            $dayNames = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
                                        @endphp

                                        @foreach($days as $key => $day)
                                            @php
                                                $dayHasOldHours = isset($oldHours[$day]) && is_array($oldHours[$day]) && count($oldHours[$day]) > 0;
                                                $hoursForDay = $dayHasOldHours ? $oldHours[$day] : [null];
                                            @endphp
                                            <div id="hours-{{ $day }}-container">
                                                @foreach($hoursForDay as $index => $timeSlot)
                                                    <div class="row time-slot align-items-center" data-day="{{ $day }}">
                                                        <div class="col-md-3 col-sm-4 horizontal-input-title">
                                                            @if($index === 0)
                                                                <strong>{{ $dayNames[$key] }}</strong>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-4 col-sm-4">
                                                            <div class="form-group">
                                                                <input type="time" class="form-control"
                                                                    name="hours[{{ $day }}][{{ $index }}][open]"
                                                                    placeholder="Inicio"
                                                                    value="{{ $timeSlot['open'] ?? '' }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4">
                                                            <div class="form-group">
                                                                <input type="time" class="form-control"
                                                                    name="hours[{{ $day }}][{{ $index }}][close]"
                                                                    placeholder="Fin"
                                                                    value="{{ $timeSlot['close'] ?? '' }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1 col-sm-auto">
                                                            @if($index > 0)
                                                                <button type="button" class="btn btn-sm btn-danger remove-time-slot" data-day="{{ $day }}">-</button>
                                                            @else
                                                                <button type="button" class="btn btn-sm btn-success add-time-slot" data-day="{{ $day }}">+</button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                </div>
                            </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="available_24_7" {{ old('available_24_7') ? 'checked' : '' }}>
                                <small> Disponible las 24hs.</small>
                            </label>
                        </div>
                    </section>

                    <section>
                        <h2>Galeria</h2>
                        <label for="file-upload" class="col-form-label">Imágenes</label>
                        <div class="file-upload-previews"></div>
                        <div class="file-upload">
                            <input type="file" name="photo[]" class="file-upload-input with-preview" multiple> 
                            <span><i class="fa fa-plus-circle"></i>Seleccione las imagenes</span>
                        </div>
                        <small>Máximo 3 imágenes.</small>
                    </section>

                    <section class="clearfix">
                        <div class="form-group">
                            <button type="submit" name="submitButton" class="btn btn-primary large icon float-right">Crear Servicio<i
                                    class="fa fa-chevron-right"></i></button>
                        </div>
                    </section>
                </form>
            </div>
        </section>
    </section>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
    <script src="{{ asset('styleWeb/assets/js/jQuery.MultiFile.min.js') }}"></script>

    <script>
        $(document).ready(function() {

            $(document).on('click', '.add-time-slot', function() {
                var day = $(this).data('day');
                var $dayContainer = $('#hours-' + day + '-container');
                var $lastSlotRow = $dayContainer.find('.row.time-slot').last();

                if (!$lastSlotRow.length) {
                    console.error('No se encontró la última fila de horario para el día: ' + day);
                    return;
                }

                var lastInputName = $lastSlotRow.find('input[type="time"]').first().attr('name');
                var nameMatch = lastInputName.match(/hours\[(.*?)\]\[(\d+)\]\[(.*?)\]/);
                var currentIndex = 0;
                 if (nameMatch && nameMatch[2] !== undefined) {
                    currentIndex = parseInt(nameMatch[2]);
                 }
                var newIndex = currentIndex + 1;

                var $newSlot = $lastSlotRow.clone();

                $newSlot.find('input[type="time"]').val('');

                $newSlot.find('input[type="time"]').each(function() {
                     var currentName = $(this).attr('name');
                     var nameMatch = currentName.match(/hours\[(.*?)\]\[(\d+)\]\[(.*?)\]/);
                     if (nameMatch) {
                         var dayName = nameMatch[1];
                         var timeType = nameMatch[3];
                         var newName = 'hours[' + dayName + '][' + newIndex + '][' + timeType + ']';
                         $(this).attr('name', newName);
                     }
                });

                $newSlot.find('.add-time-slot')
                    .removeClass('btn-success add-time-slot')
                    .addClass('btn-danger remove-time-slot')
                    .text('-');

                 $lastSlotRow.find('.remove-time-slot')
                     .removeClass('btn-danger remove-time-slot')
                     .addClass('btn-success add-time-slot')
                     .text('+');

                 $newSlot.find('.horizontal-input-title').empty();

                $lastSlotRow.after($newSlot);
            });

            $(document).on('click', '.remove-time-slot', function() {
                var $rowToRemove = $(this).closest('.row.time-slot');
                var day = $rowToRemove.data('day');
                var $dayContainer = $('#hours-' + day + '-container');

                $rowToRemove.remove();

                $dayContainer.find('.row.time-slot').each(function(index) {
                    $(this).find('input[type="time"]').each(function() {
                        var currentName = $(this).attr('name');
                         var nameMatch = currentName.match(/hours\[(.*?)\]\[(\d+)\]\[(.*?)\]/);
                         if (nameMatch) {
                             var dayName = nameMatch[1];
                             var timeType = nameMatch[3];
                             var newName = 'hours[' + dayName + '][' + index + '][' + timeType + ']';
                             $(this).attr('name', newName);
                         }
                    });
                    $(this).find('.add-time-slot, .remove-time-slot').remove();
                     if (index === 0) {
                          var dayNameHtml = '<strong>' + day.charAt(0).toUpperCase() + day.slice(1) + '</strong>';
                          if (day === 'wednesday') dayNameHtml = '<strong>Miércoles</strong>';
                          if (day === 'saturday') dayNameHtml = '<strong>Sábado</strong>'; // Added Saturday
                          if (day === 'sunday') dayNameHtml = '<strong>Domingo</strong>'; // Added Sunday
                          $(this).find('.col-md-3, .col-sm-4').html(dayNameHtml); // Adjusted selector
                          $(this).find('.col-md-1, .col-sm-auto').html('<button type="button" class="btn btn-sm btn-success add-time-slot" data-day="' + day + '">+</button>');
                     } else {
                          $(this).find('.horizontal-input-title').empty();
                          $(this).find('.col-md-1, .col-sm-auto').html('<button type="button" class="btn btn-sm btn-danger remove-time-slot" data-day="' + day + '">-</button>');
                     }
                });
            });

            $('select[data-placeholder]').each(function() {
                 var placeholderText = $(this).data('placeholder');
                 $(this).select2({
                     placeholder: placeholderText,
                     allowClear: !$(this).prop('required')
                 });
             });

            $('.file-upload-input').MultiFile({
                max_uploads: 3,
                accept: 'jpg|jpeg|png|gif'
            });
        });
    </script>
@endsection