<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Espece;
use App\Models\site;
use Exception;
use Illuminate\Http\Request;

class BoxController extends Controller
{
    public function index()
    {
        $boxData = Box::all();
        $siteData = site::all();
        $spece = Espece::all();
        return view(
        'box.index',
        [
            'boxData'=> $boxData,
            'siteData'=> $siteData,
            'spece' => $spece
        ]
        );
    }

    public function store(Request $request)
    {
      try 
    {
        $title = $request->libelle;
        $check = Box::where('title',$title)->first();
        if($check)
        {
            return back()->with('failed', 'Le libelle du box exite');
        }else{
            $box = new Box();
            $box->title= $request->libelle;
            $box->blocid= $request->blocid;
            $box->siteid= $request->batiment;
            $box->animalid= $request->spece;

            $box->save();

                if ($box) {
                    return back()->with('success', 'Très bien! box bien enregistrer');
                }
                else {
                    return back()->with('failed', 'Echec ! box n\'est pas creer ');
                }
            }
        }
        catch (Exception $e) {
            return back()->with('error', 'Erreur d\'insertion');
        }
        }

}
