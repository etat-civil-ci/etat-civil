@extends('layouts.app')
@section('content')

@extends('layouts.sidebar')
@section('sidebar')
<div class="col-lg-8 col-xl-9 ps-lg-4 ps-xl-6">
    <!-- Title and offcanvas button -->
    <div class="d-flex justify-content-between align-items-center mb-5 mb-sm-6">
        <!-- Title -->
        <h1 class="h3 mb-0">Liste acte naissance</h1>

        <!-- Advanced filter responsive toggler START -->
        <button class="btn btn-primary d-lg-none flex-shrink-0 ms-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
            <i class="fas fa-sliders-h"></i> Menu
        </button>
        <!-- Advanced filter responsive toggler END -->
    </div>

    <!-- Search and buttons -->
    <div class="row g-3 align-items-center mb-5">
        <!-- Search -->
        <div class="col-xl-5">
            <form class="rounded position-relative" method="GET" action="{{ route('listeactenaissance') }}">
                <input class="form-control pe-5" type="search" name="search" placeholder="Search" aria-label="Search" value="{{ request('search') }}">
                <button class="btn border-0 px-3 py-0 position-absolute top-50 end-0 translate-middle-y" type="submit"><i class="fas fa-search fs-6"></i></button>
            </form>
        </div>

        <!-- Select option -->
        <div class="col-sm-6 col-xl-3 ms-auto">
            <!-- Short by filter -->
            <form method="GET" action="{{ route('listeactenaissance') }}">
                <select class="form-select js-choice" name="sort" onchange="this.form.submit()" aria-label=".form-select-sm">
                    <option value="numero_acte" {{ request('sort') == 'numero_acte' ? 'selected' : '' }}>Par numéro</option>
                    <option value="date_acte_desc" {{ request('sort') == 'date_acte_desc' ? 'selected' : '' }}>Date récente</option>
                    <option value="date_acte_asc" {{ request('sort') == 'date_acte_asc' ? 'selected' : '' }}>Date ancienne</option>
                    <option value="statut" {{ request('sort') == 'statut' ? 'selected' : '' }}>Par statut</option>
                </select>
            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="table-responsive border-0">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <table class="table align-middle p-4 mb-0 table-hover">
            <!-- Table head -->
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="border-0 text-white rounded-start">N° Registre</th>
                    <th scope="col" class="border-0 text-white">Nom Enfant</th>
                    <th scope="col" class="border-0 text-white">Prénom Enfant</th>
                    <th scope="col" class="border-0 text-white">Date Acte</th>
                    <th scope="col" class="border-0 text-white">Statut</th>
                    <th scope="col" class="border-0 text-white rounded-end">Action</th>
                </tr>
            </thead>
        
            <tbody>
                @forelse($actesNaissance as $acte)
                <tr>
                    <td>{{ $acte->numero_acte }}</td>
                    <td>{{ $acte->nom_enfant }}</td>
                    <td>{{ $acte->prenom_enfant }}</td>
                    <td>{{ $acte->date_acte->format('d-m-Y') }}</td>
                    <td>
                        @if($acte->statut == 'succès')
                            <span class="badge bg-success">Validé</span>
                        @elseif($acte->statut == 'échec')
                            <span class="badge bg-danger">Rejeté</span>
                        @else
                            <span class="badge bg-warning">En attente</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('actenaissance.show', $acte->id) }}" class="btn btn-sm btn-primary" title="Voir">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('actenaissance.edit', $acte->id) }}" class="btn btn-sm btn-info" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('actenaissance.destroy', $acte->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet acte?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Aucun acte de naissance trouvé</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $actesNaissance->links() }}
        </div>
    </div>
</div>
@stop