<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Photo;

class PortfolioController extends Controller
{
    public function index()
    {
        $photos = Photo::orderBy('sort-order-portfolio')->where('portfolio', 1)->get();

        return view('admin.portfolio.index', compact('photos'));
    }

    public function sort(Request $request)
    {
        $itemId = $request->input('itemId');
        $itemIndex = $request->input('itemIndex');
        $photos = Photo::all();

        foreach ($photos as $photo) {
            return Photo::where('id', '=', $itemId)->update(['sort-order-portfolio' => $itemIndex]);
        }
    }
}
