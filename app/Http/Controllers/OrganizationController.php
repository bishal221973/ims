<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Employee;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class OrganizationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'mailVerify']);
    }
    public function index()
    {
        $organizations = Organization::with(['user','branch'])->latest()->get();
        return view('organization.organizationList', compact('organizations'));
    }

    public function create(Organization $organization)
    {
        return view('organization.organization', compact('organization'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'gender' => 'nullable',
            'dob' => 'nullable',
            'address' => 'nullable',
            'phone' => 'nullable',
            'image' => 'nullable',
            'organization_name' => 'required',
            'organization_address' => 'nullable',
            'organization_phone' => 'nullable',
            'organization_email' => 'nullable',
            'vat_number' => 'nullable',
            'logo' => 'nullable',
            'fav_icon' => 'nullable',
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

        $orgData = $request->validate([
            'organization_name' => 'required',
            'organization_address' => 'nullable',
            'organization_phone' => 'nullable',
            'organization_email' => 'nullable',
            'vat_number' => 'nullable',
            'logo' => 'nullable',
            'fav_icon' => 'nullable',
        ]);


        $userData['password'] = Hash::make($request->password);
        if ($request->file('image')) {
            $userData['image'] = $request->file('image')->store();
        }
        if ($request->file('logo')) {
            $orgData['logo'] = $request->file('logo')->store();
        }
        if ($request->file('fav_icon')) {
            $orgData['fav_icon'] = $request->file('fav_icon')->store();
        }
        $user = User::create($userData);
        $orgData['user_id'] = $user->id;

        $org=Organization::create($orgData);
        $user->assignRole("admin");

        $branch=Branch::create([
            'organization_id'=>$org->id,
            'user_id'=>$user->id,
            'branch_name'=>"Main Branch",
            'address'=>$request->organization_address,
        ]);

        Employee::create([
            'user_id'=>$user->id,
            'organization_id'=>$org->id,
            'branch_id'=>$branch->id,
        ]);

        $permissions = Permission::get();

        $user->syncPermissions($permissions);
        return redirect()->back()->with('success', "New Organization Registered successfully.");
    }

    public function edit(Organization $organization)
    {
        $organization = Organization::where('id', $organization->id)->with('user')->first();
        return view('organization.organization', compact(['organization']));
    }

    public function update(Organization $organization, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $organization->user_id,
            'gender' => 'nullable',
            'dob' => 'nullable',
            'address' => 'nullable',
            'phone' => 'nullable',
            'image' => 'nullable',
            'organization_name' => 'required',
            'organization_address' => 'nullable',
            'organization_phone' => 'nullable',
            'organization_email' => 'nullable',
            'vat_number' => 'nullable',
            'logo' => 'nullable',
            'fav_icon' => 'nullable',
        ]);

        $userData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $organization->user_id,
            'gender' => 'nullable',
            'dob' => 'nullable',
            'address' => 'nullable',
            'phone' => 'nullable',
            'image' => 'nullable',
        ]);

        $orgData = $request->validate([
            'organization_name' => 'required',
            'organization_address' => 'nullable',
            'organization_phone' => 'nullable',
            'organization_email' => 'nullable',
            'vat_number' => 'nullable',
            'logo' => 'nullable',
            'fav_icon' => 'nullable',
        ]);


        $userData['password'] = Hash::make($request->password);
        if ($request->file('image')) {
            $userData['image'] = $request->file('image')->store();
        }
        if ($request->file('logo')) {
            $orgData['logo'] = $request->file('logo')->store();
        }
        if ($request->file('fav_icon')) {
            $orgData['fav_icon'] = $request->file('fav_icon')->store();
        }
        // User::create($userData);
        User::where('id', $organization->user_id)->first()->update($userData);
        $organization->update($orgData);

        return redirect()->route('organization.index')->with('success', "Selected Organization Updated.");
    }

    public function delete(Organization $organization)
    {
        $organization->delete();

        return redirect()->back()->with('success', "Selected organization removed.");
    }

    public function active(Organization $organization)
    {
        foreach (Organization::get() as $org) {
            $org->update([
                'status' => 0,
            ]);
        }

        $organization->update([
            'status' => 1
        ]);

        return redirect()->back();
    }
}
