<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Repository extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = "repositories";
    protected $fillable = [
        "responsible_id",
        "name",
    ];

    /**
     * ==========
     * RELATIONSHIPS
     * ==========
     */

    public function responsible()
    {
        return $this->belongsTo('App\Models\User', 'responsible_id');
    }

    public function evaluation()
    {
        return $this->hasOne('App\Models\Evaluation');
    }

    /**
     * ========
     * ATTRIBUTES
     * ========
     */

    public function getQualificationAttribute()
    {
        if (!$this->evaluation->answers->count()) {
            return 0;
        }

        return round($this->evaluation->answers->pluck('choice.punctuation')->flatten()->sum() / $this->evaluation->answers->pluck('choice.question.max_punctuation')->flatten()->sum() * 100, 2);
    }

    /**
     * =======
     * BOOLEANS
     * =======
     */

    public function getIsInProgressAttribute()
    {
        return $this->status == 'in progress';
    }

    public function getHasObservationsAttribute()
    {
        return $this->status == 'observations';
    }

    public function getIsAprovedAttribute()
    {
        return $this->status == 'aproved';
    }

    public function getIsRejectedAttribute()
    {
        return $this->status == 'rejected';
    }
}
