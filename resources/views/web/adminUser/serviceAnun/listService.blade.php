@extends('layouts.main')

@section('content')
    <div class="main-container">
        <div class="container">
            <div class="row">
                @include('web.adminUser.parts._asideMenu')
                <div class="col-sm-9 page-content">
                    <div class="inner-box">
                        <h2 class="title-2"><i class="icon-heart-1"></i> Servicios Favoritos </h2>

                        <div class="table-responsive">
                            <table id="addManageTable"
                                class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter"
                                data-filter-text-only="true">
                                <thead>
                                    <tr>
                                        <th>Servicio</th>
                                        <th>Descripción</th>
                                        <th>Estado</th>
                                        <th>Vence</th>
                                        <th>Categoría</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($services as $service)
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

                                            <td>{{ $service->status }}</td>
                                            <td>{{ \Carbon\Carbon::parse($service->end_date)->format('d/m/Y') }}</td>
                                            <td>{{ $service->category->name }}</td>

                                            <td style="width:10%" class="action-td">
                                                <p><a class="btn btn-primary btn-xs"
                                                        href="{{ route('service.edit', $service) }}"> <i
                                                            class="fa fa-edit"></i>
                                                        Editar
                                                    </a></p>
                                                <p><a class="btn btn-danger btn-xs"
                                                        href="{{ route('service.delete', $service) }}"> <i
                                                            class=" fa fa-trash"></i> Eliminar
                                                    </a></p>
                                            </td>
                                        </tr>
                                    @endforeach
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
