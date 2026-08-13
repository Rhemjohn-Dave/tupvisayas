<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Category;
use App\Models\Event;
use App\Models\Job;
use App\Models\News;
use Illuminate\Database\Seeder;

/**
 * Temporary / sample content for local preview.
 *
 *   php artisan db:seed --class=DemoContentSeeder
 *
 * Remove later (admin UI or):
 *   php artisan db:seed --class=DemoContentSeeder --no-interaction
 *   then delete rows whose slug starts with "demo-".
 */
class DemoContentSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Academic', 'slug' => 'academic'],
            ['name' => 'Administrative', 'slug' => 'administrative'],
            ['name' => 'Events', 'slug' => 'events'],
            ['name' => 'General', 'slug' => 'general'],
            ['name' => 'Hiring', 'slug' => 'hiring'],
            ['name' => 'SIT / OJT', 'slug' => 'sit-ojt'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['slug' => $category['slug']], $category);
        }

        $academic = Category::where('slug', 'academic')->first();
        $admin = Category::where('slug', 'administrative')->first();
        $events = Category::where('slug', 'events')->first();
        $general = Category::where('slug', 'general')->first();
        $hiring = Category::where('slug', 'hiring')->first();
        $sit = Category::where('slug', 'sit-ojt')->first();

        foreach ($this->jobOpenings($hiring?->id, $admin?->id) as $row) {
            Job::updateOrCreate(
                ['slug' => $row['slug']],
                $row
            );
        }

        foreach ($this->campusRecruitment($sit?->id, $academic?->id) as $row) {
            Job::updateOrCreate(
                ['slug' => $row['slug']],
                $row
            );
        }

        foreach ($this->news($academic?->id, $general?->id) as $row) {
            News::updateOrCreate(['slug' => $row['slug']], $row);
        }

        foreach ($this->announcements($academic?->id, $events?->id, $general?->id) as $row) {
            Announcement::updateOrCreate(['slug' => $row['slug']], $row);
        }

        foreach ($this->events($events?->id, $academic?->id) as $row) {
            Event::updateOrCreate(['slug' => $row['slug']], $row);
        }

        $this->command?->info('Demo content seeded (slugs prefixed with demo-).');
        $this->command?->info('HR openings: /jobs?type=job_opening');
        $this->command?->info('SIT recruitment: /jobs?type=campus_recruitment');
    }

    private function jobOpenings(?int $hiringId, ?int $adminId): array
    {
        $cat = $hiringId ?: $adminId;

        return [
            [
                'slug' => 'demo-instructor-i-coe',
                'title' => '[DEMO] Instructor I — College of Engineering',
                'listing_type' => Job::TYPE_JOB_OPENING,
                'category_id' => $cat,
                'content' => <<<'HTML'
<p><strong>Temporary sample posting</strong> from campus HR. Replace or delete before going live.</p>
<p>TUP Visayas is inviting qualified applicants for <strong>Instructor I</strong> under the College of Engineering.</p>
<h3>Minimum qualifications</h3>
<ul>
<li>Bachelor’s degree in Engineering (licensed engineer preferred)</li>
<li>Relevant teaching or industry experience</li>
<li>Willingness to handle lecture and laboratory classes</li>
</ul>
<h3>How to apply</h3>
<p>Submit a letter of intent, PDS, TOR, and PRC ID (if applicable) to the Human Resource Office, TUP Visayas, Talisay City.</p>
HTML,
            ],
            [
                'slug' => 'demo-administrative-aide-vi',
                'title' => '[DEMO] Administrative Aide VI',
                'listing_type' => Job::TYPE_JOB_OPENING,
                'category_id' => $adminId ?: $cat,
                'content' => <<<'HTML'
<p><strong>Temporary sample posting</strong> — campus HR vacancy for clerical and records support.</p>
<p>The Administration is hiring an <strong>Administrative Aide VI</strong> to support campus offices with filing, receiving, and frontline transactions.</p>
<h3>Duties</h3>
<ul>
<li>Receive and route documents</li>
<li>Maintain office records and logs</li>
<li>Assist walk-in clients during office hours</li>
</ul>
<p>Apply through the HR Office. This is demo content only.</p>
HTML,
            ],
            [
                'slug' => 'demo-guidance-counselor',
                'title' => '[DEMO] Guidance Counselor',
                'listing_type' => Job::TYPE_JOB_OPENING,
                'category_id' => $cat,
                'content' => <<<'HTML'
<p><strong>Temporary sample posting</strong> for Student Affairs / Guidance.</p>
<p>TUP Visayas seeks a licensed <strong>Guidance Counselor</strong> to support student welfare, counseling, and related campus programs.</p>
<ul>
<li>RA 9258 licensed guidance counselor</li>
<li>Experience in a higher-education setting is an advantage</li>
</ul>
<p>Submit requirements to HR. Demo posting — not a live vacancy.</p>
HTML,
            ],
            [
                'slug' => 'demo-laboratory-technician-uitc',
                'title' => '[DEMO] Laboratory Technician — UITC',
                'listing_type' => Job::TYPE_JOB_OPENING,
                'category_id' => $cat,
                'content' => <<<'HTML'
<p><strong>Temporary sample posting</strong> for the University IT Center.</p>
<p>Assist in computer laboratory operations, equipment inventory, and first-level technical support for students and faculty.</p>
<ul>
<li>Graduate of IT, Computer Engineering, or related program</li>
<li>Familiar with PC troubleshooting and lab upkeep</li>
</ul>
<p>Campus HR posting (demo). Not an official opening.</p>
HTML,
            ],
        ];
    }

    private function campusRecruitment(?int $sitId, ?int $academicId): array
    {
        $cat = $sitId ?: $academicId;

        return [
            [
                'slug' => 'demo-sit-electrical-plant',
                'title' => '[DEMO] SIT / OJT — Electrical Engineering (Plant operations)',
                'listing_type' => Job::TYPE_CAMPUS_RECRUITMENT,
                'category_id' => $cat,
                'content' => <<<'HTML'
<p><strong>Temporary sample posting</strong> from the SIT Office for TUP Visayas students.</p>
<p>A partner industrial plant is accepting <strong>Electrical Engineering</strong> trainees for Supervised Industrial Training.</p>
<h3>Who may apply</h3>
<ul>
<li>Enrolled TUP Visayas students scheduled for SIT this term / summer</li>
<li>Endorsed by the program adviser and SIT Office</li>
</ul>
<h3>Duration</h3>
<p>Following the college SIT schedule (typically 6–20 weeks depending on program).</p>
<p>Coordinate with the SIT Office — this is demo content only.</p>
HTML,
            ],
            [
                'slug' => 'demo-sit-it-support-internship',
                'title' => '[DEMO] Internship — IT Support / Helpdesk',
                'listing_type' => Job::TYPE_CAMPUS_RECRUITMENT,
                'category_id' => $cat,
                'content' => <<<'HTML'
<p><strong>Temporary sample posting</strong> for Computer Engineering / IT students.</p>
<p>A partner company is opening student internship slots for first-level IT support, ticketing, and workstation setup.</p>
<ul>
<li>SIT-eligible TUP Visayas students</li>
<li>Basic networking and OS troubleshooting</li>
</ul>
<p>Apply through the SIT Office. Demo listing — not a live partner call.</p>
HTML,
            ],
            [
                'slug' => 'demo-sit-mechanical-fabrication',
                'title' => '[DEMO] SIT Placement — Mechanical / Fabrication shop',
                'listing_type' => Job::TYPE_CAMPUS_RECRUITMENT,
                'category_id' => $cat,
                'content' => <<<'HTML'
<p><strong>Temporary sample posting</strong> for Mechanical Engineering and related COET programs.</p>
<p>Hands-on SIT placement in a fabrication / metals shop: measurement, safety, and machine-shop practice under industry supervisors.</p>
<p>Students must complete SIT orientation and documentary requirements before deployment.</p>
<p>SIT Office demo listing only.</p>
HTML,
            ],
            [
                'slug' => 'demo-sit-quality-control-trainee',
                'title' => '[DEMO] Student trainee — Quality Control',
                'listing_type' => Job::TYPE_CAMPUS_RECRUITMENT,
                'category_id' => $cat,
                'content' => <<<'HTML'
<p><strong>Temporary sample posting</strong> for campus recruitment (SIT).</p>
<p>Partner firm is accepting student trainees for quality inspection, documentation, and production-line observation.</p>
<ul>
<li>Open to COE / COET / COAC students on SIT</li>
<li>Safety orientation required before reporting</li>
</ul>
<p>Inquiries: SIT Office. This is sample data for website testing.</p>
HTML,
            ],
        ];
    }

    private function news(?int $academicId, ?int $generalId): array
    {
        return [
            [
                'slug' => 'demo-campus-orientation-week',
                'title' => '[DEMO] Incoming freshmen orientation week announced',
                'category_id' => $academicId ?: $generalId,
                'content' => '<p><strong>Temporary sample news.</strong> Orientation week for incoming freshmen will cover enrollment, student services, and campus facilities. Confirm dates with Academic Affairs.</p>',
            ],
            [
                'slug' => 'demo-engineering-week-highlights',
                'title' => '[DEMO] Engineering Week highlights student projects',
                'category_id' => $academicId ?: $generalId,
                'content' => '<p><strong>Temporary sample news.</strong> Colleges showcased student prototypes and research posters during Engineering Week. This item is demo content only.</p>',
            ],
        ];
    }

    private function announcements(?int $academicId, ?int $eventsId, ?int $generalId): array
    {
        return [
            [
                'slug' => 'demo-class-suspension-notice',
                'title' => '[DEMO] Class suspension advisory (sample)',
                'category_id' => $academicId ?: $generalId,
                'content' => '<p><strong>Temporary sample announcement.</strong> Replace with official advisories from the Office of the Director. This is not a real suspension notice.</p>',
            ],
            [
                'slug' => 'demo-sit-orientation-reminder',
                'title' => '[DEMO] SIT orientation reminder for deploying students',
                'category_id' => $eventsId ?: $academicId ?: $generalId,
                'content' => '<p><strong>Temporary sample announcement.</strong> Students scheduled for SIT must complete orientation and documentary requirements before deployment. Contact the SIT Office.</p>',
            ],
        ];
    }

    private function events(?int $eventsId, ?int $academicId): array
    {
        $cat = $eventsId ?: $academicId;

        return [
            [
                'slug' => 'demo-career-fair',
                'title' => '[DEMO] Campus career fair',
                'category_id' => $cat,
                'content' => '<p><strong>Temporary sample event.</strong> A career fair for graduating students and SIT applicants. Demo content — dates are not official.</p>',
            ],
            [
                'slug' => 'demo-research-colloquium',
                'title' => '[DEMO] Student research colloquium',
                'category_id' => $cat,
                'content' => '<p><strong>Temporary sample event.</strong> Colleges present undergraduate research. This listing is for website testing only.</p>',
            ],
        ];
    }
}
