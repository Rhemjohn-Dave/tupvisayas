<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UsgDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UsgDocumentController extends Controller
{
    public function index(Request $request)
    {
        $query = UsgDocument::query()->orderByDesc('issued_at')->orderByDesc('created_at');

        if ($request->filled('category') && array_key_exists($request->category, UsgDocument::categoryOptions())) {
            $query->where('category', $request->category);
        }

        if ($request->filled('q')) {
            $q = trim($request->q);
            $query->where(function ($builder) use ($q) {
                $builder->where('title', 'like', "%{$q}%")
                    ->orWhere('reference_no', 'like', "%{$q}%")
                    ->orWhere('summary', 'like', "%{$q}%");
            });
        }

        $documents = $query->paginate(15)->withQueryString();

        return view('admin.usg_documents.index', [
            'documents' => $documents,
            'categories' => UsgDocument::categoryOptions(),
            'filters' => [
                'category' => $request->category,
                'q' => $request->q,
            ],
        ]);
    }

    public function create()
    {
        return view('admin.usg_documents.create', [
            'categories' => UsgDocument::categoryOptions(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateDocument($request);

        $path = $request->file('file')->store('usg/documents', 'public');

        UsgDocument::create([
            'title' => $validated['title'],
            'reference_no' => $validated['reference_no'] ?? null,
            'category' => $validated['category'],
            'issued_at' => $validated['issued_at'] ?? null,
            'summary' => $validated['summary'] ?? null,
            'file_path' => $path,
            'is_published' => $request->boolean('is_published'),
        ]);

        return redirect()->route('admin.usg-documents.index')
            ->with('success', 'USG document created.');
    }

    public function edit(UsgDocument $usg_document)
    {
        return view('admin.usg_documents.edit', [
            'document' => $usg_document,
            'categories' => UsgDocument::categoryOptions(),
        ]);
    }

    public function update(Request $request, UsgDocument $usg_document)
    {
        $validated = $this->validateDocument($request, false);

        $data = [
            'title' => $validated['title'],
            'reference_no' => $validated['reference_no'] ?? null,
            'category' => $validated['category'],
            'issued_at' => $validated['issued_at'] ?? null,
            'summary' => $validated['summary'] ?? null,
            'is_published' => $request->boolean('is_published'),
        ];

        if ($request->hasFile('file')) {
            if ($usg_document->file_path) {
                Storage::disk('public')->delete($usg_document->file_path);
            }
            $data['file_path'] = $request->file('file')->store('usg/documents', 'public');
        }

        $usg_document->update($data);

        return redirect()->route('admin.usg-documents.index')
            ->with('success', 'USG document updated.');
    }

    public function destroy(UsgDocument $usg_document)
    {
        if ($usg_document->file_path) {
            Storage::disk('public')->delete($usg_document->file_path);
        }

        $usg_document->delete();

        return redirect()->route('admin.usg-documents.index')
            ->with('success', 'USG document deleted.');
    }

    private function validateDocument(Request $request, bool $requireFile = true): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'reference_no' => 'nullable|string|max:255',
            'category' => ['required', Rule::in(array_keys(UsgDocument::categoryOptions()))],
            'issued_at' => 'nullable|date',
            'summary' => 'nullable|string|max:2000',
            'file' => ($requireFile ? 'required' : 'nullable').'|file|mimes:pdf|max:10240',
            'is_published' => 'nullable|boolean',
        ]);
    }
}
