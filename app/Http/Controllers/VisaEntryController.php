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
use App\Models\User;
use App\Models\Issue;
use App\Models\Transaction;
use App\Models\Setting;
use App\Models\DocumentAttachment;
use App\Models\Invoice;
use Session;
use DB;
use App\Helpers\Helper;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExcelExport;
use PDF;

class VisaEntryController extends Controller {

    public function index(Request $request) {
        $users = ['' => __('lang.SELECT_USER')] + User::select(DB::raw("CONCAT(users.name,' (',users.phone,')') as name"), 'users.id as id')->pluck('name', 'id')->toArray();
        $countries = Country::select(DB::raw("CONCAT(name,' (',iso_code_2,')') as country_name"), 'id')->pluck('country_name', 'id')->toArray();
        $entryTypes = EntryTypes::where('status', '1')->where('category_id', '1')->pluck('title', 'id')->toArray();
        $years = Year::pluck('year', 'year')->toArray();
        $districts = District::orderBy('name')->pluck('name', 'id')->toArray();
        $thanas = Thana::orderBy('name')->pluck('name', 'id')->toArray();
        $targets = VisaApplication::select('*')->orderBy('id', 'desc');

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

        if (!empty($request->expiry_date) && !empty($request->from_date) && !empty($request->to_date)) {
            $targets = $targets->whereBetween($request->expiry_date, [$request->from_date . ' 00:00:00', $request->to_date . ' 23:59:59']);
        }

        if (!empty($request->created_by)) {
            $targets->where('created_by', $request->created_by);
        }

        if ($request->view == 'print') {
            $targets = $targets->get();
            return view('backEnd.visa.print.print-visa-list')->with(compact('targets', 'request'));
        } else if ($request->view == 'pdf') {
            $targets = $targets->get();
            $pdf = PDF::loadView('backEnd.visa.print.print-visa-list', compact('targets', 'request'))
                    ->setPaper('a4', 'portrait')
                    ->setOptions(['defaultFont' => 'sans-serif']);
            $fileName = "visa_entry_list_" . date('d_m_Y_H_i_s');
            return $pdf->download("$fileName.pdf");
        } else if ($request->view == 'excel') {
            $targets = $targets->get();
            $viewFile = 'backEnd.visa.print.print-visa-list';
            $fileName = "visa_entry_list_" . date('d_m_Y_H_i_s');
            $downLoadFileName = "$fileName.xlsx";
            $data['targets'] = $targets;
            $data['request'] = $request;
            $data['countries'] = $countries;
            $data['entryTypes'] = $entryTypes;
            $data['years'] = $years;
            $data['districts'] = $districts;
            $data['thanas'] = $thanas;
            $data['users'] = $users;
            return Excel::download(new ExcelExport($viewFile, $data), $downLoadFileName);
        }

//       
        $targets = $targets->paginate(10);

        $expiryDateArr = ['' => __('lang.SELECT_EXPIRY_DATE')] + [
            'created_at' => 'Created At',
            'passport_expiry_date' => 'Passport expiry date',
            'visa_expiry_date' => 'Visa expiry date',
            'medical_expiry_date' => 'Medical expiry date',
            'police_clearence_expiry_date' => 'Police Clearence expiry date',
            'mofa_expiry_date' => 'Mofa expiry date',
            'man_power_expiry_date' => 'Man Power expiry date',
            'stamping_expiry_date' => 'Stamping expiry date',
        ];

        $data['title'] = 'Visa List';
        $data['meta_tag'] = 'Visa List, rafiq & sons';
        $data['meta_description'] = 'Visa List, rafiq & sons';

        return view('backEnd.visa.index')->with(compact('data', 'targets', 'users', 'expiryDateArr'));
    }

    public function create(Request $request) {

        $users = ['' => __('lang.SELECT_USER')] + User::join('user_roles', 'user_roles.id', 'users.role_id')->select(DB::raw("CONCAT(users.name,' (',user_roles.role_name,')') as name"), 'users.id as id')->pluck('name', 'id')->toArray();
        $countries = ['' => __('lang.SELECT_COUNTRY')] + Country::select(DB::raw("CONCAT(name,' (',iso_code_2,')') as country_name"), 'id')->pluck('country_name', 'id')->toArray();

        $entryTypes = ['' => __('lang.SELECT_ENTRY_TYPE')] + EntryTypes::where('status', '1')->where('category_id', '1')->pluck('title', 'id')->toArray();

        $years = ['' => __('lang.SELECT_YEAR')] + Year::pluck('year', 'year')->toArray();

        $airports = ['' => __('lang.SELECT_AIRPORT')] + Airport::select(DB::raw("CONCAT(name,' (',code,')',' -- (',countryCode,')') as name"), 'countryCode', 'code')->orderBy('countryCode')->pluck('name', 'name')->toArray();

        $districts = ['' => __('lang.SELECT_DISTRICT')] + District::orderBy('name')->pluck('name', 'id')->toArray();

        $thanas = ['' => __('lang.SELECT_THANA')] + Thana::orderBy('name')->pluck('name', 'id')->toArray();

//        echo "<pre>";print_r($countries);exit;

        if (!empty($request->countryId) && !empty($request->typeId) && !empty($request->year)) {
            $type = explode(' ', $entryTypes[$request->typeId]);
            $year = $years[$request->year];
            $countryName = explode(' ', str_replace(array('(', ')'), '', $countries[$request->countryId]));
            $latestVisa = VisaApplication::where('country_id', $request->countryId)->count();
            $latestVisaId = $latestVisa == 0 ? 1 : $latestVisa + 1;
            $customerCode = end($countryName) . '-' . $type[0] . '-' . $year . '-' . $latestVisaId;

            return $customerCode;
        }

        $data['title'] = 'Visa Entry';
        $data['meta_tag'] = 'visa entry, rafiq & sons';
        $data['meta_description'] = 'visa entry, rafiq & sons';

        return view('backEnd.visa.create', compact('data', 'countries', 'entryTypes', 'years', 'airports', 'districts', 'thanas', 'users'));
    }

    public function generateCusCode(Request $request) {
        $customerCode = $this->create($request);
        return response()->json(['data' => $customerCode]);
    }

    public function store(Request $request) {
//        echo "<pre>";
//        print_r($request->all());
//        exit;
        $rules = [
            'country_id' => 'required',
            'type_id' => 'required',
            'year' => 'required',
            'customer_code' => 'required',
            'name' => 'required',
        ];

        if (!empty($request->passport_issue_date) && !empty($request->passport_expiry_date)) {
            $rules = [
                'passport_expiry_date' => ['after:passport_issue_date'],
            ];
        }
        if (!empty($request->visa_issue_date) && !empty($request->visa_expiry_date)) {
            $rules = [
                'visa_expiry_date' => ['after:visa_issue_date'],
            ];
        }
        if (!empty($request->medical_date) && !empty($request->medical_expiry_date)) {
            $rules = [
                'medical_expiry_date' => ['after:medical_date'],
            ];
        }
        if (!empty($request->police_clearence_recieve_date) && !empty($request->police_clearence_expiry_date)) {
            $rules = [
                'police_clearence_expiry_date' => ['after:police_clearence_recieve_date'],
            ];
        }
        if (!empty($request->mofa_date) && !empty($request->mofa_expiry_date)) {
            $rules = [
                'mofa_expiry_date' => ['after:mofa_date'],
            ];
        }
        if (!empty($request->stamping_date) && !empty($request->stamping_expiry_date)) {
            $rules = [
                'stamping_expiry_date' => ['after:stamping_date'],
            ];
        }
        if (!empty($request->stamping_date) && !empty($request->stamping_expiry_date)) {
            $rules = [
                'stamping_expiry_date' => ['after:stamping_date'],
            ];
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('visaEntry.create')->withInput()->withErrors($validator);
        }

        $target = new VisaApplication;
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
        $target->village = $request->village;
        $target->post_office = $request->post_office;
        $target->police_station = $request->police_station;
        $target->district = $request->district;
        $target->profession = $request->profession;
        $target->mobile_no = $request->mobile_no;
        $target->visa_no = $request->visa_no;
        $target->id_no = $request->id_no;
        $target->visa_issue_date = $request->visa_issue_date;
        $target->visa_expiry_date = $request->visa_expiry_date;
        $target->okala_date = $request->okala_date;
        $target->medical_date = $request->medical_date;
        $target->medical_card_recieve_date = $request->medical_card_recieve_date;
        $target->medical_expiry_date = $request->medical_expiry_date;
        $target->police_clearence_recieve_date = $request->police_clearence_recieve_date;
        $target->police_clearence_expiry_date = $request->police_clearence_expiry_date;
        $target->police_reference_no = $request->police_reference_no;
        $target->mofa_no = $request->mofa_no;
        $target->mofa_date = $request->mofa_date;
        $target->mofa_expiry_date = $request->mofa_expiry_date;
        $target->em_submit_date = $request->em_submit_date;
        $target->stamping_date = $request->stamping_date;
        $target->delivery_date = $request->delivery_date;
        $target->stamping_expiry_date = $request->stamping_expiry_date;
        $target->training_card_recieve_date = $request->training_card_recieve_date;
        $target->finger_date = $request->finger_date;
        $target->man_power_submit_date = $request->man_power_submit_date;
        $target->man_power_expiry_date = $request->man_power_expiry_date;
        $target->rl_no = $request->rl_no;
        $target->document_sending_date = $request->document_sending_date;
        $target->flying_form = $request->flying_form;
        $target->flying_to = $request->flying_to;
        $target->carrier = $request->carrier;
        $target->flying_date = $request->flying_date;
        $target->submit_agency = $request->submit_agency;
        $target->ref_agent = $request->ref_agent;
        $target->other_information = $request->other_information;
        if ($target->save()) {
            $data = [
                'issue_type' => 'visa',
                'issue_id' => $target->id,
                'action' => 'create',
                'user_id' => \Auth::id(),
                'ip_address' => request()->ip(),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
//            echo "<pre>";print_r($data);exit;
            Helper::log($data);
            if (!empty($request->note)) {
                $notes = new Note;
                $notes->application_id = $target->id;
                $notes->issue_id = 1;
                $notes->note = $request->note;
                $notes->save();
            }
            $this->uploadFile($target->id, $request);
            Session::flash('success', __('lang.VISA_ADDED_SUCCESSFULLY'));
            return redirect()->route('visaEntry.index');
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
                $target->issue_type = 1;
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

    public function view(Request $request) {
        $target = VisaApplication::with('attachments')->findOrFail($request->id);
        $users = ['' => __('lang.SELECT_USER')] + User::join('user_roles', 'user_roles.id', 'users.role_id')->select(DB::raw("CONCAT(users.name,' (',user_roles.role_name,')') as name"), 'users.id as id')->pluck('name', 'id')->toArray();
        $notes = Note::where('application_id', $request->id)->where('issue_id', '1')->get();
//        echo "<pre>";print_r($target->toArray());exit;

        $countries = Country::select(DB::raw("CONCAT(name,' (',iso_code_2,')') as country_name"), 'id')->pluck('country_name', 'id')->toArray();

        $entryTypes = EntryTypes::where('status', '1')->where('category_id', '1')->pluck('title', 'id')->toArray();

        $years = Year::pluck('year', 'year')->toArray();

//        $airports = Airport::select(DB::raw("CONCAT(name,' (',countryCode,')') as name"), 'countryCode','code')->orderBy('countryCode')->pluck('name', 'name')->toArray();

        $districts = District::orderBy('name')->pluck('name', 'id')->toArray();

        $thanas = Thana::orderBy('name')->pluck('name', 'id')->toArray();

        if ($request->view == 'print') {
            return view('backEnd.visa.print.print-visa-details')->with(compact('target', 'request', 'countries', 'entryTypes', 'years', 'districts', 'thanas', 'notes'));
        } else if ($request->view == 'pdf') {
            $pdf = PDF::loadView('backEnd.visa.print.print-visa-details', compact('target', 'request', 'countries', 'entryTypes', 'years', 'districts', 'thanas', 'notes'))
                    ->setPaper('a4', 'portrait')
                    ->setOptions(['defaultFont' => 'sans-serif']);
            $fileName = $target->customer_code . "_visa_details_" . date('d_m_Y_H_i_s');
            return $pdf->download("$fileName.pdf");
        } else if ($request->view == 'excel') {
            $viewFile = 'backEnd.visa.print.print-visa-details';
            $fileName = $target->customer_code . "_visa_details_" . date('d_m_Y_H_i_s');
            $downLoadFileName = "$fileName.xlsx";
            $data['target'] = $target;
            $data['request'] = $request;
            $data['countries'] = $countries;
            $data['entryTypes'] = $entryTypes;
            $data['years'] = $years;
            $data['districts'] = $districts;
            $data['thanas'] = $thanas;
            $data['notes'] = $notes;
            $data['users'] = $users;
            return Excel::download(new ExcelExport($viewFile, $data), $downLoadFileName);
        }

        $data['title'] = 'View Visa Details';
        $data['meta_tag'] = 'View Visa Details, rafiq & sons';
        $data['meta_description'] = 'View Visa Details, rafiq & sons';
        return view('backEnd.visa.view')->with(compact('target', 'data', 'countries', 'entryTypes', 'years', 'districts', 'thanas', 'notes', 'users'));
    }

    public function edit(Request $request) {
        $users = ['' => __('lang.SELECT_USER')] + User::join('user_roles', 'user_roles.id', 'users.role_id')->select(DB::raw("CONCAT(users.name,' (',user_roles.role_name,')') as name"), 'users.id as id')->pluck('name', 'id')->toArray();

        $target = VisaApplication::with('attachments')->findOrFail($request->id);

        $notes = Note::where('application_id', $request->id)->where('issue_id', '1')->get();

        $countries = ['' => __('lang.SELECT_COUNTRY')] + Country::select(DB::raw("CONCAT(name,' (',iso_code_2,')') as country_name"), 'id')->pluck('country_name', 'id')->toArray();

        $entryTypes = ['' => __('lang.SELECT_ENTRY_TYPE')] + EntryTypes::where('status', '1')->where('category_id', '1')->pluck('title', 'id')->toArray();

        $years = ['' => __('lang.SELECT_YEAR')] + Year::pluck('year', 'year')->toArray();

        $airports = ['' => __('lang.SELECT_AIRPORT')] + Airport::select(DB::raw("CONCAT(name,' (',countryCode,')') as name"), 'countryCode', 'code')->orderBy('countryCode')->pluck('name', 'name')->toArray();

        $districts = ['' => __('lang.SELECT_DISTRICT')] + District::orderBy('name')->pluck('name', 'id')->toArray();

        $thanas = ['' => __('lang.SELECT_THANA')] + Thana::orderBy('name')->pluck('name', 'id')->toArray();

        $data['title'] = 'Edit Visa';
        $data['meta_tag'] = 'Edit Visa, rafiq & sons';
        $data['meta_description'] = 'Edit Visa, rafiq & sons';
        return view('backEnd.visa.edit')->with(compact('target', 'data', 'countries', 'entryTypes', 'years', 'districts', 'thanas', 'notes', 'airports', 'users'));
    }

    public function update(Request $request) {
//        
        $rules = [
            'country_id' => 'required',
            'type_id' => 'required',
            'year' => 'required',
            'customer_code' => 'required',
            'name' => 'required',
        ];

        if (!empty($request->passport_issue_date) && !empty($request->passport_expiry_date)) {
            $rules = [
                'passport_expiry_date' => ['after:passport_issue_date'],
            ];
        }
        if (!empty($request->visa_issue_date) && !empty($request->visa_expiry_date)) {
            $rules = [
                'visa_expiry_date' => ['after:visa_issue_date'],
            ];
        }
        if (!empty($request->medical_date) && !empty($request->medical_expiry_date)) {
            $rules = [
                'medical_expiry_date' => ['after:medical_date'],
            ];
        }
        if (!empty($request->police_clearence_recieve_date) && !empty($request->police_clearence_expiry_date)) {
            $rules = [
                'police_clearence_expiry_date' => ['after:police_clearence_recieve_date'],
            ];
        }
        if (!empty($request->mofa_date) && !empty($request->mofa_expiry_date)) {
            $rules = [
                'mofa_expiry_date' => ['after:mofa_date'],
            ];
        }
        if (!empty($request->stamping_date) && !empty($request->stamping_expiry_date)) {
            $rules = [
                'stamping_expiry_date' => ['after:stamping_date'],
            ];
        }
        if (!empty($request->stamping_date) && !empty($request->stamping_expiry_date)) {
            $rules = [
                'stamping_expiry_date' => ['after:stamping_date'],
            ];
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('visaEntry.edit', $request->id)->withInput()->withErrors($validator);
        }

        $target = VisaApplication::with('attachments')->findOrFail($request->id);

//        echo "<pre>";
//        print_r($target->attachments);
//        exit;
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
        $target->village = $request->village;
        $target->post_office = $request->post_office;
        $target->police_station = $request->police_station;
        $target->district = $request->district;
        $target->profession = $request->profession;
        $target->mobile_no = $request->mobile_no;
        $target->visa_no = $request->visa_no;
        $target->id_no = $request->id_no;
        $target->visa_issue_date = $request->visa_issue_date;
        $target->visa_expiry_date = $request->visa_expiry_date;
        $target->okala_date = $request->okala_date;
        $target->medical_date = $request->medical_date;
        $target->medical_card_recieve_date = $request->medical_card_recieve_date;
        $target->medical_expiry_date = $request->medical_expiry_date;
        $target->police_clearence_recieve_date = $request->police_clearence_recieve_date;
        $target->police_clearence_expiry_date = $request->police_clearence_expiry_date;
        $target->police_clearence_expiry_date = $request->police_clearence_expiry_date;
        $target->police_reference_no = $request->police_reference_no;
        $target->mofa_no = $request->mofa_no;
        $target->mofa_date = $request->mofa_date;
        $target->mofa_expiry_date = $request->mofa_expiry_date;
        $target->em_submit_date = $request->em_submit_date;
        $target->stamping_date = $request->stamping_date;
        $target->delivery_date = $request->delivery_date;
        $target->stamping_expiry_date = $request->stamping_expiry_date;
        $target->training_card_recieve_date = $request->training_card_recieve_date;
        $target->finger_date = $request->finger_date;
        $target->man_power_submit_date = $request->man_power_submit_date;
        $target->man_power_expiry_date = $request->man_power_expiry_date;
        $target->rl_no = $request->rl_no;
        $target->document_sending_date = $request->document_sending_date;
        $target->flying_form = $request->flying_form;
        $target->flying_to = $request->flying_to;
        $target->carrier = $request->carrier;
        $target->flying_date = $request->flying_date;
        $target->submit_agency = $request->submit_agency;
        $target->ref_agent = $request->ref_agent;
        $target->other_information = $request->other_information;
        if ($target->save()) {
            $data = [
                'issue_type' => 'visa',
                'issue_id' => $target->id,
                'action' => 'update',
                'user_id' => \Auth::id(),
                'ip_address' => request()->ip(),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            Helper::log($data);
            if (count($request->note) > 0) {
                $notes = Note::where('application_id', $target->id)->where('issue_id', '1')->delete();
                $noteData = [];
                $i = 0;
                foreach ($request->note as $note) {
                    if (!empty($note)) {
                        $noteData[$i]['application_id'] = $target->id;
                        $noteData[$i]['issue_id'] = 1;
                        $noteData[$i]['note'] = $note;
                        $i++;
                    }
                }
                Note::insert($noteData);
            }

            if (!empty($target->attachments->toArray())) {
                $this->uploadImageForUpdate($target, $request);
            } else {
                $this->uploadFile($target->id, $request);
            }

            Session::flash('success', __('lang.VISA_UPDATED_SUCCESSFULLY'));
            return redirect()->route('visaEntry.index');
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
            $realFileArr[$j]['issue_type'] = 1;
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
        $target = VisaApplication::findOrFail($request->id);
        if ($target->delete()) {
            $data = [
                'issue_type' => 'visa',
                'issue_id' => $target->id,
                'action' => 'delete',
                'user_id' => \Auth::id(),
                'ip_address' => request()->ip(),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            Helper::log($data);

            $notes = Note::where('application_id', $request->id)->where('issue_id', '1')->delete();
            Session::flash('success', __('lang.VISA_DELETED_SUCCESSFULLY'));
            return redirect()->route('visaEntry.index');
        }
    }

    public function transactionList(Request $request) {
//       echo "<pre>";print_r($request->all());exit;
        $createdBy = ['' => __('lang.SELECT_CREATED_BY')] + User::join('transactions', 'transactions.created_by', '=', 'users.id')->select(DB::raw("CONCAT(users.name,' (',users.phone,')') as name"), 'users.id as id')->where('transactions.issue_id', 1)->pluck('name', 'id')->toArray();
        $users = ['' => __('lang.SELECT_USER')] + User::join('user_roles', 'user_roles.id', 'users.role_id')->select(DB::raw("CONCAT(users.name,' (',user_roles.role_name,')') as name"), 'users.id as id')->pluck('name', 'id')->toArray();
        $transactionTypeArr = ['' => __('lang.SELECT_TR_TYPE'), 'in' => 'Cash In', 'out' => 'Cash Out'];
        $bankAccountArr = BankAccount::select(DB::raw("CONCAT(bank_name,' => ',account_name,' (',account_no,')') as bank_account"), 'id')->pluck('bank_account', 'id')->toArray();
        $issues = Issue::pluck('issue_title', 'id')->toArray();

        $total_transaction = Transaction::where('application_id', $request->id)->where('issue_id', '1')->sum('amount');
        $total_in = Transaction::where('application_id', $request->id)->where('issue_id', '1')->where('transaction_type', 'in')->sum('amount');
        $total_out = Transaction::where('application_id', $request->id)->where('issue_id', '1')->where('transaction_type', 'out')->sum('amount');
        $total_profit = $total_in - $total_out;

        $targets = Transaction::where('application_id', $request->id)->where('issue_id', '1')->orderBy('id', 'asc');

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

        if (!empty($request->created_by)) {
            $targets = $targets->where('created_by', $request->created_by);
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
        $transactionListOf = 'visa-entry';
        $issue_id = '1';
        $searchFormRoute = 'visaEntry.filter';
        $searchCreatedBy = 'visaEntry.createdBy';
        $applicationDetails = VisaApplication::select('customer_code', 'name', 'passport_no')->where('id', $request->id)->first();

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

        return redirect('admin/visa-entry/' . $request->id . '/transaction-list?' . $url);
    }

    public function VisaFilter(Request $request) {

        $rules = [
            'from_date' => 'required_with:to_date',
            'to_date' => 'required_with:from_date',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        if (isset($request->created_by)) {
            $url = 'filter=true' . '&expiry_date=' . $request->expiry_date . '&created_by=' . $request->created_by . '&search_value=' . $request->search_value . '&from_date=' . $request->from_date . '&to_date=' . $request->to_date;
        } else {
            $url = 'filter=true' . '&expiry_date=' . $request->expiry_date . '&search_value=' . $request->search_value . '&from_date=' . $request->from_date . '&to_date=' . $request->to_date;
        }
        return redirect('admin/visa-entry?' . $url);
    }

    public function combineReport(Request $request) {
        $applicationDetails = VisaApplication::select('customer_code', 'name', 'passport_no')->where('id', $request->id)->first();
        $invoices = Invoice::where('customer_code', $applicationDetails->customer_code)->where('issue_id', '1')->get();
        $transactions = Transaction::where(['issue_id' => '1', 'application_id' => $request->id])->get();
        $users = ['' => __('lang.SELECT_USER')] + User::select(DB::raw("CONCAT(users.name,' (',users.phone,')') as name"), 'users.id as id')->pluck('name', 'id')->toArray();
 

        $application_id = $request->id;
        $transactionListOf = 'visa-entry';
        $issue_id = '1';
        $searchFormRoute = 'visaEntry.filter';
        $searchCreatedBy = 'visaEntry.createdBy';

        $data['title'] = 'Transaction';
        $data['meta_tag'] = 'Transaction page, rafiq & sons';
        $data['meta_description'] = 'Transaction, rafiq & sons';
        return view('backEnd.report.combine_report')->with(compact('invoices', 'transactions','users' ,'data', 'application_id', 'issue_id', 'applicationDetails', 'searchFormRoute', 'transactionListOf', 'searchCreatedBy'));
    }

}
