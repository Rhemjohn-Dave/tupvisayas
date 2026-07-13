@php
    use App\Support\CmsPermissions;

    $user = auth()->user();
    $home = $user?->adminHomeRoute() ?? route('home');

    $openContent = request()->routeIs('admin.dashboard')
        || request()->routeIs('admin.categories.*')
        || request()->routeIs('admin.carousel-images.*')
        || request()->routeIs('admin.tiptto_posts.*')
        || request()->routeIs('admin.director_posts.*');

    $openManagement = request()->routeIs('admin.users.*')
        || request()->routeIs('admin.officials.*')
        || request()->routeIs('admin.activity-logs.*');

    $openProcurement = request()->routeIs('admin.procurements.*');

    $showContent = $user?->can(CmsPermissions::MANAGE_POSTS)
        || $user?->can(CmsPermissions::MANAGE_CATEGORIES)
        || $user?->can(CmsPermissions::MANAGE_CAROUSEL)
        || $user?->can(CmsPermissions::MANAGE_TIPTTO)
        || $user?->can(CmsPermissions::MANAGE_DIRECTOR_POSTS);

    $showManagement = $user?->can(CmsPermissions::MANAGE_USERS)
        || $user?->can(CmsPermissions::MANAGE_OFFICIALS)
        || $user?->can(CmsPermissions::VIEW_ACTIVITY_LOGS);
@endphp

{{--
Admin sidebar — light institutional rail, brand red accents (matches public site).
--}}
<aside class="admin-sidebar" id="adminSidebar" aria-label="Admin navigation">
    <div class="admin-sidebar__brand">
        <a href="{{ $home }}" class="admin-sidebar__logo">
            <img src="{{ asset('images/tup-logo.png') }}" alt="TUP Visayas" class="admin-sidebar__logo-img" width="44" height="44">
            <span class="admin-sidebar__logo-text">
                <span class="admin-sidebar__logo-title">TUP Visayas</span>
                <span class="admin-sidebar__logo-sub">Administration</span>
            </span>
        </a>
    </div>

    <div class="admin-sidebar__nav" id="adminSidebarNav" aria-label="Primary">
        @can(CmsPermissions::MANAGE_POSTS)
            <ul class="admin-sidebar__list admin-sidebar__list--root">
                <li>
                    <x-admin.sidebar-nav-link href="{{ route('admin.dashboard') }}" label="Dashboard" icon="dashboard"
                        :active="request()->routeIs('admin.dashboard')" class="admin-sidebar__link--root" />
                </li>
            </ul>
        @endcan

        @if ($showContent)
            <x-admin.sidebar-collapsible title="Content" icon="folder_open" group-id="sb-group-content"
                :open="$openContent">
                @can(CmsPermissions::MANAGE_POSTS)
                    <li>
                        <x-admin.sidebar-nav-link href="{{ route('admin.dashboard') }}" label="Posts" icon="article"
                            :active="request()->routeIs('admin.dashboard')" class="admin-sidebar__link--nested" />
                    </li>
                @endcan
                @can(CmsPermissions::MANAGE_CATEGORIES)
                    <li>
                        <x-admin.sidebar-nav-link href="{{ route('admin.categories.index') }}" label="Categories"
                            icon="category" :active="request()->routeIs('admin.categories.*')"
                            class="admin-sidebar__link--nested" />
                    </li>
                @endcan
                @can(CmsPermissions::MANAGE_CAROUSEL)
                    <li>
                        <x-admin.sidebar-nav-link href="{{ route('admin.carousel-images.index') }}" label="Carousel"
                            icon="photo_library" :active="request()->routeIs('admin.carousel-images.*')"
                            class="admin-sidebar__link--nested" />
                    </li>
                @endcan
                @can(CmsPermissions::MANAGE_TIPTTO)
                    <li>
                        <x-admin.sidebar-nav-link href="{{ route('admin.tiptto_posts.index') }}" label="TIPTTO" icon="science"
                            :active="request()->routeIs('admin.tiptto_posts.*')" class="admin-sidebar__link--nested" />
                    </li>
                @endcan
                @can(CmsPermissions::MANAGE_DIRECTOR_POSTS)
                    <li>
                        <x-admin.sidebar-nav-link href="{{ route('admin.director_posts.index') }}" label="Director's Corner"
                            icon="record_voice_over" :active="request()->routeIs('admin.director_posts.*')"
                            class="admin-sidebar__link--nested" />
                    </li>
                @endcan
            </x-admin.sidebar-collapsible>
        @endif

        @if ($showManagement)
            <x-admin.sidebar-collapsible title="Management" icon="manage_accounts" group-id="sb-group-management"
                :open="$openManagement">
                @can(CmsPermissions::MANAGE_USERS)
                    <li>
                        <x-admin.sidebar-nav-link href="{{ route('admin.users.index') }}" label="Users" icon="group"
                            :active="request()->routeIs('admin.users.*')" class="admin-sidebar__link--nested" />
                    </li>
                @endcan
                @can(CmsPermissions::MANAGE_OFFICIALS)
                    <li>
                        <x-admin.sidebar-nav-link href="{{ route('admin.officials.index') }}" label="Officials" icon="badge"
                            :active="request()->routeIs('admin.officials.*')" class="admin-sidebar__link--nested" />
                    </li>
                @endcan
                @can(CmsPermissions::VIEW_ACTIVITY_LOGS)
                    <li>
                        <x-admin.sidebar-nav-link href="{{ route('admin.activity-logs.index') }}" label="Activity logs"
                            icon="history" :active="request()->routeIs('admin.activity-logs.*')"
                            class="admin-sidebar__link--nested" />
                    </li>
                @endcan
            </x-admin.sidebar-collapsible>
        @endif

        @can(CmsPermissions::MANAGE_ACADEMICS)
            <ul class="admin-sidebar__list admin-sidebar__list--root">
                <li>
                    <x-admin.sidebar-nav-link href="{{ route('admin.college-pages.index') }}" label="Academics pages"
                        icon="school" :active="request()->routeIs('admin.college-pages.*')"
                        class="admin-sidebar__link--root" />
                </li>
            </ul>
        @endcan

        @can(CmsPermissions::MANAGE_ADMISSIONS)
            <ul class="admin-sidebar__list admin-sidebar__list--root">
                <li>
                    <x-admin.sidebar-nav-link href="{{ route('admin.admission-schedules.index') }}"
                        label="Admission schedules" icon="event_available"
                        :active="request()->routeIs('admin.admission-schedules.*')"
                        class="admin-sidebar__link--root" />
                </li>
            </ul>
        @endcan

        @can(CmsPermissions::MANAGE_PROCUREMENTS)
            <x-admin.sidebar-collapsible title="Procurement" icon="assignment" group-id="sb-group-procurement"
                :open="$openProcurement">

                <li>
                    <x-admin.sidebar-nav-link href="{{ route('admin.procurements.create') }}" label="Add new"
                        icon="add_circle" :active="request()->routeIs('admin.procurements.create')"
                        class="admin-sidebar__link--nested" />
                </li>

                <li>
                    <x-admin.sidebar-nav-link href="{{ route('admin.procurements.index', ['type' => 'bid_opportunity']) }}"
                        label="Bid opportunities" icon="gavel" :active="request()->routeIs('admin.procurements.index') && request()->query('type') === 'bid_opportunity'" class="admin-sidebar__link--nested" />
                </li>

                <li>
                    <x-admin.sidebar-nav-link href="{{ route('admin.procurements.index', ['type' => 'philgeps_posting']) }}"
                        label="PhilGEPS" icon="public" :active="request()->routeIs('admin.procurements.index') && request()->query('type') === 'philgeps_posting'" class="admin-sidebar__link--nested" />
                </li>

            </x-admin.sidebar-collapsible>
        @endcan
    </div>


</aside>
