<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use Validator;

class PayableController extends Controller {

    public function index(Request $request) {
        $suppliers = ['' => __('lang.SELECT_SUPPLIER')] + User::where('role_id', '3')->pluck('name', 'id')->toArray();

        $targets = User::select('id', 'name')->where('role_id', '3');
        if(!empty($request->supplier_id)){
            $targets = $targets->where('id',$request->supplier_id);
        }
        
        $targets = $targets->paginate(5);

//        $supplierBalance = User::leftJoin('transactions','transactions.user_id','=','users.id')
//                ->where('users.role_id', '3')
//                ->select('users.id','users.name','users.balance as initial_balance','transactions.amount as tr_balance','transactions.transaction_type')
//                ->get();
//        if($supplierBalance->isNotEmpty()){
//            $balanceArr = [];
//            $i = 0;
//            foreach($supplierBalance as $balance){
//               $balanceArr[$i]['id']  =  $balance->id;
//               $balanceArr[$i]['name']  =  $balance->name;
//               $balanceArr[$i]['initial_balance']  =  $balance->initial_balance;
//               $balanceArr[$i]['tr_balance']  =  $balance->tr_balance;
//               $balanceArr[$i]['transaction_type']  =  $balance->transaction_type;
//               if(!empty($balance->tr_balance) && ($balance->transaction_type == 'in')){
//                   $balanceArr[$i]['total_balance']  =  $balanceArr[$i]['initial_balance'] + $balanceArr[$i]['tr_balance'];
//               }elseif(!empty($balance->tr_balance) && ($balance->transaction_type == 'out')){
//                   $balanceArr[$i]['total_balance']  =  $balanceArr[$i]['initial_balance'] - $balanceArr[$i]['tr_balance'];
//               }
//               else{
//                   $balanceArr[$i]['total_balance']  =  $balanceArr[$i]['initial_balance'];
//               }
//               $i++;
//            }
//        }
//        
//       echo "<pre>";print_r($balanceArr);exit;
//        
//        if(!empty($balanceArr)){
//            $balanceSumArr = [];
//            $j = 0;
//            $inBalance = 20;
//            $outBalance = 0;
//            foreach($balanceArr as $key => $balanceSum){
//                if($balanceSum['transaction_type'] == 'in'){
//                     $balanceSumArr[$balanceSum['id']]['inBalance']  =  $inBalance + $balance->tr_balance;
//                     
//                }
//            }
//        }
        
        $data['title'] = 'Account Payable';
        $data['meta_tag'] = 'Account Payable, rafiq & sons';
        $data['meta_description'] = 'Account Payable, rafiq & sons';
        return view('backEnd.report.payable.index')->with(compact('suppliers', 'targets','data'));
    }

    public function details(Request $request) {
        
        $supplier_id = $request->id;

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
             return view('backEnd.report.payable.print')->with(compact('targets','supplier_id'));
        }
        
        
        return view('backEnd.report.payable.details')->with(compact('targets','supplier_id'));
    }

    public function filter(Request $request) {

        $url = 'supplier_id=' . $request->supplier_id;

        return redirect('admin/account-payable?' . $url);
    }
    
    public function detailsFilter(Request $request) {
        
        $rules = [
            'from_date' => 'required_with:to_date',
            'to_date' => 'required_with:from_date',
        ];

        $validator = Validator::make($request->all(), $rules);

        $url = 'filter=true'.'&from_date=' . $request->from_date . '&to_date=' . $request->to_date;

        if ($validator->fails()) {
            return redirect('admin/account-payable/'.$request->supplier_id.'/details?' . $url)->withInput()->withErrors($validator);
        }

        return redirect('admin/account-payable/'.$request->supplier_id.'/details?' . $url);
    }

}
