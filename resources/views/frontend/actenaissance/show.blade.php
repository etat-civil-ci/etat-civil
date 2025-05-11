@extends('layouts.appactenaissance')

@section('content')
    @extends('layouts.sidebaractenaissance')

    @section('sidebaractenaissance')
        <div class="col-lg-8 col-xl-9 ps-lg-4 ps-xl-6">
            <div class="d-flex justify-content-between align-items-center mb-5 mb-sm-6">
                <h1 class="h3 mb-0">Détails de l'acte de naissance</h1>
                <a href="{{ route('listeactenaissance') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
                <button class="btn btn-primary d-lg-none flex-shrink-0 ms-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                    <i class="fas fa-sliders-h"></i> Menu
                </button>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                            {{-- Enfant + Administratif --}}
                            <div class="row mb-4">
                                <h5 class="border-bottom pb-2">Informations sur l'enfant et les détails administratifs</h5>
                                <div class="col-md-6">
                                    <p><strong>Numéro d'acte:</strong> {{ $acteNaissance->numero_acte }}</p>
                                    <p><strong>Nom:</strong> {{ $acteNaissance->nom_enfant }}</p>
                                    <p><strong>Prénom:</strong> {{ $acteNaissance->prenom_enfant }}</p>
                                    <p><strong>Date de naissance:</strong> {{ $acteNaissance->date_naissance->format('d/m/Y') }}</p>
                                    <p><strong>Lieu de naissance:</strong> {{ $acteNaissance->lieu_naissance }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Date d'enregistrement:</strong> {{ $acteNaissance->date_acte->format('d/m/Y') }}</p>
                                    <p><strong>Localité:</strong> {{ $acteNaissance->localite->nom }}</p>
                                    <p><strong>Statut:</strong>
                                        @if($acteNaissance->statut == 'succès')
                                            <span class="badge bg-success">Validé</span>
                                        @elseif($acteNaissance->statut == 'échec')
                                            <span class="badge bg-danger">Rejeté</span>
                                        @else
                                            <span class="badge bg-warning">En attente</span>
                                        @endif
                                    </p>
                                    <p><strong>Créé le:</strong> {{ $acteNaissance->created_at->format('d/m/Y H:i') }}</p>
                                    <p><strong>Mis à jour le:</strong> {{ $acteNaissance->updated_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>

                            @if($acteNaissance->documents)
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <h5>Documents associés</h5>
                                        @foreach(json_decode($acteNaissance->documents) as $document)
                                            <div class="mb-2">
                                                {{-- <a href="{{ asset('storage/documents/actes_naissance/'.basename($document)) }}" 
                                                target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-file-alt"></i> Document {{ $loop->iteration }}
                                                </a> --}}
                                                <a href="{{ asset('storage/' . str_replace('public/', '', $document)) }}" 
                                                    target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-file-alt"></i> Document {{ $loop->iteration }}
                                                    </a>
                                                
                                                <form action="{{ route('actenaissance.deleteDocument', [$acteNaissance->id, $loop->index]) }}" 
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                            onclick="return confirm('Supprimer ce document?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            {{-- Père --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="border-bottom pb-2">Informations sur le père</h5>
                                    <p><strong>Nom:</strong> {{ $acteNaissance->nom_pere ?? 'Non renseigné' }}</p>
                                    <p><strong>Prénom:</strong> {{ $acteNaissance->prenom_pere ?? 'Non renseigné' }}</p>
                                    <p><strong>Domicile:</strong> {{ $acteNaissance->domicile_pere ?? 'Non renseigné' }}</p>
                                    <p><strong>Profession:</strong> {{ $acteNaissance->profession_pere ?? 'Non renseigné' }}</p>
                                    <p><strong>Numéro CNI:</strong> {{ $acteNaissance->numero_cni_pere ?? 'Non renseigné' }}</p>
                                </div>

                                {{-- Mère --}}
                                <div class="col-md-6">
                                    <h5 class="border-bottom pb-2">Informations sur la mère</h5>
                                    <p><strong>Nom:</strong> {{ $acteNaissance->nom_mere }}</p>
                                    <p><strong>Prénom:</strong> {{ $acteNaissance->prenom_mere }}</p>
                                    <p><strong>Domicile:</strong> {{ $acteNaissance->domicile_mere ?? 'Non renseigné' }}</p>
                                    <p><strong>Profession:</strong> {{ $acteNaissance->profession_mere ?? 'Non renseigné' }}</p>
                                    <p><strong>Numéro CNI:</strong> {{ $acteNaissance->numero_cni_mere ?? 'Non renseigné' }}</p>
                                </div>
                            </div>

                            {{-- Demandeur --}}
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h5 class="border-bottom pb-2">Informations sur le demandeur</h5>
                                    <p><strong>Filiation:</strong> {{ ucfirst($acteNaissance->filiation) }}</p>
                                    <p><strong>Nom:</strong> {{ $acteNaissance->nom_demandeur }}</p>
                                    <p><strong>Prénom:</strong> {{ $acteNaissance->prenom_demandeur }}</p>
                                </div>
                            </div>

                            {{-- Actions --}}
                            <div class="row mt-4">
                                <div class="col-md-12 d-flex justify-content-end">
                                    <a href="{{ route('actenaissance.edit', $acteNaissance->id) }}" class="btn btn-primary me-2">
                                        <i class="fas fa-edit"></i> Modifier
                                    </a>
                                    <form action="{{ route('actenaissance.destroy', $acteNaissance->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet acte?')">
                                            <i class="fas fa-trash"></i> Supprimer
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endsection