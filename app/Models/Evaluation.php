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
        'status',
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

    public function evaluator()
    {
        return $this->belongsTo('App\Models\User','evaluator_id','id');
    }

    /**
     * ========
     * BOOLEANS
     * ========
     */

    public function getIsInProgressAttribute(){
        return $this->status == 'in progress';
    }

    public function getInReviewAttribute()
    {
        return $this->status == 'in review';
    }

    public function getIsAnsweredAttribute()
    {
        return $this->status == 'answered';
    }

    public function getIsAnswerableAttribute()
    {
        if (Auth::user()->id != $this->repository->responsible->id) {
            return false;
        }
        if (!$this->is_in_progress && !$this->is_answered) {
            // dd('2 no');
            return false;
        }
        if(!$this->repository->is_in_progress && !$this->repository->has_observations){
            // dd('3 no');
            return false;
        }

        return true;
    }

    public function getIsReviewableAttribute()
    {
        if (Auth::user()->id != $this->evaluator->id) {
            return false;
        }
        if (!$this->in_review) {
            return false;
        }
        return true;
    }
}
