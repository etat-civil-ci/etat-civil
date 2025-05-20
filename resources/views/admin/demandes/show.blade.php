<div class="timeline-item">
            <div class="timeline-date">{{ $demande->updated_at->format('d/m/Y à H:i') }}</div>
            <div class="timeline-content">
                <h5>Statut mis à jour</h5>
                <p>La demande a été {{ $demande->statut }}</p>
            </div>
        </div>
        @endif
                        
        @if($demande->statut == 'validé' && $demande->downloadHistory && $demande->downloadHistory->count() > 0)
        <div class="timeline-item">
            <div class="timeline-date">{{ $demande->downloadHistory->first()->created_at->format('d/m/Y à H:i') }}</div>
            <div class="timeline-content">
                <h5>Document téléchargé</h5>
                <p>Le document a été téléchargé pour la première fois</p>
            </div>
        </div>
        @endif
    </div>
</div>
            </div>
            
            @if($demande->statut == 'validé')
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-file-pdf me-1"></i>
                    Aperçu du document
                </div>
                <div class="card-body">
                    <div class="document-preview">
                        <!-- Intégration d'un aperçu du document -->
                        <div class="text-center">
                            <img src="{{ asset('img/document-preview.png') }}" alt="Aperçu du document" class="img-fluid" style="max-height: 300px;">
                        </div>
                        
                        <div class="qr-code">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ route('verifier.document', ['reference' => $demande->reference]) }}" alt="Code QR de vérification">
                            <p class="mt-2">Code de vérification: <strong>{{ $demande->reference }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        
        <div class="col-lg-4">
            <!-- Informations du demandeur -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-user me-1"></i>
                    Informations du demandeur
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <img src="{{ $demande->user->photo ? asset('storage/'.$demande->user->photo) : asset('img/default-user.png') }}" 
                             alt="Photo de profil" class="rounded-circle img-thumbnail" style="width: 100px; height: 100px;">
                    </div>
                    
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Nom:</div>
                        <div class="col-md-8">{{ $demande->user->nom }}</div>
                    </div>
                    
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Prénom:</div>
                        <div class="col-md-8">{{ $demande->user->prenom }}</div>
                    </div>
                    
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Email:</div>
                        <div class="col-md-8">{{ $demande->user->email }}</div>
                    </div>
                    
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Téléphone:</div>
                        <div class="col-md-8">{{ $demande->user->telephone }}</div>
                    </div>
                    
                    <div class="row mb-2">
                        <div class="col-md-4 fw-bold">Adresse:</div>
                        <div class="col-md-8">{{ $demande->user->adresse }}</div>
                    </div>
                    
                    <div class="text-center mt-3">
                        <a href="{{ route('users.show', $demande->user->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-user"></i> Voir le profil complet
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-tasks me-1"></i>
                    Actions
                </div>
                <div class="card-body">
                    <div class="action-buttons">
                        @if($demande->statut == 'en attente')
                        <form action="{{ route('demandes.valider', $demande->id) }}" method="POST" class="mb-2">
                            @csrf
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-check"></i> Valider la demande
                            </button>
                        </form>
                        
                        <form action="{{ route('demandes.rejeter', $demande->id) }}" method="POST" class="mb-2">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-times"></i> Rejeter la demande
                            </button>
                        </form>
                        @endif
                        
                        @if($demande->statut == 'validé')
                        <a href="{{ route('demandes.telecharger', $demande->id) }}" class="btn btn-primary w-100 mb-2">
                            <i class="fas fa-download"></i> Télécharger le document
                        </a>
                        
                        <a href="{{ route('demandes.envoyer', $demande->id) }}" class="btn btn-info w-100 mb-2">
                            <i class="fas fa-paper-plane"></i> Envoyer par email
                        </a>
                        @endif
                        
                        <a href="{{ route('demandes.edit', $demande->id) }}" class="btn btn-warning w-100 mb-2">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                    </div>
                    
                    <hr>
                    
                    <div class="notes">
                        <h6>Notes administratives:</h6>
                        <form action="{{ route('demandes.addnote', $demande->id) }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <textarea class="form-control" name="note" rows="3" placeholder="Ajouter une note..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-sm btn-secondary">
                                <i class="fas fa-save"></i> Enregistrer la note
                            </button>
                        </form>
                        
                        @if($demande->notes && count($demande->notes) > 0)
                        <div class="mt-3">
                            @foreach($demande->notes as $note)
                            <div class="alert alert-secondary">
                                <small class="text-muted">{{ $note->created_at->format('d/m/Y H:i') }} - {{ $note->admin->nom }}</small>
                                <p class="mb-0">{{ $note->contenu }}</p>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Script pour confirmation des actions
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (this.action.includes('rejeter')) {
                if (!confirm('Êtes-vous sûr de vouloir rejeter cette demande ?')) {
                    e.preventDefault();
                }
            } else if (this.action.includes('valider')) {
                if (!confirm('Êtes-vous sûr de vouloir valider cette demande ?')) {
                    e.preventDefault();
                }
            }
        });
    });
</script>
@endsection