<?php

namespace App\Http\Controllers;

use App\Models\TransfertArgent;
use App\Models\AgenceTransfert;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransfertController extends Controller
{
    /**
     * Liste des transferts (vue: transfert.list_transfert)
     */
    public function index()
    {
        $transferts = TransfertArgent::with(['client', 'AgenceTransfert'])
            ->latest()
            ->get();

        return view('transfert.list_transfert', compact('transferts'));
    }

    /**
     * Formulaire de création (vue: transfert.create)
     */
    public function create()
    {
        $agences = AgenceTransfert::all();

        // Adapte le filtre selon ta logique réelle de rôles (ex: where('role', 'client'))
        $clients = User::where('role', 'client')->get();

        $numeroDeControle = $this->genererNumeroControle();

        return view('transfert.forms_transfert', compact('agences', 'clients', 'numeroDeControle'));
    }

    /**
     * Enregistrement d'un nouveau transfert
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'agence_transfert_id'   => 'required|exists:agences_transfert,id',
            'client_id'             => 'required|exists:users,id',
            'montant_a_envoyer'     => 'required|numeric|min:0.01',
            'taux_de_change'        => 'required|numeric|min:0.01',
            'motif_du_transfert'    => 'required|string|max:255',
            'numero_de_controle'    => 'required|numeric',
            'destinateur_nom'       => 'required|string|max:255',
            'destinateur_prenom'    => 'required|string|max:255',
            'destinateur_telephone' => 'required|string|max:30',
            'destinateur_email'     => 'nullable|email|max:255',
            'type_piece_identite'   => 'required|string|max:100',
            'numero_piece_identite' => 'nullable|string|max:100',
        ]);

        // Recalcul serveur (ne jamais faire confiance aux valeurs calculées côté JS)
        $montantEnvoyer = (float) $validated['montant_a_envoyer'];
        $tauxDeChange   = (float) $validated['taux_de_change'];
        $taxe           = round($montantEnvoyer * 0.08, 2);
        $montantARecevoir = round(($montantEnvoyer - $taxe) * $tauxDeChange, 2);

        $transfert = TransfertArgent::create([
            'user_id'               => Auth::id(), // secrétaire connectée
            'client_id'             => $validated['client_id'],
            'agence_transfert_id'   => $validated['agence_transfert_id'],
            'montant_a_envoyer'     => $montantEnvoyer,
            'taux_de_change'        => $tauxDeChange,
            'taxe'                  => $taxe,
            'montant_a_recevoir'    => $montantARecevoir,
            'destinateur_nom'       => $validated['destinateur_nom'],
            'destinateur_prenom'    => $validated['destinateur_prenom'],
            'destinateur_telephone' => $validated['destinateur_telephone'],
            'destinateur_email'     => $validated['destinateur_email'] ?? null,
            'type_piece_identite'   => $validated['type_piece_identite'],
            'numero_piece_identite' => $validated['numero_piece_identite'] ?? null,
            'motif_du_transfert'    => $validated['motif_du_transfert'],
            'numero_de_controle'    => $validated['numero_de_controle'],
            'statut'                => 'En_attente',
        ]);

        return redirect()
            ->route('transfert.list_transfert.show', $transfert->id)
            ->with('success', 'Transfert enregistré avec succès. Numéro de contrôle : ' . $transfert->numero_de_controle);
    }

    /**
     * Détail d'un transfert (vue: transfert.show)
     */
    public function show($id)
    {
        $transfert = TransfertArgent::with(['client', 'user', 'AgenceTransfert'])
            ->findOrFail($id);

        return view('transfert.edit_transfert', compact('transfert'));
    }

    /**
     * Mise à jour d'un transfert (depuis le modal de la vue show)
     */
    public function update(Request $request, $id)
    {
        $transfert = TransfertArgent::findOrFail($id);

        $validated = $request->validate([
            'montant_a_envoyer'     => 'required|numeric|min:0.01',
            'statut'                => 'required|in:En_attente,Validé',
            'motif_du_transfert'    => 'required|string|max:255',
            'type_piece_identite'   => 'required|string|max:100',
            'numero_piece_identite' => 'nullable|string|max:100',
            'destinateur_nom'       => 'required|string|max:255',
            'destinateur_prenom'    => 'required|string|max:255',
            'destinateur_telephone' => 'required|string|max:30',
            'destinateur_email'     => 'nullable|email|max:255',
        ]);

        // Recalcul du montant à recevoir si le montant à envoyer change
        $montantEnvoyer   = (float) $validated['montant_a_envoyer'];
        $tauxDeChange     = (float) $transfert->taux_de_change;
        $taxe             = round($montantEnvoyer * 0.08, 2);
        $montantARecevoir = round(($montantEnvoyer - $taxe) * $tauxDeChange, 2);

        $transfert->update([
            'montant_a_envoyer'     => $montantEnvoyer,
            'taxe'                  => $taxe,
            'montant_a_recevoir'    => $montantARecevoir,
            'statut'                => $validated['statut'],
            'motif_du_transfert'    => $validated['motif_du_transfert'],
            'type_piece_identite'   => $validated['type_piece_identite'],
            'numero_piece_identite' => $validated['numero_piece_identite'] ?? null,
            'destinateur_nom'       => $validated['destinateur_nom'],
            'destinateur_prenom'    => $validated['destinateur_prenom'],
            'destinateur_telephone' => $validated['destinateur_telephone'],
            'destinateur_email'     => $validated['destinateur_email'] ?? null,
        ]);

        return redirect()
            ->route('transfert.list_transfert.show', $transfert->id)
            ->with('success', 'Transfert mis à jour avec succès.');
    }

    /**
     * Recherche AJAX par numéro de contrôle (utilisé par la barre de recherche de la liste)
     */
    public function searchByNumero(Request $request)
    {
        $numero = $request->query('numero');

        $transfert = TransfertArgent::with(['client', 'AgenceTransfert'])
            ->where('numero_de_controle', $numero)
            ->first();

        if (!$transfert) {
            return response()->json(['success' => false]);
        }

        return response()->json([
            'success' => true,
            'transfert' => $transfert,
        ]);
    }

    /**
     * Vue d'impression du reçu de transfert (vue: transfert.recu)
     */
    public function imprimer($id)
    {
        $transfert = TransfertArgent::with(['client', 'user', 'AgenceTransfert'])
            ->findOrFail($id);

        return view('transfert.imprimer', compact('transfert'));
    }

    /**
     * Génère un numéro de contrôle unique à 10 chiffres
     */
    private function genererNumeroControle(): string
    {
        do {
            $numero = str_pad((string) random_int(0, 9999999999), 10, '0', STR_PAD_LEFT);
        } while (TransfertArgent::where('numero_de_controle', $numero)->exists());

        return $numero;
    }
}
