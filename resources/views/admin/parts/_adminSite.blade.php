<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Administración Sitio</h4>
                    </div>
                    <div class="card-body">
                        <div class="buttons">
                            <a href="{{ route('adminDashboard.incrementService') }}"
                                class="btn btn-outline-primary btn-lg">Incrementar Servicios</a>
                            <a href="{{ route('adminService.reactivate') }}"
                                class="btn btn-outline-primary btn-lg">Reactivar Servicios</a>
                            <a href="{{ route('adminDashboard.sitemap') }}"
                                class="btn btn-outline-secondary btn-lg">Generar
                                Site Map</a>
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
                                  <label for="inputEmail4">Email</label>
                                  <input type="text" class="form-control" name="publicDays" value="{{ $publicDays }}">
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="inputPassword4">Password</label>
                                  <input type="text" class="form-control" name="sponsorDays" value="{{ $sponsorDays }}">
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