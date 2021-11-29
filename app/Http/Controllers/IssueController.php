<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;


class IssueController extends Controller {

    public function index(Request $request) {
        $targets = Issue::orderBy('id', 'desc');
       
       
        if (!empty($request->search_value)) {
            $searchText = $request->search_value;
            $targets->where(function ($query) use ($searchText) {
                $query->where('issue_title', 'like', "%{$searchText}%");
            });
        }
        
        $targets    =   $targets->paginate(5);
        
        $data['title'] = 'Issue List';
        $data['meta_tag'] = 'Issue page, rafiq & sons';
        $data['meta_description'] = 'Issue, rafiq & sons';
        return view('backEnd.head.index')->with(compact('targets','data'));
//        echo "<pre>";print_r($target->toArray());exit;
    }

    public function create(Request $request) {
        $view = view('backEnd.head.createIssue')->render();
        return response()->json(['data' => $view]);
    }

    public function store(Request $request) {
        $rules = [
            'issue_title' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        
        $target = new Issue;
        $target->issue_title = $request->issue_title;
        if($target->save()){
           return response()->json(['response'=>'success']); 
        }
    }
    
    public function edit(Request $request){
        $target = Issue::findOrFail($request->id);
        $view = view('backEnd.head.editIssue')->with(compact('target'))->render();
        return response()->json(['data' => $view]);
    }
    
    public function update(Request $request){
//        echo "<pre>";print_r($request->all());exit;
        $rules = [
            'issue_title' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        
        $target = Issue::findOrFail($request->id);
        $target->issue_title = $request->issue_title;
        if($target->save()){
           return response()->json(['response'=>'success']); 
        }
        
    }


    public function destroy(Request $request){
        $target = Issue::findOrFail($request->id);
        if($target->delete()){
            Session::flash('success',__('lang.ISSUE_DELETED_SUCCESSFULLY'));
//            return redirect()->route('head.index', ['page' => $request->get('page', 1)]);
            return redirect()->route('head.index');
        }
        
    }
    
     public function filter(Request $request) {
        $url = 'transaction_type=' . $request->transaction_type . '&search_value=' . $request->search_value;
        return redirect('admin/head-list?' . $url);
    }

}
