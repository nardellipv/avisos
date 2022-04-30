<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Pendientes Aprovación Destacado</h4>
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
                                @foreach ($serviceSponsorPending as $servSponsorPending)
                                <tr>
                                    <form action="{{ route('adminService.sponsorActive', $servSponsorPending->service_id) }}" method="POST">
                                        @csrf
                                        <td><a
                                                href="{{ route('adminDashboard.servicePending', [$servSponsorPending->service->slug, $servSponsorPending->service->ref]) }}">
                                                {{ $servSponsorPending->service->title }} </a></td>
                                        <td>{{ Str::limit($servSponsorPending->service->description, 50) }}</td>
                                        <td><input name="motive" type="text"></td>
                                        <td>
                                            <div class="buttons">
                                                <button class="btn btn-icon btn-sm btn-success"><i
                                                        class="fas fa-check"></i></button>
                                            </div>
                                        </td>
                                    </form>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>