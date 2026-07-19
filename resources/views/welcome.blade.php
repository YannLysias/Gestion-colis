<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>MSCJ KIN — Colis &amp; Transfert d'argent entre Cotonou et Kinshasa</title>
    <link rel="icon" href="/Authentification/img/Rapide service.jpg">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="MSCJ KIN — Envoi de colis et transfert d'argent sécurisé entre le Bénin et la R.D. Congo.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --navy: #0F2545;
            --navy-light: #1B3A66;
            --gold: #E8A33D;
            --gold-light: #f5c37a;
            --cream: #F7F5F0;
            --green: #1B8A5A;
            --text: #2B3542;
            --muted: #6b7686;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text);
            background: var(--cream);
        }

        h1, h2, h3, .brand-font {
            font-family: 'Space Grotesk', sans-serif;
        }

        .mono { font-family: 'JetBrains Mono', monospace; }

        a { text-decoration: none; }

        img { max-width: 100%; display: block; }

        /* ===== TOPBAR ===== */
        .topbar {
            background: var(--navy);
            color: #cdd8ea;
            font-size: 13px;
            padding: 8px 5%;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 8px;
        }

        .topbar a { color: #cdd8ea; }
        .topbar span { display: inline-flex; align-items: center; gap: 6px; margin-right: 18px; }
        .topbar i { color: var(--gold); }

        /* ===== NAVBAR ===== */
        .navbar-mscj {
            background: #fff;
            padding: 14px 5%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 12px rgba(15,37,69,0.06);
        }

        .navbar-mscj .logo-img { height: 48px; width: auto; }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 32px;
            list-style: none;
        }

        .nav-links a {
            color: var(--text);
            font-weight: 500;
            font-size: 14.5px;
            position: relative;
        }

        .nav-links a::after {
            content: "";
            position: absolute;
            left: 0; bottom: -6px;
            width: 0; height: 2px;
            background: var(--gold);
            transition: width 0.25s ease;
        }

        .nav-links a:hover::after,
        .nav-links a.active::after { width: 100%; }

        .btn-nav-cta {
            background: var(--gold);
            color: var(--navy);
            font-weight: 600;
            padding: 10px 22px;
            border-radius: 100px;
            font-size: 14px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-nav-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(232,163,61,0.35);
            color: var(--navy);
        }

        .navbar-toggler-mscj {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: var(--navy);
        }

        /* ===== HERO ===== */
        .hero {
            background: linear-gradient(160deg, var(--navy) 0%, var(--navy-light) 55%, #24467d 100%);
            color: #fff;
            padding: 80px 5% 60px;
            position: relative;
            overflow: hidden;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 50px;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(232,163,61,0.15);
            border: 1px solid rgba(232,163,61,0.4);
            color: var(--gold-light);
            padding: 6px 16px;
            border-radius: 100px;
            font-size: 12.5px;
            font-weight: 600;
            letter-spacing: 0.4px;
            margin-bottom: 22px;
        }

        .hero h1 {
            font-size: clamp(32px, 4.2vw, 50px);
            line-height: 1.15;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .hero h1 .accent { color: var(--gold); }

        .hero p.lead {
            font-size: 17px;
            color: #cdd8ea;
            max-width: 480px;
            margin-bottom: 32px;
            line-height: 1.65;
        }

        .hero-ctas { display: flex; gap: 14px; flex-wrap: wrap; margin-bottom: 40px; }

        .btn-hero-primary {
            background: var(--gold);
            color: var(--navy);
            font-weight: 600;
            padding: 14px 28px;
            border-radius: 100px;
            font-size: 14.5px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: transform 0.2s ease;
        }

        .btn-hero-primary:hover { transform: translateY(-2px); color: var(--navy); }

        .btn-hero-secondary {
            border: 1.5px solid rgba(255,255,255,0.35);
            color: #fff;
            font-weight: 600;
            padding: 14px 28px;
            border-radius: 100px;
            font-size: 14.5px;
            transition: background 0.2s ease;
        }

        .btn-hero-secondary:hover { background: rgba(255,255,255,0.08); color: #fff; }

        /* ROUTE — signature visual */
        .route-card {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.14);
            border-radius: 18px;
            padding: 32px 24px 26px;
            backdrop-filter: blur(6px);
        }

        .route-track {
            position: relative;
            height: 6px;
            background: rgba(255,255,255,0.15);
            border-radius: 6px;
            margin: 34px 6px 14px;
        }

        .route-track .dash-line {
            position: absolute;
            top: 50%; left: 0;
            width: 100%; height: 2px;
            transform: translateY(-50%);
            background-image: linear-gradient(to right, var(--gold) 55%, transparent 0%);
            background-position: left center;
            background-size: 14px 2px;
            background-repeat: repeat-x;
        }

        .route-track .node {
            position: absolute;
            top: 50%;
            width: 16px; height: 16px;
            background: var(--gold);
            border: 3px solid var(--navy-light);
            border-radius: 50%;
            transform: translate(-50%, -50%);
        }

        .route-track .node.start { left: 0; }
        .route-track .node.end { left: 100%; }

        .route-track .traveler {
            position: absolute;
            top: 50%;
            width: 22px; height: 22px;
            background: #fff;
            border-radius: 50%;
            transform: translate(-50%, -50%);
            display: flex; align-items: center; justify-content: center;
            font-size: 11px;
            color: var(--navy);
            animation: travel 4.5s ease-in-out infinite;
            box-shadow: 0 0 0 6px rgba(255,255,255,0.12);
        }

        @keyframes travel {
            0%   { left: 0%; }
            45%  { left: 100%; }
            50%  { left: 100%; }
            95%  { left: 0%; }
            100% { left: 0%; }
        }

        .route-cities {
            display: flex;
            justify-content: space-between;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 600;
            font-size: 15px;
            margin-top: 6px;
        }

        .route-cities .city-sub {
            display: block;
            font-family: 'Inter', sans-serif;
            font-weight: 400;
            font-size: 11.5px;
            color: #b9c6de;
            margin-top: 2px;
        }

        .route-track-ref {
            margin-top: 26px;
            background: rgba(0,0,0,0.2);
            border-radius: 10px;
            padding: 12px 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: #b9c6de;
        }

        .route-track-ref .mono { color: var(--gold-light); font-size: 13px; }

        @media (prefers-reduced-motion: reduce) {
            .traveler { animation: none; left: 50% !important; }
        }

        /* ===== SERVICES ===== */
        .services {
            max-width: 1200px;
            margin: -46px auto 0;
            padding: 0 5% 70px;
            position: relative;
            z-index: 5;
        }

        .services-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .service-card {
            background: #fff;
            border-radius: 16px;
            padding: 32px 28px;
            box-shadow: 0 12px 30px rgba(15,37,69,0.10);
            border: 1px solid #eceff4;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .service-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 36px rgba(15,37,69,0.14);
        }

        .service-icon {
            width: 52px; height: 52px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px;
            margin-bottom: 18px;
        }

        .service-card.colis .service-icon { background: #eaf1ff; color: var(--navy-light); }
        .service-card.transfert .service-icon { background: #fdf1de; color: var(--gold); }

        .service-card h3 { font-size: 20px; margin-bottom: 10px; }
        .service-card p { color: var(--muted); font-size: 14.5px; line-height: 1.6; margin-bottom: 18px; }

        .service-link {
            font-weight: 600;
            font-size: 14px;
            color: var(--navy);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .service-card.transfert .service-link { color: var(--gold); }

        /* ===== ABOUT ===== */
        .about-section {
            background: #fff;
            padding: 80px 5%;
        }

        .about-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 0.85fr 1.15fr;
            gap: 60px;
            align-items: center;
        }

        .about-image-wrap {
            position: relative;
            border-radius: 18px;
            overflow: hidden;
            min-height: 380px;
        }

        .about-image-wrap img {
            width: 100%; height: 100%;
            object-fit: cover;
            position: absolute; inset: 0;
        }

        .about-eyebrow {
            display: inline-block;
            color: var(--gold);
            font-weight: 700;
            font-size: 12.5px;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .about-text h2 {
            font-size: clamp(26px, 3vw, 34px);
            margin-bottom: 20px;
            color: var(--navy);
        }

        .about-text p {
            color: var(--muted);
            font-size: 15px;
            line-height: 1.75;
            margin-bottom: 16px;
        }

        .about-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 22px 0 26px;
        }

        .about-badge {
            background: var(--cream);
            border: 1px solid #ece7db;
            color: var(--navy);
            font-size: 12.5px;
            font-weight: 600;
            padding: 8px 14px;
            border-radius: 100px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .about-badge i { color: var(--green); }

        .btn-about {
            background: var(--navy);
            color: #fff;
            font-weight: 600;
            padding: 13px 26px;
            border-radius: 100px;
            font-size: 14px;
            display: inline-block;
        }

        .btn-about:hover { background: var(--navy-light); color: #fff; }

        /* ===== FOOTER ===== */
        .footer-mscj {
            background: var(--navy);
            color: #cdd8ea;
            padding: 56px 5% 0;
        }

        .footer-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1.3fr 1fr 1fr;
            gap: 40px;
            padding-bottom: 40px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .footer-mscj h5 {
            color: #fff;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 15px;
            margin-bottom: 16px;
        }

        .footer-mscj p, .footer-mscj a {
            color: #b9c6de;
            font-size: 13.5px;
            line-height: 1.9;
        }

        .footer-city-flag { font-size: 15px; margin-right: 6px; }

        .footer-bottom {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 0;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
            font-size: 12.5px;
            color: #93a2bc;
        }

        .back-to-top-mscj {
            position: fixed;
            bottom: 24px; right: 24px;
            width: 46px; height: 46px;
            background: var(--gold);
            color: var(--navy);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 8px 20px rgba(232,163,61,0.4);
            font-size: 18px;
            z-index: 200;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 991px) {
            .hero-grid { grid-template-columns: 1fr; }
            .services-grid { grid-template-columns: 1fr; }
            .about-grid { grid-template-columns: 1fr; }
            .about-image-wrap { min-height: 260px; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 767px) {
            .nav-links { display: none; }
            .navbar-toggler-mscj { display: block; }
            .footer-grid { grid-template-columns: 1fr; }
            .topbar { font-size: 11.5px; }
        }
    </style>
</head>

<body>

    <!-- Topbar -->
    <div class="topbar">
        <div>
            <span><i class="fa fa-envelope-open"></i> mscjkin@gmail.com</span>
        </div>
        <div>
            <span><i class="fa fa-phone-alt"></i> +229 01 0000 0000</span>
            <span><i class="fa fa-phone-alt"></i> +243 000 000 000</span>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar-mscj">
        <a href="#" class="d-flex align-items-center">
            <img src="/Authentification/img/logoMSCJ.jpeg" alt="MSCJ KIN" class="logo-img">
        </a>
        <ul class="nav-links">
            <li><a href="#" class="active">Accueil</a></li>
            <li><a href="#about">À propos</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
        <a href="/dashboard" class="btn-nav-cta">Tableau de bord</a>
        <button class="navbar-toggler-mscj"><i class="fa fa-bars"></i></button>
    </nav>

    <!-- Hero -->
    <section class="hero">
        <div class="hero-grid">
            <div>
                <span class="hero-eyebrow"><i class="bi bi-shield-check"></i> Confiance &amp; traçabilité</span>
                <h1>Vos colis et votre argent voyagent <span class="accent">entre Cotonou et Kinshasa</span> en toute confiance</h1>
                <p class="lead">MSCJ KIN connecte le Bénin et la R.D. Congo : expédiez un colis ou transférez de l'argent à vos proches, avec un suivi clair à chaque étape — même en zone rurale.</p>
                <div class="hero-ctas">
                    <a href="/dashboard" class="btn-hero-primary"><i class="bi bi-box-seam"></i> Envoyer un colis</a>
                    <a href="/dashboard" class="btn-hero-secondary"><i class="bi bi-cash-coin"></i> Transférer de l'argent</a>
                </div>
            </div>

            <div class="route-card">
                <div class="route-cities">
                    <div>🇧🇯 Cotonou<span class="city-sub">Agence d'expédition</span></div>
                    <div style="text-align:right;">🇨🇩 Kinshasa<span class="city-sub">Agence de réception</span></div>
                </div>
                <div class="route-track">
                    <div class="dash-line"></div>
                    <div class="node start"></div>
                    <div class="node end"></div>
                    <div class="traveler"><i class="bi bi-send"></i></div>
                </div>
                <div class="route-track-ref">
                    <span>Numéro de suivi</span>
                    <span class="mono">MSCJ-2026-0417</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Services -->
    <section class="services" id="services">
        <div class="services-grid">
            <div class="service-card colis">
                <div class="service-icon"><i class="bi bi-box-seam"></i></div>
                <h3>Envoi de colis</h3>
                <p>Confiez vos colis à un réseau d'agences partenaires entre le Bénin et la R.D. Congo. Chaque envoi est enregistré, pesé et suivi jusqu'à sa remise.</p>
                <a href="/dashboard" class="service-link">Expédier un colis <i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="service-card transfert">
                <div class="service-icon"><i class="bi bi-cash-coin"></i></div>
                <h3>Transfert d'argent</h3>
                <p>Envoyez de l'argent à vos proches ou partenaires professionnels rapidement, avec un numéro de contrôle unique et un reçu vérifiable à chaque transaction.</p>
                <a href="/dashboard" class="service-link">Transférer de l'argent <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </section>

    <!-- About -->
    <section class="about-section" id="about">
        <div class="about-grid">
            <div class="about-image-wrap">
                <img src="/Acceuil/img/transport-colis.jpg" alt="Transport de colis MSCJ KIN">
            </div>
            <div class="about-text">
                <span class="about-eyebrow">À propos de MSCJ KIN</span>
                <h2>Moderniser la logistique et le transfert d'argent entre le Bénin et la R.D. Congo</h2>
                <p>MSCJ KIN est une plateforme web dédiée à la gestion des colis et des transferts d'argent, simple, rapide et sécurisée. Née de la volonté de moderniser les services logistiques et financiers, elle permet d'envoyer, suivre et recevoir colis et fonds entre le Bénin et la R.D. Congo, à tout moment.</p>
                <p>Grâce à une interface conviviale et des outils performants, la plateforme offre une expérience fluide aussi bien pour les particuliers que pour les professionnels, en s'appuyant sur un réseau d'agences partenaires.</p>
                <p>Notre mission : rendre les services d'expédition et de transfert accessibles à tous, en particulier dans les zones où les solutions traditionnelles sont limitées.</p>
                <div class="about-badges">
                    <span class="about-badge"><i class="bi bi-check-circle-fill"></i> Suivi en temps réel</span>
                    <span class="about-badge"><i class="bi bi-check-circle-fill"></i> Reçus vérifiables</span>
                    <span class="about-badge"><i class="bi bi-check-circle-fill"></i> Réseau d'agences partenaires</span>
                </div>
                <a href="#" class="btn-about">Découvrir nos agences</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-mscj" id="contact">
        <div class="footer-grid">
            <div>
                <h5>MSCJ KIN</h5>
                <p>Plateforme d'envoi de colis et de transfert d'argent entre le Bénin et la R.D. Congo.</p>
                <p style="margin-top:12px;"><i class="fa fa-envelope-open" style="color:var(--gold);"></i> mscjkin@gmail.com</p>
            </div>
            <div>
                <h5><span class="footer-city-flag">🇧🇯</span> Bénin — Cotonou</h5>
                <p>Adresse : Cotonou</p>
                <p>☎️ +229 01 0000 0000</p>
            </div>
            <div>
                <h5><span class="footer-city-flag">🇨🇩</span> R.D. Congo — Kinshasa</h5>
                <p>Adresse : Kinshasa, C/ Kasa Vubu</p>
                <p>☎️ +243 000 000 000</p>
            </div>
        </div>
        <div class="footer-bottom">
            <div>&copy; 2026 MSCJ KIN. Tous droits réservés.</div>
            <div>Conçu pour connecter le Bénin et la R.D. Congo</div>
        </div>
    </footer>

    <a href="#" class="back-to-top-mscj"><i class="bi bi-arrow-up"></i></a>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
