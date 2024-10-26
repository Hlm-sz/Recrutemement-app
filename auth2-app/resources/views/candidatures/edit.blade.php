@extends('layouts.auth')

@section('authcontent')
<div class="container">
    <h2>Modifier votre candidature</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <!-- Formulaire pour modifier la candidature -->
    <form action="{{ route('candidatures.update', ['candidature' => $candidature->id, 'concour' => $concour->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <input type="hidden" name="concour_id" value="{{ $concourId ?? '' }}">
        <div class="form-group">
            <label for="first_name_fr">Prénom (Français)</label>
            <input type="text" class="form-control" id="first_name_fr" name="first_name_fr" value="{{ old('first_name_fr', $candidature->first_name_fr) }}" required>
        </div>

        <div class="form-group">
            <label for="first_name_ar">Prénom (Arabe)</label>
            <input type="text" class="form-control" id="first_name_ar" name="first_name_ar" value="{{ old('first_name_ar', $candidature->first_name_ar) }}" required>
        </div>

        <div class="form-group">
            <label for="last_name_fr">Nom de famille (Français)</label>
            <input type="text" class="form-control" id="last_name_fr" name="last_name_fr" value="{{ old('last_name_fr', $candidature->last_name_fr) }}" required>
        </div>

        <div class="form-group">
            <label for="last_name_ar">Nom de famille (Arabe)</label>
            <input type="text" class="form-control" id="last_name_ar" name="last_name_ar" value="{{ old('last_name_ar', $candidature->last_name_ar) }}" required>
        </div>

        <div class="form-group">
            <label for="gender">Genre</label>
            <select class="form-control" id="gender" name="gender" required>
                <option value="male" {{ old('gender', $candidature->gender) == 'male' ? 'selected' : '' }}>Homme</option>
                <option value="female" {{ old('gender', $candidature->gender) == 'female' ? 'selected' : '' }}>Femme</option>
            </select>
        </div>

        <div class="form-group">
            <label for="national_id">Identifiant National</label>
            <input type="text" class="form-control" id="national_id" name="national_id" value="{{ old('national_id', $candidature->national_id) }}" required>
        </div>

        <div class="form-group">
            <label for="cnic_file">Document d'identité (PDF, JPEG, PNG)</label>
            <input type="file" class="form-control-file" id="cnic_file" name="cnic_file">
            @if($candidature->cnic_file)
                <p>Document actuel : <a href="{{ Storage::url($candidature->cnic_file) }}" target="_blank">Télécharger</a></p>
            @endif
        </div>

        <div class="form-group">
            <label for="date_naissance">Date de naissance</label>
            <input type="date" class="form-control" id="date_naissance" name="date_naissance" value="{{ old('date_naissance', $candidature->date_naissance) }}" required>
        </div>

        <div class="form-group">
            <label for="current_profession">Profession actuelle</label>
            <select class="form-control" id="current_profession" name="current_profession" required>
                <option value="autres" {{ old('current_profession', $candidature->current_profession) == 'autres' ? 'selected' : '' }}>Autres</option>
                <option value="employe" {{ old('current_profession', $candidature->current_profession) == 'employe' ? 'selected' : '' }}>Employé</option>
                <option value="fonctionnaire" {{ old('current_profession', $candidature->current_profession) == 'fonctionnaire' ? 'selected' : '' }}>Fonctionnaire</option>
                <option value="professionLiberale" {{ old('current_profession', $candidature->current_profession) == 'professionLiberale' ? 'selected' : '' }}>Profession libérale</option>
            </select>
        </div>

        <div class="form-group">
            <label for="military_status">Statut militaire</label>
            <select class="form-control" id="military_status" name="military_status">
                <option value="">Non spécifié</option>
                <option value="oui" {{ old('military_status', $candidature->military_status) == 'oui' ? 'selected' : '' }}>Oui</option>
                <option value="non" {{ old('military_status', $candidature->military_status) == 'non' ? 'selected' : '' }}>Non</option>
            </select>
        </div>

        <div class="form-group">
            <label for="military_status_pdf">Document de statut militaire (PDF, JPEG, PNG)</label>
            <input type="file" class="form-control-file" id="military_status_pdf" name="military_status_pdf">
            @if($candidature->military_status_pdf)
                <p>Document actuel : <a href="{{ Storage::url($candidature->military_status_pdf) }}" target="_blank">Télécharger</a></p>
            @endif
        </div>

        <div class="form-group">
            <label for="ville_id">Ville</label>
            <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="ville_id">
                                <option selected >Selectioner une ville</option>
                                @foreach($villes as $ville)
                                   <option value="{{ $ville->id }}" {{ old('ville_id') == $ville->id ? 'selected' : '' }}>{{ $ville->name }}</option>
                                @endforeach
            </select>                    
        </div>

        <div class="form-group">
            <label for="region_id">Région</label>
            <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="region_id">
                                <option selected >Selectioner une région</option>
                                @foreach($regions as $region)
                                    <option value="{{ $region->id }}" {{ old('region_id') == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="address_fr">Adresse (Français)</label>
            <input type="text" class="form-control" id="address_fr" name="address_fr" value="{{ old('address_fr', $candidature->address_fr) }}" required>
        </div>

        <div class="form-group">
            <label for="phone">Téléphone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $candidature->phone) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
    </form>
    
</div>
@endsection
