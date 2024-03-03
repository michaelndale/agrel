<?php

namespace App\Http\Controllers;

use App\Models\Entrestock;
use App\Models\fournisseur;
use App\Models\Motifstock;
use App\Models\site;
use App\Models\Statut;
use App\Models\Stock;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntrestockController extends Controller
{
    public function index()
    {
        $Entrestock=DB::table('entrestocks')
        ->join('motifstocks', 'entrestocks.motifid', '=', 'motifstocks.id')
        ->join('fournisseurs', 'entrestocks.fournisseurid', '=', 'fournisseurs.id')
        ->select('entrestocks.*', 'motifstocks.libelle','motifstocks.unitemesure','fournisseurs.nom')         
        ->orderBy('id', 'DESC')
        ->get();

        $site= site::orderBy('libelle', 'ASC')->get();
        $motifstock = Motifstock::orderBy('libelle', 'ASC')->get();
        $statut = Statut::orderBy('libelle', 'ASC')->get();
        $fournisseur = fournisseur::orderBy('nom', 'ASC')->get();

        return view(
            'entrerstock.index',
            [
               
                'site'        => $site,
                'motifstock'  => $motifstock,
                'statut'      => $statut,
                'fournisseur' => $fournisseur,
                'Entrestock'  => $Entrestock

             
            ]
        );
    }

    public function store(Request $request)
    {
        try {
           
            $stock = new Entrestock();

            $stock->site= $request->site;
            $stock->motifid = $request->motif;
            $stock->statutid= $request->statut;
            $stock->fournisseurid = $request->fournisseur;
            $stock->quantite= $request->quantite;
            $stock->date = $request->date;
            $stock->note= $request->note;

            $stock->save();

            if ($stock) {


                $stor = DB::table('stocks')
                        ->where('site',$request->site)
                        ->where('motifid',$request->motif)
                        ->first();
                
                if($stor){

                $stor = $stor->quantite;

                $newquantite = $stor+$request->quantite;

                $updateStor = [
                    'quantite'=> $newquantite
                ];

                Stock::where('site',$request->site)
                      ->where('motifid',$request->motif)
                      ->update($updateStor);

                    
                    if($updateStor){
                        return back()->with('success', 'Très bien! L\'entrer stock bien enregistrer');

                    }else{
                        return back()->with('failed', 'Echec ! L\'entrer stock n\'est pas creer ');
                    }

                }else{

                    $initialstock = new Stock();

                    $initialstock->site= $request->site;
                    $initialstock->motifid = $request->motif;
                    $initialstock->quantite= $request->quantite;
                    $initialstock->save();

                    if($initialstock){
                        return back()->with('success', 'Très bien! L\'entrer stock bien enregistrer');

                    }else{
                        return back()->with('failed', 'Echec ! L\'entrer stock n\'est pas creer ');
                    }
                }


            } else {
                return back()->with('failed', 'Echec ! L\'entrer stock n\'est pas creer ');
            }
       
        } catch (Exception $e) {
            return back()->with('error', 'Erreur d\'insertion');
        }
    }

     // supresseion
     public function delete($id)
     {
       $post = Entrestock::find($id);
       $post->delete();
       return back()->with('success', 'Stock supprimer avec succès');
     }
}
