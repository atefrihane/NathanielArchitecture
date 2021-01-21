<?php

namespace App\Http\Controllers;

use App\Photo;

class PortfolioController extends Controller
{
    public function index()
    {
        $photos = Photo::orderBy('sort-order-portfolio')->where('portfolio', 1)->with('project')->get();

        $nphotos = count($photos);

        return view('portfolio.index', compact('photos', 'nphotos'));
    }
}
