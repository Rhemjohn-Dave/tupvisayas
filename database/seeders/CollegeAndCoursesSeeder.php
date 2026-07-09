<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CollegePage;
use App\Models\Course;
use App\Models\Department;

class CollegeAndCoursesSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'College of Engineering' => [
                'label' => 'College of Engineering',
                'courses' => [
                    'Bachelor of Science in Electronics Engineering',
                    'Bachelor of Science in Mechanical Engineering',
                    'Bachelor of Science in Computer Engineering',
                    'Bachelor of Science in Electrical Engineering',
                ],
            ],
            'College of Automation and Control' => [
                'label' => 'College of Automation and Control',
                'courses' => [
                    'Bachelor of Science in Instrumentation and Control Engineering',
                    'Bachelor of Science in Mechatronics Engineering',
                    'Bachelor of Technology in Mechatronics Technology',
                ],
            ],
            'College of Engineering Technology' => [
                'label' => 'College of Engineering Technology',
                'courses' => [
                    'Bachelor in Science in Chemistry',
                    'Bachelor in Engineering Technology major in Automotive Engineering Technology',
                    'Bachelor in Engineering Technology major in Chemical Engineering Technology',
                    'Bachelor in Engineering Technology major in Heating, Ventilation, Air Conditioning and Refrigeration Engineering Technology',
                    'Bachelor in Engineering Technology major in Computer Engineering Technology',
                    'Bachelor in Engineering Technology major in Manufacturing Engineering Technology',
                    'Bachelor in Engineering Technology major in Electronics Engineering Technology',
                    'Bachelor in Engineering Technology major in Electro-Mechanical Engineering Technology',
                    'Bachelor in Engineering Technology major in Electrical Engineering Technology',
                ],
            ],
        ];

        foreach ($data as $key => $payload) {
            $college = CollegePage::firstOrCreate(['college' => $key], [
                'history' => null,
                'department_faculty' => null,
                'student_organization' => null,
            ]);

            foreach ($payload['courses'] as $courseName) {
                $course = Course::firstOrCreate([
                    'college_page_id' => $college->id,
                    'name' => $courseName,
                ], [
                    'description' => null,
                ]);

                $dept = Department::firstOrCreate([
                    'college_page_id' => $college->id,
                    'name' => $courseName,
                ]);
                if ($dept->course_id !== $course->id) {
                    $dept->course_id = $course->id;
                    $dept->save();
                }
            }
        }
    }
}


