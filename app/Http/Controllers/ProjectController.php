<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'mailVerify']);
    }
    public function index(Project $project)
    {
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $projects = Project::where('organization_id', $org_id)->with('branch')->latest()->get();
        $branches = Branch::where('organization_id', $org_id)->latest()->get();
        return view('project.project', compact('project', 'projects', 'branches'));
    }

    public function store(Request $request)
    {
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }

        $data = $request->validate([
            'name' => 'required',
            'branch_id' => 'required',
            'start_date' => 'required',
            'location' => 'nullable',
            'status' => 'required',
        ]);

        $data['organization_id'] = $org_id;

        Project::create($data);

        return redirect()->back()->with('success', "New project saved.");
    }

    public function edit(Project $project)
    {
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $project = Project::where('id', $project->id)->where('organization_id', $$org_id)->first();

        if ($project) {
            $projects = Project::where('organization_id', $org_id)->with('branch')->latest()->get();
            $branches = Branch::where('organization_id', $org_id)->latest()->get();
            return view('project.project', compact('project', 'projects', 'branches'));
        }
        return redirect()->back()->with('error', "No data found");
    }

    public function update(Project $project, Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'branch_id' => 'required',
            'start_date' => 'required',
            'location' => 'nullable',
            'status' => 'required',
        ]);

        $project->update($data);

        return redirect()->route('project.index')->with('success',"Selected project updated");
    }


    public function delete($id)
    {
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $data = Project::where('id', $id)->where('organization_id', $org_id)->first();

        if(!$data){
            return redirect()->back()->with('error', "No data found");
        }
        $data->delete();
        return redirect()->route('project.index')->with('success',"project removed");
    }
}
