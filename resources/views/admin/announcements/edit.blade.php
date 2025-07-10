@extends('layouts.app')

@section('content')
    <div class="section">
        <h4 style="color:#C41E3A; font-weight:700;">Edit Announcement Post</h4>
        <form method="POST" action="{{ route('admin.announcements.update', $announcement->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="input-field">
                <input type="text" name="title" id="title" value="{{ $announcement->title }}" required>
                <label for="title" class="active">Title</label>
            </div>
            <div class="input-field">
                <textarea name="content" id="content" class="materialize-textarea"
                    required>{{ $announcement->content }}</textarea>
                <label for="content" class="active">Content</label>
            </div>
            <div class="file-field input-field">
                <div class="btn" style="background-color:#C41E3A;">
                    <span>Upload Image</span>
                    <input type="file" name="picture" accept="image/*">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Upload an image (optional)">
                </div>
                @if($announcement->picture)
                    <div style="margin-top: 10px;">
                        <p><strong>Current Image:</strong></p>
                        <img src="{{ asset('storage/' . $announcement->picture) }}" alt="Current Image"
                            style="max-width: 200px; max-height: 200px; border: 1px solid #ddd;">
                    </div>
                @endif
            </div>
            <button type="submit" class="btn waves-effect waves-light" style="background-color:#C41E3A;">Update
                Announcement</button>
            <a href="{{ route('admin.dashboard') }}" class="btn waves-effect waves-light grey">Cancel</a>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            M.textareaAutoResize(document.getElementById('content'));
        });
    </script>
@endsection