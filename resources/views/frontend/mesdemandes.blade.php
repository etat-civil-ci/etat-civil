@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <!-- Main Content -->
            <main class="mt-8">

                <!-- Stats Cards -->
               


                 

                  
                </div>

                <!-- Projects & Recent Orders -->
                <div class="row">
                    <!-- Recent Orders -->
                    <div class="col-lg-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Liste de mes demandes</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th>Numero de l'acte</th>
                                                 <th>Date de demande</th>
                                                <th>Nom</th>
                                                <th>Prenom</th>
                                                <th>Date</th>
                                                <th>Type de l'acte</th>
                                                <th>Nombre de copie</th>
                                                <th>Motif du rejet</th>
                                                <th>Type de l'acte</th>
                                                <th>Statut</th>
                                                <!-- <th>Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <tbody>
                  @forelse($demandes as $demande)
              <tr>
                  <td>{{ $demande->numero_acte ?? $demande->id }}</td>
                  <td>{{ \Carbon\Carbon::parse($demande->date_demande)->format('d/m/Y') ?? 'N/A' }}</td>
                  <td>{{ $demande->user->nom ?? 'Inconnu' }}</td>
                  <td>{{ $demande->user->prenom ?? '' }}</td>
                  <td>{{ \Carbon\Carbon::parse($demande->date)->format('d/m/Y') ?? 'N/A' }}</td>
                  <td>{{ $demande->type_acte }}</td>
                  <td>{{ $demande->nombre_copie }}</td>
                  <td>{{ $demande->motif_rejet ?? '-' }}</td>
                  <td>{{ $demande->type_acte }}</td>
                  <td>
                      @if($demande->statut === 'validé')
                          <span class="badge bg-success">Validé</span>
                      @elseif($demande->statut === 'en attente')
                          <span class="badge bg-warning">En attente</span>
                      @elseif($demande->statut === 'annulée')
                          <span class="badge bg-danger">Annulée</span>
                      @else
                          <span class="badge bg-secondary">{{ ucfirst($demande->statut) }}</span>
                      @endif
                  </td>
              </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">Aucune demande disponible</td>
                </tr>
            @endforelse

</tbody>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>


@stop