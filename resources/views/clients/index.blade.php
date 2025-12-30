@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm hover-elevate">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ __('Clients') }}</h5>
                    <a href="{{ route('clients.create') }}" class="btn btn-primary btn-sm rounded-pill px-3">
                        <i class="fas fa-plus mr-1"></i> Ajouter un client
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
                                    <th class="border-0">Email</th>
                                    <th class="border-0">Téléphone</th>
                                    <th class="border-0 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($clients as $client)
                                    <tr>
                                        <td class="text-secondary">#{{ $client->id }}</td>
                                        <td class="fw-bold">{{ $client->name }}</td>
                                        <td>{{ $client->email }}</td>
                                        <td>{{ $client->phone ?? 'N/A' }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('clients.edit', $client) }}" class="btn btn-outline-info btn-sm rounded-pill px-3 me-1">
                                                Modifier
                                            </a>
                                            <form action="{{ route('clients.destroy', $client) }}" method="POST" class="d-inline">
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
                                        <td colspan="5" class="text-center py-4 text-secondary">Aucun client trouvé.</td>
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
