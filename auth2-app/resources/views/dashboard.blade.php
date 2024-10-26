@extends('layouts.auth')
@section('authcontent')

 <!-- Layout wrapper -->
 <div class="layout-wrapper layout-content-navbar layout-without-menu">
      <div class="layout-container">
        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <!-- <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              

              <ul class="navbar-nav flex-row align-items-center ms-auto"> -->
                <!-- Place this tag where you want the button to render. -->
                

                <!-- User -->
                <!-- <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <div class="mt-4">
                <div class="btn-group" role="group" aria-label="Basic example">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
             @csrf
             </form>

<a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    Déconnexion
</a>
             </div>
             </div> -->
                <!-- @if (Route::has('login'))
    @auth
        <a href="{{ url('/dashboard') }}" class="btn btn-primary">MEF</a>
    @else
        <div class="mt-4">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{ route('login') }}" class="btn btn-primary">connection</a>
                <a href="{{ route('admin.login') }}" class="btn btn-primary">Admin connection  </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-primary">Inscription</a>
                @endif
            </div>
        </div>
    @endauth
@endif -->
         
                          <!-- <br/>
                </li> -->
                <!--/ User -->
              <!-- </ul>
            </div>
          </nav> -->
<br/>
          <!-- / Navbar -->
<!-- Layout wrapper -->

      <div class="container-fluid">
      <div class="card">
                <h5 class="card-header">Concours List</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                        <th>Nom Concour</th>
                        <th>Date Concour</th>
                        <th>Date Affichage</th>
                        <th>Date Limite Depot Dossier</th>
                        <th>Nombre Poste</th>
                        <th>Concour PDF</th>
                        <th>Administration</th>
                        <th>Postuler</th>  
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($concours as $concour)
                      @if( now()->greaterThanOrEqualTo($concour->date_affichage))
                        <tr>
                        <td>{{ $concour->nom_concour }}</td>
                        <td>{{ $concour->date_concour }}</td>
                        <td>{{ $concour->date_affichage }}</td>
                        <td>{{ $concour->date_limite_depot_dossier }}</td>
                        <td>{{ $concour->nombre_poste }}</td>
                        <td><a href="{{ asset('storage/' . $concour->concour_pdf) }}">Download</a></td>
                        
                        <td>{{ $concour->administration->name ?? 'N/A' }}</td>
                        
                        @if( (\Carbon\Carbon::now()->between($concour->date_affichage, $concour->date_limite_depot_dossier)))
                         <td>
                         <form action="{{ route('candidatures.create', ['concour' => $concour->id]) }}" method="GET">
                                  <button type="submit" class="btn btn-info">Postuler</button>
                         </form>
                         </td>
                        @endif 
                    </tr>
                @endif
            @endforeach
                       
                      
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!--/ Bordered Table -->

      </div>
 
      <br>
      <div class="container-fluid">
      <div class="card">
                <h5 class="card-header">Concours List Resultat  </h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                        <th>Nom Concour</th>
                        <th>Date Concour</th>
                        <th>Date Affichage</th>
                        <th>Date Limite Depot Dossier</th>
                        <th>Nombre Poste</th>
                        <th>Concour PDF</th>
                        <th>Administration</th>
                        <th>Liste des candidat au teste ecrit</th>  
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($concours as $concour)
                      @if( isset($concour->resultats_pdf_1) )
                        <tr>
                        <td>{{ $concour->nom_concour }}</td>
                        <td>{{ $concour->date_concour }}</td>
                        <td>{{ $concour->date_affichage }}</td>
                        <td>{{ $concour->date_limite_depot_dossier }}</td>
                        <td>{{ $concour->nombre_poste }}</td>
                        <td><a href="{{ asset('storage/' . $concour->concour_pdf) }}">Download</a></td>
                        <td>{{ $concour->administration->name ?? 'N/A' }}</td>
                        <td><a href="{{ asset('storage/' . $concour->resultats_pdf_1) }}">Download</a></td>
                        </tr>
                     @endif
                     @endforeach
                       
                      
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!--/ Bordered Table -->

       </div>
       @if (Auth::check() && Auth::user()->hasRole('candidat'))
                        
       @endif
            
@endsection