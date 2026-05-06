<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    //affichage du clients 
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }
    //from ajouter
    public function  create()
    {
        return view('clients.create');
    }
    //stocage des client
   public function store(Request $request){
    Client::create([
        'name' => $request->name,
        'phone' => $request->phone,
        'status' => $request->status,
        'reminder_date' => $request->reminder_date,
        'reminder_at' => $request->reminder_at
    ]);

    return redirect()->route('clients.index');
}
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $client->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'status' => $request->status,
            'reminder_date' => $request->reminder_date,
            'reminder_at' => $request->reminder_at
        ]);
        return redirect()->route('clients.index');
    }
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('clients.index');
    }
}
