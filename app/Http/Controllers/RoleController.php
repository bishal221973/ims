<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
        $roles= Role::where('organization_id',orgId())->orderBy('name')->latest()->get();
        return view('role.roleList',compact('roles'));
    }

    public function create(Role $role){
        return view('role.role',compact('role'));
    }

    public function store(Request $request){
        $org_id=orgId();
        if(!$org_id){
            return redirect()->back()->with('error',"Please select an organization");
        }
        $request->validate([
            'role'=>'required'
        ]);

        $role=Role::create([
            'name'=>$request->role,
            'organization_id'=>$org_id,
        ]);

        // $role->syncPermissions($request->premissions);

        return redirect()->back()->with('success',"New role saved");
    }

    public function edit(Role $role){
        return view('role.role',compact('role'));
    }

    public function update(Role $role,Request $request){
        $role=Role::where('id',$role->id)->where('organization_id',orgId())->first();
        $role->update([
            'name'=>$request->role,
        ]);
        $role->syncPermissions($request->premissions);
        return redirect()->route('role.index')->with('success',"Role Updated");
    }

    public function delete(Role $role){
        $role=Role::where('id',$role->id)->where('organization_id',orgId())->first();

        if($role){
            $role->delete();
            return redirect()->back()->with('success',"Selected role removed");
        }
        return redirect()->back()->with('error',"Data not found");
    }
}
