@extends('themes.retro.layout')

@section('content')
    @include('themes.retro.partials.cover', ['inv' => $inv, 'guestName' => $guestName])

    <main id="content" class="bg-cream">
        @include('themes.retro.partials.opening', ['inv' => $inv])
        @include('themes.retro.partials.couple', ['inv' => $inv])

        @if($inv->hasFeature('love_story') && $inv->stories->isNotEmpty())
            @include('themes.retro.partials.story', ['inv' => $inv])
        @endif

        @include('themes.retro.partials.events', ['inv' => $inv])

        @if($inv->hasFeature('countdown') && $inv->main_event)
            @include('themes.retro.partials.countdown', ['event' => $inv->main_event])
        @endif

        @if($inv->hasFeature('map_embed') && $inv->main_event?->hasCoordinates())
            @include('themes.retro.partials.location', ['event' => $inv->main_event])
        @endif

        @if($inv->hasFeature('gallery') && $inv->photos->isNotEmpty())
            @include('themes.retro.partials.gallery', ['inv' => $inv])
        @endif

        @if($inv->hasFeature('gift') && $inv->giftAccounts->isNotEmpty())
            @include('themes.retro.partials.gift', ['inv' => $inv])
        @endif

        @if($inv->hasFeature('rsvp'))
            @include('themes.retro.partials.rsvp', ['inv' => $inv, 'guestName' => $guestName])
        @endif

        @if($inv->hasFeature('wishes'))
            @include('themes.retro.partials.wishes', ['inv' => $inv])
        @endif

        @include('themes.retro.partials.footer', ['inv' => $inv])
    </main>
@endsection
