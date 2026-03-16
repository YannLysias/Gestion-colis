<?php

namespace App\Http\Controllers;

use App\Models\AgenceTransfert;
use App\Models\Colis;
use App\Models\User;
use App\Models\Groupage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    $colisEnCours = Colis::where('statut', 'en_cours')->count();
    $totalColis = Colis::count();
    $colisLivres = Colis::where('statut', 'Livré')->count();
    $colisEnAttente = Colis::where('statut', 'En_attente')->count();
    $colisArrive = Colis::where('statut', 'arrivé')->count();

    $secretaire = User::where('role', 'Secretaire')->count();
    $clients = User::where('role', 'Client')->count();
    $agences = AgenceTransfert::count();
    $groupage = Groupage::count();

    $montantEnregistres = Colis::sum('montant');
    $montantArrive = Colis::where('statut', 'arrivé')->sum('montant');
    $montantLivres = Colis::where('statut', 'livré')->sum('montant');
    $montantEnAttente = Colis::where('statut', 'en_attente')->sum('montant');

    $tauxLivraison = $totalColis > 0 ? round(($colisLivres/$totalColis)*100) : 0;
    $tauxArrivé = $totalColis > 0 ? round(($colisArrive/$totalColis)*100) : 0;
    $tauxAttente = $totalColis > 0 ? round(($colisEnAttente/$totalColis)*100) : 0;
    $tauxCours = $totalColis > 0 ? round(($colisEnCours/$totalColis)*100) : 0;
    $tauxLivraison = $colisEnregistres > 0 ? round(($colisLivres / $colisEnregistres) * 100, 2) : 0;

    $colisAujourdHui = Colis::whereDate('created_at', today())->count();
    $caAujourdHui = Colis::whereDate('created_at', today())->where('paiement','payé')->sum('montant');
    $colisParMois = Colis::select(DB::raw('MONTH(created_at) as mois'), DB::raw('COUNT(*) as total'))->whereYear('created_at', Carbon::now()->year)->groupBy('mois')->orderBy('mois')->pluck('total', 'mois');
    $caTotal = Colis::where('paiement', 'payé')->sum('montant');
    $caParMois = Colis::select(DB::raw('MONTH(created_at) as mois'), DB::raw('SUM(montant) as total'))->where('paiement','payé')->whereYear('created_at', Carbon::now()->year)->groupBy('mois')->pluck('total','mois');
    $topClients = Colis::select('client_id', DB::raw('COUNT(*) as total_colis'), DB::raw('SUM(poid) as total_kilos'), DB::raw('SUM(montant) as total_montant'))->with('client')->groupBy('client_id')->orderByDesc('total_colis')->limit(5)->get();

    $statCA = [];
    for ($i = 1; $i <= 12; $i++) {
        $statCA[] = $caParMois[$i] ?? 0;
    }
    $statistiques = [];
    for ($i = 1; $i <= 12; $i++) {
        $statistiques[] = $colisParMois[$i] ?? 0;
    }

    return view('dashboard', compact('colisEnregistres', 'topClients', 'colisEnCours', 'statCA', 'caParMois', 'caTotal', 'tauxCours', 'tauxArrivé', 'tauxAttente', 'colisLivres', 'colisEnAttente', 'colisArrive', 'secretaire', 'clients', 'agences', 'groupage', 'montantEnregistres',  'montantArrive', 'montantLivres', 'montantEnAttente', 'tauxLivraison' ,  'colisParMois', 'statistiques', 'colisAujourdHui', 'caAujourdHui'));
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('agences')->findOrFail($id);
        $agences = AgenceTransfert::all();
        $groupages = Groupage::all();
        $listeColis = Colis::where('client_id', $id)->get();
        return view('user.edit_user', compact('user', 'agences', 'groupages', 'listeColis'));
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
