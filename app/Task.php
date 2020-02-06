<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = auth()->user()->id;
        });

        static::created(function ($model) {
            \Notification::route('mail', $model->assigned->email)
            ->notify(new \App\Notifications\TaskAssignedMade($model));
        });
    }

    protected $casts = [
        'due_date' => 'date',
        'end_date' => 'date',
    ];

    protected $fillable = [
        'due_date', 'end_date', 'project_id', 'campus_id', 'tasktype_id','status_id', 'description', 'assigned_id', 'user_id', 'status_id'
    ];

    public function tasktype()
    {
        return $this->belongsTo(TaskType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assigned()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function end_status()
    {
        return $this->belongsTo(Status::class);
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
