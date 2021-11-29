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
use App\Models\TicketApplication;
use App\Models\DocumentAttachment;
use App\Models\User;
use App\Models\Issue;
use App\Models\Transaction;
use Session;
use DB;
use App\Helpers\Helper;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExcelExport;
use PDF;

class TicketEntryController extends Controller {

    public function index(Request $request) {
//        echo "<pre>";print_r($request->all());exit;
        $banksArr = ['' => __('lang.SELECT_BANK')] + BankAccount::pluck('bank_name', 'id')->toArray();
        $targets = TicketApplication::select('id', 'customer_code', 'name', 'ticket_no', 'created_at')->orderBy('id', 'desc');

//        if (!empty($request->transaction_type)) {
//            $targets = $targets->where('transaction_type', $request->transaction_type);
//        }
        if (!empty($request->search_value)) {
            $searchText = $request->search_value;
            $targets->where(function ($query) use ($searchText) {
                $query->where('customer_code', 'like', "%{$searchText}%")
                        ->orWhere('name', 'like', "%{$searchText}%")
                        ->orWhere('ticket_no', 'like', "%{$searchText}%");
            });
        }

        if ($request->view == 'print') {
            $targets = $targets->get();
            return view('backEnd.ticket.print.print-ticket-list')->with(compact('targets', 'request'));
        } else if ($request->view == 'pdf') {
            $targets = $targets->get();
            $pdf = PDF::loadView('backEnd.ticket.print.print-ticket-list', compact('targets', 'request'))
                    ->setPaper('a4', 'portrait')
                    ->setOptions(['defaultFont' => 'sans-serif']);
            $fileName = "ticket_entry_list_" . date('d_m_Y_H_i_s');
            return $pdf->download("$fileName.pdf");
        } else if ($request->view == 'excel') {
            $targets = $targets->get();
            $viewFile = 'backEnd.ticket.print.print-ticket-list';
            $fileName = "ticket_entry_list_" . date('d_m_Y_H_i_s');
            $downLoadFileName = "$fileName.xlsx";
            $data['targets'] = $targets;
            $data['request'] = $request;
            return Excel::download(new ExcelExport($viewFile, $data), $downLoadFileName);
        }
        $targets = $targets->paginate(5);

        $data['title'] = 'Ticket List';
        $data['meta_tag'] = 'Ticket List, rafiq & sons';
        $data['meta_description'] = 'Ticket List, rafiq & sons';

        return view('backEnd.ticket.index')->with(compact('data', 'targets'));
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

            $latestPassport = TicketApplication::select('id')->latest()->take(1)->first();

            $latestPassId = !empty($latestPassport->id) ? $latestPassport->id + 1 : '1';

            $customerCode = end($countryName) . '-' . $type[0] . '-' . $year . '-' . $latestPassId;
            return $customerCode;
        }

        $data['title'] = 'Ticket Entry';
        $data['meta_tag'] = 'Ticket entry, rafiq & sons';
        $data['meta_description'] = 'Ticket entry, rafiq & sons';

        return view('backEnd.ticket.create', compact('data', 'countries', 'entryTypes', 'years', 'airports'));
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
//            'ticket_no' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('ticketEntry.create')->withInput()->withErrors($validator);
        }

        $target = new TicketApplication;
        $target->country_id = $request->country_id;
        $target->type_id = $request->type_id;
        $target->year = $request->year;
        $target->customer_code = $request->customer_code;
        $target->name = $request->name;
        $target->ticket_no = $request->ticket_no;
        $target->issue_date = $request->issue_date;
        $target->agent = $request->agent;
        $target->fly_from = $request->fly_from;
        $target->fly_to = $request->fly_to;
        $target->carrier = $request->carrier;
        $target->flying_date = $request->flying_date;
        $target->fly_type = $request->fly_type;
        $target->takeoff_time = $request->takeoff_time;
        $target->landing_time = $request->landing_time;
        $target->fare = $request->fare;
        $target->tax = $request->tax;
        $target->tax_type = $request->tax_type;
        $target->fare_with_tax = $request->fare_with_tax;
        $target->ait_percentage = $request->ait_percentage;
        $target->ait_tax = $request->ait_tax;
        $target->commission = $request->commission;
        $target->commission_type = $request->commission_type;
        $target->net_fare = $request->net_fare;
        if ($target->save()) {
//            if (!empty($request->note)) {
//                $notes = new Note;
//                $notes->application_id = $target->id;
//                $notes->issue_id = 2;
//                $notes->note = $request->note;
//                $notes->save();
//            }
            $this->uploadFile($target->id, $request);
            Session::flash('success', __('lang.TICKET_ADDED_SUCCESSFULLY'));
            return redirect()->route('ticketEntry.index');
        }
    }

    public function view(Request $request) {

        $target = TicketApplication::findOrFail($request->id);

        $countries = Country::select(DB::raw("CONCAT(name,' (',iso_code_2,')') as country_name"), 'id')->pluck('country_name', 'id')->toArray();

        $entryTypes = EntryTypes::where('status', '1')->where('category_id', '4')->pluck('title', 'id')->toArray();

        $years = Year::pluck('year', 'year')->toArray();


        if ($request->view == 'print') {
            return view('backEnd.ticket.print.print-ticket-details')->with(compact('target', 'request', 'countries', 'entryTypes', 'years'));
        } else if ($request->view == 'pdf') {
            $pdf = PDF::loadView('backEnd.ticket.print.print-ticket-details', compact('target', 'request', 'countries', 'entryTypes', 'years'))
                    ->setPaper('a4', 'portrait')
                    ->setOptions(['defaultFont' => 'sans-serif']);
            $fileName = $target->customer_code . "_ticket_details_" . date('d_m_Y_H_i_s');
            return $pdf->download("$fileName.pdf");
        } else if ($request->view == 'excel') {
            $viewFile = 'backEnd.ticket.print.print-ticket-details';
            $fileName = $target->customer_code . "_ticket_details_" . date('d_m_Y_H_i_s');
            $downLoadFileName = "$fileName.xlsx";
            $data['target'] = $target;
            $data['request'] = $request;
            $data['countries'] = $countries;
            $data['entryTypes'] = $entryTypes;
            $data['years'] = $years;
            return Excel::download(new ExcelExport($viewFile, $data), $downLoadFileName);
        }


        $data['title'] = 'View Ticket';
        $data['meta_tag'] = 'View Ticket, rafiq & sons';
        $data['meta_description'] = 'View Ticket, rafiq & sons';
        return view('backEnd.ticket.view')->with(compact('target', 'data', 'countries', 'entryTypes', 'years'));
    }

    public function edit(Request $request) {

        $target = TicketApplication::findOrFail($request->id);

        $notes = Note::where('application_id', $request->id)->where('issue_id', '2')->get();

        $countries = ['' => __('lang.SELECT_COUNTRY')] + Country::select(DB::raw("CONCAT(name,' (',iso_code_2,')') as country_name"), 'id')->pluck('country_name', 'id')->toArray();

        $entryTypes = ['' => __('lang.SELECT_ENTRY_TYPE')] + EntryTypes::where('status', '1')->where('category_id', '4')->pluck('title', 'id')->toArray();

        $years = ['' => __('lang.SELECT_YEAR')] + Year::pluck('year', 'year')->toArray();

        $airports = ['' => __('lang.SELECT_AIRPORT')] + Airport::select(DB::raw("CONCAT(name,' (',countryCode,')') as name"), 'countryCode', 'code')->orderBy('countryCode')->pluck('name', 'name')->toArray();

        $data['title'] = 'Edit Medical';
        $data['meta_tag'] = 'Edit Medical, rafiq & sons';
        $data['meta_description'] = 'Edit Medical, rafiq & sons';
        return view('backEnd.ticket.edit')->with(compact('target', 'data', 'countries', 'entryTypes', 'years', 'airports'));
    }

    public function update(Request $request) {

        $rules = [
            'country_id' => 'required',
            'type_id' => 'required',
            'year' => 'required',
            'customer_code' => 'required',
            'name' => 'required',
//            'ticket_no' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('ticketEntry.edit', $request->id)->withInput()->withErrors($validator);
        }

        $target = TicketApplication::findOrFail($request->id);
        $target->country_id = $request->country_id;
        $target->type_id = $request->type_id;
        $target->year = $request->year;
        $target->customer_code = $request->customer_code;
        $target->name = $request->name;
        $target->ticket_no = $request->ticket_no;
        $target->issue_date = $request->issue_date;
        $target->agent = $request->agent;
        $target->fly_from = $request->fly_from;
        $target->fly_to = $request->fly_to;
        $target->carrier = $request->carrier;
        $target->flying_date = $request->flying_date;
        $target->fly_type = $request->fly_type;
        $target->takeoff_time = $request->takeoff_time;
        $target->landing_time = $request->landing_time;
        $target->fare = $request->fare;
        $target->tax = $request->tax;
        $target->tax_type = $request->tax_type;
        $target->fare_with_tax = $request->fare_with_tax;
        $target->ait_percentage = $request->ait_percentage;
        $target->ait_tax = $request->ait_tax;
        $target->commission = $request->commission;
        $target->commission_type = $request->commission_type;
        $target->net_fare = $request->net_fare;
        if ($target->save()) {
//            if (count($request->note) > 0) {
//                $notes = Note::where('application_id', $target->id)->where('issue_id', '2')->delete();
//                $noteData = [];
//                $i = 0;
//                foreach ($request->note as $note) {
//                    if (!empty($note)) {
//                        $noteData[$i]['application_id'] = $target->id;
//                        $noteData[$i]['issue_id'] = 2;
//                        $noteData[$i]['note'] = $note;
//                        $i++;
//                    }
//                }
//                Note::insert($noteData);
//            }
            $this->uploadImageForUpdate($target, $request);
            Session::flash('success', __('lang.TICKET_UPDATED_SUCCESSFULLY'));
            return redirect()->route('ticketEntry.index');
        }
    }

    public function destroy(Request $request) {
        $target = TicketApplication::findOrFail($request->id);
        if ($target->delete()) {
//            $notes = Note::where('application_id', $request->id)->where('issue_id', '2')->delete();
            Session::flash('success', __('lang.TICKET_DELETED_SUCCESSFULLY'));
            return redirect()->route('ticketEntry.index');
        }
    }

    public function transactionList(Request $request) {

        $users = ['' => __('lang.SELECT_USER')] + User::join('user_roles', 'user_roles.id', 'users.role_id')->select(DB::raw("CONCAT(users.name,' (',user_roles.role_name,')') as name"), 'users.id as id')->pluck('name', 'id')->toArray();
        $transactionTypeArr = ['' => __('lang.SELECT_TR_TYPE'), 'in' => 'Cash In', 'out' => 'Cash Out'];
        $bankAccountArr = BankAccount::select(DB::raw("CONCAT(bank_name,' => ',account_name,' (',account_no,')') as bank_account"), 'id')->pluck('bank_account', 'id')->toArray();
        $issues = Issue::pluck('issue_title', 'id')->toArray();

        $total_transaction = Transaction::where('application_id', $request->id)->where('issue_id', '4')->sum('amount');
        $total_in = Transaction::where('application_id', $request->id)->where('issue_id', '4')->where('transaction_type', 'in')->sum('amount');
        $total_out = Transaction::where('application_id', $request->id)->where('issue_id', '4')->where('transaction_type', 'out')->sum('amount');
        $total_profit = $total_in - $total_out;

        $targets = Transaction::where('application_id', $request->id)->where('issue_id', '4')->orderBy('id', 'desc');

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
            $issue_id = '4';
            return view('backEnd.transaction.print.tr_print')->with(compact('targets', 'request', 'users', 'transactionTypeArr', 'bankAccountArr', 'issues','issue_id'));
        } else if ($request->view == 'pdf') {
            $targets = $targets->get();
            $issue_id = '4';
            $pdf = PDF::loadView('backEnd.transaction.print.tr_print', compact('targets', 'request', 'users', 'transactionTypeArr', 'bankAccountArr', 'issues','issue_id'))
                    ->setPaper('a4', 'portrait')
                    ->setOptions(['defaultFont' => 'sans-serif']);
            $fileName = "transaction_list_" . date('d_m_Y_H_i_s');
            return $pdf->download("$fileName.pdf");
        } else if ($request->view == 'excel') {
            $targets = $targets->get();
            $issue_id = '4';
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


        $application_id = $request->id;
        $transactionListOf  = 'ticket-entry';
        $issue_id = '4';
        $searchFormRoute = 'ticketEntry.filter';

        $applicationDetails = TicketApplication::select('customer_code', 'name', 'ticket_no')->where('id', $request->id)->first();
        $data['title'] = 'Transaction';
        $data['meta_tag'] = 'Transaction page, rafiq & sons';
        $data['meta_description'] = 'Transaction, rafiq & sons';
        return view('backEnd.transaction.index')->with(compact('targets', 'issues', 'bankAccountArr', 'users', 'transactionTypeArr', 'data', 'application_id', 'total_transaction', 'total_in', 'total_out', 'total_profit', 'issue_id', 'applicationDetails', 'searchFormRoute','transactionListOf'));
    }

    public function filter(Request $request) {
        $url = 'user_id=' . $request->user_id . '&transaction_type=' . $request->transaction_type . '&search_value=' . $request->search_value;
        return redirect('admin/ticket-entry/' . $request->id . '/transaction-list?' . $url);
    }

    public function ticketFilter(Request $request) {
        $url = 'filter=true' . '&search_value=' . $request->search_value;
        return redirect('admin/ticket-entry?' . $url);
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
            $realFileArr[$j]['issue_type'] = 4;
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
//        echo "<pre>";print_r($request->all());exit;
        if ($files = $request->file('doc_name')) {
            foreach ($files as $key => $file) {
                $filePath = 'uploads/attachments/';
                $fileName = uniqid() . "." . date('Ymd') . "." . $file->getClientOriginalExtension();
                $dbName = $filePath . '' . $fileName;
                $file->move($filePath, $fileName);

                $target = new DocumentAttachment;
                $target->issue_type = 4;
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


}
