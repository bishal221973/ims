<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class BranchController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'mailVerify']);
    }
    public function index()
    {

        $org_id = orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $branchs = Branch::where('organization_id', $org_id)->with('user', 'organization')->latest()->get();
        return view('organization.branchList', compact(['branchs']));
    }

    public function create(Branch $branch)
    {
        $org_id = orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        return view('organization.branch', compact('branch'));
    }

    public function store(Request $request)
    {
        $org_id = orgId();
        if ($org_id == 0) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'gender' => 'nullable',
            'dob' => 'nullable',
            'address' => 'nullable',
            'phone' => 'nullable',
            'image' => 'nullable',
            'branch_name' => 'required',
            'branch_phone' => 'nullable',
            'branch_email' => 'nullable',

        ]);

        $userData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'gender' => 'nullable',
            'dob' => 'nullable',
            'address' => 'nullable',
            'phone' => 'nullable',
            'image' => 'nullable',
        ]);

        $branchData = $request->validate([
            'branch_name' => 'required',
            'branch_phone' => 'nullable',
            'branch_email' => 'nullable',
            'address' => 'nullable',
        ]);
        $branchData['organization_id'] = $org_id;


        $userData['password'] = Hash::make($request->password);
        if ($request->file('image')) {
            $userData['image'] = $request->file('image')->store();
        }
        $user = User::create($userData);
        $branchData['user_id'] = $user->id;

        $branch = Branch::create($branchData);

        $user->assignRole("branch-admin");

        Employee::create([
            'user_id' => $user->id,
            'organization_id' => $org_id,
            'branch_id' => $branch->id,
        ]);

        $permissions = Permission::get();

        $user->syncPermissions($permissions);

        return redirect()->back()->with('success', "New branch saved.");
    }

    public function edit($id)
    {
        $org_id = orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $branch = Branch::where('id', $id)->where('organization_id', $org_id)->first();
        return view('organization.branch', compact('branch'));
    }

    public function update(Branch $branch, Request $request)
    {
        $org_id = orgId();
        if ($org_id == 0) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $branch->user_id,
            'gender' => 'nullable',
            'dob' => 'nullable',
            'address' => 'nullable',
            'phone' => 'nullable',
            'image' => 'nullable',
            'branch_name' => 'required',
            'branch_phone' => 'nullable',
            'branch_email' => 'nullable',

        ]);

        $userData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $branch->user_id,
            'gender' => 'nullable',
            'dob' => 'nullable',
            'address' => 'nullable',
            'phone' => 'nullable',
            'image' => 'nullable',
        ]);

        $branchData = $request->validate([
            'branch_name' => 'required',
            'branch_phone' => 'nullable',
            'branch_email' => 'nullable',
            'address' => 'nullable',
        ]);

        if ($request->file('image')) {
            $userData['image'] = $request->file('image')->store();
        }
        User::where('id', $branch->user_id)->first()->update($userData);

        $branch->update($branchData);

        return redirect()->route('branch.index')->with('success', "Branch update.");
    }
}
