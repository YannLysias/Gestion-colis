<?php

namespace App\Http\Controllers;
use App\Models\Groupage;
use App\Models\Colis;
use App\Models\AgenceTransfert;
use App\Models\User;


use Illuminate\Http\Request;

class GroupageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groupages = Groupage::orderBy('created_at', 'desc')->paginate(10);

        $colisDisponibles = Colis::where('statut', 'en_attente')
            ->whereRaw('NOT EXISTS (
                SELECT 1 
                FROM groupages 
                WHERE JSON_CONTAINS(groupages.colis_ids, CONCAT(\'"\', colis.code_colis, \'"\'))
            )')
            ->get();

        return view('groupage.list_groupage', [
            "groupages" => $groupages,
            "colisDisponibles" => $colisDisponibles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $colis = Colis::where('statut', 'en_attente')
        ->whereRaw('NOT EXISTS (
            SELECT 1 
            FROM groupages 
            WHERE JSON_CONTAINS(groupages.colis_ids, CONCAT(\'"\', colis.code_colis, \'"\'))
        )')
        ->get();
        $agences = AgenceTransfert::all();
        return view('groupage.forms_groupage', compact('colis', 'agences'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'agence_id' => 'required|exists:agences_transfert,id',
            'colis_ids' => 'required|array|min:1',
            'colis_ids.*' => 'exists:colis,code_colis',
        ]);

        $colis = Colis::whereIn('code_colis', $request->colis_ids)->get();
        $poidsTotal = $colis->sum('poid');
        $code = 'GRP' . rand(100,999);

        Groupage::create([
            'code_groupage' => $code,
            'agence_id' => $request->agence_id,
            'colis_ids' => $request->colis_ids,
            'poids_total' => $poidsTotal,
            'statut' => 'en_attente',
        ]);

        return redirect('groupage')->with('success', 'Groupage créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $groupage = Groupage::findOrFail($id);
        $groupage->delete();

        return redirect()->route('groupage.index')->with('success', 'Groupage supprimé avec succès.');
    }

    public function updateStatut($id)
    {
        $groupage = Groupage::findOrFail($id);

        // Déterminer le nouveau statut
        if ($groupage->statut === 'en_attente') {
            $nouveauStatut = 'en_cours';
        } elseif ($groupage->statut === 'en_cours') {
            $nouveauStatut = 'arrivé';
        } else {
            return back()->with('error', 'Le groupage est déjà arrivé.');
        }

        // Mettre à jour le groupage
        $groupage->update([
            'statut' => $nouveauStatut,
        ]);

        // Mettre à jour les colis avec le même statut
        Colis::whereIn('code_colis', $groupage->colis_ids)
            ->update(['statut' => $nouveauStatut]);

        return back()->with('success', 'Statut mis à jour.');
    }

    public function supprimerColisGrouper($groupageId, $codeColis)
    {
        $groupage = Groupage::findOrFail($groupageId);

        $colisIds = $groupage->colis_ids ?? [];

        // 🔹 Retirer le colis du tableau JSON
        $colisIds = array_values(array_diff($colisIds, [$codeColis]));

        // 🔹 Recalculer le poids total
        $colis = Colis::whereIn('code_colis', $colisIds)->get();
        $poidsTotal = $colis->sum('poid');

        $groupage->update([
            'colis_ids' => $colisIds,
            'poids_total' => $poidsTotal
        ]);

        return back()->with('success', 'Colis supprimé du groupage avec succès.');
    }  
    
    public function ajouterColis(Request $request, $id)
    {
        $request->validate([
            'colis_ids' => 'required|array|min:1',
        ]);

        $groupage = Groupage::findOrFail($id);

        $colisExistants = $groupage->colis_ids ?? [];

        // Fusionner sans doublon
        $nouveaux = array_unique(array_merge($colisExistants, $request->colis_ids));

        // Recalcul poids
        $colis = Colis::whereIn('code_colis', $nouveaux)->get();
        $poidsTotal = $colis->sum('poid');

        $groupage->update([
            'colis_ids' => $nouveaux,
            'poids_total' => $poidsTotal
        ]);

        return back()->with('success', 'Colis ajouté au groupage avec succès.');
    }
}
