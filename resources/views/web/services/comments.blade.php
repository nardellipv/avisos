<section>
    <h2>Comentarios <small>({{ $feedbackCount }})</small></h2>
    @if($feedbackCount == 0)
    <h4 class="text text-center">Se el primero en comentar el servicio</h4>
    @endif
    @foreach ($comments as $comment)
    <div class="comments">
        <div class="comment">
            <div class="author">
                <a href="#" class="author-image">
                    <div class="background-image">
                        @if ($comment->user->photo)
                        <img src="{{ asset('users/' . $comment->user->id . '/images/120x120-' . $comment->user->photo) }}"
                            alt="foto perfil" title="foto perfil" class="img-responsive">
                        @else
                        <img src="{{ asset('styleWeb/assets/logo.png') }}" class="img-fluid" alt="Logo" title="foto perfil"
                            class="img-responsive">
                        @endif
                    </div>
                </a>
                <div class="author-description">
                    <h3>{{ $comment->user->name }}</h3>
                    <div class="meta">
                        <span>{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</span>
                    </div>
                    <p>
                        {{ $comment->comment }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</section>

<h2>Deja tu comentario</h2>
<div class="box">
    @if (Auth::check())
    <form class="form email" method="post" action="{{ route('comment.store', $service) }}">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name" class="col-form-label">Nombre</label>
                    <input name="name" type="text" class="form-control" id="name" value="{{ userConnect()->name }}"
                        readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email_user" class="col-form-label">Email</label>
                    <input name="email" type="email" class="form-control" id="email_user" value="{{ userConnect()->email }}"
                        readonly>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="message" class="col-form-label">Comentario</label>
                    <textarea name="comment" id="message" class="form-control" rows="4"
                        placeholder="Comentario"></textarea>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Enviar Comentario</button>
                </div>
            </div>
        </div>
    </form>
    @else
    <h4 class="text text-center"><mark>Necesitas estar logueado para poder comentar</mark></h4>
    <form role="form" class="loginForm" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="sender-email" class="control-label">Email</label>

            <div class="input-icon">
                <input id="email_login" type="email" placeholder="Email"
                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email"
                    required autocomplete="email" id="email_login">
            </div>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password" id="password_login" class="control-label">Password</label>

            <div class="input-icon">
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="Password" id="password_login" name="password" required autocomplete="current-password">
            </div>
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <input name="submit" class="btn btn-primary  btn-block" value="Ingresar" type="submit">
        </div>
    </form>
    <a href="{{ route('login.google') }}" class="btn btn-light border w-100 d-flex align-items-center justify-content-center px-3 py-2" style="text-decoration: none;">
        <div class="d-flex align-items-center">
            <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google Logo" width="20" style="margin-right: 10px;">
            <span style="font-weight: 500;">Continuar con Google</span>
        </div>
    </a>
    @endif
</div>