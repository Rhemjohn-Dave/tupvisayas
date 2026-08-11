<?php

namespace App\Http\Controllers;

use App\Models\Official;
use Illuminate\Support\Collection;

class LibraryController extends Controller
{
    public function index()
    {
        $officials = Official::query()
            ->whereNotNull('photo')
            ->where('photo', '!=', '')
            ->get(['id', 'name', 'position', 'photo']);

        $leadership = [
            $this->person(
                officials: $officials,
                search: 'Malo-oy',
                fallbackName: 'Eric A. Malo-oy, Ph.D.',
                fallbackTitle: 'Campus Director',
                fallbackPhoto: 'images/library/malo-oy.jpg',
            ),
            $this->person(
                officials: $officials,
                search: 'Delumpa',
                fallbackName: 'Patrick John G. Delumpa, Ph.D.',
                fallbackTitle: 'Assistant Director for Academic Affairs',
                fallbackPhoto: 'images/library/delumpa.jpg',
            ),
        ];

        $libraryTeam = [
            $this->person(
                officials: $officials,
                search: 'Dichosa',
                fallbackName: 'Janette P. Dichosa, MSLS, RL',
                fallbackTitle: 'College Librarian III',
                fallbackPhoto: 'images/library/dichosa.jpg',
            ),
            $this->person(
                officials: $officials,
                search: null,
                fallbackName: 'Aisa Marie J. Ortega, PhD-TM, RL',
                fallbackTitle: 'College Librarian II',
                fallbackPhoto: 'images/library/ortega.jpg',
            ),
            $this->person(
                officials: $officials,
                search: null,
                fallbackName: 'Evelyn A. Flores, RL',
                fallbackTitle: 'College Librarian I',
                fallbackPhoto: 'images/library/flores.jpg',
            ),
            $this->person(
                officials: $officials,
                search: null,
                fallbackName: 'Juvielyn L. Estardo',
                fallbackTitle: 'Library Staff (J.O.)',
                fallbackPhoto: 'images/library/estardo.png',
            ),
        ];

        return view('pages.library', compact('leadership', 'libraryTeam'));
    }

    /**
     * @return array{name: string, title: string, photo_url: string, from_officials: bool}
     */
    private function person(
        Collection $officials,
        ?string $search,
        string $fallbackName,
        string $fallbackTitle,
        string $fallbackPhoto,
    ): array {
        $match = $search
            ? $officials->first(fn (Official $o) => str_contains(mb_strtolower($o->name), mb_strtolower($search)))
            : null;

        if ($match?->photo) {
            return [
                'name' => $match->name,
                'title' => $match->position ?: $fallbackTitle,
                'photo_url' => asset('storage/' . $match->photo),
                'from_officials' => true,
            ];
        }

        return [
            'name' => $fallbackName,
            'title' => $fallbackTitle,
            'photo_url' => asset($fallbackPhoto),
            'from_officials' => false,
        ];
    }
}
