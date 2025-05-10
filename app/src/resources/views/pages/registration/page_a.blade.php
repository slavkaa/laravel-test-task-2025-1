@extends('layouts.app')

@section('content')
    <div class="outer">
        <div class="wrapper">
            <form id="i-am-feeling-lucky-form" class="centered-form" method="POST" action="{{ route('game.i_am_feeling_lucky') }}">
                @csrf
                <button type="submit" value="i_am_feeling_lucky">Imfeelinglucky</button>
                <div id="game-real-score" class="hidden">Real score : <span></span></div>
                <div id="game-status" class="hidden">Status : <span></span></div>
                <div id="game-win-points" class="hidden">WIN points : <span></span></div>
            </form>

            <br/>

            <form id="game-history" class="centered-form" method="POST" action="{{ route('game.get_history') }}">
                @csrf
                <button type="submit" value="lottery_history">History</button>

                <div id="game-history-container" class="hidden">Nothing to display</div>
            </form>

            <br/>

            <form id="deactivate-link-form" class="centered-form" method="POST" action="{{ route('registration.deactivate_hash') }}">
                @csrf
                <input type="hidden" name="hash" value="{{ $hash }}"/>
                <button type="submit" value="deactivate_link">Deactivate link</button>
            </form>

            <br/>

            @include('partials.generate_hash_form')
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/registration/deactivate-registration-link.js') }}"></script>
    <script src="{{ asset('js/game/game.js') }}"></script>
    <script src="{{ asset('js/game/game-history.js') }}"></script>
@endpush
