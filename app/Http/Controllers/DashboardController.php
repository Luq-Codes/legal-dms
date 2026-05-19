<?php

namespace App\Http\Controllers;

use App\Models\LegalCase;
use App\Models\AuditLog;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'lawyer') {
            return redirect()->route('lawyer.dashboard');
        }

        if ($user->role === 'staff') {
            return redirect()->route('staff.dashboard');
        }

        if ($user->role === 'client') {
            return redirect()->route('client.dashboard');
        }

        abort(403, 'Unauthorized');
    }

    public function lawyer()
    {
    return view('dashboards.lawyer');
    }

    public function lawyerActiveCases()
    {
    $cases = LegalCase::with(['client', 'staff'])
        ->where('assigned_lawyer_id', auth()->id())
        ->whereIn('case_status', [
            'Open',
            'In Progress',
            'Pending Hearing',
            'Pending Client',
        ])
        ->latest()
        ->get();

    return view('lawyer.cases.active', compact('cases'));
    }

    public function lawyerClosedCases()
    {
        $cases = LegalCase::with(['client', 'staff'])
            ->where('assigned_lawyer_id', auth()->id())
            ->whereIn('case_status', [
                'Closed',
                'Archived',
            ])
            ->latest()
            ->get();

        return view('lawyer.cases.closed', compact('cases'));
    }

    public function staff()
    {
        return view('dashboards.staff');
    }

    public function staffActiveCases()
    {
        $cases = auth()->user()
            ->assignedStaffCases()
            ->with(['client', 'assignedLawyer'])
            ->whereIn('case_status', [
                'Open',
                'In Progress',
                'Pending Hearing',
                'Pending Client',
            ])
            ->latest()
            ->get();

        return view('staff.cases.active', compact('cases'));
    }

    public function staffClosedCases()
    {
        $cases = auth()->user()
            ->assignedStaffCases()
            ->with(['client', 'assignedLawyer'])
            ->whereIn('case_status', [
                'Closed',
                'Archived',
            ])
            ->latest()
            ->get();

        return view('staff.cases.closed', compact('cases'));
    }

    public function closeCase(LegalCase $case)
    {
        $user = auth()->user();

        if ($user->role !== 'admin' && !($user->role === 'lawyer' && $case->assigned_lawyer_id === $user->id)) {
            abort(403, 'Unauthorized');
        }

        $case->update([
            'case_status' => 'Closed',
            'closed_date' => now()->toDateString(),
        ]);

        AuditLog::record(
            'Case Closed',
            'Cases',
            'Closed case ' . $case->case_reference . ' - ' . $case->case_title . '.'
        );

        return redirect()->route('cases.show', $case)
            ->with('success', 'Case closed successfully.');
    }

    public function client()
    {
    $client = auth()->user()->client;

    if (!$client) {
        abort(403, 'No client profile linked to this account.');
    }

    $cases = LegalCase::with(['assignedLawyer'])
        ->where('client_id', $client->id)
        ->latest()
        ->get();

    return view('dashboards.client', compact('client', 'cases'));
    }

    public function showCase(LegalCase $case)
    {
    if (!$case->isAccessibleBy(auth()->user())) {
        abort(403, 'Unauthorized');
    }

    $case->load(['client', 'assignedLawyer', 'staff', 'documents.uploader']);

    return view('cases.show', compact('case'));
    }
}