<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncementRepository extends Model
{
    use HasFactory;

    protected $table = "announcement_repository";

    public $fillable = [
        'id',
        'announcement_id',
        'repository_id',
        'extended_final_date',
        'created_at',
        'updated_at'
    ];

    public function announcement(){
        return $this->hasOne('App\Models\Announcement','id','announcement_id');
    }
    public function repository(){
        return $this->hasOne('App\Models\Repository','id','repository_id');
    }
}

