<?php

namespace App\Http\Controllers;

use App\Models\AgenceTransfert;
use App\Models\Colis;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;



class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', 'Client')
                        ->orderBy('created_at', 'desc')->get();

        return view('user.user', [
            "users" => $users,
        ]);
    }

    public function createAdmin()
    {
        $admin = User::where('role', 'Super-admin')->first();

        if($admin)
        {
            return response()->json("Le super administrateur avait déjà été enregistré");
        }

        $admin = User::create([
            'name' => 'MPUKYA KEBO',
            'prenom' => 'Glody',
            'sexe' => 'Masculin',
            'telephone' => '54103099',
            'email' => 'lysiasyannloemba06@gmail.com',
            'role' => 'Super-admin',
            'password' => '12345678',
            'adresse' => 'Bicentenaire',
            'profession'  => 'Etudiant',
            'transfert_argent_id'  => 0,
            'colis_id'  => 0,
            'statut'  => True,
        ]);

        return response()->json('Le super administrateur a été enregistré avec succès');

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $agences = AgenceTransfert::all();
        return view('user.forms_user', [
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
        'email' => 'nullable|email|unique:users,email',
        'role' => 'required|string',
        'adresse' => 'nullable|string',
        'profession' => 'nullable|string',
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
        'role' => $request->role,
        'adresse' => $request->adresse,
        'profession' => $request->profession,
        'agences_transfert_id' => $agence->id,
        'statut' => true,
    ]);

    $user->agences()->attach($agence->id);

        return redirect('user/user')->with('success', 'Utilisateur ajouté avec succès.');

}
public function stat()
{
    $colisEnregistres = Colis::count();
    $colisLivres = Colis::where('statut', 'Livré')->count();
    $colisEnAttente = Colis::where('statut', 'En_attente')->count();
    $colisEnCours = Colis::where('statut', 'En_cours')->count();
    $secretaire = User::where('role', 'Secretaire')->count();
    $clients = User::where('role', 'Client')->count();
    $agences = AgenceTransfert::count();

    $caJour = Colis::whereDate('created_at', Carbon::today())
                ->where('paiement', 'payé')
                ->sum('montant');

    $caSemaine = Colis::whereBetween('created_at', [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek()
                ])
                ->where('paiement', 'payé')
                ->sum('montant');

     $caMois = Colis::whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year)
                    ->where('paiement', 'payé')
                    ->sum('montant');

        // 📦 Montant total de tous les colis
    $montantTotal = Colis::sum('montant');

    // 🚚 Montant des colis envoyés (ex: statut = en_cours)
    $montantEnvoyes = Colis::where('statut', 'en_cours')
                            ->sum('montant');

    // ✅ Montant des colis livrés
    $montantLivres = Colis::where('statut', 'livre')
                           ->sum('montant');

    return view('dashboard', compact('colisEnregistres', 'colisLivres', 'colisEnAttente', 'colisEnCours', 'secretaire', 'clients', 'agences', 'caJour', 'caSemaine', 'caMois', 'montantTotal', 'montantEnvoyes', 'montantLivres'));
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('agences')->findOrFail($id);
        $agences = AgenceTransfert::all();
        return view('user.edit_user', compact('user', 'agences'));
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
        $user = User::findOrFail($id);

        $request->validate([
            'agences_transfert_id' => 'required|exists:agences_transfert,id',
            // autres champs …
        ]);

        $user->update([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'sexe' => $request->sexe,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'adresse' => $request->adresse,
            'profession' => $request->profession,
            'agences_transfert_id' => $request->agences_transfert_id,
        ]);

        return redirect()->back()->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.user.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
