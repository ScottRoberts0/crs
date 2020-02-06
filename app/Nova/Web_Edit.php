<?php

namespace App\Nova;

use Laravel\Nova\Panel;
use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\ID;
use App\Nova\Actions\Delete;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use App\Nova\Actions\MarkComplete;
use Laravel\Nova\Fields\BelongsTo;
use App\Nova\Actions\MarkInProgress;
use Laravel\Nova\Http\Requests\NovaRequest;

class Web_Edit extends Resource
{
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
    public static $model = 'App\Web_Edit';

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
        return 'Web Edits';
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
        'id',
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
            Text::make('Edit location web address', 'web_address')->hideFromIndex()->rules('required','url'),
            Text::make('URL', function() {
                return '<a href="mailto'. $this->web_address . '" target="_blank">' . $this->web_address . '</a>';
            })->onlyOnIndex()->asHtml(),
            Trix::make('Content')->alwaysShow()->rules('required'),
            Text::make('Content', function() {
                return '<div class="py-4">'.$this->content.'</div>';
            })->onlyOnIndex()->asHtml(),
            File::make('Attachment(10MB)', 'file')->disk('public')->nullable()->storeAs(function (Request $request) {
                return $request->file->getClientOriginalName();
            })->rules("max:10000"),
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