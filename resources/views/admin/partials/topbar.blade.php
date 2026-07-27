{{-- Sticky top bar: mobile menu, search (posts), notifications, profile --}}
<header class="admin-topbar">
    <div class="admin-topbar__left">
        {{-- Desktop: narrow/widen sidebar. Mobile: open/close drawer (same control). --}}
        <button type="button" class="admin-icon-btn admin-topbar__menu-btn" id="adminMenuToggle" aria-controls="adminSidebar" aria-expanded="true" aria-label="Toggle navigation menu">
            <i class="material-icons" aria-hidden="true">menu</i>
        </button>

        <p class="admin-topbar__title">Admin Central</p>

        <form class="admin-topbar-search" action="{{ route('admin.dashboard') }}" method="get" role="search">
            <label class="visually-hidden" for="adminGlobalSearch">Search posts</label>
            <span class="admin-topbar-search__icon" aria-hidden="true"><i class="material-icons">search</i></span>
            <input id="adminGlobalSearch" type="search" name="q" value="{{ request('q') }}" placeholder="Search posts by title or category…" autocomplete="off">
            @if(request()->routeIs('admin.dashboard'))
                @if(request('type'))
                    <input type="hidden" name="type" value="{{ request('type') }}">
                @endif
                @if(request('sort'))
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                @endif
                @if(request('dir'))
                    <input type="hidden" name="dir" value="{{ request('dir') }}">
                @endif
            @endif
        </form>
    </div>

    <div class="admin-topbar__right">
        <details class="admin-disclosure">
            <summary class="admin-icon-btn" aria-label="Notifications">
                <i class="material-icons" aria-hidden="true">notifications_none</i>
            </summary>
            <div class="admin-disclosure__panel admin-disclosure__panel--sm">
                <p class="admin-disclosure__empty">No new notifications</p>
            </div>
        </details>

        <details class="admin-disclosure">
            <summary class="admin-icon-btn" aria-label="Help">
                <i class="material-icons" aria-hidden="true">help_outline</i>
            </summary>
            <div class="admin-disclosure__panel admin-disclosure__panel--sm">
                <p class="admin-disclosure__empty">Use the sidebar to manage site sections and create posts.</p>
            </div>
        </details>

        <details class="admin-disclosure admin-disclosure--profile">
            <summary class="admin-profile-trigger" aria-label="Account menu">
                <span class="admin-avatar" aria-hidden="true">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</span>
                <span class="admin-profile-trigger__text hide-on-small-admin">
                    <span class="admin-profile-trigger__name">Admin</span>
                    <span class="admin-profile-trigger__role">Administrator</span>
                </span>
            </summary>
            <div class="admin-disclosure__panel admin-disclosure__panel--profile">
                <div class="admin-profile-card">
                    <span class="admin-avatar admin-avatar--lg" aria-hidden="true">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</span>
                    <div>
                        <div class="admin-profile-card__name">{{ auth()->user()->name }}</div>
                        <div class="admin-profile-card__email">{{ auth()->user()->email }}</div>
                    </div>
                </div>
                <a href="{{ route('home') }}" class="admin-dropdown-link">
                    <i class="material-icons" aria-hidden="true">open_in_new</i> View public site
                </a>
                <form method="POST" action="{{ route('logout') }}" class="admin-dropdown-logout">
                    @csrf
                    <button type="submit" class="admin-dropdown-link admin-dropdown-link--danger">
                        <i class="material-icons" aria-hidden="true">logout</i> Log out
                    </button>
                </form>
            </div>
        </details>
    </div>
</header>
