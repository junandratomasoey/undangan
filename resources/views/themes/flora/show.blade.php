@extends('themes.flora.layout')

@section('content')
    @include('themes.flora.partials.cover', ['inv' => $inv, 'guestName' => $guestName])

    <main id="content" class="bg-ivory">
        @include('themes.flora.partials.opening', ['inv' => $inv])
        @include('themes.flora.partials.couple', ['inv' => $inv])

        @if($inv->hasFeature('love_story') && $inv->stories->isNotEmpty())
            @include('themes.flora.partials.story', ['inv' => $inv])
        @endif

        @include('themes.flora.partials.events', ['inv' => $inv])

        @if($inv->hasFeature('countdown') && $inv->main_event)
            @include('themes.flora.partials.countdown', ['event' => $inv->main_event])
        @endif

        @if($inv->hasFeature('map_embed') && $inv->main_event?->hasCoordinates())
            @include('themes.flora.partials.location', ['event' => $inv->main_event])
        @endif

        @if($inv->hasFeature('gallery') && $inv->photos->isNotEmpty())
            @include('themes.flora.partials.gallery', ['inv' => $inv])
        @endif

        @if($inv->hasFeature('gift') && $inv->giftAccounts->isNotEmpty())
            @include('themes.flora.partials.gift', ['inv' => $inv])
        @endif

        @if($inv->hasFeature('rsvp'))
            @include('themes.flora.partials.rsvp', ['inv' => $inv, 'guestName' => $guestName])
        @endif

        @if($inv->hasFeature('wishes'))
            @include('themes.flora.partials.wishes', ['inv' => $inv])
        @endif

        @include('themes.flora.partials.footer', ['inv' => $inv])
    </main>
@endsection
