{{--
    Sasando theme entrypoint.
    $inv       = App\Models\Invitation (relations eager-loaded)
    $guestName = string|null  (from ?to=)
    $inv is available inside the layout too (passed to this view).
--}}
@extends('themes.sasando.layout')

@section('content')
    @include('themes.sasando.partials.cover', ['inv' => $inv, 'guestName' => $guestName])

    <main id="content" class="bg-ivory">
        @include('themes.sasando.partials.opening', ['inv' => $inv])
        @include('themes.sasando.partials.couple', ['inv' => $inv])

        @if($inv->hasFeature('love_story') && $inv->stories->isNotEmpty())
            @include('themes.sasando.partials.story', ['inv' => $inv])
        @endif

        @include('themes.sasando.partials.events', ['inv' => $inv])

        @if($inv->hasFeature('countdown') && $inv->main_event)
            @include('themes.sasando.partials.countdown', ['event' => $inv->main_event])
        @endif

        @if($inv->hasFeature('map_embed') && $inv->main_event?->hasCoordinates())
            @include('themes.sasando.partials.location', ['event' => $inv->main_event])
        @endif

        @if($inv->hasFeature('gallery') && $inv->photos->isNotEmpty())
            @include('themes.sasando.partials.gallery', ['inv' => $inv])
        @endif

        @if($inv->hasFeature('gift') && $inv->giftAccounts->isNotEmpty())
            @include('themes.sasando.partials.gift', ['inv' => $inv])
        @endif

        @if($inv->hasFeature('rsvp'))
            @include('themes.sasando.partials.rsvp', ['inv' => $inv, 'guestName' => $guestName])
        @endif

        @if($inv->hasFeature('wishes'))
            @include('themes.sasando.partials.wishes', ['inv' => $inv])
        @endif

        @include('themes.sasando.partials.footer', ['inv' => $inv])
    </main>
@endsection
