<?php

namespace App\Http\Controllers;

use App\Models\AgenceTransfert;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $users = User::where('role', 'Secretaire')
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('user.user', [
            "users" => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $agences = AgenceTransfert::all();
        return view('user.forms_admin', [
            'agences' => $agences,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'sexe' => 'required|string',
        'telephone' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'adresse' => 'required|string',
        'profession' => 'required|string',
        'agences_transfert_id' => 'required|exists:agences_transfert,id',
    ]);

    $agence = AgenceTransfert::findOrFail(intval($request->agences_transfert_id));

    $user = User::create([
        'name' => $request->name,
        'prenom' => $request->prenom,
        'sexe' => $request->sexe,
        'telephone' => $request->telephone,
        'email' => $request->email,
        'password' => bcrypt('default123'),
        'role' => 'Secretaire',
        'adresse' => $request->adresse,
        'profession' => $request->profession,
        'agences_transfert_id' => $agence->id,
        'statut' => true,
    ]);

    $user->agences()->attach($agence->id);

        return redirect('user/admin')->with('success', 'Utilisateur ajouté avec succès.');

}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('agences')->findOrFail($id);
        return view('user.edit_user', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::with('agences')->findOrFail($id);
        $agences = AgenceTransfert::all();
        return view('user.edit_user', compact('user', 'agences'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        dd($request->all(), $id);
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'sexe' => 'required|string',
            'telephone' => 'required|string',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'role' => 'required|string',
            'adresse' => 'nullable|string',
            'profession' => 'nullable|string',
            'agences_transfert_id' => 'required|exists:agences_transfert,id',
        ]);

        $agence = AgenceTransfert::findOrFail(intval($request->agences_transfert_id));

        $user->update([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'sexe' => $request->sexe,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'role' => $request->role,
            'adresse' => $request->adresse,
            'profession' => $request->profession,
            'agences_transfert_id' => $agence->id,
        ]);

        // Synchroniser les agences associées
        $user->agences()->sync([$agence->id]);

        return redirect('user/admin')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.admin')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
