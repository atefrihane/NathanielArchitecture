<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;
use App\Http\Requests\Tag\TagRequest;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::withCount('projects')->get();

        return view('admin.tags.index', compact('tags'));
    }

    public function store(TagRequest $request)
    {
        Tag::create(
            request(['name'])
        );

        return back()->withSuccess('Tag added successfully!');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('admin.tags.index');
    }
}
