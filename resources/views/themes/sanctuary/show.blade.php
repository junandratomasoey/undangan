@extends('themes.sanctuary.layout')

@section('content')
    @include('themes.sanctuary.partials.cover', ['inv' => $inv, 'guestName' => $guestName])

    <main id="content" class="bg-ivory">
        @include('themes.sanctuary.partials.opening', ['inv' => $inv])
        @include('themes.sanctuary.partials.couple', ['inv' => $inv])

        @if($inv->hasFeature('love_story') && $inv->stories->isNotEmpty())
            @include('themes.sanctuary.partials.story', ['inv' => $inv])
        @endif

        @include('themes.sanctuary.partials.events', ['inv' => $inv])

        @if($inv->hasFeature('countdown') && $inv->main_event)
            @include('themes.sanctuary.partials.countdown', ['event' => $inv->main_event])
        @endif

        @if($inv->hasFeature('map_embed') && $inv->main_event?->hasCoordinates())
            @include('themes.sanctuary.partials.location', ['event' => $inv->main_event])
        @endif

        @if($inv->hasFeature('gallery') && $inv->photos->isNotEmpty())
            @include('themes.sanctuary.partials.gallery', ['inv' => $inv])
        @endif

        @if($inv->hasFeature('gift') && $inv->giftAccounts->isNotEmpty())
            @include('themes.sanctuary.partials.gift', ['inv' => $inv])
        @endif

        @if($inv->hasFeature('rsvp'))
            @include('themes.sanctuary.partials.rsvp', ['inv' => $inv, 'guestName' => $guestName])
        @endif

        @if($inv->hasFeature('wishes'))
            @include('themes.sanctuary.partials.wishes', ['inv' => $inv])
        @endif

        @include('themes.sanctuary.partials.footer', ['inv' => $inv])
    </main>
@endsection
