<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'MiniStore') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
        <!-- Styles -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        <style>
            body {
                font-family: 'Plus Jakarta Sans', sans-serif;
                background: #0f172a;
                height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0;
                overflow: hidden;
            }
            .bg-circles {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: -1;
            }
            .circle {
                position: absolute;
                border-radius: 50%;
                filter: blur(80px);
                animation: float 20s infinite alternate;
            }
            .circle-1 {
                width: 400px;
                height: 400px;
                background: rgba(99, 102, 241, 0.15);
                top: -100px;
                right: -100px;
            }
            .circle-2 {
                width: 300px;
                height: 300px;
                background: rgba(168, 85, 247, 0.15);
                bottom: -50px;
                left: -50px;
                animation-delay: -5s;
            }
            @keyframes float {
                0% { transform: translate(0, 0); }
                100% { transform: translate(50px, 50px); }
            }
            .welcome-card {
                background: rgba(255, 255, 255, 0.03);
                backdrop-filter: blur(20px);
                padding: 4rem;
                border-radius: 2.5rem;
                border: 1px solid rgba(255, 255, 255, 0.1);
                text-align: center;
                max-width: 500px;
                width: 90%;
                color: white;
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            }
            .brand-name {
                font-size: 3.5rem;
                font-weight: 800;
                letter-spacing: -0.05em;
                margin-bottom: 1rem;
                background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            .btn-welcome {
                padding: 1rem 2rem;
                font-weight: 700;
                border-radius: 1rem;
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                text-transform: uppercase;
                letter-spacing: 0.05em;
                font-size: 0.85rem;
            }
            .btn-welcome:hover {
                transform: translateY(-5px) scale(1.02);
                box-shadow: 0 15px 30px -5px rgba(99, 102, 241, 0.4);
            }
            .btn-primary-fascinating {
                background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
                border: none;
                color: white;
            }
            .btn-outline-fascinating {
                background: transparent;
                border: 2px solid rgba(255, 255, 255, 0.1);
                color: white;
            }
            .btn-outline-fascinating:hover {
                background: rgba(255, 255, 255, 0.05);
                border-color: rgba(255, 255, 255, 0.2);
            }
        </style>
    </head>
    <body>
        <div class="bg-circles">
            <div class="circle circle-1"></div>
            <div class="circle circle-2"></div>
        </div>
        
        <div class="welcome-card fade-in-up">
            <h1 class="brand-name">MiniStore</h1>
            <p class="text-light opacity-50 mb-5 fs-5">L'art de la gestion, simplifié à l'extrême.</p>

            @if (Route::has('login'))
                <div class="d-grid gap-3">
                    @auth
                        <a href="{{ url('/home') }}" class="btn btn-welcome btn-primary-fascinating">Tableau de Bord</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-welcome btn-primary-fascinating">Continuer</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-welcome btn-outline-fascinating">Créer un compte</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </body>
</html>
