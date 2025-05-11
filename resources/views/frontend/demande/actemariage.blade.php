{{-- actemariage.blade.php --}}
@extends('layouts.appactenaissance')

@section('content')
<!-- =======================
Main hero START -->
<section class="pt-8">
    <div class="container">
        <!-- Breadcrumb & title -->
        <div class="bg-dark rounded-4 text-center position-relative overflow-hidden py-5">
            <!-- Svg decoration -->
            <figure class="position-absolute top-0 start-0 ms-n8">
                <svg width="424" height="405" viewBox="0 0 424 405" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- SVG content -->
                </svg>
            </figure>

            <!-- SVG decoration -->
            <figure class="position-absolute top-0 end-0 me-n8 mt-5">
                <svg class="opacity-3" width="371" height="354" viewBox="0 0 371 354" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- SVG content -->
                </svg>
            </figure>

            <!-- Breadcrumb -->
            <div class="d-flex justify-content-center position-relative z-index-9">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-dots breadcrumb-dark mb-1">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Demande d'Acte de Mariage</li>
                    </ol>
                </nav>
            </div>
            <!-- Title -->
            <h1 class="h2 text-white">Acte de Mariage</h1>
        </div>

        <!-- Formulaire d'Acte de Mariage -->
        <div class="container mt-6">
            
            <h2 class="text-center mb-4">Formulaire de Demande d'Acte de Mariage</h2>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('demandes.acte-mariage.store') }}" method="POST" class="row g-3">
                @csrf

                <!-- Informations sur le mariage -->


                <div class="col-md-6">
                    <label for="date_mariage" class="form-label">Date du mariage *</label>
                    <input type="date" class="form-control @error('date_mariage') is-invalid @enderror" 
                           id="date_mariage" name="date_mariage" 
                           value="{{ old('date_mariage') }}" required>
                    @error('date_mariage')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="date_acte" class="form-label">Date de l'acte *</label>
                    <input type="date" class="form-control @error('date_acte') is-invalid @enderror" 
                           id="date_acte" name="date_acte" 
                           value="{{ old('date_acte') }}" required>
                    @error('date_acte')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="numero_acte" class="form-label">Numéro d'acte *</label>
                    <input type="text" class="form-control @error('numero_acte') is-invalid @enderror" 
                           id="numero_acte" name="numero_acte" 
                           value="{{ old('numero_acte') }}" required>
                    @error('numero_acte')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="nombre_copie" class="form-label">Nombre de copies *</label>
                    <select class="form-select @error('nombre_copie') is-invalid @enderror" 
                            id="nombre_copie" name="nombre_copie" required>
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ old('nombre_copie') == $i ? 'selected' : '' }}>
                                {{ $i }} copie{{ $i > 1 ? 's' : '' }}
                            </option>
                        @endfor
                    </select>
                    @error('nombre_copie')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Bouton envoyer -->
                <div class="col-12 text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-5">
                        <i class="fas fa-paper-plane me-2"></i> Envoyer la demande
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

@if(session('pdf_generated'))
<div id="pdf-download" data-url="{{ session('pdf_url') }}"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const pdfDiv = document.getElementById('pdf-download');
    if (pdfDiv) {
        const pdfUrl = pdfDiv.getAttribute('data-url');
        if (pdfUrl) {
            // Solution 1: Téléchargement forcé via un lien
            const link = document.createElement('a');
            link.href = pdfUrl;
            link.setAttribute('download', ''); // Force le téléchargement
            document.body.appendChild(link);
            link.click();
            
            // Nettoyer après quelques secondes pour permettre le téléchargement
            setTimeout(() => {
                document.body.removeChild(link);
                
                // Informer l'utilisateur
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-success alert-dismissible fade show mt-3';
                alertDiv.innerHTML = `
                    <strong>Téléchargement lancé!</strong> Si votre téléchargement ne démarre pas automatiquement, 
                    <a href="${pdfUrl}" download class="alert-link">cliquez ici</a>.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                `;
                
                // Insérer l'alerte au début du formulaire ou d'un conteneur approprié
                const container = document.querySelector('.container.mt-6');
                if (container) {
                    container.insertBefore(alertDiv, container.firstChild);
                }
            }, 1000);
        }
    }
});
</script>
@endif
<!-- =======================
Main hero END -->
@endsection