@extends('layouts.concours')

@section('content')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setMinDate();
            showSpecialtyField();

            $('#specialite').select2({
                placeholder: 'Sélectionnez la spécialité...',
                allowClear: true
            });
        });

        function showGradeField() {
            const profileField = document.getElementById('profile');
            const gradeFieldContainer = document.getElementById('gradeFieldContainer');
            
            if (profileField.value) {
                gradeFieldContainer.style.visibility = 'visible';
            } else {
                gradeFieldContainer.style.visibility = 'hidden';
            }
        }

        function showSpecialtyField() {
            const filiereField = document.getElementById('filiere');
            const specialtyFieldContainer = document.getElementById('specialtyFieldContainer');
            
            if (filiereField.value) {
                specialtyFieldContainer.style.visibility = 'visible';
            } else {
                specialtyFieldContainer.style.visibility = 'hidden';
            }
        }

        function setMinDate() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('dateAffichage').setAttribute('min', today);
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#filiere').change(function() {
                var filiere = $(this).val();
                if (filiere) {
                    $.ajax({
                        url: '/getSpecialites/' + filiere,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#specialite').empty().prop('disabled', false);
                            $('#specialite').append('<option value="">Sélectionnez la spécialité...</option>');
                            $.each(data, function(key, value) {
                                $('#specialite').append('<option value="'+ key +'">'+ value +'</option>');
                            });
                        }
                    });
                } else {
                    $('#specialite').empty().prop('disabled', true).append('<option value="">Sélectionnez la spécialité...</option>');
                }
            });
        });
    </script>
    <style>
        .text-right {
            text-align: right;
        }
        .rtl {
            direction: rtl;
        }
        .full-width-img {
            width: 100%;
            height: auto;
            display: block;
            margin: 0;
            padding: 0;
        }
        .hidden {
            visibility: hidden;
        }
        .inline-fields {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
        }
        .inline-fields .form-group {
            margin-right: 10px;
        }
        .inline-fields .form-group.hidden {
            visibility: hidden;
        }
        fieldset {
            text-align: left;
        }
        fieldset legend {
            text-align: left;
        }
        label{
            display: flex; 
            justify-content: flex;
        }
    </style>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y"> 
                    <div class="row">
                        <div class="col-xxl">
                            <div class="card mb-4">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <!-- Your header content -->
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('concours.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <legend>Administration</legend>
                                        <div class="mb-3 row">
                                            <div class="col-md-8">
                                                <label for="nom">Concours de recrutement</label>
                                                <input type="text" class="form-control" id="nom" name="nom_concour" value="{{ old('nom_concour') }}" aria-label="Nom" required>
                                                @error('nom')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label for="administration">Administration</label>
                                                <select class="form-control" id="administration" name="administration_id" aria-label="Administration" required>
                                                    <option value="">Sélectionnez l'administration...</option>
                                                    @foreach($administrations as $administration)
                                                        <option value="{{ $administration->id }}" {{ old('administration') == $administration->id ? 'selected' : '' }}>
                                                            {{ $administration->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('administration')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <hr>
                                        <legend>Concours de Recrutement</legend>
                                        <div class="mb-3 row ">
                                            <div class="form-group col-4">
                                                <label for="profile">Profil</label>
                                                <select class="form-control" id="profile" name="profil_id" aria-label="Profil" onchange="showGradeField()" required>
                                                    <option value="">Sélectionnez le profil...</option>
                                                    @foreach($profils as $profil)
                                                       <option  value="{{ $profil->id }}" {{ old('profil_id') == $profil->id ? 'selected' : '' }}>
                                                          {{ $profil->name }}
                                                       </option>
                                                    @endforeach
                                                </select>
                                                @error('profile')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div id="gradeFieldContainer" class="form-group hidden col-4">
                                                <label for="grade">Grade</label>
                                                <select class="form-control" id="grade" name="grade_id" aria-label="Grade">
                                                    <option value="">Sélectionnez le grade...</option>
                                                    @foreach($grades as $grade)
                                                        <option value="{{ $grade->id }}" {{ old('grade_id') == $grade->id ? 'selected' : '' }}>
                                                            {{ $grade->name }}
                                                        </option>
                                                     @endforeach
                                                </select>
                                                @error('grade')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-2">
                                                <label for="dateConcours">Date Concours</label>
                                                <input type="date" class="form-control" id="dateConcours" name="date_concour" value="{{ old('date_concour') }}" aria-label="Date Concours">
                                                @error('dateConcours')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-2">
                                                <label for="dateLimite">Date Limite de candidature</label>
                                                <input type="date" class="form-control" id="dateLimite" name="date_limite_depot_dossier" value="{{ old('date_limite_depot_dossier') }}" aria-label="Date Limite Dépôt du Dossier">
                                                @error('dateLimite')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="form-group col-4">
                                                <label for="filiere">Filière</label>
                                                <select class="form-control" id="filiere" name="filiere_id" aria-label="Filière" onchange="showSpecialtyField()" required>
                                                    <option value="">Sélectionnez la filière...</option>
                                                    @foreach($filieres as $filiere)
                                                        <option value="{{ $filiere->id }}" {{ old('filiere_id') == $filiere->id ? 'selected' : '' }}>
                                                           {{ $filiere->name }}
                                                       </option>
                                                   @endforeach
                                                </select>
                                                @error('filiere')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div id="specialtyFieldContainer" class="form-group hidden col-4">
                                                <label for="specialite">Spécialité</label>
                                                <select class="form-control" id="specialite" name="specialite_ids[]" multiple="multiple" aria-label="Spécialité">
                                                    <option value="" >Sélectionnez la spécialité...</option>
                                                </select>
                                                @error('specialite')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2">
                                                <label for="nombrePostes">Nombre de Postes</label>
                                                <input type="number" class="form-control" id="nombrePostes" name="nombre_poste" value="{{ old('nombre_poste') }}" aria-label="Nombre de Postes" required>
                                                @error('nombrePostes')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2">
                                                <label for="dateAffichage">Date d'Affichage</label>
                                                <input type="date" class="form-control" id="dateAffichage" name="date_affichage" value="{{ old('date_affichage') }}" aria-label="Date d'Affichage" required>
                                                @error('dateAffichage')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <hr>
                                        <legend>Pièces Jointes</legend>
                                        
                                        <div class="mb-3 row">
                                            <div class="col-md-8">
                                                <label for="concour_pdf">Fichier</label>
                                                <input type="file" class="form-control" id="concour_pdf" name="concour_pdf" aria-label="Fichier" required>
                                                @error('concour_pdf')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-3 text-center">
                                                <button type="submit" class="btn btn-primary" style="margin-top: 31px; margin-right:0px">Ajouter un concours</button>
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
