@extends('layouts.admin')

@section('title', 'Admin — Add official')

@section('admin_content')
    <x-admin.page-header title="Add official" subtitle="University leadership shown on the public site.">
        <x-slot name="actions">
            <a href="{{ route('admin.officials.index') }}" class="admin-btn admin-btn--ghost">
                <i class="material-icons" aria-hidden="true">arrow_back</i>
                Back to officials
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-form-card admin-form">
        <form action="{{ route('admin.officials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="admin-form__group">
                <label class="admin-label" for="name">Name</label>
                <input class="admin-input" type="text" name="name" id="name" value="{{ old('name') }}" required>
                @error('name')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="position">Position</label>
                <input class="admin-input" type="text" name="position" id="position" value="{{ old('position') }}"
                    required>
                <p class="admin-form__hint">Example: Dean, College of Engineering</p>
                @error('position')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="quote">Short saying / quote</label>
                <textarea class="admin-textarea" name="quote" id="quote" rows="2" maxlength="280"
                    placeholder="A brief message shown on the college page">{{ old('quote') }}</textarea>
                <p class="admin-form__hint">Optional. Keep it under ~2 short sentences for the college dean spotlight.</p>
                @error('quote')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="college_page_id">College (dean display)</label>
                <select class="admin-select browser-default" name="college_page_id" id="college_page_id">
                    <option value="">— Not linked (campus-wide) —</option>
                    @foreach ($colleges as $college)
                        <option value="{{ $college->id }}" @selected(old('college_page_id') == $college->id)>
                            {{ $college->college }}
                        </option>
                    @endforeach
                </select>
                <p class="admin-form__hint">Link a college dean here so they appear on that college’s academic page.</p>
                @error('college_page_id')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="order">Order</label>
                <input class="admin-input" type="number" name="order" id="order" value="{{ old('order', 0) }}">
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="photo">Photo</label>
                <input class="admin-file" type="file" name="photo" id="photo" accept="image/*">
                <x-admin.image-spec type="official" />
                @error('photo')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__actions">
                <button type="submit" class="admin-btn admin-btn--primary">Create official</button>
                <a href="{{ route('admin.officials.index') }}" class="admin-btn admin-btn--ghost">Cancel</a>
            </div>
        </form>
    </div>
@endsection
