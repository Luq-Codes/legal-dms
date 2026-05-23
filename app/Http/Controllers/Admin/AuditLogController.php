<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $module = $request->input('module');

        $logs = AuditLog::with('user')
            ->when($module, function ($query) use ($module) {
                $query->where('module', $module);
            })
            ->latest()
            ->paginate(10);

        $modules = [
            'Users',
            'Clients',
            'Cases',
            'Documents',
            'Search',
        ];

        return view('admin.audit-logs.index', compact('logs', 'modules', 'module'));
    }
}