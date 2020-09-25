<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'max_punctuation',
        'help_text',
        'order',
        'is_optional',
        'has_description_field',
        'description_label',
    ];

    /**
     * ==========
     * RELATIONSHIPS
     * ==========
     */

    /**
     * 
     *
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function Subcategory()
    {
        return $this->belongsTo('App\Models\Subcategory');
    }

    public function answers()
    {
        return $this->hasMany('App\Models\Answer');
    }

    /**
     * ==========
     * RELATIONSHIPS
     * ==========
     */

}
