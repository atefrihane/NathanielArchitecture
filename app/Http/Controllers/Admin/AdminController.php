<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Project;
use App\Photo;
use App\Tag;

class AdminController extends Controller
{
    public function index()
    {
        $projects = Project::count();
        $photos = Photo::count();
        $tags = Tag::count();

        return view('admin.dashboard.index', compact('projects', 'photos', 'tags'));
    }
}
