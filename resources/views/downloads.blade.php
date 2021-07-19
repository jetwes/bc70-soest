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
                        <h1>Downloads</h1>
                        <h2>Wir stellen euch hier einige wichtige Dokumente als Download zur Verfügung.</h2>
                        <div class="ritekhed-fixture ritekhed-fixture-list">
                            <ul class="row">
                                @foreach($downloads as $entry)
                                    <li class="col-md-4">
                                        <div class="ritekhed-fixture-wrap">
                                            <div class="ritekhed-teams-match">

                                            </div>
                                            <div class="ritekhed-buy-ticket">
                                                <div class="ritekhed-buy-ticket-text">
                                                    <h5 href="{{ $entry->getDatei()->getFile()->getUrl() }}">{{ $entry->getTitel() }}</h5>
                                                    <time datetime="{{ $entry->getSystemProperties()->getCreatedAt()->format('d.m.Y') }}">{{ $entry->getSystemProperties()->getCreatedAt()->format('d.m.Y') }}</time>
                                                </div>
                                                <a href="{{ $entry->getDatei()->getFile()->getUrl() }}" title="{{ $entry->getTitel() }}" class="ticket-buy-btn">Download</a>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--// Main Section \\-->
@stop
