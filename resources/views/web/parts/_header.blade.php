<div class="dtable hw100">
    <div class="dtable-cell hw100">
        <div class="container text-center">
            <h1 class="intro-title animated fadeInDown"> plataforma de servicios clasificados en mendoza </h1>

            <p class="sub animateme fittext3 animated fadeIn"> Busca y publica todo tipo servicios.
            </p>

            <form action="{{ route('search') }}" method="POST">
                @csrf
                <div class="row search-row animated fadeInUp">
                    <div class="col-lg-4 col-sm-4 search-col relative locationicon">
                        <i class="icon-location-2 icon-append"></i>
                        <select id="selectbasic" name="location"
                            class="form-control locinput input-rel searchtag-input has-icon">
                            <option value="all"> Totas las Regiones</option>
                            <option disabled> ------------------------------------</option>
                            @foreach ($locations as $region)
                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col-lg-4 col-sm-4 search-col relative"><i class="icon-docs icon-append"></i>
                        <input type="text" name="service" class="form-control has-icon" placeholder="Nombre del Servicio">
                    </div>
                    <div class="col-lg-4 col-sm-4 search-col">
                        <button class="btn btn-primary btn-search btn-block"><i class="icon-search"></i><strong>Buscar
                                Servicio</strong></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
