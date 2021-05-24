@extends('layouts.main')

@section('content')
    <div class="intro-inner"  style="margin-top: -3%;">
        <div class="about-intro" style="
                            background:url({{ asset('styleWeb/assets/img/terms.jpg') }}) no-repeat center;
                         background-size:cover;">

            <div class="dtable hw100">
                <div class="dtable-cell hw100">
                    <div class="container text-center">

                        <h3 class="intro-title animated fadeInDown"> Contacto </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="main-container inner-page">
        <div class="container">
            <div class="section-content">
                <div class="row ">
                    <h2 class="text-center title-1"> Contactate con nosotros por cualquier duda que tengas </h2>
                    <hr class="center-block small text-hr">
                </div>
                <div class="container-content">

                    @include('web.alerts.error')

                    <div class="inner-box ">
                        <div class="main-container">
                            <div class="container">
                                <div class="row clearfix">
                                    <div class="col-md-3">
                                        <div class="contact_info">
                                            <h5 class="list-title gray"><strong>Contacto</strong></h5>

                                            <div class="contact-info ">
                                                <div class="address">
                                                    <p>Email: info@avisosmendoza.com.ar</p>

                                                    <p>&nbsp;</p>

                                                    <div>


                                                        <p><strong> <a href="{{ route('login') }}">Área Cliente
                                                                    Login</a></strong></p>

                                                        <p><strong> <a href="#skypeid" class="skype">Preguntas
                                                                    Frecuentes</a></strong></p>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="social-list">
                                                <a target="_blank" href="https://www.facebook.com/"><i
                                                        class="fa fa-facebook fa-lg "></i></a>
                                                <a target="_blank" href="https://plus.google.com"><i
                                                        class="fa fa-instagram fa-lg "></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="contact-form">
                                            <h5 class="list-title gray"><strong>Contacto</strong></h5>


                                            <form class="form-horizontal" action="{{ route('contactMail') }}"
                                                method="post">
                                                @csrf
                                                <fieldset>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                    <input id="firstname" name="name" type="text"
                                                                        placeholder="Nombre" value="{{ old('name') }}" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                    <input id="email" name="email" type="text"
                                                                        placeholder="Email" value="{{ old('email') }}" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                    <textarea class="form-control" id="message"
                                                                        name="message-client"
                                                                        placeholder="Ingresar el mensaje."
                                                                        rows="7">{{ old('message-client') }}</textarea>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="col-md-12 center">
                                                                    {!! htmlFormSnippet() !!}
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="col-md-12 ">
                                                                    <button type="submit"
                                                                        class="btn btn-primary btn-lg btn-block">Enviar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
