<?php

namespace App\Http\Controllers;

use App\Models\site;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $siteData = site::all();
        return view(
        'home.index',
        [
            'siteData'=> $siteData
        ]
        );
    }
}
