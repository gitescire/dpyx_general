<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'evaluation_id',
        'punctuation',
        'description',
    ];

    /**
     * ==========
     * RELATIONSHIPS
     * ==========
     */

    public function question()
    {
        return $this->belongsTo('App\Models\Question');
    }

    public function observation()
    {
        return $this->hasOne('App\Models\Observation');
    }
}
