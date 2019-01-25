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

                    <div class="col-md-9">
                        @if($entry->getSystemProperties()->getContentType()->getName() == 'News')
                            <div class="ritekhed-rich-editor">
                                <ul class="ritekhed-article-options">
                                    <li><a href="#"><i class="fa fa-user"></i> Webteam</a></li>
                                    <li><a href="#"><i class="fa fa-calendar"></i> {{ $entry->getSystemProperties()->getCreatedAt()->format('d.m.Y') }}</a></li>
                                </ul>
                                <h2>{{ $title }}</h2>
                            </div>
                        @else
                            <h1 style="font-size: 2em;">{{ $title }}</h1>
                        @endif
                        @if(isset($entry->bild) && $entry->getBild()->getTitle() != 'news standard.jpg?w=270&h=270&fit=thumb')
                            <figure class="ritekhed-detail-thumb"><img src="{{ $entry->getBild()->getFile()->getUrl($options) }}" alt="{{ $entry->getBild()->getTitle() }}"></figure>
                        @endif
                            @if(isset($picture))
                                <img src="{{ $picture->getFile()->getUrl($options) }}" alt="Ein Bild">
                            @endif
                        <div class="ritekhed-rich-editor">
                            {!! $renderer->render($entry->getBeschreibung()) !!}
                        </div>
                    </div>
                        <div class="col-md-3">
                            <div class="widget widget_cetagories">
                                <div class="ritekhed-widget-heading"><h2>Infos zum Team</h2></div>
                                <br>
                                <h3>Trainer</h3>
                                @foreach($entry->getTrainer() as $trainer)
                                    <div>
                                        <a href="{{ route('person.show',['id' => $trainer->getSystemProperties()->getId()]) }}">{{ $trainer->getName() }}</a><br>
                                        @if($trainer->getBild())
                                            <img class="img-thumbnail" src="{{ $trainer->getBild()->getFile()->getUrl($options) }}" alt="Bild {{ $trainer->getName() }}">
                                        @endif
                                        <span>{{ $trainer->getTelefon() }}</span><br>
                                        <span>{{ $trainer->getMobil() }}</span><br>
                                        <span><a href="mailto:{{ $trainer->getEMail() }}">{{ $trainer->getEMail() }}</a></span>
                                    </div>
                                @endforeach
                                <br>
                                <h3>Infos</h3>
                                <div>
                                    <a href="{{ $entry->getSpielplan() }}"><span><i class="fa fa-clock"></i> Spielplan</span></a><br>
                                    <a href="{{ $entry->getTabelle() }}"><span><i class="fa fa-table"></i> Tabelle</span></a><br>
                                    <a href="{{ $entry->getErgebnisse() }}"><span><i class="fa fa-flag"></i> Ergebnisse</span></a>
                                </div>
                            </div>
                        </div>
                    <div class="col-md-12">
                        @if($news->count() > 0)

                            <div class="ritekhed-blog ritekhed-blog-grid">
                                <h2>Letzte News</h2>
                                <ul class="row">
                                    @foreach($news as $news_entry)
                                        <li class="col-md-3">
                                            @if($news_entry->getBild())
                                                <figure style="min-height: 262px;"><a href="#"><img src="{{ $news_entry->getBild()->getFile()->getUrl($options) }}" alt="{{ $news_entry->getBild()->getTitle() }}">
                                                        <span class="ritekhed-blog-hover"><i class="fa fa-link ritekhed-bgcolor"></i></span> </a>
                                                </figure>
                                            @endif
                                            <div class="ritekhed-blog-grid-text ritekhed-border-color">
                                                <ul>
                                                    <li><i class="far fa-calendar-alt"></i> {{ $news_entry->getSystemProperties()->getCreatedAt()->format('d.m.Y') }}</li>
                                                </ul>
                                                <h2><a href="{{ route('news.show',['id' => $news_entry->getSystemProperties()->getId()]) }}">{{ $news_entry->getTitel() }}</a></h2>
                                                <p>{{ $news_entry->getVorschau() }}</p>
                                                <a href="#" class="ritekhed-blog-grid-btn ritekhed-bgcolor">Mehr lesen</a>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if($entry->getGalerie())
                            <h2>Bildergallerie</h2>
                            <div class="ritekhed-gallery ritekhed-gallery-classic">
                                <ul class="row">
                                    @foreach($entry->getGalerie() as $picture)
                                        <li class="col-md-4">
                                            <a data-fancybox-group="group" href="{{ $picture->getFile()->getUrl() }}" class="fancybox"><img src="{{ $picture->getFile()->getUrl($options) }}" alt="{{ $picture->getTitle() }}"></a>
                                            <div class="ritekhed-gallery-classic-text">
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <!-- Content -->
                </div>
            </div>
        </div>
    </div>
    <!--// Main Section \\-->
@stop
@section('js')
@parent
    <script src="{{ url('script/fancybox.min.js') }}"></script>
    <script>
        //***************************
        // Fancybox Function
        //***************************
        jQuery(".fancybox").fancybox({
            openEffect  : 'elastic',
            closeEffect : 'elastic',
        });
    </script>
@stop