<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Project;
use App\Tag;
use App\Photo;
use App\Http\Requests\Project\ProjectRequest;
use Illuminate\Support\Carbon;
use App\Http\Requests\Project\ProjectUpdateRequest;
use Symfony\Component\HttpFoundation\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['photos', 'tags'])->get();

        return view('admin.projects.index', compact('projects'));
    }

    public function create(Project $project)
    {
        if (!$project->exists) {
            $project = $this->createAndReturnSkeletonProject();

            return redirect()->route('admin.projects.create', $project);
        }

        $tags = Tag::all();

        return view('admin.projects.create', [
            'project' => $project,
            'tags' => $tags
        ]);
    }

    public function store(Project $project, ProjectRequest $request)
    {
        $date = Carbon::createFromFormat('d-m-Y', $request->input('date'));

        $thumb = $request->file('thumb');
        $filename = $project->id . '.' . $thumb->getClientOriginalExtension();
        $thumb->storeAs(
            'public/thumbs',
            $filename
        );

        $project->fill([
            'name' => $request->input('name'),
            'architect' => $request->input('architect'),
            'location' => $request->input('location'),
            'date' => $date
        ]);

        $project->save();

        $project->tags()->sync($request->input('tags'), false);

        return redirect()->route('admin.projects.index')->withSuccess('Project added successfully!');
    }

    public function edit(Project $project)
    {
        $tags = Tag::all();

        return view('admin.projects.edit', compact('project', 'tags'));
    }

    public function update(ProjectUpdateRequest $request, Project $project)
    {
        $date = Carbon::createFromFormat('d-m-Y', $request->input('date'));

        $thumb = $request->file('thumb');
        $filename = $project->id . '.' . $thumb->getClientOriginalExtension();
        $thumb->storeAs(
            'public/thumbs',
            $filename
        );

        $project->update([
            'name' => $request->input('name'),
            'architect' => $request->input('architect'),
            'location' => $request->input('location'),
            'date' => $date
        ]);

        $project->tags()->detach();

        $project->tags()->sync($request->input('tags'), false);

        return redirect()->route('admin.projects.index')->withSuccess('Project updated successfully!');
    }

    public function sort(Request $request, Project $project)
    {
        $itemId = $request->input('itemId');
        $itemIndex = $request->input('itemIndex');

        foreach ($project->photos as $photo) {
            return Photo::where('id', '=', $itemId)->update(['sort-order-project' => $itemIndex]);
        }
    }

    public function destroy(Project $project)
    {
        $project->tags()->detach();

        $project->delete();

        return redirect()->route('admin.projects.index');
    }

    protected function createAndReturnSkeletonProject()
    {
        return Project::create([
            'name' => 'Awesome Project',
            'architect' => 'John Doe',
            'location' => 'Neverland',
            'date' => today()
        ]);
    }
}
