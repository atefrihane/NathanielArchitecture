<?php

namespace App\Http\Controllers;

use App\Project;

class ProjectController extends Controller
{
    public function show(Project $project)
    {
        $nphotos = count($project->photos);

        $photos = $project->photos;

        return view('projects.show', compact('project', 'nphotos', 'photos'));
    }
}
