@extends('layouts.index')

@section('title', 'Artemblog')

@section('content')
    @include('includes.slider')
    <section class="blogs-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-7">
                    <div class="blogs-wrapper">
                        <div class="blog-list-con">
                            @foreach($posts as $post)
                            <!-- item -->
                            <article class="post-standard">
                                <div class="post-content">
                                    <div class="post-standard-header">
                                        <div class="s-p-categories main-color">
                                            <a href="#">Велосипед</a>
                                        </div>
                                        <h2 class="s-post-title effect">
                                            <a href="#">{{ $post->title }}</a>
                                        </h2>
                                        <div class="s-meta-date">
                                            <span>{{ $post->published_at?->format('d.m.Y H:i') }}</span>
                                        </div>
                                    </div>
                                    <div class="post-standard-media">
                                        <figure class="s-post-img">
                                            <a href="#">
                                                <img src="img/blog-post-1.jpg" alt="post-1">
                                            </a>
                                        </figure>
                                    </div>
                                    <div class="post-standard-footer">
                                        <p class="post-excerpt">{{ $post->introtext }}</p>

                                        <div class="c-read-btn">
                                            <a href="#" class="bb-btn main-color-bg">Подробнее</a>
                                        </div>

                                        <div class="s-post-last">
                                            <div class="s-post-author">
                                                <span>
                                                    <i class="fa fa-comments"></i>
                                                    10
                                                </span>
                                                <span>
                                                    <i class="fa fa-eye"></i>
                                                    1001
                                                </span>
                                            </div>
                                            <div class="s-post-share">
                                                <ul>
                                                    <li class="main-color">
                                                        <a href="#" class="effect"><i class="fa fa-facebook"></i></a>
                                                    </li>
                                                    <li class="main-color">
                                                        <a href="#" class="effect"><i class="fa fa-twitter"></i></a>
                                                    </li>
                                                    <li class="main-color">
                                                        <a href="#" class="effect"><i class="fa fa-pinterest-p"></i></a>
                                                    </li>
                                                    <li class="main-color">
                                                        <a href="#" class="effect"><i class="fa fa-google-plus"></i></a>
                                                    </li>
                                                    <li class="main-color">
                                                        <a href="#" class="effect"><i class="fa fa-vine"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <!-- / item -->
                            @endforeach
                        </div>
                        @if ($posts->hasPages())
                            {{ $posts->links('components.pagination') }}
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-md-5">
                    @include('includes.sidebar')
                </div>
            </div>
        </div>
    </section>
@endsection
