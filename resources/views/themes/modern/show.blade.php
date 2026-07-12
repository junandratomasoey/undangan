@extends('themes.modern.layout')

@section('content')
    @include('themes.modern.partials.cover', ['inv' => $inv, 'guestName' => $guestName])

    <main id="content" class="bg-paper">
        @include('themes.modern.partials.opening', ['inv' => $inv])
        @include('themes.modern.partials.couple', ['inv' => $inv])

        @if($inv->hasFeature('love_story') && $inv->stories->isNotEmpty())
            @include('themes.modern.partials.story', ['inv' => $inv])
        @endif

        @include('themes.modern.partials.events', ['inv' => $inv])

        @if($inv->hasFeature('countdown') && $inv->main_event)
            @include('themes.modern.partials.countdown', ['event' => $inv->main_event])
        @endif

        @if($inv->hasFeature('map_embed') && $inv->main_event?->hasCoordinates())
            @include('themes.modern.partials.location', ['event' => $inv->main_event])
        @endif

        @if($inv->hasFeature('gallery') && $inv->photos->isNotEmpty())
            @include('themes.modern.partials.gallery', ['inv' => $inv])
        @endif

        @if($inv->hasFeature('gift') && $inv->giftAccounts->isNotEmpty())
            @include('themes.modern.partials.gift', ['inv' => $inv])
        @endif

        @if($inv->hasFeature('rsvp'))
            @include('themes.modern.partials.rsvp', ['inv' => $inv, 'guestName' => $guestName])
        @endif

        @if($inv->hasFeature('wishes'))
            @include('themes.modern.partials.wishes', ['inv' => $inv])
        @endif

        @include('themes.modern.partials.footer', ['inv' => $inv])
    </main>
@endsection
