<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use App\Models\Salaire;
use App\Models\site;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaireController extends Controller
{
    public function index()
    {
       
        $salsite= DB::table('salaires')
        ->join('personnels', 'salaires.persid', '=', 'personnels.id')
        ->select('salaires.*', 'personnels.nom', 'personnels.prenom')
        ->orderBy('id', 'ASC')
        ->get();

        $personnel= Personnel::all();
        $site= site::all();
        return view(
            'salaire.index',
            [
                'personnel' => $personnel,
                'site'      => $site,
                'salaire'   => $salsite
            ]
        );
    }

    public function store(Request $request)
    {
        try {
           
            $credit = new Salaire();

            $credit->site= $request->site;
            $credit->persid = $request->persid;
            $credit->mois= $request->mois;
            $credit->anne= $request->anne;
            $credit->date = $request->date;
            $credit->montant= $request->montant;
            $credit->note= $request->note;

            $credit->save();

            if ($credit) {
                return back()->with('success', 'Très bien! salaire bien enregistrer');
            } else {
                return back()->with('failed', 'Echec ! Le salaire n\'est pas creer ');
            }
       
        } catch (Exception $e) {
            return back()->with('error', $e);
        }
    }

     // supresseion
     public function delete($id)
     {
       $post = Salaire::find($id);
       $post->delete();
       return back()->with('success', 'Salaire supprimer avec succès');
     }
}
