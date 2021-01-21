<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class PdfController extends Controller
{
    public function create(Request $request)
    {
        $selection = array_map('intval', explode('-', $request->input('photos', '')));

        $photos = Photo::whereIn('id', $selection)->get();

        $pdf = Pdf::loadView('pdf.album', compact('photos'));

        return $pdf->stream('Nathaniel-McMahon-Photo-Album.pdf');
    }
}
