@extends('layouts.app')
@section('content')

@extends('layouts.sidebar')
@section('sidebar')
<div class="col-lg-8 col-xl-9 ps-lg-4 ps-xl-6">
    <!-- Title and offcanvas button -->
    <div class="d-flex justify-content-between align-items-center mb-5 mb-sm-6">
        <!-- Title -->
        <h1 class="h3 mb-0">List of accounts</h1>

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
            <form class="rounded position-relative">
                <input class="form-control pe-5" type="search" placeholder="Search" aria-label="Search">
                <button class="btn border-0 px-3 py-0 position-absolute top-50 end-0 translate-middle-y" type="submit"><i class="fas fa-search fs-6"></i></button>
            </form>
        </div>

        <!-- Select option -->
        <div class="col-sm-6 col-xl-3 ms-auto">
            <!-- Short by filter -->
            <form>
                <select class="form-select js-choice" aria-label=".form-select-sm">
                    <option>Sort by</option>
                    <option selected>Published</option>
                    <option>Free</option>
                    <option>Newest</option>
                    <option>Oldest</option>
                </select>
            </form>
        </div>

        <!-- Button -->
        <div class="col-sm-6 col-xl-4">
            <a href="#" class="btn btn-primary mb-0"><i class="bi bi-plus-lg me-2"></i>Crée un compte</a>
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
                    <th scope="col" class="border-0 text-white rounded-start">Id</th>
                    <th scope="col" class="border-0 text-white">Nom</th>
                    <th scope="col" class="border-0 text-white">Role</th>
                    <th scope="col" class="border-0 text-white">contact</th>
                    <th scope="col" class="border-0 text-white rounded-end">Action</th>
                </tr>
            </thead>
        
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->contact }}</td>
                    <td>
                        <button class="btn btn-sm btn-dark me-1 mb-1 mb-md-0">
                            <i class="bi bi-pencil-square"></i> Modifier
                        </button>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" 
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                <i class="bi bi-trash"></i> Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-4">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Modal d'édition -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Modifier l'utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editUserId" name="id">
                        
                        <div class="mb-3">
                            <label for="editName" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="editName" name="name">
                        </div>
                        
                        <div class="mb-3">
                            <label for="editRole" class="form-label">Rôle</label>
                            <select class="form-select" id="editRole" name="role">
                                <option value="citoyen">Citoyen</option>
                                <option value="officier">Officier</option>
                                <option value="admin">Administrateur</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="editContact" class="form-label">Contact</label>
                            <input type="text" class="form-control" id="editContact" name="contact">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary" id="saveChangesBtn">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Confirmer la suppression</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Confirmer la suppression</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

