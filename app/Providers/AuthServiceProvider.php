<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Approval' => 'App\Policies\ApprovalPolicy',
        'App\Audience' => 'App\Policies\AudiencePolicy',
        'App\Campus' => 'App\Policies\CampusPolicy',
        'App\Copy' => 'App\Policies\CopyPolicy',  
        'App\CopyFinishing' => 'App\Policies\CopyFinishingPolicy', 
        'App\CopySetting' => 'App\Policies\CopySettingPolicy', 
        'App\Demographic' => 'App\Policies\DemographicPolicy',
        'App\Department' => 'App\Policies\DepartmentPolicy',
        'App\Focus' => 'App\Policies\FocusPolicy',  
        'App\MaritialStatus' => 'App\Policies\MaritalStatusPolicy',
        'App\Ministry' => 'App\Policies\MinistryPolicy',      
        'App\PaperType' => 'App\Policies\PaperTypePolicy',
        'App\ProjectType' => 'App\Policies\ProjectTypePolicy',    
        'App\Role' => 'App\Policies\RolePolicy',  
        'App\Staffnet' => 'App\Policies\StaffnetPolicy',
        'App\Status' => 'App\Policies\StatusPolicy',  
        'App\TaskType' => 'App\Policies\TaskTypePolicy',  
        'App\User' => 'App\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
