<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Transaction;
use App\Models\BankAccount;
use App\Models\PendingCheque;
use App\Models\Issue;
use App\Models\User;
use App\Models\TicketApplication;
use App\Models\Package;
use Session;
use DB;
use App\Helpers\Helper;
use Auth;

class TransactionController extends Controller {

    public function index(Request $request) {


        $users = ['' => __('lang.SELECT_USER')] + User::join('user_roles', 'user_roles.id', 'users.role_id')->select(DB::raw("CONCAT(users.name,' (',user_roles.role_name,')') as name"), 'users.id as id')->pluck('name', 'id')->toArray();
        $transactionTypeArr = ['' => __('lang.SELECT_TR_TYPE'), 'in' => 'Cash In', 'out' => 'Cash Out'];
        $bankAccountArr = BankAccount::select(DB::raw("CONCAT(bank_name,' => ',account_name,' (',account_no,')') as bank_account"), 'id')->pluck('bank_account', 'id')->toArray();
        $issues = Issue::pluck('issue_title', 'id')->toArray();

        $targets = Transaction::where('application_id', $request->id)->orderBy('id', 'desc');

        if (!empty($request->user_id)) {
            $targets = $targets->where('user_id', $request->user_id);
        }
        if (!empty($request->transaction_type)) {
            $targets = $targets->where('transaction_type', $request->transaction_type);
        }
        if (!empty($request->search_value)) {
            $searchText = $request->search_value;
            $targets->where(function ($query) use ($searchText) {
                $query->where('cheque_no', 'like', "%{$searchText}%")
                        ->orWhere('amount', 'like', "%{$searchText}%");
            });
        }

        $targets = $targets->paginate(5);

        $data['title'] = 'Transaction';
        $data['meta_tag'] = 'Transaction page, rafiq & sons';
        $data['meta_description'] = 'Transaction, rafiq & sons';
        return view('backEnd.transaction.index')->with(compact('targets', 'issues', 'bankAccountArr', 'users', 'transactionTypeArr', 'data'));
    }

    public function create(Request $request) {

        $issueArr = ['' => __('lang.SELECT_ISSUE')];
        $transactionTypeArr = ['' => __('lang.SELECT_TR_TYPE'), 'in' => 'Cash In', 'out' => 'Cash Out'];
        $bankAccountArr = ['' => __('lang.SELECT_BANK_ACCOUNT')] + BankAccount::select(DB::raw("CONCAT(bank_name,' => ',account_name,' (',account_no,')') as bank_account"), 'id')->pluck('bank_account', 'id')->toArray();
        $users = ['' => __('lang.SELECT_PARTY')] + User::join('user_roles', 'user_roles.id', 'users.role_id')->select(DB::raw("CONCAT(users.name,' (',user_roles.role_name,')') as name"), 'users.id as id')->pluck('name', 'id')->toArray();
        $paymentMode = ['' => '--Select Payment mode--', 'cash' => 'cash', 'cheque' => 'cheque'];
        $ticketType = ['normal' => 'Normal', 'refund' => 'Refund', 'reissue' => 'Reissue', 'deport' => 'Deport'];

        $packageDetails = [];
        if ($request->issue_id == '5') {
            $packageDetails = Package::findOrFail($request->application_id);
        }

        $application_id = $request->application_id;
        $issue_id = $request->issue_id;

        $OldTicket = TicketApplication::select('ticket_no')->where('id', $application_id)->first();
        $OldTicketNo = !empty($OldTicket->ticket_no) ? $OldTicket->ticket_no : '';

        $view = view('backEnd.transaction.openCreateModal')->with(compact('issueArr', 'transactionTypeArr', 'bankAccountArr', 'users', 'paymentMode', 'application_id', 'issue_id', 'ticketType', 'OldTicketNo', 'packageDetails'))->render();
        return response()->json(['data' => $view]);
    }

    public function getIssue(Request $request) {
        $issueArr = ['' => __('lang.SELECT_ISSUE')] + Issue::where('transaction_type', $request->trType)->pluck('issue_title', 'id')->toArray();
        $view = view('backEnd.transaction.issue')->with(compact('issueArr'))->render();
        return response()->json(['data' => $view]);
    }

    public function store(Request $request) {

        $rules = [
            'transaction_type' => 'required',
            'payment_mode' => 'required',
            'amount' => 'required',
            'user_id' => 'required',
        ];
        if ($request->payment_mode == 'cheque') {
            $rules['bank_account_id'] = ['required'];
            $rules['cheque_no'] = ['required'];
        }
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $target = new Transaction;
        $target->transaction_type = $request->transaction_type;
        $target->issue_id = $request->issue_id;
        $target->payment_mode = $request->payment_mode;
        $target->amount = $request->amount;
        $target->cheque_no = $request->cheque_no;
        $target->bank_account_id = $request->bank_account_id;
        $target->user_id = $request->user_id;
        $target->application_id = $request->application_id;
        $target->note = $request->note;
        $target->ticket_type = $request->ticket_type;
        $target->created_by = Auth::id();

        //Reissue Extra field
        if ($request->ticket_type == 'reissue') {
            $target->old_ticket_no = $request->old_ticket_no;
            $target->new_ticket_no = $request->new_ticket_no;
        }
        //End Reissue Extra field
        //Deport Extra field
        if ($request->ticket_type == 'deport') {
            $target->first_issue_date = $request->first_issue_date;
            $target->fly_date = $request->fly_date;
            $target->return_date = $request->return_date;
            $target->flied_to = $request->flied_to;
            $target->ticket_no = $request->ticket_no;
            $target->deport_ticket_no = $request->deport_ticket_no;
            $target->fare = $request->fare;
        }
        //End Deport Extra field
        //Refund Extra field
        if ($request->ticket_type == 'refund') {
            $target->refund_charge = $request->refund_charge;
        }
        //End Refund Extra field

        if ($request->issue_id == '5') {
            $target->package_id = $request->application_id;
            $target->passport = $request->passport;
            $target->mobile = $request->mobile;
            $target->num_of_package = $request->num_of_package;
            $target->email = $request->email;
        }


        if ($target->save()) {
            if ($request->payment_mode == 'cheque') {
                $pendingCheque = new PendingCheque;
                $pendingCheque->cheque_no = $request->cheque_no;
                $pendingCheque->transaction_type = $request->transaction_type;
                $pendingCheque->transaction_id = $target->id;
                $pendingCheque->cheque_amount = $request->amount;
                $pendingCheque->status = '0';
                $pendingCheque->save();
            }
            return response()->json(['response' => 'success']);
//            Session::flash('success', __('lang.VOUCHER_ADDED_SUCCESSFULLY'));
//            return redirect()->route('transaction.index');
        }
    }

    public function view(Request $request) {
        $target = Transaction::findOrFail($request->id);

        $bankAccountArr = BankAccount::pluck('account_no', 'id')->toArray();
        $issues = Issue::pluck('issue_title', 'id')->toArray();
        $users = User::join('user_roles', 'user_roles.id', 'users.role_id')->select(DB::raw("CONCAT(users.name,' (',user_roles.role_name,')') as name"), 'users.id as id')->pluck('name', 'id')->toArray();
        $package = Package::pluck('name', 'id')->toArray();
        return view('backEnd.transaction.view')->with(compact('target', 'issues', 'bankAccountArr', 'users', 'package'));
    }

    public function edit(Request $request) {
//        echo "<pre>";print_r($request->all());exit;
        $target = Transaction::findOrFail($request->id);

        $transactionTypeArr = ['' => __('lang.SELECT_TR_TYPE'), 'in' => 'Cash In', 'out' => 'Cash Out'];
        $issueArr = ['' => __('lang.SELECT_ISSUE')] + Issue::pluck('issue_title', 'id')->toArray();
        $paymentMode = ['' => __('lang.SELECT_PAYMENT_MODE'), 'cash' => 'Cash', 'cheque' => 'Cheque'];
        $bankAccountArr = ['' => __('lang.SELECT_BANK_ACCOUNT')] + BankAccount::select(DB::raw("CONCAT(bank_name,' => ',account_name,' (',account_no,')') as bank_account"), 'id')->pluck('bank_account', 'id')->toArray();
        $users = ['' => __('lang.SELECT_PARTY')] + User::join('user_roles', 'user_roles.id', 'users.role_id')->select(DB::raw("CONCAT(users.name,' (',user_roles.role_name,')') as name"), 'users.id as id')->pluck('name', 'id')->toArray();

        $ticketType = ['normal' => 'Normal', 'refund' => 'Refund', 'reissue' => 'Reissue', 'deport' => 'Deport'];
        $issue_id = $target->issue_id;

        $packageDetails = [];
        if ($target->issue_id == '5') {
            $packageDetails = Package::findOrFail($target->application_id);
        }

        $data['title'] = 'Edit Transaction';
        $data['meta_tag'] = 'Edit Transaction page, rafiq & sons';
        $data['meta_description'] = 'Edit Transaction, rafiq & sons';
//        echo "<pre>";print_r($target->toArray());exit;
        $view = view('backEnd.transaction.openEditModal')->with(compact('target', 'transactionTypeArr', 'issueArr', 'paymentMode', 'bankAccountArr', 'users', 'data', 'issue_id', 'ticketType', 'packageDetails'))->render();

        return response()->json(['data' => $view]);
    }

    public function update(Request $request) {
        // echo "<pre>";print_r($request->all());exit;

        $rules = [
            'transaction_type' => 'required',
            'payment_mode' => 'required',
            'amount' => 'required',
            'user_id' => 'required',
        ];
        if ($request->payment_mode == 'cheque') {
            $rules['bank_account_id'] = ['required'];
            $rules['cheque_no'] = ['required'];
        }
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $pendingCheque = PendingCheque::where('transaction_id', $request->id)->first();
        if (!empty($pendingCheque) && $pendingCheque->status == '1') {
            Session::flash('error', __('lang.THIS_TRANSACTION_CHEQUE_ALREADY_APPROVED'));
            return redirect()->route('transaction.index');
        }

        $target = Transaction::findOrFail($request->id);
        $target->transaction_type = $request->transaction_type;
        $target->issue_id = $request->issue_id;
        $target->payment_mode = $request->payment_mode;
        $target->amount = $request->amount;
        $target->cheque_no = $request->cheque_no;
        $target->bank_account_id = $request->bank_account_id;
        $target->user_id = $request->user_id;
        $target->application_id = $request->application_id;
        $target->note = $request->note;
        $target->ticket_type = $request->ticket_type;

        //Reissue Extra field
        if ($request->ticket_type == 'reissue') {
            $target->old_ticket_no = $request->old_ticket_no;
            $target->new_ticket_no = $request->new_ticket_no;
        }
        //End Reissue Extra field
        //Deport Extra field
        if ($request->ticket_type == 'deport') {
            $target->first_issue_date = $request->first_issue_date;
            $target->fly_date = $request->fly_date;
            $target->return_date = $request->return_date;
            $target->flied_to = $request->flied_to;
            $target->ticket_no = $request->ticket_no;
            $target->deport_ticket_no = $request->deport_ticket_no;
            $target->fare = $request->fare;
        }
        //End Deport Extra field
        //Refund Extra field
        if ($request->ticket_type == 'refund') {
            $target->refund_charge = $request->refund_charge;
        }
        //End Refund Extra field

        if ($request->issue_id == '5') {
            $target->package_id = $request->application_id;
            $target->passport = $request->passport;
            $target->mobile = $request->mobile;
            $target->num_of_package = $request->num_of_package;
            $target->email = $request->email;
        }
        if ($target->save()) {
            if ($request->payment_mode == 'cheque') {
                $pendingCheque = PendingCheque::where('transaction_id', $request->id)->first();
                $pendingCheque->cheque_no = $request->cheque_no;
                $pendingCheque->transaction_type = $request->transaction_type;
                $pendingCheque->transaction_id = $target->id;
                $pendingCheque->cheque_amount = $request->amount;
                $pendingCheque->status = '0';
                $pendingCheque->save();
            }
            return response()->json(['response' => 'success']);
        }
    }

    public function destroy(Request $request) {
        $target = Transaction::findOrFail($request->id);

        $application_id = $target->application_id;

        $previous_url = explode('/', url()->previous());

        if (in_array('visa-entry', $previous_url)) {
            $redirectUrl = 'visa-entry';
        } else if (in_array('passport-entry', $previous_url)) {
            $redirectUrl = 'passport-entry';
        } else if (in_array('medical-entry', $previous_url)) {
            $redirectUrl = 'medical-entry';
        } else if (in_array('ticket-entry', $previous_url)) {
            $redirectUrl = 'ticket-entry';
        } else if (in_array('package-entry', $previous_url)) {
            $redirectUrl = 'package-entry';
        }

        $pendingCheque = PendingCheque::where('transaction_id', $request->id)->first();

        if ($target->delete()) {
            Session::flash('success', __('lang.VOUCHER_DELETED_SUCCESSFULLY'));
            if (!empty($pendingCheque)) {
                $pendingCheque->delete();
            }
            return redirect('admin/' . $redirectUrl . '/' . $application_id . '/transaction-list');
        }
    }

}
