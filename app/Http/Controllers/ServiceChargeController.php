<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\ServiceCharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;
use DB;

class ServiceChargeController extends Controller {

    public function index(Request $request) {

        $targets = ServiceCharge::orderBy('id', 'desc');

        if (!empty($request->search_value)) {
            $searchText = $request->search_value;
            $targets->where(function ($query) use ($searchText) {
                $query->where('service_name', 'like', "%{$searchText}%");
                $query->orWhere('charge', 'like', "%{$searchText}%");
            });
        }
        $targets = $targets->paginate(5);
        $users = ['' => __('lang.SELECT_USER')] + User::join('user_roles', 'user_roles.id', 'users.role_id')->select(DB::raw("CONCAT(users.name,' (',user_roles.role_name,')') as name"), 'users.id as id')->pluck('name', 'id')->toArray();
        $data['title'] = 'ServiceCharge List';
        $data['meta_tag'] = 'ServiceCharge page, rafiq & sons';
        $data['meta_description'] = 'ServiceCharge, rafiq & sons';
        return view('backEnd.service.index')->with(compact('targets', 'data', 'users'));
    }

    public function create(Request $request) {
//        echo "<pre>";print_r($request->all());exit;
        $users = ['' => __('lang.SELECT_USER')] + User::join('user_roles', 'user_roles.id', 'users.role_id')->select(DB::raw("CONCAT(users.name,' (',user_roles.role_name,')') as name"), 'users.id as id')->pluck('name', 'id')->toArray();
        $view = view('backEnd.service.create')->with(compact('users'))->render();
        return response()->json(['data' => $view]);
    }

    public function store(Request $request) {
        $rules = [
            'agent_id' => 'required',
            'service_name' => 'required',
            'charge' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $target = new ServiceCharge;
        $target->agent_id = $request->agent_id;
        $target->service_name = $request->service_name;
        $target->charge = $request->charge;
        if ($target->save()) {
            return response()->json(['response' => 'success']);
        }
    }

    public function edit(Request $request) {
        $target = ServiceCharge::findOrFail($request->id);
        $users = ['' => __('lang.SELECT_USER')] + User::join('user_roles', 'user_roles.id', 'users.role_id')->select(DB::raw("CONCAT(users.name,' (',user_roles.role_name,')') as name"), 'users.id as id')->pluck('name', 'id')->toArray();
        $view = view('backEnd.service.edit')->with(compact('target', 'users'))->render();
        return response()->json(['data' => $view]);
    }

    public function update(Request $request) {
//        echo "<pre>";print_r($request->all());exit;
        $rules = [
            'agent_id' => 'required',
            'service_name' => 'required',
            'charge' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $target = ServiceCharge::findOrFail($request->id);
        $target->agent_id = $request->agent_id;
        $target->service_name = $request->service_name;
        $target->charge = $request->charge;
        if ($target->save()) {
            return response()->json(['response' => 'success']);
        }
    }

    public function view(Request $request) {
        
        $target = ServiceCharge::findOrFail($request->id);
        $users = ['' => __('lang.SELECT_USER')] + User::join('user_roles', 'user_roles.id', 'users.role_id')->select(DB::raw("CONCAT(users.name,' (',user_roles.role_name,')') as name"), 'users.id as id')->pluck('name', 'id')->toArray();
        $view = view('backEnd.service.view')->with(compact('users', 'target'))->render();
        return response()->json(['data' => $view]);
    }

    public function destroy(Request $request) {
        $target = ServiceCharge::findOrFail($request->id);
        if ($target->delete()) {
            Session::flash('success', __('lang.SERVICE_CHARGE_DELETED_SUCCESSFULLY'));
//            return redirect()->route('service.index', ['page' => $request->get('page', 1)]);
            return redirect()->route('serviceCharge.index');
        }
    }

    public function filter(Request $request) {
        $url = 'search_value=' . $request->search_value;
        return redirect('admin/service-charge?' . $url);
    }

}
