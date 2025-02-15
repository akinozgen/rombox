<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndexPages extends Model
{
    /** @use HasFactory<\Database\Factories\IndexPagesFactory> */
    use HasFactory;

    protected $fillable = [
        'url',
        'last_checked_at',
        'status_code',
        'error_message'
    ];

    protected $casts = [
        'last_checked_at' => 'datetime',
        'status_code' => 'integer'
    ];

    public static function updateStatus($id, $status_code, $error_message = null): void
    {
        static::findOrFail($id)->update([
            'last_checked_at' => now(),
            'status_code' => $status_code,
            'error_message' => $error_message
        ]);
    }
}
