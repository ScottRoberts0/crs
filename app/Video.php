<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes;
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = auth()->user()->id;
        });

        static::created(function ($model) {
            $user = \App\Department::where('name',"Video")->first()->user;
            \Notification::route('mail', $user->email)
            ->notify(new \App\Notifications\VideoRequestMade($model));
            \Notification::route('mail', 'doug.cook@cschurch.ca')
            ->notify(new \App\Notifications\VideoRequestMade($model));
            \Notification::route('mail', 'dean.adams@cschurch.ca')
            ->notify(new \App\Notifications\VideoRequestMade($model));
            \Notification::route('mail', $model->user->email)
            ->notify(new \App\Notifications\VideoRequestMade($model));
        });
    }

    protected $casts = [
        'demographic' => 'array',
        'audience' => 'array',
        'lifestyle' => 'array',
        'date_needed' => 'date',
        'event_date' => 'date'
    ];

    protected $fillable = [
         'type','audience','focus','demographic','lifestyles','purpose', 'keymessage', 'walkaway','date_needed','event_date','time','location','status_id'
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
