<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use Exception;
use Illuminate\Http\Request;

class CreditController extends Controller
{

    public function index()
    {
        $credit = Credit::all();
        return view(
            'credit.index',
            [
                'credit' => $credit
            ]
        );
    }

    public function store(Request $request)
    {
        try {
           
            if($request->montant < $request->montantpayer)
            {
                return back()->with('failed', 'Le montant de l\'avance est superiere a montant a payer ');
            }else{
            $credit = new Credit();
            $credit->motifid= $request->motif;
            $credit->montant = $request->montant;
            $credit->date= $request->datepaye;
            $credit->montantdonne = $request->montantpayer;
            $credit->statut = $request->statut;

            $credit->save();

            if ($credit) {
                return back()->with('success', 'Très bien! credit bien enregistrer');
            } else {
                return back()->with('failed', 'Echec ! Le credit n\'est pas creer ');
            }
        }
        } catch (Exception $e) {
             return back()->with('failed', 'Erreur de connexion ');
        }
    }

     // supresseion
     public function delete($id)
     {
       $post = Credit::find($id);
       $post->delete();
       return back()->with('success', 'Credit supprimer avec succès');
     }
}
