<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\BankLedger;
use App\Models\BankAccount;
use DB;
use Session;
use App\Helpers\Helper;

class BankLedgerController extends Controller {

    public function index(Request $request) {
        $transactionTypeArr = ['' => __('lang.SELECT_TR_TYPE'), 'in' => 'Cash In', 'out' => 'Cash Out'];
        $bankAccountArr = BankAccount::select(DB::raw("CONCAT(bank_name,' (',branch,') => ',account_name,' (',account_no,')') as bank_account"), 'id')->pluck('bank_account', 'id')->toArray();
        $targets = BankLedger::join('bank_accounts', 'bank_accounts.id', '=', 'bank_ledgers.bank_account_id')
                ->select('bank_ledgers.id', 'bank_ledgers.bank_account_id', 'bank_ledgers.amount', 'bank_ledgers.note',
                        'bank_ledgers.transaction_type', 'bank_ledgers.created_at', 'bank_accounts.account_no', 'bank_accounts.account_name', 'bank_accounts.bank_name',
                        'bank_accounts.branch')
                ->where('bank_ledgers.bank_account_id', $request->id)
                ->paginate(5);
        $bank_account_id = $request->id;
        return view('backEnd.bankLedger.index')->with(compact('targets', 'transactionTypeArr', 'bankAccountArr', 'bank_account_id'));
    }

    public function ledgerList(Request $request) {

        $allDatas = BankLedger::join('bank_accounts', 'bank_accounts.id', '=', 'bank_ledgers.bank_account_id')
                ->select('bank_ledgers.id', 'bank_ledgers.bank_account_id', 'bank_ledgers.amount', 'bank_ledgers.note',
                        'bank_ledgers.transaction_type', 'bank_ledgers.created_at', 'bank_accounts.account_no', 'bank_accounts.account_name', 'bank_accounts.bank_name',
                        'bank_accounts.branch')
                ->where('bank_ledgers.bank_account_id', $request->bank_account_id)
                ->take(5)
                ->get();
        $in_targets = BankLedger::join('bank_accounts', 'bank_accounts.id', '=', 'bank_ledgers.bank_account_id')
                ->select('bank_ledgers.id', 'bank_ledgers.bank_account_id', 'bank_ledgers.amount', 'bank_ledgers.note',
                        'bank_ledgers.transaction_type', 'bank_ledgers.created_at', 'bank_accounts.account_no', 'bank_accounts.account_name', 'bank_accounts.bank_name',
                        'bank_accounts.branch')
                ->where('bank_ledgers.bank_account_id', $request->bank_account_id)
                ->where('bank_ledgers.transaction_type', 'in')
                ->take(5)
                ->get();
        $out_targets = BankLedger::join('bank_accounts', 'bank_accounts.id', '=', 'bank_ledgers.bank_account_id')
                ->select('bank_ledgers.id', 'bank_ledgers.bank_account_id', 'bank_ledgers.amount', 'bank_ledgers.note',
                        'bank_ledgers.transaction_type', 'bank_ledgers.created_at', 'bank_accounts.account_no', 'bank_accounts.account_name', 'bank_accounts.bank_name',
                        'bank_accounts.branch')
                ->where('bank_ledgers.bank_account_id', $request->bank_account_id)
                ->where('bank_ledgers.transaction_type', 'out')
                ->take(5)
                ->get();

        $bankAccountId = $request->bank_account_id;
        $transactionTypeArr = ['' => __('lang.SELECT_TR_TYPE'), 'in' => 'Cash In', 'out' => 'Cash Out'];
        $view = view('backEnd.bankLedger.list')->with(compact('allDatas', 'in_targets', 'out_targets', 'transactionTypeArr', 'bankAccountId'))->render();
        return response()->json(['data' => $view]);
    }

    public function create(Request $request) {
        $bank_account_id = $request->bank_account_id;
        $transactionTypeArr = ['' => __('lang.SELECT_TR_TYPE'), 'in' => 'Cash In', 'out' => 'Cash Out'];
        $view = view('backEnd.bankLedger.createLedger')->with(compact('bank_account_id', 'transactionTypeArr'))->render();
        return response()->json(['data' => $view]);
    }

    public function store(Request $request) {
        $rules = [
            'bank_account_id' => 'required',
            'transaction_type' => 'required',
            'amount' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $target = new BankLedger;
        $target->bank_account_id = $request->bank_account_id;
        $target->transaction_type = $request->transaction_type;
        $target->amount = $request->amount;
        $target->note = $request->note;
        if ($target->save()) {
            $bankAccount = BankAccount::where('id', $request->bank_account_id)->first();
            $accountBalance = $bankAccount->current_amount;
            if ($request->transaction_type == 'in') {
                $adjustBalance = $accountBalance + $request->amount;
            } elseif ($request->transaction_type == 'out') {
                $adjustBalance = $accountBalance - $request->amount;
            }
            $bankAccount->current_amount = $adjustBalance;
            $bankAccount->save();
            return response()->json(['response' => 'success']);
        }
    }

    public function edit(Request $request) {
        $target = BankLedger::findOrFail($request->bank_ledgers_id);
        $transactionTypeArr = ['' => __('lang.SELECT_TR_TYPE'), 'in' => 'Cash In', 'out' => 'Cash Out'];
        $view = view('backEnd.bankLedger.editLedger')->with(compact('target', 'transactionTypeArr'))->render();
        return response()->json(['data' => $view]);
    }

    public function update(Request $request) {
//        echo "<pre>";print_r($request->all());exit;
        $rules = [
            'bank_ledgers_id' => 'required',
//            'transaction_type' => 'required',
            'amount' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $target = BankLedger::findOrFail($request->bank_ledgers_id);
        $target->transaction_type = $request->transaction_type;

        if ($request->transaction_type == 'in') {
            if ($request->amount > $target->amount) {
                $changeAmount = $request->amount - $target->amount;
            } elseif ($request->amount < $target->amount) {
                $changeAmount = $target->amount - $request->amount;
            } else {
                $changeAmount = 0;
            }
        }
        if ($request->transaction_type == 'out') {
            if ($request->amount > $target->amount) {
                $changeAmount = $request->amount - $target->amount;
            } elseif ($request->amount < $target->amount) {
                $changeAmount = $target->amount - $request->amount;
            } else {
                $changeAmount = 0;
            }
        }
        
//        echo "<pre>";print_r($changeAmount);exit;
        $target->amount = $request->amount;
        $target->note = $request->note;
        if ($target->save()) {
            $bankAccount = BankAccount::where('id', $target->bank_account_id)->first();
            $accountBalance = $bankAccount->current_amount;
            if ($request->transaction_type == 'in') {
                $adjustBalance = $accountBalance + $changeAmount;
            } elseif ($request->transaction_type == 'out') {
                $adjustBalance = $accountBalance - $changeAmount;
            }
            $bankAccount->current_amount = $adjustBalance;
            $bankAccount->save();
            return response()->json(['response' => 'success']);
        }
    }

    public function destroy(Request $request) {
        $target = BankLedger::findOrFail($request->id);
        if ($target->delete()) {
            $bankAccount = BankAccount::where('id', $target->bank_account_id)->first();
            $accountBalance = $bankAccount->current_amount;
            if ($target->transaction_type == 'in') {
                $adjustBalance = $accountBalance - $target->amount;
            } elseif ($target->transaction_type == 'out') {
                $adjustBalance = $accountBalance + $target->amount;
            }
            $bankAccount->current_amount = $adjustBalance;
            $bankAccount->save();
            return response()->json(['response' => 'success']);
        }
    }

}
