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

class PassportEntryController extends Controller {

    public function index(Request $request) {
//        echo "<pre>";print_r($request->all());exit;
        $banksArr = ['' => __('lang.SELECT_BANK')] + BankAccount::pluck('bank_name', 'id')->toArray();
        $targets = PassportApplication::select('id', 'customer_code', 'name', 'passport_no', 'mobile_no', 'created_at')->orderBy('id', 'desc');

//        if (!empty($request->transaction_type)) {
//            $targets = $targets->where('transaction_type', $request->transaction_type);
//        }
        if (!empty($request->search_value)) {
            $searchText = $request->search_value;
            $targets->where(function ($query) use ($searchText) {
                $query->where('customer_code', 'like', "%{$searchText}%")
                        ->orWhere('name', 'like', "%{$searchText}%")
                        ->orWhere('passport_no', 'like', "%{$searchText}%")
                        ->orWhere('father_name', 'like', "%{$searchText}%")
                        ->orWhere('mobile_no', 'like', "%{$searchText}%");
            });
        }

        if ($request->view == 'print') {
            $targets = $targets->get();
            return view('backEnd.passport.print.print-passport-list')->with(compact('targets', 'request'));
        } else if ($request->view == 'pdf') {
            $targets = $targets->get();
            $pdf = PDF::loadView('backEnd.passport.print.print-passport-list', compact('targets', 'request'))
                    ->setPaper('a4', 'portrait')
                    ->setOptions(['defaultFont' => 'sans-serif']);
            $fileName = "passport_entry_list_" . date('d_m_Y_H_i_s');
            return $pdf->download("$fileName.pdf");
        } else if ($request->view == 'excel') {
            $targets = $targets->get();
            $viewFile = 'backEnd.passport.print.print-passport-list';
            $fileName = "passport_entry_list_" . date('d_m_Y_H_i_s');
            $downLoadFileName = "$fileName.xlsx";
            $data['targets'] = $targets;
            $data['request'] = $request;
            return Excel::download(new ExcelExport($viewFile, $data), $downLoadFileName);
        }


        $targets = $targets->paginate(5);

        $data['title'] = 'Passpor List';
        $data['meta_tag'] = 'Passpor List, rafiq & sons';
        $data['meta_description'] = 'Passpor List, rafiq & sons';

        return view('backEnd.passport.index')->with(compact('data', 'targets'));
    }

    public function create(Request $request) {

        $countries = ['' => __('lang.SELECT_COUNTRY')] + Country::select(DB::raw("CONCAT(name,' (',iso_code_2,')') as country_name"), 'id')->pluck('country_name', 'id')->toArray();

        $entryTypes = ['' => __('lang.SELECT_ENTRY_TYPE')] + EntryTypes::where('status', '1')->where('category_id', '2')->pluck('title', 'id')->toArray();

        $years = ['' => __('lang.SELECT_YEAR')] + Year::pluck('year', 'year')->toArray();

        $airports = ['' => __('lang.SELECT_AIRPORT')] + Airport::select(DB::raw("CONCAT(name,' (',countryCode,')') as name"), 'countryCode', 'code')->orderBy('countryCode')->pluck('name', 'name')->toArray();

        $districts = ['' => __('lang.SELECT_DISTRICT')] + District::orderBy('name')->pluck('name', 'id')->toArray();

        $thanas = ['' => __('lang.SELECT_THANA')] + Thana::orderBy('name')->pluck('name', 'id')->toArray();


        if (!empty($request->countryId) && !empty($request->typeId) && !empty($request->year)) {
            $type = explode(' ', $entryTypes[$request->typeId]);
            $year = $years[$request->year];
            $countryName = explode(' ', str_replace(array('(', ')'), '', $countries[$request->countryId]));

            $latestPassport = PassportApplication::select('id')->latest()->take(1)->first();

            $latestPassId = !empty($latestPassport->id) ? $latestPassport->id + 1 : '0';

            $customerCode = end($countryName) . '-' . $type[0] . '-' . $year . '-' . $latestPassId;
            return $customerCode;
        }

        $data['title'] = 'Visa Entry';
        $data['meta_tag'] = 'visa entry, rafiq & sons';
        $data['meta_description'] = 'visa entry, rafiq & sons';

        return view('backEnd.passport.create', compact('data', 'countries', 'entryTypes', 'years', 'airports', 'districts', 'thanas'));
    }

    public function generateCusCode(Request $request) {
        $customerCode = $this->create($request);
        return response()->json(['data' => $customerCode]);
    }

    public function store(Request $request) {

        $rules = [
            'country_id' => 'required',
            'type_id' => 'required',
            'year' => 'required',
            'customer_code' => 'required',
            'name' => 'required',
//            'passport_no' => 'required',
//            'mobile_no' => 'required|numeric',
        ];
        
        if (!empty($request->passport_issue_date) && !empty($request->passport_expiry_date)) {
            $rules = [
                'passport_expiry_date' => ['after:passport_issue_date'],
            ];
        }


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('passportEntry.create')->withInput()->withErrors($validator);
        }

        $target = new PassportApplication;
        $target->country_id = $request->country_id;
        $target->type_id = $request->type_id;
        $target->year = $request->year;
        $target->customer_code = $request->customer_code;
        $target->name = $request->name;
        $target->passport_no = $request->passport_no;
        $target->father_name = $request->father_name;
        $target->passport_issue_date = $request->passport_issue_date;
        $target->passport_recieve_date = $request->passport_recieve_date;
        $target->passport_expiry_date = $request->passport_expiry_date;
        $target->passport_send_date = $request->passport_send_date;
        $target->dob = $request->dob;
        $target->village = $request->village;
        $target->post_office = $request->post_office;
        $target->police_station = $request->police_station;
        $target->district = $request->district;
        $target->profession = $request->profession;
        $target->mobile_no = $request->mobile_no;
        $target->other_information = $request->other_information;
        if ($target->save()) {
            if (!empty($request->note)) {
                $notes = new Note;
                $notes->application_id = $target->id;
                $notes->issue_id = 2;
                $notes->note = $request->note;
                $notes->save();
            }
            $this->uploadFile($target->id, $request);
            Session::flash('success', __('lang.PASSPORT_ADDED_SUCCESSFULLY'));
            return redirect()->route('passportEntry.index');
        }
    }
    
    public function uploadFile($applicationId, $request) {
//        echo "<pre>";print_r($request->all());exit;
        if ($files = $request->file('doc_name')) {
            foreach ($files as $key => $file) {
                $filePath = 'uploads/attachments/';
                $fileName = uniqid() . "." . date('Ymd') . "." . $file->getClientOriginalExtension();
                $dbName = $filePath . '' . $fileName;
                $file->move($filePath, $fileName);

                $target = new DocumentAttachment;
                $target->issue_type = 2;
                $target->application_id = $applicationId;
                $target->doc_name = $dbName;
                $target->title = $raquest->title[$key] ?? '';
                $target->serial = $request->serial[$key] ?? 0;
                $target->status = $request->status[$key] ?? 0;
                $target->save();
            }
        }
        return true;
    }

    public function view(Request $request) {

        $target = PassportApplication::findOrFail($request->id);

        $notes = Note::where('application_id', $request->id)->where('issue_id', '1')->get();

        $countries = Country::select(DB::raw("CONCAT(name,' (',iso_code_2,')') as country_name"), 'id')->pluck('country_name', 'id')->toArray();

        $entryTypes = EntryTypes::where('status', '1')->where('category_id', '2')->pluck('title', 'id')->toArray();

        $years = Year::pluck('year', 'year')->toArray();

//        $airports = Airport::select(DB::raw("CONCAT(name,' (',countryCode,')') as name"), 'countryCode','code')->orderBy('countryCode')->pluck('name', 'name')->toArray();

        $districts = District::orderBy('name')->pluck('name', 'id')->toArray();

        $thanas = Thana::orderBy('name')->pluck('name', 'id')->toArray();

        if ($request->view == 'print') {
            return view('backEnd.passport.print.print-passport-details')->with(compact('target', 'request', 'countries', 'entryTypes', 'years', 'districts', 'thanas', 'notes'));
        } else if ($request->view == 'pdf') {
            $pdf = PDF::loadView('backEnd.passport.print.print-passport-details', compact('target', 'request', 'countries', 'entryTypes', 'years', 'districts', 'thanas', 'notes'))
                    ->setPaper('a4', 'portrait')
                    ->setOptions(['defaultFont' => 'sans-serif']);
            $fileName = $target->customer_code . "_passport_details_" . date('d_m_Y_H_i_s');
            return $pdf->download("$fileName.pdf");
        } else if ($request->view == 'excel') {
            $viewFile = 'backEnd.passport.print.print-passport-details';
            $fileName = $target->customer_code . "_passport_details_" . date('d_m_Y_H_i_s');
            $downLoadFileName = "$fileName.xlsx";
            $data['target'] = $target;
            $data['request'] = $request;
            $data['countries'] = $countries;
            $data['entryTypes'] = $entryTypes;
            $data['years'] = $years;
            $data['districts'] = $districts;
            $data['thanas'] = $thanas;
            $data['notes'] = $notes;
            return Excel::download(new ExcelExport($viewFile, $data), $downLoadFileName);
        }

        $data['title'] = 'View Passport';
        $data['meta_tag'] = 'View Passport, rafiq & sons';
        $data['meta_description'] = 'View Passport, rafiq & sons';
        return view('backEnd.passport.view')->with(compact('target', 'data', 'countries', 'entryTypes', 'years', 'districts', 'thanas', 'notes'));
    }

    public function edit(Request $request) {

        $target = PassportApplication::findOrFail($request->id);

        $notes = Note::where('application_id', $request->id)->where('issue_id', '2')->get();

        $countries = ['' => __('lang.SELECT_COUNTRY')] + Country::select(DB::raw("CONCAT(name,' (',iso_code_2,')') as country_name"), 'id')->pluck('country_name', 'id')->toArray();

        $entryTypes = ['' => __('lang.SELECT_ENTRY_TYPE')] + EntryTypes::where('status', '1')->pluck('title', 'id')->toArray();

        $years = ['' => __('lang.SELECT_YEAR')] + Year::pluck('year', 'year')->toArray();

        $airports = ['' => __('lang.SELECT_AIRPORT')] + Airport::select(DB::raw("CONCAT(name,' (',countryCode,')') as name"), 'countryCode', 'code')->orderBy('countryCode')->pluck('name', 'name')->toArray();

        $districts = ['' => __('lang.SELECT_DISTRICT')] + District::orderBy('name')->pluck('name', 'id')->toArray();

        $thanas = ['' => __('lang.SELECT_THANA')] + Thana::orderBy('name')->pluck('name', 'id')->toArray();

        $data['title'] = 'Edit Passport';
        $data['meta_tag'] = 'Edit Passport, rafiq & sons';
        $data['meta_description'] = 'Edit Passport, rafiq & sons';
        return view('backEnd.passport.edit')->with(compact('target', 'data', 'countries', 'entryTypes', 'years', 'districts', 'thanas', 'notes', 'airports'));
    }

    public function update(Request $request) {

        $rules = [
            'country_id' => 'required',
            'type_id' => 'required',
            'year' => 'required',
            'customer_code' => 'required',
            'name' => 'required',
//            'passport_no' => 'required',
//            'mobile_no' => 'required|numeric',
        ];
        
        if (!empty($request->passport_issue_date) && !empty($request->passport_expiry_date)) {
            $rules = [
                'passport_expiry_date' => ['after:passport_issue_date'],
            ];
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('passportEntry.edit', $request->id)->withInput()->withErrors($validator);
        }

        $target = PassportApplication::findOrFail($request->id);
        $target->country_id = $request->country_id;
        $target->type_id = $request->type_id;
        $target->year = $request->year;
        $target->customer_code = $request->customer_code;
        $target->name = $request->name;
        $target->passport_no = $request->passport_no;
        $target->father_name = $request->father_name;
        $target->passport_issue_date = $request->passport_issue_date;
        $target->passport_recieve_date = $request->passport_recieve_date;
        $target->passport_expiry_date = $request->passport_expiry_date;
        $target->passport_send_date = $request->passport_send_date;
        $target->dob = $request->dob;
        $target->village = $request->village;
        $target->post_office = $request->post_office;
        $target->police_station = $request->police_station;
        $target->district = $request->district;
        $target->profession = $request->profession;
        $target->mobile_no = $request->mobile_no;
        $target->other_information = $request->other_information;
        if ($target->save()) {
            if (count($request->note) > 0) {
                $notes = Note::where('application_id', $target->id)->where('issue_id', '2')->delete();
                $noteData = [];
                $i = 0;
                foreach ($request->note as $note) {
                    if (!empty($note)) {
                        $noteData[$i]['application_id'] = $target->id;
                        $noteData[$i]['issue_id'] = 2;
                        $noteData[$i]['note'] = $note;
                        $i++;
                    }
                }
                Note::insert($noteData);
            }
            $this->uploadImageForUpdate($target, $request);
            Session::flash('success', __('lang.PASSPORT_UPDATED_SUCCESSFULLY'));
            return redirect()->route('passportEntry.index');
        }
    }
    
    public function uploadImageForUpdate($target, $request) {
      
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
            $realFileArr[$j]['issue_type'] = 2;
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

    public function destroy(Request $request) {
        $target = PassportApplication::findOrFail($request->id);
        if ($target->delete()) {
            $notes = Note::where('application_id', $request->id)->where('issue_id', '2')->delete();
            Session::flash('success', __('lang.PASSPORT_DELETED_SUCCESSFULLY'));
            return redirect()->route('passportEntry.index');
        }
    }

    public function transactionList(Request $request) {

        $users = ['' => __('lang.SELECT_USER')] + User::join('user_roles', 'user_roles.id', 'users.role_id')->select(DB::raw("CONCAT(users.name,' (',user_roles.role_name,')') as name"), 'users.id as id')->pluck('name', 'id')->toArray();
        $transactionTypeArr = ['' => __('lang.SELECT_TR_TYPE'), 'in' => 'Cash In', 'out' => 'Cash Out'];
        $bankAccountArr = BankAccount::select(DB::raw("CONCAT(bank_name,' => ',account_name,' (',account_no,')') as bank_account"), 'id')->pluck('bank_account', 'id')->toArray();
        $issues = Issue::pluck('issue_title', 'id')->toArray();

        $total_transaction = Transaction::where('application_id', $request->id)->where('issue_id', '2')->sum('amount');
        $total_in = Transaction::where('application_id', $request->id)->where('issue_id', '2')->where('transaction_type', 'in')->sum('amount');
        $total_out = Transaction::where('application_id', $request->id)->where('issue_id', '2')->where('transaction_type', 'out')->sum('amount');
        $total_profit = $total_in - $total_out;

        $targets = Transaction::where('application_id', $request->id)->where('issue_id', '2')->orderBy('id', 'asc');

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

//         echo "<pre>";print_r($targets->toArray());exit;

        $application_id = $request->id;
        $transactionListOf = 'passport-entry';
        $issue_id = '2';
        $searchFormRoute = 'passportEntry.filter';

        $applicationDetails = PassportApplication::select('customer_code', 'name', 'passport_no')->where('id', $request->id)->first();
//        echo "<pre>";print_r($applicationDetails->toArray());exit;
        $data['title'] = 'Transaction';
        $data['meta_tag'] = 'Transaction page, rafiq & sons';
        $data['meta_description'] = 'Transaction, rafiq & sons';
        return view('backEnd.transaction.index')->with(compact('targets', 'issues', 'bankAccountArr', 'users', 'transactionTypeArr', 'data', 'application_id', 'total_transaction', 'total_in', 'total_out', 'total_profit', 'issue_id', 'applicationDetails', 'searchFormRoute', 'transactionListOf'));
    }

    public function filter(Request $request) {
//        echo "<pre>";print_r($request->id);exit;
        $url = 'user_id=' . $request->user_id . '&transaction_type=' . $request->transaction_type . '&search_value=' . $request->search_value;
        return redirect('admin/passport-entry/' . $request->id . '/transaction-list?' . $url);
    }

    public function PassportFilter(Request $request) {
        $url = 'filter=true' . '&search_value=' . $request->search_value;
        return redirect('admin/passport-entry?' . $url);
    }
    
    


}
