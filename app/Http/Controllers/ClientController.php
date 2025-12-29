<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:clients|max:255',
            'phone' => 'nullable|max:20',
            'address' => 'nullable',
        ]);
        Client::create($request->all());
        return redirect()->route('clients.index')->with('success', 'Client créé avec succès.');
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:clients,email,' . $client->id . '|max:255',
            'phone' => 'nullable|max:20',
            'address' => 'nullable',
        ]);
        $client->update($request->all());
        return redirect()->route('clients.index')->with('success', 'Client modifié avec succès.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client supprimé avec succès.');
    }
}
