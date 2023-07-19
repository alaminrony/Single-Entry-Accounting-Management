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
use App\Models\Package;
use App\Models\User;
use App\Models\Issue;
use App\Models\Transaction;
use App\Models\DocumentAttachment;
use Session;
use DB;
use App\Helpers\Helper;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExcelExport;
use PDF;

class PackageEntryController extends Controller {

    public function index(Request $request) {
//        echo "<pre>";print_r($request->all());exit;
        $users = ['' => __('lang.SELECT_USER')] + User::join('packages', 'packages.created_by', '=', 'users.id')->select(DB::raw("CONCAT(users.name,' (',users.phone,')') as name"), 'users.id as id')->pluck('name', 'id')->toArray();
        $targets = Package::select('id', 'name', 'total_dayes', 'hotel', 'transportation', 'total_package_cost', 'adult', 'children', 'created_at')->orderBy('id', 'desc');

        if (!empty($request->search_value)) {
            $searchText = $request->search_value;
            $targets->where(function ($query) use ($searchText) {
                $query->where('name', 'like', "%{$searchText}%")
                        ->orWhere('from', 'like', "%{$searchText}%")
                        ->orWhere('to', 'like', "%{$searchText}%")
                        ->orWhere('adult', 'like', "%{$searchText}%")
                        ->orWhere('total_package_cost', 'like', "%{$searchText}%")
                        ->orWhere('children', 'like', "%{$searchText}%");
            });
        }

        if (!empty($request->created_by)) {
            $targets->where('created_by', $request->created_by);
        }

        if ($request->view == 'print') {
            $targets = $targets->get();
            return view('backEnd.package.print.print-package-list')->with(compact('targets', 'request'));
        } else if ($request->view == 'pdf') {
            $targets = $targets->get();
            $pdf = PDF::loadView('backEnd.package.print.print-package-list', compact('targets', 'request'))
                    ->setPaper('a4', 'portrait')
                    ->setOptions(['defaultFont' => 'sans-serif']);
            $fileName = "package_entry_list_" . date('d_m_Y_H_i_s');
            return $pdf->download("$fileName.pdf");
        } else if ($request->view == 'excel') {
            $targets = $targets->get();
            $viewFile = 'backEnd.package.print.print-package-list';
            $fileName = "package_entry_list_" . date('d_m_Y_H_i_s');
            $downLoadFileName = "$fileName.xlsx";
            $data['targets'] = $targets;
            $data['request'] = $request;
            return Excel::download(new ExcelExport($viewFile, $data), $downLoadFileName);
        }

        $targets = $targets->paginate(8);

//        echo "<pre>";print_r($targets->toArray());exit;

        $data['title'] = 'Package List';
        $data['meta_tag'] = 'Package List, rafiq & sons';
        $data['meta_description'] = 'Package List, rafiq & sons';
        return view('backEnd.package.index')->with(compact('data', 'targets', 'users'));
    }

    public function create(Request $request) {
        $countries = ['' => __('lang.SELECT_COUNTRY')] + Country::select(DB::raw("CONCAT(name,' (',iso_code_2,')') as country_name"), 'id')->pluck('country_name', 'id')->toArray();
        $entryTypes = ['' => __('lang.SELECT_ENTRY_TYPE')] + EntryTypes::where('status', '1')->where('category_id', '4')->pluck('title', 'id')->toArray();
        $years = ['' => __('lang.SELECT_YEAR')] + Year::pluck('year', 'year')->toArray();
        $airports = ['' => __('lang.SELECT_AIRPORT')] + Airport::select(DB::raw("CONCAT(name,' (',countryCode,')') as name"), 'countryCode', 'code')->orderBy('countryCode')->pluck('name', 'name')->toArray();

        if (!empty($request->countryId) && !empty($request->typeId) && !empty($request->year)) {
            $type = explode(' ', $entryTypes[$request->typeId]);
            $year = $years[$request->year];
            $countryName = explode(' ', str_replace(array('(', ')'), '', $countries[$request->countryId]));
            $latestPassport = Package::select('id')->latest()->take(1)->first();
            $latestPassId = !empty($latestPassport->id) ? $latestPassport->id + 1 : '1';
            $customerCode = end($countryName) . '-' . $type[0] . '-' . $year . '-' . $latestPassId;
            return $customerCode;
        }

        $data['title'] = 'Package Entry';
        $data['meta_tag'] = 'Package entry, rafiq & sons';
        $data['meta_description'] = 'Package entry, rafiq & sons';
        return view('backEnd.package.create', compact('data', 'countries', 'entryTypes', 'years', 'airports'));
    }

    public function generateCusCode(Request $request) {
        $customerCode = $this->create($request);
        return response()->json(['data' => $customerCode]);
    }

    public function store(Request $request) {

        $rules = [
            'name' => 'required',
            'from' => 'required',
            'to' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('packageEntry.create')->withInput()->withErrors($validator);
        }

        $moreCost = json_encode($request->more_cost);

        $target = new Package;
        $target->name = $request->name;
        $target->from = $request->from;
        $target->to = $request->to;
        $target->adult = $request->adult;
        $target->children = $request->children;
        $target->hotel = $request->hotel;
        $target->hotel_type = $request->hotel_type;
        $target->hotel_cost = $request->hotel_cost;
        $target->air = $request->air;
        $target->ticket_cost = $request->ticket_cost;
        $target->carrier = $request->carrier;
        $target->tour_guide = $request->tour_guide;
        $target->guide_cost = $request->guide_cost;
        $target->total_dayes = $request->total_dayes;
        $target->transportation = $request->transportation;
        $target->transport_cost = $request->transport_cost;
        $target->more_cost = $moreCost;
        $target->total_package_cost = $request->total_package_cost;
        $target->note = $request->note;
        if ($target->save()) {
            $data = [
                'issue_type' => 'package',
                'issue_id' => $target->id,
                'action' => 'create',
                'user_id' => \Auth::id(),
                'ip_address' => request()->ip(),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            Helper::log($data);

            $this->uploadFile($target->id, $request);
            Session::flash('success', __('lang.PACKAGE_ADDED_SUCCESSFULLY'));
            return redirect()->route('packageEntry.index');
        }
    }

    public function view(Request $request) {

        $target = Package::findOrFail($request->id);

        $moreCostArr = !empty($target->more_cost) ? json_decode($target->more_cost) : '';
        $moreCosts = (array) $moreCostArr;

        $countries = Country::select(DB::raw("CONCAT(name,' (',iso_code_2,')') as country_name"), 'id')->pluck('country_name', 'id')->toArray();

        $entryTypes = EntryTypes::where('status', '1')->where('category_id', '4')->pluck('title', 'id')->toArray();

        $years = Year::pluck('year', 'year')->toArray();

        $hotelType = ['3' => '3 Star', '4' => '4 Star', '5' => '5 Star'];

        if ($request->view == 'print') {
            return view('backEnd.package.print.print-package-details')->with(compact('target', 'request', 'countries', 'entryTypes', 'years', 'hotelType', 'moreCosts'));
        } else if ($request->view == 'pdf') {
            $pdf = PDF::loadView('backEnd.package.print.print-package-details', compact('target', 'request', 'countries', 'entryTypes', 'years', 'hotelType', 'moreCosts'))
                    ->setPaper('a4', 'portrait')
                    ->setOptions(['defaultFont' => 'sans-serif']);
            $fileName = $target->name . "_package_details_" . date('d_m_Y_H_i_s');
            return $pdf->download("$fileName.pdf");
        } else if ($request->view == 'excel') {
            $viewFile = 'backEnd.package.print.print-package-details';
            $fileName = $target->name . "_package_details_" . date('d_m_Y_H_i_s');
            $downLoadFileName = "$fileName.xlsx";
            $data['target'] = $target;
            $data['request'] = $request;
            $data['countries'] = $countries;
            $data['entryTypes'] = $entryTypes;
            $data['years'] = $years;
            $data['hotelType'] = $hotelType;
            $data['moreCosts'] = $moreCosts;
            return Excel::download(new ExcelExport($viewFile, $data), $downLoadFileName);
        }

        $data['title'] = 'View Ticket';
        $data['meta_tag'] = 'View Ticket, rafiq & sons';
        $data['meta_description'] = 'View Ticket, rafiq & sons';
        return view('backEnd.package.view')->with(compact('target', 'data', 'countries', 'entryTypes', 'years', 'hotelType', 'moreCosts'));
    }

    public function edit(Request $request) {

        $target = Package::findOrFail($request->id);
        $moreCostArr = !empty($target->more_cost) ? json_decode($target->more_cost) : '';

        $moreCost = (array) $moreCostArr;
        $counter = count($moreCost);

        $data['title'] = 'Edit Medical';
        $data['meta_tag'] = 'Edit Medical, rafiq & sons';
        $data['meta_description'] = 'Edit Medical, rafiq & sons';
        return view('backEnd.package.edit')->with(compact('target', 'data', 'moreCostArr', 'counter'));
    }

    public function update(Request $request) {

        $rules = [
            'name' => 'required',
            'from' => 'required',
            'to' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('packageEntry.edit', $request->id)->withInput()->withErrors($validator);
        }


        $moreCost = json_encode(($request->more_cost));

        $target = Package::findOrFail($request->id);
        $target->name = $request->name;
        $target->from = $request->from;
        $target->to = $request->to;
        $target->adult = $request->adult;
        $target->children = $request->children;
        $target->hotel = $request->hotel;
        $target->hotel_type = $request->hotel_type;
        $target->hotel_cost = $request->hotel_cost;
        $target->air = $request->air;
        $target->ticket_cost = $request->ticket_cost;
        $target->carrier = $request->carrier;
        $target->tour_guide = $request->tour_guide;
        $target->guide_cost = $request->guide_cost;
        $target->total_dayes = $request->total_dayes;
        $target->transportation = $request->transportation;
        $target->transport_cost = $request->transport_cost;
        $target->more_cost = $moreCost;
        $target->total_package_cost = $request->total_package_cost;
        $target->note = $request->note;
        if ($target->save()) {
            $data = [
                'issue_type' => 'package',
                'issue_id' => $target->id,
                'action' => 'update',
                'user_id' => \Auth::id(),
                'ip_address' => request()->ip(),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            Helper::log($data);

            if (!empty($target->attachments->toArray())) {
                $this->uploadImageForUpdate($target, $request);
            } else {
                $this->uploadFile($target->id, $request);
            }
            Session::flash('success', __('lang.PACKAGE_UPDATED_SUCCESSFULLY'));
            return redirect()->route('packageEntry.index');
        }
    }

    public function destroy(Request $request) {
        $target = Package::findOrFail($request->id);
        if ($target->delete()) {
            $data = [
                'issue_type' => 'package',
                'issue_id' => $target->id,
                'action' => 'delete',
                'user_id' => \Auth::id(),
                'ip_address' => request()->ip(),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            Helper::log($data);
//            $notes = Note::where('application_id', $request->id)->where('issue_id', '2')->delete();
            Session::flash('success', __('lang.PACKAGE_DELETED_SUCCESSFULLY'));
            return redirect()->route('packageEntry.index');
        }
    }

    public function transactionList(Request $request) {
        $createdBy = ['' => __('lang.SELECT_CREATED_BY')] + User::join('transactions', 'transactions.created_by', '=', 'users.id')->select(DB::raw("CONCAT(users.name,' (',users.phone,')') as name"), 'users.id as id')->where('transactions.issue_id', 5)->pluck('name', 'id')->toArray();
        $users = ['' => __('lang.SELECT_USER')] + User::join('user_roles', 'user_roles.id', 'users.role_id')->select(DB::raw("CONCAT(users.name,' (',user_roles.role_name,')') as name"), 'users.id as id')->pluck('name', 'id')->toArray();
        $transactionTypeArr = ['' => __('lang.SELECT_TR_TYPE'), 'in' => 'Cash In', 'out' => 'Cash Out'];
        $bankAccountArr = BankAccount::select(DB::raw("CONCAT(bank_name,' => ',account_name,' (',account_no,')') as bank_account"), 'id')->pluck('bank_account', 'id')->toArray();
        $issues = Issue::pluck('issue_title', 'id')->toArray();

        $total_transaction = Transaction::where('application_id', $request->id)->where('issue_id', '5')->sum('amount');
        $total_in = Transaction::where('application_id', $request->id)->where('issue_id', '5')->where('transaction_type', 'in')->sum('amount');
        $total_out = Transaction::where('application_id', $request->id)->where('issue_id', '5')->where('transaction_type', 'out')->sum('amount');
        $total_profit = $total_in - $total_out;

        $targets = Transaction::where('application_id', $request->id)->where('issue_id', '5')->orderBy('id', 'desc');

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
                        ->orWhere('amount', 'like', "%{$searchText}%")
                        ->orWhere('ticket_type', 'like', "%{$searchText}%")
                        ->orWhere('new_ticket_no', 'like', "%{$searchText}%")
                        ->orWhere('old_ticket_no', 'like', "%{$searchText}%")
                        ->orWhere('flied_to', 'like', "%{$searchText}%")
                        ->orWhere('ticket_no', 'like', "%{$searchText}%")
                        ->orWhere('deport_ticket_no', 'like', "%{$searchText}%")
                        ->orWhere('fare', 'like', "%{$searchText}%");
            });
        }

        if ($request->view == 'print') {
            $targets = $targets->get();
            return view('backEnd.transaction.print.tr_print')->with(compact('targets', 'request', 'users', 'transactionTypeArr', 'bankAccountArr', 'issues'));
        } else if ($request->view == 'pdf') {
            $targets = $targets->get();
            $pdf = PDF::loadView('backEnd.transaction.print.tr_print', compact('targets', 'request', 'users', 'transactionTypeArr', 'bankAccountArr', 'issues'))
                    ->setPaper('a4', 'portrait')
                    ->setOptions(['defaultFont' => 'sans-serif']);
            $fileName = "transaction_list_" . date('d_m_Y_H_i_s');
            return $pdf->download("$fileName.pdf");
        } else if ($request->view == 'excel') {
            $targets = $targets->get();
            $viewFile = 'backEnd.transaction.print.tr_print';
            $fileName = "transaction_list_" . date('d_m_Y_H_i_s');
            $downLoadFileName = "$fileName.xlsx";
            $data['targets'] = $targets;
            $data['request'] = $request;
            $data['users'] = $users;
            $data['transactionTypeArr'] = $transactionTypeArr;
            $data['bankAccountArr'] = $bankAccountArr;
            $data['issues'] = $issues;
            return Excel::download(new ExcelExport($viewFile, $data), $downLoadFileName);
        }

        $targets = $targets->paginate(5);

//        echo "<pre>";print_r($targets->toArray());exit;


        $application_id = $request->id;
        $issue_id = '5';
        $searchFormRoute = 'packageEntry.filter';
        $searchCreatedBy = 'packageEntry.createdBy';
        $transactionListOf = 'package-entry';

        $applicationDetails = Package::where('id', $request->id)->first();

//        echo "<pre>";print_r($applicationDetails->toArray());exit;

        $data['title'] = 'Transaction';
        $data['meta_tag'] = 'Transaction page, rafiq & sons';
        $data['meta_description'] = 'Transaction, rafiq & sons';
        return view('backEnd.transaction.index')->with(compact('targets', 'issues', 'bankAccountArr', 'users', 'transactionTypeArr', 'data', 'application_id', 'total_transaction', 'total_in', 'total_out', 'total_profit', 'issue_id', 'applicationDetails', 'searchFormRoute', 'transactionListOf', 'createdBy', 'searchCreatedBy'));
    }

    public function filter(Request $request) {
        if (isset($request->created_by)) {
            $url = 'user_id=' . $request->user_id . '&transaction_type=' . $request->transaction_type . '&search_value=' . $request->search_value . '&created_by=' . $request->created_by;
        } else {
            $url = 'user_id=' . $request->user_id . '&transaction_type=' . $request->transaction_type . '&search_value=' . $request->search_value;
        }
        return redirect('admin/package-entry/' . $request->id . '/transaction-list?' . $url);
    }

    public function packageFilter(Request $request) {
        if (isset($request->created_by)) {
            $url = 'filter=true' . '&created_by=' . $request->created_by . '&search_value=' . $request->search_value;
        } else {
            $url = 'filter=true&search_value=' . $request->search_value;
        }
        return redirect('admin/package-entry?' . $url);
    }

    public function uploadImageForUpdate($target, $request) {
//        echo "<pre>";print_r($request->all());exit;
        $preFileArr = [];
        if (!empty($target->attachments)) {
            foreach ($target->attachments as $index => $image) {
                $preFileArr[$index] = $image->doc_name;
            }
        }

        $reqPreImage = $request->preImage;

        $preFinalArr = array_intersect_key($preFileArr, $reqPreImage);

        $fileArr = [];
        if ($files = $request->file('doc_name')) {
            foreach ($files as $key => $file) {
                $filePath = 'uploads/attachments/';
                $fileName = uniqid() . "." . date('Ymd') . "." . $file->getClientOriginalExtension();
                $dbName = $filePath . '' . $fileName;
                $file->move($filePath, $fileName);
                $fileArr[$key] = $dbName;
            }
        }


        // if change existing file then it will replace previous file name into new one.
        $replaceExistingFile = array_replace_recursive($preFinalArr, $fileArr);

        $realFileArr = [];
        $j = 0;
        foreach ($replaceExistingFile as $key => $replaceFile) {
            $realFileArr[$j]['issue_type'] = 5;
            $realFileArr[$j]['application_id'] = $target->id ?? null;
            $realFileArr[$j]['doc_name'] = $replaceFile ?? 0;
            $realFileArr[$j]['title'] = $request->title[$key];
            $realFileArr[$j]['serial'] = $request->serial[$key] ?? 0;
            $realFileArr[$j]['status'] = $request->status[$key] ?? 0;
            $j++;
        }


        if (DocumentAttachment::where('application_id', $target->id)->delete()) {
            DocumentAttachment::insert($realFileArr);
            return true;
        }
    }

    public function uploadFile($applicationId, $request) {

        if ($files = $request->file('doc_name')) {
            foreach ($files as $key => $file) {
                $filePath = 'uploads/attachments/';
                $fileName = uniqid() . "." . date('Ymd') . "." . $file->getClientOriginalExtension();
                $dbName = $filePath . '' . $fileName;
                $file->move($filePath, $fileName);

                $target = new DocumentAttachment;
                $target->issue_type = 5;
                $target->application_id = $applicationId;
                $target->doc_name = $dbName;
                $target->title = $request->title[$key] ?? '';
                $target->serial = $request->serial[$key] ?? 0;
                $target->status = $request->status[$key] ?? 0;
                $target->save();
            }
        }
        return true;
    }

    public function combineReport(Request $request) {
        $applicationDetails = PackageApplication::select('customer_code', 'name', 'ticket_no')->where('id', $request->id)->first();
        $invoices = Invoice::where('customer_code', $applicationDetails->customer_code)->where('issue_id', '4')->get();
        $transactions = Transaction::where(['issue_id' => '4', 'application_id' => $request->id])->get();
        $users = ['' => __('lang.SELECT_USER')] + User::select(DB::raw("CONCAT(users.name,' (',users.phone,')') as name"), 'users.id as id')->pluck('name', 'id')->toArray();
 

        $application_id = $request->id;
        $transactionListOf = 'ticket-entry';
        $issue_id = '4';

        $data['title'] = 'Combine Report';
        $data['meta_tag'] = 'Combine Report page, rafiq & sons';
        $data['meta_description'] = 'Combine Report, rafiq & sons';
        return view('backEnd.report.combine_report')->with(compact('invoices', 'transactions','users' ,'data', 'application_id', 'issue_id', 'applicationDetails','transactionListOf'));
    }

}
