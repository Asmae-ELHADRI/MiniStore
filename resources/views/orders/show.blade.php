@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ __('Détails de la commande') }} #{{ $order->id }}</h5>
                    <a href="{{ route('orders.index') }}" class="text-secondary text-decoration-none">Retour à la liste</a>
                </div>

                <div class="card-body">
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <h6 class="text-secondary mb-3">Informations Client</h6>
                            <p class="mb-1 fw-bold fs-5">{{ $order->client->name }}</p>
                            <p class="mb-1 text-secondary text-decoration-none">{{ $order->client->email }}</p>
                            <p class="mb-1 text-secondary text-decoration-none">{{ $order->client->phone ?? 'Pas de téléphone' }}</p>
                            <p class="text-secondary text-decoration-none">{{ $order->client->address ?? 'Pas d\'adresse' }}</p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <h6 class="text-secondary mb-3">Détails de la commande</h6>
                            <p class="mb-1">Statut: <span class="badge bg-success rounded-pill">{{ ucfirst($order->status) }}</span></p>
                            <p class="mb-1">Date: {{ $order->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <h6 class="fw-bold mb-3">Produits commandés</h6>
                    <div class="table-responsive mb-4">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Produit</th>
                                    <th class="text-center">Prix unitaire</th>
                                    <th class="text-center">Quantité</th>
                                    <th class="text-end">Sous-total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->products as $product)
                                    <tr>
                                        <td class="fw-bold">{{ $product->name }}</td>
                                        <td class="text-center">{{ number_format($product->pivot->price, 2) }} DH</td>
                                        <td class="text-center">{{ $product->pivot->quantity }}</td>
                                        <td class="text-end fw-bold">{{ number_format($product->pivot->price * $product->pivot->quantity, 2) }} DH</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="border-top">
                                    <td colspan="3" class="text-end fw-bold fs-5 pt-3">Total</td>
                                    <td class="text-end fw-bold fs-5 text-primary pt-3">{{ number_format($order->total_price, 2) }} DH</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
