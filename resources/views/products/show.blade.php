@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ __('Détails du produit') }}</h5>
                    <a href="{{ route('products.index') }}" class="text-secondary text-decoration-none">Retour à la liste</a>
                </div>

                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <h2 class="fw-bold mb-3">{{ $product->name }}</h2>
                            <hr class="my-4">
                            <div class="row g-4">
                                <div class="col-6">
                                    <p class="text-secondary mb-1">Catégorie</p>
                                    <p class="fw-bold fs-5"><span class="badge bg-light text-dark border">{{ $product->category->name }}</span></p>
                                </div>
                                <div class="col-6">
                                    <p class="text-secondary mb-1">Prix unitaire</p>
                                    <p class="fw-bold fs-5 text-primary">{{ number_format($product->price, 2) }} DH</p>
                                </div>
                                <div class="col-6">
                                    <p class="text-secondary mb-1">Stock disponible</p>
                                    <p class="fw-bold fs-5">
                                        <span class="badge {{ $product->quantity > 5 ? 'bg-success' : 'bg-warning' }} rounded-pill">
                                            {{ $product->quantity }} unités
                                        </span>
                                    </p>
                                </div>
                                <div class="col-6">
                                    <p class="text-secondary mb-1">Date d'ajout</p>
                                    <p class="fw-bold fs-5">{{ $product->created_at->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 d-flex justify-content-end">
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-info rounded-pill px-4 me-2">Modifier</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger rounded-pill px-4" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
