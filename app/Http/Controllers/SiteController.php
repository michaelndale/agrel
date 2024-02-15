<?php

namespace App\Http\Controllers;

use App\Models\site;
use Exception;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $siteData = site::all();
        return view(
        'site.index',
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
        $check = site::where('libelle',$title)->first();
        if($check)
        {
            return back()->with('failed', 'Le libellé du site exite');
        }else{
            $site = new site();
            $site->libelle= $request->libelle;
            $site->sperficie=  $request->mesure;
            $site->save();
                if ($site) {
                    return back()->with('success', 'Très bien! le libellé bien enregistrer');
                }
                else {
                    return back()->with('failed', 'Echec ! le libellé n\'est pas creer ');
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
          $go=site::destroy($id);
        if ($go) {
            return back()->with('success', 'Très bien! le libellé supprimer');
        }
        else {
            return back()->with('failed', 'Echec ! le libellé n\'est pas supprimer ');
        }
        }
          catch (Exception $e) {
            return back()->with('error', 'Erreur de connection');
        }
    }
}
