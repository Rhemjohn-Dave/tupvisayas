@php
    // Auto-expand the group that contains the current route
    $openContent = request()->routeIs('admin.dashboard')
        || request()->routeIs('admin.categories.*')
        || request()->routeIs('admin.carousel-images.*')
        || request()->routeIs('admin.tiptto_posts.*');

    $openManagement = request()->routeIs('admin.users.*')
        || request()->routeIs('admin.officials.*');

    $openProcurement = request()->routeIs('admin.procurements.*');
@endphp

{{--
<<<<<<< HEAD
Admin sidebar — light institutional rail, brand red accents (matches public site).
=======
Admin sidebar — dark #1f2937 rail, red accent for active only.
Collapsible groups (Content, Management, Procurement) + icon-only rail when collapsed.
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
--}}
<aside class="admin-sidebar" id="adminSidebar" aria-label="Admin navigation">
    <div class="admin-sidebar__brand">
        <a href="{{ route('admin.dashboard') }}" class="admin-sidebar__logo">
<<<<<<< HEAD
            <img src="{{ asset('images/tup-logo.png') }}" alt="TUP Visayas" class="admin-sidebar__logo-img" width="44" height="44">
            <span class="admin-sidebar__logo-text">
                <span class="admin-sidebar__logo-title">TUP Visayas</span>
                <span class="admin-sidebar__logo-sub">Administration</span>
            </span>
=======
            <span class="admin-sidebar__logo-mark" aria-hidden="true"></span>
            <span class="admin-sidebar__logo-text">TUPV Admin</span>
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
        </a>
    </div>

    <div class="admin-sidebar__nav" id="adminSidebarNav" aria-label="Primary">
        <ul class="admin-sidebar__list admin-sidebar__list--root">
            <li>
                <x-admin.sidebar-nav-link href="{{ route('admin.dashboard') }}" label="Dashboard" icon="dashboard"
                    :active="request()->routeIs('admin.dashboard')" class="admin-sidebar__link--root" />
            </li>
        </ul>

        <x-admin.sidebar-collapsible title="Content" icon="folder_open" group-id="sb-group-content"
            :open="$openContent">
            <li>
                <x-admin.sidebar-nav-link href="{{ route('admin.dashboard') }}" label="Posts" icon="article"
                    :active="request()->routeIs('admin.dashboard')" class="admin-sidebar__link--nested" />
            </li>
            <li>
                <x-admin.sidebar-nav-link href="{{ route('admin.categories.index') }}" label="Categories"
                    icon="category" :active="request()->routeIs('admin.categories.*')"
                    class="admin-sidebar__link--nested" />
            </li>
            <li>
                <x-admin.sidebar-nav-link href="{{ route('admin.carousel-images.index') }}" label="Carousel"
                    icon="photo_library" :active="request()->routeIs('admin.carousel-images.*')"
                    class="admin-sidebar__link--nested" />
            </li>
            <li>
                <x-admin.sidebar-nav-link href="{{ route('admin.tiptto_posts.index') }}" label="TIPTTO" icon="science"
                    :active="request()->routeIs('admin.tiptto_posts.*')" class="admin-sidebar__link--nested" />
            </li>
        </x-admin.sidebar-collapsible>

        <x-admin.sidebar-collapsible title="Management" icon="manage_accounts" group-id="sb-group-management"
            :open="$openManagement">
            <li>
                <x-admin.sidebar-nav-link href="{{ route('admin.users.index') }}" label="Users" icon="group"
                    :active="request()->routeIs('admin.users.*')" class="admin-sidebar__link--nested" />
            </li>
            <li>
                <x-admin.sidebar-nav-link href="{{ route('admin.officials.index') }}" label="Officials" icon="badge"
                    :active="request()->routeIs('admin.officials.*')" class="admin-sidebar__link--nested" />
            </li>
        </x-admin.sidebar-collapsible>

        <ul class="admin-sidebar__list admin-sidebar__list--root">
            <li>
                <x-admin.sidebar-nav-link href="{{ route('admin.college-pages.index') }}" label="Academics pages"
                    icon="school" :active="request()->routeIs('admin.college-pages.*')"
                    class="admin-sidebar__link--root" />
            </li>
        </ul>

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
    </div>


</aside>