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
     * ==============
     *  RELATIONSHIPS
     * ==============
     */

    public function answers()
    {
        return $this->hasMany('App\Models\Answer');
    }

    public function repository()
    {
        return $this->belongsTo('App\Models\Repository');
    }

    /**
     * ========
     * BOOLEANS
     * ========
     */

    public function getIsAnswerableAttribute()
    {
        if (Auth::user()->id != $this->repository->responsible->id) {
            return false;
        }
        if ($this->is_answered) {
            return false;
        }
        return true;
    }

    public function getIsEvaluableAttribute(){
        if(Auth::user()->id != $this->evaluator_id){
            return false;
        }
        if(!$this->is_answered){
            return false;
        }
        return true;
    }
}
