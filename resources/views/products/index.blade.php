@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm hover-elevate">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ __('Produits') }}</h5>
                    <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm rounded-pill px-3">
                        <i class="fas fa-plus mr-1"></i> Ajouter un produit
                    </a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success border-0 shadow-sm mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light text-secondary">
                                <tr>
                                    <th class="border-0">ID</th>
                                    <th class="border-0">Nom</th>
                                    <th class="border-0">Catégorie</th>
                                    <th class="border-0">Prix</th>
                                    <th class="border-0">Quantité</th>
                                    <th class="border-0 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <td class="text-secondary">#{{ $product->id }}</td>
                                        <td class="fw-bold">{{ $product->name }}</td>
                                        <td>
                                            <span class="badge bg-light text-dark border">{{ $product->category->name }}</span>
                                        </td>
                                        <td>{{ number_format($product->price, 2) }} DH</td>
                                        <td>
                                            <span class="badge {{ $product->quantity > 5 ? 'bg-success' : 'bg-warning' }} rounded-pill">
                                                {{ $product->quantity }} en stock
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('products.show', $product) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3 me-1">
                                                Détails
                                            </a>
                                            <a href="{{ route('products.edit', $product) }}" class="btn btn-outline-info btn-sm rounded-pill px-3 me-1">
                                                Modifier
                                            </a>
                                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3" onclick="return confirm('Êtes-vous sûr ?')">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-secondary">Aucun produit trouvé.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
