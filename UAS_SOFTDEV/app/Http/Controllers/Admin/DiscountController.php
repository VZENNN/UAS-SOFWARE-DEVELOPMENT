<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiscountController extends Controller
{
    public function index(){

        $data = [
            'title' => 'Diskon',
            'discounts' => Discount::latest()->get()
        ];

        return view('admin.discount.index', $data);
    }
    
    public function create(){

        $data = [
            'title' => 'Create Discount'
        ];

        return view('admin.discount.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:discounts',
            'discount' => 'required|integer|min:1',
            'qty' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Discount::create([
            'code' => $request->code,
            'discount' => $request->discount,
            'qty' => $request->qty,
        ]);

        return redirect()->route('admin.discount.index')
            ->with('success', 'Discount created successfully.');
    }
    
    public function edit($id){
        $discountData = Discount::where('id', $id)->first();

        $data = [
            'discount' => $discountData,
            'title' => 'Edit Discount '. $discountData->code
        ];

        
        return view('admin.discount.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $discount = Discount::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:discounts,code,' . $id,
            'discount' => 'required|integer|min:1',
            'qty' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $discount->update([
            'code' => $request->code,
            'discount' => $request->discount,
            'qty' => $request->qty,
        ]);

        return redirect()->route('admin.discount.index')
            ->with('success', 'Discount updated successfully.');
    }

    public function destroy($id)
    {
        $discount = Discount::findOrFail($id);
        $discount->delete();

        return redirect()->route('admin.discount.index')
            ->with('success', 'Discount deleted successfully.');
    }
}