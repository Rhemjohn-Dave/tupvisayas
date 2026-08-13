@php
    $jobs = $jobs ?? collect();
    $empty = $empty ?? 'No postings yet.';
@endphp

@if ($jobs->isEmpty())
    <p class="sit-prose">{{ $empty }}</p>
@else
    <div class="office-job-grid">
        @foreach ($jobs as $item)
            <article class="office-job-card">
                @if ($item->picture)
                    <figure class="office-job-card__media">
                        <img src="{{ asset('storage/' . $item->picture) }}" alt="" loading="lazy">
                    </figure>
                @endif
                <div class="office-job-card__body">
                    <p class="office-job-card__badge">{{ $item->audienceLabel() }}</p>
                    <h3 class="office-job-card__title">{{ $item->title }}</h3>
                    <p class="office-job-card__excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($item->content), 140) }}</p>
                    <a class="acad-btn acad-btn--ghost" href="{{ route('jobs.show', $item->slug) }}">Read more</a>
                </div>
            </article>
        @endforeach
    </div>
@endif
