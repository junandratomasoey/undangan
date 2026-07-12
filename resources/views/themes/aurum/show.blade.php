@extends('themes.aurum.layout')

@section('content')
    @include('themes.aurum.partials.cover', ['inv' => $inv, 'guestName' => $guestName])

    <main id="content" class="bg-noir">
        @include('themes.aurum.partials.opening', ['inv' => $inv])
        @include('themes.aurum.partials.couple', ['inv' => $inv])

        @if($inv->hasFeature('love_story') && $inv->stories->isNotEmpty())
            @include('themes.aurum.partials.story', ['inv' => $inv])
        @endif

        @include('themes.aurum.partials.events', ['inv' => $inv])

        @if($inv->hasFeature('countdown') && $inv->main_event)
            @include('themes.aurum.partials.countdown', ['event' => $inv->main_event])
        @endif

        @if($inv->hasFeature('map_embed') && $inv->main_event?->hasCoordinates())
            @include('themes.aurum.partials.location', ['event' => $inv->main_event])
        @endif

        @if($inv->hasFeature('gallery') && $inv->photos->isNotEmpty())
            @include('themes.aurum.partials.gallery', ['inv' => $inv])
        @endif

        @if($inv->hasFeature('gift') && $inv->giftAccounts->isNotEmpty())
            @include('themes.aurum.partials.gift', ['inv' => $inv])
        @endif

        @if($inv->hasFeature('rsvp'))
            @include('themes.aurum.partials.rsvp', ['inv' => $inv, 'guestName' => $guestName])
        @endif

        @if($inv->hasFeature('wishes'))
            @include('themes.aurum.partials.wishes', ['inv' => $inv])
        @endif

        @include('themes.aurum.partials.footer', ['inv' => $inv])
    </main>
@endsection
