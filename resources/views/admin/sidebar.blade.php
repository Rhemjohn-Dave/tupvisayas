<!-- Admin Sidebar -->
<div class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-header">
        <span class="sidebar-title">Admin Panel</span>
        <button class="sidebar-toggle-btn" id="sidebarToggle" title="Toggle Sidebar">
            <i class="material-icons">chevron_left</i>
        </button>
    </div>

    <!-- Expand button for collapsed state -->
    <div class="sidebar-expand-btn" id="sidebarExpand">
        <button class="expand-toggle-btn" id="expandToggle" title="Expand Sidebar">
            <i class="material-icons">chevron_right</i>
        </button>
    </div>
    <ul>
        <li>
            <a href="{{ route('admin.dashboard') }}"
                class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="material-icons">dashboard</i><span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.posts.create') }}">
                <i class="material-icons">add</i><span>Create Post</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.users.index') }}"
                class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="material-icons">supervisor_account</i><span>Users</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.officials.index') }}"
                class="{{ request()->routeIs('admin.officials.*') ? 'active' : '' }}">
                <i class="material-icons">people</i><span>Officials</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.carousel-images.index') }}"
                class="{{ request()->routeIs('admin.carousel-images.*') ? 'active' : '' }}">
                <i class="material-icons">photo_library</i><span>Carousel Images</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.categories.index') }}"
                class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="material-icons">category</i><span>Categories</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.college-pages.index') }}"
                class="{{ request()->routeIs('admin.college-pages.*') ? 'active' : '' }}">
                <i class="material-icons">school</i><span>Manage Academics Pages</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.procurements.index') }}"
                class="{{ request()->routeIs('admin.procurements.*') ? 'active' : '' }}">
                <i class="material-icons">assignment</i><span>Procurement</span>
            </a>
            <ul class="sub-menu">
                <li><a href="{{ route('admin.procurements.create') }}">Add New</a></li>
                <li><a href="{{ route('admin.procurements.index') }}?type=bid_opportunity">Bid Opportunities</a></li>
                <li><a href="{{ route('admin.procurements.index') }}?type=philgeps_posting">PhilGEPS Posting</a></li>
            </ul>
        </li>
        <li>
            <a href="{{ route('admin.tiptto_posts.index') }}"
                class="{{ request()->routeIs('admin.tiptto_posts.*') ? 'active' : '' }}">
                <i class="material-icons">science</i><span>TIPTTO Posts</span>
            </a>
            <ul class="sub-menu">
                <li><a href="{{ route('admin.tiptto_posts.create') }}">Create New Post</a></li>
                <li><a href="{{ route('admin.tiptto_posts.index') }}">Manage Posts</a></li>
            </ul>
        </li>
    </ul>
</div>
<div class="admin-sidebar-overlay"></div>