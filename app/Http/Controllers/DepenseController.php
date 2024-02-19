<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use App\Models\Motifdepense;
use App\Models\site;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepenseController extends Controller
{
    public function index()
    {
        $depense=DB::table('depenses')
        ->join('motifdepenses', 'depenses.motif', '=', 'motifdepenses.id')
        ->select('depenses.*', 'motifdepenses.libelle')         
        ->orderBy('id', 'ASC')
        ->get();


        $motif= Motifdepense::all();
        $site= site::all();
        return view(
            'depense.index',
            [
                'depense' => $depense,
                'site'    => $site,
                'motif'   => $motif
            ]
        );
    }

    public function store(Request $request)
    {
        try {
           
            $credit = new Depense();
            $credit->site= $request->site;
            $credit->motif = $request->motif;
            $credit->montant= $request->montant;
            $credit->date = $request->date;
            $credit->note= $request->note;

            $credit->save();

            if ($credit) {
                return back()->with('success', 'Très bien! depense bien enregistrer');
            } else {
                return back()->with('failed', 'Echec ! Le depense n\'est pas creer ');
            }
       
        } catch (Exception $e) {
            return back()->with('error', $e);
        }
    }

     // supresseion
     public function delete($id)
     {
       $post = Depense::find($id);
       $post->delete();
       return back()->with('success', 'Depense supprimer avec succès');
     }
}
