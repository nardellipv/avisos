<div class="footer" id="footer">
    <div class="container">
        <ul class=" pull-left navbar-link footer-nav">
            <li>
                <a href="{{ route('home') }}"> Home </a> 
                {{--  <a href="about-us.html"> About us </a>  --}}
                <a href="{{ route('terms') }}">Terminos y Condiciones </a>
                <a href="{{ route('policy') }}"> Politicas de Privacidad </a>
                <a href="{{ route('contact') }}"> Contacto </a> 
                {{--  <a href="faq.html"> FAQ </a>  --}}
            </li>
        </ul>
        <ul class=" pull-right navbar-link footer-nav">
            <li> &copy; {{ date('Y') }} <a href="https://mikant.com.ar" target="_blank">MikAnt</a></li>
        </ul>
    </div>
</div>