<?php

namespace App\Http\Controllers;

use App\Models\Bloc;
use App\Models\Parcelle;
use App\Models\site;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlocController extends Controller
{
    public function index()
    {
       
        $siteData = site::orderBy('libelle', 'ASC')->get();
        return view(
        'bloc.index',
        [
            'siteData'=> $siteData
        ]
        );
    }

    public function store(Request $request)
    {
      try 
    {
        $title = $request->libelle;
        $check = Bloc::where('libelle',$title)->first();
        if($check)
        {
            return back()->with('failed', 'Le libelle du bloc exite');
        }else{
            $bloc = new Bloc();
            $bloc->libelle= $request->name_bloc;
            $bloc->siteid= $request->site_id;
            $bloc->superficie= $request->superficie_bloc;
            $bloc->save();
                if ($bloc) {
                    return back()->with('success', 'Très bien! bloc bien enregistrer');
                }
                else {
                    return back()->with('failed', 'Echec ! bloc n\'est pas creer ');
                }
            }
        }
        catch (Exception $e) {
            return back()->with('error', 'Erreur de connection');
        }
        }

        public function storeparcelle(Request $request)
        {
          try 
        {
            $title = $request->libelle;
            $check = Parcelle::where('parcelle_libelle',$title)
            ->where('blocid',$request->blocid)
            ->first();
            if($check)
            {
                return back()->with('failed', 'Le libelle  du parcelle exite');
            }else{
                $bloc = new Parcelle();
                $bloc->siteid= $request->batiment;
                $bloc->blocid= $request->blocid;
                $bloc->parcelle_libelle= $request->libelle;
                $bloc->superficie= $request->superficie;
                $bloc->save();
                    if ($bloc) {
                        return back()->with('success', 'Très bien! parcelle bien enregistrer');
                    }
                    else {
                        return back()->with('failed', 'Echec ! parcelle n\'est pas creer ');
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
          $go=Bloc::destroy($id);
        if ($go) {
            return back()->with('success', 'Très bien! bloc supprimer');
        }
        else {
            return back()->with('failed', 'Echec ! blocn\'est pas supprimer ');
        }
        }
          catch (Exception $e) {
            return back()->with('error', 'Erreur de connection');
        }
    }

    public function findbloc(Request $request){

    try {

        $check=DB::table('blocs')
        ->where('siteid',$request->id)
        ->orderBy('id', 'ASC')
        ->get();
        return response()->json($check);
       
       
    } catch (Exception $e) {
        return back()->with('failed', 'Echec ! bloc n\'est pas supprimer ');
      }
       
    }

    
    
}
