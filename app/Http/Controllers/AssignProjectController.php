<?php

namespace App\Http\Controllers;

use App\Models\AssignEmployee;
use App\Models\AssignProject;
use App\Models\Employee;
use App\Models\Project;
use Illuminate\Http\Request;

class AssignProjectController extends Controller
{
    public function index(AssignProject $assignProject)
    {
        $org_id = orgId();
        $org_id = orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $projects = Project::where('organization_id', $org_id)->latest()->get();
        $employees = Employee::where('organization_id', $org_id)->latest()->get();
        $assignProjects = AssignProject::where('organization_id', $org_id)->with('project', 'employee.employee.user')->latest()->get();
        return view('project.assign', compact(['assignProject', 'assignProjects', 'projects', 'employees']));
    }

    public function store(Request $request)
    {
        $org_id = orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $assign = AssignProject::where('organization_id', $org_id)->where('project_id', $request->project_id)->with('employee')->first();

        if (!$assign) {
            if ($request->employee_id) {

                $assign = AssignProject::create([
                    'project_id' => $request->project_id,
                    'organization_id' => $org_id,
                ]);

                foreach ($request->employee_id as $key => $item) {
                    AssignEmployee::create([
                        'assing_project_id' => $assign->id,
                        'employee_id' => $request->employee_id[$key],
                        'organization_id' => $org_id,
                    ]);
                }
                return redirect()->back()->with('success', "11Project assigned.");
            }
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        return redirect()->back()->with('error', "Project already assigned.");
        // return redirect()->back()->with('error', "Project assigned.");
    }
}
