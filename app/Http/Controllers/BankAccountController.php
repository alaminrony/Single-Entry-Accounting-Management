<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\BankAccount;
use App\Models\BankLedger;
use Session;
use DB;
use App\Helpers\Helper;

class BankAccountController extends Controller {

    public function index(Request $request) {
        
        $page = !empty($request->page) ? $request->page : 1;
        
        
        $banksArr = ['' => __('lang.SELECT_BANK')] + BankAccount::pluck('bank_name', 'id')->toArray();
        $targets = BankAccount::orderBy('id', 'desc');

        if (!empty($request->search_value)) {
            $searchText = $request->search_value;
            $targets->where(function ($query) use ($searchText) {
                $query->where('account_no', 'like', "%{$searchText}%")
                        ->orWhere('account_name', 'like', "%{$searchText}%")
                        ->orWhere('bank_name', 'like', "%{$searchText}%")
                        ->orWhere('current_amount', 'like', "%{$searchText}%")
                        ->orWhere('branch', 'like', "%{$searchText}%");
            });
        }
        $targets = $targets->paginate(10);
        
        
        $data['title'] = 'Bank Account';
        $data['meta_tag'] = 'Bank Account, rafiq & sons';
        $data['meta_description'] = 'Bank Account, rafiq & sons';

        return view('backEnd.bankAccount.index')->with(compact('targets', 'banksArr', 'data','page'));
    }

    public function create(Request $request) {
        $data['title'] = 'Create Bank';
        $data['meta_tag'] = 'Create Bank, rafiq & sons';
        $data['meta_description'] = 'Create Bank, rafiq & sons';

        return view('backEnd.bankAccount.create', compact('data'));
    }

    public function store(Request $request) {
//         echo "<pre>";print_r($request->all());exit;
        $rules = [
            'account_no' => 'required',
            'account_name' => 'required',
            'bank_name' => 'required',
            'branch' => 'required',
            'current_amount' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('bankAccount.create')->withInput()->withErrors($validator);
        }

        $target = new BankAccount;
        $target->account_no = $request->account_no;
        $target->account_name = $request->account_name;
        $target->bank_name = $request->bank_name;
        $target->branch = $request->branch;
        $target->current_amount = $request->current_amount;
        if ($target->save()) {
            $target1 = new BankLedger;
            $target1->bank_account_id = $target->id;
            $target1->amount = $request->current_amount;
            $target1->note = 'Opening Balance';
            $target1->transaction_type = 'in';
            $target1->save();
            Session::flash('success', __('lang.BANK_ACCOUNT_ADDED_SUCCESSFULLY'));
            return redirect()->route('bankAccount.index');
        }
    }

    public function view(Request $request) {
        $target = BankAccount::findOrFail($request->id);

        $data['title'] = 'View Bank';
        $data['meta_tag'] = 'View Bank, rafiq & sons';
        $data['meta_description'] = 'View Bank, rafiq & sons';
        return view('backEnd.bankAccount.view')->with(compact('target', 'data'));
    }

    public function edit(Request $request) {
        $page = !empty($request->page) ? $request->page : 1;
        
        $target = BankAccount::findOrFail($request->id);

        $data['title'] = 'Edit Bank';
        $data['meta_tag'] = 'Edit Bank, rafiq & sons';
        $data['meta_description'] = 'Edit Bank, rafiq & sons';
        return view('backEnd.bankAccount.edit')->with(compact('target', 'data','page'));
    }

    public function update(Request $request) {
//        echo "<pre>";print_r($request->page);exit;
        $rules = [
            'account_no' => 'required',
            'account_name' => 'required',
            'bank_name' => 'required',
            'branch' => 'required',
            'current_amount' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('bankAccount.create')->withInput()->withErrors($validator);
        }

        $target = BankAccount::findOrFail($request->id);
        $target->account_no = $request->account_no;
        $target->account_name = $request->account_name;
        $target->bank_name = $request->bank_name;
        $target->branch = $request->branch;
        $target->current_amount = $request->current_amount;
        if ($target->save()) {
            Session::flash('success', __('lang.BANK_ACCOUNT_UPDATED_SUCCESSFULLY'));
            return redirect()->route('bankAccount.index',['page'=>$request->page]);
        }
    }

    public function destroy(Request $request) {
        $target = BankAccount::findOrFail($request->id);
        if ($target->delete()) {
            Session::flash('success', __('lang.BANK_ACCOUNT_DELETED_SUCCESSFULLY'));
            return redirect()->route('bankAccount.index');
        }
    }

    public function filter(Request $request) {
//        $url = 'transaction_type=' . $request->transaction_type . '&search_value=' . $request->search_value;
        $url = 'search_value=' . $request->search_value;
        return redirect('admin/bank-account-list?' . $url);
    }

}
