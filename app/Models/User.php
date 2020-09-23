<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * ==========
     * RELATIONSHIPS
     * ==========
     */

    public function repositories()
    {
        return $this->hasMany('App\Models\Repository', 'responsible_id');
    }

    /**
     * ============
     * SCOPE METHODS
     * ============
     */

    public function scopeEvaluators($query)
    {
        return $query->whereHas('roles', function ($query) {
            return $query->where('name', 'evaluador');
        });
    }

    public function scopeUsers($query){
        return $query->whereHas('roles', function ($query) {
            return $query->where('name', 'usuario');
        });
    }

    /**
     * =======
     * BOOLEANS
     * =======
     */

    public function getHasRepositoriesAtttribute()
    {
        return $this->repositories->count() > 0;
    }

    public function getIsEvaluatorAttribute()
    {
        return $this->hasRole('evaluador');
    }
}
