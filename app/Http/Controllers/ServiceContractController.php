<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use App\Models\ServiceCharge;
use App\Models\Invoice;
use Validator;

class ServiceContractController extends Controller {

    public function index(Request $request) {
        $users = ['' => __('lang.SELECT_PARTY')] + User::pluck('name', 'id')->toArray();

        $targets = User::select('id', 'name');
        if (!empty($request->user_id)) {
            $targets = $targets->where('id', $request->user_id);
        }

        $targets = $targets->paginate(10);

        $data['title'] = 'Service Contract report';
        $data['meta_tag'] = 'Service Contract report, rafiq & sons';
        $data['meta_description'] = 'Service Contract report, rafiq & sons';
        return view('backEnd.report.service_contract.index')->with(compact('users', 'targets', 'data'));
    }

    public function details(Request $request) {

        $user_id = $request->id;

        $targets = Transaction::join('issues', 'issues.id', '=', 'transactions.issue_id')
                ->join('users', 'users.id', '=', 'transactions.user_id')
                ->select('transactions.created_at', 'transactions.transaction_type', 'transactions.amount', 'issues.issue_title', 'users.name', 'users.id as supplier_id')
                ->where('transactions.user_id', $request->id);

        if (!empty($request->from_date) && !empty($request->to_date)) {
            $targets = $targets->whereBetween('transactions.created_at', [$request->from_date . " 00:00:00", $request->to_date . " 23:59:59"]);
        }
        $targets = $targets->get();

        $userName = User::where('id', $user_id)->select('name')->first();

//         echo "<pre>";print_r($supplierName->toArray());exit;

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

        if ($request->print == true) {
            return view('backEnd.report.service_contract.print')->with(compact('targets', 'user_id', 'userName'));
        }

        $totalContract = ServiceCharge::where('agent_id', $user_id)->sum('charge');
        $totalInvoiced = Invoice::where('bill_to', $user_id)->sum('total_amount');

        return view('backEnd.report.service_contract.details')->with(compact('targets', 'user_id', 'totalContract', 'totalInvoiced', 'userName'));
    }

    public function filter(Request $request) {
        $url = 'user_id=' . $request->user_id;
        return redirect('admin/party-ledger-list?' . $url);
    }

    public function detailsFilter(Request $request) {

        $rules = [
            'from_date' => 'required_with:to_date',
            'to_date' => 'required_with:from_date',
        ];

        $validator = Validator::make($request->all(), $rules);

        $url = 'filter=true' . '&from_date=' . $request->from_date . '&to_date=' . $request->to_date;

        if ($validator->fails()) {
            return redirect('admin/party-ledger-list/' . $request->user_id . '/details?' . $url)->withInput()->withErrors($validator);
        }

        return redirect('admin/party-ledger-list/' . $request->user_id . '/details?' . $url);
    }

}
