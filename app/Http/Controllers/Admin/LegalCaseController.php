<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\LegalCase;
use App\Models\User;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class LegalCaseController extends Controller
{
    public function index()
    {
        $cases = LegalCase::with(['client', 'assignedLawyer', 'staff'])
            ->latest()
            ->get();

        return view('admin.cases.index', compact('cases'));
    }

    public function show(LegalCase $case)
    {
    $case->load(['client', 'assignedLawyer', 'staff', 'documents.uploader']);

    return view('admin.cases.show', compact('case'));
    }

    public function edit(LegalCase $case)
    {
        $clients = Client::orderBy('name')->get();

        $lawyers = User::where('role', 'lawyer')
            ->orderBy('name')
            ->get();

        $staff = User::where('role', 'staff')
            ->orderBy('name')
            ->get();

        $case->load('staff');

        return view('admin.cases.edit', compact('case', 'clients', 'lawyers', 'staff'));
    }

    public function update(Request $request, LegalCase $case)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'assigned_lawyer_id' => 'required|exists:users,id',
            'staff_ids' => 'nullable|array',
            'staff_ids.*' => 'exists:users,id',
            'case_title' => 'required|string|max:255',
            'case_reference' => 'required|string|max:255|unique:legal_cases,case_reference,' . $case->id,
            'case_type' => 'required|string|max:255',
            'case_status' => 'required|string|max:255',
            'next_important_date' => 'nullable|date',
            'latest_client_update' => 'nullable|string',
            'internal_notes' => 'nullable|string',
            'opened_date' => 'nullable|date',
            'closed_date' => 'nullable|date',
            'archive_location' => 'nullable|string|max:255',
        ]);

        $oldStatus = $case->case_status;

        $case->update([
            'client_id' => $request->client_id,
            'assigned_lawyer_id' => $request->assigned_lawyer_id,
            'case_title' => $request->case_title,
            'case_reference' => $request->case_reference,
            'case_type' => $request->case_type,
            'case_status' => $request->case_status,
            'next_important_date' => $request->next_important_date,
            'latest_client_update' => $request->latest_client_update,
            'internal_notes' => $request->internal_notes,
            'opened_date' => $request->opened_date,
            'closed_date' => $request->closed_date,
            'archive_location' => $request->archive_location,
        ]);

        $case->staff()->sync($request->staff_ids ?? []);

        AuditLog::record(
            'Case Updated',
            'Cases',
            'Updated case ' . $case->case_reference . '. Status changed from ' . $oldStatus . ' to ' . $case->case_status . '.'
        );

        return redirect()->route('admin.cases.show', $case)
            ->with('success', 'Case updated successfully.');
    }

    public function create()
    {
    $clients = Client::orderBy('name')->get();

    $lawyers = User::where('role', 'lawyer')
        ->orderBy('name')
        ->get();

    $staff = User::where('role', 'staff')
        ->orderBy('name')
        ->get();

    return view('admin.cases.create', compact('clients', 'lawyers', 'staff'));
    }

    public function store(Request $request)
    {
         $request->validate([
            'client_id' => 'required|exists:clients,id',
            'assigned_lawyer_id' => 'required|exists:users,id',
            'staff_ids' => 'nullable|array',
            'staff_ids.*' => 'exists:users,id',
            'case_title' => 'required|string|max:255',
            'case_reference' => 'required|string|max:255|unique:legal_cases,case_reference',
            'case_type' => 'required|string|max:255',
            'case_status' => 'required|string|max:255',
            'next_important_date' => 'nullable|date',
            'latest_client_update' => 'nullable|string',
            'internal_notes' => 'nullable|string',
            'opened_date' => 'nullable|date',
            'closed_date' => 'nullable|date',
            'archive_location' => 'nullable|string|max:255',
        ]);

        $case = LegalCase::create([
            'client_id' => $request->client_id,
            'assigned_lawyer_id' => $request->assigned_lawyer_id,
            'case_title' => $request->case_title,
            'case_reference' => $request->case_reference,
            'case_type' => $request->case_type,
            'case_status' => $request->case_status,
            'next_important_date' => $request->next_important_date,
            'latest_client_update' => $request->latest_client_update,
            'internal_notes' => $request->internal_notes,
            'opened_date' => $request->opened_date,
            'closed_date' => $request->closed_date,
            'archive_location' => $request->archive_location,
        ]);

$case->staff()->sync($request->staff_ids ?? []);

        AuditLog::record(
            'Case Created',
            'Cases',
            'Created case ' . $case->case_reference . ' - ' . $case->case_title . '.'
        );
        
        return redirect()->route('admin.cases.index')
            ->with('success', 'Case created successfully.');
    }
}