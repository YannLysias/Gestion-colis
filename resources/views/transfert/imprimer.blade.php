<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Reçu d'Expédition - Agence MSCJ KIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #1a3c6e;
            --accent: #ff7a00;
            --success: #16a34a;
            --gray-bg: #f4f6f9;
            --border-soft: #e2e6ec;
        }

        * { box-sizing: border-box; }

        html {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            color-adjust: exact;
        }

        @page {
            size: A4;
            margin: 8mm;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: var(--gray-bg);
            color: #1f2733;
            font-size: 13px;
            margin: 0;
            padding: 0;
        }

        .receipt-wrapper {
            max-width: 820px;
            margin: 30px auto;
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        /* HEADER */
        .receipt-header {
            background: linear-gradient(135deg, var(--primary), #1a3c6e);
            color: #fff;
            padding: 28px 35px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .receipt-header .logo-block {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .receipt-header img.logo {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            background: #fff;
            padding: 4px;
            object-fit: contain;
        }

        .receipt-header .company-name {
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin: 0;
        }

        .receipt-header .tagline {
            font-size: 11px;
            opacity: 0.85;
            margin: 0;
        }

        .receipt-header .transfert-code { text-align: right; }

        .receipt-header .transfert-code .code {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .receipt-header .transfert-code .code-label {
            font-size: 10px;
            text-transform: uppercase;
            opacity: 0.8;
            letter-spacing: 1px;
        }
        .doc-title {
            text-align: center;
            background: #fff;
            color: var(--primary);
            font-size: 15px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            padding: 12px 20px 4px 20px;
        }


        /* STATUS BAND */
        .status-band {
            background: #fdf3e0;
            border-bottom: 1px solid var(--border-soft);
            padding: 12px 35px;
            display: flex;
            justify-content: space-between;
            font-size: 12px;
        }

        .status-band .badge-statut {
            background: var(--accent);
            color: #fff;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 11px;
            text-transform: uppercase;
        }

        .status-band .badge-statut.valide { background: var(--success); }

        /* BODY */
        .receipt-body { padding: 30px 35px; }

        .section-title {
            font-weight: 700;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.8px;
            color: var(--primary);
            margin-top: 26px;
            margin-bottom: 14px;
            padding-bottom: 8px;
            border-bottom: 2px solid var(--border-soft);
            position: relative;
        }

        .section-title::after {
            content: "";
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 45px;
            height: 2px;
            background: var(--accent);
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px 24px;
        }

        .info-item {
            background: var(--gray-bg);
            border: 1px solid var(--border-soft);
            border-radius: 8px;
            padding: 10px 14px;
        }

        .info-item .label {
            display: block;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            color: #6b7686;
            margin-bottom: 3px;
        }

        .info-item .value {
            font-weight: 600;
            font-size: 13.5px;
            color: #1f2733;
        }

        .amount-highlight {
            background: linear-gradient(135deg, #f1e9ff, #f9f6ff);
            border: 1px solid #ddc9fb;
        }

        .amount-highlight .value { color: var(--primary); font-size: 16px; }

        .amount-highlight.recevoir {
            background: linear-gradient(135deg, #e8f8ee, #f4fdf7);
            border: 1px solid #bfe9cd;
        }

        .amount-highlight.recevoir .value { color: var(--success); }

        /* SIGNATURES */
        .signature-zone {
            margin-top: 45px;
            display: flex;
            gap: 30px;
        }

        .signature-box { flex: 1; text-align: center; }

        .signature-box p.role {
            font-weight: 700;
            margin-bottom: 45px;
            color: var(--primary);
        }

        .signature-line {
            border-top: 1px solid #b8c0cc;
            padding-top: 6px;
            font-size: 12px;
            color: #4a5567;
        }

        /* FOOTER */
        .receipt-footer {
            background: var(--gray-bg);
            border-top: 1px solid var(--border-soft);
            padding: 22px 35px;
        }

        .agence-block h6 { font-weight: 700; margin-bottom: 6px; font-size: 13px; }

        .agence-block p {
            font-size: 11.5px;
            color: #4a5567;
            line-height: 1.6;
            margin: 0;
        }

        .qr-block {
            border-left: 1px dashed #c3badd;
            border-right: 1px dashed #c3badd;
        }

        .qr-block .qr-code {
            width: 90px;
            height: 90px;
            padding: 4px;
            background: #fff;
            border: 1px solid var(--border-soft);
            border-radius: 8px;
        }

        .qr-block .qr-caption {
            font-size: 9.5px;
            color: #6b7686;
            margin: 6px 0 0 0;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .date-line {
            text-align: right;
            font-size: 12px;
            color: #6b7686;
            font-style: italic;
            margin-bottom: 10px;
        }

        .buttons-bar { text-align: center; padding: 25px; }

        /* IMPRESSION : 1 page A4, couleurs conservées */
        @media print {
            html, body {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                color-adjust: exact !important;
                background: #fff;
                font-size: 11px;
            }

            .no-print { display: none; }

            .receipt-wrapper {
                box-shadow: none !important;
                margin: 0 !important;
                border-radius: 0 !important;
                max-width: 100% !important;
                width: 100%;
            }

            .receipt-header { padding: 14px 20px !important; }
            .receipt-header .logo-block img.logo { width: 45px; height: 45px; }
            .receipt-header .company-name { font-size: 15px; }
            .receipt-header .transfert-code .code { font-size: 16px; }

            .status-band { padding: 8px 20px !important; }
            .doc-title { padding: 6px 20px 2px 20px !important; font-size: 12px !important; }
            .receipt-body { padding: 12px 20px !important; }

            .section-title {
                margin-top: 12px !important;
                margin-bottom: 8px !important;
                padding-bottom: 4px !important;
                font-size: 11px;
            }

            .info-grid { gap: 6px 16px !important; }
            .info-item { padding: 6px 10px !important; }
            .info-item .label { font-size: 9px; margin-bottom: 1px; }
            .info-item .value { font-size: 11.5px; }
            .amount-highlight .value { font-size: 13px; }

            .signature-zone { margin-top: 22px !important; gap: 20px !important; }
            .signature-box p.role { margin-bottom: 20px !important; }

            .receipt-footer { padding: 10px 20px !important; }
            .agence-block p { font-size: 10px; line-height: 1.4; }
            .agence-block h6 { font-size: 11.5px; margin-bottom: 3px; }

            .qr-block .qr-code { width: 65px; height: 65px; }
            .qr-block .qr-caption { font-size: 8px; margin-top: 3px; }

            .date-line { margin-bottom: 4px !important; }

            .receipt-wrapper, .receipt-body, .info-grid, .signature-zone {
                page-break-inside: avoid;
                break-inside: avoid;
            }
        }
    </style>
</head>
<body>

    <div class="receipt-wrapper">

        {{-- HEADER --}}
        <div class="receipt-header">
            <div class="logo-block">
                <img src="/Authentification/img/logoMSCJ.jpeg" alt="Logo" class="logo">
                <div>
                    <p class="company-name">Agence MSCJ KIN</p>
                    <p class="tagline">Maison Sacré Coeur de Jésus</p>
                </div>
            </div>
            <div class="transfert-code">
                <div class="code-label">N° de contrôle</div>
                <div class="code">{{ $transfert->numero_de_controle }}</div>
            </div>
        </div>

        {{-- TITRE DU DOCUMENT --}}
        <div class="doc-title">Reçu de Transfert d'Argent</div>

        {{-- STATUS BAND --}}
        <div class="status-band">
            <div>Date d'émission : <strong>{{ $transfert->created_at->format('d/m/Y') }}</strong></div>
            <div class="badge-statut {{ $transfert->statut === 'Validé' ? 'valide' : '' }}">
                {{ ucfirst(str_replace('_', ' ', $transfert->statut)) }}
            </div>
        </div>

        <div class="receipt-body">

            {{-- INFOS GENERALES --}}
            <div class="section-title">Informations Générales</div>
            <div class="info-grid">
                <div class="info-item amount-highlight">
                    <span class="label">Montant envoyé</span>
                    <span class="value">{{ number_format($transfert->montant_a_envoyer, 0, ',', ' ') }} $</span>
                </div>
                <div class="info-item amount-highlight recevoir">
                    <span class="label">Montant à recevoir</span>
                    <span class="value">{{ number_format($transfert->montant_a_recevoir, 0, ',', ' ') }} $</span>
                </div>
                <div class="info-item">
                    <span class="label">Frais</span>
                    <span class="value">{{ number_format($transfert->taxe, 0, ',', ' ') }} $</span>
                </div>
                <div class="info-item">
                    <span class="label">Motif</span>
                    <span class="value">{{ $transfert->motif_du_transfert }}</span>
                </div>
            </div>

            {{-- DESTINATAIRE --}}
            <div class="section-title">Destinataire</div>
            <div class="info-grid">
                <div class="info-item">
                    <span class="label">Nom complet</span>
                    <span class="value">{{ $transfert->destinateur_nom }} {{ $transfert->destinateur_prenom }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Téléphone</span>
                    <span class="value">{{ $transfert->destinateur_telephone }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Email</span>
                    <span class="value">{{ $transfert->destinateur_email }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Agence de réception</span>
                    <span class="value">{{ $transfert->AgenceTransfert->nom ?? 'N/A' }} ({{ $transfert->AgenceTransfert->pays ?? 'N/A' }})</span>
                </div>
            </div>

            {{-- EXPEDITEUR --}}
            <div class="section-title">Expéditeur</div>
            <div class="info-grid">
                <div class="info-item">
                    <span class="label">Nom complet</span>
                    <span class="value">{{ $transfert->client->name }} {{ $transfert->client->prenom }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Téléphone</span>
                    <span class="value">{{ $transfert->client->telephone }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Email</span>
                    <span class="value">{{ $transfert->client->email }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Secrétaire</span>
                    <span class="value">{{ $transfert->user->name }} {{ $transfert->user->prenom }}</span>
                </div>
                @foreach($transfert->user->agences as $agence)
                <div class="info-item">
                    <span class="label">Agence d'expédition</span>
                    <span class="value">{{ $agence->nom ?? 'N/A' }} ({{ $agence->pays ?? 'N/A' }})</span>
                </div>
                @endforeach
            </div>

            {{-- SIGNATURES --}}
            <div class="section-title">Signatures</div>
            <div class="signature-zone">
                <div class="signature-box">
                    <p class="role">Client</p>
                    <div class="signature-line">Signature</div>
                </div>
                <div class="signature-box">
                    <p class="role">Secrétaire</p>
                    <div class="signature-line">{{ $transfert->user->name }} {{ $transfert->user->prenom }}</div>
                </div>
            </div>

            <p class="date-line mt-4">
                Fait à {{ $agence->ville ?? 'Ville inconnue' }}, le {{ now()->format('d/m/Y à H:i') }}
            </p>
        </div>

        {{-- FOOTER --}}
        <div class="receipt-footer">
            <div class="row align-items-center">
                <div class="col-4 agence-block">
                    <h6 class="text-primary">RDC - Kinshasa</h6>
                    <p>
                        📍 C/bandalungwa Q/ sikine 33, av : maduda<br>
                        ☎️ +243 892 568 961<br>
                        ✉️ mscjkin@gmail.com
                    </p>
                </div>

                <div class="col-4 qr-block text-center">
                    <img class="qr-code"
                         src="https://api.qrserver.com/v1/create-qr-code/?size=140x140&margin=0&data={{ urlencode($transfert->numero_de_controle) }}"
                         alt="QR Code Transfert {{ $transfert->numero_de_controle }}">
                    <p class="qr-caption">Scanner pour vérifier le transfert</p>
                </div>

                <div class="col-4 agence-block">
                    <h6 style="color: var(--success);">Bénin - Cotonou</h6>
                    <p>
                        📍 Marché DANTOKPA, devant le caniveau<br>
                        ☎️ +229 01 96 00 15 50<br>
                        ✉️ mscjkin@gmail.com
                    </p>
                </div>
            </div>
        </div>

        {{-- BOUTONS --}}
        <div class="buttons-bar no-print">
            <button class="btn btn-primary px-4" onclick="window.print()">🖨️ Imprimer</button>
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary px-4">← Retour</a>
        </div>

    </div>

</body>
</html>
