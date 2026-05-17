<?php

namespace App\Http\Controllers;

use App\Models\LegalCase;

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
        $cases = LegalCase::with(['client', 'staff'])
            ->where('assigned_lawyer_id', auth()->id())
            ->latest()
            ->get();

        return view('dashboards.lawyer', compact('cases'));
    }

    public function staff()
    {
    $cases = auth()->user()
        ->assignedStaffCases()
        ->with(['client', 'assignedLawyer'])
        ->latest()
        ->get();

    return view('dashboards.staff', compact('cases'));
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