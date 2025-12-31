@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">{{ __('Créer une commande') }}</h5>
                </div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger border-0 shadow-sm mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('orders.store') }}" method="POST" id="order-form">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="client_id" class="form-label fw-bold">Client (Optionnel)</label>
                            <select class="form-select @error('client_id') is-invalid @enderror" id="client_id" name="client_id">
                                <option value="" selected>Continuer en tant qu'invité</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->name }} ({{ $client->email }})</option>
                                @endforeach
                            </select>
                            @error('client_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 fw-bold">Produits</h6>
                            <button type="button" class="btn btn-outline-primary btn-sm rounded-pill" id="add-product">
                                + Ajouter un autre produit
                            </button>
                        </div>

                        <div class="table-responsive mb-4">
                            <table class="table table-borderless align-middle" id="products-table">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 60%">Produit</th>
                                        <th style="width: 30%">Quantité</th>
                                        <th style="width: 10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="product-row">
                                        <td>
                                            <select name="products[0][id]" class="form-select product-select" required>
                                                <option value="" {{ !$selectedProductId ? 'selected' : '' }} disabled>Choisir un produit</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}" 
                                                        {{ $selectedProductId == $product->id ? 'selected' : '' }}
                                                        data-stock="{{ $product->quantity }}" 
                                                        data-price="{{ $product->price }}">
                                                        {{ $product->name }} ({{ number_format($product->price, 2) }} DH)
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="products[0][quantity]" class="form-control" value="1" min="1" required>
                                        </td>
                                        <td class="text-end">
                                            <button type="button" class="btn btn-link text-danger p-0 remove-row" style="display: none;">
                                                Supprimer
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-2">
                            <a href="{{ route('home') }}" class="text-secondary text-decoration-none">Retour à la boutique</a>
                            <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
                                <i class="fas fa-check me-2"></i>Confirmer la commande
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const addBtn = document.getElementById('add-product');
    const tableBody = document.querySelector('#products-table tbody');
    let rowIdx = 1;

    addBtn.addEventListener('click', function () {
        const firstRow = document.querySelector('.product-row');
        const newRow = firstRow.cloneNode(true);
        
        // Update names
        newRow.querySelector('select').name = `products[${rowIdx}][id]`;
        newRow.querySelector('input').name = `products[${rowIdx}][quantity]`;
        newRow.querySelector('input').value = 1;
        newRow.querySelector('select').selectedIndex = 0;
        
        // Show remove button
        const removeBtn = newRow.querySelector('.remove-row');
        removeBtn.style.display = 'block';
        
        removeBtn.addEventListener('click', function() {
            newRow.remove();
        });

        tableBody.appendChild(newRow);
        rowIdx++;
    });

    // Initial remove button hidden for first row is already handled by style="display: none;"
});
</script>
@endsection
