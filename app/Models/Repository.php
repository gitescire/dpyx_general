<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Repository extends Model
{
    use HasFactory;

    protected $table = "repositories";
    protected $fillable = [
        "responsible_id",
        "name",
        "status",
        "comments"
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

    public function evaluationsHistory()
    {
        return $this->hasMany('App\Models\EvaluationHistory');
    }

    /**
     * ========
     * ATTRIBUTES
     * ========
     */

    public function getStatusColorAttribute(){
        if($this->is_in_progress) return 'info';
        if($this->evaluation->in_review) return 'info';
        if($this->is_aproved) return 'success';
        if($this->is_rejected) return 'danger';
        if($this->has_observations) return 'warning';
    }

    public function getQualificationAttribute()
    {
        // if (!$this->evaluation->answers->count()) return 0;
        if( $this->evaluation->answers->pluck('choice.question.max_punctuation')->flatten()->sum() == 0 ) return 0;

        return round($this->evaluation->answers->pluck('choice.punctuation')->flatten()->sum() / $this->evaluation->answers->pluck('question.max_punctuation')->flatten()->sum() * 100, 2);
    }

    /**
     * =======
     * BOOLEANS
     * =======
     */

    public function getIsInProgressAttribute()
    {
        return $this->status == 'en progreso';
    }

    public function getHasObservationsAttribute()
    {
        return $this->status == 'observaciones';
    }

    public function getIsAprovedAttribute()
    {
        return $this->status == 'aprobado';
    }

    public function getIsRejectedAttribute()
    {
        return $this->status == 'rechazado';
    }
}
