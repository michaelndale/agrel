<?php

namespace App\Http\Controllers;

use App\Models\Espece;
use App\Models\site;
use Illuminate\Http\Request;

class CompteanimalController extends Controller
{
    public function index()
    {
        $elementanimal = Espece::select('id', 'libelle')->distinct()->get();
        $site = site::all();
        return view(
            'compteanimal.index',
            [
                'elementanimal' => $elementanimal,
                'site'      => $site
            ]
        );
    }
}
