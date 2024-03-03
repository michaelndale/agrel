<?php

namespace App\Http\Controllers;

use App\Models\Compteanimal;
use App\Models\Entreranimal;
use App\Models\Espece;
use App\Models\fournisseur;
use App\Models\site;
use App\Models\Statut;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntreranimalController extends Controller
{
     public function index()
    {
        $Entreanimal=DB::table('entreranimals')
        ->join('especes', 'entreranimals.animalid', '=', 'especes.id')
        ->join('fournisseurs', 'entreranimals.fournisseurid', '=', 'fournisseurs.id')
        ->select('entreranimals.*', 'especes.libelle','fournisseurs.nom')         
        ->orderBy('id', 'ASC')
        ->get();

        $site= site::orderBy('libelle', 'ASC')->get();
        $espece = Espece::orderBy('libelle', 'ASC')->get();
        $statut = Statut::orderBy('libelle', 'ASC')->get();
        $fournisseur = fournisseur::orderBy('nom', 'ASC')->get();

        return view(
            'entreranimal.index',
            [
                'site'        => $site,
                'espece'  => $espece,
                'statut'      => $statut,
                'fournisseur' => $fournisseur,
                'Entreanimal'  => $Entreanimal
            ]
        );
    }

    public function store(Request $request)
    {
        try {
           
            $stock = new Entreranimal();

            $stock->site= $request->batiment;
            $stock->blocid= $request->blocid;
            $stock->animalid= $request->espece;
            $stock->boxid= $request->boxid;
            $stock->numero = $request->nom;
            $stock->statutid = $request->statut;
            $stock->sexe = $request->sexe;
            $stock->date = $request->date;
            $stock->fournisseurid = $request->fournisseur;
            $stock->quantitea = $request->quantite;
            $stock->note= $request->note;

            $stock->save();

            if ($stock) {


                $stor = DB::table('compteanimals')
                        ->where('site',$request->batiment)
                        ->where('motifa',$request->espece)
                        ->first();
                
                if($stor){

                $stor = $stor->quantite;

                $newquantite = $stor+$request->quantite;

                $updateStor = [
                    'quantite'=> $newquantite
                ];

                Compteanimal::where('site',$request->batiment)
                      ->where('motifa',$request->espece)
                      ->update($updateStor);

                    
                    if($updateStor){
                        return back()->with('success', 'Très bien! L\'entrer animal bien enregistrer');

                    }else{
                        return back()->with('failed', 'Echec ! L\'entrer animal n\'est pas creer ');
                    }

                }else{

                    $initialstock = new Compteanimal();

                    $initialstock->site    = $request->batiment;
                    $initialstock->motifa  = $request->espece;
                    $initialstock->quantite= $request->quantite;

                    $initialstock->save();

                    if($initialstock){
                        return back()->with('success', 'Très bien! L\'entrer animal bien enregistrer');

                    }else{
                        return back()->with('failed', 'Echec ! L\'entrer animal n\'est pas creer ');
                    }
                }


            } else {
                return back()->with('failed', 'Echec ! L\'entrer stock n\'est pas creer ');
            }
       
        } catch (Exception $e) {
            return back()->with('error', 'Erreur d\'insertion');
        }
    }


    public function findbox(Request $request){

        try {
    
            $check=DB::table('boxes')
            ->where('siteid',$request->batiment)
            ->where('animalid',$request->id)
            ->where('blocid',$request->blocid)
            ->where('animalid',$request->espece)
            ->orderBy('id', 'ASC')
            ->get();
            return response()->json($check);
           
           
        } catch (Exception $e) {
            return back()->with('failed', 'Echec ! bloc n\'est pas supprimer ');
          }
           
        }

     // supresseion
     public function delete($id)
     {
       $post = Entreranimal::find($id);
       $post->delete();
       return back()->with('success', 'Stock supprimer avec succès');
     }
}
