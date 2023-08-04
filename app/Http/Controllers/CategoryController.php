<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Category $category){
        $org_id=orgId();
        $categories=Category::where('organization_id',$org_id)->latest()->get();
        return view('product.category',compact('category','categories'));
    }

    public function store(Request $request)
    {
        $org_id = orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization.");
        }
        $data = $request->validate([
            'name' => 'required',
        ]);
        $data['organization_id'] = $org_id;
        Category::create($data);

        return redirect()->back()->with('success', "New brand saved.");
    }

    public function edit($id)
    {
        $orgId = orgId();
        if (!$orgId) {
            return redirect()->back()->with('error', "Please select an organization.");
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
        $data = Category::where('id', $id)->where('organization_id', orgId())->first();

        if(!$data){
            return redirect()->back()->with('error', "No data found");
        }
        $data->delete();
        return redirect()->back()->with('success',"Brand removed");
    }
}
