<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Reçu d'Expédition - Rapide Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
            font-size: 13px;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
        @media print {
            .signature-zone {
                margin-top: 80px;
            }
        }

        .logo {
            width: 80px;
            height: auto;
        }

        .section-title {
            font-weight: bold;
            text-transform: uppercase;
            border-bottom: 2px solid #000;
            margin-top: 30px;
            margin-bottom: 15px;
            padding-bottom: 5px;
        }

        .info-pair {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .info-pair .label {
            font-weight: bold;
            width: 48%;
        }

        .signature-zone {
            margin-top: 40px;
        }

        .signature-line {
            border-top: 1px solid #000;
            width: 70%;
            margin: 0 auto;
            padding-top: 5px;
            font-size: 12px;
        }
        
    </style>
</head>
<body>

    <div class="text-center mb-4">
        <img src="{{ asset('Authentification/img/Rapide service.jpg') }}" alt="Logo" class="logo">
        <h4 class="mt-2">Fiche d'expédition - Colis N° {{ $colis->code_colis }}</h4>
    </div>

    {{-- Section Informations générales --}}
    <div class="section-title">Informations Générales</div>
    <div class="info-pair">
        <div class="label">Poids : {{ $colis->poid }} kg | pour 1kg = {{ number_format($colis->prix_kilo, 0, ',', ' ') }} $</div>
        <div class="label">Type : {{ $colis->type }}</div>

    </div>
    <div class="info-pair">
        <div class="label">Montant : {{ number_format($colis->montant, 0, ',', ' ') }} $</div>
        <div class="label">Paiement : {{ ucfirst($colis->paiement) }}</div>
    </div>
    @if($colis->paiement === 'partiel')
        <div class="info-pair">
            <div class="label">Montant payé : {{ number_format($colis->montant_avance, 0, ',', ' ') }} $</div>
            <div class="label">Reste à payer : {{ number_format($colis->montant - $colis->montant_avance, 0, ',', ' ') }} $</div>
        </div>
    @endif
    <div class="info-pair">
        <div class="label">Date : {{ $colis->created_at->format('d/m/Y') }}</div>
        <div class="label">Statut : {{ ucfirst(str_replace('_', ' ', $colis->statut)) }}</div>
    </div>

    {{-- Section Destinateur --}}
    <div class="section-title">Destinateur</div>
    <div class="info-pair">
        <div class="label">Nom : {{ $colis->destinateur_nom }} {{ $colis->destinateur_prenom }}</div>
        <div class="label">Téléphone : {{ $colis->destinateur_telephone }}</div>
    </div>
    <div class="info-pair">
        <div class="label">Email : {{ $colis->destinateur_email }}</div>
        <div class="label">Agence réception : {{ $colis->AgenceTransfert->nom ?? 'N/A' }} ({{ $colis->AgenceTransfert->pays ?? 'N/A' }})</div>
    </div>

    {{-- Section Expéditeur --}}
    <div class="section-title">Expéditeur</div>
    <div class="info-pair">
        <div class="label">Nom : {{ $colis->client->name }} {{ $colis->client->prenom }}</div>
        <div class="label">Téléphone : {{ $colis->client->telephone }}</div>
    </div>
    <div class="info-pair">
        <div class="label">Email : {{ $colis->client->email }}</div>
        <div class="label">
            Agence :
            @foreach($colis->client->agences as $agence)
                {{ $agence->nom ?? 'N/A' }} ({{ $agence->pays ?? 'N/A' }})
            @endforeach
        </div>
    </div>

    {{-- Section Signature --}}
    <div class="section-title">Signatures</div>
    {{-- <div class="row signature-zone">
        <div class="col-md-3">
             <p class="mb-1">Client</p>
             <div class="signature-line">Signature</div>
        </div>
        <div class="col-md-3">
             <p class="mb-1">Caissier</p>
             {{ Auth::user()->name }} {{ Auth::user()->prenom }}
             <div class="signature-line">Signature</div>
        </div>
    </div> --}}
    <div class="row signature-zone">
        <div class="col-6 text-center">
            <p class="mb-2"><strong>Client</strong></p>
            <div style="height: 40px;"></div> <!-- espace pour signature -->
            <div class="signature-line">Signature</div>
        </div>

        <div class="col-6 text-center">
            <p class="mb-2"><strong>Caissier</strong></p>
            
            <div style="height: 40px;"></div>
            <div class="signature-line"><p>{{ auth()->user()->name }} {{ auth()->user()->prenom }}</p></div>
        </div>
    </div>
    @php
        $agence = auth()->user()->agences->first();
    @endphp

    <p class="mt-2 text-end">
        {{ $agence->ville ?? 'Ville inconnue' }},
        le {{ now()->format('d/m/Y à H:i') }}
    </p>

    <div class="row">
        <div class="col-md-3">
            <h6 class="fw-bold text-primary">RDC - Kinshasa</h6>
            <p>
                📍 33 Av Force publique, Direction<br>
                Gambela C/ KASA VUBU<br>
                ☎️ +243 893 330 999 / +243 812 715 826
            </p>
            
        </div>
        <div class="col-md-3">
            <h6 class="fw-bold text-success">Bénin - Cotonou</h6>
            <p>
                Chez Patrick ETINA<br>
                📍 Situé en face Nouvelle Pharmacie ADECHINA<br>
                ☎️ +229 019 696 4338<br>
                ✉️ patricketina20@gmail.com
            </p>
        </div>
    </div>
    {{-- <p class="small text-center">Envoyez vos colis par tout en RD Congo en toute sécurité et honnêteté</p> --}}


    {{-- Boutons --}}
    <div class="text-center no-print mt-5">
        <button class="btn btn-primary" onclick="window.print()">Imprimer</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Retour</a>
    </div>

</body>
</html>
