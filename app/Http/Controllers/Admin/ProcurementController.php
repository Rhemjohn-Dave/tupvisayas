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

    public function create()
    {
        return view('admin.procurements.form', ['procurement' => new Procurement()]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('procurements', 'public');
            $data['file_url'] = Storage::url($path);
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
        $data = $this->validateData($request, $procurement->id);
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('procurements', 'public');
            $data['file_url'] = Storage::url($path);
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

    private function validateData(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'reference_no' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'posting_date' => ['required', 'date'],
            'closing_date' => ['nullable', 'date'],
            'type' => ['required', 'in:bid_opportunity,philgeps_posting'],
            'file' => ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx', 'max:10240'],
        ]);
    }
}
