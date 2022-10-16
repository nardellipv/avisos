@extends('layouts.mainAdminSite')

@section('css')
<link rel="stylesheet" href="{{ asset('admin/assets/bundles/datatables/datatables.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('admin/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Servicios Publicados</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>Título</th>
                                        <th>Descripción</th>
                                        <th>EMail</th>
                                        <th>Estado</th>
                                        <th>Fecha Fin</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($services as $service)
                                    <tr>
                                        <td><a href="{{ route('adminService.edit', $service) }}">{{ $service->title }}</a></td>
                                        <td>{{ Str::limit($service->description, 50) }}</td>
                                        <td>{{ $service->user->email }}</td>
                                        <td>{{ $service->status }}</td>
                                        <td>{{ $service->end_date }}</td>
                                        <td>
                                            @if ($service->status == 'Activo')
                                            <div class="buttons">
                                                <a href="{{ route('adminService.desactive', $service) }}"
                                                    class="btn btn-icon btn-sm btn-danger"><i
                                                        class="fas fa-times"></i></a>
                                            </div>
                                            @endif
                                            @if ($service->status == 'Pendiente')
                                            <div class="buttons">
                                                <a href="{{ route('adminService.active', $service) }}"
                                                    class="btn btn-icon btn-sm btn-success"><i
                                                        class="fas fa-check"></i></a>
                                            </div>
                                            @endif
                                            <div class="buttons">
                                                <a href="{{ route('adminService.delete', $service) }}"
                                                    class="btn btn-icon btn-sm btn-success"><i
                                                        class="fas fa-trash"></i></a>
                                            </div>                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
<script src="{{ asset('admin/assets/bundles/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('admin/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
</script>
<script src="{{ asset('admin/assets/js/page/datatables.js') }}"></script>
@endsection