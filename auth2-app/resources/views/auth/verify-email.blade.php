@extends('layouts.app')
@section('authcontent')
<style>
    #verificationMessage {
      margin-top: 20px;
    }
    .action-buttons {
      display: flex;
      gap: 10px; /* Space between button and link */
      margin-top: 10px; /* Space from the message */
    }
    .resend-button {
      font-size: 0.875rem; /* Smaller font size */
    }
    .logout-link {
      font-size: 0.75rem; /* Smaller font size for the link */
      align-self: center; /* Vertically align with the button */
      text-decoration: none; /* Remove underline */
      color: #007bff; /* Match button color */
      margin-top: 15px;
    }
    .logout-link:hover {
      text-decoration: underline; /* Add underline on hover */
    }
  </style>
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
            <!-- <h4 class="mb-1">Réinitialiser le mot de passe</h4> -->
            <p class="mb-6">
             Merci de vous être inscrit ! Avant de commencer, pourriez-vous vérifier votre adresse e-mail en cliquant sur le lien que nous venons de vous envoyer par e-mail ? Si vous n'avez pas reçu l'e-mail, nous vous en enverrons un autre avec plaisir.
            </p>

            @if (session('status') == 'verification-link-sent')
            <div id="verificationMessage" class="alert alert-success" role="alert">
               Un nouveau lien de vérification a été envoyé à l'adresse e-mail que vous avez fournie lors de votre inscription.
            </div>
            @endif

            <!-- Action buttons -->
             
            <div class="row g-1"> <!-- Utilisez g-1 pour réduire l'espacement -->
    <div class="action-buttons col-9 mb-0"> <!-- Réduit l'espace en bas -->
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button class="btn btn-primary resend-button">Renvoyer l'e-mail de vérification</button>
        </form>
    </div>
    <div class="action-buttons col-3 mb-0"> <!-- Réduit l'espace en bas -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-primary" style="padding: 2px 4px; font-size: 10px; width: 90px; height: 37px;">
                Se déconnecter
            </button>
        </form>
    </div>
</div>

            <!-- <div class="row">
            <div class="action-buttons col-9">
             <form method="POST" action="{{ route('verification.send') }}">
               @csrf
              <button class="btn btn-primary resend-button">Renvoyer l'e-mail de vérification</button>
              </form>
            </div>
            <div class="action-buttons col-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-primary "
                    style="padding: 2px 4px; font-size: 10px;width: 90px;height: 37px;">
                     Se déconnecter
                </button>
            </form>
            </div>
            </div> -->

             <!-- Action buttons -->
            <!-- <div class="action-buttons">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-primary resend-button">
                Renvoyer l'e-mail de vérification
                </button>
              </form>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-link">
                  {{ __('Se déconnecter') }}
                </button>
              </form>
            </div> -->
             
            
            

        </div>
      </div>
    </div>
  </div>
</div>

@endsection