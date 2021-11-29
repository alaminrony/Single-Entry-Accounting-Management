<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use Validator;

class ReceivableController extends Controller {

    public function index(Request $request) {

        $customers = ['' => __('lang.SELECT_CUSTOMER')] + User::where('role_id', '4')->pluck('name', 'id')->toArray();

        $targets = User::select('id', 'name')->where('role_id', '4');
        if (!empty($request->supplier_id)) {
            $targets = $targets->where('id', $request->customer_id);
        }

        $targets = $targets->paginate(5);
        
        $data['title'] = 'Account Receivable';
        $data['meta_tag'] = 'Account Receivable, rafiq & sons';
        $data['meta_description'] = 'Account Receivable, rafiq & sons';
        return view('backEnd.report.receivable.index')->with(compact('customers', 'targets','data'));
    }

    public function details(Request $request) {
        
        $customer_id = $request->id;

        $targets = Transaction::join('issues', 'issues.id', '=', 'transactions.issue_id')
                ->join('users', 'users.id', '=', 'transactions.user_id')
                ->select('transactions.created_at', 'transactions.transaction_type', 'transactions.amount', 'issues.issue_title', 'users.name', 'users.id as supplier_id')
                ->where('transactions.user_id', $request->id);

        if (!empty($request->from_date) && !empty($request->to_date)) {
            $targets = $targets->whereBetween('transactions.created_at', [$request->from_date . " 00:00:00", $request->to_date . " 23:59:59"]);
        }
        $targets = $targets->get();

        $bal = 0;
        foreach ($targets as $target) {
            if ($target->transaction_type == "in") {
                $bal += $target->amount;
                $target->balance = $bal;
            } else {
                $bal -= $target->amount;
                $target->balance = $bal;
            }
        }
        
        if($request->print == true){
             return view('backEnd.report.receivable.print')->with(compact('targets','customer_id'));
        }

        
        return view('backEnd.report.receivable.details')->with(compact('targets', 'customer_id'));
    }

    public function filter(Request $request) {

        $url = 'customer_id=' . $request->customer_id;

        return redirect('admin/account-receivable?' . $url);
    }

    public function detailsFilter(Request $request) {
        $rules = [
            'from_date' => 'required_with:to_date',
            'to_date' => 'required_with:from_date',
        ];

        $validator = Validator::make($request->all(), $rules);

        $url = 'filter=true' . '&from_date=' . $request->from_date . '&to_date=' . $request->to_date;

        if ($validator->fails()) {
            return redirect('admin/account-receivable/' . $request->customer_id . '/details?' . $url)->withInput()->withErrors($validator);
        }

        return redirect('admin/account-receivable/' . $request->customer_id . '/details?' . $url);
    }

}
