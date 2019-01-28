@extends('layouts.master')
@section('title')
    <title>{{ $title }} | BC70 Soest e.V.</title>
@stop

@section('description')
    @if($entry->getSystemProperties()->getContentType()->getName() == 'News')
        {{ str_limit($entry->getVorschau(),150) }}
    @endif
    @if($entry->getSystemProperties()->getContentType()->getName() == 'Seite')
        {{ str_limit(strip_tags($renderer->render($entry->getInhalt())), $limit = 150, $end = '...') }}    
    @endif
@stop

@section('body_class')
    home
@endsection

@section('content')
    <div class="ritekhed-main-content">
        <div class="ritekhed-main-section">
            <div class="container">
                <div class="row">

                    <div class="@if($entry->getSystemProperties()->getContentType()->getName() == 'News')col-md-9 @else col-md-12 @endif">
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
                        @if(isset($entry->bild) && $entry->getBild()->getTitle() != 'Bild News Standard')
                            <figure class="ritekhed-detail-thumb"><img src="{{ $entry->getBild()->getFile()->getUrl($options) }}" alt="{{ $entry->getBild()->getTitle() }}"></figure>
                        @endif
                            @if(isset($picture))
                                <img src="{{ $picture->getFile()->getUrl($options) }}" alt="Ein Bild">
                            @endif
                        @if($entry->getTitel() == 'Kontakt')
                            <div class="ritekhed-map">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2479.6832515045476!2d8.093541416438459!3d51.57403997964615!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47b97d2d4683a1ed%3A0xc1cdc151876f0e1d!2sHubertus-Schwartz-Berufskolleg!5e0!3m2!1sde!2sde!4v1548258929455" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                            </div>
                        @endif
                        <div class="ritekhed-rich-editor">
                            {!! $renderer->render($entry->getInhalt()) !!}
                        </div>
                        @if(isset($personen) && $personen->count() > 0)
                                <div class="ritekhed-player ritekhed-player-grid">
                                    <ul class="row">
                                        @foreach($personen as $person)
                                            <li class="col-md-3">
                                                <figure style="min-height: 337px;"><a href="{{ route('person.show',['id' => $person->getSlug()]) }}">
                                                        @if($person->getBild())
                                                            <img src="{{ $person->getBild()->getFile()->getUrl($options) }}" alt="{{ $person->getName() }}">
                                                        @else
                                                            <img src="/extra-images/player-grid-img1.jpg" alt="{{ $person->getName() }}">
                                                            <div style="min-height: 262px;"></div>
                                                        @endif
                                                        <i class="fa fa-link"></i>
                                                    </a><span></span>
                                                </figure>
                                                <div class="ritekhed-player-grid-text">
                                                    <a href="{{ route('person.show',['id' => $person->getSlug()]) }}" class="forward-btn">
                                                        @if(isset($person->position)) {{ $person->getPosition() }}<br> @endif
                                                        @if(isset($person->team))
                                                            @foreach($person->team as $team)
                                                                    {{ $team->getMannschaft() }}<br>
                                                            @endforeach
                                                        @endif
                                                    </a>
                                                    <h5><a href="{{ route('person.show',['id' => $person->getSlug()]) }}">{{ $person->getName() }}</a></h5>
                                                </div>
                                                <ul class="ritekhed-player-grid-social">
                                                    <li><a href="mailto:{{ $person->eMail }}" class="ritekhed-colorhover fa fa-mail-bulk"></a></li>
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                        @endif
                        @if(isset($teams))
                                <div class="ritekhed-player ritekhed-player-grid">
                                    <ul class="row">
                                        @if(isset($teams['senioren'])) 
                                            @foreach($teams['senioren'] as $single_team)
                                            <li class="col-md-3">
                                                <figure style="min-height: 180px;"><a href="{{ route('team.show',['id' => $single_team->getSlug()]) }}">
                                                        @if($single_team->getBild())
                                                            <img src="{{ $single_team->getBild()->getFile()->getUrl($options) }}" alt="{{ $single_team->getMannschaft() }}">
                                                        @else
                                                            <img src="/extra-images/player-grid-img1.jpg" alt="{{ $single_team->getMannschaft() }}">
                                                            <div style="min-height: 180px;"></div>
                                                        @endif
                                                        <i class="fa fa-link"></i>
                                                    </a><span></span>
                                                </figure>
                                                <div class="ritekhed-player-grid-text">
                                                    <a href="{{ route('team.show',['id' => $single_team->getSlug()]) }}" class="forward-btn">                                
                                                    </a>
                                                    <h5><a href="{{ route('team.show',['id' => $single_team->getSlug()]) }}">{{ $single_team->getMannschaft() }}</a></h5>
                                                </div>                                            
                                            </li>
                                            @endforeach
                                            @foreach($teams['junioren'] as $single_team)
                                            <li class="col-md-3">
                                                <figure style="min-height: 180px;"><a href="{{ route('team.show',['id' => $single_team->getSlug()]) }}">
                                                        @if($single_team->getBild())
                                                            <img src="{{ $single_team->getBild()->getFile()->getUrl($options) }}" alt="{{ $single_team->getMannschaft() }}">
                                                        @else
                                                            <img src="/extra-images/player-grid-img1.jpg" alt="{{ $single_team->getMannschaft() }}">
                                                            <div style="min-height: 180px;"></div>
                                                        @endif
                                                        <i class="fa fa-link"></i>
                                                    </a><span></span>
                                                </figure>
                                                <div class="ritekhed-player-grid-text">
                                                    <a href="{{ route('team.show',['id' => $single_team->getSlug()]) }}" class="forward-btn">                                
                                                    </a>
                                                    <h5><a href="{{ route('team.show',['id' => $single_team->getSlug()]) }}">{{ $single_team->getMannschaft() }}</a></h5>
                                                </div>                                            
                                            </li>
                                            @endforeach
                                        @else
                                            @foreach($teams as $single_team)
                                            <li class="col-md-3">
                                                <figure style="min-height: 337px;"><a href="{{ route('team.show',['id' => $single_team->getSlug()]) }}">
                                                        @if($single_team->getBild())
                                                            <img src="{{ $single_team->getBild()->getFile()->getUrl($options) }}" alt="{{ $single_team->getMannschaft() }}">
                                                        @else
                                                            <img src="/extra-images/player-grid-img1.jpg" alt="{{ $single_team->getMannschaft() }}">
                                                            <div style="min-height: 262px;"></div>
                                                        @endif
                                                        <i class="fa fa-link"></i>
                                                    </a><span></span>
                                                </figure>
                                                <div class="ritekhed-player-grid-text">
                                                    <a href="{{ route('team.show',['id' => $single_team->getSlug()]) }}" class="forward-btn">                                
                                                    </a>
                                                    <h5><a href="{{ route('team.show',['id' => $single_team->getSlug()]) }}">{{ $single_team->getMannschaft() }}</a></h5>
                                                </div>                                            
                                            </li>
                                            @endforeach
                                        @endif
                                    
                                    </ul>
                                </div>
                        @endif

                    </div>
                    @if($entry->getSystemProperties()->getContentType()->getName() == 'News' && ($entry->getVerknpfung()))
                        <div class="col-md-3">
                            <div class="widget widget_cetagories">
                                <div class="ritekhed-widget-heading"><h2>Zum Team</h2></div>
                                    <a href="{{ route('team.show',['id' =>  $entry->getVerknpfung()->getSlug()]) }}">{{ $entry->getVerknpfung()->getMannschaft() }}</a><br>
                                    <br>
                                <h3>Trainer</h3>
                                @foreach($entry->getVerknpfung()->getTrainer() as $trainer)
                                    <a href="{{ route('person.show',['id' => $trainer->getSlug()]) }}">{{ $trainer->getName() }}</a><br>
                                @endforeach                                
                            </div>
                        </div>
                    @endif
                    <!-- Content -->

                </div>
            </div>
        </div>
    </div>
    <!--// Main Section \\-->
@stop