<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\RoleToAccess;
use App\Models\ModuleOperation;
use Auth;

class AccessControl {

    public function handle(Request $request, Closure $next) {

        $roleToAccess = RoleToAccess::join('module_operations', 'module_operations.id', '=', 'role_to_accesses.module_operation_id')
                ->select('role_to_accesses.id', 'role_to_accesses.module_id', 'role_to_accesses.module_operation_id', 'module_operations.route', 'role_to_accesses.role_id')
                ->where('role_to_accesses.role_id', Auth::user()->role_id)
                ->pluck('module_operations.route', 'role_to_accesses.id')
                ->toArray();

//        echo "<pre>";print_r(\Request::route()->getName());exit;

        if (in_array(\Request::route()->getName(), $roleToAccess) == false) {
            return redirect()->route('admin.dashboard');
        }
        return $next($request);
    }

}
