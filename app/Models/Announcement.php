<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        "initial_date",
        "final_date",
    ];

    /**
     * ===========
     * SCOPE METHODS
     * ===========
     */

    public function scopeActive($query)
    {
        return $query->whereDate('initial_date', '<=', Carbon::now())
            ->whereDate('final_date', '>=', Carbon::now());
    }
}
