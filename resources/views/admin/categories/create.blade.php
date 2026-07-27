@extends('layouts.admin')

@section('title', 'Admin — New category')

@section('admin_content')
    <x-admin.page-header title="Add category" subtitle="Categories group news, announcements, jobs, and events.">
        <x-slot name="actions">
            <a href="{{ route('admin.categories.index') }}" class="admin-btn admin-btn--ghost">
                <i class="material-icons" aria-hidden="true">arrow_back</i>
                Back to categories
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-form-card admin-form admin-form--narrow">
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf
            <div class="admin-form__group">
                <label class="admin-label" for="name">Category name</label>
                <input class="admin-input" type="text" name="name" id="name" value="{{ old('name') }}" required>
                @error('name')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>
            <div class="admin-form__actions">
                <button type="submit" class="admin-btn admin-btn--primary">Add category</button>
                <a href="{{ route('admin.categories.index') }}" class="admin-btn admin-btn--ghost">Cancel</a>
            </div>
        </form>
    </div>
@endsection
