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
                                    <h5>Modifier un utilisateur</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <legend>Informations Utilisateur</legend>
                                        <div class="mb-3 row">
                                            <div class="col-md-6">
                                                <label for="name">Nom</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" aria-label="Nom" required>
                                                @error('name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" aria-label="Email" required>
                                                @error('email')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
    <div class="col-md-6">
        <label for="password">Nouveau mot de passe</label>
        <input type="password" class="form-control" id="password" name="password">
        @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="password_confirmation">Confirmer le mot de passe</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        @error('password_confirmation')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

                                            <div class="col-md-6">
                                                <label for="usertype">Type d'utilisateur</label>
                                                <select class="form-control" id="usertype" name="usertype" aria-label="Type d'utilisateur" required>
                                                    <option value="admin" {{ old('usertype', $user->usertype) == 'admin' ? 'selected' : '' }}>Admin</option>
                                                    <option value="validateur" {{ old('usertype', $user->usertype) == 'validateur' ? 'selected' : '' }}>Validateur</option>
                                                    <option value="lanceur_concour" {{ old('usertype', $user->usertype) == 'lanceur_concour' ? 'selected' : '' }}>Lanceur de concour</option>
                                                </select>
                                                @error('usertype')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <div class="col-md-12 text-center">
                                                <button type="submit" class="btn btn-primary">Modifier l'utilisateur</button>
                                            </div>
                                        </div>
                                    </form>
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
