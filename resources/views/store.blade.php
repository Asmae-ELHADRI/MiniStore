@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-5 text-center fade-in-up">
        <div class="col-lg-8 mx-auto">
            <h1 class="display-4 fw-bold mb-3" style="background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                Nos Produits Premium
            </h1>
            <p class="lead text-muted">Découvrez notre sélection exclusive de produits de haute qualité, sélectionnés pour vous.</p>
        </div>
    </div>

    <div class="row g-4">
        @forelse($products as $index => $product)
            <div class="col-md-6 col-lg-4 fade-in-up delay-{{ ($index % 5) + 1 }}">
                <div class="card h-100 hover-elevate border-0 shadow-premium overflow-hidden">
                    <div class="position-relative overflow-hidden" style="height: 240px; background: #f8fafc; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-box-open fa-5x text-indigo-soft opacity-25"></i>
                        <span class="position-absolute top-0 end-0 m-3 badge rounded-pill bg-soft-primary px-3 py-2 text-primary fw-bold">
                            {{ $product->category->name ?? 'Général' }}
                        </span>
                    </div>
                    <div class="card-body p-4">
                        <h3 class="h5 card-title fw-bold mb-2">{{ $product->name }}</h3>
                        <p class="text-muted small mb-4">Stock disponible: <span class="fw-bold text-dark">{{ $product->quantity }}</span></p>
                        
                        <div class="d-flex align-items-center justify-content-between mt-auto">
                            <span class="h4 fw-bold text-primary mb-0">{{ number_format($product->price, 2) }} DH</span>
                            <a href="{{ route('orders.create', ['product_id' => $product->id]) }}" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-shopping-cart me-2"></i>Commander
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="glass p-5 rounded-4 shadow-sm">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h3>Aucun produit disponible</h3>
                    <p class="text-muted">Revenez plus tard pour découvrir nos nouveautés !</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

<style>
.bg-soft-primary {
    background-color: rgba(99, 102, 241, 0.1);
}
.text-indigo-soft {
    color: #6366f1;
}
.shadow-premium {
    box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05);
}
</style>
@endsection
