<div
    style="height:100vh;min-height:600px;background:#C41E3A;display:flex;flex-direction:column;align-items:stretch;position:fixed;left:0;top:0;width:220px;z-index:1;">
    <div style="padding:2rem 1rem 1rem 1.5rem;">
        <span style="color:white;font-size:1.3rem;font-weight:700;letter-spacing:1px;">Admin Panel</span>
    </div>
    <ul style="list-style:none;padding:0;margin:0;flex:1;">
        <li><a href="{{ route('admin.dashboard') }}" class="white-text"
                style="display:flex;align-items:center;padding:14px 24px;font-weight:600;"><i
                    class="material-icons left" style="margin-right:12px;">dashboard</i>Dashboard</a></li>
        <li><a href="{{ route('admin.posts.create') }}" class="white-text"
                style="display:flex;align-items:center;padding:14px 24px;"><i class="material-icons left"
                    style="margin-right:12px;">add</i>Create Post</a></li>
        <li><a href="{{ route('admin.officials.index') }}" class="white-text"
                style="display:flex;align-items:center;padding:14px 24px;"><i class="material-icons left"
                    style="margin-right:12px;">people</i>Officials</a></li>
        <li><a href="{{ route('admin.carousel-images.index') }}" class="white-text"
                style="display:flex;align-items:center;padding:14px 24px;"><i class="material-icons left"
                    style="margin-right:12px;">photo_library</i>Carousel Images</a></li>
        <li><a href="{{ route('admin.categories.index') }}" class="white-text"
                style="display:flex;align-items:center;padding:14px 24px;"><i class="material-icons left"
                    style="margin-right:12px;">category</i>Categories</a></li>
    </ul>
</div>