@extends('layouts.app')

@section('title', $course->name . ' Accreditation - TUP Visayas')

@section('content')
    <div class="section">
        <h4 style="color:#C41E3A;font-weight:700;">{{ $course->name }} - Accreditation</h4>

        @if(session('status'))
            <div class="card-panel green lighten-4 green-text text-darken-4">
                {{ session('status') }}
            </div>
        @endif

        @if(!$hasAccess)
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Restricted Access</span>
                    <p class="grey-text text-darken-1" style="margin-bottom:1rem;">
                        Please enter the accreditation password to view the details for this program.
                    </p>
                    <form method="POST" action="{{ route('accreditation.course.verify', $course) }}">
                        @csrf
                        <div class="input-field">
                            <input id="password" type="password" name="password" required>
                            <label for="password">Accreditation Password</label>
                            @error('password')
                                <span class="red-text text-darken-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn waves-effect waves-light red darken-2">
                            Unlock Accreditation
                        </button>
                        <a href="{{ route('accreditation.index') }}" class="btn-flat">
                            Back to Programs
                        </a>
                    </form>
                </div>
            </div>
        @else
            @if($course->name === 'Bachelor of Science in Mechanical Engineering')
                {{-- Customized content for BS Mechanical Engineering accreditation --}}
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Bachelor of Science in Mechanical Engineering - Accreditation</span>

                        {{-- 1. Certification of Authenticity & Veracity --}}
                        <h5 style="margin-top:1.5rem;">1. Certification of Authenticity &amp; Veracity</h5>
                        <ul class="browser-default">
                            <li>
                                <a href="https://drive.google.com/file/d/1dWubuzL_c-eYBzQeQIfujEL3QWtmTzC6/view?usp=drive_link"
                                    target="_blank" rel="noopener">
                                    Certification of Authenticity &amp; Veracity
                                </a>
                            </li>
                        </ul>

                        {{-- 2. COPC --}}
                        <h5 style="margin-top:1.5rem;">2. COPC</h5>
                        <ul class="browser-default">
                            <li>
                                <a href="https://docs.google.com/document/d/1I5RnmY9aV78cvVOfRJyJOJsMGMlArDNN/edit?usp=drive_link&ouid=118193976169173204719&rtpof=true&sd=true"
                                    target="_blank" rel="noopener">
                                    COPC Document
                                </a>
                            </li>
                        </ul>

                        {{-- 3. Exhibits / Additional Documents --}}
                        <h5 style="margin-top:1.5rem;">3. Exhibits / Additional Documents</h5>
                        <ul class="browser-default">
                            <li>
                                Community Service –
                                <a href="https://drive.google.com/your-community-service-link" target="_blank" rel="noopener">
                                    View files
                                </a>
                            </li>
                            <li>
                                International Linkages and Consortia –
                                <a href="https://drive.google.com/your-international-linkages-link" target="_blank" rel="noopener">
                                    View files
                                </a>
                            </li>
                            <li>
                                Planning Process –
                                <a href="https://drive.google.com/your-planning-process-link" target="_blank" rel="noopener">
                                    View files
                                </a>
                            </li>
                            <li>
                                Research –
                                <a href="https://drive.google.com/your-research-link" target="_blank" rel="noopener">
                                    View files
                                </a>
                            </li>
                            <li>
                                Teaching and Learning –
                                <a href="https://drive.google.com/your-teaching-learning-link" target="_blank" rel="noopener">
                                    View files
                                </a>
                            </li>
                        </ul>

                        {{-- 4. Mandatory Compliance Reports --}}
                        <h5 style="margin-top:1.5rem;">4. Mandatory Compliance Reports</h5>

                        <h6 style="margin-top:1rem;">Areas I–X</h6>
                        <ul class="browser-default">
                            <li>
                                Area I Compliance Reports Level IV Phase 2 –
                                <a href="https://docs.google.com/document/d/1zmIv3ZzkCpVapfqTpRwWzZmsSfI9zz-R/edit?usp=drive_link&ouid=118193976169173204719&rtpof=true&sd=true"
                                    target="_blank" rel="noopener">
                                    View files
                                </a>
                            </li>
                            <li>
                                Area II Compliance Reports Level IV Phase 2 –
                                <a href="https://docs.google.com/document/d/1pFlDfnayHpO8HEO_xMbWoxf_gHkxf0_j/edit?usp=drive_link&ouid=118193976169173204719&rtpof=true&sd=true"
                                    target="_blank" rel="noopener">
                                    View files
                                </a>
                            </li>
                            <li>
                                Area III Compliance Reports Level IV Phase 2 –
                                <a href="https://docs.google.com/document/d/1o5Cm_szUt-htG9q3QHV_iaN3Rzl6EI1R/edit?usp=drive_link&ouid=118193976169173204719&rtpof=true&sd=true"
                                    target="_blank" rel="noopener">
                                    View files
                                </a>
                            </li>
                            <li>
                                Area IV Compliance Reports Level IV Phase 2 –
                                <a href="https://docs.google.com/document/d/1qEWiwk9GiyCSi0PHWM9x7E5UaieXFb-I/edit?usp=drive_link&ouid=118193976169173204719&rtpof=true&sd=true"
                                    target="_blank" rel="noopener">
                                    View files
                                </a>
                            </li>
                            <li>
                                Area V Compliance Reports Level IV Phase 2 –
                                <a href="https://docs.google.com/document/d/16Jb6y8yDpfa1MSTeMehVTchV40olCMT1/edit?usp=drive_link&ouid=118193976169173204719&rtpof=true&sd=true"
                                    target="_blank" rel="noopener">
                                    View files
                                </a>
                            </li>
                            <li>
                                Area VI Compliance Reports Level IV Phase 2 –
                                <a href="https://docs.google.com/document/d/1PpSzD3B_sCv_DRVtBE1gkFL0XZpgqsO7/edit?usp=drive_link&ouid=118193976169173204719&rtpof=true&sd=true"
                                    target="_blank" rel="noopener">
                                    View files
                                </a>
                            </li>
                            <li>
                                Area VII Compliance Reports Level IV Phase 2 –
                                <a href="https://docs.google.com/document/d/1Kg_3at5Vtuo23WC0qvXZe0kW1IIvfzgP/edit?usp=drive_link&ouid=118193976169173204719&rtpof=true&sd=true"
                                    target="_blank" rel="noopener">
                                    View files
                                </a>
                            </li>
                            <li>
                                Area VIII Compliance Reports Level IV Phase 2 –
                                <a href="https://docs.google.com/document/d/1j9yke-v1i-ZjS226vwmdGxKvtVpv2FQp/edit?usp=drive_link&ouid=118193976169173204719&rtpof=true&sd=true"
                                    target="_blank" rel="noopener">
                                    View files
                                </a>
                            </li>
                            <li>
                                Area IX Compliance Reports Level IV Phase 2 –
                                <a href="https://docs.google.com/document/d/1pk6ORsEuu71JiFMlunex_7tBEEnAGqAz/edit?usp=drive_link&ouid=118193976169173204719&rtpof=true&sd=true"
                                    target="_blank" rel="noopener">
                                    View files
                                </a>
                            </li>
                            <li>
                                Area X Compliance Reports Level IV Phase 2 –
                                <a href="https://docs.google.com/document/d/1SHi_PaYMG9ed2d4uyIWBD2Y-itm54LGl/edit?usp=drive_link&ouid=118193976169173204719&rtpof=true&sd=true"
                                    target="_blank" rel="noopener">
                                    View files
                                </a>
                            </li>
                        </ul>

                        <h6 style="margin-top:1rem;">Special Areas</h6>
                        <ul class="browser-default">
                            <li>
                                Community Service –
                                <a href="https://docs.google.com/document/d/1iP_A7G4mGjmY0rOvV-Ww0X2PuSD1sqor/edit?usp=drive_link&ouid=118193976169173204719&rtpof=true&sd=true"
                                    target="_blank" rel="noopener">
                                    View files
                                </a>
                            </li>
                            <li>
                                International Linkages and Consortia –
                                <a href="https://docs.google.com/document/d/1qQcBxxLkkjSSz30cbZNZ5UyH1nihYHqE/edit?usp=drive_link&ouid=118193976169173204719&rtpof=true&sd=true"
                                    target="_blank" rel="noopener">
                                    View files
                                </a>
                            </li>
                            <li>
                                Performance of Graduates –
                                <a href="https://docs.google.com/document/d/1EhaWqHdM-kUKJZSvqovxJTWsRY1Y23he/edit?usp=drive_link&ouid=118193976169173204719&rtpof=true&sd=true"
                                    target="_blank" rel="noopener">
                                    View files
                                </a>
                            </li>
                            <li>
                                Planning Process –
                                <a href="https://docs.google.com/document/d/1vBD5jzVDDxb6W6c2Snmr65HO7gJtbIvA/edit?usp=drive_link&ouid=118193976169173204719&rtpof=true&sd=true"
                                    target="_blank" rel="noopener">
                                    View files
                                </a>
                            </li>
                            <li>
                                Research –
                                <a href="https://docs.google.com/document/d/1j-C8qg8XIiccimzl2uq-gTUAReREJ00c/edit?usp=drive_link&ouid=118193976169173204719&rtpof=true&sd=true"
                                    target="_blank" rel="noopener">
                                    View files
                                </a>
                            </li>
                        </ul>

                        {{-- 5. Narrative Profiles --}}
                        <h5 style="margin-top:1.5rem;">5. Narrative Profiles</h5>
                        <ul class="browser-default">
                            <li>
                                Community Service –
                                <a href="https://docs.google.com/document/d/1DR1Cy18P12esL21BtL5twZRWNcHlS7mq/edit?usp=drive_link&ouid=118193976169173204719&rtpof=true&sd=true"
                                    target="_blank" rel="noopener">
                                    View narrative
                                </a>
                            </li>
                            <li>
                                International Linkages and Consortia –
                                <a href="https://docs.google.com/document/d/14kmFHK32iPH-fhEiGx378xVQKgiV2Y5L/edit?usp=drive_link&ouid=118193976169173204719&rtpof=true&sd=true"
                                    target="_blank" rel="noopener">
                                    View narrative
                                </a>
                            </li>
                            <li>
                                Planning Process –
                                <a href="https://docs.google.com/document/d/1wqrV3qJTb2OlL90FZFDAVIdkB72P-R0N/edit?usp=drive_link&ouid=118193976169173204719&rtpof=true&sd=true"
                                    target="_blank" rel="noopener">
                                    View narrative
                                </a>
                            </li>
                            <li>
                                Research –
                                <a href="https://docs.google.com/document/d/1siLUBC_fqRlUWttle0vyRfUm-ZnAapMR/edit?usp=drive_link&ouid=118193976169173204719&rtpof=true&sd=true"
                                    target="_blank" rel="noopener">
                                    View narrative
                                </a>
                            </li>
                            <li>
                                Teaching and Learning –
                                <a href="https://drive.google.com/your-narrative-teaching-learning-link" target="_blank"
                                    rel="noopener">
                                    View narrative
                                </a>
                            </li>
                        </ul>

                        {{-- 6. Technical Review and Board Action --}}
                        <h5 style="margin-top:1.5rem;">6. Technical Review and Board Action</h5>
                        <ul class="browser-default">
                            <li>
                                Level III PHASE 2 –
                                <a href="https://drive.google.com/your-level3-phase2-link" target="_blank" rel="noopener">
                                    View documents
                                </a>
                            </li>
                            <li>
                                Level IV PHASE 1 –
                                <a href="https://drive.google.com/your-level4-phase1-link" target="_blank" rel="noopener">
                                    View documents
                                </a>
                            </li>
                            <li>
                                Level IV PHASE 2 –
                                <a href="https://drive.google.com/your-level4-phase2-link" target="_blank" rel="noopener">
                                    View documents
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            @else
                {{-- Generic fallback content for other programs --}}
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Accreditation Information</span>
                        <p class="grey-text text-darken-1" style="margin-bottom:1rem;">
                            This section contains accreditation documents, status, certificates, and related
                            information specific to <strong>{{ $course->name }}</strong>.
                        </p>
                        <p>
                            Please coordinate with the site administrator to add Google Drive links or other
                            accreditation resources for this program.
                        </p>
                    </div>
                </div>
            @endif
        @endif
    </div>
@endsection