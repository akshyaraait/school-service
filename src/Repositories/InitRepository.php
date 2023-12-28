<?php

namespace AkshyaraaIt\SchoolService\Repositories;

use App\SmGeneralSettings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Modules\RolePermission\Entities\AkshyaraaRole;
use Modules\RolePermission\Entities\Permission;
use Modules\RolePermission\Entities\AssignPermission;

class InitRepository {

    public function init() {
		config([
            'app.item' => '23876323',
            'akshyaraait.module_manager_model' => \App\AkshyaraaModuleManager::class,
            'akshyaraait.module_manager_table' => 'akshyaraa_module_managers',
            'akshyaraait.saas_module_name' => 'Saas',
            'akshyaraait.module_status_check_function' => 'moduleStatusCheck',

            'akshyaraait.settings_model' => SmGeneralSettings::class,
            'akshyaraait.module_model' => \Nwidart\Modules\Facades\Module::class,

            'akshyaraait.user_model' => \App\User::class,
            'akshyaraait.settings_table' => 'sm_general_settings',
            'akshyaraait.database_file' => 'akshyaraa_edu.sql',
            'akshyaraait.support_multi_connection' => true
        ]);
    }

    public function config()
	{
        app()->singleton('dashboard_bg', function () {
            $dashboard_background = DB::table('sm_background_settings')->where([['is_default', 1], ['title', 'Dashboard Background']])->first();
            return $dashboard_background;
        });

         app()->singleton('school_info', function () {
            return DB::table('sm_general_settings')->where('school_id', app('school')->id)->first();
        });

        app()->singleton('permission', function () {
            if(!Auth::check()){
                return [];
            }

            $akshyaraaRole = AkshyaraaRole::find(Auth::user()->role_id);
            $permissionIds = AssignPermission::where('role_id', Auth::user()->role_id)
            ->when($akshyaraaRole->is_saas == 0, function($q) {
                $q->where('school_id', Auth::user()->school_id);
            })->pluck('permission_id')->toArray();

            $permissions = Permission::whereIn('id', $permissionIds)
                                ->pluck('route')->toArray();  

            $cache_key = 'have_due_fees_'.auth()->user()->id ;
            if(Cache::get($cache_key) && auth()->user()->role_id == 2){
                $whitelist = ['fees.student-fees-list','fees.student-fees-list-parent','student_fees','student-dashboard'];
                $permissions = (array_intersect($whitelist, $permissions));
            }
            return  $permissions;
        });

	}

}
