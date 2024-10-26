<!-- <!DOCTYPE html>
<html>
<head>
    <title>Edit Concours</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Edit Concours</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('concours.update', $concour) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nom_concour">Nom Concour:</label>
            <input type="text" class="form-control" id="nom_concour" name="nom_concour" value="{{ old('nom_concour', $concour->nom_concour) }}" required>
        </div>

        <div class="form-group">
            <label for="date_concour">Date Concour:</label>
            <input type="date" class="form-control" id="date_concour" name="date_concour" value="{{ old('date_concour', $concour->date_concour) }}" required>
        </div>

        <div class="form-group">
            <label for="date_affichage">Date Affichage:</label>
            <input type="date" class="form-control" id="date_affichage" name="date_affichage" value="{{ old('date_affichage', $concour->date_affichage) }}" required>
        </div>

        <div class="form-group">
            <label for="date_limite_depot_dossier">Date Limite Depot Dossier:</label>
            <input type="date" class="form-control" id="date_limite_depot_dossier" name="date_limite_depot_dossier" value="{{ old('date_limite_depot_dossier', $concour->date_limite_depot_dossier) }}" required>
        </div>

        <div class="form-group">
            <label for="nombre_poste">Nombre Poste:</label>
            <input type="number" class="form-control" id="nombre_poste" name="nombre_poste" value="{{ old('nombre_poste', $concour->nombre_poste) }}" required>
        </div>

        <div class="form-group">
            <label for="concour_pdf">Concour PDF:</label>
            <input type="file" class="form-control-file" id="concour_pdf" name="concour_pdf">
            @if($concour->concour_pdf)
                <p>Current PDF: <a href="{{ asset('storage/' . $concour->concour_pdf) }}">Download</a></p>
            @endif
        </div>

        <div class="form-group">
            <label for="statut">Statut:</label>
            <input type="text" class="form-control" id="statut" name="statut" value="{{ old('statut', $concour->statut) }}" required>
        </div>

        <div class="form-group">
            <label for="administration_id">Administration:</label>
            <select class="form-control" id="administration_id" name="administration_id">
                <option value="">Select Administration</option>
                @foreach($administrations as $administration)
                    <option value="{{ $administration->id }}" {{ $concour->administration_id == $administration->id ? 'selected' : '' }}>{{ $administration->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="profil_id">Profil:</label>
            <select class="form-control" id="profil_id" name="profil_id">
                <option value="">Select Profil</option>
                @foreach($profils as $profil)
                    <option  value="{{ $profil->id }}" {{ $concour->profil_id == $profil->id ? 'selected' : '' }}>{{ $profil->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="grade_id">Grade:</label>
            <select class="form-control" id="grade_id" name="grade_id">
                <option value="">Select Grade</option>
                @foreach($grades as $grade)
                    <option value="{{ $grade->id }}" {{ $concour->grade_id == $grade->id ? 'selected' : '' }}>{{ $grade->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="filiere_id">Filiere:</label>
            <select class="form-control" id="filiere_id" name="filiere_id">
                <option value="">Select Filiere</option>
                @foreach($filieres as $filiere)
                    <option value="{{ $filiere->id }}" {{ $concour->filiere_id == $filiere->id ? 'selected' : '' }}>{{ $filiere->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="specialite_id">Specialite:</label>
            <select class="form-control" id="specialite_id" name="specialite_id">
                <option value="">Select Specialite</option>
                @foreach($specialites as $specialite)
                    <option value="{{ $specialite->id }}" {{ $concour->specialite_id == $specialite->id ? 'selected' : '' }}>{{ $specialite->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Concours</button>
    </form>
</div>
</body>
</html> -->
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
                gradeFieldContainer.style.visibility = 'visible';
            }
        }

        function showSpecialtyField() {
            const filiereField = document.getElementById('filiere');
            const specialtyFieldContainer = document.getElementById('specialtyFieldContainer');
            
            if (filiereField.value) {
                specialtyFieldContainer.style.visibility = 'visible';
            } else {
                specialtyFieldContainer.style.visibility = 'visible';
            }
        }

        function setMinDate() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('dateAffichage').setAttribute('min', today);
        }
    </script>
   

   <script>
    $(document).ready(function() {
        // Convert selectedSpecialities JSON array from Blade to JavaScript
        var selectedSpecialities = {!! json_encode($concour->specialites->pluck('id')->toArray()) !!};


        // Log to verify selected specialities
        console.log("Selected Specialities:", selectedSpecialities);

        // Initialize Select2 for specialite dropdown
        $('#specialite').select2();

        // Handle change event for filiere dropdown
        $('#filiere').change(function() {
            var filiere = $(this).val();
            console.log("Selected Filiere:", filiere);

            if (filiere) {
                $.ajax({
                    url: '/getSpecialites/' + filiere,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log("Specialites Data:", data);

                        // Clear and re-enable the specialite dropdown
                        $('#specialite').empty().prop('disabled', false);

                        // Add a placeholder option
                        $('#specialite').append('<option value="">Sélectionnez la spécialité...</option>');

                        // Populate specialite dropdown with new options
                        $.each(data, function(key, value) {
                            $('#specialite').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                        // Reinitialize Select2
                        $('#specialite').select2();

                        // Set selected options
                        $('#specialite').val(selectedSpecialities).trigger('change');
                    },
                    error: function(xhr) {
                        // Handle errors if needed
                        console.error("Error fetching specialites:", xhr);
                    }
                });
            } else {
                // Disable specialite dropdown and reset options if no filiere is selected
                $('#specialite').empty().prop('disabled', true).append('<option value="">Sélectionnez la spécialité...</option>');
            }
        });

        // Trigger change event on page load to set initial specialities
        $('#filiere').trigger('change');
    });
</script>



    <!-- <script>
        
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
    </script> -->
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
            visibility: visible;
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
            visibility: visible;
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
                                    <form action="{{ route('concours.update', $concour) }}" method="POST" enctype="multipart/form-data">
                                           @csrf
                                           @method('PUT')
                                        <legend>Administration</legend>
                                        <div class="mb-3 row">
                                            <div class="col-md-8">
                                                <label for="nom">Concours de recrutement</label>
                                                <input type="text" class="form-control" id="nom" name="nom_concour" value="{{ old('nom_concour', $concour->nom_concour) }}" aria-label="Nom" required>
                                                @error('nom_concour')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label for="administration">Administration</label>
                                                <select class="form-control" id="administration" name="administration_id" aria-label="Administration" required>
                                                    <option value="">Sélectionnez l'administration...</option>
                                                     @foreach($administrations as $administration)
                                                    <option value="{{ $administration->id }}" {{ $concour->administration_id == $administration->id ? 'selected' : '' }}>{{ $administration->name }}</option>
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
                                                    <option  value="{{ $profil->id }}" {{ $concour->profil_id == $profil->id ? 'selected' : '' }}>{{ $profil->name }}</option>
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
                                                     <option value="{{ $grade->id }}" {{ $concour->grade_id == $grade->id ? 'selected' : '' }}>{{ $grade->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('grade')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-2">
                                                <label for="dateConcours">Date Concours</label>
                                                <input type="date" class="form-control" id="dateConcours" name="date_concour" value="{{ old('date_concour', $concour->date_concour) }}"  aria-label="Date Concours">
                                                @error('dateConcours')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-2">
                                                <label for="dateLimite">Date Limite de candidature</label>
                                                <input type="date" class="form-control" id="dateLimite" name="date_limite_depot_dossier" value="{{ old('date_limite_depot_dossier', $concour->date_limite_depot_dossier) }}" aria-label="Date Limite Dépôt du Dossier">
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
                                                      <option value="{{ $filiere->id }}" {{ $concour->filiere_id == $filiere->id ? 'selected' : '' }}>{{ $filiere->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('filiere')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div id="specialtyFieldContainer" class="form-group hidden col-4">
                                                <label for="specialite">Spécialité</label>
                                                <!-- <select class="form-control" id="specialite" name="specialite_ids[]" multiple> -->
                                                <select class="form-control" id="specialite" name="specialite_ids[]" multiple="multiple" aria-label="Spécialité">
                                                    <option value="" >Sélectionnez la spécialité...</option>
                                                </select>
                                                @error('specialite')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2">
                                                <label for="nombrePostes">Nombre de Postes</label>
                                                <input type="number" class="form-control" id="nombrePostes" name="nombre_poste" value="{{ old('nombre_poste', $concour->nombre_poste) }}" aria-label="Nombre de Postes" required>
                                                @error('nombrePostes')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2">
                                                <label for="dateAffichage">Date d'Affichage</label>
                                                <input type="date" class="form-control" id="dateAffichage" name="date_affichage" value="{{ old('date_affichage', $concour->date_affichage) }}" aria-label="Date d'Affichage" required>
                                                @error('dateAffichage')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <hr>
                                        <legend>Pièces Jointes</legend>
                                        
                                        <div class="mb-3 row">
                                            <div class="col-md-6">
                                                <label for="concour_pdf">Fichier</label>
                                                @if($concour->concour_pdf)
                                                <p>Current PDF: <a href="{{ asset('storage/' . $concour->concour_pdf) }}">Download</a></p>
                                                @endif
                                                <input type="file" class="form-control" id="concour_pdf" name="concour_pdf" aria-label="Fichier" >
                                                
                                                @error('concour_pdf')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="resultats_pdf_1">Liste des candidats au teste ecrit</label>
                                                <input type="file" name="resultats_pdf_1">
                                                <!-- <input type="file" class="form-control" id="resultats_pdf_1" name="resultats_pdf_1" aria-label="Fichier" > -->
                                                
                                                @error('concour_pdf')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            
                                        </div>

                                        <div class="mb-3 row">
                                            
                                            <div class="form-group col-2">
                                               <label for="statut">Statut</label>
                                               <input type="text" class="form-control" id="statut" name="statut" value="{{ old('statut', $concour->statut) }}"  readonly>
                                            </div>
                                            <div class="col-md-3 text-center">
                                                <button type="submit" class="btn btn-primary" style="margin-top: 31px; margin-right:0px">MODIFIER</button>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
    updateStatus(); // Initial call to set the status on page load

    // Add event listeners to update status when dates change
    document.getElementById('dateConcours').addEventListener('change', updateStatus);
    document.getElementById('dateLimite').addEventListener('change', updateStatus);
    document.getElementById('dateAffichage').addEventListener('change', updateStatus);
});

function updateStatus() {
    const dateConcours = new Date(document.getElementById('dateConcours').value);
    const dateLimite = new Date(document.getElementById('dateLimite').value);
    const dateAffichage = new Date(document.getElementById('dateAffichage').value);
    const today = new Date();

    let status = '';

    if (dateAffichage > today) {
        status = 'À venir'; // Upcoming
    } else if (dateConcours > today) {
        status = 'Ouvert'; // Open
    } else if (dateLimite < today) {
        status = 'Fermé'; // Closed
    }

    document.getElementById('statut').value = status;
}
</script>    
@endsection
