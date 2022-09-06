<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\RoleToAccess;
use App\Models\Setting;
use DB;
use Auth;

class AppServiceProvider extends ServiceProvider {

    public function register() {
        view()->composer('*', function ($view) {

            if (Auth::check()) {
                $roleToAccess = RoleToAccess::join('module_names', 'module_names.id', '=', 'role_to_accesses.module_id')
                        ->join('module_operations', 'module_operations.id', '=', 'role_to_accesses.module_operation_id')
                        ->where('role_id', Auth::user()->role_id)
                        ->select('role_to_accesses.*', 'module_names.name', 'module_operations.operation', 'module_operations.route')
                        ->get();

                $accessArr = [];
                $accessRouteArr = [];
                if ($roleToAccess->isNotEmpty()) {
                    foreach ($roleToAccess as $key => $access) {
                        $accessArr[$access->name][$access->module_operation_id] = $access->operation;
                        $accessRouteArr[$key] = $access->route;
                    }
                }
            }
//            echo "<pre>";
//            print_r($accessArr);
//            exit;

            $settings = Setting::get();
            $settingArr = [];
            if ($settings->isNotEmpty()) {
                foreach ($settings as $setting) {
                    if (!empty($setting->image)) {
                        $settingArr[$setting->key_name] = $setting->image;
                    } else {
                        $settingArr[$setting->key_name] = $setting->key_value;
                    }
                }
            }

            $view->with([
                'settingArr' => $settingArr,
                'accessArr' => isset($accessArr) ? $accessArr : [],
                'accessRouteArr' => isset($accessRouteArr) ? $accessRouteArr : [],
            ]);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        //
    }

}
