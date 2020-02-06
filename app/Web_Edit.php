<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Web_Edit extends Model
{
    use SoftDeletes;
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = auth()->user()->id;
        });

        static::created(function ($model) {
            $user = \App\Department::where('name',"Web")->first()->user;
            \Notification::route('mail', $user->email)
            ->notify(new \App\Notifications\WebRequestMade($model));
            \Notification::route('mail', $model->user->email)
            ->notify(new \App\Notifications\WebRequestMade($model));
        });
    }

    protected $fillable = [
        'web_address','content', 'file', 'status_id'
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
