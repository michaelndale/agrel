<?php

namespace App\Http\Controllers;

use App\Models\Motifstock;
use App\Models\site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index()
    {
        $elementstock = Motifstock::select('id', 'libelle', 'unitemesure')->distinct()->get();
        $site = site::all();
        return view(
            'stock.index',
            [
                'elementstock' => $elementstock,
                'site'      => $site
            ]
        );
    }
}
