<?php

namespace App\Http\Controllers;

use App\Models\Official;
use Illuminate\Support\Collection;

class LibraryController extends Controller
{
    public function index()
    {
        $officials = Official::query()->get(['id', 'name', 'position', 'photo']);

        // These three must come from Officials only — never from /images/library.
        $leadership = [
            $this->fromOfficialsOnly(
                officials: $officials,
                needles: ['malo-oy', 'malooy', 'malo oy'],
                fallbackName: 'Eric A. Malo-oy, Ph.D.',
                fallbackTitle: 'Campus Director',
            ),
            $this->fromOfficialsOnly(
                officials: $officials,
                needles: ['delumpa'],
                fallbackName: 'Patrick John G. Delumpa, Ph.D.',
                fallbackTitle: 'Assistant Director for Academic Affairs',
            ),
        ];

        $libraryTeam = [
            $this->fromOfficialsOnly(
                officials: $officials,
                needles: ['dichosa'],
                fallbackName: 'Janette P. Dichosa, MSLS, RL',
                fallbackTitle: 'College Librarian III',
            ),
            $this->libraryOnly(
                name: 'Aisa Marie J. Ortega, PhD-TM, RL',
                title: 'College Librarian II',
                photo: 'images/library/ortega.jpg',
            ),
            $this->libraryOnly(
                name: 'Evelyn A. Flores, RL',
                title: 'College Librarian I',
                photo: 'images/library/flores.jpg',
            ),
            $this->libraryOnly(
                name: 'Juvielyn L. Estardo',
                title: 'Library Staff (J.O.)',
                photo: 'images/library/estardo.png',
            ),
        ];

        return view('pages.library', compact('leadership', 'libraryTeam'));
    }

    /**
     * @param  list<string>  $needles
     * @return array{name: string, title: string, photo_url: ?string, from_officials: bool}
     */
    private function fromOfficialsOnly(
        Collection $officials,
        array $needles,
        string $fallbackName,
        string $fallbackTitle,
    ): array {
        $match = $officials->first(function (Official $official) use ($needles) {
            $haystack = $this->normalize($official->name);

            foreach ($needles as $needle) {
                if (str_contains($haystack, $this->normalize($needle))) {
                    return true;
                }
            }

            return false;
        });

        if (! $match) {
            return [
                'name' => $fallbackName,
                'title' => $fallbackTitle,
                'photo_url' => null,
                'from_officials' => false,
            ];
        }

        return [
            'name' => $match->name,
            'title' => $match->position ?: $fallbackTitle,
            'photo_url' => filled($match->photo) ? asset('storage/' . ltrim($match->photo, '/')) : null,
            'from_officials' => true,
        ];
    }

    /**
     * @return array{name: string, title: string, photo_url: string, from_officials: bool}
     */
    private function libraryOnly(string $name, string $title, string $photo): array
    {
        return [
            'name' => $name,
            'title' => $title,
            'photo_url' => asset($photo),
            'from_officials' => false,
        ];
    }

    private function normalize(string $value): string
    {
        $value = mb_strtolower($value);
        $value = str_replace(['-', '.', ','], ' ', $value);

        return preg_replace('/\s+/', ' ', trim($value)) ?? '';
    }
}
