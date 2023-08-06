<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Project $project)
    {
        $projects = Project::where('organization_id', orgId())->with('branch')->latest()->get();
        $branches = Branch::where('organization_id', orgId())->latest()->get();
        return view('project.project', compact('project', 'projects', 'branches'));
    }

    public function store(Request $request)
    {
        $org_id = orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization.");
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
        $orgId = orgId();
        if (!$orgId) {
            return redirect()->back()->with('error', "Please select an organization.");
        }
        $project = Project::where('id', $project->id)->where('organization_id', $orgId)->first();

        if ($project) {
            $projects = Project::where('organization_id', orgId())->with('branch')->latest()->get();
            $branches = Branch::where('organization_id', orgId())->latest()->get();
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
        $data = Project::where('id', $id)->where('organization_id', orgId())->first();

        if(!$data){
            return redirect()->back()->with('error', "No data found");
        }
        $data->delete();
        return redirect()->route('project.index')->with('success',"project removed");
    }
}
