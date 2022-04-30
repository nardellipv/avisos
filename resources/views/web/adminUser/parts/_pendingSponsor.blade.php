@extends('layouts.main')

@section('content')
<div class="main-container">
    <div class="container">
        <div class="row">
            @include('web.adminUser.parts._asideMenu')
            <div class="col-md-9 page-content">
                <div class="inner-box category-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4><i class="fa fa-info-circle"></i> Para destacar <strong>{{ $service->title }}</strong>
                            </h4>
                            <p><i class="fa fa-chevron-right"></i> Podes ó bien desde el botón de pagar en el mail que
                                te
                                acaba de llegar a <strong>{{ userConnect()->email }}</strong></p>
                            <p><i class="fa fa-chevron-right"></i> ó
                                desde el botón pagar debajo de este texto</p>
                            <h5>
                                Esto te llevará a MercadoPago, luego de haber realizado el pago correspondiente, un
                                administrador
                                activará tu servicio dentro de las siguientes 4hs.
                            </h5>
                        </div>
                    </div>
                </div>
                <!-- /.page-content -->
                <a href="https://mpago.la/2FdkkoF" id="button1id" name="button1id" class="btn btn-success btn-block">
                    Ir a MercadoPago
                </a>
            </div>
        </div>
    </div>
</div>
@endsection