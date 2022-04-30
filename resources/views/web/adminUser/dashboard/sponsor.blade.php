@if($countService >= 1 AND userConnect()->type == 'Anunciante' AND $countServiceSponsor <= 0)
<div class="inner-box">
    {{--  <img id="sponsorImage" src="{{ asset('styleWeb/assets/img/sponsorAdmin.png') }}">  --}}
    <div class="text-center">
        <a href="{{ route('info.highlight') }}" 
            name="button2id" class="btn btn-warning btn-post">Destaca tus Servicios
        </a>
        <hr>
        <h5>Podes destacar tus servicios para que más posibles clientes puedan ver tus servicios.</h5>
        {{--  <h5>Tus servicios se muestran en primer lugar en los listados.</h5>
        <h5>Se publican el doble del tiempo de un servicio Free.</h5>  --}}
    </div>
</div>
@endif