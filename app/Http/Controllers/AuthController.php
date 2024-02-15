<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{


    public function login()
    {
      if (Auth::id()){
        return redirect()->route('bienvenu')->with('success', 'Très bien! vous etes connecter');
      }else{
        return view('Auth.index');
      }
  
    }

    public function handlelogin(AuthRequest $request)
    {
      try{

        $username = $request->email;
        $password = $request->password;
        if (Auth::attempt(['identifiant'=> $username,'password'=> $password])) {

            $user = Auth::User();
             
            if($user->statut=='Activé'){
                return redirect()->route('bienvenu')->with('success', 'Très bien! vous etes connecter');
            }
            else if($user->statut=='Bloqué'){
                return back()->with('failed', 'Votre compte est Bloqué ');
             
            }
            else if($user->statut=='Desactivé'){
                return back()->with('failed', 'Votre compte est Desactivé ');
             }
             
          }
          else
          {
            
            return back()->with('failed', 'Identifiant et mot de passe incorrect ');
          }
      
        } catch (Exception $e) {
            return back()->with('error', 'Erreur de connection');
        }
       
    }

    public function logout()
    {
      session()->forget('id');
      Auth::logout();
      return redirect()->route('login')->with('success', 'Très bien! vous etes deconnecter');
    }


}
