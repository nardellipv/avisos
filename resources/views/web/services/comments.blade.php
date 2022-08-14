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
                            alt="foto perfil" class="img-responsive">
                        @else
                        <img src="{{ asset('styleWeb/assets/logo.png') }}" class="img-fluid" alt="Logo"
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
                    <label for="email" class="col-form-label">Email</label>
                    <input name="email" type="email" class="form-control" id="email" value="{{ userConnect()->email }}"
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
                <input id="email" type="email" placeholder="Email"
                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email"
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
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="Password" id="password" name="password" required autocomplete="current-password">
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
    @endif
</div>