<footer class="footer">
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <a href="#" class="brand">
                        <img src="{{ asset('styleWeb/assets/logo_chico.png') }}" alt="logo avisos mendoza" title="logo avisos mendoza">
                    </a>
                    <p>
                        Avisos Mendoza es un sitio para que todo mendocino que ofrezca un servicio pueda tener mayor visibilidad dentro de la provincia 
                        y totalmente gratis.
                    </p>
                </div>
                <div class="col-md-3">
                    <h2>Navegación</h2>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <nav>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="{{ route('home') }}">Inicio</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('terms') }}">Términos y Condiciones</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('policy') }}">Politicas de Privacidad</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('contact') }}">Contacto</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <nav>
                                <ul class="list-unstyled">                                    
                                    <li>
                                        <a href="{{ route('login') }}">Ingresar</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('register') }}">Registrarse</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h2>Contacto</h2>
                    <address>
                        <figure>
                            Las Heras, Mendoza<br>
                            Argentina
                        </figure>
                        <br>
                        <strong>Email:</strong> <a href="#">info@avisosmendoza.com.ar</a>
                        <br>
                        <br>
                        <br>
                        <a href="{{ route('contact') }}" class="btn btn-primary text-caps btn-framed">Contactenos</a>
                    </address>
                </div>
            </div>
            &copy; {{ date('Y') }} <a href="https://mikant.com.ar" target="_blank">MikAnt</a>
        </div>
        <div class="background">
            <div class="background" data-background-color="#fff"></div>
        </div>
    </div>
</footer>