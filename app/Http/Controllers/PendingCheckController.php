<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Transaction;
use App\Models\PendingCheque;
use App\Models\BankAccount;
use App\Models\BankLedger;
use Session;
use DB;
use App\Helpers\Helper;

class PendingCheckController extends Controller {

    public function index(Request $request) {
//        echo "<pre>";print_r($request->all());exit;
        $transactionTypeArr = ['' => __('lang.SELECT_TR_TYPE'), 'in' => 'Cash In', 'out' => 'Cash Out'];
        $statusArr = ['' => __('lang.SELECT_STATUS'), '0' => 'Pending', '1' => 'Approved'];
        $bankInfoArr = PendingCheque::join('transactions', 'transactions.id', '=', 'pending_cheques.transaction_id')
                ->join('bank_accounts', 'bank_accounts.id', '=', 'transactions.bank_account_id')
                ->select(DB::raw("CONCAT(bank_accounts.bank_name,' => ',bank_accounts.account_name,' (',bank_accounts.account_no,')') as accountInfo"), 'transactions.id as tr_id')
                ->pluck('accountInfo', 'tr_id')
                ->toArray();
        
        
        $targets = PendingCheque::orderBy('id', 'desc');

        if ($request->status == '0' || $request->status == '1') {
            $targets = $targets->where('status', $request->status);
        }
        if (!empty($request->transaction_type)) {
            $targets = $targets->where('transaction_type', $request->transaction_type);
        }
        if (!empty($request->search_value)) {
            $searchText = $request->search_value;
            $targets->where(function ($query) use ($searchText) {
                $query->where('cheque_no', 'like', "%{$searchText}%")
                        ->orWhere('cheque_amount', 'like', "%{$searchText}%");
            });
        }

        $targets = $targets->paginate(5);
        
        $data['title'] = 'Pending Cheque';
        $data['meta_tag'] = 'Pending Cheque, rafiq & sons';
        $data['meta_description'] = 'Pending Cheque, rafiq & sons';
        return view('backEnd.pendingCheque.index')->with(compact('targets', 'bankInfoArr', 'transactionTypeArr', 'statusArr','data'));
    }

    public function approve(Request $request) {
        $target = PendingCheque::findOrFail($request->id);

        if (!empty($target->transaction_id)) {
            $transAction = Transaction::findOrFail($target->transaction_id);
        }
        if (!empty($transAction->bank_account_id)) {
            $bankAccount = BankAccount::findOrFail($transAction->bank_account_id);
            $accountBalance = $bankAccount->current_amount;
            if ($target->transaction_type == 'in') {
                $bankAccount->current_amount = $accountBalance + $target->cheque_amount;
            }
            if ($target->transaction_type == 'out') {
                $bankAccount->current_amount = $accountBalance - $target->cheque_amount;
            }
            $bankAccount->save();
        }

        $target->status = '1';
        if ($target->save()) {
            $addLedger = new BankLedger;
            $addLedger->bank_account_id = $transAction->bank_account_id;
            $addLedger->amount = $target->cheque_amount;
            $addLedger->transaction_type = $target->transaction_type;
            $addLedger->save();
            return response()->json(['response' => 'success']);
        }
    }

    public function destroy(Request $request) {
        $target = PendingCheque::findOrFail($request->id);
        $transAction = Transaction::findOrFail($target->transaction_id);

//        if (!empty($transAction->bank_account_id) && ($target->status == '1')) {
//            $bankAccount = BankAccount::findOrFail($transAction->bank_account_id);
//            $accountBalance = $bankAccount->current_amount;
//            if ($target->transaction_type == 'in') {
//                $bankAccount->current_amount = $accountBalance - $target->cheque_amount;
//            }
//            if ($target->transaction_type == 'out') {
//                $bankAccount->current_amount = $accountBalance + $target->cheque_amount;
//            }
//            $bankAccount->save();
//        }
        if ($target->delete()) {
            $transAction->delete();
            return response()->json(['response' => 'success']);
        }
    }

    public function filter(Request $request) {
        $url = 'status=' . $request->status . '&transaction_type=' . $request->transaction_type . '&search_value=' . $request->search_value;
        return redirect('admin/pending-cheque?' . $url);
    }

}
