<div class="page-title">
    <div class="container">
        <h1 class="opacity-40 center">
            Plataforma de servicios clasificados en Mendoza
        </h1>
    </div>
    <!--end container-->
</div>

<form class="hero-form form" action="{{ route('search') }}" method="POST">
    @csrf
    <div class="container">
        <div class="main-search-form">
            <div class="form-row">

                <div class="col-md-4 col-sm-4">
                    <div class="form-group">
                        <label for="category" class="col-form-label">Ubicación</label>
                        <select id="selectbasic" name="location" data-placeholder="Select Category">
                            <option value="all"> Todas las Regiones</option>
                            <option disabled> --------------------</option>
                            @foreach ($locations as $region)
                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4 col-sm-4">
                    <div class="form-group">
                        <label for="what" class="col-form-label">Servicio</label>
                        <input name="service" type="text" class="form-control" id="what"
                            placeholder="Nombre del Servicio">
                    </div>
                </div>

                <div class="col-md-4 col-sm-4">
                    <button type="submit" class="btn btn-primary width-100">Buscar Servicio</button>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="background">
    <div class="background-image original-size">
        <img src="{{ asset('styleWeb/assets/img/hero-background-icons.jpg') }}" alt="aviso mendoza">
    </div>
    <!--end background-image-->
</div>