<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = auth()->user()->id;
            if($model->events === 0){
                $model->planning = 1;
            }
        });

        static::created(function ($model) {
            $project = \App\Department::where('name',"Project")->first()->user;
            $event = \App\Department::where('name',"Event")->first()->user;
            if($model->events === 1){
                \Notification::route('mail', $event->email)
                ->notify(new \App\Notifications\EventRequestMade($model));
                \Notification::route('mail', $project->email)
                ->notify(new \App\Notifications\EventRequestMade($model));
                \Notification::route('mail', $model->user->email)
                ->notify(new \App\Notifications\EventRequestMade($model));
            } else {
                \Notification::route('mail', $project->email)
                ->notify(new \App\Notifications\ProjectRequestMade($model));
                \Notification::route('mail', $model->user->email)
                ->notify(new \App\Notifications\ProjectRequestMade($model));
            }
            
        });
    }

    protected $casts = [
        'demographic' => 'array',
        'audience' => 'array',
        'lifestyle' => 'array',
        'focus' => 'array',
        'project_type' => 'array',
        'end_date' => 'date',
        'start_date' => 'date',
        'event_date' => 'date',
        'project_date' => 'date',
        'startDate' => 'date',
        'endDate' => 'date',
        'regStartDate' => 'date',
        'regEndDate' => 'date'
    ];

    protected $fillable = [
         'user_id','events','title','project_date','flex_date','project_type','notsure','usedfor','audience','scale','focus','demographic','lifestyles','event_description','event_date','event_time','tickets','method','start_date','end_date','rsvpname','budget','message','pursuit','support','moreinfo','file','status_id',
         'location','startDate','endDate','startTime','endTime','description','ticketType','costInclude','totalTickets','doorTickets','cheaque','regStartDate','regEndDate','regStartTime','regEndTime','contact','incomeCode','expenseLine','customMSG','specInfo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    } 
    
    public function tasks(){
        return $this->hasMany(Task::class);
    }

    public function notes(){
        return $this->hasMany(ProjectEditNote::class);
    }
}
