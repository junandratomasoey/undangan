@extends('themes.tenun.layout')

@section('content')
    @include('themes.tenun.partials.cover', ['inv' => $inv, 'guestName' => $guestName])

    <main id="content" class="bg-cream">
        @include('themes.tenun.partials.opening', ['inv' => $inv])
        @include('themes.tenun.partials.couple', ['inv' => $inv])

        @if($inv->hasFeature('love_story') && $inv->stories->isNotEmpty())
            @include('themes.tenun.partials.story', ['inv' => $inv])
        @endif

        @include('themes.tenun.partials.events', ['inv' => $inv])

        @if($inv->hasFeature('countdown') && $inv->main_event)
            @include('themes.tenun.partials.countdown', ['event' => $inv->main_event])
        @endif

        @if($inv->hasFeature('map_embed') && $inv->main_event?->hasCoordinates())
            @include('themes.tenun.partials.location', ['event' => $inv->main_event])
        @endif

        @if($inv->hasFeature('gallery') && $inv->photos->isNotEmpty())
            @include('themes.tenun.partials.gallery', ['inv' => $inv])
        @endif

        @if($inv->hasFeature('gift') && $inv->giftAccounts->isNotEmpty())
            @include('themes.tenun.partials.gift', ['inv' => $inv])
        @endif

        @if($inv->hasFeature('rsvp'))
            @include('themes.tenun.partials.rsvp', ['inv' => $inv, 'guestName' => $guestName])
        @endif

        @if($inv->hasFeature('wishes'))
            @include('themes.tenun.partials.wishes', ['inv' => $inv])
        @endif

        @include('themes.tenun.partials.footer', ['inv' => $inv])
    </main>
@endsection
