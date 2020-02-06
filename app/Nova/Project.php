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
use Illuminate\Support\Carbon;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
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

class Project extends Resource
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
    public static $model = 'App\Project';

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
    public function title()
    {
        return '#'.$this->id.' - '.$this->title;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'title',
        'user_id'
    ];

    public static $searchRelations = [
        'user' => ['name', 'email'],
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
            (new Tabs('Docket# '.$this->id.' - ' .$this->title, [
                'Details'    => [
            ID::make('Docket#','id')->sortable(),
            Boolean::make('Planning')->hideWhenCreating()->hideFromIndex()->hideFromDetail(),
            Text::make('', function () {
                
                $class = "bg-white";

                if($this->planning){
                    $class = "bg-purple";
                }
                
                if(!$this->planning){
                    $class = "bg-info";
                }

                if($this->status->id === 3){
                    $class = "bg-white";
                }

                if($this->events == 0){
                    $class = "bg-white";
                }
                
                return '<div class="h-4 w-4 rounded-full '.$class.'"></div>';
            })->asHTML()->hideFromDetail()->hideWhenCreating()->hideWhenUpdating(),
            Text::make('', function () {
                $date = Carbon::now();
                $nextWeek = Carbon::now()->addDays(7);
                $class = 'bg-50';
                
                if($nextWeek >= $this->project_date){
                    $class = "bg-warning";
                }
                if($date > $this->project_date){
                    $class = "bg-danger";
                }
                if($this->status->id === 3){
                    $class = "bg-success";
                }
                
                return '<div class="h-4 w-4 rounded-full '.$class.'"></div>';
            })->asHTML()->hideFromDetail()->hideWhenCreating()->hideWhenUpdating(),
            Text::make('Status', function() {
                return $this->status->name;
            })->hideWhenCreating()->hideWhenUpdating(),
            RadioButton::make('Project/Event','events')
            ->options([
                0 => 'Project',
                1 => 'Event',
            ]),
            Text::make('Project Title','title')->rules('required'),
            Date::make('Date Submitted', 'created_at')->sortable()->format('YYYY-MM-DD')->hideWhenCreating()->hideWhenUpdating(),
            Date::make('Project Needed', 'project_date')->sortable()->format('YYYY-MM-DD')->hideWhenCreating()->hideWhenUpdating(),
            
            NovaDependencyContainer::make([
                Heading::make('Project Details'),
                Date::make('Date Projet Needed','project_date')->format('YYYY-MM-DD')->rules('required')->rules('required')->creationRules('after_or_equal:tomorrow'),
                RadioButton::make('Is this date flexible?','flex_date')
                ->options([
                    1 => 'Yes',
                    0 => 'No',
                ])->default(1),
                Checkboxes::make('I think i need','project_type')
                ->options(\App\ProjectType::all()->pluck('name', 'name')->push('Other','Other'))->rules('required')->hideFromIndex(),
                Textarea::make('I need something different then on the above list?', 'notsure'),
                Textarea::make('What will this be used for?', 'usedfor')->rules('required'),
                Textarea::make('More information?', 'moreinfo'),
            ])->dependsOn('events', '0'),
            NovaDependencyContainer::make([
                Heading::make('Event Details'),
                Date::make('Event Date', 'project_date')->format('YYYY-MM-DD')->rules('required')->rules('required')->creationRules('after_or_equal:tomorrow'),
                Text::make('Event Time')->rules('required'),
                Textarea::make('Why should ppl attend your event', 'event_description')->rules('required'),
                Heading::make('Audience Details'),
                Checkboxes::make('Audience')
                ->options(\App\Audience::all()->pluck('name', 'name'))->rules('required')->hideFromIndex(),
                Text::make('How many ppl do you anticipate at your event?','scale')->rules('required'),
                RadioButton::make('Focus','focus')
                ->options(\App\Focus::all()->pluck('name', 'name')->toArray())->stack()->default('Both')->rules('required')->hideFromIndex(),
                Checkboxes::make('Demographic')
                ->options(\App\Demographic::all()->pluck('name', 'name'))->rules('required')->hideFromIndex(),
                Heading::make('Registration/Ticket Sales Details'),
                RadioButton::make('Will this event have registration/ticket sales?','tickets')
                ->options([
                    1 => 'Yes',
                    2 => 'Yes and Use Event Bright',
                    0 => 'No',
                ])->default(0),
                NovaDependencyContainer::make([
                    Date::make('Start Date')->format('YYYY-MM-DD')->rules('required')->rules('required')->creationRules('after_or_equal:tomorrow'),
                    Date::make('End Date')->format('YYYY-MM-DD')->rules('required')->rules('required')->creationRules('after_or_equal:tomorrow'),
                    Text::make('RSVP Contact Full Name', 'rsvpname')->rules('required'),
                    Text::make('RSVP Contact Email', 'rsvpemail')->rules('required'),
                    Text::make('RSVP Contact Phone', 'rsvpphone')->rules('required'),
                ])->dependsOn('tickets', '1'),
                NovaDependencyContainer::make([
                    Textarea::make('Event Location', 'event_description')->rules('required')->withMeta(['extraAttributes' => [
                        'placeholder' => 'Please included the full address, city, provience and postal code']
                    ]),
                    Date::make('Event Start Date', 'startDate')->format('YYYY-MM-DD')->rules('required')->rules('required')->creationRules('after_or_equal:tomorrow'),
                    Date::make('Event End Date', 'endDate')->format('YYYY-MM-DD')->rules('required')->rules('required')->creationRules('after_or_equal:tomorrow'),
                    Text::make('Event Start Time', 'startTime')->rules('required'),
                    Text::make('Event End Time', 'endTime')->rules('required'),
                    Textarea::make('Ticket Types/Price', 'ticketType')->rules('required')->withMeta(['extraAttributes' => [
                        'placeholder' => 'Early Bird/ $50.00 / Before Jan 15, 2016']
                    ]),
                    Textarea::make('How many Tickets do we want to make available?', 'totalTickets')->rules('required'),
                    Textarea::make('What does the cost include', 'costInclude')->rules('required'),
                    RadioButton::make('Do you plan to sell tickets at the door or in person via cash?','doorTickets')
                    ->options([
                        1 => 'Yes',
                        0 => 'No',
                    ])->default(0),
                    RadioButton::make('Do you plan to accept cheques?','cheaque')
                    ->options([
                        1 => 'Yes',
                        0 => 'No',
                    ])->default(0),
                    Date::make('Registration Start Date', 'regStartDate')->format('YYYY-MM-DD')->rules('required')->rules('required')->creationRules('after_or_equal:tomorrow'),
                    Date::make('Registration End Date', 'regEndDate')->format('YYYY-MM-DD')->rules('required')->rules('required')->creationRules('after_or_equal:tomorrow'),
                    Text::make('Registration Start Time', 'regStartTime')->rules('required'),
                    Text::make('Registration End Time', 'regEndTime')->rules('required'),
                    Textarea::make('Event Contact', 'contact')->rules('required')->withMeta(['extraAttributes' => [
                        'placeholder' => 'Please included the full name and email, phone is optional. If you do not include all the information needed we will use your info above.']
                    ]),
                    Text::make('Income Code:', 'incomeCode')->rules('required')->withMeta(['extraAttributes' => [
                        'placeholder' => '"Where the $$ will go']
                    ]),
                    Text::make('Expense Line', 'expenseLine')->withMeta(['extraAttributes' => [
                        'placeholder' => 'Where the fees will be charged']
                    ]),
                    Textarea::make('Custom Message', 'customMSG')->rules('required')->withMeta(['extraAttributes' => [
                        'placeholder' => 'Through eventbrite, you can add a custom message to the order confirmation emails. If you would like a custom email confirmation message please provide this custom message here:']
                    ]),
                    Textarea::make('Information Required From User', 'specInfo')->rules('required')->withMeta(['extraAttributes' => [
                        'placeholder' => 'Is there any specific information you need from those who purchase tickets? (ie- name, email, phone number, address, custom questions?):']
                    ]),

                ])->dependsOn('tickets', '2'),

                Heading::make('Extra Details'),
                Textarea::make('More information?', 'moreinfo'),

            ])->dependsOn('events', '1'),
            File::make('Attachment(10MB)', 'file')->disk('public')->storeAs(function (Request $request) {
                return $request->file->getClientOriginalName();
            })->rules("max:10000"),
            BelongsTo::make('User')->hideWhenCreating()->hideWhenUpdating()->hideFromDetail(),
            new Panel('Contact', $this->contactDetails()),
                    ],
                    'Tasks' => [
                        HasMany::make('Tasks'),
                    ],
                    'Notes/Edits' => [
                        HasMany::make('Notes/Edits', 'notes', 'App\Nova\ProjectEditNote'),
                    ]
        ]))->withToolbar(),
        ];
    }
/**
     * Get the contact detail fields for the resource
     * 
     * @return array
     */
    protected function productDetails()
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
                return $this->user->campus->name;
            })->hideFromIndex(),
            Text::make('Ministry', function() {
                return $this->user->ministry->name;
            })->hideFromIndex(),
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