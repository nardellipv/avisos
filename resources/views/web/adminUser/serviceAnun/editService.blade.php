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
                        <h2>Editar Servicio</h2>
                        @include('web.alerts.error')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category-group" class="col-form-label required">Categoría</label>
                                    <input type="hidden" name="category_id" value="{{ $service->category_id }}">
                                    <select id="category-group" disabled>
                                        <option value="{{ $service->category_id }}" selected>{{ $service->category->name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subcategory_id" class="col-form-label required">Sub Categoría</label>
                                    <input type="hidden" name="subcategory_id" value="{{ $service->subcategory_id }}">
                                    <select id="subcategory_id" disabled>
                                        @if ($service->subcategory)
                                            <option value="{{ $service->subcategory->id }}" selected>
                                                {{ $service->subcategory->name }}</option>
                                        @else
                                            <option value="">Sin Sub Categoría</option>
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
                                        value="{{ old('title', $service->title) }}" placeholder="Título del servicio">
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
                                            <input type="checkbox" name="phoneWsp"
                                                {{ old('phoneWsp', $service->phoneWsp == 'Y') ? 'checked' : '' }}>
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
                                        value="{{ old('social_facebook', $service->social_facebook) }}"
                                        placeholder="Cuenta">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="social_instagram" class="col-form-label">Instagram</label>
                                    <input name="social_instagram" type="text" class="form-control" id="social_instagram"
                                        value="{{ old('social_instagram', $service->social_instagram) }}"
                                        placeholder="Usuario">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="social_website" class="col-form-label">Web Site</label>
                                    <input name="social_website" type="text" class="form-control" id="social_website"
                                        value="{{ old('social_website', $service->social_website) }}"
                                        placeholder="sitio web">
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
                                        <option value="0"
                                            {{ old('years_of_experience', $service->years_of_experience) == '0' ? 'selected' : '' }}>
                                            Menos de 1 año</option>
                                        <option value="1"
                                            {{ old('years_of_experience', $service->years_of_experience) == '1' ? 'selected' : '' }}>
                                            1 a 3 años</option>
                                        <option value="3"
                                            {{ old('years_of_experience', $service->years_of_experience) == '3' ? 'selected' : '' }}>
                                            3 a 5 años</option>
                                        <option value="5"
                                            {{ old('years_of_experience', $service->years_of_experience) == '5' ? 'selected' : '' }}>
                                            5 a 10 años</option>
                                        <option value="10"
                                            {{ old('years_of_experience', $service->years_of_experience) == '10' ? 'selected' : '' }}>
                                            Más de 10 años</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="payment_methods" class="col-form-label required">Metodos de pago</label>
                                    <select name="payment_methods[]" id="payment_methods"
                                        data-placeholder="Seleccionar métodos" multiple required>
                                        @php
                                            $oldPaymentMethods = old(
                                                'payment_methods',
                                                $service->payment_methods ?? [],
                                            );
                                        @endphp
                                        <option value="Efectivo"
                                            {{ in_array('Efectivo', $oldPaymentMethods) ? 'selected' : '' }}>Efectivo
                                        </option>
                                        <option value="Transferencia Bancaria"
                                            {{ in_array('Transferencia Bancaria', $oldPaymentMethods) ? 'selected' : '' }}>
                                            Transferencia Bancaria</option>
                                        <option value="Mercado Pago"
                                            {{ in_array('Mercado Pago', $oldPaymentMethods) ? 'selected' : '' }}>Mercado
                                            Pago</option>
                                        <option value="Tarjeta de Credito"
                                            {{ in_array('Tarjeta de Credito', $oldPaymentMethods) ? 'selected' : '' }}>
                                            Tarjeta de Crédito</option>
                                        <option value="Tarjeta de Debito"
                                            {{ in_array('Tarjeta de Debito', $oldPaymentMethods) ? 'selected' : '' }}>
                                            Tarjeta de Débito</option>
                                        <option value="Cheque"
                                            {{ in_array('Cheque', $oldPaymentMethods) ? 'selected' : '' }}>Cheque</option>
                                        <option value="Otro"
                                            {{ in_array('Otro', $oldPaymentMethods) ? 'selected' : '' }}>Otro</option>
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
                                        <option value="Gratis"
                                            {{ old('estimate_cost', $service->estimate_cost) == 'Gratis' ? 'selected' : '' }}>
                                            Gratis</option>
                                        <option value="Con Cargo"
                                            {{ old('estimate_cost', $service->estimate_cost) == 'Con Cargo' ? 'selected' : '' }}>
                                            Con Cargo</option>
                                        <option value="A Convenir"
                                            {{ old('estimate_cost', $service->estimate_cost) == 'A Convenir' ? 'selected' : '' }}>
                                            A Convenir</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section>
                        <label for="description" class="col-form-label required">Descripción</label>
                        <div class="form-group">
                            <textarea name="description" id="description" class="form-control" rows="4" required
                                placeholder="Descripción del servicio">{{ old('description', $service->description) }}</textarea>
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
                                            $hoursToRender = empty($oldHours)
                                                ? $service->structured_availability_hours ?? []
                                                : $oldHours;

                                            $days = [
                                                'monday',
                                                'tuesday',
                                                'wednesday',
                                                'thursday',
                                                'friday',
                                                'saturday',
                                                'sunday',
                                            ];
                                            $dayNames = [
                                                'Lunes',
                                                'Martes',
                                                'Miércoles',
                                                'Jueves',
                                                'Viernes',
                                                'Sábado',
                                                'Domingo',
                                            ];
                                        @endphp

                                        @foreach ($days as $key => $day)
                                            @php
                                                $dayHasHours =
                                                    isset($hoursToRender[$day]) &&
                                                    is_array($hoursToRender[$day]) &&
                                                    count($hoursToRender[$day]) > 0;
                                                $hoursForDay = $dayHasHours ? $hoursToRender[$day] : [null];
                                            @endphp
                                            <div id="hours-{{ $day }}-container">
                                                @foreach ($hoursForDay as $index => $timeSlot)
                                                    <div class="row time-slot align-items-center"
                                                        data-day="{{ $day }}">
                                                        <div class="col-md-3 col-sm-4 horizontal-input-title">
                                                            @if ($index === 0)
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
                                                            @if ($index > 0)
                                                                <button type="button"
                                                                    class="btn btn-sm btn-danger remove-time-slot"
                                                                    data-day="{{ $day }}">-</button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn btn-sm btn-success add-time-slot"
                                                                    data-day="{{ $day }}">+</button>
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
                                <input type="checkbox" name="available_24_7"
                                    {{ old('available_24_7', $service->attends_emergencies) ? 'checked' : '' }}>
                                <small> Disponible las 24hs.</small>
                            </label>
                        </div>
                    </section>

                    @if ($service->photo || $images->count() > 0)
                        <section>
                            <h2>Imágenes Actuales</h2>
                            <div class="gallery-carousel owl-carousel">
                                @php
                                    $allImages = [];
                                    if ($service->photo) {
                                        $allImages[] = (object) [
                                            'name' => $service->photo,
                                            'id' => null,
                                            'is_main' => true,
                                        ];
                                    }
                                    $allImages = array_merge($allImages, $images->all());
                                @endphp

                                @foreach ($allImages as $key => $image)
                                    @php
                                        $imagePath = asset('users/' . $service->user_id . '/service/' . $image->name);
                                        $deleteRoute = isset($image->id) ? route('service.deletePhoto', $image) : null;
                                        $imageId = isset($image->id) ? $image->id : 'main_' . $key;
                                    @endphp
                                    <div class="image-item">
                                        <img src="{{ $imagePath }}" alt="{{ $service->title }}">
                                        @if ($deleteRoute)
                                            <a href="{{ $deleteRoute }}" class="btn btn-danger small delete-image-btn"
                                                data-image-id="{{ $imageId }}"> Eliminar </a>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    <section>
                        <h2>Subir Nuevas Imágenes</h2>
                        <label for="file-upload" class="col-form-label">Seleccionar Imágenes</label>
                        <div class="file-upload-previews"></div>
                        <div class="file-upload">
                            <input type="file" name="photo[]" class="file-upload-input with-preview" multiple>
                            <span><i class="fa fa-plus-circle"></i>Seleccione las imagenes</span>
                        </div>
                        <small>Máximo 3 imágenes adicionales.</small>
                    </section>

                    <section class="clearfix">
                        <div class="form-group">
                            <button type="submit" name="submitButton"
                                class="btn btn-primary large icon float-right">Actualizar Servicio<i
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
    <script src="{{ asset('styleWeb/assets/js/owl.carousel.min.js') }}"></script>


    @if ($service->structured_availability_hours)
        <script>
            window.serviceHours = @json($service->structured_availability_hours);
        </script>
    @endif
    @if (old('hours'))
        <script>
            window.oldHours = @json(old('hours'));
        </script>
    @endif


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
                        var nameMatch = currentName.match(
                            /hours\[(.*?)\]\[(\d+)\]\[(.*?)\]/);
                        if (nameMatch) {
                            var dayName = nameMatch[1];
                            var timeType = nameMatch[3];
                            var newName = 'hours[' + dayName + '][' + index + '][' +
                                timeType + ']';
                            $(this).attr('name', newName);
                        }
                    });
                    $(this).find('.add-time-slot, .remove-time-slot').remove();
                    if (index === 0) {
                        var dayNameHtml = '<strong>' + day.charAt(0).toUpperCase() + day.slice(1) +
                            '</strong>';
                        if (day === 'wednesday') dayNameHtml = '<strong>Miércoles</strong>';
                        if (day === 'saturday') dayNameHtml = '<strong>Sábado</strong>';
                        if (day === 'sunday') dayNameHtml = '<strong>Domingo</strong>';
                        $(this).find('.col-md-3, .col-sm-4').html(dayNameHtml);
                        $(this).find('.col-md-1, .col-sm-auto').html(
                            '<button type="button" class="btn btn-sm btn-success add-time-slot" data-day="' +
                            day + '">+</button>');
                    } else {
                        $(this).find('.horizontal-input-title').empty();
                        $(this).find('.col-md-1, .col-sm-auto').html(
                            '<button type="button" class="btn btn-sm btn-danger remove-time-slot" data-day="' +
                            day + '">-</button>');
                    }
                });
            });

            var hoursToPopulate = window.oldHours || window.serviceHours;

            if (hoursToPopulate) {
                var days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

                days.forEach(function(day) {
                    if (hoursToPopulate.hasOwnProperty(day) && Array.isArray(hoursToPopulate[day])) {
                        var dayHours = hoursToPopulate[day];
                        var $container = $('#hours-' + day + '-container');

                        if (dayHours.length > 0) {
                            $container.find('.row.time-slot').first().remove();
                        }

                        for (var i = 0; i < dayHours.length; i++) {
                            var timeSlotData = dayHours[i];
                            var openTime = timeSlotData ? (timeSlotData.open || '') : '';
                            var closeTime = timeSlotData ? (timeSlotData.close || '') : '';

                            var $lastCurrentSlot = $container.find('.row.time-slot').last();

                            var $newSlot;

                            if (!$lastCurrentSlot.length) {
                                var $elementToClone;
                                if (i === 1) { // If adding the second slot (index 1)
                                    $elementToClone = $container.find('.row.time-slot[data-day="' + day +
                                        '"]').first(); // Clone the first (static) one
                                } else { // If adding third slot (index 2) or more
                                    $elementToClone = $container.find('.row.time-slot').last();
                                }
                                $newSlot = $elementToClone.clone();
                            }

                            if (i > 0) {
                                var $lastCurrentSlot = $container.find('.row.time-slot').last();

                                var $newSlot = $lastCurrentSlot.clone();

                                $newSlot.find('input[type="time"]').each(function() {
                                    var currentName = $(this).attr('name');
                                    var nameMatch = currentName.match(
                                        /hours\[(.*?)\]\[(\d+)\]\[(.*?)\]/);
                                    if (nameMatch) {
                                        var dayName = nameMatch[1];
                                        var timeType = nameMatch[3];
                                        var newName = 'hours[' + dayName + '][' + i + '][' +
                                            timeType + ']';
                                        $(this).attr('name', newName);

                                        if (timeType === 'open') {
                                            $(this).val(openTime);
                                        } else if (timeType === 'close') {
                                            $(this).val(closeTime);
                                        }
                                    }
                                });

                                $newSlot.find('.add-time-slot')
                                    .removeClass('btn-success add-time-slot')
                                    .addClass('btn-danger remove-time-slot')
                                    .text('-');

                                $newSlot.find('.horizontal-input-title').empty();

                                $lastCurrentSlot.after($newSlot);
                            }

                        }

                        // After adding all slots for the day, re-render buttons based on current DOM state
                        $container.find('.row.time-slot').each(function(index) {
                            $(this).find('.add-time-slot, .remove-time-slot')
                        .remove(); // Remove existing buttons
                            var dayBtn = $(this).data('day');
                            if (index === 0) {
                                // Add '+' button to the first row
                                $(this).find('.col-md-1, .col-sm-auto').html(
                                    '<button type="button" class="btn btn-sm btn-success add-time-slot" data-day="' +
                                    dayBtn + '">+</button>');
                            } else {
                                // Add '-' button to subsequent rows
                                $(this).find('.col-md-1, .col-sm-auto').html(
                                    '<button type="button" class="btn btn-sm btn-danger remove-time-slot" data-day="' +
                                    dayBtn + '">-</button>');
                            }
                            // Ensure day label is only on the first row
                            if (index > 0) {
                                $(this).find('.horizontal-input-title').empty();
                            }
                        });

                    }
                });
            }


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

            $('.gallery-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 5
                    }
                }
            });

            $(document).on('click', '.delete-image-btn', function(e) {
                e.preventDefault();
                var deleteUrl = $(this).attr('href');
                var $imageItem = $(this).closest('.image-item');

                if (confirm('¿Estás seguro de que quieres eliminar esta imagen?')) {
                    $.ajax({
                        url: deleteUrl,
                        type: 'POST', // O 'DELETE' si tu ruta usa ese método y tienes el @method('DELETE')
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE' // Si usas DELETE en la ruta
                        },
                        success: function(result) {
                            if (result.success) {
                                $imageItem.remove();
                                // Opcional: Re-inicializar el carousel o manejar si se eliminan todas las imágenes
                            } else {
                                alert(result.message || 'Error al eliminar la imagen.');
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('Error al eliminar la imagen.');
                            console.error(xhr.responseText);
                        }
                    });
                }
            });

        });
    </script>
@endsection
