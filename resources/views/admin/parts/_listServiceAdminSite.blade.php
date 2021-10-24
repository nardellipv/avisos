<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Últimos Sevicios</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-md">
                                <tr>
                                    <th>Título</th>
                                    <th>Descripción</th>
                                    <th>EMail</th>
                                    <th>Estado</th>
                                    <th>Fecha Fin</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($services as $service)
                                    <tr>
                                        <td>{{ $service->title }}</td>
                                        <td>{{ Str::limit($service->description, 50) }}</td>
                                        <td>{{ $service->user->email }}</td>
                                        <td>{{ $service->status }}</td>
                                        <td>{{ $service->end_date }}</td>
                                        <td>
                                            @if ($service->status == 'Activo')
                                                <div class="buttons">
                                                    <a href="{{ route('adminService.desactive', $service) }}" class="btn btn-icon btn-sm btn-danger"><i
                                                            class="fas fa-times"></i></a>
                                                </div>
                                            @endif
                                            @if ($service->status == 'Pendiente')
                                                <div class="buttons">
                                                    <a href="{{ route('adminService.active', $service) }}" class="btn btn-icon btn-sm btn-success"><i
                                                            class="fas fa-check"></i></a>
                                                </div>
                                            @endif
                                            <div class="buttons">
                                                <a href="{{ route('adminService.delete', $service) }}" class="btn btn-icon btn-sm btn-success"><i
                                                        class="fas fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <nav class="d-inline-block">
                            <ul class="pagination mb-0">
                                {{ $services->render() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
