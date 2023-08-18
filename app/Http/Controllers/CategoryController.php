<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Category $category){
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $categories=Category::where('organization_id',$org_id)->latest()->get();
        return view('product.category',compact('category','categories'));
    }

    public function store(Request $request)
    {
        $org_id = orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $data = $request->validate([
            'name' => 'required',
        ]);
        $data['organization_id'] = $org_id;
        Category::create($data);

        return redirect()->back()->with('success', "New category saved.");
    }

    public function edit($id)
    {
        $orgId = orgId();
        if (!$orgId) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $category = Category::where('id', $id)->where('organization_id', $orgId)->first();

        if ($category) {
            $categories = Category::where('organization_id', $orgId)->latest()->get();
            return view('product.category',compact('category','categories'));

        }
        return redirect()->back()->with('error', "No data found");
    }

    public function update(Category $category, Request $request)
    {
        $category->update($request->validate([
            'name' => 'required',
        ]));

        return redirect()->route('category.index')->with('success', "Category update");
    }

    public function delete($id)
    {
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $data = Category::where('id', $id)->where('organization_id', $org_id)->first();

        if(!$data){
            return redirect()->back()->with('error', "No data found");
        }
        $data->delete();
        return redirect()->back()->with('success',"Category removed");
    }
}
