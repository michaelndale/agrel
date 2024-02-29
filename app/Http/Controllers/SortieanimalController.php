<?php

namespace App\Http\Controllers;

use App\Models\Compteanimal;
use App\Models\Espece;
use App\Models\site;
use App\Models\Sortieanimal;
use App\Models\Statut;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SortieanimalController extends Controller
{
    
    public function index()
    {
        $sortieanimal=DB::table('sortieanimals')
        ->join('especes', 'sortieanimals.animalid', '=', 'especes.id')
        ->select('sortieanimals.*', 'especes.libelle')         
        ->orderBy('id', 'DESC')
        ->get();

        $site= site::orderBy('libelle', 'ASC')->get();
        $espece = Espece::orderBy('libelle', 'ASC')->get();
        $statut = Statut::orderBy('libelle', 'ASC')->get();
     

        return view(
            'sortieanimal.index',
            [
                'site'         => $site,
                'espece'       => $espece,
                'statut'       => $statut,
                'sortieanimal'  => $sortieanimal
            ]
        );
    }

    public function store(Request $request)
    {
        try {
           
            $stock = new Sortieanimal();

            $total=$request->quantite*$request->prixunite;

            $stock->site= $request->batiment;
            $stock->blocid= $request->blocid;
            $stock->animalid= $request->espece;
            $stock->boxid= $request->boxid;
            $stock->numero = $request->nom;
            $stock->statut = $request->statut;
            $stock->sexe = $request->sexe;
            $stock->date = $request->date;
            $stock->client = $request->client;
            $stock->quantite = $request->quantite;
            $stock->prixunite = $request->prixunite;
            $stock->total =$total;
            $stock->note= $request->note;

            $stock->save();

            if ($stock) {


                $stor = DB::table('compteanimals')
                        ->where('site',$request->batiment)
                        ->where('motifa',$request->espece)
                        ->first();
                
                if($stor){

                $stor = $stor->quantite;

                $newquantite = $stor-$request->quantite;

                $updateStor = [
                    'quantite'=> $newquantite
                ];

                Compteanimal::where('site',$request->batiment)
                            ->where('motifa',$request->espece)
                            ->update($updateStor);

                    
                    if($updateStor){
                        return back()->with('success', 'Très bien! La sortie animal bien enregistrer');

                    }else{
                        return back()->with('failed', 'Echec ! La sortie animal n\'est pas creer ');
                    }

                }else
                {
                    return back()->with('failed', 'Echec ! Pas de l\'animal disponible dans cette compartiment');
                    
                }


            } else {
                return back()->with('failed', 'Echec ! La sortie animal n\'est pas creer ');
            }
       
        } catch (Exception $e) {
            return back()->with('failed', 'Erreur connexion data');
        }
    }


     // supresseion
     public function delete($id)
     {
       $post = Sortieanimal::find($id);
       $post->delete();
       return back()->with('success', 'Supprimer avec succès');
     }
}
