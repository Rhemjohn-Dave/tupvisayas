<?php

namespace Database\Seeders;

use App\Models\AdmissionTestSchedule;
use Illuminate\Database\Seeder;

class AdmissionTestScheduleSeeder extends Seeder
{
    public function run(): void
    {
        if (AdmissionTestSchedule::query()->exists()) {
            return;
        }

        $defaultAddressCampus = 'Capt. Sabi, Brgy Zone 12, Talisay City, Negros Occidental';
        $bothSessions = "8 AM\n1 PM";

        $rows = [
            ['2026-01-22', $bothSessions, 'TUP Visayas Gymnasium', null, $defaultAddressCampus],
            ['2026-01-23', $bothSessions, 'TUP Visayas Gymnasium', null, $defaultAddressCampus],
            ['2026-01-24', $bothSessions, 'TUP Visayas Gymnasium', null, $defaultAddressCampus],
            ['2026-01-28', $bothSessions, 'Negros Occidental High School', 'Exclusive to their SHS students only', 'Araneta Street, Barangay 39, Bacolod City, Negros Occidental'],
            ['2026-01-31', $bothSessions, 'Eva J. Montilla Farm School', null, 'Barangay Inayawan, Mun. of Cauayan, Negros Occidental'],
            ['2026-02-07', $bothSessions, 'Hinigaran National High School', null, 'Rizal Street, Brgy. III, Mun. of Hinigaran, Negros Occidental'],
            ['2026-02-11', '8 AM', 'Bacolod City National High School', 'Exclusive to their SHS students only', 'P. Hernandez Extension, Brgy. Taculing, Bacolod City, Negros Occidental'],
            ['2026-02-13', '8 AM', 'Don Bosco Technical Institute', 'Exclusive to their SHS students only', 'Victorias Milling Company (VMC) Compound, Victorias City, Negros Occidental'],
            ['2026-02-21', $bothSessions, 'Doña Hortencia Salas Benedicto National High School — SHS Building', null, 'Gurrea Street, Barangay 1, La Carlota City, Negros Occidental'],
            ['2026-02-24', '8 AM', 'Pulupandan Municipal Auditorium', null, 'Municipality of Pulupandan, Negros Occidental'],
            ['2026-03-07', $bothSessions, 'Negros Women for Tomorrow Foundation / Dungganon — San Carlos City', null, 'Eco-Tourism Highway, Brgy. Palampas, San Carlos City'],
        ];

        foreach ($rows as $i => [$date, $times, $venue, $note, $address]) {
            AdmissionTestSchedule::create([
                'exam_date' => $date,
                'times' => $times,
                'venue' => $venue,
                'venue_note' => $note,
                'address' => $address,
                'is_published' => true,
                'sort_order' => $i + 1,
            ]);
        }
    }
}
