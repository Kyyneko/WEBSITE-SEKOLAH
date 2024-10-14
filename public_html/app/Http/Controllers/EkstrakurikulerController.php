<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Organisasi;

class EkstrakurikulerController extends Controller
{
    public function show($slug)
    {
        $ekstrakurikuler = Organisasi::where('slug', $slug)->firstOrFail();
        return view('frontend.ekstrakurikuler.show', compact('ekstrakurikuler'));
    }
}
