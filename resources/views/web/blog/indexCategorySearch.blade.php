@extends('layouts.main')

@section('content')
<div class="intro jobs-intro hasOverly"
    style="background-image: url({{ asset('styleWeb/assets/ciudad.jpg') }}); background-position: center center;margin-top: -7%;">
    <div class="dtable hw100">
        <div class="dtable-cell hw100">
            <div class="container text-center">
                <h1 class="intro-title animated fadeInDown"> Avisos Mendoza Blog </h1>

                <p class="sub animateme fittext3 animated fadeIn"> Suscribite y recibí las últimas novedades en tu
                    email.
                </p>

                <form action="{{ route('newsLetter.addEmail') }}" method="POST">
                    @csrf
                    <div class="row search-row animated fadeInUp">
                        <div class="col-lg-4 col-sm-4 search-col relative locationicon">
                            <input type="text" name="name" 
                                   class="form-control locinput input-rel searchtag-input"
                                   placeholder="Nombre" value="{{ old('name') }}" required>

                        </div>
                        <div class="col-lg-4 col-sm-4 search-col relative">
                            <input type="email" name="email" class="form-control"
                                   placeholder="EMail" value="{{ old('email') }}" required>
                        </div>
                        <div class="col-lg-4 col-sm-4 search-col">
                            <button class="btn btn-primary btn-search btn-block"><i
                                    class="icon-search"></i><strong>Suscribirme</strong></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="main-container inner-page">
    <div class="container">
        <div class="section-content">
            <div class="row ">
                <div class="col-sm-8 blogLeft">
                    <div class="blog-post-wrapper">
                        @include('web.alerts.error')
                        <h2>Filtrado por: <b>{{ $category->name }}</b></h2>
                        @foreach ($posts as $post)
                        <article class="blog-post-item">
                            <div class="inner-box">
                                <div class="blog-post-img">
                                    <a href="{{ route('blog.post', $post->slug) }}">
                                        <figure>
                                            <img class="img-responsive" alt="blog-post image" src="{{ $post->photo }}">
                                        </figure>
                                    </a>
                                </div>
                                <div class="blog-post-content-desc">

                                    <div class="blog-post-content">
                                        <h2><a href="{{ route('blog.post', $post->slug) }}">{{ $post->title }}</a></h2>

                                        <p>{!! Str::limit($post->body, 300) !!}</p>

                                        <div class="row">
                                            <div class="col-md-12 clearfix blog-post-bottom">
                                                <a class="btn btn-primary  pull-left" href="{{ route('blog.post', $post->slug) }}">More
                                                    info</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                        @endforeach
                    </div>
                    <div class="pagination-bar text-center">
                        <ul class="pagination">
                            {{ $posts->render() }}
                        </ul>
                    </div>
                </div>

                <div class="col-sm-4 blogRight page-sidebar">
                    @include('web.blog._asideBlog')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection