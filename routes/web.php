<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\LegalCaseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\AuditLogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/users', [UserController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.users.index');

Route::get('/admin/users/create', [UserController::class, 'create'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.users.create');

Route::post('/admin/users', [UserController::class, 'store'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.users.store');

Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.users.edit');

Route::put('/admin/users/{user}', [UserController::class, 'update'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.users.update');


Route::get('/admin/clients', [ClientController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.clients.index');

Route::get('/admin/clients/create', [ClientController::class, 'create'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.clients.create');

Route::post('/admin/clients', [ClientController::class, 'store'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.clients.store');

    Route::get('/admin/cases', [LegalCaseController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.cases.index');

Route::get('/admin/cases/create', [LegalCaseController::class, 'create'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.cases.create');

Route::get('/admin/cases/{case}', [LegalCaseController::class, 'show'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.cases.show');

Route::post('/admin/cases', [LegalCaseController::class, 'store'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.cases.store');

Route::get('/admin/cases/{case}/documents/create', [DocumentController::class, 'create'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.documents.create');

Route::post('/admin/cases/{case}/documents', [DocumentController::class, 'store'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.documents.store');

Route::get('/admin/documents/{document}/download', [DocumentController::class, 'download'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.documents.download');

Route::get('/admin/search', [SearchController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.search.index');   
    
Route::get('/admin/audit-logs', [AuditLogController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.audit-logs.index');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('/cases/{case}', [DashboardController::class, 'showCase'])
    ->middleware(['auth'])
    ->name('cases.show');
Route::get('/cases/{case}/documents/create', [DocumentController::class, 'sharedCreate'])
    ->middleware(['auth'])
    ->name('documents.create');

Route::post('/cases/{case}/documents', [DocumentController::class, 'sharedStore'])
    ->middleware(['auth'])
    ->name('documents.store');

Route::get('/documents/{document}/download', [DocumentController::class, 'sharedDownload'])
    ->middleware(['auth'])
    ->name('documents.download');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/admin-test', function() {
    return 'Admin access granted';
})->middleware(['auth', 'role:admin']);

Route::get('/admin/dashboard', function(){
    return view ('dashboards.admin');
})->middleware(['auth', 'role:admin'])->name('admin.dashboard');

Route::get('/lawyer/dashboard', [DashboardController::class, 'lawyer'])
    ->middleware(['auth', 'role:lawyer'])
    ->name('lawyer.dashboard');

Route::get('/lawyer/cases/active', [DashboardController::class, 'lawyerActiveCases'])
    ->middleware(['auth', 'role:lawyer'])
    ->name('lawyer.cases.active');

Route::get('/lawyer/cases/closed', [DashboardController::class, 'lawyerClosedCases'])
    ->middleware(['auth', 'role:lawyer'])
    ->name('lawyer.cases.closed');

Route::get('/staff/dashboard', [DashboardController::class, 'staff'])
    ->middleware(['auth', 'role:staff'])
    ->name('staff.dashboard');

    Route::get('/staff/cases/active', [DashboardController::class, 'staffActiveCases'])
    ->middleware(['auth', 'role:staff'])
    ->name('staff.cases.active');

Route::get('/staff/cases/closed', [DashboardController::class, 'staffClosedCases'])
    ->middleware(['auth', 'role:staff'])
    ->name('staff.cases.closed');

    Route::get('/client/dashboard', [DashboardController::class, 'client'])
    ->middleware(['auth', 'role:client'])
    ->name('client.dashboard');