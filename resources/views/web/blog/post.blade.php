@extends('layouts.main')

@section('content')
<div class="main-container inner-page">
    <div class="container">
        <div class="section-content">
            <div class="row ">
                <div class="col-sm-8 blogLeft">
                    <div class="blog-post-wrapper">
                        <article class="blog-post-item">
                            <div class="inner-box">
                                <!--blog image-->
                                <div class="blog-post-img">
                                    <a href="blog-details.html">
                                        <figure>
                                            <img class="img-responsive" alt="{{ $post->title }}" src="{{ asset('imgBlog/' . $post->photo) }}">
                                        </figure>
                                    </a>
                                </div>
                                <div class="blog-post-content-desc">

                                    <div class="blog-post-content">
                                        <h2><a href="#">{{ $post->title }}</a></h2>
                                        <div class="blog-article-text">
                                            <p>{!! $post->body !!}</p>
                                        </div>
                                    </div>

                                    <div class="clearfix">
                                        <div class="col-md-12  blog-post-bottom">
                                            <div class="sharethis-inline-share-buttons" style="margin: 5% 0% 5% 0%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
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