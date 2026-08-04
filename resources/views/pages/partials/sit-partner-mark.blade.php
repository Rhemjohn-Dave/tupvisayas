@if ($partner->logo_path)
    <span class="sit-partner-card__logo">
        <img src="{{ asset('storage/' . $partner->logo_path) }}" alt="" loading="lazy">
    </span>
@else
    <span class="sit-partner-card__mark" aria-hidden="true">TUPv</span>
@endif
