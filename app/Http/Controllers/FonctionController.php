<?php

namespace App\Http\Controllers;

use App\Models\Fonction;
use Exception;
use Illuminate\Http\Request;

class FonctionController extends Controller
{
    public function index()
    {
        $fonctionData = Fonction::all();
        return view(
        'fonction.index',
        [
            'fonctionData'=> $fonctionData
        ]
        );
    }

    public function store(Request $request)
    {
      try 
    {
        $title = $request->libelle;
        $check = fonction::where('libelle',$title)->first();
        if($check)
        {
            return back()->with('failed', 'Le libellé du site exite');
        }else{
            $site = new Fonction();
            $site->libelle= $request->libelle;
            $site->save();
                if ($site) {
                    return back()->with('success', 'Très bien! la fonction bien enregistrer');
                }
                else {
                    return back()->with('failed', 'Echec ! la fonction n\'est pas creer ');
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
          $go=Fonction::destroy($id);
        if ($go) {
            return back()->with('success', 'Très bien! la fonction supprimer');
        }
        else {
            return back()->with('failed', 'Echec ! la fonction n\'est pas supprimer ');
        }
        }
          catch (Exception $e) {
            return back()->with('error', 'Erreur de connection');
        }
    }
}
