<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'mailVerify']);
    }
    public function index(Product $product){
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $categories=Category::where('organization_id',$org_id)->latest()->get();
        $brands=Brand::where('organization_id',$org_id)->latest()->get();
        $units=Unit::where('organization_id',$org_id)->latest()->get();
        $products=Product::where('organization_id',$org_id)->with(['category','brand','unit'])->latest()->get();
        return view('product.product',compact('product','categories','brands','units','products'));
    }

    public function store(Request $request)
    {
        $org_id = orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $data = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'unit_id' => 'required',
        ]);
        $data['organization_id'] = $org_id;
        Product::create($data);

        return redirect()->back()->with('success', "New product saved.");
    }

    public function edit($id)
    {
        $orgId = orgId();
        if (!$orgId) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $product = Product::where('id', $id)->where('organization_id', $orgId)->first();

        if ($product) {
            $categories=Category::where('organization_id',$orgId)->latest()->get();
            $brands=Brand::where('organization_id',$orgId)->latest()->get();
            $units=Unit::where('organization_id',$orgId)->latest()->get();
            $products=Product::where('organization_id',$orgId)->with(['category','brand','unit'])->latest()->get();
            return view('product.product',compact('product','categories','brands','units','products'));

        }
        return redirect()->back()->with('error', "No data found");
    }

    public function update(Product $product, Request $request)
    {
        $product->update($request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'unit_id' => 'required',
        ]));

        return redirect()->route('product.index')->with('success', "Product update");
    }

    public function delete($id)
    {
        $data = Product::where('id', $id)->where('organization_id', orgId())->first();

        if(!$data){
            return redirect()->back()->with('error', "No data found");
        }
        $data->delete();
        return redirect()->route('product.index')->with('success',"Product removed");
    }
}
