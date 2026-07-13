@php
    /** @var \App\Models\Course|null $course */
    $course = $course ?? null;
@endphp

<div class="admin-form__group">
    <p class="admin-form__hint">Optional program page sections. Leave blank to hide on the public site until content is ready.</p>
</div>

<div class="admin-form__group">
    <label class="admin-label" for="curriculum">Curriculum</label>
    <textarea name="curriculum" id="curriculum"
        class="admin-textarea wysiwyg">{{ old('curriculum', $course?->curriculum) }}</textarea>
    @error('curriculum')
        <span class="admin-form__error">{{ $message }}</span>
    @enderror
</div>

<div class="admin-form__group">
    <label class="admin-label" for="facilities_labs">Labs &amp; facilities</label>
    <textarea name="facilities_labs" id="facilities_labs"
        class="admin-textarea wysiwyg">{{ old('facilities_labs', $course?->facilities_labs) }}</textarea>
    @error('facilities_labs')
        <span class="admin-form__error">{{ $message }}</span>
    @enderror
</div>

<div class="admin-form__group">
    <label class="admin-label" for="accreditation_info">Accreditation</label>
    <textarea name="accreditation_info" id="accreditation_info"
        class="admin-textarea wysiwyg">{{ old('accreditation_info', $course?->accreditation_info) }}</textarea>
    <p class="admin-form__hint">Public accreditation highlights for this program (level, status, awarding body). Separate from the password-protected accreditation documents area.</p>
    @error('accreditation_info')
        <span class="admin-form__error">{{ $message }}</span>
    @enderror
</div>

<div class="admin-form__group">
    <label class="admin-label" for="board_performance">Board performance</label>
    <textarea name="board_performance" id="board_performance"
        class="admin-textarea wysiwyg">{{ old('board_performance', $course?->board_performance) }}</textarea>
    @error('board_performance')
        <span class="admin-form__error">{{ $message }}</span>
    @enderror
</div>

<div class="admin-form__group">
    <label class="admin-label" for="scholarships">Scholarships</label>
    <textarea name="scholarships" id="scholarships"
        class="admin-textarea wysiwyg">{{ old('scholarships', $course?->scholarships) }}</textarea>
    <p class="admin-form__hint">Program-specific scholarship notes only. Leave blank if none apply.</p>
    @error('scholarships')
        <span class="admin-form__error">{{ $message }}</span>
    @enderror
</div>
