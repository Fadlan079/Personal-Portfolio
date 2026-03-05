<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'user_id',
        'theme',
        'locale',
        'show_clock',
        'clock_format',
        'show_seconds',
        'show_date',
        'cursor_theme',
    ];

    /**
     * Get the user that owns the setting.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
