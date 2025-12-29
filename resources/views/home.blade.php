@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h2 class="mb-4 fw-bold">Tableau de bord</h2>
            
            <div class="row g-4 mb-5">
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100 text-center py-3">
                        <div class="card-body">
                            <h6 class="text-secondary mb-3">Catégories</h6>
                            <h2 class="fw-bold mb-0 text-primary">{{ $stats['categories'] }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100 text-center py-3">
                        <div class="card-body">
                            <h6 class="text-secondary mb-3">Produits</h6>
                            <h2 class="fw-bold mb-0 text-success">{{ $stats['products'] }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100 text-center py-3">
                        <div class="card-body">
                            <h6 class="text-secondary mb-3">Clients</h6>
                            <h2 class="fw-bold mb-0 text-info">{{ $stats['clients'] }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100 text-center py-3">
                        <div class="card-body">
                            <h6 class="text-secondary mb-3">Commandes</h6>
                            <h2 class="fw-bold mb-0 text-warning">{{ $stats['orders'] }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">Actions rapides</h5>
                            <div class="d-grid gap-3">
                                <a href="{{ route('orders.create') }}" class="btn btn-primary rounded-pill py-2">
                                    Nouvelle commande
                                </a>
                                <a href="{{ route('products.create') }}" class="btn btn-outline-success rounded-pill py-2">
                                    Ajouter un produit
                                </a>
                                <a href="{{ route('clients.create') }}" class="btn btn-outline-info rounded-pill py-2">
                                    Inscrire un client
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">Bienvenue, {{ Auth::user()->name }}</h5>
                            <p class="text-secondary">
                                Vous êtes connecté sur l'interface de gestion de MiniStore. Utilisez le menu de navigation ou les boutons d'accès rapide pour gérer votre activité.
                            </p>
                            <p class="text-secondary small">
                                Dernière connexion: {{ now()->format('d/m/Y H:i') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
