@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ __('Catégories') }}</h5>
                    <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm rounded-pill px-3">
                        <i class="fas fa-plus mr-1"></i> Ajouter une catégorie
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
                                    <th class="border-0 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td class="text-secondary">#{{ $category->id }}</td>
                                        <td class="fw-bold">{{ $category->name }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-outline-info btn-sm rounded-pill px-3 me-1">
                                                Modifier
                                            </a>
                                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
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
                                        <td colspan="3" class="text-center py-4 text-secondary">Aucune catégorie trouvée.</td>
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
