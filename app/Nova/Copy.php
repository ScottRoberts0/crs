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
use Laravel\Nova\Fields\Textarea;
use App\Nova\Actions\MarkComplete;
use Laravel\Nova\Fields\BelongsTo;

use App\Nova\Actions\MarkInProgress;
use Fourstacks\NovaCheckboxes\Checkboxes;
use Laravel\Nova\Http\Requests\NovaRequest;

use Epartment\NovaDependencyContainer\HasDependencies;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;

class Copy extends Resource
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
    public static $model = 'App\Copy';


    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Requests';

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
        'docket',
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
            (new Tabs('Copy Request# '.$this->id, [
                'Details'    => [
            ID::make('Copy#','id')->sortable()->onlyOnIndex(),
            Text::make('Status', function() {
                return $this->status->name;
            })->hideWhenCreating()->hideWhenUpdating(),
            Text::make('Docket#', 'docket'),
            Date::make('Due Date')->format('YYYY-MM-DD')->rules('required'),
            Text::make('Amount', 'copies')->rules('required','numeric')->help(
                'How many will you need printed or copied?'
            ),
            Select::make('Paper Size', 'papersize')->options([
                '1/4 Letter | 4.25" x 5.5"' => ' 1/4 Letter | 4.25" x 5.5"',
                'Half Letter | 8.5" x 5.5"' => 'Half Letter | 8.5" x 5.5"',
                'Letter | 8.5" x 11"' => 'Letter | 8.5" x 11"',
                'other' => 'Other'
            ])->displayUsingLabels()->hideFromIndex()->hideFromDetail(),
            NovaDependencyContainer::make([
                Text::make('Other Size?', 'papersize')
            ])->dependsOn('papersize', 'other')->hideFromDetail(),
            Select::make('Paper Type?', 'papertype')->options(\App\PaperType::all()->pluck('name','name')->push('Other'))->rules('required')->displayUsingLabels()->hideFromIndex()->hideFromDetail(),
            NovaDependencyContainer::make([
                Text::make('Other Type?', 'papertype')->rules('required')
            ])->dependsOn('papertype', 0)->hideFromDetail(),
            NovaDependencyContainer::make([
                Select::make('Paper Color', 'papercolour')->options(\App\CopySetting::where('paper_type_id', '=', 1)->pluck('paper_color','paper_color')->push('Other'))->rules('required')->displayUsingLabels(),
                ])->dependsOn('papertype', "Cover Regular")->hideFromDetail(),
            NovaDependencyContainer::make([
                Select::make('Paper Color', 'papercolour')->options(\App\CopySetting::where('paper_type_id', '=', 2)->pluck('paper_color','paper_color')->push('Other'))->rules('required')->displayUsingLabels(),
            ])->dependsOn('papertype', "Regular")->hideFromDetail(),
            NovaDependencyContainer::make([
                Text::make('Other Color?', 'papercolour')->rules('required')
            ])->dependsOn('papertype', 0)->hideFromDetail(),
            NovaDependencyContainer::make([
                Text::make('Other Color?', 'papercolour')->rules('required')
            ])->dependsOn('papercolour', 0)->hideFromDetail(),
            Text::make('Paper Size', function() {
                return $this->papersize;
            })->asHtml(),
            Text::make('Paper Type', function() {
                return $this->papertype;
            })->asHtml(),
            Text::make('Paper Colour', function() {
                return $this->papercolour;
            })->asHtml(),
            Checkboxes::make('Finishing Instructions', 'finishing')
                ->options(\App\CopyFinishing::all()->pluck('type', 'type'))->hideFromIndex(),
            Textarea::make('Additional Information', 'information')->alwaysShow()->nullable(),
            File::make('Attachment (10MB)', 'file')->disk('public')->prunable()->storeAs(function (Request $request) {
                return $request->file->getClientOriginalName();
            })->rules("max:10000"),
            Boolean::make('Distributed to All Campuses','distribute')->hideFromIndex(),
            NovaDependencyContainer::make([
                Textarea::make('If Yes, How many per campus?', 'distribute_ammount')->rules('required')
            ])->dependsOn('distribute', 1),
            BelongsTo::make('User')->hideWhenCreating()->hideWhenUpdating()->hideFromDetail(),
            new Panel('Contact Details', $this->contactDetails()),
        ],
        ]))->withToolbar(),
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
