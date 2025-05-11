@extends('layouts.appactenaissance')

@section('content')
    @extends('layouts.sidebaractenaissance')

    @section('sidebaractenaissance')
        <div class="col-lg-8 col-xl-9 ps-lg-4 ps-xl-6">
            <div class="d-flex justify-content-between align-items-center mb-5 mb-sm-6">
                <h1 class="h3 mb-0">Détails de l'acte de mariage</h1>
                <a href="{{ route('listeactemariage') }}" class="btn btn-sm btn-outline-secondary">
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
                            {{-- Informations administratives --}}
                            <div class="row mb-4">
                                <h5 class="border-bottom pb-2">Informations administratives</h5>
                                <div class="col-md-6">
                                    <p><strong>Numéro d'acte:</strong> {{ $acteMariage->numero_acte }}</p>
                                    <p><strong>Date du mariage:</strong> {{ $acteMariage->date_mariage ? \Carbon\Carbon::parse($acteMariage->date_mariage)->format('d/m/Y') : '' }}</p>
                                    <p><strong>Lieu du mariage:</strong> {{ $acteMariage->lieu_mariage }}</p>
                                    <p><strong>Localité:</strong> {{ $acteMariage->localite->nom }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Date d'enregistrement:</strong> {{ $acteMariage->created_at->format('d/m/Y H:i') }}</p>
                                    <p><strong>Statut:</strong>
                                        @if($acteMariage->statut == 'succès')
                                            <span class="badge bg-success">Validé</span>
                                        @elseif($acteMariage->statut == 'échec')
                                            <span class="badge bg-danger">Rejeté</span>
                                        @else
                                            <span class="badge bg-warning">En attente</span>
                                        @endif
                                    </p>
                                    <p><strong>Mis à jour le:</strong> {{ $acteMariage->updated_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>

                            {{-- Informations sur les époux --}}
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <h5 class="border-bottom pb-2">Informations sur l'époux</h5>
                                    <p><strong>Nom:</strong> {{ $acteMariage->nom_epoux }}</p>
                                    <p><strong>Prénom:</strong> {{ $acteMariage->prenom_epoux }}</p>
                                    <p><strong>Date de naissance:</strong> {{ $acteMariage->date_naissance_epoux ? \Carbon\Carbon::parse($acteMariage->date_naissance_epoux)->format('d/m/Y') : '' }}</p>
                                    <p><strong>Lieu de naissance:</strong> {{ $acteMariage->lieu_naissance_epoux }}</p>
                                    <p><strong>Numéro CNI:</strong> {{ $acteMariage->numero_cni_epoux }}</p>
                                    <p><strong>Profession:</strong> {{ $acteMariage->profession_epoux }}</p>
                                    <p><strong>Domicile:</strong> {{ $acteMariage->domicile_epoux }}</p>
                                </div>

                                <div class="col-md-6">
                                    <h5 class="border-bottom pb-2">Informations sur l'épouse</h5>
                                    <p><strong>Nom:</strong> {{ $acteMariage->nom_epouse }}</p>
                                    <p><strong>Prénom:</strong> {{ $acteMariage->prenom_epouse }}</p>
                                    <p><strong>Date de naissance:</strong> {{ $acteMariage->date_naissance_epouse ? \Carbon\Carbon::parse($acteMariage->date_naissance_epouse)->format('d/m/Y') : '' }}</p>
                                    <p><strong>Lieu de naissance:</strong> {{ $acteMariage->lieu_naissance_epouse }}</p>
                                    <p><strong>Numéro CNI:</strong> {{ $acteMariage->numero_cni_epouse }}</p>
                                    <p><strong>Profession:</strong> {{ $acteMariage->profession_epouse }}</p>
                                    <p><strong>Domicile:</strong> {{ $acteMariage->domicile_epouse }}</p>
                                </div>
                            </div>

                            {{-- Témoins --}}
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <h5 class="border-bottom pb-2">Témoin 1</h5>
                                    <p><strong>Nom:</strong> {{ $acteMariage->nom_temoin1 }}</p>
                                    <p><strong>Prénom:</strong> {{ $acteMariage->prenom_temoin1 }}</p>
                                    <p><strong>Numéro CNI:</strong> {{ $acteMariage->numero_cni_temoin1 }}</p>
                                </div>

                                <div class="col-md-6">
                                    <h5 class="border-bottom pb-2">Témoin 2</h5>
                                    <p><strong>Nom:</strong> {{ $acteMariage->nom_temoin2 }}</p>
                                    <p><strong>Prénom:</strong> {{ $acteMariage->prenom_temoin2 }}</p>
                                    <p><strong>Numéro CNI:</strong> {{ $acteMariage->numero_cni_temoin2 }}</p>
                                </div>
                            </div>

                            {{-- Documents --}}
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h5 class="border-bottom pb-2">Documents associés</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>Documents de l'époux</h6>
                                            <p>
                                                <a href="{{ asset('storage/' . str_replace('public/', '', $acteMariage->extrait_naissance_epoux)) }}" 
                                                    target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-file-pdf"></i> Extrait de naissance
                                                </a>
                                            </p>
                                            <p>
                                                <a href="{{ asset('storage/' . str_replace('public/', '', $acteMariage->photo_epoux)) }}" 
                                                    target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-image"></i> Photo d'identité
                                                </a>
                                            </p>
                                            <p>
                                                <a href="{{ asset('storage/' . str_replace('public/', '', $acteMariage->certificat_residence_epoux)) }}" 
                                                   target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-file-pdf"></i> Certificat de résidence
                                                </a>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Documents de l'épouse</h6>
                                            <p>
                                                <a href="{{ asset('storage/' . str_replace('public/', '', $acteMariage->extrait_naissance_epouse)) }}" 
                                                   target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-file-pdf"></i> Extrait de naissance
                                                </a>
                                            </p>
                                            <p>
                                                <a href="{{ asset('storage/' . str_replace('public/', '', $acteMariage->photo_epouse)) }}" 
                                                   target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-image"></i> Photo d'identité
                                                </a>
                                            </p>
                                            <p>
                                                <a href="{{ asset('storage/' . str_replace('public/', '', $acteMariage->certificat_residence_epouse)) }}" 
                                                   target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-file-pdf"></i> Certificat de résidence
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Actions --}}
                            <div class="row mt-4">
                                <div class="col-md-12 d-flex justify-content-end">
                                    <a href="{{ route('actemariage.edit', $acteMariage->id) }}" class="btn btn-primary me-2">
                                        <i class="fas fa-edit"></i> Modifier
                                    </a>
                                    <form action="{{ route('actemariage.destroy', $acteMariage->id) }}" method="POST" class="d-inline">
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