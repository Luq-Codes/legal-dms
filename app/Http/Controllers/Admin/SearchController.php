<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Document;
use App\Models\LegalCase;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        $clients = collect();
        $cases = collect();
        $documents = collect();

        if ($query) {
            AuditLog::record(
                'Search Performed',
                'Search',
                'Searched for "' . $query . '".'
            );
            
            $clients = Client::where('name', 'like', "%{$query}%")
                ->orWhere('ic_passport_no', 'like', "%{$query}%")
                ->orWhere('email', 'like', "%{$query}%")
                ->get();

            $cases = LegalCase::with(['client', 'assignedLawyer'])
                ->where('case_reference', 'like', "%{$query}%")
                ->orWhere('case_title', 'like', "%{$query}%")
                ->orWhere('case_type', 'like', "%{$query}%")
                ->orWhere('case_status', 'like', "%{$query}%")
                ->get();

            $documents = Document::with(['legalCase.client', 'uploader'])
                ->where('document_title', 'like', "%{$query}%")
                ->orWhere('original_filename', 'like', "%{$query}%")
                ->orWhere('document_status', 'like', "%{$query}%")
                ->get();
        }

        return view('admin.search.index', compact(
            'query',
            'clients',
            'cases',
            'documents'
        ));
    }
}