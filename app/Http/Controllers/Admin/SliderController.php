<?php

namespace App\Http\Controllers\Admin;

use App\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    public function index()
    {
        $photos = Photo::orderBy('sort-order-slider')->where('slider', 1)->get();

        return view('admin.slider.index', compact('photos'));
    }

    public function sort(Request $request)
    {
        $itemId = $request->input('itemId');
        $itemIndex = $request->input('itemIndex');
        $photos = Photo::all();

        foreach ($photos as $photo) {
            return Photo::where('id', '=', $itemId)->update(['sort-order-slider' => $itemIndex]);
        }
    }
}
