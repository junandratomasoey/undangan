@extends('themes.nikkah.layout')

@section('content')
    @include('themes.nikkah.partials.cover', ['inv' => $inv, 'guestName' => $guestName])

    <main id="content" class="bg-ivory">
        @include('themes.nikkah.partials.opening', ['inv' => $inv])
        @include('themes.nikkah.partials.couple', ['inv' => $inv])

        @if($inv->hasFeature('love_story') && $inv->stories->isNotEmpty())
            @include('themes.nikkah.partials.story', ['inv' => $inv])
        @endif

        @include('themes.nikkah.partials.events', ['inv' => $inv])

        @if($inv->hasFeature('countdown') && $inv->main_event)
            @include('themes.nikkah.partials.countdown', ['event' => $inv->main_event])
        @endif

        @if($inv->hasFeature('map_embed') && $inv->main_event?->hasCoordinates())
            @include('themes.nikkah.partials.location', ['event' => $inv->main_event])
        @endif

        @if($inv->hasFeature('gallery') && $inv->photos->isNotEmpty())
            @include('themes.nikkah.partials.gallery', ['inv' => $inv])
        @endif

        @if($inv->hasFeature('gift') && $inv->giftAccounts->isNotEmpty())
            @include('themes.nikkah.partials.gift', ['inv' => $inv])
        @endif

        @if($inv->hasFeature('rsvp'))
            @include('themes.nikkah.partials.rsvp', ['inv' => $inv, 'guestName' => $guestName])
        @endif

        @if($inv->hasFeature('wishes'))
            @include('themes.nikkah.partials.wishes', ['inv' => $inv])
        @endif

        @include('themes.nikkah.partials.footer', ['inv' => $inv])
    </main>
@endsection
