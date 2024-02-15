<?php

namespace App\Http\Controllers;

use App\Models\Espece;
use Exception;
use Illuminate\Http\Request;

class EspeceController extends Controller
{
    public function index()
    {
        $EspeceData = Espece::all();
        return view(
        'espece.index',
        [
            'EspeceData'=> $EspeceData
        ]
        );
    }

    public function store(Request $request)
    {
      try 
    {
        $title = $request->libelle;
        $check = Espece::where('libelle',$title)->first();
        if($check)
        {
            return back()->with('failed', 'Le libellé du espece exite');
        }else{
            $espece = new Espece();
            $espece->libelle= $request->libelle;
            $espece->save();
                if ($espece) {
                    return back()->with('success', 'Très bien! l\'espece bien enregistrer');
                }
                else {
                    return back()->with('failed', 'Echec ! l\'espece n\'est pas creer ');
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
          $go=Espece::destroy($id);
        if ($go) {
            return back()->with('success', 'Très bien! l\'espece supprimer');
        }
        else {
            return back()->with('failed', 'Echec ! l\'espece n\'est pas supprimer ');
        }
        }
          catch (Exception $e) {
            return back()->with('error', 'Erreur de connection');
        }
    }
}
