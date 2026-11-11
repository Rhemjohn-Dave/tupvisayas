@extends('layouts.admin')

@section('title', 'Admin — USG settings')

@section('admin_content')
    <x-admin.page-header title="USG About &amp; contact"
        subtitle="Content shown on the public University Student Government hub.">
        <x-slot name="actions">
            <a href="{{ route('usg.index') }}" class="admin-btn admin-btn--ghost" target="_blank" rel="noopener noreferrer">
                <i class="material-icons" aria-hidden="true">open_in_new</i>
                View on site
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-form-card admin-form">
        <form method="POST" action="{{ route('admin.usg-settings.update') }}">
            @csrf
            @method('PUT')

            <div class="admin-form__group">
                <label class="admin-label" for="about">About</label>
                <textarea class="admin-textarea" name="about" id="about" rows="6"
                    placeholder="Describe the University Student Government and its role on campus.">{{ old('about', $about) }}</textarea>
                @error('about')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="mission">Mission</label>
                <textarea class="admin-textarea" name="mission" id="mission" rows="3">{{ old('mission', $mission) }}</textarea>
                @error('mission')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="vision">Vision</label>
                <textarea class="admin-textarea" name="vision" id="vision" rows="3">{{ old('vision', $vision) }}</textarea>
                @error('vision')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="contact_email">Contact email</label>
                <input class="admin-input" type="email" name="contact_email" id="contact_email"
                    value="{{ old('contact_email', $contactEmail) }}" placeholder="usg@tupv.edu.ph">
                @error('contact_email')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="office_hours">Office hours</label>
                <input class="admin-input" type="text" name="office_hours" id="office_hours"
                    value="{{ old('office_hours', $officeHours) }}" placeholder="Mon–Fri, 8:00 AM – 5:00 PM">
                @error('office_hours')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__actions">
                <button type="submit" class="admin-btn admin-btn--primary">Save settings</button>
            </div>
        </form>
    </div>
@endsection
