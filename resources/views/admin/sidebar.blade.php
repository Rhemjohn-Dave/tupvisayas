<!-- Admin Sidebar -->
<div class="admin-sidebar">
    <div class="sidebar-header">Admin Panel</div>
    <ul>
        <li>
            <a href="{{ route('admin.dashboard') }}"
                class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="material-icons">dashboard</i>Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('admin.posts.create') }}">
                <i class="material-icons">add</i>Create Post
            </a>
        </li>
        <li>
            <a href="{{ route('admin.users.index') }}"
                class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="material-icons">supervisor_account</i>Users
            </a>
        </li>
        <li>
            <a href="{{ route('admin.officials.index') }}"
                class="{{ request()->routeIs('admin.officials.*') ? 'active' : '' }}">
                <i class="material-icons">people</i>Officials
            </a>
        </li>
        <li>
            <a href="{{ route('admin.carousel-images.index') }}"
                class="{{ request()->routeIs('admin.carousel-images.*') ? 'active' : '' }}">
                <i class="material-icons">photo_library</i>Carousel Images
            </a>
        </li>
        <li>
            <a href="{{ route('admin.categories.index') }}"
                class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="material-icons">category</i>Categories
            </a>
        </li>
        <li>
            <a href="{{ route('admin.college-pages.index') }}"
                class="{{ request()->routeIs('admin.college-pages.*') ? 'active' : '' }}">
                <i class="material-icons">school</i>Manage Academics Pages
            </a>
        </li>
        <li>
            <a href="{{ route('admin.procurements.index') }}"
                class="{{ request()->routeIs('admin.procurements.*') ? 'active' : '' }}">
                <i class="material-icons">assignment</i>Procurement
            </a>
            <ul class="sub-menu">
                <li><a href="{{ route('admin.procurements.create') }}">Add New</a></li>
                <li><a href="{{ route('admin.procurements.index') }}?type=bid_opportunity">Bid Opportunities</a></li>
                <li><a href="{{ route('admin.procurements.index') }}?type=philgeps_posting">PhilGEPS Posting</a></li>
            </ul>
        </li>
    </ul>
</div>
<div class="admin-sidebar-overlay"></div>