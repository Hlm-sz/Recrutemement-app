@extends('layouts.concours')

@section('content')
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y"> 
                    <div class="row">
                        <div class="col-xxl">
                            <div class="card mb-4">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <h5>Détails de l'utilisateur</h5>
                                </div>
                                <div class="card-body">
                                    <legend>Informations Utilisateur</legend>
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="name">Nom</label>
                                            <input type="text" class="form-control" id="name" value="{{ $user->name }}" aria-label="Nom" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" value="{{ $user->email }}" aria-label="Email" readonly>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="usertype">Type d'utilisateur</label>
                                            <input type="text" class="form-control" id="usertype" value="{{ ucfirst($user->usertype) }}" aria-label="Type d'utilisateur" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email_verified_at">Email vérifié le</label>
                                            <input type="text" class="form-control" id="email_verified_at" value="{{ $user->email_verified_at ? $user->email_verified_at->format('d/m/Y H:i') : 'Non vérifié' }}" aria-label="Email vérifié le" readonly>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="created_at">Créé le</label>
                                            <input type="text" class="form-control" id="created_at" value="{{ $user->created_at->format('d/m/Y H:i') }}" aria-label="Créé le" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="updated_at">Mis à jour le</label>
                                            <input type="text" class="form-control" id="updated_at" value="{{ $user->updated_at->format('d/m/Y H:i') }}" aria-label="Mis à jour le" readonly>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-md-12 text-center">
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Modifier</a>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-backdrop fade"></div>
            </div>
        </div>
    </div>
@endsection
