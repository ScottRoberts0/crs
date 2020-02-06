<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function ministry()
    {
        return $this->belongsTo(Ministry::class);
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public function staffnets()
    {
        return $this->hasMany(Staffnet::class);
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function approvals()
    {
        return $this->hasMany(Department::class);
    }
}
