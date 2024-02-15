<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use App\Models\site;
use Exception;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    public function index()
    {
        $personnelData = Personnel::all();
        $site = site::all();
        return view(
        'personnel.index',
        [
            'userData' => $personnelData,
            'site' => $site
        ]
        );
    }

    public function store(Request $request)
    {
      try 
    {
        $phone = $request->phone;
        $check = Personnel::where('phone',$phone)->first();
        if($check)
        {
            return back()->with('failed', 'Le personnel existe ');
        }else{
            $user = new Personnel();

            $user->nom= $request->nom;
            $user->prenom= $request->prenom;
            $user->phone   = $request->phone;
            $user->siteid  = $request->site;
            $user->userid  =  Auth()->user()->id;
            $user->save();

                if ($user) {
                    return back()->with('success', 'Très bien! Personnel bien enregistrer');
                }
                else {
                    return back()->with('failed', 'Echec ! Personnel n\'est pas creer ');
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
          $go=Personnel::destroy($id);
        if ($go) {
            return back()->with('success', 'Très bien! la supprimer supprimer');
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
