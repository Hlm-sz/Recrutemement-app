@extends('layouts.auth')

@section('authcontent')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <div class="card px-sm-6 px-0">
                <div class="card-body">
                    <div class="app-brand justify-content-center mb-6">
                        <a href="" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo"></span>
                            <span class="app-brand-text demo text-heading fw-bold">Recrutement-MEF</span>
                        </a>
                    </div>

                    <h4 class="mb-1">Réinitialiser le mot de passe</h4>
                    <p class="mb-6">Veuillez entrer votre adresse e-mail et un nouveau mot de passe pour réinitialiser votre mot de passe.</p>

                    <!-- Réinitialiser le mot de passe -->
                    <form id="formPasswordReset" method="POST" action="{{ route('password.store') }}">
                        @csrf

                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre email" value="{{ old('email', $request->email) }}" required aria-label="Email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de Passe</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe" required aria-label="Mot de Passe">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div id="passwordStrength" class="mt-1"></div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-6">
                            <label for="password_confirmation" class="form-label">Confirmer le Mot de Passe</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmez votre mot de passe" required aria-label="Confirmer le Mot de Passe">
                            @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                         <br/>
                        <button class="btn btn-primary d-grid w-100 btn-spacing" type="submit">Confirmer</button>
                    </form>

                    <!-- Message to show after sending verification link -->
                    <!-- <div id="verificationMessage" class="alert alert-success" role="alert">
                        Un email de vérification a été envoyé à votre adresse. Veuillez vérifier votre email pour activer votre compte.
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
