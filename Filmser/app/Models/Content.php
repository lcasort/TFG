<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    /**
     * Get the user that tagged the content.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
