<?php

namespace App\Http\Controllers;

use App\Models\fournisseur;
use Exception;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    public function index()
    {
        $fournisseurData = Fournisseur::all();
        return view(
        'fournisseur.index',
        [
            'userData' => $fournisseurData,
        ]
        );
    }

    public function store(Request $request)
    {
      try 
    {
        $phone = $request->phone;
        $check = Fournisseur::where('phone',$phone)->first();
        if($check)
        {
            return back()->with('failed', 'Le Fournisseur existe ');
        }else{
            $user = new Fournisseur();

            $user->nom= $request->nom;
            $user->adresse= $request->adresse;
            $user->phone   = $request->phone;
            $user->userid  =  Auth()->user()->id;
            $user->save();

                if ($user) {
                    return back()->with('success', 'Très bien! Fournisseur bien enregistrer');
                }
                else {
                    return back()->with('failed', 'Echec ! Fournisseur n\'est pas creer ');
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
          $go=fournisseur::destroy($id);
        if ($go) {
            return back()->with('success', 'Très bien! la supprimer supprimer');
        }
        else {
            return back()->with('failed', 'Echec ! Fournisseur n\'est pas supprimer ');
        }
        }
          catch (Exception $e) {
            return back()->with('error', 'Erreur de connection');
        }
    }
}
