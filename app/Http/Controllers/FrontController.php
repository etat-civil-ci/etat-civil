<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function welcome()
    {
        return view('frontend.welcome');
    }
    public function index()
    {
        return view('frontend.index');
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function actedeces(){
        return view('frontend.actedeces');
    }
    public function actemariage(){
        return view('frontend.actemariage');
    }
    public function actenaissance(){
        return view('frontend.actenaissance');
    }
    public function apropos(){
        return view('frontend.apropos');
    }
    public function aproposactedenaissance(){
        return view('frontend.aproposactedenaissance');
    }
    public function aproposactedemariage(){
        return view('frontend.aproposactedemariage');
    }
    public function aproposactededeces(){
        return view('frontend.aproposactededeces');
    }
    public function dashboard()
    {
        return view('frontend.dashboard');
    }
    public function listeactemariage()
    {
        return view('frontend.listeactemariage');
    }
    public function listeactenaissance()
    {
        return view('frontend.listeactenaissance');
    }
    public function listeactedeces()
    {
        return view('frontend.listeactedeces');
    }
    
    // public function account()
    // {
    //     $users = \App\Models\User::all(); // Récupère tous les utilisateurs
    //     $users = \App\Models\User::paginate(10); // 10 utilisateurs par page
    //     return view('frontend.account', compact('users'));
    // }

    public function account()
{
    $users = \App\Models\User::paginate(10); // Utilisez seulement paginate()
    return view('frontend.account', compact('users'));
}
}
