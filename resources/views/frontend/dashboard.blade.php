@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <!-- Main Content -->
            <main class="mt-8">

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card card-dashboard border-0 shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Acte de naissance (Mensuels)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">40</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-calendar text-gray-300 fs-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card card-dashboard border-0 shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            acte de mariage (Annuels)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">21</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-heart-fill fs-2 text-danger"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card card-dashboard border-0 shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">acte de décès
                                        </div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">5</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-flower1 fs-2 text-black"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card card-dashboard border-0 shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            citoyen</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">100</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-person-standing text-gray-300 fs-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Projects & Recent Orders -->
                <div class="row">
                    <!-- Recent Orders -->
                    <div class="col-lg-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Acte d'état civil</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th>N°</th>
                                                <th>Nom & Prenom</th>
                                                <th>Date</th>
                                                <th>role</th>
                                                <th>Statut</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#2457</td>
                                                <td>Brandon Jacob</td>
                                                <td>28/04/2025</td>
                                                <td>citoyen</td>
                                                <td><span class="badge bg-success">validé</span></td>
                                            </tr>
                                            <tr>
                                                <td>#2456</td>
                                                <td>Bridie Kessler</td>
                                                <td>27/04/2025</td>
                                                <td>citoyen</td>
                                                <td><span class="badge bg-warning">En attente</span></td>
                                            </tr>
                                            <tr>
                                                <td>#2455</td>
                                                <td>Ashleigh Langosh</td>
                                                <td>26/04/2025</td>
                                                <td>citoyen</td>
                                                <td><span class="badge bg-success">validé</span></td>
                                            </tr>
                                            <tr>
                                                <td>#2454</td>
                                                <td>Angus Grady</td>
                                                <td>25/04/2025</td>
                                                <td>citoyen</td>
                                                <td><span class="badge bg-danger">Annulée</span></td>
                                            </tr>
                                            <tr>
                                                <td>#2453</td>
                                                <td>Raheem Lehner</td>
                                                <td>24/04/2025</td>
                                                <td>citoyen</td>
                                                <td><span class="badge bg-success">validé</span></td>
                                            </tr>
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