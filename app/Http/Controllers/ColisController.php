<?php

namespace App\Http\Controllers;

use App\Models\AgenceTransfert;
use App\Models\Colis;
use App\Models\User;
use App\Models\Groupage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Support\Facades\Validator;

class ColisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'Secretaire') {

            // récupérer les agences de l'utilisateur
            $agences = $user->agences->pluck('id');

            $colis = Colis::where(function ($query) use ($user, $agences) {

                        $query->where('user_id', $user->id)
                            ->orWhereIn('agence_transfert_id', $agences);

                    })
                    ->orderBy('created_at', 'desc')
                    ->get();

        } else {

            $colis = Colis::orderBy('created_at', 'desc')->get();

        }

        $groupages = Groupage::all();

        return view('colis.list_colis', compact('colis','groupages'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();

        // agences de l'utilisateur connecté
        $userAgences = $user->agences->pluck('id');

        // clients appartenant aux mêmes agences
        $clients = User::where('role', 'client')
            ->whereHas('agences', function ($query) use ($userAgences) {
                $query->whereIn('agence_transfert_id', $userAgences);
            })
            ->get();

        // agences sauf celles de l'utilisateur
        $agences = AgenceTransfert::whereNotIn('id', $userAgences)->get();

        return view('colis.forms_colis', compact('clients', 'agences'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $inspections = Validator::make($request->all(), [
        //     'client_id' => 'required|exists:users,id',
        //     'agence_transfert_id' => 'required|exists:agences_transfert,id',
        //     'poid' => 'required|numeric|min:0.1',
        //     'type' => 'required|string|max:255',
        //     'destinateur_nom' => 'required|string|max:255',
        //     'destinateur_prenom' => 'required|string|max:255',
        //     'destinateur_email' => 'required|string|max:255',
        //     'destinateur_telephone' => 'required|string|max:255',
        // ]);
        // if($inspections->fails()){
        //     dd($inspections->errors());
        // }
        
        $request->validate([
            'client_id' => 'required|exists:users,id',
            'agence_transfert_id' => 'required|exists:agences_transfert,id',
            'poid' => 'required|numeric|min:0.1',
            'type' => 'nullable|string|max:255',
            'destinateur_nom' => 'required|string|max:255',
            'destinateur_prenom' => 'nullable|string|max:255',
            'destinateur_email' => 'nullable|string|max:255',
            'destinateur_telephone' => 'required|string|max:255',
            'paiement' => 'required|in:payé,non_payé,partiel',
            'montant_avance' => 'nullable|numeric|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 1. Génération de l’ID personnalisé du colis
        $lastId = Colis::max('id') + 1; // par sécurité, on récupère le max
        $currentYear = now()->format('y'); // ex: 25 pour 2025
        $codeColis = 'FIH' . str_pad($lastId, 5, '0', STR_PAD_LEFT) . $currentYear;

        // 2. Calcul automatique du montant

        $prixKilo = $request->prix_kilo;
        $montant = $request->poid * $prixKilo;


        $photo_name = null;

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');

            // Génère un nom unique pour éviter les collisions
            $photo_name = time() . '_' . $photo->getClientOriginalName();

            // Stocke dans storage/app/public/photos
            $photo->storeAs('public/photos', $photo_name);
        }

         $colis = Colis::create([
            'user_id' => Auth::id(),
            'client_id' =>  $request->client_id,
            'agence_transfert_id' => $request->agence_transfert_id,
            'poid' => $request->poid,
            'prix_kilo' => $prixKilo,
            'type' => $request->type,
            'statut' => 'en_attente',
            'montant' => $montant,
            'montant_avance' => $request->montant_avance ?? 0,
            'paiement' => $request->paiement,
            'destinateur_nom' => $request->destinateur_nom,
            'destinateur_prenom' => $request->destinateur_prenom,
            'destinateur_email' => $request->destinateur_email,
            'destinateur_telephone' => $request->destinateur_telephone,
            'code_colis' => $codeColis,
            'photo' => $photo_name ?? null,
        ]);

        return redirect('colis/list_colis')->with('success', 'Colis ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $colis = Colis::with('agenceTransfert', 'user')->findOrFail($id);
        return view('colis.edit_colis', compact('colis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // $request->validate([
        //     'client_id' => 'required|exists:users,id',
        //     'agence_transfert_id' => 'required|exists:agences_transfert,id',
        //     'poid' => 'required|numeric|min:0.1',
        //     'type' => 'required|string|max:255',
        //     'statut' => 'required|in:en_attente,en_cours,livré',
        //     'destinateur_nom' => 'required|string|max:255',
        //     'destinateur_prenom' => 'required|string|max:255',
        //     'destinateur_email' => 'required|string|max:255',
        //     'destinateur_telephone' => 'required|string|max:255',
        //     'paiement' => 'required|in:payé,non_payé',
        // ]);


        $colis = Colis::findOrFail($id);

        if ($request->statut === 'livré' && $request->paiement === 'non_payé') {
            return back()->withErrors([
                'statut' => 'Impossible de livrer un colis non payé.'
            ])->withInput();
        }
        if ($request->statut === 'livré' && $request->paiement === 'partiel') {
            return back()->withErrors([
                'statut' => 'Impossible de livrer un colis partiellement payé.'
            ])->withInput();
        }

        $prixKilo = $request->prix_kilo;

        $colis->update([

            // 'user_id' => Auth::id(),
            // 'client_id' =>  $request->client_id,
            // 'agence_transfert_id' => $request->agence_transfert_id,
            'poid' => $request->poid,
            'type' => $request->type,
            'prix_kilo' => $prixKilo,
            'statut' => $request->statut,
            'paiement' => $request->paiement,
            'montant_avance' => $request->montant_avance ?? 0,
            'destinateur_nom' => $request->destinateur_nom,
            'destinateur_prenom' => $request->destinateur_prenom,
            'destinateur_email' => $request->destinateur_email,
            'destinateur_telephone' => $request->destinateur_telephone,
            'montant' => $request->poid * $prixKilo,
        ]);

        return back()->with('success', 'Colis modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $colis = Colis::findOrFail($id);
        $colis->delete();

        return redirect()->route('colis.list_colis.index')->with('success', 'Colis supprimé avec succès.');
    }

    public function imprimer($id)
    {
        $colis = Colis::with('client', 'user', 'AgenceTransfert')->findOrFail($id);
        return view('colis.imprimer', compact('colis')); // Crée une vue propre à l'impression
    }

    public function search(Request $request)
    {
        $code = $request->query('code_colis');

         $colis = Colis::where('code_colis', $code)->first();

        if ($colis) {
            return response()->json([
                'success' => true,
                'transfert' => $colis,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Aucun transfert trouvé',
            ]);
        }
    }
}
