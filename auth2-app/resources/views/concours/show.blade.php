<!-- <!DOCTYPE html>
<html>
<head>
    <title>Concours List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Concours Details</h1>
    
    <div class="card">
        <div class="card-header">
            <h2>{{ $concour->nom_concour }}</h2>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4"><strong>Date du Concours:</strong></div>
                <div class="col-md-8">{{ $concour->date_concour}}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4"><strong>Date d'Affichage:</strong></div>
                <div class="col-md-8">{{ $concour->date_affichage }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4"><strong>Date Limite de Dépôt de Dossier:</strong></div>
                <div class="col-md-8">{{ $concour->date_limite_depot_dossier }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4"><strong>Nombre de Postes:</strong></div>
                <div class="col-md-8">{{ $concour->nombre_poste }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4"><strong>Statut:</strong></div>
                <div class="col-md-8">{{ $concour->statut }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4"><strong>Administration:</strong></div>
                <div class="col-md-8">{{ $concour->administration->name ?? 'N/A' }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4"><strong>Profil:</strong></div>
                <div class="col-md-8">{{ $concour->profil->name ?? 'N/A' }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4"><strong>Grade:</strong></div>
                <div class="col-md-8">{{ $concour->grade->name ?? 'N/A' }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4"><strong>Filière:</strong></div>
                <div class="col-md-8">{{ $concour->filiere->name ?? 'N/A' }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4"><strong>Spécialité:</strong></div>
                <div class="col-md-8"> 
                
                @forelse($concour->specialites as $specialite)
                  {{ $specialite->name }}@if(!$loop->last), @endif
                @empty
                   N/A
                @endforelse

                
    
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4"><strong>PDF du Concours:</strong></div>
                <div class="col-md-8">
                    @if($concour->concour_pdf)
                        <a href="{{ asset('storage/' . $concour->concour_pdf) }}" target="_blank">Voir le PDF</a>
                    @else
                        N/A
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('concours.index') }}" class="btn btn-primary">Retour à la Liste</a>
            <a href="{{ route('concours.edit', $concour) }}" class="btn btn-warning">Modifier</a>
            <form action="{{ route('concours.destroy', $concour) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
        </div>
    </div>
</div>
</body>
</html> -->

@extends('layouts.concours')

@section('content')
<style>
   #diplay{
        display: flex; 
        justify-content: flex;
    }
    #diplay-right{
        display: flex; 
        justify-content: flex-end;
        justify-content: space-between;
    }
    .label-left {
            text-align: left;
        }
        .icon-left {
            font-size: 30px; 
            cursor: pointer;
        }
</style>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="index.html" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <!-- Add your SVG logo here -->
                        </span>
                        <span class="app-brand-text demo menu-text fw-bolder ms-2">Brand</span>
                    </a>
                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>
                <div class="menu-inner-shadow"></div>
                <ul class="menu-inner py-1">
                    <!-- Add menu items here if needed -->
                </ul>
            </aside>
            <!-- /Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>
                    <!-- Navbar content here -->
                </nav>
                <!-- /Navbar -->

                <!-- Content here -->
                <div class="container mt-4">
                    <div class="row justify-content-center">
                        <div class="col-md">
                            <div class="card">
                               
                            
                                <div class="card-header" id="diplay">
                                <!-- <a href="{{ route('concours.index') }}" class="icon-left ms-2" >
                                        <i class='bx bxs-left-arrow-circle'></i>
                                </a> -->
                                    
                                    <h2>{{ $concour->nom_concour }}</h2>
                                </div>
                                <div class="card-body" >
                                    <div class="row mb-3">
                                        <div class="col-md-4" id="diplay"><strong>Date du Concours:</strong></div>
                                        <div class="col-md-8" id="diplay">{{ $concour->date_concour }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4" id="diplay"><strong>Date d'Affichage:</strong></div>
                                        <div class="col-md-8" id="diplay">{{ $concour->date_affichage }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4" id="diplay"><strong>Date Limite de Dépôt de Dossier:</strong></div>
                                        <div class="col-md-8" id="diplay">{{ $concour->date_limite_depot_dossier }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4" id="diplay"><strong>Nombre de Postes:</strong></div>
                                        <div class="col-md-8" id="diplay">{{ $concour->nombre_poste }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4" id="diplay"><strong>Statut:</strong></div>
                                        <div class="col-md-8" id="diplay">{{ $concour->statut }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4" id="diplay"><strong>Administration:</strong></div>
                                        <div class="col-md-8" id="diplay">{{ $concour->administration->name ?? 'N/A' }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4" id="diplay"><strong>Profil:</strong></div>
                                        <div class="col-md-8" id="diplay">{{ $concour->profil->name ?? 'N/A' }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4" id="diplay"><strong>Grade:</strong></div>
                                        <div class="col-md-8" id="diplay">{{ $concour->grade->name ?? 'N/A' }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4" id="diplay"><strong>Filière:</strong></div>
                                        <div class="col-md-8" id="diplay">{{ $concour->filiere->name ?? 'N/A' }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4" id="diplay"><strong>Spécialité:</strong></div>
                                        <div class="col-md-8" id="diplay">
                                             @forelse($concour->specialites as $specialite)
                                                 {{ $specialite->name }}@if(!$loop->last), @endif
                                                 @empty
                                                   N/A
                                             @endforelse
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4" id="diplay"><strong>PDF du Concours:</strong></div>
                                        <div class="col-md-8" id="diplay">
                                            @if($concour->concour_pdf)
                                                <a href="{{ asset('storage/' . $concour->concour_pdf) }}" target="_blank">Voir le PDF</a>
                                            @else
                                                N/A
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row card-footer">
                                    <div class="col-2"  id="diplay">
                                    <a href="{{ route('concours.index') }}" class="btn btn-primary">Retour à la Liste</a>
                                    </div>
                                    <div class="col-3"  id="diplay-right">
                                    <!-- 
                                    <a href="{{ route('concours.edit', $concour) }}" class="btn btn-warning">Modifier</a>
                                      <form action="{{ route('concours.destroy', $concour) }}" method="POST" style="display:inline;">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn btn-danger">Supprimer</button>
                                      </form> -->

                                    <div class="mt-3">
                                     <div class="btn-group" role="group" aria-label="Basic example">
                                     <form action="{{ route('concours.destroy', $concour) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('concours.edit', $concour) }}" class="btn btn-warning">Modifier</a>
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                     </form>
                                     </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Content -->
            </div>
        </div>
    </div>
<!-- <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <div class="content-wrapper">

          

            <div class="card">
                <h5 class="card-header">{{ $concour->nom_concour }}</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table table-sm">
                    <thead>
                      <tr>
                        <th>Date du Concours:</th>
                        <th>Date d'Affichage:</th>
                        <th>Date Limite de Dépôt de Dossier:</th>
                        <th>Nombre de Postes:</th>
                        <th>Statut:</th>
                        <th>Administration:</th>
                        <th>Profil:</th>
                        <th>Grade:</th>
                        <th>Filière:</th>
                        <th>Spécialité:</th>
                        <th>PDF du Concours:</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <tr>
                        <th>Date du Concours:</th>
                        <td>
                            <strong>{{ $concour->date_concour}}</strong>
                        </td>
                        <th>Date d'Affichage:</th>
                        <td>{{ $concour->date_affichage }}</td>
                        
                        <td>{{ $concour->date_limite_depot_dossier }}</td>
                        <td>{{ $concour->nombre_poste }}</td>
                        <td>{{ $concour->statut }}</td>
                        <td>{{ $concour->administration->name ?? 'N/A' }}</td>
                        <td>{{ $concour->profil->name ?? 'N/A' }}</td>
                        <td>{{ $concour->grade->name ?? 'N/A' }}</td>
                        <td>{{ $concour->filiere->name ?? 'N/A' }}</td>
                        <td>
                            @forelse($concour->specialites as $specialite)
                               {{ $specialite->name }}@if(!$loop->last), @endif
                                @empty
                                   N/A
                            @endforelse
                        </td>
                        <td>
                           @if($concour->concour_pdf)
                             <a href="{{ asset('storage/' . $concour->concour_pdf) }}" target="_blank">Voir le PDF</a>
                           @else
                              N/A
                           @endif
                        </td>

                    </tbody>
                  </table>
                </div>
              </div>
             
            </div>
        </div>
</div> -->
@endsection