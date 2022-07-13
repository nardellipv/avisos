@extends('layouts.main')

@section('content')
<section class="content">
    <section class="block">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h2>Contacto</h2>
                    <br>
                    <figure class="with-icon">
                        <i class="fa fa-map-marker"></i>
                        <span>Las Heras, Mendoza, Argentina </span>
                    </figure>
                    <br>
                    <figure class="with-icon">
                        <i class="fa fa-envelope"></i>
                        <a href="#">info@avisosmendoza.com.ar</a>
                    </figure>
                    <figure class="with-icon">
                        <i class="fa fa-facebook"></i>
                        <a href="https://www.facebook.com/avisosmendozaOk">Aviso Mendoza</a>
                    </figure>
                </div>
                <!--end col-md-4-->
                <div class="col-md-8">
                    <h2>Formulario de Contacto</h2>
                    @include('web.alerts.error')
                    <form class="form email" action="{{ route('contactMail') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-form-label required">Nombre</label>
                                    <input name="name" type="text" class="form-control" id="name" placeholder="Nombre" value="{{ old('name') }}" required>
                                </div>
                                <!--end form-group-->
                            </div>
                            <!--end col-md-6-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="col-form-label required">Email</label>
                                    <input name="email" type="email" class="form-control" id="email" placeholder="Email" value="{{ old('email') }}" required>
                                </div>
                                <!--end form-group-->
                            </div>
                            <!--end col-md-6-->
                        </div>
                        <!--end row-->
                        <!--end form-group-->
                        <div class="form-group">
                            <label for="message" class="col-form-label required">Mensaje</label>
                            <textarea name="message-client" id="message" class="form-control" rows="4" placeholder="Mensaje" required>{{ old('message-client') }}</textarea>
                        </div>
                        <div class="form-group">
                            {!! htmlFormSnippet() !!}
                        </div>
                        <!--end form-group-->
                        <button type="submit" class="btn btn-primary float-right">Enviar Mensaje</button>
                    </form>
                    <!--end form-->
                </div>
                <!--end col-md-8 -->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!--end block-->
</section>
@endsection
