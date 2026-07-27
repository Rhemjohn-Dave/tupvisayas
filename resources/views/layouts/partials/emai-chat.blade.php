{{-- E-Mai FAQ chatbot — public pages only --}}
@php
    $emaiLogo = asset('images/e-mai.png');
    $emaiName = config('emai.name', 'E-Mai');
    $emaiFull = config('emai.full_name', 'Electronics Machine AI');
    $emaiWelcome = config('emai.welcome');
    $emaiSuggestions = config('emai.suggestions', []);
@endphp

<div
    class="emai"
    id="emaiChat"
    data-ask-url="{{ route('emai.ask') }}"
    data-csrf="{{ csrf_token() }}"
    data-logo="{{ $emaiLogo }}"
    hidden
>
    <button
        type="button"
        class="emai__fab"
        id="emaiFab"
        aria-controls="emaiPanel"
        aria-expanded="false"
        aria-label="Open {{ $emaiName }} FAQ chat"
    >
        <img class="emai__fab-img" src="{{ $emaiLogo }}" alt="" width="56" height="56">
        <span class="emai__fab-pulse" aria-hidden="true"></span>
    </button>

    <section
        class="emai__panel"
        id="emaiPanel"
        role="dialog"
        aria-modal="false"
        aria-labelledby="emaiTitle"
        hidden
    >
        <header class="emai__header">
            <div class="emai__identity">
                <img class="emai__avatar" src="{{ $emaiLogo }}" alt="" width="44" height="44">
                <div>
                    <h2 id="emaiTitle" class="emai__name">{{ $emaiName }}</h2>
                    <p class="emai__role">{{ $emaiFull }} · FAQ assistant</p>
                </div>
            </div>
            <button type="button" class="emai__close" id="emaiClose" aria-label="Close chat">
                <span aria-hidden="true">&times;</span>
            </button>
        </header>

        <div class="emai__messages" id="emaiMessages" aria-live="polite">
            <div class="emai__row emai__row--bot">
                <img class="emai__bubble-avatar" src="{{ $emaiLogo }}" alt="" width="28" height="28">
                <div class="emai__bubble emai__bubble--bot">
                    <p>{{ $emaiWelcome }}</p>
                </div>
            </div>
        </div>

        @if (count($emaiSuggestions))
            <div class="emai__suggestions" id="emaiSuggestions" aria-label="Suggested questions">
                @foreach ($emaiSuggestions as $suggestion)
                    <button type="button" class="emai__chip" data-emai-suggest="{{ $suggestion }}">
                        {{ $suggestion }}
                    </button>
                @endforeach
            </div>
        @endif

        <form class="emai__composer" id="emaiForm" autocomplete="off">
            <label class="visually-hidden" for="emaiInput">Ask E-Mai</label>
            <input
                id="emaiInput"
                class="emai__input"
                type="text"
                name="message"
                maxlength="500"
                placeholder="Ask about admissions, programs…"
                required
            >
            <button type="submit" class="emai__send" id="emaiSend" aria-label="Send message">
                <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true" fill="currentColor">
                    <path d="M2.01 21 23 12 2.01 3 2 10l15 2-15 2z" />
                </svg>
            </button>
        </form>
    </section>
</div>
