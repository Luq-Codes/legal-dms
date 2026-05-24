<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'legal_case_id',
        'uploaded_by',
        'document_title',
        'original_filename',
        'file_path',
        'document_status',
        'notes',
    ];

    public function legalCase()
    {
        return $this->belongsTo(LegalCase::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}