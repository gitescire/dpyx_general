<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
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

    public function evaluation(){
        return $this->hasOne('App\Models\Evaluation');
    }

    /**
     * ========
     * ATTRIBUTES
     * ========
     */

    public function getQualificationAttribute(){
        return $this->evaluation->answers->pluck('punctuation')->flatten()->sum() / $this->evaluation->answers->pluck('question.max_punctuation')->flatten()->sum() * 100;
    }

}
