<?php

namespace App\Http\Controllers;

use App\Models\fournisseur;
use App\Models\Motifstock;
use App\Models\site;
use App\Models\Sortiestock;
use App\Models\Statut;
use App\Models\Stock;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SortiestockController extends Controller
{
    public function index()
    {
        $Sortiestocks = DB::table('sortiestocks')
            ->join('motifstocks', 'sortiestocks.motifid', '=', 'motifstocks.id')
            ->select('sortiestocks.*', 'motifstocks.libelle', 'motifstocks.unitemesure')
            ->orderBy('id', 'DESC')
            ->get();

        $site = site::orderBy('libelle', 'ASC')->get();
        $motifstock = Motifstock::orderBy('libelle', 'ASC')->get();
        $statut = Statut::orderBy('libelle', 'ASC')->get();


        return view(
            'sortiestock.index',
            [

                'site'        => $site,
                'motifstock'  => $motifstock,
                'statut'      => $statut,

                'Sortiestocks'  => $Sortiestocks


            ]
        );
    }

    public function store(Request $request)
    {
        try {

            $stor = DB::table('stocks')
                ->where('site', $request->site)
                ->where('motifid', $request->motif)
                ->first();

            if ($stor) {

                $stock = new Sortiestock();

                $stock->site = $request->site;
                $stock->motifid = $request->motif;
                $stock->statutid = $request->statut;
                $stock->client = $request->client;
                $stock->quantite = $request->quantite;
                $stock->date = $request->date;
                $stock->prixunite = $request->prixunite;
                $stock->note = $request->note;

                $stock->save();



                $stor = $stor->quantite;

                $newquantite = $stor - $request->quantite;

                $updateStor = [
                    'quantite' => $newquantite
                ];

                Stock::where('site', $request->site)
                    ->where('motifid', $request->motif)
                    ->update($updateStor);


                if ($updateStor) {
                    return back()->with('success', 'Très bien! La sortie en stock bien enregistrer');
                } else {
                    return back()->with('failed', 'Echec ! La sortie en stock n\'est pas creer ');
                }
            } else {
                return back()->with('failed', 'Echec ! Pas de stock dispobible pour cette type de produit ');
            }
        } catch (Exception $e) {
            return back()->with('error', $e);
        }
    }

    // supresseion
    public function delete($id)
    {
        $post = Sortiestock::find($id);
        $post->delete();
        return back()->with('success', 'Stock supprimer avec succès');
    }
}
