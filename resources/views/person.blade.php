@extends('layouts.master')
@section('title')
    <title>{{ $entry->getName() }} | BC70 Soest e.V.</title>
@stop

@section('body_class')
    home
@endsection
@section('content')
    <div class="ritekhed-main-content">

        <!-- Main Section -->
        <div class="ritekhed-main-section ritekhed-player-thumb">
            <span class="thumb-transparent"></span>

            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <div class="ritekhed-player-thumb-wrap">
                            <figure>
                                @if($entry->getBild())
                                    <img src="{{ $entry->getBild()->getFile()->getUrl($options) }}" alt="{{ $entry->getName() }}">
                                @else
                                    <img src="/extra-images/player-text-img.png" alt="Bild Platzhalte {{ $entry->getName() }}">
                                @endif
                            </figure>
                            <div class="ritekhed-player-thumb-text">
                                <h3>{{ explode(' ',$entry->getName())[0] }} <br><span> {{ explode(' ',$entry->getName())[1] }}</span></h3>
                                <ul class="ritekhed-player-info">
                                    @if($entry->position)
                                        <li>
                                            <h5>Position</h5>
                                            <span>{{ $entry->position }}</span>
                                        </li>
                                    @endif
                                    @foreach($entry->team as $team)
                                    <li>
                                        <h5>Team</h5>
                                        <a href="{{ route('team.show',['id' => $team->getSlug()]) }}"><span>{{ $team->getMannschaft() }}</span></a>
                                    </li>
                                    @endforeach
                                        @if($entry->getTelefon())
                                            <li>
                                                <h5>Telefon</h5>
                                                <span>{{ $entry->getTelefon() }}</span>
                                            </li>
                                        @endif
                                        @if($entry->getMobil())
                                            <li>
                                                <h5>Mobil</h5>
                                                <span>{{ $entry->getMobil() }}</span>
                                            </li>
                                        @endif
                                        @if($entry->getEMail())
                                            <li>
                                                <h5>E-Mail</h5>
                                                <span>{{ $entry->getEMail() }}</span>
                                            </li>
                                        @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Main Section -->
    </div>
@stop