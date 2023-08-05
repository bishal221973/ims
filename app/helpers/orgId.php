<?php

use App\Models\Organization;
use Illuminate\Support\Facades\Session;

function orgId()
{
    if(Auth()->user()){
        $roleSuperAdmin=false;
        foreach (Auth()->user()->roles as $role) {
            if ($role->name != "super-admin") {
                $roleSuperAdmin=false;
             } else {
                $roleSuperAdmin=true;
                break;

            }
        }

        if($roleSuperAdmin){
            $organization = Organization::select('id')->where('status', "1")->first();
            if ($organization) {
                // return "hello";
                return $organization->id;
            }
            else{
                return "0";
            }
        }else{
            return Auth()->user()->organization->id;
        }
    }

    // return Session::get('org_id');
}
