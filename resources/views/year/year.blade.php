@extends('layout.main')

@section('title')
    Année {{ $year }}
@stop

@section('content')

    <h2 style="text-align: center">Année {{ $year }}</h2>
    <hr>

    @foreach($months as $key => $postTab)
        <?php
        setlocale(LC_ALL, 'fr_FR', 'fra_fra');
        $timestamp = strtotime($key.'15');
        $date = utf8_encode(ucfirst(strftime('%B %Y', $timestamp)));
        ?>
        <div class="panel panel-primary-green">
            <div class="panel-heading-green">
                <h3 class="panel-title">
                    <span class="glyphicon glyphicon-circle-arrow-right"></span><b> {{ $date }} </b>
                </h3>
            </div>
            <div class="panel-body">
                @foreach($postTab as $post)
                    @if($post->type == 'article')
                        @include('posts.articles.article')
                    @endif

                    @if($post->type == 'photo')
                        @include('posts.articles_photo.article_photo')
                    @endif

                    @if($post->type == 'video')
                        @include('posts.articles_video.article_video')
                    @endif
                @endforeach
            </div>
        </div>
    @endforeach

@stop