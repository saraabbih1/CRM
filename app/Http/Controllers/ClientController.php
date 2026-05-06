<?php

namespace App\Http\Controllers;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    //affichage du clients 
    public function index(){
        $client=Client::all();
        return view('clients.index',compact('clients'));
    }
//from ajouter
public function  create(){
    return view('clients.create');
}
//stocage des client
public function store(Request $request){
    Client::create($request->all());
    return redirect()->route('clients.index');
}
}
