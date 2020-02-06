<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use App\Nova\Actions\Delete;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Illuminate\Support\Carbon;
use Laravel\Nova\Fields\Select;

use Laravel\Nova\Fields\Textarea;
use App\Nova\Actions\MarkComplete;

use Laravel\Nova\Fields\BelongsTo;
use Illuminate\Support\Facades\Log;
use App\Nova\Actions\MarkInProgress;
use Laravel\Nova\Http\Requests\NovaRequest;
use Epartment\NovaDependencyContainer\HasDependencies;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;

class Task extends Resource
{
    use HasDependencies;

    public static function indexQuery(NovaRequest $request, $query)
    {
        if($request->user()->id === 5){
            return $query;
        }
        if($request->viaResource == 'projects'){
            return $query;
        }

        return $query->where('assigned_id', $request->user()->id)
                ->where(function ($query) {
                    $query->where('status_id', '!=', 3)
                    ->orWhere('end_status_id', '!=', 3);
                })->get();
            // ->where('project_id', $request->resourceId)

        // return $task->orWhere('end_date', '!=', NULL)->where('end_status_id', '!=', 3);
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Task';

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Tools';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    public static $with = ['user', 'project'];

    public static $perPageViaRelationship = 100;

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            BelongsTo::make('Docket#','project','App\Nova\Project')->rules('required')->readonly(function ($request) {
                return $request->isUpdateOrUpdateAttachedRequest();
            })->sortable()->searchable(),
            BelongsTo::make('Assigned', 'assigned', 'App\Nova\User')->rules('required')->sortable()->exceptOnForms()->hideFromIndex(),
            BelongsTo::make('Assigned', 'assigned', 'App\Nova\User')->rules('required')->sortable()->exceptOnForms()->canSee(function ($request) {

                return $request->viaResource == 'projects';

            })->onlyOnIndex(),
            Select::make('Assigned', 'assigned_id')->options(\App\User::where('ministry_id', '=', 1)->pluck('name','id'))->rules('required')->displayUsingLabels()->onlyOnForms(),
            BelongsTo::make('TaskType')->rules('required'),
            BelongsTo::make('Campus')->rules('required')->sortable()->hideFromIndex(),
            Date::make('Due Date', 'due_date')->format('MMMM Do')->rules('required')->creationRules('after_or_equal:tomorrow')->sortable(),
            Text::make('', function () {
                $date = Carbon::now();
                $nextWeek = Carbon::now()->addDays(7);
                $class = 'bg-50';
                
                if($nextWeek >= $this->due_date){
                    $class = "bg-info";
                }
                if($date > $this->due_date){
                    $class = "bg-danger";
                }
                if($this->status_id == 3){
                    $class = "bg-success";
                }
                
                return '<div class="h-4 w-4 rounded-full '.$class.'"></div>';
            })->asHTML()->hideFromDetail()->hideWhenCreating()->hideWhenUpdating(),
            Date::make('Close Date', 'end_date')->format('MMMM Do')->sortable(),
            Text::make('', function () {
                $date = Carbon::now();
                $nextWeek = Carbon::now()->addDays(7);
                $class = 'bg-50';
                
                if($nextWeek >= $this->end_date){
                    $class = "bg-info";
                }
                if($date > $this->end_date){
                    $class = "bg-danger";
                }
                if($this->end_status_id == 3){
                    $class = "bg-success";
                }

                if(!$this->end_date){
                    $class = "bg-white";
                }
                
                return '<div class="h-4 w-4 rounded-full '.$class.'"></div>';
            })->asHTML()->hideFromDetail()->hideWhenCreating()->hideWhenUpdating(),
            BelongsTo::make('Due Date Status', 'status', '\App\Nova\Status')->hideWhenCreating()->hideFromIndex()->nullable(),
            BelongsTo::make('Close Date Status', 'end_status', '\App\Nova\Status')->hideWhenCreating()->hideFromIndex()->nullable(),    
            Textarea::make('Details','description')->rules('required')->alwaysShow(),
            Text::make('Details', function () {
                return $this->description;
            })->onlyOnIndex()->readMore(['mask' => 'More Detail', 'max' => 150]),
            
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            (new MarkInProgress)
            ->confirmText('Are you sure you want to change request to In Progress')
            ->confirmButtonText('Change')
            ->cancelButtonText("Don't Change"),
            (new MarkComplete)
            ->confirmText('Are you sure you want to change request to Complete')
            ->confirmButtonText('Change')
            ->cancelButtonText("Don't Change"),
            (new Delete)
            ->confirmText('Are you sure you want to delete request')
            ->confirmButtonText('Delete')
            ->cancelButtonText("Don't Delete"),
        ];
    }
}
