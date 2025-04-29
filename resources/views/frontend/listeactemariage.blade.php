@extends('layouts.app')
@section('content')

@extends('layouts.sidebar')
@section('sidebar')

<!-- Main content -->
<div class="col-lg-8 col-xl-9 ps-lg-4 ps-xl-6">
    <!-- Title and offcanvas button -->
    <div class="d-flex justify-content-between align-items-center mb-5 mb-sm-6">
        <!-- Title -->
        <h1 class="h3 mb-0">Liste de acte mariage</h1>

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
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-4">

        </div>
    </div>
</div>

@stop