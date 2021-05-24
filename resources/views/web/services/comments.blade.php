<div class="blog-post-footer">
    <div style="clear: both"></div>

    <div class="inner ">

        <div class="blogs-comments-area">
            <h3 class="list-title"><a href="" class="post-comments">{{ $feedbackCount }} Comentarios</a>
            </h3>

            <div class="blogs-comment-respond" id="respond">
                <ul class="blogs-comment-list">
                    @foreach ($comments as $comment)
                    <li>
                            <div class="blogs-comment-wrapper">
                                <div class="blogs-comment-avatar">
                                    <figure>
                                        @if ($comment->user->photo)
                                            <img src="{{ asset('users/' . $comment->user->id . '/images/120x120-' . $comment->user->photo) }}"
                                                alt="foto perfil" class="img-responsive">
                                        @else
                                            <img src="{{ asset('styleWeb/assets/logo.png') }}" class="img-fluid"
                                                alt="Logo" class="img-responsive">
                                        @endif
                                    </figure>
                                </div>
                                <div class="blogs-comment-details">
                                    <div class="blogs-comment-name">
                                        <a href="#">{{ $comment->user->name }}</a>
                                        <span
                                            class="blogs-comment-date">{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</span>
                                    </div>
                                    <div class="blogs-comment-description">
                                        <p>{{ $comment->comment }}</p>
                                    </div>
                                </div>
                            </div>
                         @endforeach                     
                    </li>
                </ul>


                <h3 class="blogs-comment-reply-title list-title">Dejar un Comentario</h3>

                @if (Auth::check())
                    <form class="blogs-comment-form" id="blogs-commentform" method="post"
                        action="{{ route('comment.store', $service) }}">
                        @csrf
                        <div class="row form-group">
                            <div class="col-md-6"><input class="form-control" type="text" placeholder="Enter your name"
                                    aria-required="true" value="{{ userConnect()->name }}" name="name" readonly></div>
                            <div class="col-md-6 text-left"><span>Nombre*</span></div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6"><input class="form-control" type="text" placeholder="Enter your email"
                                    aria-required="true" value="{{ userConnect()->email }}" name="email" readonly>
                            </div>
                            <div class="col-md-6 text-left"><span>E-mail*</span></div>
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" placeholder="Comentario" name="comment"></textarea>
                        </div>

                        <button type="submit" class="btn-success btn btn-lg"> Enviar
                        </button>
                    </form>
                @else
                    <h4>Necesitas estar logueado para poder comentar</h4>
                    <div class="panel-body">
                        <form role="form" class="loginForm" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="sender-email" class="control-label">Email:</label>

                                <div class="input-icon"><i class="fa fa-envelope fa"></i>
                                    <input id="email" type="email" placeholder="Email"
                                        class="form-control email  @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" name="email" required autocomplete="email">
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label">Password:</label>

                                <div class="input-icon"><i class="icon-lock fa"></i>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Password" id="password" name="password" required
                                        autocomplete="current-password">
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
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
