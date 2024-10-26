
@extends('layouts.auth')
@section('authcontent')

 <!-- Layout wrapper -->
 <div class="layout-wrapper layout-content-navbar layout-without-menu">
      <div class="layout-container">
        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->


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
                <h5 class="card-header">Résultats des opérations de recrutement</h5>
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
            
@endsection