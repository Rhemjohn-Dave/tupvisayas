<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Procurement;
use Illuminate\Support\Facades\Storage;

class ProcurementController extends Controller
{
    public function index()
    {
        $procurements = Procurement::orderByDesc('posting_date')->paginate(20);
        return view('admin.procurements.index', compact('procurements'));
    }

    public function destroyPoFile(Request $request, $id)
    {
        $procurement = Procurement::findOrFail($id);
        $validated = $request->validate([
            'index' => ['required', 'integer', 'min:0'],
        ]);

        $poFiles = is_array($procurement->po_files) ? $procurement->po_files : [];
        if (empty($poFiles) && !empty($procurement->po_file_url)) {
            $poFiles = [$procurement->po_file_url];
        }

        $index = (int) $validated['index'];
        if (!array_key_exists($index, $poFiles)) {
            abort(404);
        }

        $removedUrl = $poFiles[$index];
        // Attempt to delete the physical file from the public disk
        $relative = ltrim($removedUrl, '/');
        if (strpos($relative, 'storage/') === 0) {
            $relative = substr($relative, strlen('storage/'));
        }
        if (!empty($relative)) {
            Storage::disk('public')->delete($relative);
        }

        unset($poFiles[$index]);
        $poFiles = array_values($poFiles);
        $procurement->po_files = !empty($poFiles) ? $poFiles : null;
        $procurement->po_file_url = !empty($poFiles) ? $poFiles[0] : null;
        $procurement->save();

        return back()->with('status', 'Purchase Order file deleted.');
    }

    public function create()
    {
        return view('admin.procurements.form', ['procurement' => new Procurement()]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request, null);
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('procurements', 'public');
            $data['file_url'] = Storage::url($path);
        }
        // Handle multiple PO files
        $poFilesUrls = [];
        if ($request->hasFile('po_files')) {
            foreach ($request->file('po_files') as $poFile) {
                if ($poFile) {
                    $poPath = $poFile->store('procurements/po', 'public');
                    $poFilesUrls[] = Storage::url($poPath);
                }
            }
        }
        // Backward compatibility: accept single po_file as well
        if ($request->hasFile('po_file')) {
            $poPath = $request->file('po_file')->store('procurements/po', 'public');
            $poFilesUrls[] = Storage::url($poPath);
        }
        if (!empty($poFilesUrls)) {
            $data['po_files'] = $poFilesUrls;
            // Keep first as legacy field for any old view usage
            $data['po_file_url'] = $poFilesUrls[0];
        }
        Procurement::create($data);
        return redirect()->route('admin.procurements.index')->with('status', 'Procurement created.');
    }

    public function edit($id)
    {
        $procurement = Procurement::findOrFail($id);
        return view('admin.procurements.form', compact('procurement'));
    }

    public function update(Request $request, $id)
    {
        $procurement = Procurement::findOrFail($id);
        $data = $this->validateData($request, $procurement);
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('procurements', 'public');
            $data['file_url'] = Storage::url($path);
        }
        // Handle multiple PO files: append to existing
        $poFilesUrls = is_array($procurement->po_files) ? $procurement->po_files : [];
        if ($request->hasFile('po_files')) {
            foreach ($request->file('po_files') as $poFile) {
                if ($poFile) {
                    $poPath = $poFile->store('procurements/po', 'public');
                    $poFilesUrls[] = Storage::url($poPath);
                }
            }
        }
        // Backward compatibility: accept single po_file as well
        if ($request->hasFile('po_file')) {
            $poPath = $request->file('po_file')->store('procurements/po', 'public');
            $poFilesUrls[] = Storage::url($poPath);
        }
        if (!empty($poFilesUrls)) {
            $data['po_files'] = array_values(array_unique($poFilesUrls));
            $data['po_file_url'] = $data['po_files'][0];
        }
        $procurement->update($data);
        return redirect()->route('admin.procurements.index')->with('status', 'Procurement updated.');
    }

    public function destroy($id)
    {
        $procurement = Procurement::findOrFail($id);
        $procurement->delete();
        return redirect()->route('admin.procurements.index')->with('status', 'Procurement deleted.');
    }

    private function validateData(Request $request, ?Procurement $existing = null): array
    {
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'reference_no' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'posting_date' => ['required', 'date'],
            'closing_date' => ['nullable', 'date'],
            'type' => ['required', 'in:bid_opportunity,philgeps_posting'],
            'file' => ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx', 'max:10240'],
            'status' => ['required', 'in:pending,awarded'],
        ];
        // Multiple PO files support
        $rules['po_files'] = ['nullable', 'array'];
        $rules['po_files.*'] = ['file', 'mimes:pdf,doc,docx,xls,xlsx', 'max:10240'];
        // Backward-compatible single PO file
        $rules['po_file'] = ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx', 'max:10240'];

        $validated = $request->validate($rules);

        // Enforce at least one PO if status is awarded and none exists yet
        if (($validated['status'] ?? $request->input('status')) === 'awarded') {
            $hasNewMultiple = $request->hasFile('po_files');
            $hasNewSingle = $request->hasFile('po_file');
            $hasExisting = $existing && ((is_array($existing->po_files) && count($existing->po_files) > 0) || !empty($existing->po_file_url));
            if (!$hasNewMultiple && !$hasNewSingle && !$hasExisting) {
                abort(422, 'At least one Purchase Order file is required for awarded procurements.');
            }
        }

        return $validated;
    }
}
