<?php

use App\Models\Organization;
use Illuminate\Support\Facades\Session;

function orgId()
{
    // return Auth()->user()->roles[0]->name;
    if(Auth()->user()){
        $userRole="";
        foreach (Auth()->user()->roles as $role) {
            if ($role->name == "super-admin") {
                $userRole="super-admin";
            } else if($role->name == "admin"){
                 $userRole="admin";
                break;
            }
        }

        if($userRole=="super-admin"){
            $organization = Organization::select('id')->where('status', "1")->first();
            if ($organization) {
                // return "hello";
                return $organization->id;
            }
            else{
                return "0";
            }
        }else if(Auth()->user()->roles[0]->name=="admin"){
            return Auth()->user()->organization->id;
        }else if(Auth()->user()->roles[0]->name=="branch-admin"){
            return Auth()->user()->branch->organization->id;
        }
    }

    // return Session::get('org_id');
}
