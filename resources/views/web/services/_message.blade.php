@if (Auth::check())
    <form class="form email" action="{{ route('message.send') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name" class="col-form-label">Nombre</label>
            <input name="name" type="text" class="form-control" id="name" placeholder="Tu Nombre" required
                value="{{ old('name') }}">
            <input name="serviceUser" value="{{ $service->id }}" required readonly hidden>
        </div>
        <div class="form-group">
            <label for="email" class="col-form-label">Email</label>
            <input name="email" type="email" class="form-control" id="email" placeholder="Tu Email" required
                value="{{ old('email', Auth::user()->email) }}">
        </div>
        <div class="form-group">
            <label for="message" class="col-form-label">Mensaje <small>(200)</small></label>
            <textarea name="messageService" id="message" class="form-control" rows="4" placeholder="Tu Mensaje">{{ old('messageService') }}</textarea>
        </div>
        <div class="form-group">
            {!! htmlFormSnippet() !!}
        </div>
        <button type="submit" class="btn btn-primary btn-block">Enviar</button>
    </form>
@else
    <hr>
    <h5 class="text text-center">
        <mark>Necesitas tener una cuenta para contactar al vendedor</mark>
    </h5>
    <form role="form" class="loginForm" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="sender-email" class="control-label">Email</label>
            <div class="input-icon">
                <input id="email" type="email" placeholder="Email"
                    class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                    required autocomplete="email">
            </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password" class="control-label">Password</label>
            <div class="input-icon">
                <input id="password" type="password" placeholder="Password"
                    class="form-control @error('password') is-invalid @enderror" name="password" required
                    autocomplete="current-password">
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <input name="submit" class="btn btn-primary btn-block" value="Ingresar" type="submit">
        </div>
    </form>
    <a href="{{ route('login.google') }}" class="btn btn-light border w-100 d-flex align-items-center justify-content-center px-3 py-2" style="text-decoration: none;">
        <div class="d-flex align-items-center">
            <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google Logo" width="20" style="margin-right: 10px;">
            <span style="font-weight: 500;">Continuar con Google</span>
        </div>
    </a>
@endif
