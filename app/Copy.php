<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Copy extends Model
{
    use SoftDeletes;
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = auth()->user()->id;
        });

        static::created(function ($model) {
            $user = \App\Department::where('name',"Copy")->first()->user;
            \Notification::route('mail', $user->email)
            ->notify(new \App\Notifications\CopyRequestMade($model));
            \Notification::route('mail', $model->user->email)
            ->notify(new \App\Notifications\CopyRequestMade($model));
        });
    }

    protected $casts = [
        'finishing' => 'array',
        'due_date' => 'date'
    ];

    protected $fillable = [
        'docket', 'due_date', 'copies', 'papersize', 'papertype', 'papercolour', 'finishing', 'information', 'distribute', 'distribute_amount', 'file', 'status_id'
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
