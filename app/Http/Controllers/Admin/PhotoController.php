<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\Photo;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Photo\PhotoRequest;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::with('project:id,name,identifier')->get();

        return view('admin.photos.index', compact('photos'));
    }

    public function store(Project $project, Request $request)
    {
        $uploadedPhoto = $request->file('file');

        $photo = $this->storePhoto($project, $uploadedPhoto);

        Storage::disk('public')->putFileAs(
            'photos/' . $project->identifier,
            $uploadedPhoto,
            $photo->filename
        );

        return response()->json([
            'id' => $photo->id
        ]);
    }

    public function edit(Photo $photo)
    {
        return view('admin.photos.edit', compact('photo'));
    }

    public function update(PhotoRequest $request, Photo $photo)
    {
        $photo->update([
            'slider' => $request->has('slider'),
            'portfolio' => $request->has('portfolio')
        ]);

        return back()->withSuccess('Photo settings changed successfully!');
    }

    public function destroy(Project $project, Photo $photo)
    {
        $photo->delete();

        return redirect()->back();
    }

    protected function storePhoto(Project $project, UploadedFile $uploadedPhoto)
    {
        $photo = new Photo;

        $photo->fill([
            'filename' => $this->generateFilename($uploadedPhoto)
        ]);

        $photo->project()->associate($project);

        $photo->save();

        return $photo;
    }

    protected function generateFilename(UploadedFile $uploadedPhoto)
    {
        return $uploadedPhoto->getClientOriginalName();
    }
}
