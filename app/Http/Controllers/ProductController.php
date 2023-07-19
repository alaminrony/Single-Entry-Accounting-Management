<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class ProductController extends Controller {

    public function index(Request $request) {

        $targets = Product::orderBy('id', 'desc');

        if (!empty($request->search_value)) {
            $searchText = $request->search_value;
            $targets->where(function ($query) use ($searchText) {
                $query->where('name', 'like', "%{$searchText}%");
                $query->orWhere('price', 'like', "%{$searchText}%");
            });
        }
        $targets = $targets->paginate(5);

        $data['title'] = 'Product List';
        $data['meta_tag'] = 'Product page, rafiq & sons';
        $data['meta_description'] = 'Product, rafiq & sons';
        return view('backEnd.product.index')->with(compact('targets', 'data'));
    }

    public function create(Request $request) {
        $view = view('backEnd.product.createProduct')->render();
        return response()->json(['data' => $view]);
    }

    public function store(Request $request) {
        $rules = [
            'name' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $target = new Product;
        $target->name = $request->name;
        $target->price = $request->price;
        $target->status = $request->status;
        if ($target->save()) {
            return response()->json(['response' => 'success', 'id' => $target->id, 'name' => $target->name]);
        }
    }

    public function edit(Request $request) {
        $target = Product::findOrFail($request->id);
        $view = view('backEnd.product.editProduct')->with(compact('target'))->render();
        return response()->json(['data' => $view]);
    }

    public function update(Request $request) {
//        echo "<pre>";print_r($request->all());exit;
        $rules = [
            'name' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $target = Product::findOrFail($request->id);
        $target->name = $request->name;
        $target->price = $request->price;
        $target->status = $request->status;
        if ($target->save()) {
            return response()->json(['response' => 'success']);
        }
    }

    public function destroy(Request $request) {
        $target = Product::findOrFail($request->id);
        if ($target->delete()) {
            Session::flash('success', __('lang.PRODUCT_DELETED_SUCCESSFULLY'));
//            return redirect()->route('product.index', ['page' => $request->get('page', 1)]);
            return redirect()->route('product.index');
        }
    }

    public function filter(Request $request) {
        $url = 'transaction_type=' . $request->transaction_type . '&search_value=' . $request->search_value;
        return redirect('admin/product-list?' . $url);
    }

}
