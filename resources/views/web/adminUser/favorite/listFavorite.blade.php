@extends('layouts.main')

@section('content')
    <div class="main-container">
        <div class="container">
            <div class="row">
                @include('web.adminUser.parts._asideMenu')
                <div class="col-sm-9 page-content">
                    <div class="inner-box">
                        <h2 class="title-2"> Servicios Favoritos </h2>

                        <div class="table-responsive">
                            <table id="addManageTable"
                                class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter"
                                data-filter-text-only="true">
                                <thead>
                                    <tr>
                                        <th> Foto</th>
                                        <th data-sort-ignore="true"> Descripción</th>
                                        <th> Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($favorites as $favorite)
                                        <tr>
                                            <td style="width:14%" class="add-img-td">
                                                @if ($favorite->service->photo)
                                                    <a
                                                        href="{{ route('service', [$favorite->service->slug, $favorite->service->ref]) }}">
                                                        <img class="thumbnail  img-responsive"
                                                            src="{{ asset('users/' . $favorite->service->user->id . '/service/' . $favorite->service->photo) }}"
                                                            alt="{{ $favorite->service->name }}">
                                                    </a>
                                                @else
                                                    <a
                                                        href="{{ route('service', [$favorite->service->slug, $favorite->service->ref]) }}">
                                                        <img class="thumbnail  img-responsive"
                                                            src="{{ asset('styleWeb/assets/sin_imagen.jpg') }}"
                                                            alt="{{ $favorite->name }}">
                                                    </a>
                                                @endif
                                            </td>
                                            <td style="width:58%" class="ads-details-td">
                                                <div>
                                                    <p><strong> <a
                                                                href="{{ route('service', [$favorite->service->slug, $favorite->service->ref]) }}"
                                                                title="{{ $favorite->service->name }}">
                                                                {{ $favorite->service->title }}
                                                            </a> </strong></p>

                                                    <p><strong> Actualizado </strong>:
                                                        {{ \Carbon\Carbon::parse($favorite->service->updated_at)->diffForHumans() }}
                                                    </p>

                                                    <p><strong>Visto por </strong>: {{ $favorite->service->visit }} usuarios</p>
                                                    <p><strong>Localidad:</strong> {{ $favorite->service->region->name }}</p>
                                                </div>
                                            </td>
                                            <td style="width:10%" class="action-td">
                                                <div>                                                    
                                                    <p><a class="btn btn-danger btn-xs"
                                                            href="{{ route('favorite.delete', $favorite) }}"> <i
                                                                class=" fa fa-trash"></i> Eliminar
                                                        </a></p>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>
                                                <p>Todavía no agregas ningún servicio como favorito</p>
                                            </td>
                                            <td>
                                            </td>
                                            <td>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!--/.row-box End-->

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
