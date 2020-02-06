<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use App\Nova\Actions\Delete;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use App\Nova\Actions\MarkComplete;
use Laravel\Nova\Fields\BelongsTo;
use App\Nova\Actions\MarkInProgress;
use Laravel\Nova\Http\Requests\NovaRequest;

class ProjectEditNote extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\ProjectEditNote';

    /**
     * The label associated with the resource.
     *
     * @var string
     */
    public static function label() {
        return 'Project Notes';
    }

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
    ];

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
            Trix::make('Content', 'content')->alwaysShow()->rules('required'),
            Text::make('Content', 'content', function() {
                return '<div class="py-4">'.$this->content.'</div>';
            })->onlyOnIndex()->asHtml(),
            BelongsTo::make('User')->hideWhenCreating()->hideWhenUpdating(),
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
