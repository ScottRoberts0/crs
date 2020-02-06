<?php

namespace App\Nova;

use Laravel\Nova\Panel;
use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\ID;
use App\Nova\Actions\Delete;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Textarea;
use App\Nova\Actions\MarkComplete;
use Laravel\Nova\Fields\BelongsTo;

use App\Nova\Actions\MarkInProgress;
use OwenMelbz\RadioField\RadioButton;
use Fourstacks\NovaCheckboxes\Checkboxes;
use Laravel\Nova\Http\Requests\NovaRequest;
use Epartment\NovaDependencyContainer\HasDependencies;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;

class Video extends Resource
{
    use HasDependencies;

    public static function indexQuery(NovaRequest $request, $query)
    {
        if($request->user()->role->id <= 3){
            return $query;
        }

        return $query->where('user_id', $request->user()->id);
    }

    public static function detailQuery(NovaRequest $request, $query)
    {
        if($request->user()->role->id < 4){
            $item = $query->where('id', $request->resourceId)->first();
            if($item->status->id === 1){
                $item->update(['status_id' => 2]);
                return parent::detailQuery($request, $query);
            }
        }
        return parent::detailQuery($request, $query);
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Video';

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Requests';

    /**
     * The label associated with the resource.
     *
     * @var string
     */
    public static function label() {
        return 'Video';
    }

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
            Text::make('Status', function() {
                return $this->status->name;
            })->hideWhenCreating()->hideWhenUpdating(),
            Date::make('Due Date', function() {
                if($this->event_date){
                    return $this->event_date;
                }
                if($this->date_needed){
                    return $this->date_needed;
                }
            })->format('YYYY-MM-DD')->onlyOnIndex(),
            Select::make('Video Type', 'type')->options([
                'Original Video' => 'Original Video',
                'Live Video' => 'Live Video',
            ])->displayUsingLabels()->rules('required')->help(
                'Select Video Type for more options'
            )->readonly(function ($request) {
                return $request->isUpdateOrUpdateAttachedRequest();
            }),
            NovaDependencyContainer::make([
                Heading::make('Live Event Details'),
                Date::make('Event Date')->format('YYYY-MM-DD')->rules('required')->rules('required')->creationRules('after_or_equal:tomorrow'),
                Text::make('Time of Event', 'time')->rules('required'),
                Text::make('Location')->rules('required'),
                Textarea::make('Purpose of Video', 'purpose')->rules('required'),
            ])->dependsOn('type', 'Live Video'),
            NovaDependencyContainer::make([
                Heading::make('Audience Details'),
                Checkboxes::make('Audience')
                ->options(\App\Audience::all()->pluck('name', 'name'))->rules('required')->hideFromIndex(),
                RadioButton::make('Focus','focus')
                ->options(\App\Focus::all()->pluck('name', 'name')->toArray())->stack()->default('Both')->rules('required')->hideFromIndex(),
                Checkboxes::make('Demographic')
                ->options(\App\Demographic::all()->pluck('name', 'name'))->rules('required')->hideFromIndex(),
                Checkboxes::make('Maritial Status', 'lifestyles')
                ->options(\App\MaritalStatus::all()->pluck('name', 'name'))->rules('required')->hideFromIndex(),
                Heading::make('Message Details'),
                Textarea::make('What is the purpose of this video?', 'purpose')->rules('required'),
                Textarea::make('If you could summarize the videos key message what would it be?', 'keymessage')->rules('required'),
                Textarea::make('What do you want your audience to walk away feeling after watching this video?', 'walkaway')->rules('required'),
                Date::make('Date Needed')->format('YYYY-MM-DD')->rules('required')->rules('required')->creationRules('after_or_equal:tomorrow'),
            ])->dependsOn('type', 'Original Video'),
            Textarea::make('Do you know when and or where this video may play', 'whenwhere')->rules('required'),
            BelongsTo::make('User')->hideWhenCreating()->hideWhenUpdating()->hideFromDetail(),
            new Panel('Contact Details', $this->contactDetails()),
        ];
    }
 /**
     * Get the contact detail fields for the resource
     * 
     * @return array
     */
    protected function contactDetails()
    {
        return [
            Text::make('Name', function() {
                return $this->user->name;
            })->hideFromIndex(),
            Text::make('Email', function() {
                return $this->user->email;
            })->hideFromIndex(),
            Text::make('Phone', function() {
                return $this->user->phone;
            })->hideFromIndex(),
            Text::make('Campus', function() {
                if($this->user->campus){
                    return $this->user->campus->name;
                }
                return 'No campus assigned';
            })->hideFromIndex(),
            Text::make('Ministry', function() {
                if($this->user->ministry){
                    return $this->user->ministry->name;
                }
                return 'No ministry assigned';
            })->hideFromIndex(),
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
        return [
            new Filters\InProgress,
        ];
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
