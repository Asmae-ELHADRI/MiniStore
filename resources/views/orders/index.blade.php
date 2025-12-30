@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm hover-elevate">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ __('Commandes') }}</h5>
                    <a href="{{ route('orders.create') }}" class="btn btn-primary btn-sm rounded-pill px-3">
                        <i class="fas fa-plus mr-1"></i> Créer une commande
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
                                    <th class="border-0">Client</th>
                                    <th class="border-0">Total</th>
                                    <th class="border-0">Statut</th>
                                    <th class="border-0">Date</th>
                                    <th class="border-0 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td class="text-secondary">#{{ $order->id }}</td>
                                        <td class="fw-bold">{{ $order->client->name }}</td>
                                        <td>{{ number_format($order->total_price, 2) }} DH</td>
                                        <td>
                                            <span class="badge bg-success rounded-pill px-3">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td class="text-secondary">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('orders.show', $order) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                                Détails
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-secondary">Aucune commande trouvée.</td>
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
