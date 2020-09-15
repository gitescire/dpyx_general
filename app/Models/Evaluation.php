<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'repository_id',
        'evaluator_id',
        'is_answered',
    ];

    /**
     * ===========
     *  RELATIONSHIPS
     * ===========
     */

    public function answers()
    {
        return $this->hasMany('App\Models\Answer');
    }

    /**
     * ========
     * BOOLEANS
     * ========
     */

    public function getIsAnswerableAttribute()
    {
        if(Auth::user()->id != $this->repository->responsible->id){
            return false;
        }
        if($this->is_answered){
            return false;
        }
        return true;
    }
}
