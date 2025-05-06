<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Administración Sitio</h4>
                    </div>
                    <div class="card-body">
                        <div class="buttons flex items-center gap-2">
                            <a href="{{ route('adminDashboard.incrementService') }}"
                                class="btn btn-outline-primary btn-lg">Incrementar Servicios</a>
                            <a href="{{ route('adminService.reactivate') }}"
                                class="btn btn-outline-primary btn-lg">Reactivar Servicios</a>
                            <a href="{{ route('publication.make') }}"
                                class="btn btn-outline-primary btn-lg"
                                onclick="event.preventDefault(); document.getElementById('publicar-form').submit();">
                                Generar Publicación
                            </a>
                            <form id="publicar-form" action="{{ route('publication.make') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                            <a href="{{ route('adminDashboard.sitemap') }}"
                                class="btn btn-outline-secondary btn-lg">Generar Site Map</a>
                        </div>
                        <div class="buttons">
                            <a href="{{ route('exports.exportAllUsers') }}"
                                class="btn btn-icon icon-left btn-warning"><i class="far fa-user"></i> Exportar
                                Todos</a>
                            <a href="{{ route('exports.exportAnnun') }}" class="btn btn-icon icon-left btn-warning"><i
                                    class="far fa-user"></i> Exportar Anunciantes</a>
                            <a href="{{ route('exports.exportClient') }}" class="btn btn-icon icon-left btn-warning"><i
                                    class="far fa-user"></i> Exportar Clientes</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Días Publicación</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('adminDashboard.changeDaysService') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Free</label>
                                    <input type="text" class="form-control" name="publicDays"
                                        value="{{ $publicDays }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Sponsor</label>
                                    <input type="text" class="form-control" name="sponsorDays"
                                        value="{{ $sponsorDays }}">
                                </div>
                                <div class="form-group col-md-6">

                                    <button class="btn btn-primary">Cambiar días Servicios</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
