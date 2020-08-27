<?php
/**
 * @var $news
 * @var $termine
 * @var $options
 */
?>
@extends('layouts.master')
@section('body_class')
    home
@endsection

@section('css')
    @parent
    <style>
        .ritekhed-testimonial-slider p:before {
            content: none;
        }
    </style>
@stop
@section('content')
    <!-- Banner -->
    <div class="ritekhed-banner">
        <div class="ritekhed-banner-layer">
            <span class="ritekhed-banner-transparent" style="background: none !important;"></span>
            <img src="/images/mock.jpg" width="100%" alt="">
            <div class="ritekhed-banner-caption">
                <div class="container">
                    <h1 style="margin-left: 25%;"><strong class="ritekhed-color">Gemeinsam</strong> erfolgreich, <strong class="ritekhed-color">Gemeinsam</strong> stark!</h1>
                    <div class="clearfix"></div>
                    <p>Wir hoffen, Soest zu einem immer stärkeren Basketballstandort machen zu können und den Spielern unseres Vereins, Training auf hohem Niveau, mit trotzdem sehr familiärem Charakter zu ermöglichen.</p>
                    <div class="clearfix"></div>
                    <a href="{{ route('verein') }}" class="ritekhed-border-color ritekhed-color ritekhed-bgcolorhover ritekhed-colorhover-two">Mehr erfahren</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner -->

    <!-- Content -->
    <div class="ritekhed-main-content">

        <!-- Main Section -->
        <div class="ritekhed-main-section ritekhed-fixture-table-slider-full">
            <div class="container-fluid">
                <div class="row">

                    <!-- Fixture Table List -->
                    <div class="ritekhed-fixture-table-slider">
                        @foreach($termine as $termin)
                            <div class="ritekhed-fixture-table-slider-layer">
                                <time class="ritekhed-bgcolor-two" datetime="{{ $termin->datum }}">{{ $termin->datum->format('d.m.Y H:i') }}</time>
                                <ul class="ritekhed-bgcolor">
                                    <li>{{ $termin->ort }}</li>
                                    <li class="ritekhed-fixture-addtext">{{ $termin->titel }}</li>
                                </ul>
                            </div>
                        @endforeach
                    </div>
                    <!-- Fixture Table List -->
                </div>
            </div>
        </div>
        <!-- Main Section -->

        <!-- Main Section -->
        <div class="ritekhed-main-section">
            <div class="container">
                <!-- Blog's -->

                <!-- Blog's -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="ritekhed-fancy-title"> <h2>Letzte News</h2> </div>
                        <!-- Blog Grid -->
                        <div class="ritekhed-blog ritekhed-blog-grid">
                            <ul class="row draggable">
                                @foreach($news as $news_item)
                                    <li class="col-md-3">
                                        <figure style="min-height: 262px;"><a href="{{ route('news.show',['id' => $news_item->getSlug()]) }}"><img src="{{ $news_item->getBild()->getFile()->getUrl($options) }}" alt=""> <span class="ritekhed-blog-hover"><i class="fa fa-link ritekhed-bgcolor"></i></span> </a></figure>
                                        <div class="ritekhed-blog-grid-text ritekhed-border-color" style="min-height: 320px;">
                                            <ul>
                                                <li><i class="far fa-user"></i> <a href="#">Webteam</a></li>
                                                <li><i class="far fa-calendar-alt"></i> {{ $news_item->getSystemProperties()->getCreatedAt()->format('d.m.Y') }}</li>
                                            </ul>
                                            <h2><a href="{{ route('news.show',['id' => $news_item->getSlug()]) }}">{{ $news_item->titel }}</a></h2>
                                            <p>@markdown($news_item->vorschau)</p>
                                            <a href="{{ route('news.show',['id' => $news_item->getSlug()]) }}" class="ritekhed-blog-grid-btn ritekhed-bgcolor">Mehr lesen</a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Blog Grid -->
                    </div>

                    <!-- Partners -->
                    <div class="col-md-12">
                        <div class="ritekhed-partner-slider">
                            @foreach($sponsoren as $sponsor)
                                <div class="ritekhed-partner-slider-layer">

                                        @if($sponsor->getWebsite() != '')
                                            <a title="{{ $sponsor->titel }}" href="{{ $sponsor->getWebsite() }}"><img src="{{ $sponsor->getBanner()->getFile()->getUrl($options) }}" alt="{{ $sponsor->titel }}"></a>
                                        @else
                                            <img src="{{ $sponsor->getBanner()->getFile()->getUrl($options) }}" style="min-height: 150px;" alt="{{ $sponsor->titel }}">
                                        @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Partners -->

                </div>
            </div>
        </div>
        <!-- Main Section -->

        <!-- Main Section -->
        <div class="ritekhed-main-section">
            <div class="container">
                <div class="row">

                    <!-- Result -->
                    <div class="@if($startseite->bildAktionStartseite) col-md-6 @else col-md-12 @endif">
                        <div class="ritekhed-classic-heading">
                            <h2>Nächstes Turnier</h2>
                        </div>
                        <div class="ritekhed-nextmatch">
                            <ul class="ritekhed-team-matches">
                                <li>
                                    <a href="#"><img src="/extra-images/next-match-1.png" alt=""> <span></span></a>
                                </li>
                                <li><small>Termin</small>
                                    <time class="ritekhed-color" datetime="">31.08.2019 - 01.09.2019</time> <small></small></li>
                                <li>
                                    <a href="#"><img src="/extra-images/next-match-2.png" alt=""> <span></span></a>
                                </li>
                            </ul>
                            <div id="ritekhed-match-countdown" class="ritekhed-match-countdown"></div>
                            <a href="#" class="ritekhed-ticket-button ritekhed-bgcolor">Wappen von Soest 2019</a>
                        </div>
                    </div>
                    <!-- Result -->

                    <!-- Result -->
                    @if($startseite->bildAktionStartseite)
                    <div class="col-md-6">
                        <div class="ritekhed-classic-heading">
                            <h2>Aktuelle Aktion</h2>
                        </div>
                        <div class="ritekhed-latest-result-wrap">
                            <div class="ritekhed-latest-result">
                                <a href="{{ $startseite->getlinkAktionStartseite() }}"><img alt="Aktuelle Aktion" src="{{ $startseite->getBildAktionStartseite()->getFile()->getUrl($options) }}"></a>
                            </div>
                        </div>
                    </div>
                    @endif
                    <!-- Result -->



                </div>
            </div>
        </div>
        <!-- Main Section -->

        <!-- Main Section -->
        <div class="ritekhed-fancy-title">
            <h2 style="text-align: center; font-size: 2em; margin-bottom: 0; margin-top: 30px;">Wir bedanken uns herzlich bei unseren Sponsoren!</h2>
        </div>
        <div class="ritekhed-main-section ritekhed-testimonial-slider-full" style="margin-top: 10px !important;">
            <span class="ritekhed-banner-transparent"></span>
            <div class="container">
                <div class="row">
                    <!-- Testimonial -->
                    <div class="col-md-12">
                        <div class="ritekhed-testimonial-slider">

                            @foreach($sponsoren as $sponsor)
                                <div class="ritekhed-testimonial-slider-layer">
                                    <p style="padding: 5px;">
                                        @if($sponsor->getWebsite() != '')
                                            <a title="{{ $sponsor->titel }}" href="{{ $sponsor->getWebsite() }}"><img src="{{ $sponsor->getBanner()->getFile()->getUrl($options) }}" style="min-height: 150px;" alt="{{ $sponsor->titel }}"></a>
                                        @else
                                            <img src="{{ $sponsor->getBanner()->getFile()->getUrl($options) }}" style="min-height: 150px;" alt="{{ $sponsor->titel }}">
                                        @endif
                                    </p>
                                    <div class="clearfix"></div>
                                </div>
                            @endforeach
                            <!--<div class="ritekhed-testimonial-slider-layer">
                                <p>Lorem ipsum dolor sit amet, consectet adipiscing elit. Vestibulum a nunc du rabitur dignissim luctus nisi id eu Morbi ePPPPt arcu dui. Proin pel Donec tincidunt</p>
                                <div class="clearfix"></div>
                                <a href="#" class="ritekhed-testimonial-slider-thumb"><img src="/extra-images/testimonial-img1.jpg" alt=""></a>
                                <div class="ritekhed-testimonial-slider-text">
                                    <h5>Julia Ann</h5>
                                    <span>Ceo</span>
                                </div>
                            </div>-->
                        </div>
                    </div>
                    <!-- Testimonial -->

                </div>
            </div>
        </div>
        <!-- Main Section -->

        <!-- Main Section -->
        <div class="ritekhed-main-section ritekhed-player-grid-full">
            <div class="container">
                <div class="row">

                    <!-- Team -->
                    <div class="col-md-12">
                        <div class="ritekhed-fancy-title"> <h2>Der Vorstand des BC70 Soest</h2> </div>
                        <div class="ritekhed-player ritekhed-player-grid">
                            <ul class="row">
                                @foreach($vorstand as $single_vorstand)
                                    @if($single_vorstand->getBild())
                                    <li class="col-md-3">
                                        <figure style="max-height: 220px;" ><a href="{{ route('person.show',['id' => $single_vorstand->getSlug()]) }}">
                                                    <img src="{{ $single_vorstand->getBild()->getFile()->getUrl() }}" alt="{{ $single_vorstand->name }}">
                                                    <i class="fa fa-link"></i></a><span></span></figure>
                                        <div class="ritekhed-player-grid-text">
                                            <a href="{{ route('person.show',['id' => $single_vorstand->getSlug()]) }}" class="forward-btn">{{ $single_vorstand->getPosition() }}</a>
                                            <h5><a href="{{ route('person.show',['id' => $single_vorstand->getSlug()]) }}">{{ $single_vorstand->name }}</a></h5>
                                            <p></p>
                                        </div>
                                        <ul class="ritekhed-player-grid-social">
                                            <li><a href="mailto:{{ $single_vorstand->eMail }}" class="ritekhed-colorhover fa fa-mail-bulk"></a></li>
                                        </ul>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- Team -->

                </div>
            </div>
        </div>
        <!-- Main Section -->

        <!-- Main Section -->
        <div class="ritekhed-main-section ritekhed-shop-grid-full">
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <div class="ritekhed-fancy-title"> <h2>BC70 Vereinskollektion</h2> </div>
                        <!-- Shop Grid -->
                        <div class="ritekhed-shop ritekhed-shop-grid">
                            <ul class="row">
                                <li class="col-md-3">
                                    <figure><a href="https://www.basketballdirekt.de/basics-bc-soest-hoodie-unisex-714826.html"><img src="/images/Hoodie-BC-Soest.jpg" alt="BC70 Hoodie"></a></figure>
                                    <div class="ritekhed-shop-grid-text">
                                        <h2><a href="https://www.basketballdirekt.de/basics-bc-soest-hoodie-unisex-714826.html">BC70 Hoodie</a></h2>
                                        <span class="price-cart"><del></del> €24.95</span>
                                        <p>80% Baumwolle/20% Polyester</p>
                                    </div>
                                </li>
                                <li class="col-md-3">
                                    <figure><a href="https://www.basketballdirekt.de/basics-bc-soest-t-shirt-unisex-714854.html"><img src="/images/T-Shirt-I-Love-BC.jpg" alt="T Shirt I love BC70 grau"></a></figure>
                                    <div class="ritekhed-shop-grid-text">
                                        <h2><a href="https://www.basketballdirekt.de/basics-bc-soest-t-shirt-unisex-714854.html">I love BC70 Shirt</a></h2>
                                        <span class="price-cart"><del></del> €14.95</span>
                                        <p>Baumwoll-Shirt mit großem I Love BC70 Motiv auf der Brust.
                                        </p>
                                    </div>
                                </li>
                                <li class="col-md-3">
                                    <figure><a href="https://www.basketballdirekt.de/basics-bc-soest-funktionsshirt-damen-damen-714837.html"><img src="https://cdn.basketballdirekt.de/full/BSJC005BCSO-weiss.jpg" alt="Damen Funktionsshirt"></a></figure>
                                    <div class="ritekhed-shop-grid-text">
                                        <h2><a href="https://www.basketballdirekt.de/basics-bc-soest-funktionsshirt-damen-damen-714837.html">Damen Funktionsshirt</a></h2>
                                        <span class="price-cart"><del></del> €14.95</span>
                                        <p>Damen Shirt aus mit großem Vereinsmotiv auf der Brust.
                                        </p>
                                    </div>
                                </li><li class="col-md-3">
                                    <figure><a href="https://www.basketballdirekt.de/spalding-bc-soest-move-shooting-shirt-ls-unisex-714896.html"><img src="https://cdn.basketballdirekt.de/full/SP3002142BCSO-01.jpg" alt="Shooting-Shirt"></a></figure>
                                    <div class="ritekhed-shop-grid-text">
                                        <h2><a href="https://www.basketballdirekt.de/spalding-bc-soest-move-shooting-shirt-ls-unisex-714896.html">Shooting Shirt</a></h2>
                                        <span class="price-cart"><del></del> €22.95</span>
                                        <p>Basketball Shootingshirt mit V-Ausschnitt im offiziellen BC Soest Layout.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- Shop Grid -->
                    </div>

                </div>
            </div>
        </div>
        <!-- Main Section -->

    </div>
    <!-- Content -->
@endsection
@section('js')
    @parent
    <script src="{{ url('script/slick.slider.min.js') }}"></script>
    <script src="{{ url('script/fancybox.min.js') }}"></script>
    <script src="{{ url('script/isotope.min.js') }}"></script>
    <script src="{{ url('script/progressbar.js') }}"></script>
    <script src="{{ url('script/counter.js') }}"></script>
    <script src="{{ url('script/jquery.countdown.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script src="{{ url('script/functions.js') }}"></script>
@stop
