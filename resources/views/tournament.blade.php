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
                            <h1 style="font-size: 2em;">{{ $title }}</h1>

                         <div class="ritekhed-rich-editor">
                            {!! $renderer->render($entry->getBeschreibung()) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h2 class="ritekhed-article-options">Termin: {{ $entry->getDatum()->format('d.m.Y') }}</h2>
                    </div>
                    <!-- Content -->
                    @if($entry->getBilder())
                        <div class="col-md-12">
                            <h2>Bildergallerie</h2>
                            <div class="ritekhed-gallery ritekhed-gallery-classic">
                                <ul class="row">
                                    @foreach($entry->getBilder() as $picture)
                                        <li class="col-md-4">
                                            <a data-fancybox-group="group" href="{{ $picture->getFile()->getUrl() }}" class="fancybox"><img src="{{ $picture->getFile()->getUrl($options) }}" alt="{{ $picture->getTitle() }}"></a>
                                            <div class="ritekhed-gallery-classic-text">
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--// Main Section \\-->
@stop