@extends('layouts.appactenaissance')

@section('content')
    @extends('layouts.sidebaractenaissance')

    @section('sidebaractenaissance')
        <div class="col-lg-8 col-xl-9 ps-lg-4 ps-xl-6">
            <div class="d-flex justify-content-between align-items-center mb-5 mb-sm-6">
                <h1 class="h3 mb-0">Détails de l'acte de décès</h1>
                <a href="{{ route('listeactedeces') }}" class="btn btn-sm btn-outline-secondary">
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
                            {{-- Défunt + Administratif --}}
                            <div class="row mb-4">
                                <h5 class="border-bottom pb-2">Informations sur le défunt et les détails administratifs</h5>
                                <div class="col-md-6">
                                    <p><strong>Numéro d'acte:</strong> {{ $acteDeces->numero_acte }}</p>
                                    <p><strong>Nom:</strong> {{ $acteDeces->nom_defunt }}</p>
                                    <p><strong>Prénom:</strong> {{ $acteDeces->prenom_defunt }}</p>
                                    <p><strong>Date de décès:</strong> {{ $acteDeces->date_deces ? \Carbon\Carbon::parse($acteDeces->date_deces)->format('d/m/Y') : '' }}</p>
                                    <p><strong>Lieu de décès:</strong> {{ $acteDeces->lieu_deces }}</p>
                                    <p><strong>Cause du décès:</strong> {{ $acteDeces->cause_deces ?? 'Non spécifiée' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Date de naissance:</strong> {{ $acteDeces->date_naissance ? \Carbon\Carbon::parse($acteDeces->date_naissance)->format('d/m/Y') : 'Non renseignée' }}</p>
                                    <p><strong>Lieu de naissance:</strong> {{ $acteDeces->lieu_naissance ?? 'Non renseigné' }}</p>
                                    <p><strong>Date d'enregistrement:</strong> {{ $acteDeces->date_acte ? \Carbon\Carbon::parse($acteDeces->date_acte)->format('d/m/Y') : '' }}</p>
                                    <p><strong>Localité:</strong> {{ $acteDeces->localite->nom }}</p>
                                    <p><strong>Statut:</strong>
                                        @if($acteDeces->statut == 'succès')
                                            <span class="badge bg-success">Validé</span>
                                        @elseif($acteDeces->statut == 'échec')
                                            <span class="badge bg-danger">Rejeté</span>
                                        @else
                                            <span class="badge bg-warning">En attente</span>
                                        @endif
                                    </p>
                                    <p><strong>Créé le:</strong> {{ $acteDeces->created_at->format('d/m/Y H:i') }}</p>
                                    <p><strong>Mis à jour le:</strong> {{ $acteDeces->updated_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>

                            @if($acteDeces->documents)
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <h5>Documents associés</h5>
                                        @foreach(json_decode($acteDeces->documents) as $document)
                                            <div class="mb-2">
                                                <a href="{{ asset('storage/' . str_replace('public/', '', $document)) }}" 
                                                    target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-file-alt"></i> Document {{ $loop->iteration }}
                                                </a>
                                                
                                                <form action="{{ route('actedeces.deleteDocument', [$acteDeces->id, $loop->index]) }}" 
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

                            {{-- Déclarant --}}
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <h5 class="border-bottom pb-2">Informations sur le déclarant</h5>
                                    <p><strong>Filiation:</strong> {{ ucfirst($acteDeces->filiation) }}</p>
                                    <p><strong>Nom:</strong> {{ $acteDeces->nom_declarant }}</p>
                                    <p><strong>Prénom:</strong> {{ $acteDeces->prenom_declarant }}</p>
                                </div>

                                {{-- Parent --}}
                                <div class="col-md-6">
                                    <h5 class="border-bottom pb-2">Informations sur le parent</h5>
                                    <p><strong>Type de parenté:</strong> {{ $acteDeces->type_parent ?? 'Non renseigné' }}</p>
                                    <p><strong>Nom:</strong> {{ $acteDeces->nom_parent ?? 'Non renseigné' }}</p>
                                    <p><strong>Prénom:</strong> {{ $acteDeces->prenom_parent ?? 'Non renseigné' }}</p>
                                </div>
                            </div>

                            {{-- Actions --}}
                            <div class="row mt-4">
                                <div class="col-md-12 d-flex justify-content-end">
                                    <a href="{{ route('actedeces.edit', $acteDeces->id) }}" class="btn btn-primary me-2">
                                        <i class="fas fa-edit"></i> Modifier
                                    </a>
                                    <form action="{{ route('actedeces.destroy', $acteDeces->id) }}" method="POST" class="d-inline">
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