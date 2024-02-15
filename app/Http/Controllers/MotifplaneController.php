<?php

namespace App\Http\Controllers;

use App\Models\Motifplane;
use Exception;
use Illuminate\Http\Request;

class MotifplaneController extends Controller
{
    public function index()
    {
        $motifData = Motifplane::all();
        return view(
        'motifplante.index',
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
        $check = Motifplane::where('libelle',$title)->first();
        if($check)
        {
            return back()->with('failed', 'Le motif plante du motif exite');
        }else{
            $motif = new Motifplane();
            $motif->libelle= $request->libelle;
            $motif->save();
                if ($motif) {
                    return back()->with('success', 'Très bien! motif palnte bien enregistrer');
                }
                else {
                    return back()->with('failed', 'Echec ! motif plante n\'est pas creer ');
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
          $go=Motifplane::destroy($id);
        if ($go) {
            return back()->with('success', 'Très bien! motif plante supprimer');
        }
        else {
            return back()->with('failed', 'Echec ! motif plane n\'est pas supprimer ');
        }
        }
          catch (Exception $e) {
            return back()->with('error', 'Erreur de connection');
        }
    }
}
