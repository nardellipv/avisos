<footer class="footer">
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <!-- Branding y descripción -->
                <div class="col-md-5">
                    <a href="{{ route('home') }}" class="brand">
                        <img src="{{ asset('styleWeb/assets/logo_chico.png') }}" alt="Avisos Mendoza - Publicá tu servicio gratis" title="Avisos Mendoza - Publicá tu servicio gratis">
                    </a>
                    <p>
                        <strong>Avisos Mendoza</strong> es una plataforma de clasificados gratuita donde cualquier mendocino puede publicar sus servicios u oficios y aumentar su visibilidad en toda la provincia. Ideal para profesionales, emprendedores y empresas locales.
                    </p>
                </div>

                <!-- Navegación -->
                <div class="col-md-3">
                    <h2>Navegación</h2>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <nav>
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('home') }}">Inicio</a></li>
                                    <li><a href="{{ route('terms') }}">Términos y Condiciones</a></li>
                                    <li><a href="{{ route('policy') }}">Política de Privacidad</a></li>
                                    <li><a href="{{ route('contact') }}">Contacto</a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <nav>
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('login') }}">Ingresar</a></li>
                                    <li><a href="{{ route('register') }}">Registrarse</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Contacto -->
                <div class="col-md-4">
                    <h2>Contacto</h2>
                    <address>
                        <figure>
                            Las Heras, Mendoza<br>
                            Argentina
                        </figure>
                        <br>
                        <strong>Email:</strong> <a href="mailto:info@avisosmendoza.com.ar">info@avisosmendoza.com.ar</a>
                        <br><br>
                        <a href="{{ route('contact') }}" class="btn btn-primary text-caps btn-framed">Escribinos un mensaje</a>
                    </address>
                </div>
            </div>

            <!-- Copyright -->
            <div class="text-center mt-4">
                &copy; {{ date('Y') }} <a href="https://mikant.com.ar" target="_blank" rel="noopener">MikAnt</a>
            </div>
        </div>

        <!-- Fondo -->
        <div class="background">
            <div class="background" data-background-color="#fff"></div>
        </div>
    </div>
</footer>
