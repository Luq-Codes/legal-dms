<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LegalCase extends Model
{
    protected $fillable = [
        'client_id',
        'assigned_lawyer_id',
        'case_title',
        'case_reference',
        'case_type',
        'case_status',
        'next_important_date',
        'latest_client_update',
        'internal_notes',
        'opened_date',
        'closed_date',
        'archive_location',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function assignedLawyer()
    {
        return $this->belongsTo(User::class, 'assigned_lawyer_id');
    }

    public function staff()
    {
    return $this->belongsToMany(User::class, 'legal_case_staff', 'legal_case_id', 'staff_id');

    }

    public function documents()
    {
    return $this->hasMany(Document::class);
    }

    public function isAccessibleBy(User $user): bool
    {
    if ($user->role === 'admin') {
        return true;
    }

    if ($user->role === 'lawyer' && $this->assigned_lawyer_id === $user->id) {
        return true;
    }

    if ($user->role === 'staff' && $this->staff()->where('users.id', $user->id)->exists()) {
        return true;
    }

    return false;
    }
}
