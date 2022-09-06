<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\User;
use DB;

class LogController extends Controller {

    public function index(Request $request) {
        $users = ['' => __('lang.SELECT_USER')] + User::select(DB::raw("CONCAT(users.name,' (',users.phone,')') as name"), 'users.id as id')->pluck('name', 'id')->toArray();
        $targets = Log::paginate(10);

//        echo "<pre>";
//        print_r($targets->toArray());
//        exit;

        return view('backEnd.report.log.index')->with(compact('targets', 'users'));
    }

}
