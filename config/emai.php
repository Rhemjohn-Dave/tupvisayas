<?php

return [
    'name' => 'E-Mai',
    'full_name' => 'Electronics Machine AI',
    'tagline' => 'Your TUP Visayas AI assistant',
    'welcome' => "Hi! I'm E-Mai (Electronics Machine AI). Ask me about TUP Visayas admissions and programs, technology, PRC board exams, engineering topics, or other study questions.",
    'fallback' => "I don't have a confident answer for that yet. Try asking about admissions, TUPSTAT, programs, technology, PRC board exams — or visit the Admissions / Contact pages for official campus help.",

    'contact' => [
        'address' => 'Capt. Sabi Street, Brgy. Zone 12, Talisay City, Negros Occidental 6115',
        'phone' => '(034) 495-3480',
        'website' => 'https://www.tupvisayas.edu.ph/',
        'admissions_email' => null,
        'uitc_email' => 'visayas.uitc@tup.edu.ph',
        'transparency_email' => 'transparency@tupv.edu.ph',
    ],

    'faqs' => [
        [
            'id' => 'apply-not-graduated',
            'question' => 'Can I apply if I haven’t graduated yet?',
            'answer' => 'Yes—incoming senior high completers may apply as freshmen through the TUP ERS portal. Bring your final credentials when enrollment requirements are announced.',
            'keywords' => ['graduate', 'graduated', 'shs', 'senior high', 'incoming', 'not yet', 'haven\'t', 'havent', 'apply early', 'completer'],
            'category' => 'admissions',
            'links' => [
                ['label' => 'Admission procedure', 'route' => 'admissions.enrollment'],
            ],
        ],
        [
            'id' => 'course-quota',
            'question' => 'Is there a quota for each course?',
            'answer' => 'Yes. Programs admit a limited number of freshmen each year. Completing your ERS application early improves your chances of securing a preferred schedule and slot.',
            'keywords' => ['quota', 'slot', 'limited', 'capacity', 'available seats', 'course limit'],
            'category' => 'admissions',
            'links' => [
                ['label' => 'Undergraduate programs', 'route' => 'academics.undergraduate'],
            ],
        ],
        [
            'id' => 'tupstat-fee',
            'question' => 'How much is the TUPSTAT application fee?',
            'answer' => 'None. No admission testing fee shall be collected, consistent with universal access to quality tertiary education policies for eligible students in SUCs.',
            'keywords' => ['fee', 'payment', 'cost', 'how much', 'tuition entrance', 'testing fee', 'application fee', 'free'],
            'category' => 'admissions',
            'links' => [
                ['label' => 'Admission procedure', 'route' => 'admissions.enrollment'],
            ],
        ],
        [
            'id' => 'missed-exam',
            'question' => 'What if I miss my scheduled exam date?',
            'answer' => 'Contact Admissions as soon as possible. Makeup or alternate schedules depend on available slots and campus announcements—do not assume a walk-in seat without confirmation.',
            'keywords' => ['miss', 'missed', 'absent', 'reschedule', 'makeup', 'alternate', 'walk-in', 'walk in'],
            'category' => 'admissions',
            'links' => [
                ['label' => 'Admission procedure', 'route' => 'admissions.enrollment'],
                ['label' => 'Contact', 'route' => 'contact'],
            ],
        ],
        [
            'id' => 'ers-photo',
            'question' => 'What photo should I upload on ERS?',
            'answer' => 'Upload a low-resolution 2×2 photo in .jpeg or .jpg format.',
            'keywords' => ['photo', '2x2', '2×2', 'picture', 'upload photo', 'id picture', 'jpeg', 'jpg'],
            'category' => 'admissions',
        ],
        [
            'id' => 'ers-password',
            'question' => 'I forgot my ERS username or password. What should I do?',
            'answer' => 'Use recovery options on the ERS portal if available, or contact campus Admissions / UITC with your full name and applicant details for assistance.',
            'keywords' => ['password', 'username', 'forgot', 'login', 'ers account', 'reset', 'recover'],
            'category' => 'admissions',
            'links' => [
                ['label' => 'Contact', 'route' => 'contact'],
            ],
        ],
        [
            'id' => 'what-is-tupstat',
            'question' => 'What is TUPSTAT?',
            'answer' => 'TUPSTAT is the TUP Scholastic and Technical Aptitude Test—the entrance examination for freshman admission to engineering and technology programs at TUP Visayas.',
            'keywords' => ['tupstat', 'entrance exam', 'admission test', 'entrance test', 'scholastic', 'aptitude'],
            'category' => 'admissions',
            'links' => [
                ['label' => 'Admission procedure', 'route' => 'admissions.enrollment'],
            ],
        ],
        [
            'id' => 'how-to-apply',
            'question' => 'How do I apply for freshman admission?',
            'answer' => 'Create an applicant account on the TUP ERS portal, select Visayas Campus, complete your application, upload requirements, and choose your preferred TUPSTAT exam schedule. Follow the steps on the Admissions page.',
            'keywords' => ['how to apply', 'application', 'enroll', 'enrollment', 'freshman', 'freshmen', 'ers', 'register', 'sign up'],
            'category' => 'admissions',
            'links' => [
                ['label' => 'Admission procedure', 'route' => 'admissions.enrollment'],
            ],
        ],
        [
            'id' => 'documents',
            'question' => 'What documents do I need?',
            'answer' => 'Typical requirements include a recent 2×2 photo for ERS, Form 138 / SHS report card (upon enrollment), PSA Birth Certificate, and Certificate of Good Moral Character. Always follow the latest campus advisory for exact requirements.',
            'keywords' => ['document', 'requirements', 'requirement', 'birth certificate', 'good moral', 'form 138', 'report card', 'psa'],
            'category' => 'admissions',
            'links' => [
                ['label' => 'Admission procedure', 'route' => 'admissions.enrollment'],
            ],
        ],
        [
            'id' => 'programs',
            'question' => 'What undergraduate programs are offered?',
            'answer' => 'TUP Visayas offers undergraduate programs under its colleges (including Engineering, Engineering Technology, and Automation and Control). Browse the Academics section for the full list by college.',
            'keywords' => ['program', 'course', 'degree', 'bachelor', 'undergraduate', 'college', 'coe', 'coet', 'coac', 'curriculum'],
            'category' => 'academics',
            'links' => [
                ['label' => 'Academics overview', 'route' => 'academics'],
                ['label' => 'Undergraduate programs', 'route' => 'academics.undergraduate'],
            ],
        ],
        [
            'id' => 'colleges',
            'question' => 'What colleges does TUP Visayas have?',
            'answer' => 'Public college pages include the College of Engineering (COE), College of Engineering Technology (COET), and College of Automation and Control (COAC/CACE). Open Academics to explore each college.',
            'keywords' => ['college', 'coe', 'coet', 'coac', 'cace', 'engineering technology', 'automation'],
            'category' => 'academics',
            'links' => [
                ['label' => 'Academics overview', 'route' => 'academics'],
            ],
        ],
        [
            'id' => 'contact',
            'question' => 'How can I contact TUP Visayas?',
            'answer' => 'Use the Contact page for campus contact details and office information. For admission-specific concerns, reach out to the Admissions Office.',
            'keywords' => ['contact', 'email', 'phone', 'hotline', 'office', 'location', 'address', 'where'],
            'category' => 'campus',
            'links' => [
                ['label' => 'Contact page', 'route' => 'contact'],
            ],
        ],
        [
            'id' => 'news',
            'question' => 'Where can I find news and announcements?',
            'answer' => 'Campus news, events, and announcements are published on the News & Events and Announcements pages of this website.',
            'keywords' => ['news', 'announcement', 'events', 'update', 'advisory'],
            'category' => 'campus',
            'links' => [
                ['label' => 'News & Events', 'route' => 'news_events'],
                ['label' => 'Announcements', 'route' => 'announcements.index'],
            ],
        ],
        [
            'id' => 'jobs',
            'question' => 'Where are job openings posted?',
            'answer' => 'Career opportunities are listed on the Jobs page of the TUP Visayas website.',
            'keywords' => ['job', 'career', 'hiring', 'vacancy', 'employment', 'work'],
            'category' => 'campus',
            'links' => [
                ['label' => 'Jobs', 'route' => 'jobs'],
            ],
        ],
        [
            'id' => 'procurement',
            'question' => 'Where can I see bid opportunities?',
            'answer' => 'Procurement notices are available under Bid Opportunities and PhilGEPS Posting on this site.',
            'keywords' => ['bid', 'procurement', 'philgeps', 'tender', 'bidding'],
            'category' => 'campus',
            'links' => [
                ['label' => 'Bid opportunities', 'route' => 'procurement.bid'],
                ['label' => 'PhilGEPS', 'route' => 'procurement.philgeps'],
            ],
        ],
        [
            'id' => 'about',
            'question' => 'Tell me about TUP Visayas',
            'answer' => 'The Technological University of the Philippines Visayas is a state university focused on engineering and technology education. Learn more under About TUP (history, mission, values, mandate, and hymn).',
            'keywords' => ['about tup', 'about the university', 'history', 'mission', 'vision', 'mandate', 'tell me about tup', 'what is tup visayas'],
            'category' => 'campus',
            'links' => [
                ['label' => 'History', 'route' => 'about.history'],
                ['label' => 'Mission & Vision', 'route' => 'about.mission'],
            ],
        ],
        [
            'id' => 'who-are-you',
            'question' => 'Who are you?',
            'answer' => "I'm E-Mai — Electronics Machine AI — the FAQ assistant for the TUP Visayas website. I help with common questions about admissions, academics, and campus services.",
            'keywords' => ['who are you', 'your name', 'e-mai', 'emai', 'chatbot', 'bot', 'assistant', 'electronics machine'],
            'category' => 'meta',
        ],
        [
            'id' => 'exam-day-tips',
            'question' => 'What should I bring on TUPSTAT exam day?',
            'answer' => 'Bring your application form proof (screenshot or print), two sharpened pencils, and your Applicant ID details. Dress appropriately (no shorts, sleeveless tops, or slippers). Watches and cellphones are not allowed in the venue. Arrive at least 30 minutes early. Parents and companions are not allowed inside the testing area.',
            'keywords' => ['exam day', 'what to bring', 'pencil', 'dress code', 'arrive', 'venue rules', 'watch', 'cellphone', 'parents'],
            'category' => 'admissions',
            'links' => [
                ['label' => 'Admission procedure', 'route' => 'admissions.enrollment'],
            ],
        ],
        [
            'id' => 'transferee-docs',
            'question' => 'What documents do transferees need?',
            'answer' => 'Transferees typically need an Official Transcript of Records, Transfer credentials or Honorable Dismissal, course descriptions for crediting evaluation, Certificate of Good Moral Character, and other documents required by the latest campus transfer advisory.',
            'keywords' => ['transferee', 'transfer', 'shifting', 'tor', 'honorable dismissal', 'transcript'],
            'category' => 'admissions',
            'links' => [
                ['label' => 'Admission procedure', 'route' => 'admissions.enrollment'],
            ],
        ],
        [
            'id' => 'results-release',
            'question' => 'When are TUPSTAT results released?',
            'answer' => 'Result release dates are announced through ERS and official campus advisories. Check the Admissions page and Announcements regularly for updates.',
            'keywords' => ['results', 'result', 'release', 'passers', 'qualified', 'when results'],
            'category' => 'admissions',
            'links' => [
                ['label' => 'Admission procedure', 'route' => 'admissions.enrollment'],
                ['label' => 'Announcements', 'route' => 'announcements.index'],
            ],
        ],
        [
            'id' => 'ers-portal',
            'question' => 'Where do I apply online?',
            'answer' => 'Freshman applicants apply through the official TUP ERS (Enrollment Registration System) applicant portal. Select Visayas Campus when registering.',
            'keywords' => ['ers', 'portal', 'apply online', 'registration', 'enrollment registration system', 'website apply'],
            'category' => 'admissions',
            'links' => [
                ['label' => 'Admission procedure', 'route' => 'admissions.enrollment'],
            ],
        ],
        [
            'id' => 'student-services',
            'question' => 'Where can I find student services?',
            'answer' => 'Student services and campus support information are available on the Student Services page. For specific offices, use the Contact page.',
            'keywords' => ['student services', 'registrar', 'library', 'osa', 'guidance', 'scholarship'],
            'category' => 'campus',
            'links' => [
                ['label' => 'Student services', 'route' => 'student_services'],
                ['label' => 'Contact', 'route' => 'contact'],
            ],
        ],
        [
            'id' => 'facilities',
            'question' => 'What facilities does the campus have?',
            'answer' => 'TUP Visayas provides laboratories, classrooms, and college facilities supporting engineering and technology programs. Visit the Facilities page for an overview.',
            'keywords' => ['facilities', 'laboratory', 'lab', 'campus tour', 'building'],
            'category' => 'campus',
            'links' => [
                ['label' => 'Facilities', 'route' => 'facilities'],
            ],
        ],
        [
            'id' => 'officials',
            'question' => 'Who are the campus officials?',
            'answer' => 'University leadership and college officials are listed on the Campus Officials page, including the Director and college deans.',
            'keywords' => ['officials', 'director', 'dean', 'president', 'leadership', 'campus head'],
            'category' => 'campus',
            'links' => [
                ['label' => 'Campus officials', 'route' => 'officials'],
            ],
        ],
    ],
    'suggestions' => [
        'How do I apply?',
        'What is the PRC board exam?',
        'Tips for studying engineering subjects',
        'What programs does COET offer?',
        'What is cloud computing?',
    ],

    /*
    |--------------------------------------------------------------------------
    | Groq AI fallback (optional)
    |--------------------------------------------------------------------------
    | When FAQ confidence is low, E-Mai can ask Groq using campus FAQ context.
    | Leave GROQ_API_KEY empty to keep keyword-only mode.
    */
    'ai' => [
        'enabled' => (bool) env('EMAI_AI_ENABLED', true),
        'provider' => 'groq',
        'api_key' => env('GROQ_API_KEY'),
        'base_url' => env('GROQ_BASE_URL', 'https://api.groq.com/openai/v1'),
        'model' => env('GROQ_MODEL', 'llama-3.1-8b-instant'),
        'timeout' => (int) env('GROQ_TIMEOUT', 20),
        'max_tokens' => (int) env('GROQ_MAX_TOKENS', 500),
        'temperature' => (float) env('GROQ_TEMPERATURE', 0.4),
        'context_faqs' => (int) env('EMAI_AI_CONTEXT_FAQS', 8),
        'min_faq_score' => (float) env('EMAI_FAQ_MIN_SCORE', 2.2),
        // Set false only on Windows local if cURL SSL CA is missing. Keep true on production.
        'verify_ssl' => filter_var(env('EMAI_AI_VERIFY_SSL', true), FILTER_VALIDATE_BOOLEAN),
        'cache' => [
            'enabled' => filter_var(env('EMAI_AI_CACHE_ENABLED', true), FILTER_VALIDATE_BOOLEAN),
            'ttl_minutes' => (int) env('EMAI_AI_CACHE_TTL', 360),
        ],
    ],
];
