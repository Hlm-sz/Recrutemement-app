@extends('layouts.app')

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
                    <p class="mb-6">
                        {{ __('Veuillez entrer votre email pour recevoir un lien de réinitialisation du mot de passe.') }}
                    </p>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Form to enter email -->
                    <form id="formEmailVerification" class="mb-6" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre email" value="{{ old('email') }}" required autofocus>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <br/>
                        <button class="btn btn-primary d-grid w-100 btn-spacing" type="submit">Envoyer le lien de réinitialisation</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
