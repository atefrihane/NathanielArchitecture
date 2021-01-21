<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Photo;
use App\Project;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $tags = Tag::all();
        $slides = Photo::orderBy('sort-order-slider')->where('slider', 1)->get();
        $projects = Project::with('tags:tag_id')->orderBy('date', 'desc')->get();
        $section = $request->input('section', 'main');
        $sarchitect = $request->input('sarchitect', 0);
        $slocation = $request->input('slocation', 0);

        return view('pages.index', compact('tags', 'slides', 'projects', 'section', 'sarchitect', 'slocation'));
    }
}
