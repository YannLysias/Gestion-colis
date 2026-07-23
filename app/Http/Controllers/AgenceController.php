<?php

namespace App\Http\Controllers;

use App\Models\AgenceTransfert;
use Illuminate\Http\Request;

class AgenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agences = AgenceTransfert::all();
        return view('agences', [
            "agences" => $agences,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('forms_agence');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'pays' => 'required|string',
            'ville' => 'required|string',
            'adresse_complete' => 'required|string',
        ]);

        $service = AgenceTransfert::create([
            'nom' => $request->nom,
            'statut' => true,
            'pays' => $request->pays,
            'ville' => $request->ville,
            'adresse_complete' => $request->adresse_complete,
        ]);

        return redirect('agence')->with('success', 'Agence ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $agence = AgenceTransfert::findOrFail($id);
        return view('edit_agence', compact('agence'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $agence = AgenceTransfert::findOrFail($id);
        return view('edit_agence', compact('agence'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $agence = AgenceTransfert::findOrFail($id);
        $agence->update([
            'nom' => $request->nom,
            'pays' => $request->pays,
            'ville' => $request->ville,
            'adresse_complete' => $request->adresse_complete,
        ]);

        return redirect('agence')->with('success', 'Agence mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $agence = AgenceTransfert::findOrFail($id);
        $agence->delete();

        return redirect()->route('agence.index')->with('success', 'Agence supprimée avec succès.');
    }
}
