<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\LegalCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function create(LegalCase $case)
    {
        return view('admin.documents.create', compact('case'));
    }

    public function store(Request $request, LegalCase $case)
    {
        $request->validate([
            'document_title' => 'required|string|max:255',
            'document_status' => 'required|in:Draft,Under Review,Final,Signed,Archived',
            'file' => 'required|file|max:10240',
            'notes' => 'nullable|string',
        ]);

        $uploadedFile = $request->file('file');

        $filePath = $uploadedFile->store('case_documents', 'public');

        Document::create([
            'legal_case_id' => $case->id,
            'uploaded_by' => auth()->id(),
            'document_title' => $request->document_title,
            'original_filename' => $uploadedFile->getClientOriginalName(),
            'file_path' => $filePath,
            'document_status' => $request->document_status,
            'notes' => $request->notes,
        ]);

         return redirect()->route('admin.cases.show', $case)
            ->with('success', 'Document uploaded successfully.');
    }

    public function download(Document $document)
    {
        if (!Storage::disk('public')->exists($document->file_path)) {
        abort(404, 'File not found.');
        }

        return Storage::disk('public')->download(
        $document->file_path,
        $document->original_filename
        );
    }

    public function sharedCreate(LegalCase $case)
{
    if (!$case->isAccessibleBy(auth()->user())) {
        abort(403, 'Unauthorized');
    }

    return view('documents.create', compact('case'));
}

    public function sharedStore(Request $request, LegalCase $case)
    {
        if (!$case->isAccessibleBy(auth()->user())) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'document_title' => 'required|string|max:255',
            'document_status' => 'required|in:Draft,Under Review,Final,Signed,Archived',
            'file' => 'required|file|max:10240',
            'notes' => 'nullable|string',
        ]);

        $uploadedFile = $request->file('file');

        $filePath = $uploadedFile->store('case_documents', 'public');

        Document::create([
            'legal_case_id' => $case->id,
            'uploaded_by' => auth()->id(),
            'document_title' => $request->document_title,
            'original_filename' => $uploadedFile->getClientOriginalName(),
            'file_path' => $filePath,
            'document_status' => $request->document_status,
            'notes' => $request->notes,
        ]);

        return redirect()->route('cases.show', $case)
            ->with('success', 'Document uploaded successfully.');
    }

    public function sharedDownload(Document $document)
    {
        $case = $document->legalCase;

        if (!$case->isAccessibleBy(auth()->user())) {
            abort(403, 'Unauthorized');
        }

        if (!Storage::disk('public')->exists($document->file_path)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('public')->download(
            $document->file_path,
            $document->original_filename
        );
    }
}