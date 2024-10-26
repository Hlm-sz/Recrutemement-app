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

                        @if (Auth::check() && Auth::user()->hasRole('candidat'))
                        <th>Postuler</th>  
                        @endif
                        
                        @if (Auth::user() && Auth::user()->usertype === 'admin')
                        <th>Actions</th>  
                        @endif
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

                        @if (Auth::user() && Auth::user()->usertype === 'candidat')
                        <td>
                        @if( (\Carbon\Carbon::now()->between($concour->date_affichage, $concour->date_limite_depot_dossier)))                        
                           <form action="{{ route('candidatures.create', ['concour' => $concour->id]) }}" method="GET">
                              <button type="submit" class="btn btn-info">Postuler</button>
                           </form>
                        @endif 
                        </td>
                        @endif

                        @if (Auth::user() && Auth::user()->usertype === 'admin')
                        <td> 
                          <div style="display: flex; align-items: center; gap: 10px;">     
                          
                            <a href="{{ route('concours.show', $concour) }}">
                              <!-- <box-icon name='show'></box-icon> -->
                              <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAd9JREFUSEvt1EuojlEUBuDnoCShKEkRynVCmGBCDMiAkWsM5DJkRklnYGKGYkKZIDFzyUhyiwFSysQtSbkMKKTc7VX76Du77z979M/OV3+7f++117ved71r9+jy19Pl/AYBqgrXJJqIjViNyZiQM77Da1zBGXzohNQJYCwOYldah1bK/IXjOIAvZWwbwGxcQ1T/I60ncA/P8i9yTMcMLMHOXMRLLMvM/uOUAFPwAONwF1vxosJgZgI8iwV4k2RbiPd9d5oAw5LW9zEPt7ACP3PgNBzDSnxN/TiFPQ3gEZnl3MTiJpa2AezFIbzCfHxqJLiKVQWTowVImOARon/B/HTENxmEhlNT0JoEcKlI9qeIjeNo6OgibjtO4mGWqh/AE8zB+rReKC5+xqhirw1gc7btY4Rc/QA24FxuVBx+bCQ8kiTbXZEoXBcSjcdaXCwBhqTG3sEi3M6W+12AbMv/yyYPz66L3l1P95e3NTn2xuQZCKsF2Jbc9IGc2rTpjTz13zoBxP7I5OnLmUEMWkxp2PcpniPsHLadhcXYkQctjLEO35vVdHoq4nnoTXOwHyHdQF8UsS+xP9wWVHvsJqXKN+UB63vs/qY36m2WLpieb05uCVIDqBRfPx4EqGrUdYn+AW7RVxkKyEc6AAAAAElFTkSuQmCC"/>
                            </a>
                            
                            <a href="{{ route('concours.edit', $concour) }}">
                              <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAiJJREFUSEu11UuoT1EUBvDfFSIDSqEMzJQyFnmmMJOBMkEhbxIpj8g1kFck7/KYmKAMFIVEGImSgVeMpCgDDIXYq/a57U7/e8///nVXncnZ+3zfWt+31jpdBji6BhhffwgGYzXmYBIm4h1e4xEu4nc94XYJJuAWJvdR8Spc7oRgNF5iPL7hBO5jOo5kwN042Iq8qYJBeIhZSZZrWIfvWI+zvYAvzXd/xXkTwRJcxeP0zMUfrCik2IMDReYrcQmLcaMdgidJjhmYl2UZh48JdAjiLCqroiS+guXtEPzAiAz4NyMtzNlFV4UfWxNplXlF9jVJOKaJIABCx58YVjNwPm7m9w+yfHHlMHbku0Pj+yYPvmBs7vn3NZKZuJtAhyOq24hn+elJvokgOigGKz6uuqbkmYY72JbNPZQreJreT22SaDNOZrQwLIxrFaNy68acfMiyRRuf74sgjDue0TYkmc417KyYl2jLRXieOy+8azkHYVKUGlEH34KRqT3D2JAhJJ6d5mMvwpNPmILPVUJ1D/alg+58uCathwtF5ptwqo9KbmNZXic910qCGKgYnog6eJh4LJ+9zV0VnfMKb3Cv1aKrSxSmrMX19FGsiCpKyWKhxWJrO8oKQsPYORHVdtyeJvlofhfS7W8bOV+se7CzWLvlhO4qjO8XR6tBix4+U3RYzMPpfqEWl3ub5AVpDcSUvsg7p1P8xv9Bx8C9zcF/A9YB/gHj5GUZGP+85QAAAABJRU5ErkJggg=="/>                            </a>
                            <form action="{{route('concours.destroy', $concour)}}" method="POST">
                              @csrf
                              @method('delete')
                              <button type="submit" style="background:none; border:none">
                                 
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAKRJREFUSEvtlUEKgCAQRV93CYK6TsdpGXSZrlPQaYpAXVjDt8xd7mR03v8z6FQUXlXh/ChAD4xAYwjZgAGYLaEKsACtcLkC3VvA7i5aQlRclkglUPELwF/I7X1wHFsvDvDKpfXIonn+dfO+BsQK1T7wUx2ohNkl+gGXd/W0JH8P5NeUXSJFeAxIGTQx9HbwWC/5HJUTUCvpLm6OTjUyE/Pbx4oDDlBhOBmYaWrOAAAAAElFTkSuQmCC"/>
                              </button>
                            </form> 
                          </div>
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



                <h5 class="card-header">Concours List Resultat </h5>
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