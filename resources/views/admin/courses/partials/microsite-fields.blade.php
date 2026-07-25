@php
    /** @var \App\Models\Course|null $course */
    $course = $course ?? null;
@endphp

<div class="admin-form__group">
    <p class="admin-form__hint">Optional program page sections. Leave blank to hide on the public site until content is ready. Use the checklist above (edit screen) to see what still needs filling.</p>
</div>

<div class="admin-form__group">
    <label class="admin-label" for="career_opportunities">Career opportunities</label>
    <textarea name="career_opportunities" id="career_opportunities"
        class="admin-textarea wysiwyg">{{ old('career_opportunities', $course?->career_opportunities) }}</textarea>
    <p class="admin-form__hint">Typical roles, industries, and pathways for graduates of this program.</p>
    @error('career_opportunities')
        <span class="admin-form__error">{{ $message }}</span>
    @enderror
</div>

<div class="admin-form__group">
    <label class="admin-label" for="program_objectives">Program educational objectives (PEOs)</label>
    <textarea name="program_objectives" id="program_objectives"
        class="admin-textarea wysiwyg">{{ old('program_objectives', $course?->program_objectives) }}</textarea>
    <p class="admin-form__hint">What graduates are expected to achieve a few years after graduation.</p>
    @error('program_objectives')
        <span class="admin-form__error">{{ $message }}</span>
    @enderror
</div>

<div class="admin-form__group">
    <label class="admin-label" for="program_outcomes">Program outcomes</label>
    <textarea name="program_outcomes" id="program_outcomes"
        class="admin-textarea wysiwyg">{{ old('program_outcomes', $course?->program_outcomes) }}</textarea>
    <p class="admin-form__hint">Skills and competencies students should demonstrate by graduation.</p>
    @error('program_outcomes')
        <span class="admin-form__error">{{ $message }}</span>
    @enderror
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

<div class="admin-form__group">
    <label class="admin-label" for="faq">Frequently asked questions</label>
    <textarea name="faq" id="faq"
        class="admin-textarea wysiwyg">{{ old('faq', $course?->faq) }}</textarea>
    <p class="admin-form__hint">Program-specific FAQs (format as headings + short answers in the editor).</p>
    @error('faq')
        <span class="admin-form__error">{{ $message }}</span>
    @enderror
</div>
