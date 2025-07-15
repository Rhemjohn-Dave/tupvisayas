@extends('layouts.app')

@section('content')
    <div class="section">
        <h4>Manage Carousel Images</h4>
        <a href="{{ route('admin.carousel-images.create') }}" class="btn red white-text" style="margin-bottom: 20px;">Add
            New Image</a>
        <table class="striped responsive-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Caption</th>
                    <th>Order</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($carouselImages as $image)
                    <tr>
                        <td>
                            @if($image->image_path)
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="Carousel Image"
                                    style="height: 60px; width: auto; border-radius: 4px;">
                            @endif
                        </td>
                        <td>{{ $image->caption }}</td>
                        <td>{{ $image->order }}</td>
                        <td>
                            <a href="{{ route('admin.carousel-images.edit', $image->id) }}" class="btn-small orange">Edit</a>
                            <form action="{{ route('admin.carousel-images.destroy', $image->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-small red"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="center-align">No carousel images found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection