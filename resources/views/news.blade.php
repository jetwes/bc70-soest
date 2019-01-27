@extends('layouts.master')
@section('title')
    <title>{{ $title }} | BC70 Soest e.V.</title>
@stop

@section('body_class')
    home
@endsection

@section('content')
    <div class="ritekhed-main-content">
        <div class="ritekhed-main-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Blog Grid -->
                        <div class="ritekhed-blog ritekhed-blog-grid">
                            <ul class="row">
                                @if($news->count() >0)
                                    @foreach($news as $news_entry)

                                        <li class="col-md-3">
                                            @if($news_entry->getBild())
                                                <figure style="min-height: 262px;"><a href="{{ route('news.show',['id' => $news_entry->getSlug()]) }}"><img src="{{ $news_entry->getBild()->getFile()->getUrl($options) }}" alt="{{ $news_entry->getBild()->getTitle() }}">
                                                        <span class="ritekhed-blog-hover"><i class="fa fa-link ritekhed-bgcolor"></i></span> </a>
                                                </figure>
                                            @endif
                                            <div class="ritekhed-blog-grid-text ritekhed-border-color">
                                                <ul>
                                                    <li><i class="far fa-calendar-alt"></i> {{ $news_entry->getSystemProperties()->getCreatedAt()->format('d.m.Y') }}</li>
                                                </ul>
                                                <h2><a href="{{ route('news.show',['id' => $news_entry->getSlug()]) }}">{{ $news_entry->getTitel() }}</a></h2>
                                                <p>{{ $news_entry->getVorschau() }}</p>
                                                <a href="{{ route('news.show',['id' => $news_entry->getSlug()]) }}" class="ritekhed-blog-grid-btn ritekhed-bgcolor">Mehr lesen</a>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

