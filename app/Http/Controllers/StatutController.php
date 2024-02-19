<?php

namespace App\Http\Controllers;

use App\Models\Statut;
use Exception;
use Illuminate\Http\Request;

class StatutController extends Controller
{
   
    public function index()
    {
        $fonctionData = Statut::all();
        return view(
        'statut.index',
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
        $check = Statut::where('libelle',$title)->first();
        if($check)
        {
            return back()->with('failed', 'Le statut du site exite');
        }else{
            $site = new Statut();
            $site->libelle= $request->libelle;
            $site->save();
                if ($site) {
                    return back()->with('success', 'Très bien! la statut bien enregistrer');
                }
                else {
                    return back()->with('failed', 'Echec ! la statut n\'est pas creer ');
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
          $go=Statut::destroy($id);
        if ($go) {
            return back()->with('success', 'Très bien! la statut supprimer');
        }
        else {
            return back()->with('failed', 'Echec ! la statut n\'est pas supprimer ');
        }
        }
          catch (Exception $e) {
            return back()->with('error', 'Erreur de connection');
        }
    }
}
