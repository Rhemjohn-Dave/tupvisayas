@extends('layouts.app')

@section('content')
    <div class="section">
        <h4 style="color:#C41E3A; font-weight:700;">Create New Post</h4>
        <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="input-field">
                <select name="type" required>
                    <option value="" disabled selected>Select Post Type</option>
                    <option value="news">News</option>
                    <option value="announcement">Announcement</option>
                    <option value="job">Job Opening</option>
                    <option value="event">Event</option>
                </select>
                <label>Post Type</label>
            </div>
            <div class="input-field">
                <input type="text" name="title" id="title" required>
                <label for="title">Title</label>
            </div>
            <div class="input-field">
                <textarea name="content" id="content" class="materialize-textarea" required></textarea>
                <label for="content">Content</label>
            </div>
            <div class="file-field input-field">
                <div class="btn" style="background-color:#C41E3A;">
                    <span>Upload Image</span>
                    <input type="file" name="picture" accept="image/*">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Upload an image (optional)">
                </div>
            </div>
            <button type="submit" class="btn waves-effect waves-light" style="background-color:#C41E3A;">Create
                Post</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelectorAll('select');
            M.FormSelect.init(elems);
        });
    </script>
@endsection