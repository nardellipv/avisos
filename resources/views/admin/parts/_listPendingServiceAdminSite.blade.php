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
                                    <th>Estado</th>
                                    <th>Fecha Fin</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($servicePending as $servPending)
                                    <tr>
                                        <td>{{ $servPending->title }}</td>
                                        <td>{{ Str::limit($servPending->description, 50) }}</td>
                                        <td>{{ $servPending->status }}</td>
                                        <td>{{ $servPending->end_date }}</td>
                                        <td>
                                            <div class="buttons">
                                                <a href="{{ route('adminService.active', $servPending) }}" class="btn btn-icon btn-sm btn-success"><i
                                                        class="fas fa-check"></i></a>
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
