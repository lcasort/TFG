<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the opinion.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
