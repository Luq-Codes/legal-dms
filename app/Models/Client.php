<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{   
    public function user()
    {
    return $this->belongsTo(User::class);
    }
    
    protected $fillable = [
        'user_id',
        'name',
        'ic_passport_no',
        'phone',
        'email',
        'address',
    ];
}