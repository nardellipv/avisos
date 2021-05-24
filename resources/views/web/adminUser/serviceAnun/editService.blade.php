@extends('layouts.main')

@section('content')
    <div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-9 page-content">
                    <div class="inner-box category-content">
                        <h2 class="title-2 uppercase"><strong> <i class="icon-docs"></i> Publicar Servicio</strong></h2>
                        @include('web.alerts.error')
                        <div class="row">
                            <div class="col-sm-12">
                                <form action="{{ route('service.update', $service) }}" class="form-horizontal"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Categoría</label>

                                            <div class="col-md-8">
                                                <select name="category_id" id="category-group" class="form-control"
                                                    disabled>
                                                    <option>
                                                        {{ $service->category->name }}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Sub Categoría</label>

                                            <div class="col-md-8">
                                                <select name="subcategory_id" id="category-group" class="form-control"
                                                    disabled>
                                                    @if ($subCategory)
                                                        <option>{{ $subCategory->name }}</option>
                                                    @else
                                                        <option>Sin Sub Categoría</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="Adtitle">Título</label>

                                            <div class="col-md-8">
                                                <input type="text" name="title"
                                                    value="{{ old('title', $service->title) }}"
                                                    class="form-control input-md" placeholder="Título del servicio"
                                                    required>
                                                <span class="help-block">No debe superar los 60 caracteres. </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="textarea">Descripción </label>

                                            <div class="col-md-8">
                                                <textarea name="description" class="form-control" rows="5"
                                                    required>{{ old('description', $service->description) }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="Adtitle">Teléfono</label>

                                            <div class="col-md-8">
                                                <input type="text" name="phone"
                                                    value="{{ old('phone', $service->phone) }}" class="form-control">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox"
                                                            {{ $service->phoneWsp == 'Y' ? 'checked' : '' }}
                                                            name="phoneWsp">
                                                        <small> Habilitado para whatsapp</small>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="textarea"> Imágen </label>

                                            <div class="col-md-8">
                                                <div class="mb10">
                                                    <input id="input-upload-img1" name="photo" type="file" class="file"
                                                        data-preview-file-type="text">
                                                    <small> JPG, GIF o PNG.</small>
                                                </div>
                                                @if ($service->photo)
                                                    <a href="{{ route('service', [$service->slug, $service->ref]) }}">
                                                        <img class="thumbnail  img-responsive"
                                                            src="{{ asset('users/' . $service->user->id . '/service/' . $service->photo) }}"
                                                            alt="{{ $service->name }}">
                                                    </a>
                                                @else
                                                    <a href="{{ route('service', [$service->slug, $service->ref]) }}">
                                                        <img class="img-responsive"
                                                            src="{{ asset('styleWeb/assets/sin_imagen_grande.png') }}"
                                                            alt="{{ $service->name }}">
                                                    </a>
                                                @endif
                                            </div>
                                        </div>


                                        {{-- <div class="well">
                                            <h3><i class=" icon-certificate icon-color-1"></i> Make your Ad Premium
                                            </h3>

                                            <p>Premium ads help sellers promote their product or service by getting
                                                their ads more visibility with more
                                                buyers and sell what they want faster. <a href="help.html">Learn
                                                    more</a></p>

                                            <div class="form-group">
                                                <table class="table table-hover checkboxtable">
                                                    <tr>
                                                        <td>
                                                            <div class="radio">
                                                                <label>
                                                                    <input type="radio" name="optionsRadios"
                                                                        id="optionsRadios0" value="option0" checked>
                                                                    <strong>Regular List </strong> </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <p>$00.00</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="radio">
                                                                <label>
                                                                    <input type="radio" name="optionsRadios"
                                                                        id="optionsRadios1" value="option1">
                                                                    <strong>Urgent Ad </strong> </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <p>$10.00</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="radio">
                                                                <label>
                                                                    <input type="radio" name="optionsRadios"
                                                                        id="optionsRadios2" value="option2">
                                                                    <strong>Top of the Page Ad </strong> </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <p>$20.00</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="radio">
                                                                <label>
                                                                    <input type="radio" name="optionsRadios"
                                                                        id="optionsRadios3" value="option3">
                                                                    <strong>Top of the Page Ad + Urgent Ad </strong>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <p>$40.00</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="col-md-8">
                                                                    <select class="form-control" name="Method"
                                                                        id="PaymentMethod">
                                                                        <option value="2">Select Payment Method</option>
                                                                        <option value="3">Credit / Debit Card</option>
                                                                        <option value="5">Paypal</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <p><strong>Payable Amount : $40.00</strong></p>
                                                        </td>
                                                    </tr>
                                                </table>

                                            </div>
                                        </div> --}}

                                        <div class="form-group">
                                            <label class="col-md-3 control-label"></label>

                                            <div class="col-md-8"><button id="button1id"
                                                    class="btn btn-success btn-lg">Modificar Servicio</button></div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 reg-sidebar">
                    <div class="reg-sidebar-inner text-center">
                        <div class="promo-text-box"><i class=" icon-picture fa fa-4x icon-color-1"></i>

                            <h3><strong>Post a Free Classified</strong></h3>

                            <p> Post your free online classified ads with us. Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit. </p>
                        </div>

                        <div class="panel sidebar-panel">
                            <div class="panel-heading uppercase">
                                <small><strong>How to sell quickly?</strong></small>
                            </div>
                            <div class="panel-content">
                                <div class="panel-body text-left">
                                    <ul class="list-check">
                                        <li> ief title and description of the item</li>
                                        <li> Make sure you post in the correct category</li>
                                        <li> Add nice photos to your ad</li>
                                        <li> Put a reasonable price</li>
                                        <li> Check the item before publish</li>

                                    </ul>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('styleWeb/assets/js/fileinput.min.js') }}" type="text/javascript"></script>
@endsection
