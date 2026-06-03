<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Role extends Model
{
    protected $fillable = [
        'name'
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
    
}