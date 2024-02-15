<?php

namespace App\Http\Controllers;

use App\Models\Motifdepense;
use Exception;
use Illuminate\Http\Request;

class MotifdepenseController extends Controller
{
    public function index()
    {
        $motifData = Motifdepense::all();
        return view(
        'motifdepense.index',
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
        $check = motifdepense::where('libelle',$title)->first();
        if($check)
        {
            return back()->with('failed', 'Le motif depense du motif exite');
        }else{
            $motif = new Motifdepense();
            $motif->libelle= $request->libelle;
            $motif->save();
                if ($motif) {
                    return back()->with('success', 'Très bien! motif depense bien enregistrer');
                }
                else {
                    return back()->with('failed', 'Echec ! motif depense n\'est pas creer ');
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
          $go=motifdepense::destroy($id);
        if ($go) {
            return back()->with('success', 'Très bien! depense supprimer');
        }
        else {
            return back()->with('failed', 'Echec ! motif depense n\'est pas supprimer ');
        }
        }
          catch (Exception $e) {
            return back()->with('error', 'Erreur de connection');
        }
    }
}
