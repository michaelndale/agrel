<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Fonction;
use App\Models\User;
use Exception;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $userData = User::all();
        $fonction = Fonction::all();
        return view(
        'user.index',
        [
            'userData' => $userData,
            'fonction' => $fonction
        ]
        );
    }

    public function store(UserRequest $request)
    {
      try 
    {
        $identifiant = $request->identifiant;
        $check = User::where('identifiant',$identifiant)->first();
        if($check)
        {
            return back()->with('failed', 'Le nom l\'idenfifaint existe ');
        }else{
            $user = new User();
            $user->identifiant= $request->identifiant;
            $user->email= $request->email;
            $user->fonction   = $request->fonction;
            $user->prenom   = $request->prenom;
            $user->password   = $request->password;
            $user->save();
                if ($user) {
                    return back()->with('success', 'Très bien! l\'utilisateur bien enregistrer');
                }
                else {
                    return back()->with('failed', 'Echec ! l\'utilisateur n\'est pas creer ');
                }
            }
        }
        catch (Exception $e) {
            return back()->with('error', 'Erreur de connection');
        }
        }

        public function delete(UserRequest $request)
        {
        try 
        {   
          $id = $request->id;
          $go=Fonction::destroy($id);
        if ($go) {
            return back()->with('success', 'Très bien! la fonction supprimer');
        }
        else {
            return back()->with('failed', 'Echec ! la fonction n\'est pas supprimer ');
        }
        }
          catch (Exception $e) {
            return back()->with('error', 'Erreur de connection');
        }
    }
}
