<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserLog;
use App\Models\User;
use DB;

class UserLogController extends Controller {

    public function index(Request $request) {
        $users = ['' => __('lang.SELECT_USER')] + User::select(DB::raw("CONCAT(users.name,' (',users.phone,')') as name"), 'users.id as id')->pluck('name', 'id')->toArray();
        $targets = UserLog::paginate(10);

        return view('backEnd.report.user_log.index')->with(compact('targets', 'users'));
    }

}
