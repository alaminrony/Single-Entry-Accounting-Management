<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\BankAccount;
use App\Models\BankLedger;
use App\Models\Country;
use App\Models\EntryTypes;
use App\Models\Year;
use App\Models\Airport;
use App\Models\District;
use App\Models\Thana;
use App\Models\Note;
use App\Models\VisaApplication;
use App\Models\PassportApplication;
use App\Models\MedicalApplication;
use App\Models\TicketApplication;
use App\Models\Package;
use App\Models\User;
use App\Models\Issue;
use App\Models\Transaction;
use App\Models\Setting;
use App\Models\DocumentAttachment;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use Session;
use DB;
use App\Helpers\Helper;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExcelExport;
use PDF;
use Auth;

class InvoiceController extends Controller {

    public function index(Request $request) {
//        echo "<pre>";print_r($request->issue_id);exit;
        $issueArr = ['' => __('lang.SELECT_ISSUE')] + Issue::pluck('issue_title', 'id')->toArray();
        $targets = Invoice::select('invoices.*', 'users.name as bill_to_name')
                ->join('users', 'users.id', '=', 'invoices.bill_to');

        if ($request->issue_id > 0) {
            $targets->where('issue_id', $request->issue_id);
        }

        if (!empty($request->search_value)) {
            $searchText = $request->search_value;
            $targets->where(function ($query) use ($searchText) {
                $query->where('invoices.total_amount', 'like', "%{$searchText}%")
                        ->orWhere('invoices.billing_street', 'like', "%{$searchText}%")
                        ->orWhere('invoices.billing_city', 'like', "%{$searchText}%")
                        ->orWhere('invoices.billing_zip', 'like', "%{$searchText}%")
                        ->orWhere('invoices.total_quantity', 'like', "%{$searchText}%")
                        ->orWhere('invoices.invoice_code', 'like', "%{$searchText}%")
                        ->orWhere('users.name', 'like', "%{$searchText}%");
            });
        }

//        if ($request->view == 'print') {
//            $targets = $targets->get();
//            return view('backEnd.visa.print.print-visa-list')->with(compact('targets', 'request'));
//        } else if ($request->view == 'pdf') {
//            $targets = $targets->get();
//            $pdf = PDF::loadView('backEnd.visa.print.print-visa-list', compact('targets', 'request'))
//                    ->setPaper('a4', 'portrait')
//                    ->setOptions(['defaultFont' => 'sans-serif']);
//            $fileName = "visa_entry_list_" . date('d_m_Y_H_i_s');
//            return $pdf->download("$fileName.pdf");
//        } else if ($request->view == 'excel') {
//            $targets = $targets->get();
//            $viewFile = 'backEnd.visa.print.print-visa-list';
//            $fileName = "visa_entry_list_" . date('d_m_Y_H_i_s');
//            $downLoadFileName = "$fileName.xlsx";
//            $data['targets'] = $targets;
//            $data['request'] = $request;
//            return Excel::download(new ExcelExport($viewFile, $data), $downLoadFileName);
//        }
        $targets = $targets->orderBy('id', 'desc')->paginate(10);

        $data['title'] = 'Invoice List';
        $data['meta_tag'] = 'Invoice List, rafiq & sons';
        $data['meta_description'] = 'Invoice List, rafiq & sons';

        $issue_id = $request->issue_id;
        return view('backEnd.invoice.index')->with(compact('data', 'targets', 'issue_id', 'issueArr'));
    }

    public function create(Request $request) {

        $invoiceID = Invoice::orderBy('id', 'desc')->select('id')->take(1)->first();
        $invoiceCode = !empty($invoiceID->id) ? 'INV-' . date('Y') . '-' . date('m') . '-' . ($invoiceID->id + 1) : 'INV-' . date('Y') . '-' . date('m') . '-' . '1';
        $users = ['' => __('lang.SELECT_BILL_TO')] + User::join('user_roles', 'user_roles.id', 'users.role_id')->select(DB::raw("CONCAT(users.name,' (',user_roles.role_name,')') as name"), 'users.id as id')->pluck('name', 'id')->toArray();
        $products = ['' => __('lang.SELECT_PRODUCT')] + Product::where('status', 1)->pluck('name', 'id')->toArray();
        $productPrice = ['' => __('lang.SELECT_PRODUCT')] + Product::pluck('price', 'id')->toArray();
        $issueArr = ['' => __('lang.SELECT_ISSUE')] + Issue::whereNotIn('id', [6])->pluck('issue_title', 'id')->toArray();
//        echo "<pre>";print_r($issueArr);exit;
        $cusCode = ['' => '--Select customer code--'];
        $data['title'] = 'Invoice Entry';
        $data['meta_tag'] = 'Invoice entry, rafiq & sons';
        $data['meta_description'] = 'Invoice entry, rafiq & sons';

        return view('backEnd.invoice.create', compact('data', 'invoiceCode', 'users', 'products', 'productPrice', 'issueArr', 'cusCode'));
    }

    public function getCustomerCode(Request $request) {

        if ($request->issueId == 1) {
            $cusCode = ['' => '--Select customer code--'] + VisaApplication::select('customer_code')->pluck('customer_code', 'customer_code')->toArray();
        } elseif ($request->issueId == 2) {
            $cusCode = ['' => '--Select customer code--'] + PassportApplication::select('customer_code')->pluck('customer_code', 'customer_code')->toArray();
        } elseif ($request->issueId == 3) {
            $cusCode = ['' => '--Select customer code--'] + MedicalApplication::select('customer_code')->pluck('customer_code', 'customer_code')->toArray();
        } elseif ($request->issueId == 4) {
            $cusCode = ['' => '--Select customer code--'] + TicketApplication::select('customer_code')->pluck('customer_code', 'customer_code')->toArray();
        }
        $view = View('backEnd.invoice.customer_code')->with(compact('cusCode'))->render();
        return response()->json(['html' => $view]);
    }

    public function store(Request $request) {
//        echo "<pre>";print_r($request->all());exit;

        $rules = [
            'invoice_code' => 'required',
            'bill_to' => 'required',
            'customer_code' => 'required',
        ];

        if ($request->issue_id == 0) {
            $rules['select_issue_id'] = 'required';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $target = new Invoice;
        $target->invoice_code = $request->invoice_code;
        $target->inv_date = $request->inv_date;
        $target->due_date = $request->due_date;
        $target->bill_to = $request->bill_to;
        $target->billing_street = $request->billing_street;
        $target->billing_city = $request->billing_city;
        $target->billing_zip = $request->billing_zip;
        $target->sub_total = $request->sub_total;
        $target->total_amount = $request->amount_total;
        $target->discount_total = $request->discount;
        $target->discount_percent = $request->discount_percent;
        $target->invoicenote = $request->invoicenote;
        $target->invoicenote = $request->invoicenote;
        $target->issue_id = $request->issue_id == 0 ? $request->select_issue_id : $request->issue_id;
        $target->terms = $request->terms;
        $target->invoiced_by = Auth::id();
        $target->customer_code = $request->customer_code;
        $target->status = $request->status == 'Save' ? "SAVE" : "DRAFT";
        $target->total_quantity = !empty($request->quantity) ? array_sum($request->quantity) : 0;
        if ($target->save()) {
            if (!empty($request->dynamic_product_id)) {
                $detailsArr = [];
                $i = 0;
                foreach ($request->dynamic_product_id as $index => $productId) {
                    $detailsArr[$i]['product_id'] = $productId;
                    $detailsArr[$i]['invoice_id'] = $target->id;
                    $detailsArr[$i]['product_name'] = $request->product_name[$index] ?? '';
                    $detailsArr[$i]['description'] = $request->description[$index] ?? '';
                    $detailsArr[$i]['quantity'] = $request->quantity[$index] ?? '';
                    $detailsArr[$i]['unit_price'] = $request->unit_price[$index] ?? '';
                    $detailsArr[$i]['tax'] = $request->tax[$index] ?? 0;
                    $detailsArr[$i]['total'] = $request->total[$index] ?? '';
                    $detailsArr[$i]['created_at'] = date('Y-m-d H:i:s');
                    $detailsArr[$i]['updated_at'] = date('Y-m-d H:i:s');
                    $i++;
                }
//                echo "<pre>";print_r($detailsArr);exit;
                InvoiceItem::insert($detailsArr);
            }
//            $issueId = $request->issue_id 
            Session::flash('success', __('lang.INVOICE_HAS_BEEN_CREATED_SUCCESSFULLY'));
            return redirect()->route('invoice.index', $request->issue_id);
        }
    }

    public function details(Request $request) {
        $companyName = Setting::where('key_name', 'company_name')->first()->key_value;
        $target = Invoice::with('details', 'user')->where('id', $request->id)->first();
    //    echo "<pre>";print_r($target->toArray());exit;
        return view('backEnd.invoice.details')->with(compact('companyName', 'target'));
//        
    }

    public function edit(Request $request) {

        $target = Invoice::with('details', 'user')->where('id', $request->id)->first();
        $users = ['' => __('lang.SELECT_BILL_TO')] + User::join('user_roles', 'user_roles.id', 'users.role_id')->select(DB::raw("CONCAT(users.name,' (',user_roles.role_name,')') as name"), 'users.id as id')->pluck('name', 'id')->toArray();
        $products = ['' => __('lang.SELECT_PRODUCT')] + Product::where('status', 1)->pluck('name', 'id')->toArray();
        $productPrice = ['' => __('lang.SELECT_PRODUCT')] + Product::pluck('price', 'id')->toArray();
        $issueArr = ['' => __('lang.SELECT_ISSUE')] + Issue::whereNotIn('id', [5, 6])->pluck('issue_title', 'id')->toArray();
        $cusCode = ['' => '--Select customer code--'];
        if (!empty($target->customer_code)) {
            $cusCode = $cusCode + [$target->customer_code => $target->customer_code];
        }


        $data['title'] = 'Invoice Edit';
        $data['meta_tag'] = 'Invoice Edit, rafiq & sons';
        $data['meta_description'] = 'Invoice Edit, rafiq & sons';

        return view('backEnd.invoice.edit', compact('data', 'target', 'users', 'products', 'productPrice', 'issueArr', 'cusCode'));
    }

    public function update(Request $request) {

        $rules = [
            'invoice_code' => 'required',
            'bill_to' => 'required',
            'customer_code' => 'required',
        ];

        if ($request->issue_id == 0) {
            $rules['select_issue_id'] = 'required';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $target = Invoice::find($request->id);
//        echo "<pre>";print_r($target->toArray());exit;
        $target->invoice_code = $request->invoice_code;
        $target->inv_date = $request->inv_date;
        $target->due_date = $request->due_date;
        $target->bill_to = $request->bill_to;
        $target->billing_street = $request->billing_street;
        $target->billing_city = $request->billing_city;
        $target->billing_zip = $request->billing_zip;
        $target->sub_total = $request->sub_total;
        $target->total_amount = $request->amount_total;
        $target->discount_total = $request->discount;
        $target->discount_percent = $request->discount_percent;
        $target->invoicenote = $request->invoicenote;
        $target->invoicenote = $request->invoicenote;
        $target->issue_id = $request->issue_id == 0 ? $request->select_issue_id : $request->issue_id;
        $target->terms = $request->terms;
        $target->customer_code = $request->customer_code;
        $target->invoiced_by = Auth::id();
        $target->status = $request->status == 'Save' ? "SAVE" : "DRAFT";
        $target->total_quantity = !empty($request->quantity) ? array_sum($request->quantity) : 0;
        if ($target->save()) {
            if (!empty($request->dynamic_product_id)) {
                $detailsArr = [];
                $i = 0;
                foreach ($request->dynamic_product_id as $index => $productId) {
                    $detailsArr[$i]['product_id'] = $productId;
                    $detailsArr[$i]['invoice_id'] = $target->id;
                    $detailsArr[$i]['product_name'] = $request->product_name[$index] ?? '';
                    $detailsArr[$i]['description'] = $request->description[$index] ?? '';
                    $detailsArr[$i]['quantity'] = $request->quantity[$index] ?? '';
                    $detailsArr[$i]['unit_price'] = $request->unit_price[$index] ?? '';
                    $detailsArr[$i]['tax'] = $request->tax[$index] ?? 0;
                    $detailsArr[$i]['total'] = $request->total[$index] ?? '';
                    $detailsArr[$i]['created_at'] = date('Y-m-d H:i:s');
                    $detailsArr[$i]['updated_at'] = date('Y-m-d H:i:s');
                    $i++;
                }
//                echo "<pre>";print_r($detailsArr);exit;
                InvoiceItem::where('invoice_id', $target->id)->delete();
                InvoiceItem::insert($detailsArr);
            }
            Session::flash('success', __('lang.INVOICE_HAS_BEEN_UPDATED_SUCCESSFULLY'));
            return redirect()->route('invoice.index', $request->issue_id);
        }
    }

    public function destroy(Request $request) {

        $target = Invoice::findOrFail($request->id);
        if ($target->delete()) {
            $notes = InvoiceItem::where('invoice_id', $request->id)->delete();
            Session::flash('success', __('lang.INVOICE_DELETED_SUCCESSFULLY'));
            return redirect()->route('invoice.index', $request->issue_id);
        }
    }

    public function filter(Request $request) {
        $url = '?search_value=' . $request->search_value;
        return redirect('admin/visa-entry/' . $request->id . '/transaction-list?' . $url);
    }

}
