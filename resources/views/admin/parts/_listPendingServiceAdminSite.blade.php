<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Pendientes Aprovación</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>Título</th>
                                    <th>Descripción</th>
                                    <th>Motivo</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    @foreach ($servicePending as $servPending)
                                    <form action="{{ route('adminService.active', $servPending) }}" method="POST">
                                        @csrf
                                    <td><a
                                            href="{{ route('adminDashboard.servicePending', [$servPending->slug, $servPending->ref]) }}">
                                            {{ $servPending->title }} </a></td>
                                    <td>{{ Str::limit($servPending->description, 50) }}</td>
                                    <td><input name="motive" type="text"></td>
                                    <td>
                                        <div class="buttons">
                                            <button class="btn btn-icon btn-sm btn-success"><i
                                                    class="fas fa-check"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                </form>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>