<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\Espece;
use App\Models\Motifstock;
use App\Models\site;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $siteData = site::all();

        // recette
        $totalanimal= DB::table('sortieanimals')
        ->Where('statut', 'Vente à cash')
        ->SUM('total');

        $totalproduit= DB::table('sortiestocks')
        ->Where('statutid', 'Vente à cash')
        ->SUM('total');

        $totalrecette = $totalanimal+$totalproduit;

        // fin recette


        // recette moisuel
        $MOISENCOURS= date('m');
        $totalanimalM= DB::table('sortieanimals')
        ->whereMonth('created_at','=',$MOISENCOURS)
        ->Where('statut', 'Vente à cash')
        ->SUM('total');

        $totalproduitM= DB::table('sortiestocks')
        ->whereMonth('created_at','=',$MOISENCOURS)
        ->Where('statutid', 'Vente à cash')
        ->SUM('total');

        $totalrecetteM = $totalanimalM+$totalproduitM;

        // fin recette

        // recette
        $totaldepensegenerale= DB::table('depenses')
        
        ->SUM('montant');

        $totaldepensesalaire= DB::table('salaires')
        ->SUM('montant');

        $totaldepense = $totaldepensegenerale+$totaldepensesalaire;
        
        //

        // recette Mensuel
        $totaldepensegeneraleM= DB::table('depenses')
        ->whereMonth('created_at','=',$MOISENCOURS)
        ->SUM('montant');

        $totaldepensesalaireM= DB::table('salaires')
        ->whereMonth('created_at','=',$MOISENCOURS)
        ->SUM('montant');

        $totaldepenseM = $totaldepensegeneraleM+$totaldepensesalaireM;
        
        //

        //credit 

        $totalcredit= DB::table('credits')
        ->SUM('montant');

        $creditpayer= DB::table('credits')
        ->Where('statut', 'Payé')
        ->SUM('montant');

        $creditpayermoiti= DB::table('credits')
        ->Where('statut', 'Payé moitie')
        ->SUM('montantdonne');

        $totalpayer =$creditpayer+$creditpayermoiti;
        $nonpayer = $totalcredit - $totalpayer ;

        //fin credit
        

        // STOCK PRPDUIT
        $elementstock = Motifstock::select('id', 'libelle', 'unitemesure')->distinct()->get();

        $elementanimal = Espece::select('id', 'libelle')->distinct()->get();

        $recette_depense = $totalrecette+$totaldepense;

        $pourcentage_recette= round(($totalrecette*100)/$recette_depense);
        $pourcentage_depense= round(($totalrecette*100)/$recette_depense);


        return view(
        'home.index',
        [
            'siteData'=> $siteData,
            'totalrecette' => $totalrecette,
            'totaldepense' => $totaldepense,
            'recetteproduit' => $totalproduit,
            'recetteanimal' => $totalanimal,
            'depensegenerale' => $totaldepensegenerale,
            'depensesalaire' => $totaldepensesalaire,
            'totalcredit' => $totalcredit,
            'totalpayer' => $totalpayer,
            'nonpayer' => $nonpayer,


            'recetteanimalM' => $totalanimalM,
            'recetteproduitM' => $totalproduitM,
            'totalrecetteM' => $totalrecetteM,

            'depensegeneraleM' => $totaldepensegeneraleM,
            'depensesalaireM' => $totaldepensesalaireM,
            'totaldepenseM' => $totaldepenseM,

            'elementproduit' => $elementstock,

            'elementanimal' => $elementanimal,

            'pourcentage_recette' => $pourcentage_recette,
            'pourcentage_depense' => $pourcentage_depense
            
        ]
        );
    }

    public function diapoculture(){

        return view('home.index',[]);
    }

    public function rapport(){

        return view('home.rapport',[]);
    }


    public function rechercher(Request $request){

        if($request->operation=='Tout' )
        {
            $Entreanimal=DB::table('entreranimals')
            ->join('especes', 'entreranimals.animalid', '=', 'especes.id')
            ->join('fournisseurs', 'entreranimals.fournisseurid', '=', 'fournisseurs.id')
            ->select('entreranimals.*', 'especes.libelle','fournisseurs.nom')         
            ->orderBy('id', 'DESC')
            ->get();

            $sortieanimal=DB::table('sortieanimals')
            ->join('especes', 'sortieanimals.animalid', '=', 'especes.id')
            ->select('sortieanimals.*', 'especes.libelle')         
            ->orderBy('id', 'DESC')
            ->get();

            $Entrestock=DB::table('entrestocks')
            ->join('motifstocks', 'entrestocks.motifid', '=', 'motifstocks.id')
            ->join('fournisseurs', 'entrestocks.fournisseurid', '=', 'fournisseurs.id')
            ->select('entrestocks.*', 'motifstocks.libelle','motifstocks.unitemesure','fournisseurs.nom')         
            ->orderBy('id', 'DESC')
            ->get();

            $Sortiestocks = DB::table('sortiestocks')
            ->join('motifstocks', 'sortiestocks.motifid', '=', 'motifstocks.id')
            ->select('sortiestocks.*', 'motifstocks.libelle', 'motifstocks.unitemesure')
            ->orderBy('id', 'DESC')
            ->get();

            $depense=DB::table('depenses')
            ->join('motifdepenses', 'depenses.motif', '=', 'motifdepenses.id')
            ->select('depenses.*', 'motifdepenses.libelle')         
            ->orderBy('id', 'ASC')
            ->get();

            $salsite= DB::table('salaires')
            ->join('personnels', 'salaires.persid', '=', 'personnels.id')
            ->select('salaires.*', 'personnels.nom', 'personnels.prenom')
            ->orderBy('id', 'ASC')
            ->get();
    
            $credit = Credit::all();


            $alldata = 1;

            return view('home.rapport',[
                'alldata' => $alldata,
                'entreanimal' => $Entreanimal,
                'sortieanimal' => $sortieanimal,
                'Sortiestocks' => $Sortiestocks,
                'Entrestock' => $Entrestock,
                'depense'  => $depense,
                'salaire' => $salsite,
                'credit' => $credit

            ]);

        }
        elseif($request->operation=='Entrer animal'){

                $Entreanimal=DB::table('entreranimals')
                ->join('especes', 'entreranimals.animalid', '=', 'especes.id')
                ->join('fournisseurs', 'entreranimals.fournisseurid', '=', 'fournisseurs.id')
                ->select('entreranimals.*', 'especes.libelle','fournisseurs.nom')         
                ->orderBy('id', 'DESC')
                ->get();

    
                $alldata = 1;
    
                return view('home.rapport',[
                    'alldata' => $alldata,
                    'entreanimal' => $Entreanimal
                  
    
                ]);

        }

        elseif($request->operation=='Sortie animal'){

            $sortieanimal=DB::table('sortieanimals')
            ->join('especes', 'sortieanimals.animalid', '=', 'especes.id')
            ->select('sortieanimals.*', 'especes.libelle')         
            ->orderBy('id', 'DESC')
            ->get();


            $alldata = 1;

            return view('home.rapport',[
                'alldata' => $alldata,
                'sortieanimal' => $sortieanimal,
              

            ]);

            }

            elseif($request->operation=='Entrer produit'){

                $Entrestock=DB::table('entrestocks')
                ->join('motifstocks', 'entrestocks.motifid', '=', 'motifstocks.id')
                ->join('fournisseurs', 'entrestocks.fournisseurid', '=', 'fournisseurs.id')
                ->select('entrestocks.*', 'motifstocks.libelle','motifstocks.unitemesure','fournisseurs.nom')         
                ->orderBy('id', 'DESC')
                ->get();
    
    
                $alldata = 1;
    
                return view('home.rapport',[
                    'alldata' => $alldata,
                    'Entrestock' => $Entrestock,
                  
    
                ]);
    
                }


                elseif($request->operation=='Sortie produit'){

                    $Sortiestocks = DB::table('sortiestocks')
                    ->join('motifstocks', 'sortiestocks.motifid', '=', 'motifstocks.id')
                    ->select('sortiestocks.*', 'motifstocks.libelle', 'motifstocks.unitemesure')
                    ->orderBy('id', 'DESC')
                    ->get();
        
        
                    $alldata = 1;
        
                    return view('home.rapport',[
                        'alldata' => $alldata,
                        'Sortiestocks' => $Sortiestocks,
                      
        
                    ]);
        
                    }

                    elseif($request->operation=='Depense generale'){

                        $depense=DB::table('depenses')
                        ->join('motifdepenses', 'depenses.motif', '=', 'motifdepenses.id')
                        ->select('depenses.*', 'motifdepenses.libelle')         
                        ->orderBy('id', 'ASC')
                        ->get();
            
            
                        $alldata = 1;
            
                        return view('home.rapport',[
                            'alldata' => $alldata,
                            'depense'  => $depense,
                          
            
                        ]);
            
                        }
                        elseif($request->operation=='Payement salaire'){

                            $salsite= DB::table('salaires')
                            ->join('personnels', 'salaires.persid', '=', 'personnels.id')
                            ->select('salaires.*', 'personnels.nom', 'personnels.prenom')
                            ->orderBy('id', 'ASC')
                            ->get();
                
                            $alldata = 1;
                
                            return view('home.rapport',[
                                'alldata' => $alldata,
                                'salaire' => $salsite,
                              
                
                            ]);
                
                            }

                            elseif($request->operation=='Credit'){

                                $credit = Credit::all();
                                $alldata = 1;
                    
                                return view('home.rapport',[
                                    'alldata' => $alldata,
                                    'credit' => $credit
                                  
                    
                                ]);
                    
                                }


                                
        
        else{
            return back()->with('failed', 'Echec ! Entrer les elements de la recherche ');
        }
    }

  
}
