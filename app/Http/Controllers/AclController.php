<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\UserRole;
use App\Models\RoleToAccess;
use Validator;
use Session;

class AclController extends Controller {

    public function index(Request $request) {
//        echo "<pre>";print_r($request->all());exit;


        $targets = UserRole::orderBy('id', 'desc');
        if (!empty($request->role_id)) {
            $targets = $targets->where('id', $request->role_id);
        }

        $targets = $targets->paginate(5);

        $data['title'] = 'User Role';
        $data['meta_tag'] = 'User Role page, rafiq & sons';
        $data['meta_description'] = 'User Role rafiq & sons';
        return view('backEnd.acl.index')->with(compact('targets', 'data'));
    }

    public function create(Request $request) {
        $operationList = DB::table('module_operations')->join('module_names', 'module_names.id', '=', 'module_operations.module_id')
                ->select('module_operations.*', 'module_names.name')
                ->get();

        $operationArr = [];
        if ($operationList->isNotEmpty()) {
            foreach ($operationList as $operation) {
                $operationArr[$operation->name][$operation->id]['id'] = $operation->id;
                $operationArr[$operation->name][$operation->id]['name'] = $operation->name;
                $operationArr[$operation->name][$operation->id]['module_id'] = $operation->module_id;
                $operationArr[$operation->name][$operation->id]['operation'] = $operation->operation;
                $operationArr[$operation->name][$operation->id]['route'] = $operation->route;
            }
        }

        $roleWisePermissionArr = RoleToAccess::where('role_id', $request->role_id)->pluck('module_operation_id')->toArray();
        
//        echo "<pre>";print_r($operationArr);exit;
        return view('backEnd.acl.create')->with(compact('operationArr', 'roleWisePermissionArr'));
    }

    public function store(Request $request) {

        $data = [];
        $i = 0;
        if (!empty($request->accessArr)) {
            foreach ($request->accessArr as $moduleId => $targets) {
                foreach ($targets as $operationId => $target) {
                    $data[$i]['role_id'] = $request->role_id;
                    $data[$i]['module_id'] = $moduleId;
                    $data[$i]['module_operation_id'] = $operationId;
                    $i++;
                }
            }
        }
        RoleToAccess::where('role_id', $request->role_id)->delete();
        if (RoleToAccess::insert($data)) {
            Session::flash('success', __('lang.ACL_CREATED_SUCCESSFULLY'));
            return redirect()->back();
        }
    }

}
