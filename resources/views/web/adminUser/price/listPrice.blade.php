@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        @include('web.adminUser.parts._asideMenu')
        <div class="col-sm-9 page-content">
            <div class="panel sidebar-panel">
                <div class="panel-heading"><i class="icon-lamp"></i> Destacar Servicios</div>
                <div class="panel-content">
                    <div class="panel-body text-left">
                        <h2 class="text text-center text-danger"><strong> $200 </strong> / servicio</h2>
                        <ul class="list-check">
                            <li> Puedes destacar todos los servicios que desees</li>
                            <li> Se promocionan por 60 días</li>
                            <li> Tus servicios se destacan en la página principal</li>
                            <li> Se destacan en la primera posición de los servicios listados</li>
                            <li> La publicación se realiza automáticamente</li>
                            <li> Se comparten en nuestras redes sociales</li>
                        </ul>
                    </div>
                    <h5 class="text text-center">A continuación se muestran tus servicios que puedes destacar.
                    </h5>
                </div>
            </div>
        </div>

        <div class="col-sm-9 page-content">
            <div class="panel sidebar-panel">
                <div class="panel-heading"><i class="fa fa-certificate"></i> Destacar Servicios</div>
                <div class="panel-content">
                    <div class="panel-body text-left">
                        <div class="table-responsive">
                            <table id="addManageTable"
                                class="table table-striped table-bordered add-manage-table table demo"
                                data-filter="#filter" data-filter-text-only="true">
                                <thead>
                                    <tr>
                                        <th> Foto</th>
                                        <th data-sort-ignore="true"> Descripción</th>
                                        <th> Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($serviceSponsor as $service)
                                    <tr>
                                        <td style="width:14%" class="add-img-td">
                                            @if ($service->photo)
                                            <a href="{{ route('service', [$service->slug, $service->ref]) }}">
                                                <img class="thumbnail  img-responsive"
                                                    src="{{ asset('users/' . $service->user->id . '/service/' . $service->photo) }}"
                                                    alt="{{ $service->name }}">
                                            </a>
                                            @else
                                            <a href="{{ route('service', [$service->slug, $service->ref]) }}">
                                                <img class="thumbnail  img-responsive"
                                                    src="{{ asset('styleWeb/assets/sin_imagen.jpg') }}"
                                                    alt="{{ $service->name }}">
                                            </a>
                                            @endif
                                        </td>
                                        <td style="width:58%" class="ads-details-td">
                                            <div>
                                                <p><strong> <a
                                                            href="{{ route('service', [$service->slug, $service->ref]) }}"
                                                            title="{{ $service->name }}">
                                                            {{ $service->title }}
                                                        </a> </strong></p>

                                                <p><strong> Actualizado </strong>:
                                                    {{ \Carbon\Carbon::parse($service->updated_at)->diffForHumans() }}
                                                </p>

                                                <p><strong>Visto por </strong>: {{ $service->visit }} usuarios</p>
                                                <p><strong>Localidad:</strong> {{ $service->region->name }}</p>
                                            </div>
                                        </td>
                                        <td style="width:10%" class="action-td">
                                            <div>
                                                <p>
                                                    @if($service->publish == 'Free')
                                                    <a class="btn btn-warning btn-xs"
                                                        href="{{ route('service.highlight', $service) }}"> <i
                                                            class="fa fa-certificate"></i>
                                                        Destacar
                                                    </a>
                                                    @endif
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td>
                                            <p class="text text-center">Todavía no tienes servicios publicados o activos.</p>
                                            <p class="text text-center">Si tienes servicios pendientes, debes esperar a que un administrador
                                                los apruebe y luego puedes destacarlo.</p>
                                            <a class="btn btn-block btn-border btn-post btn-danger"
                                                href="{{ route('service.create') }}">Publicar Servicio</a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection