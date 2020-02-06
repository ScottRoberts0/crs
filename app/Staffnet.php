<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staffnet extends Model
{
    use SoftDeletes;
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = auth()->user()->id;
            

        });
        static::created(function ($model) {
            $user = \App\Department::where('name',"Staffnet")->first()->user;
            \Notification::route('mail', $user->email)
            ->notify(new \App\Notifications\StaffnetRequestMade($model));
            \Notification::route('mail', $model->user->email)
            ->notify(new \App\Notifications\StaffnetRequestMade($model));
        });
    }

    protected $fillable = [
        'title', 'content', 'file', 'status_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

}
