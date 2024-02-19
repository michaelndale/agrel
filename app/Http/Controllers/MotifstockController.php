<?php

namespace App\Http\Controllers;

use App\Models\Motifstock;
use Exception;
use Illuminate\Http\Request;

class MotifstockController extends Controller
{
    public function index()
    {
        $motifData = Motifstock::all();
        return view(
        'motifstock.index',
        [
            'motifData'=> $motifData
        ]
        );
    }

    public function store(Request $request)
    {
      try 
    {
        $title = $request->libelle;
        $check = Motifstock::where('libelle',$title)->first();
        if($check)
        {
            return back()->with('failed', 'Le motif stock du motif exite');
        }else{
            $motif = new Motifstock();
            $motif->libelle= $request->libelle;
            $motif->unitemesure= $request->unite;
            $motif->save();
                if ($motif) {
                    return back()->with('success', 'Très bien! motif stock bien enregistrer');
                }
                else {
                    return back()->with('failed', 'Echec ! motif stock n\'est pas creer ');
                }
            }
        }
        catch (Exception $e) {
            return back()->with('error', 'Erreur de connection');
        }
        }

        public function delete(Request $request)
        {
        try 
        {   
          $id = $request->id;
          $go=Motifstock::destroy($id);
        if ($go) {
            return back()->with('success', 'Très bien! motif stock supprimer');
        }
        else {
            return back()->with('failed', 'Echec ! motif stock n\'est pas supprimer ');
        }
        }
          catch (Exception $e) {
            return back()->with('error', 'Erreur de connection');
        }
    }
}
