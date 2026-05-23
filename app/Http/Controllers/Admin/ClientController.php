<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::latest()->paginate(10);

        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        $clientUsers = \App\Models\User::where('role', 'client')
            ->orderBy('name')
            ->get();
        return view('admin.clients.create', compact('clientUsers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'name' => 'required|string|max:255',
            'ic_passport_no' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
        ]);

        $client = Client::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'ic_passport_no' => $request->ic_passport_no,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
        ]);

        AuditLog::record(
            'Client Created',
            'Clients',
            'Created client profile for ' . $client->name . '.'
        );

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client created successfully.');
    }
}